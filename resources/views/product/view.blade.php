@extends('layout')
@section('title', 'View Product')
@section('pagetitle', 'View Product')

@section('main')

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        {{-- LEFT SIDE — Product Image --}}
        <div class="flex flex-col justify-between py-1">



            <div class="">
                <label class="block text-xl font-semibold text-gray-700 mb-2">Product Image</label>

                @if ($product->image)
                    <img src=" {{ asset('storage/' . $product->image) }} " alt=" {{ $product->name }} "
                        class="w-[300px] h-[300px] object-cover rounded-md">
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

            <div class="border-b-2 mb-4">
                <label class="block text-sm font-semibold text-gray-700">Barcode</label>

                {{-- Barcode --}}
                @if ($product->barcode)
                    <div class=" my-4">
                        <img src="data:image/png;base64,{{ DNS1D::getBarcodePNG($product->barcode, 'C128', 1.5, 40) }}"
                            alt="barcode" class="">
                        <span class="font-mono text-xs mt-1">{{ $product->barcode }}</span>
                    </div>
                @else
                    <p class="text-center text-gray-400 my-4">No barcode</p>
                @endif
            </div>


            {{-- Product Name --}}
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700">Product Name</label>
                <div class="mt-2 p-2 border border-gray-300 rounded-md bg-gray-100">
                    {{ $product->name }}
                </div>
            </div>

            {{-- Category --}}
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700">Category</label>
                <div class="mt-2 p-2 border border-gray-300 rounded-md bg-gray-100 capitalize">
                    {{ $product->category }}
                </div>
            </div>

            {{-- Description --}}
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700">Description</label>
                <div class="mt-2 p-2 border border-gray-300 rounded-md bg-gray-100 min-h-[100px]">
                    {{ $product->description }}
                </div>
            </div>

            {{-- Stock --}}
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700">Stock Quantity</label>
                <div class="mt-2 p-2 border border-gray-300 rounded-md bg-gray-100">
                    {{ $product->stock }}
                </div>
            </div>

            {{-- Purchase Price --}}
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700">Purchase Price</label>
                <div class="mt-2 p-2 border border-gray-300 rounded-md bg-gray-100">
                    ₱{{ $product->purchasePrice }}
                </div>
            </div>

            {{-- Sale Price --}}
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700">Sale Price</label>
                <div class="mt-2 p-2 border border-gray-300 rounded-md bg-gray-100">
                    ₱{{ $product->salePrice }}
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
                <a href=" {{ route('editProduct', $product->id) }} "
                    class="px-6 py-2 bg-gray-700 hover:bg-gray-800 text-white font-semibold rounded-lg shadow-md ">
                    Edit
                </a>

                <form action="" method="POST" class="view-product-delete">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="px-6 py-2 bg-red-600 text-white font-semibold rounded-lg shadow-md hover:bg-red-700">
                        Delete
                    </button>
                </form>
            </div>

        </div>
    </div>


    <script>
        document.addEventListener("DOMContentLoaded", function() {

            document.querySelectorAll(".view-product-delete").forEach(function(form) {

                form.addEventListener("submit", function(e) {
                    e.preventDefault();

                    Swal.fire({
                        title: "Delete Product?",
                        text: "This will permanently delete the product.",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#d33",
                        cancelButtonColor: "#3085d6",
                        confirmButtonText: "Yes, delete it",
                        cancelButtonText: "Cancel"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });

                });

            });

        });
    </script>

@endsection
