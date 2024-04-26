@extends('layouts.dash')

@section('content')
<div class="container">
    <h1>Interventions</h1>
    <div class="text-right">
        <a href="{{ route('interventions.create') }}" class="btn btn-primary mb-2"> <i class="fas fa-plus">Add</i> </a>
    </div>
    
    @if ($interventions->count() > 0)
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Client</th>
                <th>Date</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Recurrence</th>
                <th>Personne</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($interventions as $intervention)
            <tr>
                <td>{{ $intervention->id }}</td>
                <td>{{ $intervention->client }}</td>
                <td>{{ $intervention->date }}</td>
                <td>{{ $intervention->start_time }}</td>
                <td>{{ $intervention->end_time }}</td>
                <td>{{ $intervention->recurrence }}</td>
                <td>{{ $intervention->personne }}</td>
                <td>
                    <a href="{{ route('interventions.show', $intervention->id) }}" class="btn btn-primary">View</a>
                    <a href="{{ route('interventions.edit', $intervention->id) }}" class="btn btn-secondary">Edit</a>
                    <form action="{{ route('interventions.destroy', $intervention->id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p>No interventions found.</p>
    @endif
</div>
@endsection
