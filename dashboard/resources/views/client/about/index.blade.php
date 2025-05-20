@extends('client.web')
@section('content')
<body class="bg-gray-100 font-sans">
  <div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <h1 class="text-3xl font-bold text-center mb-6">ABOUT US</h1>

    <!-- Main Image -->
    <div class="mb-8">
      <img src="https://via.placeholder.com/1200x400" alt="Clothing Store" class="w-full h-64 object-cover rounded-lg">
    </div>

    <!-- Our Story Section -->
    <div class="mb-8">
      <h2 class="text-2xl font-semibold mb-4">OUR STORY</h2>
      <p class="text-gray-700 leading-relaxed">
        Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
      </p>
      <p class="text-gray-700 leading-relaxed mt-2">
        Saw wherein fruitful good days image them, midst, waters upon, sea. Fourth hath rule Evening creature hath seen air yielding behold yielding. Fifth great- for grass evening fourth you’re unto that. Had replenish for him light shall yielding all forth all yielding bless you’ll form, gathered, you yielding greater without yielding earth moved night.
      </p>
    </div>

    <!-- Mission and Vision Section -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
      <div>
        <h3 class="text-xl font-semibold mb-2">Our Mission</h3>
        <p class="text-gray-700">
          Quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
        </p>
      </div>
      <div>
        <h3 class="text-xl font-semibold mb-2">Our Vision</h3>
        <p class="text-gray-700">
          Quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
        </p>
      </div>
    </div>

    <!-- Company Section -->
    <div class="flex flex-col md:flex-row items-center mb-8">
      <div class="w-full md:w-1/2 mb-4 md:mb-0">
        <img src="https://via.placeholder.com/600x400" alt="Company Image" class="w-full h-48 object-cover rounded-lg">
      </div>
      <div class="w-full md:w-1/2 md:pl-6">
        <h3 class="text-xl font-semibold mb-2">The Company</h3>
        <p class="text-gray-700">
          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean sapien massa, elementum eu mattis ut, pellentesque in leo. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium.
        </p>
      </div>
    </div>
  </div>
</body>
    
@endsection