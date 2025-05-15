@extends('Layout.app')

@section('content')
    <div class="min-h-screen bg-gray-100 flex items-center justify-center p-4">
        <div class="container mx-auto max-w-lg">
            <div class="bg-white shadow-lg rounded-2xl p-8 transition-all duration-300 hover:shadow-xl">
                <!-- Profile Image -->
             @if ($user->image)
    <div class="flex justify-center mb-6">
        <img 
            src="{{ Storage::url($user->image) }}" 
            alt="{{ $user->name }}"
            class="w-24 h-24 rounded-full object-cover border border-gray-300 shadow-sm"
        >
    </div>
@else
    <div class="flex justify-center mb-6">
        <div 
            class="w-24 h-24 rounded-full bg-gray-300 flex items-center justify-center text-white text-3xl font-bold border border-gray-300 shadow-sm"
        >
            {{ strtoupper(substr($user->name, 0, 1)) }}
        </div>
    </div>
@endif

                <!-- User Details -->
                <div class="space-y-4">
                    <p class="text-lg"><span class="font-semibold text-gray-700">Name:</span> {{ $user->name }}</p>
                    <p class="text-lg"><span class="font-semibold text-gray-700">Email:</span> {{ $user->email }}</p>
                    <p class="text-lg"><span class="font-semibold text-gray-700">Phone:</span> {{ $user->phone }}</p>
                    <p class="text-lg">
                        <span class="font-semibold text-gray-700">Status:</span>
                        <span class="{{ $user->gender ? 'text-green-600' : 'text-red-600' }}">
                            {{ $user->gender ? 'Man' : 'Femal' }}
                        </span>
                    </p>
                    <p class="text-lg"><span class="font-semibold text-gray-700">Date of Birth:</span> {{ $user->dob }}</p>
                    <p class="text-lg">
                        <span class="font-semibold text-gray-700">Status:</span>
                        <span class="{{ $user->status ? 'text-green-600' : 'text-red-600' }}">
                            {{ $user->status ? 'Active' : 'Inactive' }}
                        </span>
                    </p>
                </div>

                <!-- Back Button -->
                <div class="mt-8 text-center">
                    <a href="{{ route('admin.user.index') }}"
                       class="inline-block px-6 py-3 bg-indigo-600 text-white font-semibold rounded-full  hover:bg-indigo-700 transition-all duration-300">
                        Back to Users
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection