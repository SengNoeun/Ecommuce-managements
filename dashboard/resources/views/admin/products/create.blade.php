<div class="relative bg-white w-full p-10">
    <h2 class="text-2xl font-semibold text-gray-800 mb-6 border-b w-[100%]   pb-2">Create New Product</h2>
    <button id="closeModal" class="absolute top-4 right-4 text-red-600 hover:text-gray-800">
        <i class="fas fa-times"></i>
    </button>

    <!-- Error Area -->
    <div id="errorArea" class="hidden bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4"></div>

    <!-- Validation Popup -->
    <div id="validationPopup" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-xl p-6 w-[90%] max-w-md">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Validation Error</h3>
            <p class="text-gray-600 mb-6">Please fill in all required fields.</p>
            <div class="flex justify-end">
                <button id="closePopup" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md shadow-sm">
                    OK
                </button>
            </div>
        </div>
    </div>  

    <form id="productForm" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Name -->
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required
                class="mt-1 block w-full text-gray-700  px-3 py-2 border border-gray-300 rounded-md shadow-sm sm:text-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- Price -->
        <div class="mb-4">
            <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Price</label>
            <input type="number" name="price" id="price" value="{{ old('price') }}" step="0.01" required
                class="mt-1 block w-full text-gray-700  px-3 py-2 border border-gray-300 rounded-md shadow-sm sm:text-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- Discount -->
        <div class="mb-4">
            <label for="discount" class="block text-sm font-medium text-gray-700 mb-1">Discount (%)</label>
            <input type="number" name="discount" id="discount" value="{{ old('discount') }}" step="0.01"
                class="mt-1 block w-full text-gray-700  px-3 py-2 border border-gray-300 rounded-md shadow-sm sm:text-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- Price After Discount -->
        <div class="mb-4">
            <label for="price_after_discount" class="block text-sm font-medium text-gray-700 mb-1">Price After Discount</label>
            <input type="number" name="price_after_discount" id="price_after_discount" value="{{ old('price_after_discount') }}" step="0.01"
                class="mt-1 block w-full text-gray-700  px-3 py-2 border border-gray-300 rounded-md shadow-sm sm:text-sm focus:ring-blue-500 focus:border-blue-500" readonly>
        </div>

        <!-- Description -->
        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
            <textarea name="description" id="description"
                class="mt-1 block w-full text-gray-700  px-3 py-2 border border-gray-300 rounded-md shadow-sm sm:text-sm focus:ring-blue-500 focus:border-blue-500">{{ old('description') }}</textarea>
        </div>

        <!-- Status -->
        <div class="mb-4">
            <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
            <select name="status" id="status"
                class="mt-1 block w-full text-gray-700  px-3 py-2 border border-gray-300 rounded-md shadow-sm sm:text-sm focus:ring-blue-500 focus:border-blue-500">
                <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
                <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        <!-- Brand -->
        <div class="mb-4">
            <label for="brand" class="block text-sm font-medium text-gray-700 mb-1">Brand</label>
            <select name="brand" id="brand"
                class="mt-1 block w-full text-gray-700  px-3 py-2 border border-gray-300 rounded-md shadow-sm sm:text-sm focus:ring-blue-500 focus:border-blue-500">
                <option value="">Select a Brand</option>
                @foreach ($brands as $brand)
                    <option value="{{ $brand->id }}" {{ old('brand') == $brand->id ? 'selected' : '' }}>
                        {{ $brand->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Category -->
        <div class="mb-4">
            <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
            <select name="category" id="category"
                class="mt-1 block w-full text-gray-700  px-3 py-2 border border-gray-300 rounded-md shadow-sm sm:text-sm focus:ring-blue-500 focus:border-blue-500">
                <option value="">Select a Category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Slide -->
        <div class="mb-4">
            <label for="slide" class="block text-sm font-medium text-gray-700 mb-1">Slide</label>
            <select name="slide" id="slide"
                class="mt-1 block w-full text-gray-700  px-3 py-2 border border-gray-300 rounded-md shadow-sm sm:text-sm focus:ring-blue-500 focus:border-blue-500">
                <option value="">Select a Slide</option>
                @foreach ($slides as $slide)
                    <option value="{{ $slide->id }}" {{ old('slide') == $slide->id ? 'selected' : '' }}>
                        {{ $slide->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Display Order -->
        <div class="mb-4">
            <label for="od" class="block text-sm font-medium text-gray-700 mb-1">Display Order</label>
            <input type="text" name="od" id="od" value="{{ old('od') }}"
                class="mt-1 block w-full text-gray-700  px-3 py-2 border border-gray-300 rounded-md shadow-sm sm:text-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- Name Link (Slug/URL) -->
        <div class="mb-4">
            <label for="name_link" class="block text-sm font-medium text-gray-700 mb-1">Name Link (Slug/URL)</label>
            <input type="text" name="name_link" id="name_link" value="{{ old('name_link') }}"
                class="mt-1 block w-full text-gray-700  px-3 py-2 border border-gray-300 rounded-md shadow-sm sm:text-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- Image Upload -->
           <div class="mb-4">
                <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Images (Optional)</label>
                <input type="file" name="image[]" id="image" class="form-control @error('image.*') border-red-500 @enderror" multiple>
                
                @error('image.*')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror

                <!-- Image Preview -->
                <div id="image-preview" class="mt-2 flex flex-wrap gap-2"></div>
            </div>

        <!-- Buttons -->
        <div class="flex justify-end space-x-3 pt-4 border-t mt-6">
            <button type="button" id="cancelModal" class="px-4 py-2 border border-gray-400 text-gray-700 rounded-md hover:bg-gray-100">
                Cancel
            </button>
            <button type="button" id="btn-save" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md shadow-sm">
                Save
            </button>
        </div>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
   
 document.getElementById('image').addEventListener('change', function (event) {
        const files = event.target.files;
        const preview = document.getElementById('image-preview');
        preview.innerHTML = ''; // Clear previous previews

        if (files.length > 0) {
            Array.from(files).forEach(file => {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.classList.add('w-20', 'h-20', 'object-cover', 'rounded');
                    preview.appendChild(img);
                };
                reader.readAsDataURL(file);
            });
        }
    });
    // Close Validation Popup
    $(document).on('click', '#closePopup', function() {
        $('#validationPopup').addClass('hidden');
    });

    // Close Modal
   $(document).on('click', '#closeModal, #cancelModal', function () {
    console.log('Close or cancel button clicked'); // DEBUG
    $('#modalOverlay').addClass('hidden');
    $('#modalContent').empty();
    });


    // Dynamic Price Calculation
    const priceInput = document.getElementById('price');
    const discountInput = document.getElementById('discount');
    const priceAfterDiscountInput = document.getElementById('price_after_discount');

function calculatePriceAfterDiscount() {
    const price = parseFloat(priceInput.value) || 0;
    const discount = parseFloat(discountInput.value) || 0;
    const priceAfterDiscount = price - (price * discount / 100);
    priceAfterDiscountInput.value = priceAfterDiscount >= 0 ? priceAfterDiscount.toFixed(2) : 0;
}

priceInput.addEventListener('input', calculatePriceAfterDiscount);
discountInput.addEventListener('input', calculatePriceAfterDiscount);
calculatePriceAfterDiscount();

    // AJAX Form Submission
    $(document).on('click', '#btn-save', function(e) {
        e.preventDefault();
        console.log('Save button clicked'); // Debug: Confirm click event

        const form = document.getElementById('productForm');
        const formData = new FormData(form);
        const errorArea = $('#errorArea');
        const $this = $(this);

        // Client-side validation
        const name = $('#name').val().trim();
        const price = $('#price').val().trim();
        const discount = $('#discount').val().trim();
        const price_after_discount = $('#price_after_discount').val().trim();
        const description = $('#description').val().trim();
        const status = $('#status').val().trim();
        const brand = $('#brand').val().trim();
        const category = $('#category').val().trim();
        const slide = $('#slide').val().trim();
        const od = $('#od').val().trim();
        const name_link = $('#name_link').val().trim();

    // Check if any required field is empty
    if (name === '' || price === '' || discount === '' || price_after_discount === '' || description === '' || 
                status === '' || brand === '' || category === '' || slide === '' || od === '' || name_link === '') {
                $('#validationPopup').removeClass('hidden');
                return;
            }

        $.ajax({
            type: "POST",
            url: "{{ route('admin.products.store') }}",
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            beforeSend: function() {
                console.log('Sending AJAX request'); // Debug: Confirm request start
                $this.html('<i class="fa fa-spinner fa-spin" style="font-size:20px"></i><span class="p-2">Wait...</span>');
                $this.css('pointter-events', 'none');

            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                console.log('AJAX success:', response); // Debug: Log response
                $this.html('Save');
                $this.css('pointter-events', 'auto');
                 
               // Reset form fields
                    form.reset();

                    // Reset image preview
                    $('#image-preview').empty();

                    // Reset select fields to their default options
                    $('#status').val('1'); // Default to Active
                    $('#brand').val('');
                    $('#category').val('');
                    $('#slide').val('');
                   window.location.reload();

            },
            error: function(xhr) {
                console.error('AJAX error:', xhr.responseText); // Debug: Log error details
                $this.html('Save');
                $this.prop('disabled', false);
                let errorMsg = 'An error occurred. Please try again.';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMsg = xhr.responseJSON.message;
                } else if (xhr.responseJSON && xhr.responseJSON.errors) {
                    errorMsg = Object.values(xhr.responseJSON.errors).flat().join(' ');
                }
                errorArea.removeClass('hidden').text(errorMsg);
            }
        });
    });
</script>