<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Exception;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Slide;
use Illuminate\Support\Facades\Redis;

class ProductController extends Controller
{       
    public function show(Request $request, $id)
    {
        // Fetch products from the database
        $products = Product::all();
        
        // Fetch the product by ID
        $product = Product::findOrFail($id);

        // Fetch the category of the product
        $category = Category::find($product->category);

        // Fetch the brand of the product
        $brand = Brand::find($product->brand);

        // Fetch the slide of the product
        $slide = Slide::find($product->slide);

        // Return the view with the product and its related data
        return view('admin.products.show', compact('product', 'category', 'brand', 'slide'));
       
    }
    public  function create(Request $request)
    {
        // Fetch products from the database
        $products = Product::all();
        $slides = Slide::where('status', 1)->get();
        $categories = Category::where('status', 1)->get();
        $brands = Brand::where('status', 1)->get();
        return view('admin.products.create', compact('products', 'slides', 'categories', 'brands')); 
    }
    // public  function index(Request $request){
           // ProductController.php
public function index()
{
    $products = Product::all()->map(function ($product) {
        $product->slide_name = Slide::find($product->slide)->name ?? 'N/A';
        $product->brand_name = Brand::find($product->brand)->name ?? 'N/A';
        $product->category_name = Category::find($product->category)->name ?? 'N/A';
        return $product;
    });
    return view('admin.products.index', compact('products'));
}
    //    return view('admin.products.index',compact('products') );
    // }
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $slides = Slide::where('status', 1)->get();
        $categorys = Category::where('status', 1)->get();
        $brands = Brand::where('status', 1)->get();
        return view('admin.products.edit', compact('product', 'slides', 'categorys', 'brands'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'discount' => 'nullable|numeric',
            'description' => 'nullable|string',
            'price_after_discount' => 'nullable|numeric',
            'status' => 'required|boolean',
            'brand' => 'required|exists:brands,id',
            'category' => 'required|exists:categories,id',
            'slide' => 'required|exists:slide,id',
            'od' => 'required|string|max:255',
            'name_link' => 'required|string|max:255',
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
                    $imagePath = $imageFile->store('images_product', 'public');
                    if (!$imagePath) {
                        throw new Exception('Failed to store image');
                    }
                    $imageNames[] = $imagePath;
                }
            }
            // Prepare data
            $data = [
                'name' => $validated['name'],
                'price' => $validated['price'],
                'discount' => $validated['discount'],
                'description' => $validated['description'],
                'price_after_discount' => $validated['price_after_discount'],
                'status' => $validated['status'],
                'brand' => $validated['brand'],
                'category' => $validated['category'],
                'slide' => $validated['slide'],
                'od' => $validated['od'],
                'name_link' => $validated['name_link'],
                'image' => !empty($imageNames) ? json_encode($imageNames) : null,
            ];

            
            Product::create($data);

            return redirect()->route('admin.products.index')->with('success', __('Product created successfully!'));
        } catch (Exception $e) {
            Log::error('Error creating product', [
                'error' => $e->getMessage(),
                'input' => $request->except('image'),
            ]);
            return redirect()->back()->withErrors(__('Failed to create product. Please try again.'));
        }
    }
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'discount' => 'nullable|numeric',
            'description' => 'nullable|string',
            'price_after_discount' => 'nullable|numeric',
            'status' => 'required|boolean',
            'brand' => 'required|exists:brands,id',
            'category' => 'required|exists:categories,id',
            'slide' => 'required|exists:slide,id',
            'od' => 'required|string|max:255',
            'name_link' => 'required|string|max:255',
            'images.*' => 'nullable|image|mimes:jpeg,jpg,png,gif,svg|max:2048',
            'existing_images' => 'nullable|array',
            'remove_images' => 'nullable|array',
        ]);


        try {
            $product = Product::findOrFail($id);
            $existingImages = json_decode($product->image, true) ?? [];
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
        $newImages = [];
        if ($request->hasFile('images')) {
            $totalImages = count($updatedImages) + count($request->file('images'));
            if ($totalImages > 4) {
                return back()->withErrors(['images' => 'You can only have up to 4 images in total.']);
            }
            foreach ($request->file('images') as $image) {
                $imagePath = $image->store('images_product', 'public');
                if (!$imagePath) {
                    throw new Exception('Failed to store image');
                }
                $newImages[] = $imagePath;
                Log::info('Uploaded new image', ['image' => $imagePath]);
            }
        }
        // Merge existing and new images
        $imageNames = array_merge($updatedImages, $newImages);

            $data = [
                'name' => $validated['name'],
                'price' => $validated['price'],
                'discount' => $validated['discount'],
                'description' => $validated['description'],
                'price_after_discount' => $validated['price_after_discount'],
                'status' => $validated['status'],
                'brand' => $validated['brand'],
                'category' => $validated['category'],
                'slide' => $validated['slide'],
                'od' => $validated['od'],
                'name_link' => $validated['name_link'],
                'image' => !empty($imageNames) ? json_encode($imageNames) : null,
            ];
            // Update the product
            $product->update($data);
            return redirect()->route('admin.products.index')->with('success', __('Product updated successfully!'));
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
         $product = Product::findOrFail($id);
            $images = json_decode($product->image, true) ?? [];

            // Delete all associated images
            foreach ($images as $image) {
                if (Storage::disk('public')->exists($image)) {
                    Storage::disk('public')->delete($image);
                }
            }
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', __('Product deleted successfully!'));
    } catch (Exception $e) {
        Log::error('Error deleting product', [
            'error' => $e->getMessage(),
            'product_id'=>$id,
        ]);

        return redirect()->back()->withErrors(__('Failed to delete product. Please try again.'));
    }
    
}
public function getdata(Request $request)
{
    if ($request->has('id')) {
        $id = $request->input('id');
        $product = Product::find($id);
        if ($product) {
            return response()->json($product);
        } else {
            return response()->json(['error' => 'Product not found'], 404);
        }
    } else {
        $products = Product::all();
        return response()->json($products);
    }
}
}

