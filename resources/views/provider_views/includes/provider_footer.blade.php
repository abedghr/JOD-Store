<footer class="main-footer text-center">
    <strong>Copyright &copy; <script>document.write(new Date().getFullYear());</script> <a href="#">Jordan Stores</a>.</strong>
    All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->


<div id="fb-root"></div>
	<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v8.0&appId=1302610216739853&autoLogAppEvents=1" nonce="VKOEbsPZ"></script>


  
<!-- jQuery -->
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{asset('plugins/chart.js/Chart.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('plugins/sparklines/sparkline.js')}}"></script>
<!-- JQVMap -->
<script src="{{asset('plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{asset('plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>

<!-- daterangepicker -->
<script src="{{asset('plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Summernote -->
<script src="{{asset('plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
{{-- <script src="{{asset('dist/js/pages/dashboard.js')}}"></script> --}}
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="{{asset('dist/js/demo.js')}}"></script>

<script src="https://js.pusher.com/7.0/pusher.min.js"></script>

<script>
  var receiver_id = '';
  var my_id = "{{ Auth::id() }}";
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
             url : "message/"+receiver_id,
             data: "",
             cache: false,
             success:function(data){
                 $("#messages").html(data);
                 scrollToBottom();
             }
         });
     });

     $(document).on('keyup','.input-text input',function(e){
        var message = $(this).val();

        if(e.keyCode == 13  && message != "" && receiver_id != ""){
          $(this).val('');

          var datastr = "receiver_id=" + receiver_id + "&message=" + message;
          
          $.ajax({
            type : "post",
            url : "message",
            data : datastr,
            cache: false,
            success:function(data){
              $("ul.messages").append(data);
              scrollToBottom();
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

  // Enable pusher logging - don't include this in production
  Pusher.logToConsole = true;

  var pusher = new Pusher('e9e4a073342959254078', {
    cluster: 'mt1'
  });
  
  var notifyCount = parseInt($("#notifyCount").attr('data-count'));
  var old_content = $('.notify-box').html();

  var channel = pusher.subscribe('new-notification');
  channel.bind('App\\Events\\NewNotification', function(data) {
    if(data['provider_id'] == "{{Auth::user()->id}}"){
    notifyCount +=1;
    $('#notifyCount').attr('data-count',notifyCount);
    $('.notify-box').html('<a href="/provider/order_details/'+data['order_id']+'" class="dropdown-item"><i class="fa fa-first-order mr-2"></i> There is a new Order from '+data['name']+'<span class="float-right text-muted text-sm">'+data['time']+'</span></a>'+old_content);
    $('#notifyCount').html(notifyCount);
    }
  });
  channel.bind('App\\Events\\NewCategoryNotification',function(data){
    notifyCount +=1;
    $('#notifyCount').attr('data-count',notifyCount);
    $('.notify-box').html('<a href="/provider/show_category/'+data['cat_id']+'" class="dropdown-item"><i class="fa fa-list-alt mr-2"></i> There is a new Category on store '+data['cat_name']+' <span class="float-right text-muted text-sm">'+data['time']+'</span></a>'+old_content);
    $('#notifyCount').html(notifyCount);
  });
  channel.bind('App\\Events\\NewFeedbackNotification',function(data){
    if(data['feedback_provID'] == "{{Auth::user()->id}}"){
      notifyCount +=1;
    $('#notifyCount').attr('data-count',notifyCount);
    $('.notify-box').html('<a href="/provider/show_feedback/'+data['feedback_id']+'" class="dropdown-item"><i class="fa fa-list-alt mr-2"></i>There is a new Feedback<span class="float-right text-muted text-sm">'+data['time']+'</span></a>'+old_content);
    $('#notifyCount').html(notifyCount);
    }
  });
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
