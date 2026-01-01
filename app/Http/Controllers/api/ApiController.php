<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\pemesanan_makanan;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{
    public function index()
    {
         try {
            // Ambil semua data dari tabel
            $allPemesanans = pemesanan_makanan::orderBy('created_at', 'desc')->get();

            // Jika tabel kosong
            if ($allPemesanans->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Tidak ada data pemesanan',
                    'data' => []
                ], 404);
            }

            // Kelompokkan berdasarkan kode transaksi
            $groupedData = [];
            foreach ($allPemesanans as $pesanan) {
                $kodeTransaksi = $pesanan->kode_transaksi;

                if (!isset($groupedData[$kodeTransaksi])) {
                    $groupedData[$kodeTransaksi] = [
                        'kode_transaksi' => $kodeTransaksi,
                        'total_pesanan' => 0,
                        'total_harga' => 0,
                        'waktu_transaksi' => $pesanan->created_at,
                        'items' => []
                    ];
                }

                // Tambahkan item ke kelompok
                $groupedData[$kodeTransaksi]['items'][] = [
                    'id' => $pesanan->id,
                    'barcode_id' => $pesanan->barcode_id,
                    'makanan_id' => $pesanan->makanan_id,
                    'minuman_id' => $pesanan->minuman_id,
                    'qty' => $pesanan->qty,
                    'jumlah_harga' => $pesanan->jumlah_harga,
                    'detail' => $pesanan->detail,
                    'ket' => $pesanan->ket,
                    'created_at' => $pesanan->created_at,
                    'updated_at' => $pesanan->updated_at
                ];

                // Update total
                $groupedData[$kodeTransaksi]['total_pesanan']++;
                $groupedData[$kodeTransaksi]['total_harga'] += $pesanan->jumlah_harga;
            }

            // Konversi ke array indexed dan urutkan berdasarkan waktu terbaru
            $result = array_values($groupedData);
            usort($result, function($a, $b) {
                return strtotime($b['waktu_transaksi']) - strtotime($a['waktu_transaksi']);
            });

            return response()->json([
                'success' => true,
                'message' => 'Data pemesanan berhasil diambil',
                'total_transaksi' => count($result),
                'total_semua_pesanan' => $allPemesanans->count(),
                'total_semua_pendapatan' => $allPemesanans->sum('jumlah_harga'),
                'data' => $result
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan server',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);


        if (Auth::attempt($credentials)) {
            $user = User::where('email', $credentials['email'])->first();
            return response()->json([
                'message' => 'Login berhasil',
                'user' => $user
            ]);
        }

        return response()->json([
            'message' => 'Email atau password salah'
        ], 401);
    }
}
