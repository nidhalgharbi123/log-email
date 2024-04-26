@extends('layouts.dash')

@section('content')
<div class="container">
    <h1>Edit Intervention</h1>
    <form action="{{ route('interventions.update', $intervention->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="client">Client:</label>
            <input type="text" class="form-control" id="client" name="client" value="{{ $intervention->client }}">
        </div>
        <div class="form-group">
            <label for="date">Date:</label>
            @php
                // Convertir le format de date de 'yy/mm/d' à 'yyyy-mm-dd' pour l'élément input type="date"
                $formattedDate = date('Y-m-d', strtotime($intervention->date));
            @endphp
            <input type="date" class="form-control" id="date" name="date" value="{{ $formattedDate }}">
        </div>
        <div class="form-group">
            <label for="start_time">Start Time:</label>
            <input type="datetime-local" class="form-control" id="start_time" name="start_time" value="{{ $intervention->start_time }}">
        </div>
        <div class="form-group">
            <label for="end_time">End Time:</label>
            <input type="datetime-local" class="form-control" id="end_time" name="end_time" value="{{ $intervention->end_time }}">
        </div>
        <div class="form-group">
            <label for="recurrence">Recurrence:</label>
            <input type="text" class="form-control" id="recurrence" name="recurrence" value="{{ $intervention->recurrence }}">
        </div>
        <div class="form-group">
            <label for="personne">Personne:</label>
            <input type="text" class="form-control" id="personne" name="personne" value="{{ $intervention->personne }}">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('interventions.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
