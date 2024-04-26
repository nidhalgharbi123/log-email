@extends('layouts.dash')

@section('content')
<div class="container">
    <h1>Logs</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Timestamp</th>
             
                <th>Event</th>
                <th>User</th>
                <th>IP</th>
                <th>ID</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($logs as $log)
            <tr>
                <td>{{ $log['timestamp'] }}</td>
              
                <td>{{ $log['event'] }}</td>
                <td>{{ $log['user'] }}</td>
                <td>{{ $log['ip'] }}</td>
                <td>{{ $log['id'] }}</td>
                <td>{{ $log['email'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="pagination-container text-center">
        {{ $logs->links() }}
    </div>
    
</div>
@endsection
