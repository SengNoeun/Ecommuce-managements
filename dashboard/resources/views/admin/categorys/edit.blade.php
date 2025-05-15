@extends('Layout.app')

@section('title', 'Edit Category')

@section('content')
<div id="editCategoryModal" class="bg-gray-100 min-h-screen flex items-center justify-center p-6">
    <div class="bg-white border border-gray-300 rounded-xl shadow-2xl w-full max-w-2xl p-8 mx-auto">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6 border-b pb-2 text-center">Edit Category</h2>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="bg-green-100 border border-green-500 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.categorys.update', $category->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Name -->
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Category Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $category->name) }}" required
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm sm:text-sm focus:ring-blue-500 focus:border-blue-500">
                @error('name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Status -->
            <div class="mb-4">
                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select name="status" id="status"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm sm:text-sm focus:ring-blue-500 focus:border-blue-500" required>
                    <option value="1" {{ old('status', $category->status) == '1' ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ old('status', $category->status) == '0' ? 'selected' : '' }}>Inactive</option>
                </select>
                @error('status')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Image Upload -->
            <div class="mb-4">
                <label for="images" class="block text-sm font-medium text-gray-700 mb-1">Images (Max 4)</label>
                <input type="file" name="images[]" id="images" accept="image/*" multiple
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm sm:text-sm focus:ring-blue-500 focus:border-blue-500">
                @error('images.*')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
                <p class="text-sm text-gray-500 mt-1">You can upload up to 4 images. Existing images are shown below.</p>
            </div>

            <!-- Existing Images -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Current Images</label>
                <div id="existing-images" class="grid grid-cols-2 gap-2 max-w-xs">
                    @php
                        $images = json_decode($category->image, true) ?? [];
                    @endphp
                    @if ($images)
                        @foreach ($images as $index => $img)
                            <div class="relative" data-image-path="{{ $img }}">
                                <img src="{{ asset('storage/' . $img) }}" alt="Category Image"
                                    class="w-16 h-16 object-cover rounded-md border">
                                <button type="button" class="remove-image absolute top-0 right-[5] bg-red-600 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs"
                                    data-index="{{ $index }}" data-path="{{ $img }}">×</button>
                                <input type="hidden" name="existing_images[]" value="{{ $img }}">
                            </div>
                        @endforeach
                    @else
                        <p class="text-sm text-gray-500">No images uploaded.</p>
                    @endif
                </div>
                <!-- Container for remove_images inputs -->
                <div id="remove-images-container" class="hidden"></div>
            </div>

            <!-- New Image Previews -->
            <div class="mb-4 hidden" id="preview-container">
                <label class="block text-sm font-medium text-gray-700 mb-1">New Image Previews</label>
                <div id="image-previews" class="grid grid-cols-2 gap-2 max-w-xs"></div>
            </div>

            <!-- Buttons -->
            <div class="flex justify-end space-x-3 pt-4 border-t mt-6">
                <a href="{{ route('admin.categorys.index') }}"
                    class="px-4 py-2 border border-gray-400 text-gray-700 rounded-md hover:bg-gray-100">
                    Cancel
                </a>
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md shadow-sm">
                    Update Category
                </button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.tailwindcss.com"></script>
<script>
    // Image upload preview
    document.getElementById('images').addEventListener('change', function (event) {
        const files = event.target.files;
        const previewContainer = document.getElementById('preview-container');
        const previews = document.getElementById('image-previews');
        previews.innerHTML = ''; // Clear previous previews

        const existingImagesCount = document.querySelectorAll('#existing-images > div').length;
        const maxImages = 4;
        const allowedFiles = Math.min(files.length, maxImages - existingImagesCount);

        if (allowedFiles > 0) {
            previewContainer.classList.remove('hidden');
            for (let i = 0; i < allowedFiles; i++) {
                const file = files[i];
                const reader = new FileReader();
                reader.onload = function (e) {
                    const div = document.createElement('div');
                    div.className = 'relative';
                    div.innerHTML = `
                        <img src="${e.target.result}" alt="New Image Preview" class="w-16 h-16 object-cover rounded-md border">
                    `;
                    previews.appendChild(div);
                };
                reader.readAsDataURL(file);
            }
        } else {
            previewContainer.classList.add('hidden');
            if (files.length > 0) {
                alert(`You can only upload up to ${maxImages} images in total.`);
                event.target.value = ''; // Clear the input
            }
        }
    });

    // Remove existing image
    document.querySelectorAll('.remove-image').forEach(button => {
        button.addEventListener('click', function () {
            const path = this.getAttribute('data-path');
            const container = this.parentElement;
            const existingImages = document.getElementById('existing-images');
            const removeImagesContainer = document.getElementById('remove-images-container');

            // Add hidden input for removal
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'remove_images[]';
            input.value = path;
            removeImagesContainer.appendChild(input);

            console.log('Added remove_images input:', path); // Debugging

            // Remove from display
            container.remove();

            // Update "No images" message
            if (!existingImages.querySelector('div')) {
                existingImages.innerHTML = '<p class="text-sm text-gray-500">No images uploaded.</p>';
            }
        });
    });
</script>
@endsection