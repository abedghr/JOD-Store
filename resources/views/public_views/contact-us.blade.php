<?php $pageTitle = "Contact Us" ?>
@include('public_views.includes.public_header')
<br>

<section class="contact_area p_120" style="margin-top: -32px;">
    <h2 style="font-family:Times New Roman; font-weight:bold; padding-left:50px; padding-top:25px; color:black; background-color:rgba(0,0,0,0.1); height:100px"><i>Contact US</i></h2>
    <div class="container" style="margin-top: 80px;">
        
        <div class="row">
            <div class="col-lg-3">
                <div class="contact_info">
                    <div class="info_item">
                        <i class="lnr lnr-home"></i>
                        <h6>Amman , Jordan</h6>
                        <p>Mutli stores</p>
                    </div>
                    <div class="info_item">
                        <i class="lnr lnr-phone-handset"></i>
                        <h6>
                            <a href="#">+962 79 071 4916</a>
                        </h6>
                        <p>every day from 10:00am to 9:30pm</p>
                    </div>
                    <div class="info_item">
                        <i class="lnr lnr-envelope"></i>
                        <h6>
                            <a href="#">jordan.store@gmail.com</a>
                        </h6>
                        <p>Send us your query anytime!</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <form class="row contact_form" action="{{route('admin_feedback.send')}}" method="post" id="contactForm" novalidate="novalidate">
                    @csrf
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name">
                        </div>
                        @error('name')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                        <div class="form-group">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email address">
                        </div>
                        @error('email')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                        <div class="form-group">
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter mobile number">
                        </div>
                        @error('phone')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <textarea class="form-control" name="message" id="message" rows="1" placeholder="Enter Message"></textarea>
                        </div>
                        @error('message')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-md-12 text-right">
                        <button type="submit" value="submit" class="btn submit_btn">Send Feedback</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!--================Contact Area =================-->

@include('public_views.includes.public_footer')