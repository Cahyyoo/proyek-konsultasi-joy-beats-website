<?php

namespace App\Http\Controllers;

use App\Models\pemesanan_makanan;
use App\Models\Makanan;
use App\Models\Minuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
                return redirect("/dashboard");
            } else if(Auth::user()->role == "kasir") {
                return redirect("/dashboard");
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

    public function dashboard_admin()
    {
        return view('admin.dashboard', [
            'totalTransaksi' => pemesanan_makanan::distinct('kode_transaksi')->count('kode_transaksi'),
            'totalPendapatan' => pemesanan_makanan::sum('jumlah_harga'),
            'totalMakanan' => Makanan::count(),
            'totalMinuman' => Minuman::count(),
            'latestOrders' => pemesanan_makanan::latest()->limit(5)->get()
        ]);
    }

}
