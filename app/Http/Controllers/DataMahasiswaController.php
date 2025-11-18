<?php

namespace App\Http\Controllers;

use App\Models\DataMahasiswa;
use App\Models\User;
use App\Models\Quesioner;
use Illuminate\Http\Request;

class DataMahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = DataMahasiswa::all();
        return view('admin.data_mahasiswa.index', [
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.data_mahasiswa.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedDataMhs = $request->validate([
            'nama' => 'required',
            'nim' => 'required',
        ]);
        $validatedDataMhs['rekomendasi_kbk'] = "Tidak ada";
        $validatedDataMhs['minat'] = "Tidak ada";

        $validatedDataUser = $request->validate([
            'email' => 'required',
            'password' => 'min:5|required'
        ]);
        $validatedDataUser['role'] = 'mhs';
        $validatedDataUser['name'] = $validatedDataMhs['nama'];

        try {
            User::create($validatedDataUser);
            $userIDMahasiswa = User::where('name', $request->nama)->latest()->first();
            $validatedDataMhs['user_id'] = $userIDMahasiswa->id;
            DataMahasiswa::create($validatedDataMhs);
            return redirect('/admin/data-mahasiswa')->with('success', 'Data berhasil ditambahkan!');
        } catch (\Throwable $th) {
            return redirect('/admin/data-mahasiswa')->with('danger', 'Data gagal ditambahkan!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(DataMahasiswa $dataMahasiswa)
    {
        return view('admin.data_mahasiswa.show', [
            'dataMahasiswa' => $dataMahasiswa,
            'quesioner' => Quesioner::orderBy('peminatan_id', 'asc')->get()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DataMahasiswa $dataMahasiswa)
    {
        dd($dataMahasiswa);
        return view("admin.data_mahasiswa.edit", [
            'dataMahasiswa' => $dataMahasiswa
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DataMahasiswa $dataMahasiswa)
    {
        $validatedDataMhs = $request->validate([
            'nama' => 'required',
            'nim' => 'required',
        ]);

        $validatedDataUser = $request->validate([
            'email' => 'required',
        ]);;
        $validatedDataUser['name'] = $validatedDataMhs['nama'];

        if($request->password) {
            $validatedDataUser['password'] = $request->password;
        }

        try {
            User::where('id', $dataMahasiswa->user_id)->update($validatedDataUser);
            DataMahasiswa::where('id', $dataMahasiswa->id)->update($validatedDataMhs);
            return redirect('/admin/data-mahasiswa')->with('success', 'Data berhasil diedit!');
        } catch (\Throwable $th) {
            return redirect('/admin/data-mahasiswa')->with('danger', 'Data gagal diedit!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DataMahasiswa $dataMahasiswa)
    {
        try {
            DataMahasiswa::where('id', $dataMahasiswa->id)->delete();
            User::where('id', $dataMahasiswa->user_id)->delete();
            return redirect('/admin/data-mahasiswa')->with('success', 'Data berhasil dihapus!');
        } catch (\Throwable $th) {
            return redirect('/admin/data-mahasiswa')->with('danger', 'Data gagal dihapus!');
        }
    }
}
