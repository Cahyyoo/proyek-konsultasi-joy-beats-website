<?php

namespace App\Http\Controllers;

use App\Models\permainan;
use Illuminate\Http\Request;

class PermainanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Permainan::all();
        return view('admin.data_permainan.index', [
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.data_permainan.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'no_permainan' => 'required',
            'jenis_permainan' => 'required',
        ]);

        try {
            Permainan::create($validatedData);
            return redirect('/admin/data-permainan')->with('success', 'Data berhasil ditambahkan!');
        } catch (\Throwable $th) {
            return redirect('/admin/data-permainan')->with('danger', 'Data gagal ditambahkan!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(permainan $data_permainan)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(permainan $data_permainan)
    {
        return view("admin.data_permainan.edit", [
            'permainan' => $data_permainan
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, permainan $data_permainan)
    {
        $validatedData = $request->validate([
            'no_permainan' => 'required',
            'jenis_permainan' => 'required',
        ]);

        try {
            Permainan::where('id', $data_permainan->id)->update($validatedData);
            return redirect('/admin/data-permainan')->with('success', 'Data berhasil diedit!');
        } catch (\Throwable $th) {
            return redirect('/admin/data-permainan')->with('danger', 'Data gagal diedit!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(permainan $data_permainan)
    {
        try {
            Permainan::where('id', $data_permainan->id)->delete();
            return redirect('/admin/data-permainan')->with('success', 'Data berhasil dihapus!');
        } catch (\Throwable $th) {
            return redirect('/admin/data-permainan')->with('danger', 'Data gagal dihapus!');
        }
    }
}
