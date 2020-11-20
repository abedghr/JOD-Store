@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="user-wrapper">
                    <ul class="users">
                        
                            <li class="user" id="{{ $provider->id }}">

                                <div class="media">
                                    <div class="media-left">
                                        <img src="../storage/Provider_images/{{$provider->image}}" alt="" class="media-object">
                                    </div>

                                    <div class="media-body">
                                        <p class="name">{{ $provider->name }}</p>
                                        <p class="email">{{ $provider->email }}</p>
                                        
                                    </div>
                                </div>
                            </li>

                    </ul>
                </div>
            </div>

            <div class="col-md-8" id="messages">
                
            </div>
        </div>
    </div>
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
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
