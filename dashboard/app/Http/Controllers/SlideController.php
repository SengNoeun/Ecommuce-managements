<?php

namespace App\Http\Controllers;
use App\Models\Slide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Exception;
class SlideController extends Controller
{
    public function index(Request $request)
    {
        $slides = Slide::all();
        return view('admin.slide.index', compact('slides'));
    }
   

    public function create()
    {
        return view('admin.slide.create');
    }

    public function edit($id)
    {
        $slide=Slide::findOrFail($id);
        return view('admin.slide.edit', compact('slide'));
        
    }
    public function store( Request $request)
    {
        $validated=$request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|boolean',
            'od' => 'required|string|max:255',

            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Max 2MB
        ]);

       try {
        $data = [
            'name' => $validated['name'],
            'status' => $validated['status'],
            'od' => $validated['od'],
        ];

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('category_images', 'public');
            if (!$imagePath) {
                throw new \Exception('Failed to store image');
            }
            $data['image'] = $imagePath;
        }

        Slide::create($data);

        return redirect()->route('admin.slide.index')->with('success', 'Category created successfully!');
    } catch (Exception $e) {
        Log::error('Error creating category', [
            'error' => $e->getMessage(),
            'input' => $request->except('image'),
        ]);

        return redirect()->back()->with('error', 'Failed to create category: ' . $e->getMessage());
    }


        
    }
public function update(Request $request, $id)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'status' => 'required|boolean',
        'od' => 'required|string|max:255',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Max 2MB
    ]);

    try {
        $data = [
            'name' => $validated['name'],
            'status' => $validated['status'],
            'od' => $validated['od'],
        ];

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('slide_images', 'public');
            if (!$imagePath) {
                throw new \Exception('Failed to store image');
            }
            $data['image'] = $imagePath;
        }

        Slide::where('id', $id)->update($data);

        return redirect()->route('admin.slide.index')->with('success', 'Category updated successfully!');
    } catch (Exception $e) {
        Log::error('Error updating category', [
            'error' => $e->getMessage(),
            'input' => $request->except('image'),
        ]);

        return redirect()->back()->with('error', 'Failed to update category: ' . $e->getMessage());
    }

}
public function destroy($id)
{
    try {
        $slide = Slide::findOrFail($id);
        if ($slide->image) {
            Storage::disk('public')->delete($slide->image);
        }
        $slide->delete();

        return redirect()->route('admin.slide.index')->with('success', 'Category deleted successfully!');
    } catch (Exception $e) {
        Log::error('Error deleting category', [
            'error' => $e->getMessage(),
        ]);

        return redirect()->back()->with('error', 'Failed to delete category: ' . $e->getMessage());
    }
}
}
