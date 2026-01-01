<?php

namespace App\Http\Controllers\Checkout;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\pemesanan_makanan;
use Midtrans\Config;
use Midtrans\Snap;

class CheckoutController extends Controller
{
    public function pembayaranMakanan($id)
    {
        $cart = session('cart');

        if (!$cart || count($cart) === 0) {
            return redirect('/')->with('error', 'Keranjang kosong');
        }

        // ===== 1. HITUNG TOTAL =====
        $items = [];
        $totalHarga = 0;

        foreach ($cart as $item) {
            $subtotal = $item['harga'] * $item['qty'];
            $totalHarga += $subtotal;

            $items[] = [
                'id' => $item['id'],
                'nama'     => $item['nama'],
                'qty'      => $item['qty'],
                'subtotal' => $subtotal,
            ];
        }

        $pajak = $totalHarga * 0.1;
        $grandTotal = $totalHarga + $pajak;

        // ===== 2. BARCODE TRANSAKSI =====
        $barcode = $id;
        $kode_transaksi = 'TRX-' . strtoupper(Str::random(8));

        // ===== 3. MIDTRANS CONFIG =====
        Config::$serverKey = 'SB-Mid-server-ZNFJQAs0K9hF-G6xNaBcBPiQ';
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // ===== 4. MIDTRANS PARAM =====
        $params = [
            'transaction_details' => [
                'order_id'     => $kode_transaksi,
                'gross_amount' => $grandTotal,
            ],
            'item_details' => array_map(function ($item) {
                return [
                    'id' => $item['id'],
                    'price'    => ($item['subtotal'] / $item['qty']) + ($item['subtotal'] / $item['qty']) * 0.1,
                    'quantity' => $item['qty'],
                    'name'     => $item['nama'],
                ];
            }, $items),
        ];

        $snapToken = Snap::getSnapToken($params);

        foreach ($cart as $item) {

            $isMakanan = str_starts_with($item['id'], 'makanan-');
            $isMinuman = str_starts_with($item['id'], 'minuman-');

            // VALIDASI INTI (ANTI DATA RUSAK)
            if ($isMakanan === $isMinuman) {
                abort(400, 'Data item tidak valid');
            }

            pemesanan_makanan::create([
                'barcode_id'   => $barcode,
                'kode_transaksi'    => $kode_transaksi,
                'makanan_id'   => $isMakanan ? str_replace('makanan-', '', $item['id']) : null,
                'minuman_id'   => $isMinuman ? str_replace('minuman-', '', $item['id']) : null,
                'qty'          => $item['qty'],
                'jumlah_harga' => $item['harga'] * $item['qty'],
                'detail'       => $item['nama'],
                'ket'          => 'Pesanan website',
            ]);
        }

        // ===== 5. KIRIM KE VIEW =====
        return view('user.pesan_makanan.pembayaran', [
            'kode_transaksi'   => $kode_transaksi,
            'items'      => $items,
            'total'      => $totalHarga,
            'grandTotal' => $grandTotal,
            'snapToken'  => $snapToken,
        ]);
    }
}
