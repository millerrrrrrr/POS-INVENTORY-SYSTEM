@extends('layout')
@section('title', 'Point of Sale')
@section('pagetitle', 'Point of Sale')

@section('main')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-4 p-4 text-white">

    <!-- LEFT SIDE: SEARCH & PRODUCTS -->
    <div class="lg:col-span-2 space-y-4">

        <!-- BARCODE SCAN -->
        <div class="card bg-base-100 shadow">
            <div class="card-body">
                <h2 class="card-title">Scan Barcode</h2>
                <form id="barcode-form" method="POST" action="{{ route('cart.addByBarcode') }}" class="flex gap-2">
                    @csrf
                    <input type="text" name="barcode" placeholder="Scan or type barcode"
                           class="input input-bordered w-full focus:outline-none" autofocus>
                    <button class="btn btn-primary">Add</button>
                </form>
            </div>
        </div>

        <!-- SEARCH PRODUCTS -->
        <div class="card bg-base-100 shadow">
            <div class="card-body">
                <h2 class="card-title">Search Products</h2>

                <form method="GET" action="{{ route('orderIndex') }}" class="flex gap-2">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search product..."
                        class="input input-bordered w-full focus:outline-none">
                    <button class="btn btn-primary">Search</button>
                </form>

                <!-- PRODUCT LIST -->
                @if($products->count() > 0)
                <div class="overflow-y-auto max-h-80 mt-4">
                    <table class="table table-zebra">
                        <thead class="bg-base-100 sticky top-0 z-10">
                            <tr>
                                <th>Image</th>
                                <th>Barcode</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Description</th>
                                <th>Stock</th>
                                <th>Price</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="product-table-body">
                            @include('order.partials.product-table', ['products' => $products])
                        </tbody>
                    </table>
                </div>
                @elseif(request('search'))
                <p class="text-gray-500 mt-4">No products found for "{{ request('search') }}"</p>
                @endif
            </div>
        </div>

        <!-- CART -->
        <div class="card bg-base-100 shadow">
            <div class="card-body">
                <h2 class="card-title">Cart</h2>

                @if (session('cart') && count(session('cart')) > 0)
                    <table class="table">
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
                            @php $subtotal = 0; @endphp
                            @foreach (session('cart') as $id => $details)
                                @php
                                    $itemSubtotal = $details['price'] * $details['quantity'];
                                    $subtotal += $itemSubtotal;
                                @endphp
                                <tr>
                                    <td>{{ $details['name'] }}</td>
                                    <td>
                                        <form action="{{ route('cart.update', $id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="number" name="quantity" value="{{ $details['quantity'] }}"
                                                min="1" class="input input-bordered w-16 cart-qty">
                                        </form>
                                    </td>
                                    <td>{{ number_format($details['price'], 2) }}</td>
                                    <td>{{ number_format($itemSubtotal, 2) }}</td>
                                    <td>
                                        <form action="{{ route('cart.remove', $id) }}" method="POST">
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

            </div>
        </div>
    </div>

    <!-- RIGHT SIDE: PAYMENT -->
    <div class="space-y-4">
        <div class="card bg-base-100 shadow">
            <div class="card-body">
                <h2 class="card-title">Payment</h2>

                @php
                    $vatRate = 0.12;
                    $vatAmount = $subtotal * $vatRate;
                    $totalWithVat = $subtotal + $vatAmount;
                @endphp

                <div class="text-lg font-semibold mb-2">
                    Subtotal: ₱ {{ number_format($subtotal, 2) }}
                </div>
                <div class="text-lg font-semibold mb-2">
                    VAT (12%): ₱ {{ number_format($vatAmount, 2) }}
                </div>
                <div class="text-xl font-bold mb-4">
                    Total: ₱ {{ number_format($totalWithVat, 2) }}
                </div>

                <form id="checkout-form" action="{{ route('cart.checkout') }}" method="POST">
                    @csrf
                    <input type="hidden" name="total_with_vat" value="{{ $totalWithVat }}">
                    <label class="label mt-4">Cash Received</label>
                    <input type="number" step="0.01" name="cash"
                        class="input input-bordered w-full focus:outline-none" required>
                    <button type="submit" id="checkout-button" class="btn btn-primary mt-4 w-full">Complete Transaction</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // AJAX live search
    document.querySelector("input[name='search']").addEventListener("keyup", function() {
        let search = this.value;

        fetch(`{{ route('order.ajaxSearch') }}?search=${search}`)
            .then(response => response.text())
            .then(html => {
                document.getElementById("product-table-body").innerHTML = html;
            });
    });

    // Update cart quantity
    document.addEventListener("change", function(e) {
        if (e.target.classList.contains("cart-qty")) {
            let form = e.target.closest("form");
            let formData = new FormData(form);

            fetch(form.action, {
                method: "POST",
                body: formData
            }).then(() => {
                location.reload(); // refresh totals
            });
        }
    });

    // Submit barcode on Enter
    document.querySelector("input[name='barcode']").addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            this.form.submit();
        }
    });
</script>
@endsection