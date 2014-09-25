@extends('layout')

@section('content')
    <h3>Choose action</h3>
    <div class="home actions">
        {{ Form::open(array('route' => 'job.index', 'method' => 'get')) }}
            {{ Form::submit('View jobs', array('class' => 'view-jobs')) }}
        {{ Form::close() }}

        {{ Form::open(array('route' => 'user.index', 'method' => 'get')) }}
            {{ Form::submit('View users', array('class' => 'view-users')) }}
        {{ Form::close() }}
    </div>
@stop
