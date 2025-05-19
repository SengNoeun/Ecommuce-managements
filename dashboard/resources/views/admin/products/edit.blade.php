<div id="editProductModal" class="bg-white relative w-full p-10">
    <div class="bg-white border border-gray-300 w-[100%] p-6">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6 border-b pb-2 text-center">Edit Product</h2>
         <button id="closeModal" class="absolute top-4 right-4 text-red-600 hover:text-gray-800">
        <i class="fas fa-times"></i>
    </button>

        <!-- Success Popup -->
        <div id="successArea" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white rounded-lg shadow-xl p-6 w-[90%] max-w-md">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Success</h3>
                <p id="successMessage" class="text-gray-600 mb-6">{{ session('success') }}</p>
                <div class="flex justify-end space-x-3">
                    <button id="cancelSuccess" class="px-4 py-2 border border-gray-400 text-gray-700 rounded-md hover:bg-gray-100">
                        Cancel
                    </button>
                    <button id="okSuccess" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md shadow-sm">
                        OK
                    </button>
                </div>
            </div>
        </div>

        <!-- Error Popup -->
        <div id="errorArea" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white rounded-lg shadow-xl p-6 w-[90%] max-w-md">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Error</h3>
                <p id="errorMessage" class="text-gray-600 mb-6"></p>
                <div class="flex justify-end space-x-3">
                    <button id="cancelError" class="px-4 py-2 border border-gray-400 text-gray-700 rounded-md hover:bg-gray-100">
                        Cancel
                    </button>
                    <button id="okError" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md shadow-sm">
                        OK
                    </button>
                </div>
            </div>
        </div>

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

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form id="productForm" action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Name -->
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Product Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" required
                    class="mt-1 block w-full px-3 text-gray-700 py-2  border border-gray-300 rounded-md shadow-sm sm:text-sm focus:ring-blue-500 focus:border-blue-500">
                @error('name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Price -->
            <div class="mb-4">
                <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Price</label>
                <input type="number" name="price" id="price" value="{{ old('price', $product->price) }}" step="0.01" required
                    class="mt-1 block w-full px-3 text-gray-700 py-2 border border-gray-300 rounded-md shadow-sm sm:text-sm focus:ring-blue-500 focus:border-blue-500">
                @error('price')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Discount -->
            <div class="mb-4">
                <label for="discount" class="block text-sm font-medium text-gray-700 mb-1">Discount (%)</label>
                <input type="number" name="discount" id="discount" value="{{ old('discount', $product->discount) }}" step="0.01"
                    class="mt-1 block w-full px-3 text-gray-700 py-2 border border-gray-300 rounded-md shadow-sm sm:text-sm focus:ring-blue-500 focus:border-blue-500">
                @error('discount')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Price After Discount -->
            <div class="mb-4">
                <label for="price_after_discount" class="block text-sm font-medium text-gray-700 mb-1">Price After Discount</label>
                <input type="number" name="price_after_discount" id="price_after_discount" value="{{ old('price_after_discount', $product->price_after_discount) }}" step="0.01"
                    class="mt-1 block w-full px-3 text-gray-700 py-2 border border-gray-300 rounded-md shadow-sm sm:text-sm focus:ring-blue-500 focus:border-blue-500" readonly>
                @error('price_after_discount')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Description -->
            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                <textarea name="description" id="description"
                    class="mt-1 block w-full px-3 text-gray-700 py-2 border border-gray-300 rounded-md shadow-sm sm:text-sm focus:ring-blue-500 focus:border-blue-500">{{ old('description', $product->description) }}</textarea>
                @error('description')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Category -->
            <div class="mb-4">
                <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                <select name="category" id="category"
                    class="mt-1 block w-full px-3 text-gray-700 py-2 border border-gray-300 rounded-md shadow-sm sm:text-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Select a Category</option>
                    @foreach ($categorys as $category)
                        <option value="{{ $category->id }}" {{ old('category', $product->category) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Status -->
            <div class="mb-4">
                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select name="status" id="status"
                    class="mt-1 block w-full px-3 text-gray-700 py-2 border border-gray-300 rounded-md shadow-sm sm:text-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="1" {{ old('status', $product->status) == '1' ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ old('status', $product->status) == '0' ? 'selected' : '' }}>Inactive</option>
                </select>
                @error('status')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Brand -->
            <div class="mb-4">
                <label for="brand" class="block text-sm font-medium text-gray-700 mb-1">Brand</label>
                <select name="brand" id="brand"
                    class="mt-1 block w-full px-3 text-gray-700 py-2 border border-gray-300 rounded-md shadow-sm sm:text-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Select a Brand</option>
                    @foreach ($brands as $brand)
                        <option value="{{ $brand->id }}" {{ old('brand', $product->brand) == $brand->id ? 'selected' : '' }}>
                            {{ $brand->name }}
                        </option>
                    @endforeach
                </select>
                @error('brand')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Slide -->
            <div class="mb-4">
                <label for="slide" class="block text-sm font-medium  text-gray-700 mb-1">Slide</label>
                <select name="slide" id="slide"
                    class="mt-1 block w-full px-3 text-gray-700 py-2 border border-gray-300 rounded-md shadow-sm sm:text-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Select a Slide</option>
                    @foreach ($slides as $slide)
                        <option value="{{ $slide->id }}" {{ old('slide', $product->slide) == $slide->id ? 'selected' : '' }}>
                            {{ $slide->name }}
                        </option>
                    @endforeach
                </select>
                @error('slide')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Display Order -->
            <div class="mb-4">
                <label for="od" class="block text-sm font-medium text-gray-700 mb-1">Display Order</label>
                <input type="text" name="od" id="od" value="{{ old('od', $product->od) }}"
                    class="mt-1 block text-gray-700 w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm sm:text-sm focus:ring-blue-500 focus:border-blue-500">
                @error('od')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Name Link (Slug/URL) -->
            <div class="mb-4">
                <label for="name_link" class="block text-sm font-medium text-gray-700 mb-1">Name Link (Slug/URL)</label>
                <input type="text" name="name_link" id="name_link" value="{{ old('name_link', $product->name_link) }}"
                    class="mt-1 block w-full text-gray-700 px-3 py-2 border border-gray-300 rounded-md shadow-sm sm:text-sm focus:ring-blue-500 focus:border-blue-500">
                @error('name_link')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
                   <!-- Image Upload -->
            <div class="mb-4">
                <label for="images" class="block text-sm font-medium text-gray-700 mb-1">Images (Max 4)</label>
                <input type="file" name="images[]" id="images" accept="image/*" multiple
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm sm:text-sm focus:ring-blue-500 focus:border-blue-500">
                @error('images.*')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
                <p class="text-sm text-gray-500 mt-1">You can upload up to 4 images. Existing images are shown below.</p>
            </div>
            <!-- Existing Images -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Current Images</label>
                <div id="existing-images" class="grid grid-cols-2 gap-2 max-w-xs">
                    @php
                        $images = json_decode($product->image, true) ?? [];
                    @endphp
                    @if ($images)
                        @foreach ($images as $index => $img)
                            <div class="relative" data-image-path="{{ $img }}">
                                <img src="{{ asset('storage/' . $img) }}" alt="Category Image"
                                    class="w-16 h-16 object-cover rounded-md border">
                                <button type="button" class="remove-image absolute top-0 right-[5rem] bg-red-600 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs"
                                    data-index="{{ $index }}" data-path="{{ $img }}">×</button>
                                <input type="hidden" name="existing_images[]" value="{{ $img }}">
                            </div>
                        @endforeach
                    @else
                        <p class="text-sm text-gray-500">No images uploaded.</p>
                    @endif
                </div>
                <!-- Container for remove_images inputs -->
                <div id="remove-images-container" class="hidden"></div>
            </div>
             <!-- New Image Previews -->
            <div class="mb-4 hidden" id="preview-container">
                <label class="block text-sm font-medium text-gray-700 mb-1">New Image Previews</label>
                <div id="image-previews" class="grid grid-cols-2 gap-2 max-w-xs"></div>
            </div>
            <!-- Buttons -->
            <div class="flex justify-end space-x-3 pt-4 border-t mt-6">
                <a href="{{ route('admin.products.index') }}"
                    class="px-4 py-2 border border-gray-400 text-gray-700 rounded-md hover:bg-gray-100">
                    Cancel
                </a>
                <button type="button" id="btn-edit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md shadow-sm">
                    Update Product
                </button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.tailwindcss.com"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
<script>
     // Image upload preview
    document.getElementById('images').addEventListener('change', function (event) {
        const files = event.target.files;
        const previewContainer = document.getElementById('preview-container');
        const previews = document.getElementById('image-previews');
        previews.innerHTML = ''; // Clear previous previews

        const existingImagesCount = document.querySelectorAll('#existing-images > div').length;
        const maxImages = 4;
        const allowedFiles = Math.min(files.length, maxImages - existingImagesCount);

        if (allowedFiles > 0) {
            previewContainer.classList.remove('hidden');
            for (let i = 0; i < allowedFiles; i++) {
                const file = files[i];
                const reader = new FileReader();
                reader.onload = function (e) {
                    const div = document.createElement('div');
                    div.className = 'relative';
                    div.innerHTML = `
                        <img src="${e.target.result}" alt="New Image Preview" class="w-16 h-16 object-cover rounded-md border">
                    `;
                    previews.appendChild(div);
                };
                reader.readAsDataURL(file);
            }
        } else {
            previewContainer.classList.add('hidden');
            if (files.length > 0) {
                alert(`You can only upload up to ${maxImages} images in total.`);
                event.target.value = ''; // Clear the input
            }
        }
    });
     // Remove existing image
    document.querySelectorAll('.remove-image').forEach(button => {
        button.addEventListener('click', function () {
            const path = this.getAttribute('data-path');
            const container = this.parentElement;
            const existingImages = document.getElementById('existing-images');
            const removeImagesContainer = document.getElementById('remove-images-container');

            // Add hidden input for removal
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'remove_images[]';
            input.value = path;
            removeImagesContainer.appendChild(input);

            console.log('Added remove_images input:', path); // Debugging

            // Remove from display
            container.remove();

            // Update "No images" message
            if (!existingImages.querySelector('div')) {
                existingImages.innerHTML = '<p class="text-sm text-gray-500">No images uploaded.</p>';
            }
        });
    });
    // Close Modal
   $(document).on('click', '#closeModal, #cancelModal', function () {
    console.log('Close or cancel button clicked'); // DEBUG
    $('#modalOverlay').addClass('hidden');
    $('#modalContent').empty();
    });
</script>