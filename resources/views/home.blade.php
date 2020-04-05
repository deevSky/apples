@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <form action="{{ action('AppleController@generate') }}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-secondary">Generate</button>
                </form>

                <img class="tree" src="https://i.pinimg.com/originals/5b/7e/ca/5b7eca4d8d60e4666a5e70e317c79fc4.png">


                <form id='logout-form' action='{{ url('logout') }}' method='POST'>
                    @csrf
                    <button type='submit' class='btn btn-danger' style='margin-left: 90px; margin-top: 60px;'>Logout
                    </button>
                </form>


                @foreach($apples as $apple)

                    <div type="button" onclick="edit()" class="apple stayed{{ $apple->size}} apple_{{ $apple->status }}"
                         id="{{ $apple->id }}"
                         style="background: rgb({{ $apple->color }}); left: {{$apple->left}}px; top: {{ $apple->top }}px" data-created="{{ $apple->created_at }}"
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
                            <span class="timer">You can't take it now! Wait {{ (strtotime($apple->grow_time) - $now) }} second(s)!</span>
                        @endif
                    </div>

                @endforeach

            </div>
        </div>
    </div>
</div>
@endsection
