<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session('cart', []);

        return view('user.pesan_makanan.cart', compact('cart'));
    }

    public function add(Request $request)
    {
        $cart = session('cart', []);

        $id = $request->id;

        if (isset($cart[$id])) {
            $cart[$id]['qty']++;
        } else {
            $cart[$id] = [
                'id'    => $id,
                'nama'  => $request->nama,
                'harga' => $request->harga,
                'qty'   => 1,
                'img' => $request->img
            ];
        }

        session(['cart' => $cart]);

        return back()->with('success', 'Berhasil ditambahkan ke cart');
    }

    public function update(Request $request)
    {
        $cart = session('cart', []);
        $id   = $request->id;

        if (!isset($cart[$id])) return back();

        if ($request->type === 'plus') {
            $cart[$id]['qty']++;
        } else {
            $cart[$id]['qty']--;
            if ($cart[$id]['qty'] <= 0) {
                unset($cart[$id]);
            }
        }

        session(['cart' => $cart]);

        return back();
    }

    public function remove(Request $request)
    {
        $cart = session('cart', []);
        unset($cart[$request->id]);
        session(['cart' => $cart]);

        return back();
    }
}
