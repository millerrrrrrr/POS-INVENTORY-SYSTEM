@extends('layout')
@section('title', 'View Product')
@section('pagetitle', 'View Product')

@section('main')

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        {{-- LEFT SIDE — Product Image --}}
        <div class="flex flex-col justify-between py-1">

            

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Product Image</label>

                @if ($product->image)
                    <img src=" {{ asset('storage/' . $product->image) }} " alt=" {{ $product->name }} "
                        class="w-[auto] h-[auto] object-cover rounded-md ">
                @else
                    <div
                        class="w-[auto] h-[500px] bg-gray-200  rounded-md flex items-center justify-center text-gray500 text-cs text-center">
                        <p>No image</p>
                    </div>
                @endif
            </div>

        </div>

        {{-- RIGHT SIDE — Product Information --}}
        <div>

            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700">Product Name</label>
                <div class="mt-2 p-2 border border-gray-300 rounded-md bg-gray-100">
                    {{ $product->name }}
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700">Category</label>
                <div class="mt-2 p-2 border border-gray-300 rounded-md bg-gray-100 capitalize">
                    {{ $product->category }}
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700">Description</label>
                <div class="mt-2 p-2 border border-gray-300 rounded-md bg-gray-100 min-h-[100px]">
                    {{ $product->description }}
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700">Stock Quantity</label>
                <div class="mt-2 p-2 border border-gray-300 rounded-md bg-gray-100">
                    {{ $product->stock }}
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700">Purchase Price</label>
                <div class="mt-2 p-2 border border-gray-300 rounded-md bg-gray-100">
                    ₱{{ $product->purchasePrice }}
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700">Sale Price</label>
                <div class="mt-2 p-2 border border-gray-300 rounded-md bg-gray-100">
                    ₱{{ $product->salePrice }}
                </div>
            </div>

        </div>
    </div>

    {{-- BUTTONS --}}
    {{-- BUTTONS --}}
<div class="flex justify-between mt-4">

    {{-- LEFT SIDE — BACK --}}
    <a href="{{ route('productList') }}"
       class="px-6 py-2 bg-gray-700 hover:bg-gray-800 text-white font-semibold rounded-lg shadow-md ">
        Back
    </a>

    {{-- RIGHT SIDE — EDIT & DELETE --}}
    <div class="flex gap-3">
        <a href=" {{ route('editProduct', $product->id) }} " class="px-6 py-2 bg-gray-700 hover:bg-gray-800 text-white font-semibold rounded-lg shadow-md ">
            Edit
        </a>

        <form action="" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit"
                class="px-6 py-2 bg-red-600 text-white font-semibold rounded-lg shadow-md hover:bg-red-700"
                onclick="return confirm('Are you sure you want to delete this product?')">
                Delete
            </button>
        </form>
    </div>

</div>


@endsection
