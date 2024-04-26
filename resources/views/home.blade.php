@extends('layouts.app')

@section('content')
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            Home    <a href="{{ route('activity-logs/login/logout') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
        </div>
    </div>
</div>
@endsection
