<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\pemesanan_makanan;
use App\Models\makanan;
use App\Models\minuman;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;


class PemesananMakananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->status == 'success') {
            session()->flash('success', 'Pembayaran berhasil!');
        } else if(($request->status == 'danger')){
            session()->flash('danger', 'Pembayaran gagal!');
        }

        $data = pemesanan_makanan::with(['makanan', 'minuman'])->latest()->get();
        return view('kasir.data_pemesanan_makanan.index', [
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $makanan = Makanan::all();
        $minuman = Minuman::all();
        return view('kasir.data_pemesanan_makanan.create', [
            'makanan' => $makanan,
            'minuman' => $minuman
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         // VALIDASI DASAR
        $request->validate([
            'items'           => 'required',
            'ket'             => 'required|string',
            'payment_method'  => 'required|in:cash,midtrans',
        ]);

        $items = json_decode($request->items, true);

        if (!$items || count($items) === 0) {
            return back()->with('danger', 'Keranjang masih kosong');
        }

        // GENERATE KODE TRANSAKSI
        $kodeTransaksi = 'TRX-' . strtoupper(Str::random(10));
        $barcodeId     = 0;

        DB::beginTransaction();

        try {

            foreach ($items as $item) {

                if (!isset($item['type'], $item['id'], $item['qty'])) {
                    continue;
                }

                // AMBIL DATA & HARGA DARI DB
                if ($item['type'] === 'makanan') {
                    $produk = Makanan::findOrFail($item['id']);
                    $makananId = $produk->id;
                    $minumanId = null;
                    $namaProduk = $produk->nama_makanan;
                } else {
                    $produk = Minuman::findOrFail($item['id']);
                    $makananId = null;
                    $minumanId = $produk->id;
                    $namaProduk = $produk->nama_minuman;
                }

                $qty   = (int) $item['qty'];
                $harga = $produk->harga;
                $total = $qty * $harga;

                // SIMPAN PER ITEM
                pemesanan_makanan::create([
                    'barcode_id'     => $barcodeId,
                    'kode_transaksi' => $kodeTransaksi,
                    'makanan_id'     => $makananId,
                    'minuman_id'     => $minumanId,
                    'qty'            => $qty,
                    'jumlah_harga'   => $total,
                    'detail'         => $namaProduk,
                    'ket'            => $request->ket,
                ]);
            }

            DB::commit();

            // ==========================
            // REDIRECT BERDASARKAN METODE
            // ==========================

            if ($request->payment_method === 'cash') {

                // CASH → langsung ke halaman utama
                return redirect('/kasir/data-pemesanan-makanan-minuman')
                    ->with('success', 'Pembayaran cash berhasil. Pesanan selesai.');
            }

            // MIDTRANS
            return redirect()->route('kasir.pay.kode', $kodeTransaksi)
                ->with('success', 'Pesanan berhasil, lanjutkan pembayaran');

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with(
                'danger',
                'Gagal menyimpan pesanan'
            );
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(pemesanan_makanan $pemesanan_makanan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(pemesanan_makanan $pemesanan_makanan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, pemesanan_makanan $pemesanan_makanan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(pemesanan_makanan $pemesanan_makanan)
    {
        //
    }

    public function pesan_makan($id) {
        return view("user.pesan_makanan.pesan_makanan", [
            'makanan' => Makanan::all(),
            'minuman' => Minuman::all(),
            'id_barcode' => $id
        ]);
    }
}
