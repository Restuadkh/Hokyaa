<?php

namespace App\Http\Controllers\Api;

use App\Models\Event;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EventController extends Controller
{
    // Menampilkan semua events
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }
    public function index(Request $request)
    {
        // Jika request adalah JSON, kirim data sebagai respons JSON
        $events = Event::all();
        return response()->json(['events' => $events], 200);
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
            'event_name' => 'required',
            'event_description' => 'required',
            'event_date' => 'required|date',
            'event_time' => 'required',
            'location' => 'required',
            'organizer' => 'required',
        ]);

        Event::create($request->all());

        return redirect()->route('events.index')
            ->with('success', 'Event berhasil ditambahkan.');
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
            'location' => 'required',
            'organizer' => 'required',
        ]);

        Event::find($id)->update($request->all());

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
