@extends('frontend.layout.layout')
@section('section')
<section>
    <div class="container">
        <div class="login-head">
            <h2>Join qzop now!</h2>

        </div>
        <form method="POST" id="user-login" autocomplete="off" action="{{ route('check-sign-in') }}">
            @csrf
            <div class="input-form">
                <div class="form-group">
                    <label>Enter register email</label>
                    <div class="input-group">
                        <span class="icon-box"><i class="fa fa-envelope"></i></span>
                        <input type="text" class="" autocomplete="off" placeholder="Please enter register email" name="email">
                    </div>
                </div>
            </div>

            <div class="input-form">
                <div class="form-group">
                    <label>Enter Password</label>
                    <div class="input-group">
                        <span class="icon-box"><i class="fa fa-key"></i></span>
                        <input type="password" class="" autocomplete="off" placeholder="Please enter your password" name="password">
                    </div>
                </div>
            </div>

            <div class="submit-btn">
                <button type="submit" class="btn">CONTINUE</button>
            </div>

        </form>
            <div class="sign-login">
                <a href="{{ route('sign-up') }}">Create New Account</a>
            </div>


    </div>
</section>
@endsection
