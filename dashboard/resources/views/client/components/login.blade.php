 <div class="min-h-screen bg-gray-100 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8 bg-white p-6 rounded-lg shadow-md">
            <div>
                <h2 class="text-center text-2xl font-extrabold text-gray-900 border-b-2 border-gray-300 pb-2">LOGIN</h2>
            </div>
            <form method="POST" action="{{route('client.login.index')}}" class="mt-8 space-y-6">
                @csrf

                <!-- Success/Error Messages -->
                @if (session('success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                @if ($errors->has('user'))
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4" role="alert">
                        {{ $errors->first('user') }}
                    </div>
                @endif

                <!-- Email -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Name <span class="text-red-500">*</span></label>
                    <input type="name" name="name" id="name" autocomplete="name" required
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-2">
                    @error('name')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email <span class="text-red-500">*</span></label>
                    <input type="email" name="email" id="email" autocomplete="current-email" required
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-2">
                    @error('email')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Log In Button -->
                <div>
                    <button type="submit"
                            class="w-full bg-black text-white py-3 rounded-md hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        LOG IN
                    </button>
                </div>

                <!-- Links -->
                <div class="text-center text-sm">
                    <a href="{{route('client.register.index')}}" class="text-indigo-600 hover:text-indigo-500">
                        No account yet? Create Account
                    </a> <a href="{{route('client.logout.index')}}" class="text-red-500 hover:text-red-600">
                       {{session()->get('NAME')}} Signout
                    </a>
                    <span class="mx-2">|</span>
                    <a href="#" class="text-indigo-600 hover:text-indigo-500">
                        My Account
                    </a>
                </div>
            </form>
        </div>
    </div>