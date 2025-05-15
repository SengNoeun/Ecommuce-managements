@extends('Layout.app')

@section('content')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <div class="container mx-auto p-6">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl font-semibold text-gray-800">Categories</h1>
            <a href="{{ route('admin.categorys.create') }}"
                 class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium flex items-center gap-2">
                <i class="fas fa-plus"></i> Add Category
        </a>

        </div>

        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 rounded-md" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="py-3 px-6 text-left text-sm font-medium text-gray-700">ID</th>
                        <th class="py-3 px-6 text-left text-sm font-medium text-gray-700">Name</th>
                        <th class="py-3 px-6 text-left text-sm font-medium text-gray-700">Status</th>
                        <th class="py-3 px-6 text-left text-sm font-medium text-gray-700">Image</th>
                        <th class="py-3 px-6 text-left text-sm font-medium text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categorys as $category)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="py-3 px-6 text-sm text-gray-800">{{ $category->id }}</td>
                            <td class="py-3 px-6 text-sm text-gray-800">{{ $category->name }}</td>
                            <td class="py-3 px-6 text-sm text-gray-800">
                                <span class="px-2 py-1 rounded-full text-xs font-semibold 
                                    {{ $category->status == 1 ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                    {{ $category->status == 1 ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td class="py-3 px-6">
                                @php
                                    $images = json_decode($category->image, true);
                                    $images = is_array($images) ? array_slice($images, 0,1) : []; // Limit to 4 images
                                @endphp

                                @if ($images)
                                    <div class="grid grid-cols-2 gap-2 max-w-xs">
                                        @foreach ($images as $img)
                                            <img src="{{ asset('storage/' . $img) }}" 
                                                 alt="Category Image" 
                                                 class="w-16 h-16 object-cover rounded-md border" />
                                        @endforeach
                                    </div>
                                @else
                                    <img src="{{ asset('images/placeholder.jpg') }}" 
                                         class="w-16 h-16 object-cover rounded-md border" 
                                         alt="No Image">
                                @endif
                            </td>

                            <td class="py-3 px-6 text-sm">
                                <div class="flex space-x-4">
                                    <a href="{{ route('admin.categorys.edit', $category->id) }}" 
                                       class="text-blue-600 hover:text-blue-800 font-medium">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.categorys.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 font-medium">
                                            <i class="fas fa-trash-alt"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
<script>

</script>
