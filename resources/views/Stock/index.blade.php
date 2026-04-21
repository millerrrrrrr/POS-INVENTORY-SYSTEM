@extends('layout')
@section('title', 'Stock Management')
@section('pagetitle', 'Stock Management')

@section('main')

    <form method="GET" action="{{ route('stockIndex') }}" class="mb-4">
        <div class="flex gap-2 items-center text-white">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search product..."
                class="input input-bordered w-full max-w-xs">

            <select name="category" class="select select-bordered w-3xs text-white">
                <option disabled selected value="">All Categories</option>
                @foreach ($categories as $cat)
                    <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>
                        {{ $cat }}
                    </option>
                @endforeach
            </select>

            <button type="submit" class="btn btn-primary">
                Search
            </button>

            @if (request()->has('search') && request('search') !== '')
                <a href="{{ route('stockIndex') }}" class="btn bg-red-500 hover:bg-red-600 text-white border-none">
                    Clear
                </a>
            @endif
        </div>
    </form>

    <div class="overflow-x-auto">
        <table class="table table-xs">
            <thead class="text-black">
                <tr>
                    <th class="text-center">Image</th>
                    <th class="text-center">Product Name</th>
                    <th class="text-center">Category</th>
                    <th class="text-center">Stock</th>
                    <th class="text-center">Restock</th>
                </tr>
            </thead>
            <tbody class="font-semibold">
                @forelse ($products as $pro)
                    <tr
                        @if ($pro->stock == 0) class="bg-red-100 text-red-800 font-semibold"
                @elseif($pro->stock <= $lowStockLevel)
                    class="bg-yellow-100 text-yellow-800 font-semibold" @endif>
                        {{-- IMAGE --}}
                        <td class="flex justify-center">
                            @if ($pro->image)
                                <img src="{{ asset('storage/' . $pro->image) }}" alt="{{ $pro->name }}"
                                    class="w-16 h-16 object-cover rounded-md">
                            @else
                                <div
                                    class="w-16 h-16 bg-gray-200 rounded-md flex items-center justify-center text-gray500 text-cs text-center">
                                    <p>No image</p>
                                </div>
                            @endif
                        </td>

                        {{-- NAME --}}
                        <td class="text-center">{{ $pro->name }}</td>

                        {{-- CATEGORY --}}
                        <td class="text-center">{{ $pro->category }}</td>

                        {{-- STOCK --}}
                        <td class="text-center">
                            @if ($pro->stock == 0)
                                <span class="px-2 py-1 bg-red-200 text-red-900 rounded-md font-bold">Out of Stock</span>
                            @elseif ($pro->stock <= $lowStockLevel)
                                <span
                                    class="px-2 py-1 bg-yellow-200 text-yellow-900 rounded-md font-bold">{{ $pro->stock }}
                                    (Low)
                                </span>
                            @else
                                {{ $pro->stock }}
                            @endif
                        </td>

                        {{-- ACTION --}}
                        <td>
                            <div class="flex items-center gap-3 justify-center">



                                {{-- Restock --}}
                                <a href=" {{ route('restockIndex', $pro->id) }} "
                                    class="bg-gray-700 hover:bg-gray-800 p-2 rounded-md text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                    </svg>

                                </a>


                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-6 text-gray-500 bg-gray-200 font-semibold">
                            No Item Found
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">
            {{ $products->links('vendor.pagination.simple-tailwind') }}
        </div>
    </div>

@endsection
