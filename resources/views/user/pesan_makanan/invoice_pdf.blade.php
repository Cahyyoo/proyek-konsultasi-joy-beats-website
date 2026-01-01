<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Invoice - Joy & Bites</title>

    <style>
        @page {
            size: A4;
            margin: 30px;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 13px;
            color: #000;
            margin: 0;
            padding: 0;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        /* ===== HEADER ===== */
        .header-table td {
            padding-bottom: 12px;
            border-bottom: 2px solid #000;
        }

        .brand {
            font-size: 20px;
            font-weight: bold;
        }

        .invoice-title {
            text-align: right;
            font-size: 22px;
            font-weight: bold;
            letter-spacing: 1px;
        }

        /* ===== META ===== */
        .meta-table td {
            padding: 4px 0;
        }

        .meta-label {
            width: 140px;
            font-weight: bold;
        }

        /* ===== ITEM TABLE ===== */
        .item-table th,
        .item-table td {
            border: 1px solid #ccc;
            padding: 8px;
        }

        .item-table th {
            background: #f2f2f2;
            font-weight: bold;
        }

        .text-right {
            text-align: right;
        }

        /* ===== TOTAL ===== */
        .total-table {
            width: 40%;
            margin-left: auto;
            margin-top: 20px;
            border: 1px solid #000;
        }

        .total-table td {
            padding: 8px;
        }

        .total-table tr:last-child td {
            font-weight: bold;
            border-top: 1px solid #000;
        }

        /* ===== FOOTER ===== */
        .footer {
            margin-top: 50px;
            text-align: center;
            font-size: 12px;
            border-top: 1px solid #ccc;
            padding-top: 10px;
            color: #444;
        }
    </style>
</head>
<body>

<!-- HEADER -->
<table class="header-table">
    <tr>
        <td class="brand">Joy and Bites</td>
        <td class="invoice-title">INVOICE</td>
    </tr>
</table>

<br>

<!-- META -->
<table class="meta-table">
    <tr>
        <td class="meta-label">Kode Transaksi</td>
        <td>: {{ $transaksi->first()->kode_transaksi }}</td>
    </tr>
    <tr>
        <td class="meta-label">Tanggal</td>
        <td>: {{ $transaksi->first()->created_at->format('d M Y H:i') }}</td>
    </tr>
    <tr>
        <td class="meta-label">Status</td>
        <td>: {{ $transaksi->first()->ket }}</td>
    </tr>
</table>

<br>

<!-- ITEM -->
<table class="item-table">
    <thead>
        <tr>
            <th width="5%">No</th>
            <th width="45%">Item</th>
            <th width="10%">Qty</th>
            <th width="20%" class="text-right">Harga</th>
            <th width="20%" class="text-right">Subtotal</th>
        </tr>
    </thead>
    <tbody>
        @php $total = 0; @endphp
        @foreach ($transaksi as $i => $row)
            @php $total += $row->jumlah_harga; @endphp
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $row->detail }}</td>
                <td>{{ $row->qty }}</td>
                <td class="text-right">
                    Rp {{ number_format($row->jumlah_harga / $row->qty, 0, ',', '.') }}
                </td>
                <td class="text-right">
                    Rp {{ number_format($row->jumlah_harga, 0, ',', '.') }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<!-- TOTAL -->
<table class="total-table">
    <tr>
        <td>Total</td>
        <td class="text-right">
            Rp {{ number_format($total, 0, ',', '.') }}
        </td>
    </tr>
    <tr>
        <td>Pajak (10%)</td>
        <td class="text-right">
            Rp {{ number_format($total * 0.1, 0, ',', '.') }}
        </td>
    </tr>
    <tr>
        <td>Grand Total</td>
        <td class="text-right">
            Rp {{ number_format($total * 1.1, 0, ',', '.') }}
        </td>
    </tr>
</table>

<!-- FOOTER -->
<div class="footer">
    Terima kasih telah memesan di <strong>Joy & Bites</strong><br>
    Invoice ini sah tanpa tanda tangan.
</div>

</body>
</html>
