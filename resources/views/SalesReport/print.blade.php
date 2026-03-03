<!DOCTYPE html>
<html>
<head>
    <title>Sales Report</title>
    <style>
        @page { size: A4; margin: 20mm; }
        body { font-family: Arial, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: center; }
        th { background-color: #f0f0f0; }
        tfoot th { text-align: right; }
        .text-left { text-align: left; }
    </style>
</head>
<body>
    <h2>Sales Report</h2>
    <p>
        @if(request('from_date')) From: {{ request('from_date') }} @endif
        @if(request('to_date')) To: {{ request('to_date') }} @endif
    </p>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Date</th>
                <th>Total (VAT Inc.)</th>
                <th>Cash</th>
                <th>Change</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->order_date }}</td>
                    <td>{{ $order->total }}</td>
                    <td>{{ $order->cash }}</td>
                    <td>{{ $order->change }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No sales found</td>
                </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <th colspan="2" class="text-left">Total</th>
                <th>{{ $orders->sum('total') }}</th>
                <th>{{ $orders->sum('cash') }}</th>
                <th>{{ $orders->sum('change') }}</th>
            </tr>
        </tfoot>
    </table>

    <script>
        window.onload = function() { window.print(); }
    </script>
</body>
</html>