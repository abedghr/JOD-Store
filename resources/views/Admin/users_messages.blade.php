<?php $guard = 'admin'; ?>
@include('Admin.includes.admin_header')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Users Feedbacks</h1>
          </div>
          {{-- <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">General Form</li>
            </ol>
          </div> --}}
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title">Feedbacks List</h3>
                    <div class="card-tools">
                    <ul class="pagination pagination-sm float-right">
                        {!! $messages->links() !!}
                    </ul>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0 table-responsive">
                    <table class="table text-center">
                    <thead>
                        <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Message</th>
                        <th>Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1;?>
                        @foreach ($messages as $msg)
                        <tr>
                            <td>{{$msg->name}}</td>
                            <td>{{$msg->email}}</td>
                            <td>{{$msg->phone}}</td>
                            <td>{{$msg->feedback}}</td>
                            <td>{{$msg->created_at->format('Y-m-d')}}</td>
                        </tr>
                        @endforeach
                        
                        
                        
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
            </div>
            <!-- /.card -->
          </div>
        </div>
    </div>
</section>

</div>

@include('Admin.includes.admin_footer')