<?php

namespace App\Http\Controllers;

use App\Models\barcode;
use Illuminate\Http\Request;

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
            'img' => 'required',
            'ket_barcode' => 'required',
        ]);

        $validatedData['img'] = $request->file('img')->store('barcode-images');

        try {
            Barcode::create($validatedData);
            return redirect('/admin/data-barcode')->with('success', 'Data berhasil ditambahkan!');
        } catch (\Throwable $th) {
            return redirect('/admin/data-barcode')->with('danger', 'Data gagal ditambahkan!');
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
     * Show the form for editing the specified resource.
     */
    public function edit(barcode $data_barcode)
    {
        return view("admin.data_barcode.edit", [
            'data_barcode' => $data_barcode
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, barcode $data_barcode)
    {

        $validatedData = $request->validate([
            'ket_barcode' => 'required',
        ]);

        if($request->img) {
            $validatedData['img'] = $request->file('img')->store('barcode-images');
        }

        try {
            Barcode::where('id', $data_barcode->id)->update($validatedData);
            return redirect('/admin/data-barcode')->with('success', 'Data berhasil diedit!');
        } catch (\Throwable $th) {
            return redirect('/admin/data-barcode')->with('danger', 'Data gagal diedit!');
        }
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
