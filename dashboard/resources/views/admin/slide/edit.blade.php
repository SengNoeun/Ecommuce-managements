@extends('Layout.app')

@section('title', 'Edit Slide')

@section('content')
<div id="editSlideModal" class="bg-white items-center justify-center">
    <div class="bg-white border border-gray-300 rounded-xl shadow-2xl w-[70%] p-6  mx-auto">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6 border-b pb-2 text-center">Edit Slide</h2>

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

        <form action="{{ route('admin.slide.update', $slide->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Name -->
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Slide Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $slide->name) }}" required
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm sm:text-sm focus:ring-blue-500 focus:border-blue-500">
                @error('name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Display Order (od) -->
            <div class="mb-4">
                <label for="od" class="block text-sm font-medium text-gray-700 mb-1">Display Order</label>
                <input type="number" name="od" id="od" value="{{ old('od', $slide->od) }}" required
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm sm:text-sm focus:ring-blue-500 focus:border-blue-500">
                @error('od')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Status -->
            <div class="mb-4">
                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select name="status" id="status"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm sm:text-sm focus:ring-blue-500 focus:border-blue-500" required>
                    <option value="1" {{ old('status', $slide->status) == '1' ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ old('status', $slide->status) == '0' ? 'selected' : '' }}>Inactive</option>
                </select>
                @error('status')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Image -->
           <div class="mb-4">
                <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Image</label>
                <input type="file" name="image" id="image" accept="image/*"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm sm:text-sm focus:ring-blue-500 focus:border-blue-500">
                @error('image')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
                <div class="mt-3">
                    <img id="image-preview" src="{{ $slide->image ? Storage::url($slide->image) : 'https://media.istockphoto.com/id/1324356458/vector/picture-icon-photo-frame-symbol-landscape-sign-photograph-gallery-logo-web-interface-and.jpg?s=612x612&w=0&k=20&c=ZmXO4mSgNDPzDRX-F8OKCfmMqqHpqMV6jiNi00Ye7rE=' }}"
                         class="w-24 h-24 rounded-md border border-gray-300 object-cover {{ $slide->image ? '' : '' }}" alt="Preview">
                </div>
            </div>

            <!-- Buttons -->
            <div class="flex justify-end space-x-3 pt-4 border-t mt-6">
                <a href="{{ route('admin.slide.index') }}"
                    class="px-4 py-2 border border-gray-400 text-gray-700 rounded-md hover:bg-gray-100">
                    Cancel
                </a>
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md shadow-sm">
                    Update Slide
                </button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.tailwindcss.com"></script>
<script>
    // Image Preview
    document.getElementById('image').addEventListener('change', function (event) {
        const file = event.target.files[0];
        const preview = document.getElementById('image-preview');
        const defaultSrc = '{{ $slide->image ? Storage::url($slide->image) : asset('images/placeholder.jpg') }}';

        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result;
            };
            reader.readAsDataURL(file);
        } else {
            preview.src = defaultSrc;
        }
    });
    
</script>
@endsection