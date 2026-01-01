<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Invoice - Joy & Bites</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
    body {
        font-family: 'Poppins', sans-serif;
        background: #f4f6f9;
        padding: 30px;
        color: #333;
    }

    .invoice-box {
        max-width: 800px;
        margin: auto;
        background: #ffffff;
        padding: 32px;
        border-radius: 14px;
        box-shadow: 0 8px 24px rgba(0,0,0,0.08);
    }

    /* ===== HEADER ===== */
    .invoice-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 2px solid #f1f1f1;
        padding-bottom: 16px;
        margin-bottom: 20px;
    }

    .invoice-header div:first-child {
        font-size: 20px;
        font-weight: 700;
        color: #0f1a2a;
    }

    .invoice-title {
        font-size: 22px;
        font-weight: 700;
        color: #ff8c00;
        letter-spacing: 1px;
    }

    /* ===== META ===== */
    .invoice-meta {
        margin-top: 10px;
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 14px;
        font-size: 14px;
        background: #fafafa;
        padding: 16px;
        border-radius: 10px;
    }

    .invoice-meta strong {
        color: #555;
    }

    /* ===== TABLE ===== */
    table {
        width: 100%;
        margin-top: 25px;
        border-collapse: collapse;
    }

    table thead {
        background: #ffcc00;
    }

    table th {
        padding: 12px;
        font-size: 14px;
        font-weight: 600;
        color: #333;
        text-transform: uppercase;
    }

    table td {
        padding: 12px;
        font-size: 14px;
        border-bottom: 1px solid #eee;
    }

    table tbody tr:last-child td {
        border-bottom: none;
    }

    .text-right {
        text-align: right;
    }

    /* ===== TOTAL ===== */
    .total-box {
        margin-top: 25px;
        display: flex;
        justify-content: flex-end;
    }

    .total-card {
        width: 320px;
        background: #f9fafb;
        border-radius: 12px;
        padding: 16px;
        border: 1px solid #eee;
    }

    .total-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
        font-size: 14px;
    }

    .total-row.total {
        font-weight: 700;
        font-size: 16px;
        color: #ff8c00;
        border-top: 1px dashed #ddd;
        padding-top: 10px;
    }

    /* ===== FOOTER ===== */
    .invoice-footer {
        margin-top: 40px;
        text-align: center;
        font-size: 13px;
        color: #777;
        border-top: 1px solid #eee;
        padding-top: 15px;
    }

    /* ===== BUTTON ===== */
    .btn-print {
        display: inline-block;
        margin-top: 30px;
        padding: 12px 26px;
        border-radius: 10px;
        background: linear-gradient(135deg, #ff8c00, #ff6f00);
        color: #fff;
        font-weight: 600;
        text-decoration: none;
        transition: 0.2s;
    }

    .btn-print:hover {
        opacity: 0.9;
    }

    /* ===== PRINT / PDF ===== */
    @media print {
        body {
            background: #fff;
            padding: 0;
        }
        .btn-print {
            display: none;
        }
        .invoice-box {
            box-shadow: none;
            border-radius: 0;
        }
    }

    /* ===== RESPONSIVE ===== */

    @media (max-width: 768px) {

        body {
            padding: 15px;
        }

        .invoice-box {
            padding: 20px;
        }

        /* Header jadi vertical */
        .invoice-header {
            flex-direction: flex;
            align-items: flex-start;
            gap: 8px;
        }

        .invoice-title {
            font-size: 20px;
        }

        /* Meta jadi 1 kolom */
        .invoice-meta {
            grid-template-columns: 2fr;
            gap: 10px;
            font-size: 13px;
        }

        /* Table scroll */
        table {
            /* display: block; */
            width: 100%;
            overflow-x: auto;
            white-space: nowrap;
        }

        table th,
        table td {
            font-size: 13px;
            padding: 10px;
        }

        /* Total full width */
        .total-box {
            justify-content: center;
        }

        .total-card {
            width: 100%;
        }

        .btn-print {
            width: 70vw;
            text-align: center;
            padding: 14px;
            font-size: 14px;
        }
    }


    /* ===== MOBILE SMALL ===== */
    /* @media (max-width: 480px) {

        .invoice-header div:first-child {
            font-size: 18px;
        }

        .invoice-title {
            font-size: 18px;
        }

        table th,
        table td {
            font-size: 12px;
        }

        .total-row {
            font-size: 13px;
        }

        .total-row.total {
            font-size: 15px;
        }

        .btn-print {
            max-width: 60vw;
        }
    } */

</style>

</head>
<body>

<div class="invoice-box">

    {{-- HEADER --}}
    <div class="invoice-header invoice-title">
        <div>
            {{-- <img src="{{ asset('pesan_tempat/logo.png') }}" alt="Joy & Bites"> --}}
            Joy and Bites
        </div>
        <div class="invoice-title">
            INVOICE
        </div>
    </div>

    {{-- META --}}
    <div class="invoice-meta">
        <div>
            <strong>Kode Transaksi:</strong><br>
            {{ $transaksi->first()->kode_transaksi }}
        </div>
        <div>
        </div>
        <div>
            <strong>Tanggal:</strong><br>
            {{ $transaksi->first()->created_at->format('d M Y H:i') }}
        </div>
        <div>
            <strong>Status:</strong><br>
            {{ $transaksi->first()->ket }}
        </div>
    </div>

    {{-- TABLE --}}
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Item</th>
                <th>Qty</th>
                <th class="text-right">Harga</th>
                <th class="text-right">Subtotal</th>
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
                        Rp {{ number_format($row->jumlah_harga / $row->qty,0,',','.') }}
                    </td>
                    <td class="text-right">
                        Rp {{ number_format($row->jumlah_harga,0,',','.') }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- TOTAL --}}
    <div class="total-box">
        <div class="total-card">
            <div class="total-row">
                <span>Total</span>
                <span>Rp {{ number_format($total,0,',','.') }}</span>
            </div>
            <div class="total-row">
                <span>Pajak (10%)</span>
                <span>Rp {{ number_format($total * 0.1,0,',','.') }}</span>
            </div>
            <div class="total-row total">
                <span>Grand Total</span>
                <span>Rp {{ number_format($total * 1.1,0,',','.') }}</span>
            </div>
        </div>
    </div>

    {{-- FOOTER --}}
    <div class="invoice-footer">
        Terima kasih telah memesan di <strong>Joy & Bites</strong> 💛<br>
        Invoice ini sah tanpa tanda tangan.
    </div>

    <center>
        <a href="{{ route('invoice.download', $transaksi->first()->kode_transaksi) }}" class="btn-print">
            ⬇ Download PDF
        </a>
    </center>

</div>

</body>
</html>
