
<main class="pt-[90px] relative bg-white">
 
      <button id="closeModal" class="absolute top-4 right-4 text-red-600 hover:text-gray-800">
        <i class="fas fa-times"></i>
      </button>
  <section class="container mx-auto px-4">
    <div class="flex flex-wrap -mx-4">
      <!-- Left column -->
      <div class="w-full lg:w-7/12 px-4 h-[600px]">
        <div class="" data-media-type="vertical-thumbnail">
            <div class="float-left  p-[14px]">
              <div class="float-left space-y-3 ">
                @php
                    $images = json_decode($product->image, true);
                    $images = is_array($images) ? $images : [];
                @endphp
                @if ($images)
                        @foreach ($images as $img)
                            <img 
                                 class="">
                                 <img loading="lazy" class="h-auto w-[104px]" src="{{ asset('storage/' . $img) }}" 
                                 alt="{{ $product->name }}"  />
                        @endforeach

                @else
                    <img src="{{ asset('images/placeholder.jpg') }}" 
                         alt="No Image" 
                         class="w-full h-32 object-cover rounded-md border">
                @endif
               
              </div>
          </div>
                <!-- Slide -->
                <div class="float-left mt-[3px]">
                  @php
                     $images = json_decode($product->image, true);
                    $images = is_array($images) ? array_slice($images, 0, 1) : [];
                @endphp
                @if ($images)
                        @foreach ($images as $img)
                            <img 
                                 class="">
                                 <img loading="lazy"  class="h-auto"  width="400" height="400" src="{{ asset('storage/' . $img) }}" 
                                 alt="{{ $product->name }}"  />
                        @endforeach

                @else
                    <img src="{{ asset('images/placeholder.jpg') }}" 
                         alt="No Image" 
                         class="w-full h-32 object-cover rounded-md border">
                @endif
                  
                </div>
                <!-- Repeat for other slides -->
            
                
              <!-- Swiper buttons -->
              {{-- <div class="swiper-button-prev">
                <svg width="7" height="11" viewBox="0 0 7 11" xmlns="http://www.w3.org/2000/svg">
                  <use href="#icon_prev_sm" />
                </svg>
              </div> --}}
              {{-- <div class="swiper-button-next">
                <svg width="7" height="11" viewBox="0 0 7 11" xmlns="http://www.w3.org/2000/svg">
                  <use href="#icon_next_sm" />
                </svg>
              </div> --}}
            </div>
          </div>
          <!-- Thumbnails -->
      

      <!-- Right column -->
      <div class="w-full lg:w-5/12 px-4">
        <div class="flex justify-between mb-4 pb-4 md:pb-2">
          <div class="hidden md:flex space-x-2 uppercase  font-medium">
            <a href="#" class="text-blue-600 hover:underline">

              <span>{{ $brand->name ?? 'No Category Found'}}</span>
              </a>
          </div>
        </div>
        <h1 class="text-2xl font-semibold mb-2 text-gray-900">{{$product->name}}</h1>
        <div class="flex items-center mb-2">
          {{-- <div class="flex space-x-1">
            <svg class="w-4 h-4 text-yellow-400" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">
              <use href="#icon_star" />
            </svg>
            <!-- Repeat for 5 stars -->
            <svg class="w-4 h-4 text-yellow-400" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg"><use href="#icon_star" /></svg>
            <svg class="w-4 h-4 text-yellow-400" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg"><use href="#icon_star" /></svg>
            <svg class="w-4 h-4 text-yellow-400" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg"><use href="#icon_star" /></svg>
            <svg class="w-4 h-4 text-yellow-400" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg"><use href="#icon_star" /></svg>
          </div> --}}
          <span class="text-sm text-gray-500 ml-2 lowercase">8k+ reviews</span>
        </div>
        <div class="text-xl font-bold text-red-600 mb-4  line-through"> ${{ number_format($product->price, 2) }}</div>
        <div class="text-xl font-bold text-red-600 mb-4"> %{{ number_format($product->discount, 2) }}</div>
        <div class="text-xl font-bold text-red-600 mb-4"> ${{ number_format($product->price_after_discount, 2) }}</div>
        
        <div class="text-gray-700 mb-4">
          <p>{{ $product->description ?? 'N/A' }}</p>
        </div>

        <div class="space-y-2 text-sm text-gray-700">
          <div class="flex items-center space-x-2">
            <span class="font-semibold">Categorys:</span>
            <span> {{ $category->name ?? 'No Category Found' }}</span>

          </div>
          <div class="flex items-center space-x-2">
            <span class="font-semibold">name link:</span>
            <span> {{ $product->name_link ?? 'No Category Found' }}</span>
          </div>
        </div>
      </div>
    </div>
  </section>
  <footer>
    <div class="container mx-auto px-4 py-4">
      <div class="flex justify-between items-center">
        <div class="text-gray-600 text-sm">
          &copy; {{ date('Y') }} Your Company. All rights reserved.
        </div>
        <div class="flex space-x-4">
          <a href="#" class="text-gray-600 hover:text-gray-800">Privacy Policy</a>
          <a href="#" class="text-gray-600 hover:text-gray-800">Terms of Service</a>
        </div>
      </div>
    </div>
</footer>
</main>

<script>
     // Close Modal
   $(document).on('click', '#closeModal, #cancelModal', function () {
    console.log('Close or cancel button clicked'); // DEBUG
    $('#modalOverlay').addClass('hidden');
    $('#modalContent').empty();
    });
</script>
    