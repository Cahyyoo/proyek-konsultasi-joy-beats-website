<?php

namespace App\Http\Controllers;

use App\Models\barcode;
use Illuminate\Http\Request;
use App\Helpers\QrHelper;
use Illuminate\Support\Str;

class BarcodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Barcode::all();
        return view('admin.data_barcode.index', [
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.data_barcode.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'ket_barcode' => 'required|string|max:255',
        ]);

        $validatedData['img'] = '';
        $validatedData['uuid'] = Str::uuid();

        // Simpan data ke database terlebih dahulu
        $barcode = Barcode::create($validatedData);

        // Generate URL tujuan: host/pesan-makanan/{uuid}
        $qrContent = url("/pesan-makanan/{$barcode->uuid}");

        // Nama file QR
        $fileName = 'qr_' . Str::slug($validatedData['ket_barcode']) . '_' . time() . '.png';
        $qrPath = 'barcode-images/' . $fileName;
        $fullPath = storage_path('app/public/' . $qrPath);

        try {
            // Generate QR code berisi URL
            QrHelper::generateToFile($qrContent, $fullPath, 300);

            // Simpan path QR ke database
            $barcode->update(['img' => $qrPath]);

            return redirect('/admin/data-barcode')->with('success', 'QR Code berhasil dibuat!');
        } catch (\Throwable $th) {
            // Hapus data dari DB jika gagal generate QR
            $barcode->delete();

            // Hapus file jika sempat terbuat
            if (file_exists($fullPath)) {
                unlink($fullPath);
            }

            return back()->with('danger', 'Gagal membuat QR Code: ' . $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(barcode $data_barcode)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(barcode $data_barcode)
    {
        try {
            Barcode::where('id', $data_barcode->id)->delete();
            return redirect('/admin/data-barcode')->with('success', 'Data berhasil dihapus!');
        } catch (\Throwable $th) {
            return redirect('/admin/data-barcode')->with('danger', 'Data gagal dihapus!');
        }
    }
}
