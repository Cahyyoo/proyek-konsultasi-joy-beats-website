<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DataMahasiswa;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function proses(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'min:5|required'
        ]);

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();
            if(Auth::user()->role == "admin") {
                return redirect("/admin/dashboard");
            } else if(Auth::user()->role == "mhs") {
                return redirect("/mhs/dashboard");
            }

        } else {
            return redirect('/login')->with('danger', 'Username atau Password salah!');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->intended('login');
    }

    public function home() {
        return redirect('/' . Auth::user()->role .'/dashboard');
    }

    public function dashboard_admin() {
        $dataNetw = DataMahasiswa::where('rekomendasi_kbk', 'Network & Security')->count();
        $dataIntell = DataMahasiswa::where('rekomendasi_kbk', 'Intelligence System')->count();
        $dataEmbedd = DataMahasiswa::where('rekomendasi_kbk', 'Embedded System')->count();
        // dd($dataEmbedd);
        return view('admin.dashboard', [
            'dataNetw' => $dataNetw,
            'dataIntell' => $dataIntell,
            'dataEmbedd' => $dataEmbedd
        ]);
    }
}
