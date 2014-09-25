@extends('layout')

@section('content')
    <h3>List of jobs</h3>
    @foreach ($jobs as $job)
        <div class="job {{ Job::getStateSlug($job->state) }}">
            @if ($userPermissions >= User::ROLE_MODERATOR || $userPermissions >= User::ROLE_HR && $job->user_id == $authUser->id)
                {{ Form::model($job, array('route' => array('job.destroy', $job->id), 'method' => 'delete')) }}
                    {{ Form::submit('D', array('class' => 'action delete')) }}
                {{ Form::close() }}
                {{ Form::model($job, array('route' => array('job.edit', $job->id), 'method' => 'get')) }}
                    {{ Form::submit('E', array('class' => 'action edit')) }}
                {{ Form::close() }}
            @endif
            <h4><a href="{{ URL::route('job.show', $job->id) }}">{{ $job->title }}</a></h4>
            <div class="description">{{ $job->description }}</div>
        </div>
        <div class="splitter"></div>
    @endforeach

    @if ($userPermissions >= User::ROLE_HR)
    <div class="actions">
        {{ Form::open(array('route' => 'job.create', 'method' => 'get')) }}
            {{ Form::submit('New job') }}
        {{ Form::close() }}
    </div>
    @endif
@stop

