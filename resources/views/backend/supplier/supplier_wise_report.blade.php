<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Supplier Stock Report PDF</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid black;
            text-align: center;
            padding: 5px;
        }
        h3, strong {
            margin: 0;
        }
        .text-end {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
    </style>
</head>
<body>

    <div>
        <h3>
            <img src="{{ public_path('backend/assets/images/logo-sm.png') }}" height="26" alt="Logo">
            <span>Shahariar Shopping Mall</span>
        </h3>
        <hr>
    </div>

    <div style="margin-top: 10px;">
        <div style="width: 50%; float: left;">
            <strong>Shahariar Shopping Mall</strong><br>
            Mirpur 11.5, Dhaka-1216<br>
            sahariaralam8@gmail.com
        </div>
        <div style="width: 50%; float: right;" class="text-end">
            {{-- Add anything else if needed --}}
        </div>
    </div>

    <div style="clear: both;"></div>

    <h3 class="text-center" style="margin-top: 30px;">
        <strong>Supplier Name: </strong>{{ $allData['0']['supplier']['name'] }}
    </h3>

    <table>
        <thead>
            <tr>
                <th>Sl</th>
                <th>Supplier Name</th>
                <th>Unit</th>
                <th>Category</th>
                <th>Product Name</th>
                <th>Stock</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($allData as $key => $item)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $item['supplier']['name'] }}</td>
                    <td>{{ $item['unit']['name'] }}</td>
                    <td>{{ $item['category']['name'] }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->quantity }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @php
        $date = new DateTime('now', new DateTimeZone('Asia/Dhaka'));
    @endphp

    <p style="margin-top: 20px;"><i>Printing Time: {{ $date->format('F j, Y, g:i a') }}</i></p>

</body>
</html>
