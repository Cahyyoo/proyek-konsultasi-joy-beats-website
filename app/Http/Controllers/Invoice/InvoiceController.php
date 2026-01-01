<?php

namespace App\Http\Controllers\Invoice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\pemesanan_makanan;
use App\Models\pemesanan_permainan;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    public function show($kode_transaksi)
    {
        // Ambil semua item transaksi berdasarkan barcode
        $transaksi = pemesanan_makanan::where('kode_transaksi', $kode_transaksi)->get();

        // Jika tidak ada data
        if ($transaksi->isEmpty()) {
            abort(404, 'Invoice tidak ditemukan');
        }

        return view('user.pesan_makanan.invoice', [
            'transaksi' => $transaksi
        ]);
    }

    public function download($kode_transaksi)
    {
        $transaksi = pemesanan_makanan::where('kode_transaksi', $kode_transaksi)->get();

        if ($transaksi->isEmpty()) {
            abort(404, 'Invoice tidak ditemukan');
        }

        $pdf = Pdf::loadView('user.pesan_makanan.invoice_pdf', [
            'transaksi' => $transaksi
        ])->setPaper('A4', 'portrait');

        return $pdf->download("Invoice-$kode_transaksi.pdf");
    }

    public function invoice_tempat($id)
    {
        $pemesanan = pemesanan_permainan::with('permainan')->findOrFail($id);

        return view('user.pesan_tempat.invoice', compact('pemesanan'));
    }

    public function invoice_tempat_pdf($id)
    {
        $pemesanan = pemesanan_permainan::findOrFail($id);

        $pdf = Pdf::loadView('user.pesan_tempat.invoice_pdf', [
            'pemesanan' => $pemesanan
        ])->setPaper('A4', 'portrait');

        return $pdf->download("Invoice-$id.pdf");
    }

}
