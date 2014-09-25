@extends('layout')

@section('content')
    {{ Form::model($job, array('route' => 'job.store')) }}
        <ul class="create">
            <li>
                {{ Form::label('title') }}
                {{ Form::text('title') }}
            </li>
            <li>
                {{ Form::label('email') }}
                {{ Form::text('email') }}
            </li>
            <li>
                {{ Form::label('description') }}
                {{ Form::textarea('description') }}
            </li>
         </ul>
        {{ Form::submit('Create') }}
    {{ Form::close() }}
@stop