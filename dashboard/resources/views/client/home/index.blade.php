@extends('client.web')
@section('content')

    <section class="hot-deals container">
        <h2 class="section-title text-center mb-3 pb-xl-3 mb-xl-4">Hot Deals</h2>
        <div class="row">
            <div
                class="col-md-6 col-lg-4 col-xl-20per d-flex align-items-center flex-column justify-content-center py-4 align-items-md-start">
                <h2>Summer Sale</h2>
                <h2 class="fw-bold">Up to 60% Off
         
                </h2>
                <div class="position-relative d-flex align-items-center text-center pt-xxl-4 js-countdown mb-3"
                    data-date="18-3-2024" data-time="06:50">
                    <div class="day countdown-unit">
                        <span class="countdown-num d-block"></span>
                        <span class="countdown-word text-uppercase text-secondary">Days</span>
                    </div>
                    <div class="hour countdown-unit">
                        <span class="countdown-num d-block"></span>
                        <span class="countdown-word text-uppercase text-secondary">Hours</span>
                    </div>
                    <div class="min countdown-unit">
                        <span class="countdown-num d-block"></span>
                        <span class="countdown-word text-uppercase text-secondary">Mins</span>
                    </div>
                    <div class="sec countdown-unit">
                        <span class="countdown-num d-block"></span>
                        <span class="countdown-word text-uppercase text-secondary">Sec</span>
                    </div>
                       
                </div>
                <a href="#" class="btn-link default-underline text-uppercase fw-medium mt-3">View All</a>
            </div>
            <div class="col-md-6 col-lg-8 col-xl-80per">
                <div class="position-relative">
                    <div class="swiper-container js-swiper-slider" data-settings='{
                        "autoplay": {
                            "delay": 5000
                        },
                        "slidesPerView": 4,
                        "slidesPerGroup": 4,
                        "effect": "none",
                        "loop": false,
                        "breakpoints": {
                            "320": {
                                "slidesPerView": 2,
                                "slidesPerGroup": 2,
                                "spaceBetween": 14
                            },
                            "768": {
                                "slidesPerView": 2,
                                "slidesPerGroup": 3,
                                "spaceBetween": 24
                            },
                            "992": {
                                "slidesPerView": 3,
                                "slidesPerGroup": 1,
                                "spaceBetween": 30,
                                "pagination": false
                            },
                            "1200": {
                                "slidesPerView": 4,
                                "slidesPerGroup": 1,
                                "spaceBetween": 30,
                                "pagination": false
                            }
                        }
                    }'>
                        <div class="swiper-wrapper1">
                            @foreach ($slides as $slide)
                                <div class="swiper-slide product-card product-card_style3">
                                    <div class="pc__img-wrapper">
                                        <a href="details.html">
                                            <img loading="lazy" src="{{ Storage::url($slide->image) }}" width="258"
                                                height="313" alt="{{ $slide->title ?? 'Product' }}" class="pc__img">
                                            <img loading="lazy"
                                                src="{{ Storage::url($slide->image) }}"
                                                width="258" height="313" alt="{{ $slide->name ?? 'Product' }}"
                                                class="pc__img pc__img-second">
                                        </a>
                                    </div>
                                    
                                </div>
                            @endforeach
                        </div>
                        <!-- /.swiper-wrapper -->
                    </div><!-- /.swiper-container js-swiper-slider -->
                </div><!-- /.position-relative -->
            </div>
        <div class="swiper-container py-5 px-4">
       <div class="swiper-wrapper">
            @foreach ($products as $product)
      <div class="swiper-slide flex flex-col items-center justify-center">
         @php
        $images = json_decode($product->image, true);
        $images = is_array($images) ? array_slice($images, 0, 1) : [];
        @endphp
        @foreach ($images as $img)
        <img loading="lazy" class="w-full h-auto mb-3 max-w-[124px] max-h-[124px] object-cover" src="{{ asset('storage/' . $img) }}" width="124" height="124" alt="Women Tops" />
        <div class="text-center">
          <a href="#" class="text-gray-700 font-medium text-base hover:text-blue-500">{{ $product->name }}<br /></a>
        </div>
        @endforeach

      </div>
        @endforeach

    </div>
    <!-- Pagination and Navigation -->
    <div class="swiper-pagination mt-4"></div>
    <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>
  </div>
        </div>
    </section>


    <section class="mx-auto px-4 py-8">
        <h2 class="text-3xl font-bold text-gray-800 text-center mb-6 lg:mb-8">Featured Products</h2>
       @include('client.components.main')
       
    </section>
 <!-- Modal Container -->
    <div id="modalOverlay" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div id="modalContent" class=" m-auto   w-[70%] p-6 overflow-y-auto max-h-[90vh] relative">
            <!-- Loading Indicator -->
            <div id="modalLoading" class="flex flex-col items-center">
                <i class="fas fa-spinner fa-spin text-blue-600 text-3xl"></i>
                <span class="mt-2 text-gray-600">Loading...</span>
            </div>
            <!-- Modal content will be loaded here -->
        </div>
    </div>
@endsection

  <!-- Include Swiper JS -->
  <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
  <!-- Initialize Swiper -->
  <!-- Include jQuery and Swiper JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Initialize Swiper
    const swiper = new Swiper('.swiper-container', {
        slidesPerView: 4,
        spaceBetween: 20,
        loop: true,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        breakpoints: {
            320: {
                slidesPerView: 1,
                spaceBetween: 10,
            },
            640: {
                slidesPerView: 2,
                spaceBetween: 15,
            },
            768: {
                slidesPerView: 3,
                spaceBetween: 20,
            },
            1024: {
                slidesPerView: 4,
                spaceBetween: 20,
            },
        },
    });

    // Open Edit Product Modal
    $(document).on('click', '.show-product-btn', function () {
        const productId = $(this).data('product-id');
        const $modalOverlay = $('#modalOverlay');
        const $modalLoading = $('#modalLoading');
        const $modalContent = $('#modalContent');
        const $errorArea = $('#errorArea');

        // Show overlay and loading spinner
        $modalOverlay.removeClass('hidden');
        $modalLoading.removeClass('hidden');
        $errorArea.addClass('hidden'); // Hide any previous errors

        // Generate the URL for the product show route
        const url = '{{ route("admin.products.show", ":id") }}'.replace(':id', productId);

        // Load product details into modal content
        $modalContent.load(url, function (response, status, xhr) {
      if (status === 'error') {
            console.error('Error loading show view:', xhr.status);
            $('#modalOverlay').addClass('hidden');
            $('#modalLoading').addClass('hidden');
            $('#errorArea').removeClass('hidden').text('Failed to load product details. Please try again.');
        } else {
            $('#modalLoading').addClass('hidden');
            // Optional: Run any post-load initialization here
        }
        });
    });

    // Close modal when clicking the close button
    $(document).on('click', '#closeModal', function () {
        $('#modalOverlay').addClass('hidden');
        $('#modalContent').empty(); // Clear content for next use
    });

    // Close modal when clicking outside the modal content
    $(document).on('click', '#modalOverlay', function (e) {
        if (e.target.id === 'modalOverlay') {
            $('#modalOverlay').addClass('hidden');
            $('#modalContent').empty();
        }
    });
});
</script>