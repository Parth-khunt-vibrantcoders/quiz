@extends('frontend.layout.layout')
@section('section')

<section>
    <div class="container">
        <div class="quiz-list-tab">
            <ul class="nav">
                @php
                    $i = 0 ;
                @endphp
                @foreach ($quiz_type as $qt_key => $qt_val)
                    <li style="width: {{ 100 / count($quiz_type) }}% !important">
                        <a class="{{ $i == 0 ? 'active' : '' }}" data-toggle="tab" href="#quiz_type{{ $qt_val['id'] }}">{{ $qt_val['name'] }}</a>
                    </li>
                    @php
                        $i++ ;
                    @endphp
                @endforeach
            </ul>
        </div>

        <div class="tab-content">
            @foreach ($quiz_type as $qt_key => $qt_val)
            <div id="quiz_type{{ $qt_val['id'] }}" class="tab-pane in {{ $qt_key == 0 ? 'active' : '' }}">
                <div class="quiz-list-main">
                    @forelse ($qt_val['quiz'] as $quiz_key => $quiz_val)
                        <div class="quiz-list-box">
                            <div class="quiz-list-box-head">
                                <span class="live">Live</span>
                            </div>
                            <div class="quiz-list-box-content">
                                <div class="box-img">
                                    <div class="list-img">
                                        <img src="{{ asset('uploads/quiz/'.$quiz_val['image']) }}">
                                    </div>
                                </div>
                                <div class="box-content">
                                    <span>{{ $quiz_val['name'] }}</span>
                                    <h4>{{ $quiz_val['quiz_app'] }}</h4>
                                    <p>{{ number_format(rand(0, 99999)) }} users playing</p>
                                </div>
                            </div>
                            <div class="quiz-list-box-footer-new ">
                                <div class="play-btn" style="margin-top: 10px">
                                    <a href="javascript:;">
                                        <button type="button">Play </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                    <div class="container">
                        <div class="score-main">
                            <div class="git-icon">
                                <img src="{{ asset('frontend/images/oops.png') }}">
                            </div>
                            <div class="congratulations-title">
                                <h4>We are so sorry. There is no quiz right now.</h4>
                            </div>
                        </div>
                    </div>
                    @endforelse

                </div>
              </div>
            @endforeach

        </div>
    </div>
</section>
@endsection
