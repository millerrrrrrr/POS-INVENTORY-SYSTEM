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
                    <form method="GET" action="{{ route('orderIndex') }}" class="flex gap-2">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search product..."
                            class="input input-bordered w-full focus:outline-none">
                        <button class="btn btn-primary">Search</button>
                    </form>

                    <!-- PRODUCT LIST -->
                    @if ($products->count() > 0)
                        <div class="overflow-y-auto max-h-[500px] mt-4">
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
                                        <th>Qty</th>
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

        </div>

        <!-- RIGHT SIDE: CART + PAYMENT -->
        <div class="space-y-4">

            <!-- CART (TOP RIGHT) -->
            <div class="card bg-base-100 shadow">
                <div class="card-body">
                    <div class="flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                        </svg>
                        <h2 class="card-title">Cart</h2>
                    </div>


                    @if (session('cart') && count(session('cart')) > 0)
                        <div class="overflow-y-auto max-h-64">
                            <table class="table">
                                <thead class="bg-base-100 sticky top-0 z-10">
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
                        </div>
                    @else
                        @php $subtotal = 0; @endphp
                        <p class="text-gray-500">Cart is empty</p>
                    @endif

                </div>
            </div>

            <!-- PAYMENT (BOTTOM RIGHT) -->
            <div class="card bg-base-100 shadow">
                <div class="card-body">
                    <h2 class="card-title">Payment</h2>

                    @php
                        $total = $subtotal ?? 0;
                    @endphp

                    <div class="text-2xl font-bold mb-4">
                        Total (VAT Inc.): ₱ {{ number_format($total, 2) }}
                    </div>

                    <form id="checkout-form" action="{{ route('cart.checkout') }}" method="POST">
                        @csrf

                        <label class="label mt-4">Cash Received</label>
                        <input type="number" step="0.01" name="cash"
                            class="input input-bordered w-full focus:outline-none" required>

                        <label class="label mt-4">Change</label>
                        <input type="text" id="change" class="input input-bordered focus:outline-none w-full "
                            readonly value="₱ 0.00">

                        <button type="submit" class="btn btn-primary mt-4 w-full">
                            Complete Transaction
                        </button>
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
                    location.reload();
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


    {{-- change script --}}
    <script>
        const cashInput = document.querySelector("input[name='cash']");
        const changeInput = document.getElementById("change");

        // Get total from Blade
        const total = {{ $total ?? 0 }};

        function formatPeso(amount) {
            return "₱ " + amount.toLocaleString(undefined, {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });
        }

        cashInput.addEventListener("input", function() {
            let cash = parseFloat(this.value) || 0;
            let change = cash - total;

            // Show value (including negative)
            changeInput.value = formatPeso(change);

            // 🎨 Visual feedback
            if (change < 0) {
                changeInput.classList.remove("text-green-600");
                changeInput.classList.add("text-red-600");
            } else {
                changeInput.classList.remove("text-red-600");
                changeInput.classList.add("text-green-600");
            }
        });
    </script>

@endsection
