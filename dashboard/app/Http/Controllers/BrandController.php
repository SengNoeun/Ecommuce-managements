<?php

namespace App\Http\Controllers;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
    public function index(){
        $brands = Brand::all();
        return view('admin.brands.index', compact('brands'));
    }
    public function create(){
        return view('admin.brands.create');
    }
    public function edit($id){
        $brand = Brand::findOrFail($id);
        return view('admin.brands.edit', compact('brand'));

    }
    public function store(Request $request)
    {
        $validated=$request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Max 2MB
        ]);

        try {
        $data = [
            'name' => $validated['name'],
            'status' => $validated['status'],
        ];

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('Brand_images', 'public');
            if (!$imagePath) {
                throw new \Exception('Failed to store image');
            }
            $data['image'] = $imagePath;
        }

        Brand::create($data);

        return redirect()->route('admin.brands.create')->with('success', 'Brand created successfully!');
    } catch (Exception $e) {
        Log::error('Error creating category', [
            'error' => $e->getMessage(),
            'input' => $request->except('image'),
        ]);

        return redirect()->back()->with('error', 'Failed to create category: ' . $e->getMessage());
    
    }

}
public function destroy($id)
    {
        $brand = Brand::findOrFail($id);
        if ($brand->image) {
            Storage::disk('public')->delete($brand->image);
        }
        $brand->delete();
        return redirect()->route('admin.brands.index')->with('success', 'Brand deleted successfully!');
    }
public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:brands,name,' . $id,
            'status' => 'required|in:0,1',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            $brand = Brand::findOrFail($id);
            $data = [
                'name' => $validated['name'],
                'status' => $validated['status'],
            ];

            if ($request->hasFile('image')) {
                if ($brand->image) {
                    Storage::disk('public')->delete($brand->image);
                }
                $imagePath = $request->file('image')->store('Brand_images', 'public');
                if (!$imagePath) {
                    throw new \Exception('Failed to store image');
                }
                $data['image'] = $imagePath;
            }

            $brand->update($data);

            return redirect()->route('admin.brands.index')->with('success', 'Brand updated successfully!');
        } catch (Exception $e) {
            Log::error('Error updating brand', [
                'error' => $e->getMessage(),
                'input' => $request->except('image'),
            ]);

            return redirect()->back()->with('error', 'Failed to update brand: ' . $e->getMessage());
        }
    }
}
