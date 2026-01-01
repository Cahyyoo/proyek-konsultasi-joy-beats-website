<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Invoice Pemesanan Permainan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #ff8c00;
            --dark: #0f1a2a;
            --muted: #6b7280;
            --border: #e5e7eb;
            --bg-soft: #f9fafb;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: #f4f6f9;
            padding: 32px;
            color: #1f2937;
        }

        .invoice-box {
            max-width: 820px;
            margin: auto;
            background: #ffffff;
            padding: 36px;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        }

        /* ================= HEADER ================= */
        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-bottom: 18px;
            border-bottom: 2px solid var(--border);
            margin-bottom: 28px;
        }

        .brand {
            font-size: 22px;
            font-weight: 700;
            color: var(--dark);
            letter-spacing: 0.5px;
        }

        .invoice-title {
            font-size: 26px;
            font-weight: 700;
            color: var(--primary);
        }

        /* ================= META ================= */
        .invoice-meta {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 14px;
            margin-bottom: 30px;
        }

        .meta-card {
            background: var(--bg-soft);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 14px;
            font-size: 13px;
        }

        .meta-card strong {
            display: block;
            font-size: 12px;
            color: var(--muted);
            margin-bottom: 6px;
            text-transform: uppercase;
        }

        /* ================= TABLE ================= */
        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            border: 1px solid var(--border);
            border-radius: 14px;
            overflow: hidden;
            background: #fff;
        }

        table tr:not(:last-child) td,
        table tr:not(:last-child) th {
            border-bottom: 1px solid var(--border);
        }

        th {
            width: 35%;
            background: var(--bg-soft);
            padding: 14px 16px;
            text-align: left;
            font-size: 13px;
            color: var(--muted);
            font-weight: 600;
        }

        td {
            padding: 14px 16px;
            font-size: 14px;
            font-weight: 500;
            color: #111827;
        }

        /* ================= STATUS ================= */
        .status {
            display: inline-block;
            padding: 6px 14px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 600;
            background: #dcfce7;
            color: #166534;
        }

        /* ================= FOOTER ================= */
        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 13px;
            color: var(--muted);
            border-top: 1px dashed var(--border);
            padding-top: 18px;
        }

        /* ================= BUTTON ================= */
        .btn-print {
            display: inline-block;
            margin-top: 28px;
            padding: 12px 28px;
            border-radius: 12px;
            background: linear-gradient(135deg, #ff8c00, #ff6f00);
            color: #fff;
            font-weight: 600;
            text-decoration: none;
            box-shadow: 0 8px 18px rgba(255,140,0,0.4);
        }

        /* ================= PRINT ================= */
        @media print {
            body {
                background: #fff;
                padding: 0;
            }

            .invoice-box {
                box-shadow: none;
                border-radius: 0;
            }

            .btn-print {
                display: none;
            }
        }

        /* ================= RESPONSIVE ================= */
        @media (max-width: 768px) {
            body {
                padding: 16px;
            }

            .invoice-box {
                padding: 24px;
            }

            .invoice-meta {
                grid-template-columns: repeat(2, 1fr);
            }
        }
    </style>
</head>

<body>

<div class="invoice-box">

    <!-- HEADER -->
    <div class="invoice-header">
        <div class="brand">Joy & Bites</div>
        <div class="invoice-title">INVOICE</div>
    </div>

    <!-- META -->
    <div class="invoice-meta">
        <div class="meta-card">
            <strong>ID Pemesanan</strong>
            {{ $pemesanan->id }}
        </div>
        <div class="meta-card">
            <strong>ID Permainan</strong>
            {{ $pemesanan->permainan_id }}
        </div>
        <div class="meta-card">
            <strong>Tanggal Pesan</strong>
            {{ \Carbon\Carbon::parse($pemesanan->created_at)->format('d M Y H:i') }}
        </div>
        <div class="meta-card">
            <strong>Status</strong>
            <span class="status">{{ $pemesanan->ket }}</span>
        </div>
    </div>

    <!-- DETAIL TABLE -->
    <table>
        <tbody>
            <tr>
                <th>Nama Pemesan</th>
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
                <th>Jumlah Harga</th>
                <td>{{ $pemesanan->jumlah }}</td>
            </tr>
            <tr>
                <th>Detail</th>
                <td>{{ $pemesanan->detail }}</td>
            </tr>
        </tbody>
    </table>

    <!-- FOOTER -->
    <div class="footer">
        Terima kasih telah melakukan pemesanan permainan di
        <strong>Joy & Bites</strong> 🎮<br>
        Invoice ini sah dan dibuat secara otomatis.
    </div>

    <center>
        <a href="{{ route('booking.invoice.pdf', $pemesanan->id) }}" class="btn-print">
            ⬇ Download PDF
        </a>
    </center>

</div>

</body>
</html>
