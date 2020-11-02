<footer class="main-footer text-center">
    <strong>Copyright &copy; <script>document.write(new Date().getFullYear());</script> <a href="#">Abedalrahman Al-ghandour</a>.</strong>
    All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

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
  channel.bind('App\\Events\\NewNotification', function(data) {
    notifyCount +=1;
    $('#notifyCount').attr('data-count',notifyCount);
    $('.notify-box').html('<a href="provider/order_details/'+data['order_id']+'" class="dropdown-item"><i class="fa fa-first-order mr-2"></i> There is a new Order from '+data['name']+'<span class="float-right text-muted text-sm">'+data['time']+'</span></a>'+old_content);
    $('#notifyCount').html(notifyCount);
  });
  channel.bind('App\\Events\\NewCategoryNotification',function(data){
    notifyCount +=1;
    $('#notifyCount').attr('data-count',notifyCount);
    $('.notify-box').html('<a href="" class="dropdown-item"><i class="fa fa-list-alt mr-2"></i> There is a new Category on store '+data['cat_name']+' <span class="float-right text-muted text-sm">'+data['time']+'</span></a>'+old_content);
    $('#notifyCount').html(notifyCount);
  });
</script>

</body>
</html>
