@extends('layout')
@section('title', 'Restock Item')
@section('pagetitle', 'Restock Item')

@section('main')

    <form action=" {{ route('restock', $product->id) }} " method="POST">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            {{-- LEFT SIDE — Product Image --}}
            <div class="flex flex-col justify-between py-1">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Product Image</label>

                    @if ($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" 
                             alt="{{ $product->name }}" 
                             class="w-[auto] h-[auto] object-cover rounded-md">
                    @else
                        <div class="w-[auto] h-[500px] bg-gray-200 rounded-md flex items-center justify-center text-gray-500 text-cs text-center">
                            <p>No image</p>
                        </div>
                    @endif
                </div>
            </div>

            {{-- RIGHT SIDE — Product Information & Restock Quantity --}}
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
                    <label for="restock_quantity" class="block text-sm font-semibold text-gray-700">Restock Quantity</label>
                    <input type="number" id="restock_quantity" name="restock_quantity" 
                           class="mt-2 p-2 border border-gray-300 rounded-md w-full" 
                           min="1" >
                </div>

            </div>
        </div>

        {{-- BUTTONS --}}
        <div class="flex justify-between mt-4">
            {{-- LEFT SIDE — BACK --}}
            <a href="{{ route('stockIndex') }}"
               class="px-6 py-2 bg-gray-700 hover:bg-gray-800 text-white font-semibold rounded-lg shadow-md">
                Back
            </a>

            {{-- RIGHT SIDE — SUBMIT --}}
            <button type="submit" 
                    class="px-6 py-2 bg-primary text-white font-semibold rounded-lg shadow-md ">
                Restock
            </button>
        </div>
    </form>

@endsection
