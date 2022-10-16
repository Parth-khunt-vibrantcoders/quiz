@extends('backend.layout.layout')
@section('section')
<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container-fluid">
        @php
    if(file_exists( public_path().'/uploads/quiz/'.$quiz_details[0]['image']) && $quiz_details[0]['image'] != ''){
        $image = url("public/uploads/quiz/".$quiz_details[0]['image']);
    }else{
        $image = url("public/uploads/quiz/no-image.png");
    }
@endphp
<!--begin::Section-->
<div class="row">
    <div class="col-md-7 col-lg-12 col-xxl-7">
        <!--begin::Engage Widget 14-->
        <div class="card card-custom card-stretch gutter-b">
            <div class="card-body">

                <div class="row">

                    <div class="col-6 col-md-3">
                        <div class="mb-8 d-flex flex-column">
                            <span class="text-dark font-weight-bold mb-4">Quiz Image</span>
                            <img src="{{ $image }}" class="h-75 " alt="" style="height:100px !important;; width:100px !important">
                        </div>
                    </div>

                    <div class="col-6 col-md-3">
                        <div class="mb-8 d-flex flex-column">
                            <span class="text-dark font-weight-bold mb-4">Quiz Type</span>
                            <span class="text-muted font-weight-bolder font-size-lg"> {{ $quiz_details[0]['quiz_type']}}</span>
                        </div>


                    </div>

                    <div class="col-6 col-md-3">
                        <div class="mb-8 d-flex flex-column">
                            <span class="text-dark font-weight-bold mb-4">Quiz Category</span>
                            <span class="text-muted font-weight-bolder font-size-lg"> {{ $quiz_details[0]['quiz_category']}}</span>
                        </div>
                    </div>

                    <div class="col-6 col-md-3">
                        <div class="mb-8 d-flex flex-column">
                            <span class="text-dark font-weight-bold mb-4">Quiz Name</span>
                            <span class="text-muted font-weight-bolder font-size-lg"> {{ $quiz_details[0]['name']}}</span>
                        </div>

                        <div class="mb-8 d-flex flex-column">
                            <span class="text-dark font-weight-bold mb-4">Quiz Time</span>
                            <span class="text-muted font-weight-bolder font-size-lg"> {{ $quiz_details[0]['time'] }}</span>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!--end::Engage Widget 14-->
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <!--begin::Card-->
        <div class="card card-custom gutter-b example example-compact">
            <div class="card-header">
                <h3 class="card-title">{{ $header['title'] }}</h3>
            </div>
            <!--begin::Form-->
            <form id="edit-question" enctype="multipart/form-data" method="POST" action="{{ route('save-quiz-question-edit') }}">
                @csrf
                <input type="hidden" name="quizId" class="form-control" placeholder="Enter your answer 1" value="{{ $quiz_details[0]['id']}}" >
                <input type="hidden" name="questionId" class="form-control" placeholder="Enter your answer 1" value="{{ $question_details[0]['id']}}" >
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Question
                                <span class="text-danger">*</span></label>
                                <textarea name="question" placeholder="Please enter question"  class="form-control" >{{ $question_details[0]['question']}}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Answer 1
                                <span class="text-danger">*</span></label>
                                <input type="text" name="answer1" class="form-control" value="{{ $question_details[0]['answer1']}}" placeholder="Enter your answer 1" >
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Answer 2
                                <span class="text-danger">*</span></label>
                                <input type="text" name="answer2" class="form-control" value="{{ $question_details[0]['answer2']}}" placeholder="Enter your answer 2" >
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Answer 3
                                <span class="text-danger">*</span></label>
                                <input type="text" name="answer3" class="form-control" value="{{ $question_details[0]['answer3']}}" placeholder="Enter your answer 3" >
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Answer 4
                                <span class="text-danger">*</span></label>
                                <input type="text" name="answer4" class="form-control" value="{{ $question_details[0]['answer4']}}" placeholder="Enter your answer 4" >
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Answer<span class="text-danger">*</span></label>
                                <div class="radio-inline " style="margin-top:10px">
                                    <label class="radio radio-lg radio-success" >
                                    <input type="radio" name="answer" class="radio-btn" value="1" {{ $question_details[0]['right_answer'] == '1' ? 'checked="checked"' : ''}}/>
                                    <span></span>Answer 1</label>
                                    <label class="radio radio-lg radio-success" >
                                    <input type="radio" name="answer" class="radio-btn" value="2" {{ $question_details[0]['right_answer'] == '2' ? 'checked="checked"' : ''}}/>
                                    <span></span>Answer 2</label>
                                    <label class="radio radio-lg radio-success" >
                                    <input type="radio" name="answer" class="radio-btn" value="3" {{ $question_details[0]['right_answer'] == '3' ? 'checked="checked"' : ''}}/>
                                    <span></span>Answer 3</label>
                                    <label class="radio radio-lg radio-success" >
                                    <input type="radio" name="answer" class="radio-btn" value="4"  {{ $question_details[0]['right_answer'] == '4' ? 'checked="checked"' : ''}}/>
                                    <span></span>Answer 4</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Status<span class="text-danger">*</span></label>
                                <div class="radio-inline" style="margin-top:10px">
                                    <label class="radio radio-lg radio-success" >
                                    <input type="radio" name="status" class="radio-btn" value="Y" {{ $question_details[0]['status'] == 'Y' ? 'checked="checked"' : ''}}/>
                                    <span></span>Active</label>
                                    <label class="radio radio-lg radio-danger" >
                                    <input type="radio" name="status" class="radio-btn" value="N" {{ $question_details[0]['status'] == 'N' ? 'checked="checked"' : ''}}/>
                                    <span></span>Inactive</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary mr-2 submitbtn">Save Change</button>
                    <button type="reset" class="btn btn-secondary">Cancel</button>
                </div>
            </form>
            <!--end::Form-->
        </div>
        <!--end::Card-->

    </div>

</div>
    </div>
</div>

@endsection
