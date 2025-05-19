@extends('client.web')
@section('content')
    <div class="container mx-auto p-4 min-h-screen">
        <div class="flex flex-col md:flex-row gap-4">
            <!-- Sidebar -->
            <div class="w-full md:w-1/4 sticky top-0 p-4 h-screen overflow-y-auto bg-white rounded-lg shadow-md">
                <div class="mb-6">
                    <h3 class="text-lg font-bold mb-2 text-gray-800">PRODUCT CATEGORIES</h3>
                    @foreach ($categorys as $category)
                        <ul class="space-y-1">
                            <li>
                                <a href="#" class="flex items-center p-2 bg-gray-100 rounded hover:bg-blue-50 hover:text-blue-600 transition">
                                    {{ $category->name }}
                                </a>
                            </li>
                        </ul>
                    @endforeach
                </div>
                <div class="mb-6">
                    <h3 class="text-lg font-bold mb-2 text-gray-800">COLOR</h3>
                    <div class="flex flex-wrap gap-2">
                        <div class="w-6 h-6 bg-blue-500 rounded-full cursor-pointer hover:ring-2 hover:ring-blue-300"></div>
                        <div class="w-6 h-6 bg-yellow-500 rounded-full cursor-pointer hover:ring-2 hover:ring-yellow-300"></div>
                        <div class="w-6 h-6 bg-black rounded-full cursor-pointer hover:ring-2 hover:ring-gray-300"></div>
                        <div class="w-6 h-6 bg-gray-500 rounded-full cursor-pointer hover:ring-2 hover:ring-gray-300"></div>
                        <div class="w-6 h-6 bg-orange-500 rounded-full cursor-pointer hover:ring-2 hover:ring-orange-300"></div>
                        <div class="w-6 h-6 bg-pink-500 rounded-full cursor-pointer hover:ring-2 hover:ring-pink-300"></div>
                        <div class="w-6 h-6 bg-green-500 rounded-full cursor-pointer hover:ring-2 hover:ring-green-300"></div>
                        <div class="w-6 h-6 bg-white rounded-full border border-gray-300 cursor-pointer hover:ring-2 hover:ring-gray-300"></div>
                    </div>
                </div>
                <div class="mb-6">
                    <h3 class="text-lg font-bold mb-2 text-gray-800">SIZES</h3>
                    <div class="flex flex-wrap gap-2 mb-4">
                        <span class="px-3 py-1 bg-gray-100 rounded-full text-sm hover:bg-blue-50 hover:text-blue-600 cursor-pointer variant-option" data-variant="15ml" data-price="25.00">15ml</span>
                        <span class="px-3 py-1 bg-gray-100 rounded-full text-sm hover:bg-blue-50 hover:text-blue-600 cursor-pointer variant-option" data-variant="30ml" data-price="40.00">30ml</span>
                        <span class="px-3 py-1 bg-gray-100 rounded-full text-sm hover:bg-blue-50 hover:text-blue-600 cursor-pointer variant-option" data-variant="50ml" data-price="60.00">50ml</span>
                        <span class="px-3 py-1 bg-gray-100 rounded-full text-sm hover:bg-blue-50 hover:text-blue-600 cursor-pointer variant-option" data-variant="50ml" data-price="60.00">60ml</span>
                        <span class="px-3 py-1 bg-gray-100 rounded-full text-sm hover:bg-blue-50 hover:text-blue-600 cursor-pointer variant-option" data-variant="50ml" data-price="60.00">70ml</span>
                    </div>
                </div>
                <div class="mb-6">
                    <h3 class="text-lg font-bold mb-2 text-gray-800">BRANDS</h3>
                    <input type="text" class="w-full p-2 border border-gray-300 rounded mb-3 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Search brands">
                    <ul class="space-y-2">
                        @foreach ($brands as $brand)
                            <li class="flex items-center">
                                <input type="checkbox" class="mr-2 h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                <span>{{ $brand->name }}</span>
                                <span class="ml-2 text-gray-500 text-sm">({{ $brand->id }})</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="mb-6">
                    <h3 class="text-lg font-bold mb-2 text-gray-800">PRICE</h3>
                    <input type="range" class="w-full h-2 bg-gray-600 rounded-lg appearance-none cursor-pointer accent-blue-600">
                </div>
            </div>
            <!-- Main Content -->
            <section class="w-full md:w-3/4 px-4 py-8">
                <div class="bg-gray-100 p-6 mb-6 flex flex-col md:flex-row items-center justify-between rounded-lg shadow-md">
                    <div class="mb-4 md:mb-0 md:w-1/2">
                        <h2 class="text-3xl font-bold text-gray-800">WOMEN'S ACCESSORIES</h2>
                        <p class="text-gray-600 mt-2">Accessories are the best way to update your look. Add a little edge with new styles and new colors, or go for timeless pieces.</p>
                    </div>
                    <img src="https://cdn3.pixelcut.app/7/10/ai_background_3_8ee15bb831_7936b7c985.jpg" alt="Woman with accessories" class="w-full md:w-1/2 rounded-lg object-cover">
                </div>
                @include('client.components.main')
            </section>
        </div>
        <!-- Modal Container -->
        <div id="modalOverlay" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50 hidden">
            <div id="modalContent" class=" m-auto w-[90%] md:w-[70%] p-6 rounded-lg shadow-xl overflow-y-auto max-h-[90vh] relative">
                <!-- Loading Indicator -->
                <div id="modalLoading" class="flex flex-col items-center">
                    <i class="fas fa-spinner fa-spin text-blue-600 text-3xl"></i>
                    <span class="mt-2 text-gray-600">Loading...</span>
                </div>
                <!-- Modal content will be loaded here -->
            </div>
        </div>
    </div>
@endsection

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
            320: { slidesPerView: 1, spaceBetween: 10 },
            640: { slidesPerView: 2, spaceBetween: 15 },
            768: { slidesPerView: 3, spaceBetween: 20 },
            1024: { slidesPerView: 4, spaceBetween: 20 },
        },
    });

    // Open Product Modal
    $(document).on('click', '.show-product-btn', function () {
        const productId = $(this).data('product-id');
        const $modalOverlay = $('#modalOverlay');
        const $modalLoading = $('#modalLoading');
        const $modalContent = $('#modalContent');
        const $errorArea = $('#errorArea');

        // Show overlay and loading spinner
        $modalOverlay.removeClass('hidden');
        $modalLoading.removeClass('hidden');
        $errorArea.addClass('hidden');

        // Generate the URL for the product show route
        const url = '{{ route("admin.products.show", ":id") }}'.replace(':id', productId);

        // Load product details into modal content
        $modalContent.load(url, function (response, status, xhr) {
            if (status === 'error') {
                console.error('Error loading show view:', xhr.status);
                $modalOverlay.addClass('hidden');
                $modalLoading.addClass('hidden');
                $errorArea.removeClass('hidden').text('Failed to load product details. Please try again.');
            } else {
                $modalLoading.addClass('hidden');
            }
        });
    });

    // Close modal when clicking the close button
    $(document).on('click', '#closeModal', function () {
        $('#modalOverlay').addClass('hidden');
        $('#modalContent').empty();
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