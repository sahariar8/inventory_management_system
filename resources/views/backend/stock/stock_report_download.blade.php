{{-- <!DOCTYPE html>
<html>
<head>
    <title>Stock Report</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2 style="text-align:center;">Shahariar Shopping Mall</h2>
    <p style="text-align:center;">Mirpur 11.5, Dhaka-1216<br/>sahariaralam8@gmail.com</p>
    
    <h4>Stock Report</h4>
    <table>
        <thead>
            <tr>
                <th>Sl</th>
                <th>Supplier Name</th>
                <th>Unit</th>
                <th>Category</th>
                <th>Product Name</th>
                <th>In Qty</th>
                <th>Out Qty</th>
                <th>Stock</th>
            </tr>
        </thead>
        <tbody>
            @foreach($allData as $key => $item)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $item['supplier']['name'] }}</td>
                    <td>{{ $item['unit']['name'] }}</td>
                    <td>{{ $item['category']['name'] }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->in_qty }}</td>
                    <td>{{ $item->out_qty }}</td>
                    <td>{{ $item->quantity }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p>Printing Time: {{ \Carbon\Carbon::now()->toDayDateTimeString() }}</p>
</body>
</html> --}}

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Stock Report PDF</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            line-height: 1.4;
        }
        h3 {
            margin: 0;
            font-size: 20px;
        }
        .header, .footer {
            text-align: center;
        }
        .invoice-title {
            margin-bottom: 10px;
            text-align: left;
        }
        .address {
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        table th, table td {
            border: 1px solid #000;
            padding: 6px;
            text-align: center;
        }
        .footer-note {
            margin-top: 30px;
            font-style: italic;
        }
    </style>
</head>
<body>

    <div class="invoice-title">
        <h3>
            <img src="{{ public_path('backend/assets/images/logo-sm.png') }}" height="26" alt="logo" />
            <span style="margin-left: 10px;">Shahariar Shopping Mall</span>
        </h3>
    </div>

    <div class="address">
        <strong>Shahariar Shopping Mall</strong><br>
        Mirpur 11.5, Dhaka-1216<br>
        sahariaralam8@gmail.com
    </div>

    <table>
        <thead>
            <tr>
                <th>Sl</th>
                <th>Supplier Name</th>
                <th>Unit</th>
                <th>Category</th>
                <th>Product Name</th>
                <th>In Qty</th>
                <th>Out Qty</th>
                <th>Stock</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($allData as $key => $item)
                @php
                    $buying_total = App\Models\Purchase::where('category_id', $item->category_id)
                        ->where('product_id', $item->id)->where('status', 1)->sum('buying_qty');
                    
                    $selling_total = App\Models\InvoiceDetails::where('category_id', $item->category_id)
                        ->where('product_id', $item->id)->where('status', 1)->sum('selling_qty');
                @endphp
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $item['supplier']['name'] }}</td>
                    <td>{{ $item['unit']['name'] }}</td>
                    <td>{{ $item['category']['name'] }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $buying_total }}</td>
                    <td>{{ $selling_total }}</td>
                    <td>{{ $item->quantity }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer-note">
        @php
            $date = new DateTime('now', new DateTimeZone('Asia/Dhaka'));
        @endphp
        Printing Time: {{ $date->format('F j, Y, g:i a') }}
    </div>

</body>
</html>
