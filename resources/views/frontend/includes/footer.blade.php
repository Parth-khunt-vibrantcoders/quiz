<script src="{{  asset('frontend/js/jquery.min.js')}}"></script>
<script src="{{  asset('frontend/js/popper.min.js')}}"></script>
<script src="{{  asset('frontend/js/bootstrap.min.js')}}"></script>
<script src="{{  asset('frontend/js/dark-light-mode.js')}}"></script>

<script type="text/javascript">
    $(".menu-open").click(function(){
        $("body").toggleClass("main");
    });
    $(".sidebar-menu, .menu-close").click(function(){
        $("body").toggleClass("main");
    });
    $('body').on('click', '.login', function(){
        var url = baseurl;
        window.location.href = url + 'sign-in';
    });
</script>


<script type="text/javascript">
    jQuery(document).ready(function () {
        $('#loader').show();
        $('#loader').fadeOut(2000);
    });
</script>

@if (!empty($pluginjs))
    @foreach ($pluginjs as $value)
        <script src="{{ asset('frontend/js/plugins/'.$value) }}" type="text/javascript"></script>
    @endforeach
@endif

@if (!empty($js))
@foreach ($js as $value)
    <script src="{{ asset('frontend/js/customjs/'.$value) }}" type="text/javascript"></script>
@endforeach
@endif

<script>
    jQuery(document).ready(function () {
        @if (!empty($funinit))
                @foreach ($funinit as $value)
                    {{  $value }}
                @endforeach
        @endif
    });
</script>
