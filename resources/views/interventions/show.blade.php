@extends('layouts.dash')

@section('content')
<div class="container">
    <h1>Intervention Details</h1>
    <table class="table">
        <tbody>
            <tr>
                <th>ID</th>
                <td>{{ $intervention->id }}</td>
            </tr>
            <tr>
                <th>Client</th>
                <td>{{ $intervention->client }}</td>
            </tr>
            <tr>
                <th>Date</th>
                <td>{{ $intervention->date }}</td>
            </tr>
            <tr>
                <th>Personne</th>
                <td>{{ $intervention->personne }}</td>
            </tr>
        </tbody>
    </table>
    <a href="{{ route('interventions.edit', $intervention->id) }}" class="btn btn-primary">Edit</a>
    <form action="{{ route('interventions.destroy', $intervention->id) }}" method="POST" style="display: inline-block;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>
    <a href="{{ route('interventions.index') }}" class="btn btn-secondary">Back</a>
</div>
@endsection
