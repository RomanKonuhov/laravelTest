@extends('layout')

@section('content')
    <table class="users">
        <tr><th>Name</th><th>E-mail</th><th>Role</th></tr>
        @foreach ($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ User::getHumanReadableRole($user->role) }}</td>
        </tr>
        @endforeach
    </table>

    <div class="actions">
        {{ Form::open(array('route' => 'user.create', 'method' => 'get')) }}
            <a href="javascript: history.back()">Back</a>
        {{ Form::close() }}
    </div>
@stop

