@foreach ($products as $product)
<tr>
    <td>
        @if ($product->image)
            <img src="{{ asset('storage/' . $product->image) }}" class="w-16 h-16 object-cover rounded-md">
        @else
            <div class="w-16 h-16 bg-gray-200 rounded-md flex items-center justify-center text-black">
                No image
            </div>
        @endif
    </td>

    <td>{{ $product->name }}</td>
    <td>{{ $product->category }}</td>
    <td>{{ $product->description }}</td>
    <td>{{ $product->stock }}</td>
    <td>{{ number_format($product->salePrice, 2) }}</td>
    <td>
        <form action="{{ route('cart.add', $product->id) }}" method="POST">
            @csrf
            <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}"
                class="input input-bordered w-16">
            <button class="btn btn-sm btn-success mt-1">Add</button>
        </form>
    </td>
</tr>
@endforeach
