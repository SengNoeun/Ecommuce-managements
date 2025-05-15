@extends('Layout.app')
@section('content')
<div id="addCategoryModal" class=" bg-white m-auto  items-center w-[70%] justify-center  ">
    <div class="bg-white border border-gray-300     rounded-xl shadow-2xl  ">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6 border-b pb-2 text-center">Add User</h2>
        @if ($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.user.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4 pl-10 ">
            <!-- CSRF Token --> 
            @csrf

            <!-- Name -->
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
              <input type="text" name="name" id="name"  required
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm sm:text-sm focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div class="mb-4">
                <label for="gender" class="block text-sm font-medium text-gray-700 mb-1">Gender</label>
                <select name="gender" id="gender"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm sm:text-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="1">Man</option>
                    <option value="0">Femal</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
              <input type="number" name="phone" id="phone"  required
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm sm:text-sm focus:ring-blue-500 focus:border-blue-500">
            </div>
             <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">date of bith</label>
              <input type="date" name="dob" id="dob"  required
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm sm:text-sm focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">password</label>
             <input type="number" name="pass" id="pass"  required
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm sm:text-sm focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div class="mb-4">
                <label for="pass_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                <input type="password" name="pass_confirmation" id="pass_confirmation" required
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm sm:text-sm focus:ring-blue-500 focus:border-blue-500 @error('password_confirmation') border-red-500 @enderror">
                @error('password_confirmation')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
             <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">email</label>
             <input type="email" name="email" id="email"  required
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm sm:text-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <!-- gender -->
            <div class="mb-4">
                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">status</label>
                <select name="status" id="status"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm sm:text-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="1">active</option>
                    <option value="0">inactive</option>
                </select>
            </div>
            

            <!-- Image Upload -->
            <div class="mb-4">
                <label for="image-input" class="block text-sm font-medium text-gray-700 mb-1">Image</label>
                <input type="file" name="image" id="image-input" accept="image/*"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm sm:text-sm focus:ring-blue-500 focus:border-blue-500">
                <div class="mt-3">
                    <img id="image-preview" src="{{ asset('https://media.istockphoto.com/id/1324356458/vector/picture-icon-photo-frame-symbol-landscape-sign-photograph-gallery-logo-web-interface-and.jpg?s=612x612&w=0&k=20&c=ZmXO4mSgNDPzDRX-F8OKCfmMqqHpqMV6jiNi00Ye7rE=') }}"
                         class="w-24 h-24 rounded-md border border-gray-300 object-cover" alt="Preview">
                </div>
                </div>
            
            <!-- Buttons -->
                <div class="flex justify-end space-x-3 pt-4 border-t mt-6">
                <a href="{{ route('admin.user.index') }}"
                    class="px-4 py-2 border border-gray-400 text-gray-700 rounded-md hover:bg-gray-100">
                    Cancel
                </a>
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md shadow-sm">
                    Add user
                </button>
            </div>
        </form>

    
    </div>
</div>
  <script src="https://cdn.tailwindcss.com"></script>
    <script>
        document.getElementById('image-input').addEventListener('change', function (event) {
            const file = event.target.files[0];
            const preview = document.getElementById('image-preview');
    
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    preview.src = e.target.result;
                };
                reader.readAsDataURL(file);
            } else {
                preview.src = '{{ asset('images/placeholder.jpg') }}';
            }
        });
    </script>
@endsection