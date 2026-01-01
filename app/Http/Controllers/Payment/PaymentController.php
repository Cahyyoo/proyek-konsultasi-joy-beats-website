<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Models\pemesanan_makanan;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;

class PaymentController extends Controller
{
    public function pay($id)
    {
        // aktivasi midtrans
        Config::$serverKey = 'SB-Mid-server-ZNFJQAs0K9hF-G6xNaBcBPiQ';
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // ambil pesanan
        $trx = pemesanan_makanan::where('kode_transaksi', $id)->get();

        $totalBayar = $trx->sum('jumlah_harga');

        // buat request midtrans
        $params = [
            'transaction_details' => [
                'order_id' => 'ORDER-' . $trx[0]->kode_transaksi,
                'gross_amount' => $totalBayar,
            ],
            'customer_details' => [
                'first_name' => 'Pembeli',
            ],
        ];

        $snapToken = Snap::getSnapToken($params);

        return view('kasir\data_pemesanan_makanan\bayar', compact('snapToken', 'trx', 'totalBayar'));

        // $params = [
        //     "payment_type" => "qris",
        //     "transaction_details" => [
        //         "order_id" => "ORDER-".$trx->id,
        //         "gross_amount" => $trx->jumlah
        //     ],
        //     "qris" => [
        //         "acquirer" => "gopay"
        //     ]
        // ];

        // $payment = CoreApi::charge($params);

        // // QRIS PNG
        // $qr_url = $payment->actions[0]->url;

        // return view('kasir\data_pemesanan_makanan\bayar', [
        //     'trx' => $trx,
        //     'qr_url' => $qr_url
        // ]);
    }
}
