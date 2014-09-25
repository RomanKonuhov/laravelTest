@extends('layout')

@section('content')
{{ Form::model($loginData, array('router' => 'login', 'class' => 'auth')) }}
    <ul class="login">
        <li>
            {{ Form::label('email') }}
            {{ Form::text('email') }}
        </li>
        <li>
            {{ Form::label('password') }}
            {{ Form::password('password') }}
        </li>
    </ul>
    <div class="actions">
        {{ Form::open(array('route' => 'user.create', 'method' => 'get')) }}
            {{ Form::submit('Login') }}
        {{ Form::close() }}
    </div>
{{ Form::close() }}
@stop

