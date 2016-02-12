@section('title', 'Install :: Not initialized')
@extends('layouts/install')

@section('content')
    
    <div>
        <h2>Database not initialized.</h2>
        <p>Please check your connection details below, before continuing:</p>
        <table class="table table-bordered">
            <tr>
                <td>Driver:</td>
                <td>{{ $driver }}</td>
            </tr>
            @if ($driver == 'sqlite')
                <tr>
                    <td>File:</td>
                    <td>{{ $name }}</td>
                </tr>
            @elseif ($driver == 'mysql')
                <tr>
                    <td>Host:</td>
                    <td>{{ $host }}</td>
                </tr>
                <tr>
                    <td>Username:</td>
                    <td>{{ $username }}</td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td>{{ $password }}</td>
                </tr>
                <tr>
                    <td>Schema:</td>
                    <td>{{ $name }}</td>
                </tr>
            @else
                <tr>
                    <td>Error:</td>
                    <td>Unknown driver.</td>
                </tr>
            @endif
        </table>
        
        <form action="@route('/install')" method="post">
            <input type="submit" value="Install" class="btn btn-primary">
        </form>
    </div>
@endsection
