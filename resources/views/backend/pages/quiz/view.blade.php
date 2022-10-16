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
        <div class="col-md-12">
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
                        <div class="col-6 col-md-9">
                            <div class="row">
                                <div class="col-3 col-md-3">
                                    <div class="mb-8 d-flex flex-column">
                                        <span class="text-dark font-weight-bold mb-4">Quiz Type</span>
                                        <span class="text-muted font-weight-bolder font-size-lg"> {{ $quiz_details[0]['quiz_type']}}</span>
                                    </div>
                                </div>

                                <div class="col-3 col-md-3">
                                    <div class="mb-8 d-flex flex-column">
                                        <span class="text-dark font-weight-bold mb-4">Quiz Category</span>
                                        <span class="text-muted font-weight-bolder font-size-lg"> {{ $quiz_details[0]['quiz_category']}}</span>
                                    </div>
                                </div>

                                <div class="col-3 col-md-3">
                                    <div class="mb-8 d-flex flex-column">
                                        <span class="text-dark font-weight-bold mb-4">Quiz Name</span>
                                        <span class="text-muted font-weight-bolder font-size-lg"> {{ $quiz_details[0]['name']}}</span>
                                    </div>
                                </div>

                                <div class="col-3 col-md-3">
                                    <div class="mb-8 d-flex flex-column">
                                        <span class="text-dark font-weight-bold mb-4">Each Question Time</span>
                                        <span class="text-muted font-weight-bolder font-size-lg"> {{ $quiz_details[0]['time']}}</span>
                                    </div>
                                </div>
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
            @csrf

            <!--begin::Card-->
            <div class="card card-custom gutter-b">
                <div class="card-header flex-wrap py-3">
                    <input type="hidden" value="{{ $quiz_details[0]['id']}}" id="quiz_id">
                    <div class="card-title">
                        <h3 class="card-label">Number of Question </h3>
                    </div>


                    <div class="card-toolbar">
                        <!--begin::Button-->
                        <a href="{{ route('quiz-add-question', $quiz_details[0]['id']) }}" class="btn btn-primary font-weight-bolder">
                            Add Question
                        </a>
                        <!--end::Button-->
                    </div>


                </div>
                <div class="card-body">
                    <!--begin: Datatable-->
                    <table class="table table-bordered table-checkable"  id="quiz-question-master">
                        <thead>
                            <tr>
                                <th>Sr. No</th>
                                <th>Question</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                    <!--end: Datatable-->
                </div>
            </div>
            <!--end::Card-->
        </div>
    </div>
    <!--end::Section-->
    </div>
</div>

@endsection
