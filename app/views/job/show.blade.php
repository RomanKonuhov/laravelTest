@extends('layout')

@section('content')
    <div class="job {{ $job->state }}">
        <h3>{{ $job->title }}</h3>
        <div class="description">{{ $job->description }}</div>
    </div>
    <div class="splitter"></div>


    <div class="actions">
        @if ($userPermissions >= User::ROLE_MODERATOR)
            {{ Form::model($job, array('route' => array('job.edit', $job->id), 'method' => 'get')) }}
                {{ Form::submit('Edit') }}
            {{ Form::close() }}
            {{ Form::model($job, array('route' => array('job.destroy', $job->id), 'method' => 'delete')) }}
                {{ Form::submit('Delete') }}
            {{ Form::close() }}
        @endif
        <a href="javascript: history.back()">Back</a>
    </div>
@stop

