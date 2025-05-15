@extends('Layout.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Product Details</h1>

    <div class="bg-white shadow-md rounded-lg p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h2 class="text-lg font-medium text-gray-700 mb-4">Images</h2>
                @php
                    $images = json_decode($product->image, true);
                    $images = is_array($images) ? $images : [];
                @endphp
                @if ($images)
                    <div class="grid grid-cols-2 gap-4">
                        @foreach ($images as $img)
                            <img src="{{ asset('storage/' . $img) }}" 
                                 alt="{{ $product->name }}" 
                                 class="w-full h-32 object-cover rounded-md border">
                        @endforeach
                    </div>
                @else
                    <img src="{{ asset('images/placeholder.jpg') }}" 
                         alt="No Image" 
                         class="w-full h-32 object-cover rounded-md border">
                @endif
            </div>

            <div>
                <h2 class="text-lg font-medium text-gray-700 mb-4">Details</h2>
                <div class="space-y-4">
                    <p><strong>ID:</strong> {{ $product->id }}</p>
                    <p><strong>Name:</strong> {{ $product->name }}</p>
                    <p><strong>Price:</strong> ${{ number_format($product->price, 2) }}</p>
                    <p><strong>Discount:</strong> {{ $product->discount ? $product->discount . '%' : 'N/A' }}</p>
                    <p><strong>Price After Discount:</strong> ${{ number_format($product->price_after_discount, 2) }}</p>
                    <p><strong>Description:</strong> {{ $product->description ?? 'N/A' }}</p>
                    <p><strong>Brand:</strong> {{ $product->brand_name ?? 'N/A' }}</p>
                    <p><strong>Category:</strong> {{ $product->category_name ?? 'N/A' }}</p>
                    <p><strong>Slide:</strong> {{ $product->slide_name ?? 'N/A' }}</p>
                    <p><strong>Od:</strong> {{ $product->od ?? 'N/A' }}</p>
                    <p><strong>Name Link:</strong> {{ $product->name_link }}</p>
                    <p><strong>Status:</strong> 
                        <span class="px-2 py-1 rounded-full text-xs font-semibold 
                                    {{ $product->status == 1 ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                            {{ $product->status == 1 ? 'Active' : 'Inactive' }}
                        </span>
                    </p>
                </div>
            </div>
        </div>

        {{-- <div class="mt-6 flex space-x-4">
            <a href="{{ route('admin.products.edit', $product->id) }}" 
               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">
                <i class="fas fa-edit"></i> Edit
            </a>
            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md">
                    <i class="fas fa-trash-alt"></i> Delete
                </button>
            </form>
            <a href="{{ route('admin.products.index') }}" 
               class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-md">
                <i class="fas fa-arrow-left"></i> Back to List
            </a>
        </div> --}}
    </div>

    @if ($relatedProducts->isNotEmpty())
        <section class="products-carousel container mx-auto px-4 mt-8">
            <h2 class="h3 text-uppercase mb-4 pb-xl-2 mb-xl-4">Related <strong>Products</strong></h2>

            <div id="related_products" class="position-relative">
                <div class="swiper-container js-swiper-slider" data-settings='{
                    "autoplay": false,
                    "slidesPerView": 4,
                    "slidesPerGroup": 4,
                    "effect": "none",
                    "loop": true,
                    "pagination": {
                        "el": "#related_products .products-pagination",
                        "type": "bullets",
                        "clickable": true
                    },
                    "navigation": {
                        "nextEl": "#related_products .products-carousel__next",
                        "prevEl": "#related_products .products-carousel__prev"
                    },
                    "breakpoints": {
                        "320": {
                            "slidesPerView": 2,
                            "slidesPerGroup": 2,
                            "spaceBetween": 14
                        },
                        "768": {
                            "slidesPerView": 3,
                            "slidesPerGroup": 3,
                            "spaceBetween": 24
                        },
                        "992": {
                            "slidesPerView": 4,
                            "slidesPerGroup": 4,
                            "spaceBetween": 30
                        }
                    }
                }'>
                    <div class="swiper-wrapper">
                        @foreach ($relatedProducts as $related)
                            <div class="swiper-slide product-card">
                                <div class="pc__img-wrapper">
                                    <a href="{{ route('admin.products.show', $related->id) }}">
                                        @php
                                            $relatedImages = json_decode($related->image, true);
                                            $primaryImage = is_array($relatedImages) && !empty($relatedImages) ? $relatedImages[0] : 'placeholder.jpg';
                                            $secondaryImage = is_array($relatedImages) && count($relatedImages) > 1 ? $relatedImages[1] : $primaryImage;
                                        @endphp
                                        <img loading="lazy" src="{{ asset('storage/' . $primaryImage) }}" 
                                             width="330" height="400" 
                                             alt="{{ $related->name }}" 
                                             class="pc__img">
                                        <img loading="lazy" src="{{ asset('storage/' . $secondaryImage) }}" 
                                             width="330" height="400" 
                                             alt="{{ $related->name }}" 
                                             class="pc__img pc__img-second">
                                    </a>
                                    <button class="pc__atc btn anim_appear-bottom btn position-absolute border-0 text-uppercase fw-medium js-add-cart js-open-aside" 
                                            data-aside="cartDrawer" 
                                            title="Add To Cart">
                                        Add To Cart
                                    </button>
                                </div>

                                <div class="pc__info position-relative">
                                    <p class="pc__category">{{ $related->category_name ?? 'N/A' }}</p>
                                    <h6 class="pc__title">
                                        <a href="{{ route('admin.products.show', $related->id) }}">{{ $related->name }}</a>
                                    </h6>
                                    <div class="product-card__price d-flex">
                                        @if ($related->discount)
                                            <span class="money price price-old">${{ number_format($related->price, 2) }}</span>
                                            <span class="money price price-sale">${{ number_format($related->price_after_discount, 2) }}</span>
                                        @else
                                            <span class="money price">${{ number_format($related->price, 2) }}</span>
                                        @endif
                                    </div>

                                    <button class="pc__btn-wl position-absolute top-0 end-0 bg-transparent border-0 js-add-wishlist" 
                                            title="Add To Wishlist">
                                        <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <use href="#icon_heart" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div><!-- /.swiper-wrapper -->
                </div><!-- /.swiper-container js-swiper-slider -->

                <div class="products-carousel__prev position-absolute top-50 d-flex align-items-center justify-content-center">
                    <svg width="25" height="25" viewBox="0 0 25 25" xmlns="http://www.w3.org/2000/svg">
                        <use href="#icon_prev_md" />
                    </svg>
                </div><!-- /.products-carousel__prev -->
                <div class="products-carousel__next position-absolute top-50 d-flex align-items-center justify-content-center">
                    <svg width="25" height="25" viewBox="0 0 25 25" xmlns="http://www.w3.org/2000/svg">
                        <use href="#icon_next_md" />
                    </svg>
                </div><!-- /.products-carousel__next -->

                <div class="products-pagination mt-4 mb-5 d-flex align-items-center justify-content-center"></div>
                <!-- /.products-pagination -->
            </div><!-- /.position-relative -->
        </section><!-- /.products-carousel container -->
    @endif
</div>
@endsection