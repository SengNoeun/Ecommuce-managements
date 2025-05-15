@extends('Layout.app')

@section('content')
<div id="addCategoryModal" class="bg-white items-center justify-center">
    <div class="bg-white border border-gray-300 rounded-xl shadow-2xl w-full p-6">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6 border-b pb-2">Add Category</h2>

        <form action="{{ route('admin.categorys.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Name -->
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm sm:text-sm focus:ring-blue-500 focus:border-blue-500 @error('name') border-red-500 @enderror">
                @error('name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Status -->
            <div class="mb-4">
                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select name="status" id="status"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm sm:text-sm focus:ring-blue-500 focus:border-blue-500 @error('status') border-red-500 @enderror">
                    <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
                </select>
                @error('status')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Image Upload -->
                <div class="mb-4">
                <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Images (Optional)</label>
                <input type="file" name="image[]" id="image" class="form-control @error('image.*') border-red-500 @enderror" multiple>
                
                @error('image.*')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror

                <!-- Image Preview -->
                <div id="image-preview" class="mt-2 flex flex-wrap gap-2"></div>
            </div>
            <!-- Buttons -->
            <div class="flex justify-end space-x-3 pt-4 border-t mt-6">
                <a href="{{ route('admin.categorys.index') }}"
                    class="px-4 py-2 border border-gray-400 text-gray-700 rounded-md hover:bg-gray-100">
                    Cancel
                </a>
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md shadow-sm">
                    Save
                </button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.tailwindcss.com"></script>
<script>
    document.getElementById('image').addEventListener('change', function (event) {
        const files = event.target.files;
        const preview = document.getElementById('image-preview');
        preview.innerHTML = ''; // Clear previous previews

        if (files.length > 0) {
            Array.from(files).forEach(file => {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.classList.add('w-20', 'h-20', 'object-cover', 'rounded');
                    preview.appendChild(img);
                };
                reader.readAsDataURL(file);
            });
        }
    });
</script>
@endsection