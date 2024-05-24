<?php

namespace App\Http\Controllers;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Event;
use App\Models\Order;
use Illuminate\Http\Request;

class EventController extends Controller
{
    // Menampilkan semua events
    // public function __construct()
    // {
    //     $this->middleware(['auth', 'verified']);
    // }
    public function index()
    {
        $events = Event::all();
        return view('events.index', compact('events'));
    }

    // Menampilkan form untuk membuat event baru
    public function create()
    {
        return view('events.create');
    }

    // Menyimpan event baru ke dalam database
    public function store(Request $request)
    {
        $request->validate([
            // 'photos.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'event_name' => 'required',
            'event_description' => 'required',
            'event_date' => 'required|date',
            'event_time' => 'required',
            'event_price' => 'required',
            'location' => 'required',
            'organizer' => 'required',
        ]);
        Alert::success('Berhasil', 'Data berhasil disimpan!');
        // dd($request->all());

        try {
            $event = Event::create($request->all());

            $filename = [];
            if ($request->hasfile('photos')) {
                foreach ($request->file('photos') as $photo) {
                    $filename = time() . '_' . $photo->getClientOriginalName();
                    $photo->storeAs('public/event_photos', $filename);
                    $event->photos()->create([
                        'photo_path' => 'event_photos/' . $filename,
                        'event_id' => $event->event_id,
                    ]);
                }
            }else{
                $event->delete();
                return redirect()->route('events.create', $request->order_id)->with('error', 'Event gagal dibuat!');
            }
            return redirect()->route('events.index')
                ->with('success', 'Event berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->route('events.create', $request->order_id)->with('error', 'Event gagal dibuat!');
        }
    }

    // Menampilkan detail event
    public function show($id)
    {
        $event = Event::find($id);
        return view('events.show', compact('event'));
    }

    // Menampilkan form untuk mengedit event
    public function edit($id)
    {
        $event = Event::find($id);
        return view('events.edit', compact('event'));
    }

    // Mengupdate event di dalam database
    public function update(Request $request, $id)
    {
        $request->validate([
            'event_name' => 'required',
            'event_description' => 'required',
            'event_date' => 'required|date',
            'event_time' => 'required',
            'event_price' => 'required',
            'location' => 'required',
            'organizer' => 'required',
        ]);
        $Event = Event::find($id);
        try {
            $order = Order::where('event_id', $id)->first();
            $order->total_amount = ($order->total_amount - $Event->event_price) + $request->event_price;
            $order->save();
            $Event->update($request->all());
        } catch (\Exception $e) {
            $Event->update($request->all());
        }


        return redirect()->route('events.index')
            ->with('success', 'Event berhasil diperbarui.');
    }

    // Menghapus event dari database
    public function destroy($id)
    {
        Event::find($id)->delete();

        return redirect()->route('events.index')
            ->with('success', 'Event berhasil dihapus.');
    }
}
