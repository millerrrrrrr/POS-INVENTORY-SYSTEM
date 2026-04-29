<!DOCTYPE html>
<html>
<head>
    <title>Low Stock Report</title>
    <style>
        body { font-family: Arial; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid black; padding: 8px; text-align: center; }
        th { background: #eee; }
    </style>
</head>
<body onload="window.print()">

    <h2 style="text-align:center;">Low Stock / Out of Stock Report</h2>

    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Category</th>
                <th>Description</th>
                <th>Stock</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $pro)
                <tr>
                    <td>{{ $pro->name }}</td>
                    <td>{{ $pro->category }}</td>
                    <td>{{ $pro->description }}</td>
                    <td>
                        @if($pro->stock == 0)
                            Out of Stock
                        @else
                            {{ $pro->stock }} (Low)
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>