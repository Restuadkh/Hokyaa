<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {

        if (auth()->user()->is_admin) {
            $payments = Payment::all();
        } else {
            $payments = Payment::where('user_id', '=', auth()->user()->user_id);
        }
        return view('payments.index', ['payments' => $payments]);
    }

    public function show($id)
    {
        $order = Order::find($id)
            ->with('event')
            ->with('product')
            ->first();
        // dd($order);
        // $payment = Payment::findOrFail($id);
        return view('payments.show', [
            // 'payment' => $payment,
            'order' => $order
        ]);
    }

    public function create()
    {
        // Tampilkan formulir pembuatan pembayaran
        return view('payments.create');
    }

    public function store(Request $request)
    {
        $order = Order::findorFail();
        // Validasi input
        $request->validate([
            // Atur aturan validasi sesuai kebutuhan
            'order_id' => 'required',
            'user_id' => 'required',
            'event_id' => 'nullable',
            'booking_id' => 'nullable',
            'payment_date' => 'required',
            'payment_amount' => 'required',
            'payment_status' => 'required',
            'payment_method' => 'required',
            'transaction_id' => 'required',
            // ...
        ]);

        // Simpan pembayaran baru ke database
        Payment::create($request->all());

        // Redirect dengan pesan sukses
        return redirect()->route('payments.index')->with('success', 'Pembayaran berhasil dibuat.');
    }

    public function edit($id)
    {
        $payment = Payment::findOrFail($id);
        return view('payments.edit', ['payment' => $payment]);
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            // Atur aturan validasi sesuai kebutuhan
            'order_id' => 'required',
            'user_id' => 'required',
            'event_id' => 'nullable',
            'booking_id' => 'nullable',
            'payment_date' => 'required',
            'payment_amount' => 'required',
            'payment_status' => 'required',
            'payment_method' => 'required',
            'transaction_id' => 'required',
            // ...
        ]);

        // Temukan dan perbarui pembayaran yang ada di database
        $payment = Payment::findOrFail($id);
        $payment->update($request->all());

        // Redirect dengan pesan sukses
        return redirect()->route('payments.index')->with('success', 'Pembayaran berhasil diperbarui.');
    }

    public function destroy($id)
    {
        // Temukan dan hapus pembayaran dari database
        $payment = Payment::findOrFail($id);
        $payment->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('payments.index')->with('success', 'Pembayaran berhasil dihapus.');
    }
}
