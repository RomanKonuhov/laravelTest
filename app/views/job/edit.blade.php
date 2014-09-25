@extends('layout')

@section('content')
    {{ Form::model($job, array('route' => array('job.update', $job->id), 'method' => 'put')) }}
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
            @if ($userPermissions >= User::ROLE_MODERATOR)
                <li>
                    {{ Form::label('State') }}
                    {{ Form::select('state', $jobStates, $job->state) }}
                </li>
            @endif
         </ul>
        <div class="actions">
            {{ Form::submit('Update') }}
            <a href="javascript: history.back()">Back</a>
        </div>
    {{ Form::close() }}
@stop