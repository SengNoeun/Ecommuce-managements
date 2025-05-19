<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
    @foreach ($products as $product)
        <div class="mb-4 md:mb-5 lg:mb-6">
            <div class="relative hover:scale-90 transition">
                @php
                    $images = json_decode($product->image, true);
                    $images = is_array($images) ? array_slice($images, 0, 1) : [];
                @endphp
                <button type="button" class="show-product-btn" data-product-id="{{ $product->id }}">
                    @foreach ($images as $img)
                        <img loading="lazy"
                             src="{{ asset('storage/' . $img) }}"
                             width="150" height="150" alt="{{ $product->name }}"
                             class="w-full h-auto object-cover">
                    @endforeach
                </button>
            </div>
            <div class="relative text-center pt-4">
                <div class="mt-2">
                    <p class="text-gray-500 float-start">{{ $product->name }}</p><br>
                    <div class="flex items-center  float-start">
                        <span class="text-yellow-500">★★★★★</span>
                        <span class="text-gray-500">8k reviews</span>
                    </div><br>
                    <p class="text-lg font-bold float-start">${{ $product->price_after_discount }}</p>
                    <form action="{{ route('cart.add', $product->id) }}" method="POST" class="w-full">
                        @csrf
                        <input type="hidden" name="quantity" value="1">
                        <button type="submit" class="w-full bg-black text-white py-2 mt-2 rounded hover:bg-gray-800 transition">
                            ADD TO CART
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
</div>