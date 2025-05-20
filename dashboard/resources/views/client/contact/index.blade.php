@extends('client.web')
@section('content')
<body class="bg-gray-100 font-sans">
    <div class="max-w-md mx-auto p-6">
        <h1 class="text-4xl font-bold text-gray-800 text-center uppercase">Contact Us</h1>
        <h2 class="text-2xl text-gray-700 text-center mt-4">Get In Touch</h2>
        <form class="mt-6 bg-white p-6 rounded shadow">
            <div class="mb-4">
                <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name <span class="text-red-500">*</span></label>
                <input type="text" id="name" name="name" required class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-gray-500" placeholder="Name">
            </div>
            <div class="mb-4">
                <label for="phone" class="block text-gray-700 text-sm font-bold mb-2">Phone <span class="text-red-500">*</span></label>
                <input type="tel" id="phone" name="phone" required class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-gray-500" placeholder="Phone">
            </div>
            <div class="mb-4">
                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email address <span class="text-red-500">*</span></label>
                <input type="email" id="email" name="email" required class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-gray-500" placeholder="Email address">
            </div>
            <div class="mb-6">
                <label for="message" class="block text-gray-700 text-sm font-bold mb-2">Your Message</label>
                <textarea id="message" name="message" class="w-full px-3 py-2 border border-gray-300 rounded h-32 focus:outline-none focus:ring-2 focus:ring-gray-500" placeholder="Your Message"></textarea>
            </div>
            <button type="submit" class="w-full bg-gray-800 text-white py-2 rounded hover:bg-gray-700 transition duration-200 uppercase">Submit</button>
        </form>
    </div>
</body>
    
@endsection