<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Invoice Pemesanan Permainan</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #111;
            margin: 0;
            padding: 0;
        }

        .invoice-box {
            width: 100%;
            padding: 24px;
        }

        /* ===== HEADER ===== */
        .header {
            width: 100%;
            border-bottom: 2px solid #000;
            margin-bottom: 20px;
            padding-bottom: 10px;
        }

        .header-table {
            width: 100%;
        }

        .brand {
            font-size: 18px;
            font-weight: bold;
        }

        .invoice-title {
            text-align: right;
            font-size: 20px;
            font-weight: bold;
        }

        /* ===== META ===== */
        .meta {
            width: 100%;
            margin-bottom: 20px;
        }

        .meta td {
            padding: 6px 4px;
            vertical-align: top;
        }

        .meta strong {
            width: 120px;
            display: inline-block;
        }

        /* ===== DETAIL TABLE ===== */
        .detail-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .detail-table th,
        .detail-table td {
            border: 1px solid #000;
            padding: 8px;
        }

        .detail-table th {
            background: #f0f0f0;
            text-align: left;
        }

        /* ===== FOOTER ===== */
        .footer {
            margin-top: 30px;
            font-size: 11px;
            text-align: center;
        }

        .signature {
            margin-top: 40px;
            text-align: right;
        }
    </style>
</head>

<body>

<div class="invoice-box">

    <!-- HEADER -->
    <div class="header">
        <table class="header-table">
            <tr>
                <td class="brand">Joy & Bites</td>
                <td class="invoice-title">INVOICE</td>
            </tr>
        </table>
    </div>

    <!-- META -->
    <table class="meta">
        <tr>
            <td><strong>ID Pemesanan</strong></td>
            <td>: {{ $pemesanan->id }}</td>
            <td><strong>ID Permainan</strong></td>
            <td>: {{ $pemesanan->permainan_id }}</td>
        </tr>
        <tr>
            <td><strong>Tanggal Pesan</strong></td>
            <td>: {{ \Carbon\Carbon::parse($pemesanan->created_at)->format('d M Y H:i') }}</td>
            <td><strong>Status</strong></td>
            <td>: {{ $pemesanan->ket }}</td>
        </tr>
    </table>

    <!-- DETAIL -->
    <table class="detail-table">
        <tr>
            <th width="35%">Nama Pemesan</th>
            <td>{{ $pemesanan->nama }}</td>
        </tr>
        <tr>
            <th>Tanggal Main</th>
            <td>{{ \Carbon\Carbon::parse($pemesanan->tanggal)->format('d M Y') }}</td>
        </tr>
        <tr>
            <th>Jam Mulai</th>
            <td>{{ $pemesanan->jam_mulai }}</td>
        </tr>
        <tr>
            <th>Jam Selesai</th>
            <td>{{ $pemesanan->jam_selesai }}</td>
        </tr>
        <tr>
            <th>Jumlah Pemain</th>
            <td>{{ $pemesanan->jumlah }}</td>
        </tr>
        <tr>
            <th>Detail</th>
            <td>{{ $pemesanan->detail }}</td>
        </tr>
    </table>

    <!-- FOOTER -->
    <div class="footer">
        Invoice ini sah dan dibuat secara otomatis.<br>
        Terima kasih telah melakukan pemesanan di <strong>Joy & Bites</strong>.
    </div>

    <div class="signature">
        <strong>Joy & Bites</strong><br>
        (Admin)
    </div>

</div>

</body>
</html>
