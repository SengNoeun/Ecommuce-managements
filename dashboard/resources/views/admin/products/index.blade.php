@extends('Layout.app')

@section('content')
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<div class="container mx-auto p-6">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-3xl font-semibold text-gray-800">Product</h1>
        <button type="button" id="btn-add" 
                class="btn-add bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium flex items-center gap-2"
                aria-label="Add new product">
            <i class="fas fa-plus"></i> Add Product
        </button>
    </div>

    @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 rounded-md" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <!-- Success/Error Area -->
   

    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="min-w-full table-auto">
            <thead class=" bg-indigo-600 sticky top-0 z-10">
    <tr>
        <th scope="col" class="py-3 px-4 md:px-6 text-left text-sm font-medium text-white truncate">ID</th>
        <th class="py-3 px-4 md:px-6 text-left text-sm font-medium text-white truncate">Name</th>
        <th class="py-3 px-4 md:px-6 text-left text-sm font-medium text-white truncate">Price</th>
        <th class="py-3 px-4 md:px-6 text-left text-sm font-medium text-white truncate">Discount</th>
        <th class="py-3 px-4 md:px-6 text-left text-sm font-medium text-white truncate">Price After Discount</th>
        <th class="py-3 px-4 md:px-6 text-left text-sm font-medium text-white truncate">Description</th>
        <th class="py-3 px-4 md:px-6 text-left text-sm font-medium text-white truncate">Brand</th>
        <th class="py-3 px-4 md:px-6 text-left text-sm font-medium text-white truncate">Category</th>
        <th class="py-3 px-4 md:px-6 text-left text-sm font-medium text-white truncate">Slide</th>
        <th class="py-3 px-4 md:px-6 text-left text-sm font-medium text-white truncate">Od</th>
        <th class="py-3 px-4 md:px-6 text-left text-sm font-medium text-white truncate">Name Link</th>
        <th class="py-3 px-4 md:px-6 text-left text-sm font-medium text-white truncate">Image</th>
        <th class="py-3 px-4 md:px-6 text-left text-sm font-medium text-white truncate">Status</th>
        <th class="py-3 px-4 md:px-6 text-left text-sm font-medium text-white truncate">Actions</th>
    </tr>
