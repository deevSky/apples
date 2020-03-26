$(function () {
    $(".draggable").draggable();
});

function edit($id) {

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

            {{--$aaa = "{{ $apple->status }}";--}}

            {{--if ($aaa == 'On tree'){--}}
                {{--    alert("You can't it on the tree!");--}}
                {{--}--}}

        },
        error: function (error) {
            alert('Error')
        }
    });
}
