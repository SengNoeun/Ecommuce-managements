  <script src="https://cdn.tailwindcss.com"></script>

<body class="bg-gray-100 font-sans flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Login to E-Shop</h2>
        <form action="{{ route('admin.user.login') }}" method="POST" class="space-y-4">
            <div class="mb-4">
                <label for="username" class="block text-gray-600 mb-2">Username or Email</label>
                <input type="text" id="username" name="username" class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <div class="mb-4">
                <label for="password" class="block text-gray-600 mb-2">Password</label>
                <input type="password" id="password" name="password" class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <div id="errorMessage" class="text-red-500 text-sm mb-4 hidden"></div>
            <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded-lg hover:bg-blue-600">Log In</button>
        </form>
        <p class="text-gray-600 text-sm mt-4 text-center">Forgot password? <a href="#" class="text-blue-500 hover:underline">Reset here</a></p>
</div>

   