<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }
    public function index()
    {
        $orders = Order::all();
        return view('orders.index', ['orders' => $orders]);
    }

    public function show($id)
    {
        $order = Order::findOrFail($id);
        return view('orders.show', ['order' => $order]);
    }

    public function create()
    {
        // Tampilkan formulir pembuatan pesanan
        return view('orders.create');
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            // Atur aturan validasi sesuai kebutuhan
            'product_id' => 'required',
            'user_id' => 'required',
            'event_id' => 'nullable',
            'order_date' => 'required',
            'total_amount' => 'required',
            'order_status' => 'required',
            'shipping_address' => 'required',
            // ...
        ]);

        // Simpan pesanan baru ke database
        Order::create($request->all());

        // Redirect dengan pesan sukses
        return redirect()->route('orders.index')->with('success', 'Pesanan berhasil dibuat.');
    }

    public function edit($id)
    {
        $order = Order::findOrFail($id);
        return view('orders.edit', ['order' => $order]);
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            // Atur aturan validasi sesuai kebutuhan
            'product_id' => 'required',
            'user_id' => 'required',
            'event_id' => 'nullable',
            'order_date' => 'required',
            'total_amount' => 'required',
            'order_status' => 'required',
            'shipping_address' => 'required',
            // ...
        ]);

        // Temukan dan perbarui pesanan yang ada di database
        $order = Order::findOrFail($id);
        $order->update($request->all());

        // Redirect dengan pesan sukses
        return redirect()->route('orders.index')->with('success', 'Pesanan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        // Temukan dan hapus pesanan dari database
        $order = Order::findOrFail($id);
        $order->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('orders.index')->with('success', 'Pesanan berhasil dihapus.');
    }
}
