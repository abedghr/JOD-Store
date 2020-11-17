<?php $guard="admin_provider" ?>

@include('provAdmin_views.includes.provAdmin_header')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    
<!-- /.col -->

<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="user-wrapper">
                <ul class="users">
                    @foreach($users as $user)
                        <li class="user" id="{{ $user->id }}">
                            {{--will show unread count notification--}}
                            @if($user->unread)
                                <span class="pending">{{ $user->unread }}</span>
                            @endif

                            <div class="media">
                                <div class="media-left">
                                    <img src="../img/default_user.png" alt="" class="media-object">
                                </div>

                                <div class="media-body">
                                    <p class="name">{{ $user->name }}</p>
                                    <p class="email">{{ $user->email }}</p>
                                    
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="col-md-8" id="messages">
            
        </div>
    </div>
</div>
</div>

@include('provAdmin_views.includes.provAdmin_footer')