</thead>
           <tbody id="productTable" class="divide-y divide-gray-200">
            @foreach ($products as $product)
            <tr class="hover:bg-gray-50">
            <td class="py-3 px-4 md:px-6 text-center text-sm text-gray-800">{{ $product->id }}</td>
            <td class="py-3 px-4 md:px-6 text-center text-sm text-gray-800">{{ $product->name }}</td>
            <td class="py-3 px-4 md:px-6 text-center text-sm text-gray-800">{{ $product->price }}</td>
            <td class="py-3 px-4 md:px-6 text-center text-sm text-gray-800">{{ $product->discount ?? 'N/A' }}</td>
            <td class="py-3 px-4 md:px-6 text-center text-sm text-gray-800">{{ $product->price_after_discount }}</td>
            <td class="py-4 px-4 border-r border-gray-200">{{ Str::limit($product->description, 8, '...') ?? 'N/A' }}</td>
            <td class="py-3 px-4 md:px-6 text-center text-sm text-gray-800">{{ $product->brand_name }}</td>
            <td class="py-3 px-4 md:px-6 text-center text-sm text-gray-800">{{ $product->category_name }}</td>
            <td class="py-3 px-4 md:px-6 text-center text-sm text-gray-800">{{ $product->slide_name }}</td>
            <td class="py-3 px-4 md:px-6 text-center text-sm text-gray-800">{{ $product->od }}</td>
            <td class="py-3 px-4 md:px-6 text-center text-sm text-gray-800">{{ $product->name_link }}</td>
            <td class="py-3 px-4 md:px-6 text-center text-sm text-gray-800">
                @php
                    $images = json_decode($product->image, true);
                    $images = is_array($images) ? array_slice($images, 0, 1) : [];
                @endphp
                @if ($images)
                    <div class="flex justify-center">
                        @foreach ($images as $img)
                            <img src="{{ asset('storage/' . $img) }}" 
                                 alt="Product Image" 
                                 class="w-16 h-16 object-cover rounded-md border" />
                        @endforeach
                    </div>
                @else
                    <div class="flex justify-center">
                        <img src="{{ asset('images/placeholder.jpg') }}" 
                             class="w-16 h-16 object-cover rounded-md border" 
                             alt="No Image">
                    </div>
                @endif
            </td>
            <td class="py-3 px-4 md:px-6 text-center text-sm text-gray-800">
                <span class="px-2 py-1 rounded-full text-xs font-semibold 
                            {{ $product->status == 1 ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                    {{ $product->status == 1 ? 'Active' : 'Inactive' }}
                </span>
            </td>
            <td class="py-3 px-4 md:px-6 text-center text-sm text-gray-800">
                <div class="flex justify-center space-x-4">
                    <button type="button" class="text-blue-600 hover:text-blue-800 font-medium edit-product-btn" 
                            data-product-id="{{ $product->id }}">
                        <i class="fas fa-edit"></i> Edit
                    </button>
                    <button type="button" 
                        class="text-green-600 hover:text-green-800 font-medium show-product-btn" 
                        data-product-id="{{ $product->id }}">
                        <i class="fas fa-eye"></i> Show
                    </button>
                    <form id="deleteProductForm-{{ $product->id }}" method="POST" action="{{ route('admin.products.destroy', $product->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="text-red-600 hover:text-red-800 font-medium delete-product-btn" 
                                data-product-id="{{ $product->id }}">
                            <i class="fas fa-trash-alt"></i> Delete
                        </button>
                    </form>
                </div>
            </td>
        </tr>
    @endforeach
</tbody>
        </table>
    </div>

    <!-- Delete Confirmation Popup -->
    <div id="deleteConfirmationPopup" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-xl p-6 w-[90%] max-w-md">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Confirm Deletion</h3>
            <p class="text-gray-600 mb-6" id="deleteMessage">Are you sure you want to delete this product? This action cannot be undone. <br><strong>Deletion Date: <span id="deleteDate"></span></strong></p>
            <div class="flex justify-end space-x-3">
                <button id="cancelDelete" class="px-4 py-2 border border-gray-400 text-gray-700 rounded-md hover:bg-gray-100">
                    Cancel
                </button>
                <button id="confirmDelete" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md shadow-sm">
                    Delete
                </button>
            </div>
        </div>
    </div>

    <!-- Modal Container -->
    <div id="modalOverlay" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div id="modalContent" class=" ml-64   w-[70%] p-6 overflow-y-auto max-h-[90vh] relative">
            <!-- Loading Indicator -->
            <div id="modalLoading" class="flex flex-col items-center">
                <i class="fas fa-spinner fa-spin text-blue-600 text-3xl"></i>
                <span class="mt-2 text-gray-600">Loading...</span>
            </div>
            <!-- Modal content will be loaded here -->
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
<script>
    $(document).ready(function() {
        // Open Add Product Modal
        $('#btn-add').click(function() {
            $('#modalOverlay').removeClass('hidden');
            $('#modalLoading').removeClass('hidden');
            $('#modalContent').load('{{ route("admin.products.create") }}', function(response, status, xhr) {
                if (status === 'error') {
                    console.error('Error loading modal content:', xhr.status);
                    $('#modalOverlay').addClass('hidden');
                    $('#modalLoading').addClass('hidden');
                    $('#errorArea').removeClass('hidden').text('Failed to load the form. Please try again.');
                } else {
                    $('#modalLoading').addClass('hidden');
                    initializeFormScripts(); // Initialize form scripts after loading
                }
            });
        });
        

        // Open Edit Product Modal
        $(document).on('click', '.edit-product-btn', function() {
            const productId = $(this).data('product-id');
            $('#modalOverlay').removeClass('hidden');
            $('#modalLoading').removeClass('hidden');
            $('#modalContent').load('{{ route("admin.products.index") }}/' + productId + '', function(response, status, xhr) {
                if (status === 'error') {
                    console.error('Error loading edit form:', xhr.status);
                    $('#modalOverlay').addClass('hidden');
                    $('#modalLoading').addClass('hidden');
                    $('#errorArea').removeClass('hidden').text('Failed to load the edit form. Please try again.');
                } else {
                    $('#modalLoading').addClass('hidden');
                    initializeFormScripts(); // Initialize form scripts after loading
                }
            });
        });
         // Open Edit Product Modal
       $(document).on('click', '.show-product-btn', function () {
    const productId = $(this).data('product-id');
    $('#modalOverlay').removeClass('hidden');
    $('#modalLoading').removeClass('hidden');

    const url = '{{ route("admin.products.show", ":id") }}'.replace(':id', productId);

    $('#modalContent').load(url, function (response, status, xhr) {
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

        
        // Close modal when clicking outside
        $('#modalOverlay').click(function(e) {
            if (e.target === this) {
                $('#modalOverlay').addClass('hidden');
                $('#modalContent').empty();
                $('#modalLoading').removeClass('hidden');
            }
        });

        // Delete Product
        $('.delete-product-btn').click(function () {
            const productId = $(this).data('product-id');
            const form = $('#deleteProductForm-' + productId);
            const $button = $(this);

            // Get current date
            const currentDate = new Date().toLocaleDateString('en-US', {
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });

            // Update popup message with the current date
            $('#deleteDate').text(currentDate);
            $('#deleteConfirmationPopup').removeClass('hidden');

            // Handle confirm button
            $('#confirmDelete').off('click').on('click', function () {
                const formData = new FormData(form[0]);

                $.ajax({
                    type: "POST",
                    url: form.attr('action'),
                    data: formData,
                    processData: false,
                    contentType: false,
                    cache: false,
                    beforeSend: function () {
                        // $button.html('<i class="fas fa-spinner fa-spin"></i> Deleting...').prop('disabled', true);
                        $('#confirmDelete').prop('disabled', true);
                    },
                    success: function (response) {
                        $('#deleteConfirmationPopup').addClass('hidden');
                        form.closest('tr').fadeOut(300, function () {
                            $(this).remove();
                        });
                        $('#successArea').removeClass('hidden').text('Product updated successfully!');
                        setTimeout(() => {
                            $('#successArea').addClass('hidden');
                            $('#modalOverlay').addClass('hidden');
                            $('#modalContent').empty();

                            // Fixed: Update the specific table row
                        }, 2000);
                        setTimeout(() => {
                            $('#successArea').addClass('hidden');
                        }, 3000);
                    },
                    error: function (xhr) {
                        console.error('AJAX error:', xhr.responseText);
                        $('#deleteConfirmationPopup').addClass('hidden');
                        let errorMsg = 'An error occurred. Please try again.';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMsg = xhr.responseJSON.message;
                        } else if (xhr.responseJSON && xhr.responseJSON.errors) {
                            errorMsg = Object.values(xhr.responseJSON.errors).flat().join(' ');
                        }
                        $('#errorArea').removeClass('hidden').text(errorMsg);
                        setTimeout(() => {
                            $('#errorArea').addClass('hidden');
                        }, 3000);
                    },
                    complete: function () {
                        $button.html('<i class="fas fa-trash-alt"></i> Delete').prop('disabled', false);
                        $('#confirmDelete').prop('disabled', false);
                    }
                });
            });

            // Handle cancel button
            $('#cancelDelete').off('click').on('click', function () {
                $('#deleteConfirmationPopup').addClass('hidden');
            });
        });

        // Initialize form scripts (for both create and edit forms)
        function initializeFormScripts() {
            // Image Preview
            const imageInput = document.getElementById('image');
            const imagePreview = document.getElementById('image-preview');
            if (imageInput && imagePreview) {
                imageInput.addEventListener('change', function (event) {
                    const file = event.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function (e) {
                            imagePreview.src = e.target.result;
                        };
                        reader.readAsDataURL(file);
                    } else {
                        imagePreview.src = imagePreview.dataset.defaultSrc || 'https://media.istockphoto.com/id/1324356458/vector/picture-icon-photo-frame-symbol-landscape-sign-photograph-gallery-logo-web-interface-and.jpg?s=612x612&w=0&k=20&c=ZmXO4mSgNDPzDRX-F8OKCfmMqqHpqMV6jiNi00Ye7rE=';
                    }
                });
            }

            // Dynamic Price Calculation
            const priceInput = document.getElementById('price');
            const discountInput = document.getElementById('discount');
            const priceAfterDiscountInput = document.getElementById('price_after_discount');
            if (priceInput && discountInput && priceAfterDiscountInput) {
                function calculatePriceAfterDiscount() {
                    const price = parseFloat(priceInput.value) || 0;
                    const discount = parseFloat(discountInput.value) || 0;
                    const priceAfterDiscount = price - (price * discount / 100);
                    priceAfterDiscountInput.value = priceAfterDiscount >= 0 ? priceAfterDiscount.toFixed(2) : 0;
                }
                priceInput.addEventListener('input', calculatePriceAfterDiscount);
                discountInput.addEventListener('input', calculatePriceAfterDiscount);
                calculatePriceAfterDiscount();
            }

            // Close Validation Popup
            $(document).on('click', '#closePopup', function () {
                $('#validationPopup').addClass('hidden');
            });

            // Cancel Edit
            $(document).on('click', '#cancelEdit', function () {
                $('#modalOverlay').addClass('hidden');
                $('#modalContent').empty();
                $('#modalLoading').removeClass('hidden');
            });

            // AJAX Form Submission for Edit
       $('#btn-edit').click(function(e) {
    e.preventDefault();
    console.log('Update button clicked');

    const $form = $('#productForm');
    const formData = new FormData($form[0]);
    const $button = $(this);

    // // Client-side validation
    // const requiredFields = {
    //     name: $('#name').val().trim(),
    //     price: $('#price').val().trim(),
    //     price_after_discount: $('#price_after_discount').val().trim(),
    //     description: $('#description').val().trim(),
    //     status: $('#status').val().trim(),
    //     brand: $('#brand').val().trim(),
    //     category: $('#category').val().trim(),
    //     od: $('#od').val().trim(),
    //     name_link: $('#name_link').val().trim()
    // };

 

    $.ajax({
        type: "POST",
        url: $form.attr('action'),
        data: formData,
        processData: false,
        contentType: false,
        cache: false,
        beforeSend: function() {
            console.log('Sending AJAX request');
            // $button.html('<i class="fas fa-spinner fa-spin"></i> Updating...').prop('disabled', true);
            // $button.html('<i class="fas fa-spinner fa-spin"></i> Updating...').prop('disabled', true);
            // $button.css('pointer-events', 'none');
        },
      success: function(response) {
                        $('#successArea').removeClass('hidden').html('<i class="fa fa-spinner fa-spin" style="font-size:24px"></i><span class="p-2">Update...</span>');
                        setTimeout(() => {
                            $('#successArea').addClass('hidden');
                            $('#modalOverlay').addClass('hidden');
                            window.location.reload();
                            // $('#modalContent').empty();

                            // Fixed: Update the specific table row
                        },700);
            // $button.css('pointer-events', 'auto');

                    },
        error: function(xhr) {
            console.error('AJAX error:', xhr.responseText);
            let errorMsg = 'An error occurred. Please try again.';
            if (xhr.responseJSON && xhr.responseJSON.message) {
                errorMsg = xhr.responseJSON.message;
            } else if (xhr.responseJSON && xhr.responseJSON.errors) {
                errorMsg = Object.values(xhr.responseJSON.errors).flat().join(' ');
            }
            $('#errorMessage').text(errorMsg);
            $('#errorArea').removeClass('hidden');
            setTimeout(() => $('#errorArea').addClass('hidden'), 3000);
        },
        complete: function() {
            $button.html('Update Product').prop('disabled', false);
        }
    });
});
    }
    });
</script>
@endsection