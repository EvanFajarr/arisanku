<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Tarik Saldo</title>
    <style>
        /* Gaya CSS khusus untuk tampilan PDF */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .invoice-container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table th, .table td {
            border: 1px solid #ccc;
            padding: 8px;
        }
        .table th {
            background-color: #f2f2f2;
            text-align: left;
        }
        .footer {
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="invoice-container">
        <div class="header">
            <h1>Invoice Tarik Saldo</h1>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Nominal</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @php $i = 1 @endphp
                @foreach ($tabungan->detailTabungan as $detail)
                <tr>

                    <td>{{ $i++ }}</td>
                    <td>{{ $tabungan->tabungan->name }}</td>
                    <td>{{ number_format($detail->nominal) }}.000</td>
                    <td>{{ $detail->created_at->format('d/m/Y') }}</td>

                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2"></td>
                    <td><strong>Total:</strong></td>
                    <td>{{ number_format($totalNominal) }}.000</td>
                </tr>
            </tfoot>
        </table>

    </div>
</body>
</html>
