@extends('layout')
@section('title', 'Add Product')
@section('pagetitle', 'Add Product')

@section('main')
  
   

        <form action=" {{ route('storeProduct') }} " method="POST" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div class="flex flex-col justify-between py-1">

                    <div>
                        <label for="image" class="block text-sm font-semibold text-gray-700 mb-2">Product Image</label>
                        <input type="file" id="image" name="image" 
                            class="p-2 border border-gray-300 rounded-md w-full" onchange="previewImage(event)" accept="image/*">

                        <div class="mt-4">
                            <img id="imagePreview" src="" alt="Image Preview"
                                class="hidden w-full max-w-xs h-auto rounded-md">
                        </div>
                    </div>
                    <div class="">
                        <button type="button" id="clearImageBtn"
                            class="px-6 py-2 bg-red-600 text-white font-semibold rounded-lg shadow-md hover:bg-red-700 hidden"
                            onclick="clearImage()">Clear Image</button>
                    </div>

                </div>

                <div>
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-semibold text-gray-700">Product Name</label>
                        <input type="text" id="name" name="name"
                            class="mt-2 p-2 border border-gray-300 rounded-md w-full" required>
                    </div>


                    <div class="mb-4">
                        <label for="description" class="block text-sm font-semibold text-gray-700">
                            Category
                        </label>
                        <select id="category" name="category" class="mt-2 p-2 border border-gray-300 rounded-md w-full capitalize" required>
                            <option value="" selected disabled>Select Category</option>
                            @foreach ($category as $cat)
                                <option value=" {{ $cat->category }} " > {{ $cat->category }} </option>
                            @endforeach
                        </select>
                    </div>


                    <div class="mb-4">
                        <label for="price" class="block text-sm font-semibold text-gray-700">
                            Description
                        </label>
                        <textarea id="description" name="description" rows="4" class="mt-2 p-2 border border-gray-300 rounded-md w-full"
                            required></textarea>
                    </div>

                    <div class="mb-4">
                        <label for="stock" class="block text-sm font-semibold text-gray-700">Stock Quantity</label>
                        <input type="number" id="stock" name="stock"
                            class="mt-2 p-2 border border-gray-300 rounded-md w-full" required>
                    </div>

                    <div class="mb-4">
                        <label for="purchasePrice" class="block text-sm font-semibold text-gray-700">Purchase Price</label>
                        <input type="number" id="purchasePrice" name="purchasePrice"
                            class="mt-2 p-2 border border-gray-300 rounded-md w-full" required>
                    </div>

                    <div class="mb-4">
                        <label for="salePrice" class="block text-sm font-semibold text-gray-700">Sale Price</label>
                        <input type="number" id="salePrice" name="salePrice"
                            class="mt-2 p-2 border border-gray-300 rounded-md w-full" required>
                    </div>

                  
                </div>
            </div>

            <div class="flex justify-end">
                <button type="submit"
                    class="px-6 py-2 bg-primary text-white font-semibold rounded-lg shadow-md">Add
                    Product</button>
            </div>
        </form>
   

    <script>
        // Function to preview the selected image
        function previewImage(event) {
            const file = event.target.files[0];
            const reader = new FileReader();

            reader.onload = function() {
                const imagePreview = document.getElementById('imagePreview');
                const clearImageBtn = document.getElementById('clearImageBtn');

                imagePreview.src = reader.result;
                imagePreview.classList.remove('hidden'); // Show the image
                clearImageBtn.classList.remove('hidden'); // Show the "Clear Image" button
            };

            if (file) {
                reader.readAsDataURL(file);
            }
        }

        // Function to clear the image and reset the input field
        function clearImage() {
            const fileInput = document.getElementById('image');
            const imagePreview = document.getElementById('imagePreview');
            const clearImageBtn = document.getElementById('clearImageBtn');

            fileInput.value = ''; // Reset file input
            imagePreview.src = ''; // Clear the image preview
            imagePreview.classList.add('hidden'); // Hide the image preview
            clearImageBtn.classList.add('hidden'); // Hide the "Clear Image" button
        }
    </script>

@endsection
