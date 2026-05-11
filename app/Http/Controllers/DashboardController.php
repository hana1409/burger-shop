<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Burger; // Pastikan huruf kapital (Best Practice)
use App\Models\Order;  // Pastikan huruf kapital (Best Practice)
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $burgers = Burger::all();   
        return view('dashboard', compact('burgers'));
    }

    public function order(Request $request)
    {
        // 1. Logika pengecekan diletakkan DI DALAM kurung kurawal fungsi
        $burger = Burger::find($request->input('burger_id'));

        if (!$burger) {
            return redirect()->back()->with('error', 'Burger tidak ditemukan!');
        }

        // 2. Simpan order
        $order = new Order;
        $order->user_id = Auth::id(); // Cara lebih singkat ambil ID
        $order->nama_burger = $request->input('nama_burger');
        $order->jumlah = $request->input('jumlah');
        $order->total_harga = $request->input('total_harga');
        $order->special_request = $request->input('special_request');
        $order->status = 'pending';
        $order->save();

        return redirect()->route('dashboard')->with('success', 'Order berhasil dibuat!');
    }
    public function checkout(Request $request) 
{
    // Mengirim seluruh object request ke view agar bisa dibaca
    return view('checkout', compact('request'));
}
    
    public function prosesBayar(Request $request) 
    {
        // Pastikan nama kolom di database (produk, total) sudah sesuai dengan input form
        $order = Order::create([
            'user_id' => Auth::id(),
            'produk'  => $request->item,
            'total'   => $request->total,
            'status'  => 'Lunas'
        ]);

        return view('struk', compact('order'));
    }
}