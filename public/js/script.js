// $(function () {
//     $(".draggable").draggable();
// });
//
// function edit($id) {
//
//     $.ajaxSetup({
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         }
//     });
//
//     $url = "{{ action('AppleController@update', 'FUTURE_ID') }}";
//     $url = $url.replace("FUTURE_ID", $id);
//
//     $.ajax({
//         type: 'POST',
//         url: $url,
//         success: function (response) {
//             $('#' + $id).html((response['size']));
//
//             if ((response['size']) == '75') {
//                 $('#' + $id).css("border-right-color", "transparent");
//             }
//             if ((response['size']) == '50') {
//                 $('#' + $id).css("border-right-color", "transparent");
//                 $('#' + $id).css("border-bottom-color", "transparent");
//             }
//             if ((response['size']) == '25') {
//                 $('#' + $id).css("border-right-color", "transparent");
//                 $('#' + $id).css("border-bottom-color", "transparent");
//                 $('#' + $id).css("border-left-color", "transparent");
//             }
//             if ((response['size']) == 0) {
//                 $('#' + $id).addClass('hidden');
//             }
//
//             {{--$aaa = "{{ $apple->status }}";--}}
//
//             {{--if ($aaa == 'On tree'){--}}
//                 {{--    alert("You can't it on the tree!");--}}
//                 {{--}--}}
//
//         },
//         error: function (error) {
//             alert('Error')
//         }
//     });
// }


//
//
// $growDates = [];
// $spoilDates = [];
// $arrIds = [];
// $objGrowDatesIds = {};
// $objSpoilDatesIds = {};
// $now = new Date() / 1000;
// $createDate = (Date.parse($('.apple').data('created'))) / 1000;
// console.log($createDate)
//
//
// $(".apple").each(function () {
//     $growDate = $(this).data('grow');
//     $spoilDate = $(this).data('spoil');
//
//     $ids = $(this).data('id');
//     $growDates.push($growDate);
//     $spoilDates.push($spoilDate);
//     $arrIds.push($ids);
// });
//
// // console.log($objDatesIds.Object.entries($objDatesIds)[0])
// for ($i = 0; $i < $growDates.length; $i++) {
//     $objGrowDatesIds[$growDates[$i]] = $arrIds[$i];
// }
//
// for ($i = 0; $i < $spoilDates.length; $i++) {
//     $objSpoilDatesIds[$spoilDates[$i]] = $arrIds[$i];
// }
//
// console.log($objGrowDatesIds)
// console.log($objSpoilDatesIds)
//
// $time1 = Date.parse(Object.keys($objGrowDatesIds)[0]) / 1000;
// $time2 = Date.parse(Object.keys($objSpoilDatesIds)[0]) / 1000;
// $diff1 = $time1 - $createDate;
// $diff2 = $time2 - $createDate;
//
// $id = Object.entries($objGrowDatesIds)[0][1];
//
// console.log($diff1)
// console.log($diff2)
//
// // poxos($diff1, $diff2);
//
// function poxos($timeGrows, $timeSpoils) {
//     // $firstCreated = $timeSpoiled[0] * 1000;
//     $id = Object.entries($objGrowDatesIds)[0][1];
//     // delete $objGrowDatesIds.Object.entries($objGrowDatesIds)[0];
//
//     setTimeout(function () {
//         $('.apple').css('top', '600px');
//         // $('.apple').addClass('apple_onGround');
//
//         setTimeout(function () {
//             $('.apple').css('background', 'saddlebrown');
//             // $('.apple').removeClass('apple_onGround');
//         }, ($timeSpoils - $timeGrows) * 1000)
//     }, $timeGrows * 1000);
// }
//
//
// if ($diff > 10) {
//     $id = Object.entries($objDatesIds)[0][1];
//     $("#" + $id).css('background', 'blue');
//     delete $objDatesIds.Object.entries($objDatesIds)[0];
// }
//
//
// Object.keys($objDatesIds)
//     .sort()
//     .forEach(function (k, v) {
//         console.log(Object.keys($objDatesIds)[0])
//         if ((($now - (Date.parse(k) / 1000)) > 100) && (($now - (Date.parse(k) / 1000)) <= 200)){
//             console.log($objDatesIds[k] + ' grown')
//             console.log(k)
//         }
//         if(($now - (Date.parse(k) / 1000)) > 200){
//             console.log($objDatesIds[k] + ' spoiled')
//         }
//     });
//
//
// for ($i = 0; $i < $arrDates.length; $i++) {
//     $diff = (Date.parse($now) - Date.parse($arrDates[$i])) / 3600;
//     $arrDiff.push($diff);
// }
//
// $arrDiff = $arrDiff.sort();
// console.log($arrDiff)
//
