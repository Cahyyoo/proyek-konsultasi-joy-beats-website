<?php

namespace App\Http\Controllers;

use App\Models\makanan;
use Illuminate\Http\Request;

class MakananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Makanan::all();
        return view('admin.data_makanan.index', [
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.data_makanan.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_makanan' => 'required',
            'img' => 'required',
            'harga' => 'required',
        ]);

        $validatedData['img'] = $request->file('img')->store('makanan-images');

        try {
            Makanan::create($validatedData);
            return redirect('/admin/data-makanan')->with('success', 'Data berhasil ditambahkan!');
        } catch (\Throwable $th) {
            return redirect('/admin/data-makanan')->with('danger', 'Data gagal ditambahkan!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(makanan $data_makanan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(makanan $data_makanan)
    {
        return view("admin.data_makanan.edit", [
            'data_makanan' => $data_makanan
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, makanan $data_makanan)
    {
        $validatedData = $request->validate([
            'nama_makanan' => 'required',
            'harga' => 'required',
        ]);

        if($request->img) {
            $validatedData['img'] = $request->file('img')->store('makanan-images');
        }

        try {
            Makanan::where('id', $data_makanan->id)->update($validatedData);
            return redirect('/admin/data-makanan')->with('success', 'Data berhasil diedit!');
        } catch (\Throwable $th) {
            return redirect('/admin/data-makanan')->with('danger', 'Data gagal diedit!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(makanan $data_makanan)
    {
        try {
            Makanan::where('id', $data_makanan->id)->delete();
            return redirect('/admin/data-makanan')->with('success', 'Data berhasil dihapus!');
        } catch (\Throwable $th) {
            return redirect('/admin/data-makanan')->with('danger', 'Data gagal dihapus!');
        }
    }
}
