<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
</head>
<body>

<ul class="navbar-nav ml-auto">
    <!-- Authentication Links -->
    @guest
        <h1 class="text-center mt-5 mb-5">Welcome dear guest</h1>
        <li class="nav-item text-center">
            <a class="nav-link btn-success" href="{{ route('login') }}">{{ __('Login') }}</a>
        </li>
        @if (Route::has('register'))
            <li class="nav-item text-center">
                <a class="nav-link btn-success" href="{{ route('register') }}">{{ __('Register') }}</a>
            </li>
        @endif
    @else
        <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle  float-right" href="#" role="button" data-toggle="dropdown"
               aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }} <span class="caret"></span>
            </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">

                    @csrf
                </form>
            </div>
        </li>

</ul>
<form action="{{ action('AppleController@generate') }}" method="post">
    @csrf
    <button type="submit" class="btn btn-secondary">Generate</button>
</form>

<img class="tree" src="https://i.pinimg.com/originals/5b/7e/ca/5b7eca4d8d60e4666a5e70e317c79fc4.png">


@foreach($apples as $apple)
    <div type="button" onclick="edit()" class="apple stayed{{ $apple->size}} apple_{{ $apple->status }}"
         id="{{ $apple->id }}"
         style="background: rgb({{ $apple->color }}); left: {{$apple->left}}px; top: {{ $apple->top }}px"
         data-created="{{ $apple->created_at }}"
         data-id="{{ $apple->id }}" data-grow="{{ $apple->grow_time }}" data-spoil="{{ $apple->spoil_time }}">
        <div class="appleSize">{{ $apple->size }}</div>

        <form action="{{ action('AppleController@update', $apple) }}" method="post">
            @csrf
            <button type="submit" class="eat">Eat</button>
        </form>

        @if((strtotime($apple->grow_time) - $now) < 0)
            <form action="{{ action('AppleController@down', $apple) }}" method="post">
                @csrf
                <button type="submit" class="down" style="transform: rotate(45deg)">Down</button>
            </form>
        @endif

        @if((strtotime($apple->grow_time) - $now) > 0)
            <span style="z-index: 1000; position: absolute"
                class="timer">You can't take the apple now! Wait {{ (strtotime($apple->grow_time) - $now) }} second(s)!</span>
        @endif
    </div>
@endforeach
@endguest
</body>
</html>
