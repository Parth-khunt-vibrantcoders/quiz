@php
    if (!empty(Auth()->guard('users')->user())) {
        $data = Auth()->guard('users')->user();
    }
@endphp
<header>
    <div class="container">
        <div class="header-top">
            <div class="logo-menu">
                {{-- <button class="menu-open" type=""><i class="fal fa-signal-alt-3"></i></button> --}}
                <div class="desktop-logo">
                    <a href="{{ route('home') }}">
                        <img src="{{  asset('frontend/images/logo-white.png')}}">
                    </a>
                </div>
            </div>
            <div class="wallet-icon">
                <div class="wallet-box">
                    <div class="wallet-box-text {{ !empty($data) ? '' : 'login' }}" style="cursor: pointer !important">
                        {{-- <a href=""> --}}
                        <span style="color: white !important">{{ !empty($data) ? $data['first_name'] ." ". $data['last_name'] : 'Login' }}</span>
                        {{-- </a> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</header><!-- /header -->
