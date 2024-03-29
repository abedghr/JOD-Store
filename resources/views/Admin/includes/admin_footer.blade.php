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

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>

<script src="{{asset('dist/js/pages/dashboard.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('dist/js/demo.js')}}"></script>


<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script>
  // Enable pusher logging - don't include this in production
  Pusher.logToConsole = true;

  var pusher = new Pusher('e9e4a073342959254078', {
    cluster: 'mt1'
  });
  var notifyCount = parseInt($("#notifyCount").attr('data-count'));
  var old_content = $('.notify-box').html();
  var channel = pusher.subscribe('new-notification');
  channel.bind('App\\Events\\NewProviderNotification', function(data) {
    notifyCount +=1;
    $('#notifyCount').attr('data-count',notifyCount);
    $('.notify-box').html('<a href="/admin/show_provider/'+data['provider_id']+'" class="dropdown-item"><i class="fa fa-users mr-2"></i>New Provider on your store "'+data['provider_name']+'"<span class="float-right text-muted text-sm">'+data['time']+'</span></a>'+old_content);
    $('#notifyCount').html(notifyCount);
  });
  channel.bind('App\\Events\\NewAdminFeedbackNotification', function(data) {
    notifyCount +=1;
    $('#notifyCount').attr('data-count',notifyCount);
    $('.notify-box').html('<a href="/admin/Messages" class="dropdown-item"><i class="fas fa-envelope mr-2"></i>New Feedback from user "'+data['name']+'"<span class="float-right text-muted text-sm">'+data['time']+'</span></a>'+old_content);
    $('#notifyCount').html(notifyCount);
  });
	</script>
</body>
</html>
