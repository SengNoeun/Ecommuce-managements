@extends('client.web')
@section('content')
    <!-- Header -->
    

    <!-- Cart Page -->
    <div class="container mx-auto px-4 py-8 min-h-screen ">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">CART</h1>

        <!-- Progress Steps -->
        <div class="flex justify-between items-center mb-8">
            <div class="flex-1 text-center">
                <p class="text-sm font-medium text-gray-800">01 SHOPPING BAG</p>
                <p class="text-xs text-gray-500">Manage Your Items List</p>
                <div class="h-1 bg-gray-300 mt-2"></div>
            </div>
            <div class="flex-1 text-center">
                <p class="text-sm font-medium text-gray-400">02 SHIPPING AND CHECKOUT</p>
                <p class="text-xs text-gray-400">Checkout Your Items List</p>
                <div class="h-1 bg-gray-300 mt-2"></div>
            </div>
            <div class="flex-1 text-center">
                <p class="text-sm font-medium text-gray-400">03 CONFIRMATION</p>
                <p class="text-xs text-gray-400">Review And Submit Your Order</p>
                <div class="h-1 bg-gray-300 mt-2"></div>
            </div>
        </div>

        <!-- Cart Content -->
        <div class="flex flex-col lg:flex-row gap-6">
            <!-- Cart Items -->
            <div class="flex-1">
                <!-- Header -->
                <div class="grid grid-cols-4 gap-4 mb-4 text-sm font-medium text-gray-600 border-b pb-2">
                    <div class="col-span-2">PRODUCT</div>
                    <div>PRICE</div>
                    <div>QUANTITY</div>
                    <div>SUBTOTAL</div>
                </div>

                <!-- Cart Items -->
           @foreach ($cartItems as $item)
    <div class="grid grid-cols-4 gap-4 items-center py-4 border-b">
        <!-- Product -->
        <div class="col-span-2 flex items-center space-x-4">
            @php
                \Illuminate\Support\Facades\Log::info('Cart Item Image Path: ' . $item['image']);
            @endphp
            @if (!empty($item['image']))
                <div class="flex justify-center">
                    <button class="text-gray-500 hover:text-red-500" onclick="removeItem({{ $item['id'] }})">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
               </button>
                    <img src="{{ asset('storage/' . $item['image']) }}" 
                         alt="{{ $item['name'] }}" 
                         class="w-16 h-16 object-cover rounded-md border"
                         onerror="this.onerror=null; this.src='https://via.placeholder.com/150';">
                </div>
            @else
                <div class="flex justify-center">
                    <img src="https://via.placeholder.com/150" 
                         class="w-16 h-16 object-cover rounded-md border" 
                         alt="No Image">
                </div>
            @endif
            <div>
                <p class="text-sm font-medium text-gray-800">{{ $item['name'] }}</p>
                {{-- <p class="text-xs text-gray-500">Color: {{ $item['color'] }}</p> --}}
                {{-- <p class="text-xs text-gray-500">Size: {{ $item['size'] }}</p> --}}
            </div>
        </div>
        <!-- Price -->
        <div class="text-sm text-gray-800">${{ $item['price'] }}</div>
        <!-- Quantity -->
        <div class="flex items-center space-x-2">
            <button class="w-8 h-8 flex items-center justify-center border rounded hover:bg-gray-100" onclick="updateQuantity({{ $item['id'] }}, 'decrement')">-</button>
            <span class="w-8 text-center">{{ $item['quantity'] }}</span>
            <button class="w-8 h-8 flex items-center justify-center border rounded hover:bg-gray-100" onclick="updateQuantity({{ $item['id'] }}, 'increment')">+</button>
        </div>
        <!-- Subtotal -->
        <div class="flex items-center justify-between">
            <span class="text-sm text-gray-800">${{ $item['subtotal'] }}</span>
            
        </div>
    </div>
@endforeach
            </div>

            <!-- Cart Totals -->
            <div class="lg:w-1/3 bg-gray-50 p-6 rounded-lg shadow-md">
                <h2 class="text-lg font-bold text-gray-800 mb-4">CART TOTALS</h2>
                <div class="space-y-4">
                    <!-- Subtotal -->
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">SUBTOTAL</span>
                        <span class="text-gray-800 font-medium">${{ $cartTotals['subtotal'] }}</span>
                    </div>
                    <!-- Shipping -->
                    <div class="border-t pt-4">
                        <p class="text-sm text-gray-600 mb-2">SHIPPING</p>
                        {{-- <div class="space-y-2">
                            <label class="flex items-center text-sm">
                                <input type="radio" name="shipping" value="free" class="mr-2 text-blue-600 focus:ring-blue-500">
                                Free shipping
                            </label>
                            <label class="flex items-center text-sm">
                                <input type="radio" name="shipping" value="flat" class="mr-2 text-blue-600 focus:ring-blue-500">
                                Flat rate: $49
                            </label>
                            <label class="flex items-center text-sm">
                                <input type="radio" name="shipping" value="local" class="mr-2 text-blue-600 focus:ring-blue-500">
                                Local pickup: $8
                            </label>
                        </div> --}}
                        <p class="text-xs text-gray-500 mt-2">Shipping to AL.</p>
                        <a href="#" class="text-xs text-blue-600 hover:underline">CHANGE ADDRESS</a>
                    </div>
                    <!-- VAT -->
                    <div class="flex justify-between text-sm border-t pt-4">
                        <span class="text-gray-600">VAT</span>
                        <span class="text-gray-800 font-medium">${{ $cartTotals['vat'] }}</span>
                    </div>
                    <!-- Total -->
                    <div class="flex justify-between text-sm font-bold border-t pt-4">
                        <span class="text-gray-800">TOTAL</span>
                        <span class="text-gray-800">${{ $cartTotals['total'] }}</span>
                    </div>
                </div>
                <!-- Proceed to Checkout -->
                <button class="w-full bg-black text-white py-3 mt-6 rounded hover:bg-gray-800 transition">PROCEED TO CHECKOUT</button>
            </div>
        </div>
    </div>
@endsection

<!-- JavaScript for Cart Interactions -->
<script>
    function updateQuantity(itemId, action) {
        fetch(`/cart/update/${itemId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ action: action })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            }
        })
        .catch(error => console.error('Error updating quantity:', error));
    }

    function removeItem(itemId) {
        fetch(`/cart/remove/${itemId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            }
        })
        .catch(error => console.error('Error removing item:', error));
    }
</script>