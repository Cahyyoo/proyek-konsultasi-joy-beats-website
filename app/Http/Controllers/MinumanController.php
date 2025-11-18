<?php

namespace App\Http\Controllers;

use App\Models\minuman;
use Illuminate\Http\Request;

class MinumanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Minuman::all();
        return view('admin.data_minuman.index', [
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.data_minuman.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_minuman' => 'required',
            'img' => 'required',
            'harga' => 'required',
        ]);

        $validatedData['img'] = $request->file('img')->store('minuman-images');

        try {
            Minuman::create($validatedData);
            return redirect('/admin/data-minuman')->with('success', 'Data berhasil ditambahkan!');
        } catch (\Throwable $th) {
            return redirect('/admin/data-minuman')->with('danger', 'Data gagal ditambahkan!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(minuman $data_minuman)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(minuman $data_minuman)
    {
        return view("admin.data_minuman.edit", [
            'data_minuman' => $data_minuman
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, minuman $data_minuman)
    {
        $validatedData = $request->validate([
            'nama_minuman' => 'required',
            'harga' => 'required',
        ]);

        if($request->img) {
            $validatedData['img'] = $request->file('img')->store('minuman-images');
        }

        try {
            Minuman::where('id', $data_minuman->id)->update($validatedData);
            return redirect('/admin/data-minuman')->with('success', 'Data berhasil diedit!');
        } catch (\Throwable $th) {
            return redirect('/admin/data-minuman')->with('danger', 'Data gagal diedit!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(minuman $data_minuman)
    {
        try {
            Minuman::where('id', $data_minuman->id)->delete();
            return redirect('/admin/data-minuman')->with('success', 'Data berhasil dihapus!');
        } catch (\Throwable $th) {
            return redirect('/admin/data-minuman')->with('danger', 'Data gagal dihapus!');
        }
    }
}
