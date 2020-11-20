<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        /* width */
        ::-webkit-scrollbar {
            width: 7px;
        }
        /* Track */
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: #a7a7a7;
        }
        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #929292;
        }
        ul {
            margin: 0;
            padding: 0;
        }
        li {
            list-style: none;
        }
        .user-wrapper, .message-wrapper {
            border: 1px solid #dddddd;
            overflow-y: auto;
        }
        .user-wrapper {
            height: ;
        }
        .user {
            cursor: pointer;
            padding: 5px 0;
            position: relative;
        }
        .user:hover {
            background: #eeeeee;
        }
        .user:last-child {
            margin-bottom: 0;
        }
        .pending {
            position: absolute;
            left: 13px;
            top: 9px;
            background: #b600ff;
            margin: 0;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            line-height: 18px;
            padding-left: 5px;
            color: #ffffff;
            font-size: 12px;
        }
        .media-left {
            margin: 0 10px;
        }
        .media-left img {
            width: 64px;
            border-radius: 64px;
        }
        .media-body p {
            margin: 6px 0;
        }
        .message-wrapper {
            padding: 10px;
            height: 470px;
            background: #eeeeee;
        }
        .messages .message {
            margin-bottom: 15px;
        }
        .messages .message:last-child {
            margin-bottom: 0;
        }
        .received, .sent {
            width: 45%;
            padding: 3px 10px;
            border-radius: 10px;
        }
        .received {
            background: #ffffff;
        }
        .sent {
            background: #3bebff;
            float: right;
            text-align: right;
        }
        .message p {
            margin: 5px 0;
        }
        .date {
            color: #777777;
            font-size: 12px;
        }
        .active {
            background: #eeeeee;
        }
        input[type=text] {
            width: 100%;
            padding: 12px 20px;
            margin: 15px 0 0 0;
            display: inline-block;
            border-radius: 4px;
            box-sizing: border-box;
            outline: none;
            border: 1px solid #cccccc;
        }
        input[type=text]:focus {
            border: 1px solid #aaaaaa;
        }
    </style>
</head>
<body>
   
    <h3 class="text-center"><strong><a href="/home">Visite Store</a></strong></h3>
        <main class="py-4">
            @yield('content')
        </main>{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>

<script>
    var receiver_id = '';
    
    var my_id = "{{session('user')['user_id']}}";
    $(document).ready(function () {

        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(".user").click(function(){
        $('.user').removeClass('active');
        $(this).addClass('active');
        

        $(this).find('.pending').remove();
        receiver_id = $(this).attr('id');
        $.ajax({
             type: "GET",
             url : "{{route('message.user')}}",
             data: {
                 'receiver_id':receiver_id
             },
             cache: false,
             success:function(data){
                $("#messages").html(data);
                scrollToBottom();
             }
         });
        });



        $(".user").addClass('active');
        receiver_id = $(".user").attr('id');
         $.ajax({
             type: "GET",
             url : "{{route('message.user')}}",
             data: {
                 'receiver_id':receiver_id
             },
             cache: false,
             success:function(data){
                $("#messages").html(data);
                scrollToBottom();
             }
         });


        $(document).on('keyup','.input-text input',function(e){
            var message = $(this).val();

            if(e.keyCode == 13  && message != "" && receiver_id != ""){
            $(this).val('');

            var datastr = "receiver_id=" + receiver_id + "&message=" + message;
            
            $.ajax({
                type : "post",
                url : "{{route('message_user.send')}}",
                data : datastr,
                cache: false,
                success:function(data){
                    
                },
                error:function(JqXHR , status , err){

                },
                complete:function(){
                    scrollToBottom();
                }
            });
            }
        });
    });


    function scrollToBottom(){
        $('.message-wrapper').animate({
            scrollTop : $('.message-wrapper').get(0).scrollHeight
        }, 0);
    }
</script>
 --}}
<script>
    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;
  
    var pusher = new Pusher('e9e4a073342959254078', {
      cluster: 'mt1'
    });
    
    var notifyCount = parseInt($("#notifyCount").attr('data-count'));
    var old_content = $('.notify-box').html();
  
    var channel = pusher.subscribe('new-notification');
    channel.bind('App\\Events\\NewMessage', function(data) {
        
    if(my_id == data.from){
        $('#'+ data.to).click();
    }else if(my_id == data.to){
      if(receiver_id == data.from){
        // if receiver is selected, reload the selected user....
        $('#'+ data.from).click();
      }else{
        // if receiver is not selected, add notification for that user.
        var pending = parseInt($('#' + data.from).find('.pending').html());
        if(pending){
          $('#'+ data.from).find('.pending').html(pending +1);
        }else{
          $('#'+ data.from).append('<span class="pending">1</span>');
        }
      }
    }
  });
</script>
</body>
</html>
