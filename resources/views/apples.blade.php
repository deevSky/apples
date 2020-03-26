<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

</head>
<body>

<div>
    <form action="{{ action('AppleController@generate') }}" method="post">
        @csrf
        <button type="submit" class="btn btn-secondary" onclick="aaa()">Generate</button>
    </form>

    <img class="tree" src="https://i.pinimg.com/originals/5b/7e/ca/5b7eca4d8d60e4666a5e70e317c79fc4.png" alt="">



        @foreach($apples as $apple)
        <div id="dragId" class="draggable">
            <span class="apple" id="{{ $apple->id }}"
                  style="background: rgb({{ $apple->color }}); left: {{$apple->left}}px; top: {{ $apple->top }}px"
                  type="button" onclick="edit({{ $apple->id }})" data-id="{{ $apple->id }}">
              {{ $apple->size }}
            </span>
        </div>
        @endforeach


</div>

<script>
    $(function () {
        $(".draggable").draggable();
    });


    $creatingTime = "{{ $apple->created_at }}";
    $result = $creatingTime.substring(14,16);
    $dt = new Date();
    $time = $dt.getMinutes();

        function edit($id) {
            if(($time-$result) >= 1){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $url = "{{ action('AppleController@update', 'FUTURE_ID') }}";
                $url = $url.replace("FUTURE_ID", $id);

                $.ajax({
                    type: 'POST',
                    url: $url,
                    success: function (response) {
                        $('#' + $id).html((response['size']));

                        if ((response['size']) == '75') {
                            $('#' + $id).css("border-right-color", "transparent");
                        }
                        if ((response['size']) == '50') {
                            $('#' + $id).css("border-right-color", "transparent");
                            $('#' + $id).css("border-bottom-color", "transparent");
                        }
                        if ((response['size']) == '25') {
                            $('#' + $id).css("border-right-color", "transparent");
                            $('#' + $id).css("border-bottom-color", "transparent");
                            $('#' + $id).css("border-left-color", "transparent");
                        }
                        if ((response['size']) == 0) {
                            $('#' + $id).addClass('hidden');
                        }

                    },
                    error: function (error) {
                        alert('Error')
                    }
                });
            }else{
                alert("You can't it apple now, please wait !")
            }

        }

</script>
</body>
</html>
