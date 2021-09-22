<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Store Dashboard</title>
  <script src="{{ asset('js/app.js') }}"></script>
  <link rel="stylesheet" href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css') }}">
  <link rel="stylesheet" href="{{ asset('https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css') }}">
  <script src="{{ asset('https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js') }}"></script>
  <script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js') }}"></script>
  <script src="{{ asset('https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js') }}"></script>

  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->

  <link rel="stylesheet" href="{{asset('css/mystyles.css')}}">

  <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css')}}">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="{{asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{asset('plugins/jqvmap/jqvmap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{asset('plugins/daterangepicker/daterangepicker.css')}}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{asset('plugins/summernote/summernote-bs4.css')}}">
  <!-- For DataTable -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="{{asset('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700')}}" rel="stylesheet">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <?php $c = 0; ?>
@foreach (auth()->user()->notifications as $item)
    @if ($item->type == "App\Notifications\ProviderMessageNotification")
        <?php $c++; ?>
    @endif
@endforeach

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <a href="{{route('messages.index')}}" class="btn btn-success text-center" style="width:200px;">Chating &nbsp;<i class="fa fa-comments"></i> </a>
      </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link notification-icon" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning rounded-circle mynavbar-badge" style=" font-size: 14px !important;" id="notifyCount" data-count="{{count(auth()->user()->unreadNotifications)-$c}}">{{count(auth()->user()->unreadNotifications)-$c}}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-right notify-box" id="" style="width:460px !important;">
          @foreach (auth()->user()->unreadNotifications as $notify)
          @if ($notify->type == 'App\Notifications\CategoryNotification')
          <div class="dropdown-divider"></div>
          <a href="{{route('provider_category.show',['id'=>$notify->data['id']])}}" class="dropdown-item">
            <i class="fa fa-list-alt mr-2"></i> There is a new Category on store '{{$notify->data['cat_name']}}'
            <span class="float-right text-muted text-sm">{{$notify->data['date']}}</span>
          </a>
          @endif
          @if ($notify->type == 'App\Notifications\OrderNotification')
          <div class="dropdown-divider"></div>
          <a href="{{route('order.showDetails',['order_id'=> $notify->data['id']])}}" class="dropdown-item">
            <i class="fa fa-first-order mr-2"></i> There is a new Order from '{{$notify->data['fname']}}'
            <span class="float-right text-muted text-sm">{{$notify->data['date']}}</span>
          </a>
          @endif
          @if ($notify->type == 'App\Notifications\ProviderFeedbackNotification')
          <div class="dropdown-divider"></div>
          <a href="{{route('provider_feedback.show',['id'=>$notify->data['id']])}}" class="dropdown-item">
            <i class="fa fa-envelope-square mr-2"></i> There is a new Feedback
            <span class="float-right text-muted text-sm">{{$notify->data['created_at']}}</span>
          </a>
          @endif
          @endforeach
          <div class="dropdown-divider"></div>
          <a href="{{route('provider.allNotifications')}}" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>

        <!-- Authentication Links -->
        @guest

        @else
          <li class="nav-item dropdown">
              <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                  {{ Auth::user()->name }}
              </a>
              @if (Auth::guard('provider')->check() && $guard == 'provider')
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{route('provider.profile')}}">
                  Profile
                </a>
                <a class="dropdown-item" href="{{ route('provider.logout') }}"
                    onclick="event.preventDefault();
                                    document.getElementById('provider-logout-form').submit();">
                    Logout Store
                </a>
                <form id="provider-logout-form" action="{{ route('provider.logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
            <div class="dropdown-menu dropdown-menu-right">

            </div>
              @endif

          </li>
        @endguest

    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('provider.dashboard')}}" class="brand-link">
      <h5 class="ml-1">Store Dashboard</h5>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="ml-3">
            <img src="../../img/Provider_images/{{Auth::user()->image}}" class="img-circle" style="width:40px !important; height:40px !important;" alt="User Image">
        </div>
        <div class="info">
        <a href="{{route('provider.profile')}}" class="d-block">{{Auth::user()->name}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
          <a href="{{route('provider.dashboard')}}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
          <a href="{{route('admin_provider.create')}}" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Manage Employees
              </p>
            </a>
          </li>
          <li class="nav-item">
          <a href="{{route('product_provider.create')}}" class="nav-link">
              <i class="nav-icon fa fa-product-hunt"></i>
              <p>
                Manage Products
              </p>
            </a>
          </li>
          <li class="nav-item">
          <a href="{{route('related_provider.create')}}" class="nav-link">
              <i class="nav-icon fa fa-asterisk" aria-hidden="true"></i>
              <p>
                Related Products
              </p>
            </a>
          </li>
          <li class="nav-item">
          <a href="{{route('order.index')}}" class="nav-link">
              <i class="nav-icon fa fa-first-order" aria-hidden="true"></i>
              <p>
                Manage Orders
              </p>
            </a>
          </li>
          <li class="nav-item">
          <a href="{{route('provider_category.index')}}" class="nav-link">
              <i class="nav-icon fa fa-list" aria-hidden="true"></i>
              <p>
                Show Categories
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('provider_feedback.index')}}" class="nav-link">
                <i class="nav-icon fa fa-envelope" aria-hidden="true"></i>
                <p>
                  Feedbacks
                </p>
              </a>
          </li>
          <li class="nav-item">
            <a href="{{route('messages.index')}}" class="nav-link">
                <i class="nav-icon fa fa-comments" aria-hidden="true"></i>
                <p>
                  <strong>Users Chat</strong>
                </p>
              </a>
          </li>
          <li class="nav-item">
            <a href="{{route('provider.profile')}}" class="nav-link">
                <i class="nav-icon fa fa-user-circle" aria-hidden="true"></i>
                <p>
                  Profile
                </p>
              </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

