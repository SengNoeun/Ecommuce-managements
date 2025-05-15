<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Exception;

class CategoryController extends Controller
{
    public function index()
    {
        $categorys = Category::all();
        return view('admin.categorys.index', compact('categorys'));
        
    }

    public function create()
    {
        return view('admin.categorys.create');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categorys.edit', compact('category'));
    }

    public function store(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'status' => 'required|in:0,1',
            'image.*' => 'nullable|image|mimes:jpeg,jpg,png,gif,svg|max:5120', // Multiple images
        ]);

        try {
            $imageNames = [];

            // Handle multiple image uploads
            if ($request->hasFile('image')) {
                $totalImages = count($request->file('image'));
                if ($totalImages > 4) {
                    return back()->withErrors(['image' => 'You can upload a maximum of 4 images.']);
                }
                foreach ($request->file('image') as $imageFile) {
                    $imagePath = $imageFile->store('images', 'public');
                    if (!$imagePath) {
                        throw new Exception('Failed to store image');
                    }
                    $imageNames[] = $imagePath;
                }
            }

            // Prepare data
            $data = [
                'name' => $validated['name'],
                'status' => $validated['status'],
                'image' => !empty($imageNames) ? json_encode($imageNames) : null,
            ];

            // Create category
            Category::create($data);

            return redirect()->route('admin.categorys.index')->with('success', 'Category created successfully!');
        } catch (Exception $e) {
            Log::error('Error creating category', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()->back()->with('error', 'Failed to create category: ' . $e->getMessage());
        }
    }

   public function update(Request $request, $id)
{
    // Validate input
    $validated = $request->validate([
        'name' => 'required|string|max:255|unique:categories,name,' . $id,
        'status' => 'required|in:0,1',
        'images.*' => 'nullable|image|mimes:jpeg,jpg,png,gif,svg|max:2048',
        'existing_images' => 'nullable|array',
        'remove_images' => 'nullable|array',
    ]);

    try {
        $category = Category::findOrFail($id);
        $existingImages = json_decode($category->image, true) ?? [];

        // Log request data for debugging
        Log::info('Update request data', [
            'remove_images' => $request->input('remove_images', []),
            'existing_images' => $existingImages,
        ]);

        // Handle image removals
        $removeImages = $request->input('remove_images', []);
        $updatedImages = $existingImages;

        foreach ($removeImages as $image) {
            if (in_array($image, $updatedImages)) {
                // Normalize path to avoid issues with slashes
                $image = ltrim($image, '/');
                if (Storage::disk('public')->exists($image)) {
                    Storage::disk('public')->delete($image);
                    Log::info('Deleted image from storage', ['image' => $image]);
                } else {
                    Log::warning('Image not found in storage', ['image' => $image]);
                }
                $updatedImages = array_values(array_diff($updatedImages, [$image]));
            } else {
                Log::warning('Image not found in existing images', ['image' => $image]);
            }
        }

        // Handle new image uploads
        $newImages = [];
            if ($request->hasFile('images')) {
                $totalImages = count($updatedImages) + count($request->file('images'));
                if ($totalImages > 4) {
                    return back()->withErrors(['images' => 'You can only have up to 4 images in total.']);
                }
                foreach ($request->file('images') as $image) {
                    $imagePath = $image->store('images', 'public');
                    if (!$imagePath) {
                        throw new Exception('Failed to store image');
                    }
                    $newImages[] = $imagePath;
                    Log::info('Uploaded new image', ['image' => $imagePath]);
                }
            }

        // Merge existing and new images
        $finalImages = array_merge($updatedImages, $newImages);

        // Prepare data
        $data = [
            'name' => $validated['name'],
            'status' => $validated['status'],
            'image' => !empty($finalImages) ? json_encode($finalImages) : null,
        ];

        // Update category
        $category->update($data);

        return redirect()->route('admin.categorys.index')->with('success', 'Category updated successfully!');
    } catch (Exception $e) {
        Log::error('Error updating category', [
            'error' => $e->getMessage(),
            'input' => $request->except('images'),
            'remove_images' => $request->input('remove_images', []),
            'existing_images' => $existingImages,
            'trace' => $e->getTraceAsString(),
        ]);

        return redirect()->back()->with('error', 'Failed to update category: ' . $e->getMessage());
    }
}
    public function destroy($id)
    {
        try {
            $category = Category::findOrFail($id);
            $images = json_decode($category->image, true) ?? [];

            // Delete all associated images
            foreach ($images as $image) {
                if (Storage::disk('public')->exists($image)) {
                    Storage::disk('public')->delete($image);
                }
            }

            $category->delete();
            return redirect()->route('admin.categorys.index')->with('success', 'Category deleted successfully!');
        } catch (Exception $e) {
            Log::error('Error deleting category', [
                'error' => $e->getMessage(),
                'category_id' => $id,
            ]);

            return redirect()->back()->with('error', 'Failed to delete category: ' . $e->getMessage());
        }
    }
}