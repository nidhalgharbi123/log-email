@extends('layouts.dash')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create New Intervention') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('interventions.store') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="client" class="col-md-4 col-form-label text-md-right">{{ __('Client') }}</label>

                            <div class="col-md-6">
                                <input id="client" type="text" class="form-control @error('client') is-invalid @enderror" name="client" value="{{ old('client') }}" required autofocus>

                                @error('client')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="date" class="col-md-4 col-form-label text-md-right">{{ __('Date') }}</label>

                            <div class="col-md-6">
                                <input id="date" type="date" class="form-control @error('date') is-invalid @enderror" name="date" value="{{ old('date') }}" required>

                                @error('date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="personne" class="col-md-4 col-form-label text-md-right">{{ __('Personne') }}</label>

                            <div class="col-md-6">
                                <input id="personne" type="text" class="form-control @error('personne') is-invalid @enderror" name="personne" value="{{ old('personne') }}" required>

                                @error('personne')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('recurrence') ? 'has-error' : '' }}">
                            <label>repeuter</label>
                            @foreach(App\Models\Intervention::RECURRENCE_RADIO as $key => $label)
                                <div>
                                    <input id="recurrence_{{ $key }}" name="recurrence" type="radio" value="{{ $key }}" {{ old('recurrence', 'none') === (string)$key ? 'checked' : '' }} required>
                                    <label for="recurrence_{{ $key }}">{{ $label }}</label>
                                </div>
                            @endforeach
                            @if($errors->has('recurrence'))
                                <em class="invalid-feedback">
                                    {{ $errors->first('recurrence') }}
                                </em>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('start_time') ? 'has-error' : '' }}">
                            <label for="start_time">Date de début</label>
                            <input type="datetime-local" id="start_time" name="start_time" class="form-control" value="{{ old('start_time', isset($event) ? $event->start_time : '') }}" required>
                            @if($errors->has('start_time'))
                                <em class="invalid-feedback">
                                    {{ $errors->first('start_time') }}
                                </em>
                            @endif
                        </div>
                        
                        <div class="form-group {{ $errors->has('end_time') ? 'has-error' : '' }}">
                            <label for="end_time">Date de fin</label>
                            <input type="datetime-local" id="end_time" name="end_time" class="form-control" value="{{ old('end_time', isset($event) ? $event->end_time : '') }}" required>
                            @if($errors->has('end_time'))
                                <em class="invalid-feedback">
                                    {{ $errors->first('end_time') }}
                                </em>
                            @endif
                        </div>
                        
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Submit') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
