<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin panel</title>
    <link href="/css/styles.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <div class="content">
        <div class="header">
            <div class="gohome"><a href="{{ URL::route('home') }}">Go HOME</a></div>

            @if (Auth::check())
            <div class="user">
                {{ 'Hello ' . Auth::user()->name . ' (' . User::getHumanReadableRole(Auth::user()->role) .')'}}
                <a href="{{ URL::route('logout') }}">Logout</a>
            </div>
            @endif
        </div>

        @if ($errors->all())
        <div class="errors">
            @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
            @endforeach
        </div>
        @endif

        @yield('content')
    </div>
</body>
</html>
