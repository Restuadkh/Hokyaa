<!-- resources/views/events/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md">
            <h2>Event List</h2>
        </div>
        <table id="Events" class="">
            <thead>
                <tr>
                    <th>Event Name</th>
                    <th>Event Description</th>
                    <th>Event Date</th>
                    <th>Event Time</th>
                    <th>Location</th>
                    <th>Organizer</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($events as $event)
                    <tr>
                        <td>{{ $event->event_name }}</td>
                        <td>{{ $event->event_description }}</td>
                        <td>{{ $event->event_date }}</td>
                        <td>{{ $event->event_time }}</td>
                        <td>{{ $event->location }}</td>
                        <td>{{ $event->organizer }}</td>
                        <td>
                            <a href="{{ route('events.edit', $event->event_id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('events.destroy', $event->event_id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ route('events.create') }}" class="btn btn-success">Create</a>

        <script>
            new DataTable("#Events");
        </script>
    </div>
@endsection
