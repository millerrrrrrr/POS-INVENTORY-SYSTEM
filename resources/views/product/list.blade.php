@extends('layout')
@section('title', 'Product List')
@section('pagetitle', 'Product List')

@section('main')

    <form method="GET" action="{{ route('productList') }}" class="mb-4">
    <div class="flex gap-2 items-center text-white">
        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Search product..."
            class="input input-bordered w-full max-w-xs"
        >

        <button type="submit" class="btn btn-primary">
            Search
        </button>

        {{-- ✅ Clear Button --}}
        @if(request()->has('search') && request('search') !== '')
            <a href="{{ route('productList') }}" class="btn bg-red-500 hover:bg-red-600 text-white border-none">
                Clear
            </a>
        @endif
    </div>
</form>

    <div class="overflow-x-auto">
        <table class="table table-s">
            <thead class="text-black">
                <tr>
                    <th class="text-center">Image</th>
                    <th class="text-center">Barcode</th>
                    <th class="text-center">Product Name</th>
                    <th class="text-center">Category</th>
                    <th class="text-center">Description</th>
                    <th class="text-center">Stock</th>
                    <th class="text-center">Purchase Price</th>
                    <th class="text-center">Sale Price</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $pro)
                    <tr>
                        <td class="flex justify-center">
                            @if ($pro->image)
                                <img src=" {{ asset('storage/' . $pro->image) }} " alt=" {{ $pro->name }} "
                                    class="w-16 h-16 object-cover rounded-md ">
                            @else
                                <div
                                    class="w-16 h-16 bg-gray-200  rounded-md flex items-center justify-center text-gray500 text-cs text-center">
                                    <p>No image</p>
                                </div>
                            @endif
                        </td>
                        <td class="text-center">
                            @if ($pro->barcode)
                                <div class="flex flex-col items-center justify-center">
                                    <img src="data:image/png;base64,{{ DNS1D::getBarcodePNG($pro->barcode, 'C128', 1.5, 40) }}"
                                        alt="barcode" class="mx-auto">
                                    <span class="font-mono text-xs mt-1">{{ $pro->barcode }}</span>
                                </div>
                            @else
                                <span class="text-gray-400">No barcode</span>
                            @endif
                        </td>

                        <td class="text-center">{{ $pro->name }}</td>
                        <td class="text-center">{{ $pro->category }}</td>
                        <td class="text-center">{{ $pro->description }}</td>
                        <td class="text-center">{{ $pro->stock }}</td>
                        <td class="text-center">{{ $pro->purchasePrice }}</td>
                        <td class="text-center">{{ $pro->salePrice }}</td>
                        <td>
                            <div class="flex items-center gap-3 justify-center">

                                {{-- View --}}
                                <a href=" {{ route('viewProduct', $pro->id) }} "
                                    class="bg-gray-700 hover:bg-gray-800 p-2 rounded-md text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </a>

                                {{-- Edit --}}
                                <a href=" {{ route('editProduct', $pro->id) }} "
                                    class="bg-gray-700 hover:bg-gray-800 p-2 rounded-md text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M16.862 3.487a2.25 2.25 0 113.182 3.183L7.5 19.214 3 21l1.786-4.5L16.862 3.487z" />
                                    </svg>
                                </a>

                                {{-- Delete --}}
                                <form action=" {{ route('deleteProduct', $pro->id) }} " method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-gray-700 hover:bg-gray-800 p-2 rounded-md text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673A2.25 2.25 0 0115.916 21H8.084a2.25 2.25 0 01-2.244-2.327L5.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.02-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                        </svg>
                                    </button>
                                </form>

                            </div>
                        </td>


                    </tr>


                @empty
                    <td>No Item Found</td>
                @endforelse

            </tbody>
        </table>
        <div class="mt-4">
            {{ $products->links('vendor.pagination.simple-tailwind') }}
        </div>
    </div>

@endsection
