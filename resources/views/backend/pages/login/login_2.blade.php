@extends('backend.layout.login_2_layout')
@section('section')
<!--begin::Main-->
<div class="d-flex flex-column flex-root">
    <!--begin::Login-->
    <div class="login login-5 login-signin-on d-flex flex-row-fluid" id="kt_login" >
        <div class="d-flex flex-center flex-row-fluid bgi-size-cover bgi-position-top bgi-no-repeat" style="background-image: url({{  asset('public/backend/media/bg/login.png') }});">
            <div class="login-form   p-7 position-relative overflow-hidden shadow" style="border: 7px solid #cbcccf !important; background: white !important; color: black">

                <!--end::Login Header-->

                <div class="d-flex flex-center mb-10">
                    <a href="javascript:;">
                        <img src="{{  asset('public/upload/systemsetting/logo.png') }}" class="max-h-110px" alt="" style="width: 250px;"/>
                    </a>
                </div>

                <!--begin::Login Sign in form-->
                <div class="login-signin">
                    
                    <div class="mb-10 text-center">                        
                        <h3>Login Here</h3>
                        <div class="text-muted font-weight-bold">Enter your details to login to your account</div>
                    </div>

                    <form class="form"  id="login-form" method="POST" enctype="multipart/form-data" action="{{ route('check-login') }}">@csrf
                        
                        <div class="form-group">
                            <input class="form-control form-control-solid  py-7 px-6" type="text" name="email" placeholder="Email" autocomplete="off" />
                        </div>

                        <div class="form-group">
                            <input class="form-control form-control-solid  py-7 px-6" type="password" name="password" placeholder="Password"  autocomplete="off" />
                        </div>

                        <hr>
                        
                        <div class="form-group text-center mt-10">
                            <button id="kt_login_signin_submit" class="btn btn-primary btn-outline-primary btn-block">Sign In</button>
                        </div>

                    </form>                                     

                </div>
                <!--end::Login Sign in form-->
            </div>
        </div>
    </div>
    <!--end::Login-->
</div>
<!--end::Main-->
@endsection