<?php

namespace App\Http\Controllers;

use App\Models\Pay;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Whoops\Run;

class PayController extends Controller
{
    public function index()
    {
        $pays = Pay::all();
        return view('pays.index', compact('pays'));
    }

    public function create()
    {
        return view('pays.create');
    }

    public function store(Request $request)
    {
        $length = 10;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = substr(str_shuffle($characters), 0, $length);
        $secret_key = 'Basic ' . config('xendit.key_auth');
        $external_id = 'Invoice_' . $randomString;

        $amount = $request->biaya;
        $descripsi = $request->descripsi;

        $data_request = Http::withHeaders([
            'Authorization' => $secret_key
        ])->post('https://api.xendit.co/v2/invoices', [
            'external_id' => $external_id,
            'amount' => $amount,
            // 'payment_methods' => [
            //     'BCA', 'QRIS'
            // ]
        ]);

        $response = $data_request->object();
        // dd($response);
        $expirydate = Carbon::parse($response->expiry_date);
        $expiry_date = $expirydate->format('Y-m-d H:i:s');
        $pay = Pay::create([
            'biaya' => $amount,
            'external_id' => $response->external_id,
            'description' => $descripsi,
            'status' => $response->status,
            'pay_link' => $response->invoice_url,
            'expiry_date' => $expiry_date,
        ]);

        return redirect()->route('pays.index')->with('success', 'Data Pay berhasil ditambahkan.');
    }

    public function callback(Request $request)
    {

        $data = $request->all();
        $status = $request->status;
        $external_id = $request->external_id;

        $Pay = Pay::where('external_id', $external_id)->update([
            'status' => $status
        ]);


        return response()->json($Pay);
    }



    public function show($id)
    {
        $pay = Pay::findOrFail($id);
        return view('pays.show', compact('pay'));
    }

    public function edit($id)
    {
        $pay = Pay::findOrFail($id);
        return view('pays.edit', compact('pay'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'biaya' => 'required|integer',
            'deskripsi' => 'required|string',
            'status' => 'required|string',
            'pay_link' => 'required|string',
        ]);

        $pay = Pay::findOrFail($id);
        $pay->update($request->all());

        return redirect()->route('pays.index')->with('success', 'Data Pay berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pay = Pay::findOrFail($id);
        $pay->delete();
        
        return redirect()->route('pays.index')->with('success', 'Data Pay berhasil dihapus.');
    }
}
