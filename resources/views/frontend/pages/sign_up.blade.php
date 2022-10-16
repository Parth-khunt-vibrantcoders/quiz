@extends('frontend.layout.layout')
@section('section')
<section>
    <div class="container">
        <div class="login-head">
            <h2>Join qzop now!</h2>

        </div>
        <form method="POST" id="register-form" autocomplete="off" action="{{ route('save-sign-up') }}">
            @csrf
            <div class="input-form">
                <div class="form-group">
                    <label >First Name</label>
                    <div class="input-group">
                        <span class="icon-box"><i class="fa fa-user"></i></span>
                        <input type="text" class="" autocomplete="off" placeholder="Please Full Name" name="firstname">
                    </div>
                </div>
            </div>
            <div class="input-form">
                <div class="form-group">
                    <label >Last Name</label>
                    <div class="input-group">
                        <span class="icon-box"><i class="fa fa-user"></i></span>
                        <input type="text" class="" autocomplete="off" placeholder="Please Full Name" name="lastname">
                    </div>
                </div>
            </div>
            <div class="input-form">
                <div class="form-group">
                    <label >Enter register email</label>
                    <div class="input-group">
                        <span class="icon-box"><i class="fa fa-envelope"></i></span>
                        <input type="text" class="" autocomplete="off" placeholder="Please enter register email" name="email">
                    </div>
                </div>
            </div>

            <div class="input-form">
                <div class="form-group">
                    <label >Enter Password</label>
                    <div class="input-group">
                        <span class="icon-box"><i class="fa fa-key"></i></span>
                        <input type="password" class="" autocomplete="off" id="password" placeholder="Please enter your password" name="password">
                    </div>
                </div>
            </div>

            <div class="input-form">
                <div class="form-group">
                    <label >Enter Confirm Password</label>
                    <div class="input-group">
                        <span class="icon-box"><i class="fa fa-key"></i></span>
                        <input type="password" class="" autocomplete="off" id="confirm_password" placeholder="Please enter your confirm password" name="confirm_password">
                    </div>
                </div>
            </div>

            <div class="submit-btn">
                <button type="submit" class="btn">CONTINUE</button>
            </div>
        </form>

        <div class="sign-login">
            <a href="{{ route('sign-in') }}">Already have an account</a>

        </div>
    </div>
</section>
@endsection
