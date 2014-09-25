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
You have posted the submission with the following content

<div class="content">
    <h2>{{ $job->title }}</h2>
    <div class="description">
        {{ $job->description }}
    </div>
</div>

The submission is in moderation.
</body>
</html>
