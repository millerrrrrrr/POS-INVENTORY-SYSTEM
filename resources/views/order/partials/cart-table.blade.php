@if (session('cart') && count(session('cart')) > 0)
<table class="table w-full">
    <thead>
        <tr>
            <th>Product</th>
            <th>Qty</th>
            <th>Price</th>
            <th>Subtotal</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @php $total = 0; @endphp
        @foreach (session('cart') as $id => $details)
            @php
                $subtotal = $details['price'] * $details['quantity'];
                $total += $subtotal;
            @endphp
            <tr>
                <td>{{ $details['name'] }}</td>
                <td>
                    <form action="{{ route('cart.update', $id) }}" method="POST" class="update-cart-form">
                        @csrf
                        @method('PUT')
                        <input type="number" name="quantity" value="{{ $details['quantity'] }}"
                            min="1" class="input input-bordered w-16 cart-qty">
                    </form>
                </td>
                <td>{{ number_format($details['price'], 2) }}</td>
                <td>{{ number_format($subtotal, 2) }}</td>
                <td>
                    <form action="{{ route('cart.remove', $id) }}" method="POST" class="remove-cart-form">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-error text-white">X</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@else
<p class="text-gray-500">Cart is empty</p>
@endif
