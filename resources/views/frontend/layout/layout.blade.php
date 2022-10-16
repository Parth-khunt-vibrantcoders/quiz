<!DOCTYPE html>
<html>
    @include('frontend.includes.header')
	<body>

		<div class="side-bar">
			<div class="side-bar-inner">
                @include('frontend.includes.body_header')

                @yield('section')
			</div>
		</div>

		<div class="desktop">
			<div class="desktop-inner">
				<div class="">
					<img src="{{  asset('frontend/images/man-getting.jpg')}}">
				</div>
				<div class="desktop-logo">
					<img src="{{  asset('frontend/images/logo.png')}}">
					<p>Play Quiz, <b>Win Coins !</b></p>
				</div>
			</div>
		</div>
		<div class="menu-close"></div>
        @include('frontend.includes.footer')

	</body>
</html>
