@extends('layout')
@section('title', 'Edit Product')
@section('pagetitle', 'Edit Product')

@section('main')

<form action="{{ route('updateProduct', $product->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        {{-- LEFT SIDE — Product Image --}}
        <div class="flex flex-col justify-between py-1">

            <div>
                <label for="image" class="block text-sm font-semibold text-gray-700 mb-2">Product Image</label>
                <input type="file" id="image" name="image"
                    class="p-2 border border-gray-300 rounded-md w-full"
                    onchange="previewImage(event)" accept="image/*">

                <div class="mt-4">

                    {{-- Show existing image if available --}}
                    @if ($product->image)
                        <img id="imagePreview"
                            src="{{ asset('storage/' . $product->image) }}"
                            alt="{{ $product->name }}"
                            class="w-full max-w-xs h-auto rounded-md">
                    @else
                        <img id="imagePreview"
                            src=""
                            alt="Image Preview"
                            class="hidden w-full max-w-xs h-auto rounded-md">
                    @endif

                </div>
            </div>

            <div>
                <button type="button" id="clearImageBtn"
                    class="px-6 py-2 bg-red-600 text-white font-semibold rounded-lg shadow-md hover:bg-red-700 {{ $product->image ? '' : 'hidden' }}"
                    onclick="clearImage()">
                    Clear Image
                </button>
            </div>

        </div>

        {{-- RIGHT SIDE — Product Info --}}
        <div>

            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700">Product Name</label>
                <input type="text" name="name"
                    class="mt-2 p-2 border border-gray-300 rounded-md w-full"
                    value="{{ $product->name }}" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700">Category</label>
                <select id="category" name="category"
                    class="mt-2 p-2 border border-gray-300 rounded-md w-full capitalize" required>
                    <option disabled>Select Category</option>

                    @foreach ($category as $cat)
                        <option value="{{ $cat->category }}"
                            {{ $product->category == $cat->category ? 'selected' : '' }}>
                            {{ $cat->category }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700">Description</label>
                <textarea name="description" rows="4"
                    class="mt-2 p-2 border border-gray-300 rounded-md w-full" required>{{ $product->description }}</textarea>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700">Stock Quantity</label>
                <input type="number" name="stock"
                    class="mt-2 p-2 border border-gray-300 rounded-md w-full"
                    value="{{ $product->stock }}" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700">Purchase Price</label>
                <input type="number" name="purchasePrice"
                    class="mt-2 p-2 border border-gray-300 rounded-md w-full"
                    value="{{ $product->purchasePrice }}" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700">Sale Price</label>
                <input type="number" name="salePrice"
                    class="mt-2 p-2 border border-gray-300 rounded-md w-full"
                    value="{{ $product->salePrice }}" required>
            </div>

        </div>
    </div>

    <div class="flex justify-end">
        <button type="submit"
            class="px-6 py-2 bg-primary text-white font-semibold rounded-lg shadow-md">
            Update Product
        </button>
    </div>
</form>


{{-- IMAGE PREVIEW SCRIPT --}}
<script>
    function previewImage(event) {
        const file = event.target.files[0];
        const reader = new FileReader();

        reader.onload = function() {
            const imagePreview = document.getElementById('imagePreview');
            const clearImageBtn = document.getElementById('clearImageBtn');

            imagePreview.src = reader.result;
            imagePreview.classList.remove('hidden');
            clearImageBtn.classList.remove('hidden');
        };

        if (file) reader.readAsDataURL(file);
    }

    function clearImage() {
        const fileInput = document.getElementById('image');
        const imagePreview = document.getElementById('imagePreview');
        const clearImageBtn = document.getElementById('clearImageBtn');

        fileInput.value = '';
        imagePreview.src = '';
        imagePreview.classList.add('hidden');
        clearImageBtn.classList.add('hidden');
    }
</script>

@endsection
