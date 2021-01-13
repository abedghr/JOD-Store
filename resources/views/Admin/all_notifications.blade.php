<?php $guard = "admin" ?>
@include('Admin.includes.admin_header')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    
<!-- /.col -->

<div class="col-md-12 mt-3">
    <div class="card">
      <div class="card-header bg-secondary text-light mb-2">
        <h3 class="card-title mt-2"><strong>All Notifications</strong></h3>
        <div class="card-tools">
            <ul class="float-right pagination pagination-sm float-right">
                {{-- {{ $notifications->links() }} --}}
            </ul>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body p-0 table-responsive">
        <table class="table text-center" id="table">
            <thead>
              <tr>
                <th>Read/Un-read</th>
                <th>Notifications</th>
                <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($notifications as $notify)
                    <tr style="@if ($notify->read_at == null) background-color:silver @endif">
                        <td>
                            @if ($notify->read_at == null) Un-read @else Read @endif
                        </td>
                    @if ($notify->type == 'App\Notifications\NewProviderNotification')
                        <td>
                            <a href="/admin/show_provider/{{$notify->data['provider_id']}}" class="dropdown-item">
                                <i class="fa fa-list-alt mr-2"></i> There is a New Provider on your store '{{$notify->data['provider_name']}}'
                                <br><span class="text-muted text-sm">{{$notify->data['date']}}</span>
                            </a>
                        </td>
                    @endif
                    @if ($notify->type == 'App\Notifications\AdminFeedbackNotification')
                        <td>
                            <a href="/admin/Messages" class="dropdown-item">
                                <i class="fa fa-first-order mr-2"></i> There is a New Feedback from user &nbsp;'{{$notify->data['name']}}'
                                <br><span class="text-muted text-sm">{{$notify->data['created_at']}}</span>
                            </a>
                        </td>
                    @endif
                    <td>
                        <form action="{{route('admin.notification.destroy',['id'=>$notify->id])}}" onclick="return confirm('Are You Sure ?')" method="post">
                            @csrf
                            @method('delete')
                        <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                        </form>
                    </td>
                @endforeach
                
                </tr>
            </tbody>
        </table>
      </div>
    </div>
</div>
</div>


@include('Admin.includes.admin_footer')
<script>
    $(document).ready(function () {
  $('#table').DataTable();
  $('.dataTables_length').addClass('bs-select');
});
</script>