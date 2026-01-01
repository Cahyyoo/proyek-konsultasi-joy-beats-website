<?php

namespace App\Http\Controllers;

use App\Models\pemesanan_permainan;
use App\Models\permainan;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Midtrans\Config;
use Midtrans\Snap;

class PemesananPermainanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(pemesanan_permainan $pemesanan_permainan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(pemesanan_permainan $pemesanan_permainan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, pemesanan_permainan $pemesanan_permainan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(pemesanan_permainan $pemesanan_permainan)
    {
        //
    }


    public function pesan_tempat() {
        $permainan = Permainan::all();
        $bookings = pemesanan_permainan::whereDate('tanggal', '>=', now())
                        ->get();

        return view('user.pesan_tempat.pesan_tempat', [
            'Permainan' => $permainan,
            'bookings' => $bookings
        ]);

    }

    public function booking_tempat($id)
    {
        $permainan = Permainan::find($id);

        return view('user.pesan_tempat.booking', [
            'permainan' => $permainan
        ]);
    }

    public function bayar_tempat(Request $request, $id) {

        $validatedData = $request->validate([
            'permainan_id' => 'required',
            'nama' => 'required',
            'tanggal' => 'required',
            'jam_mulai' => 'required',
            'jumlah' => 'required',
        ]);

        $jam_selesai = Carbon::createFromFormat('H:i', $request->jam_mulai)
        ->addHours($request->durasi)
        ->format('H:i');

        $validatedData['jam_selesai'] = $jam_selesai;
        $validatedData['detail'] = '';
        $validatedData['ket'] = 'Sudah Dibayar';

        $data_booking = pemesanan_permainan::create($validatedData);

        // aktivasi midtrans
        Config::$serverKey = 'SB-Mid-server-ZNFJQAs0K9hF-G6xNaBcBPiQ';
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // ambil pesanan
        $trx = pemesanan_permainan::findOrFail($id);
        $last_id = pemesanan_permainan::latest()->first();

        $jamMulai   = Carbon::createFromFormat('H:i', $trx->jam_mulai);
        $jamSelesai = Carbon::createFromFormat('H:i', $trx->jam_selesai);

        $durasiJam = $jamMulai->diffInHours($jamSelesai);

        // buat request midtrans
        $params = [
            'transaction_details' => [
                'order_id' => 'ORDER-' . ($last_id->id  + 1),
                'gross_amount' => $trx->jumlah,
            ],
            'customer_details' => [
                'first_name' => $trx->nama,
            ],
        ];

        $snapToken = Snap::getSnapToken($params);

        return view('user.pesan_tempat.pembayaran', [
            'booking' => $data_booking,
            'snapToken'=> $snapToken,
            'trx' => $trx,
            'durasi' => $durasiJam
        ]);
    }

}
