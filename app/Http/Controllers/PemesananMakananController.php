<?php

namespace App\Http\Controllers;

use App\Models\pemesanan_makanan;
use Illuminate\Http\Request;

class PemesananMakananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = pemesanan_makanan::all();
        return view('admin.data_pemesanan_makanan.index', [
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.data_pemesanan_makanan.create');
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
}
