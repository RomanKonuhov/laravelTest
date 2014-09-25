<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <style>
        .content {
            width: 600px;
            overflow: hidden;
            margin: 30px 0;
            padding: 10px;
            border: 0;
            border-top: 1px solid #cccccc;
            border-bottom: 1px solid #cccccc;
        }
    </style>
</head>
<body>
{{ Auth::user()->name }} has posted the submission with the following content

<div class="content">
    <h4>{{ $job->title }}</h4>
    <div class="description">
        {{ $job->description }}
    </div>
</div>

This is a {{ link_to_route('job.edit', 'here', array('id' => $job->id)) }} to edit submission
</body>
</html>
