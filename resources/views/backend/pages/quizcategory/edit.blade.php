@extends('backend.layout.layout')
@section('section')
<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <!--begin::Card-->
                <div class="card card-custom gutter-b example example-compact">
                    <div class="card-header">
                        <h3 class="card-title">{{ $header['title'] }}</h3>
                    </div>
                    <!--begin::Form-->
                    <form id="edit-quiz-category" enctype="multipart/form-data" method="POST" action="{{ route('save-quiz-category-edit') }}">
                        @csrf
                        <div class="card-body">

                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Quiz Type
                                        <span class="text-danger">*</span></label>

                                        <select class="form-control select2" id="quiz_type"  name="quiz_type">
                                            <option value="">Select your quiz type</option>

                                             @foreach ($quiz_type as $key => $value)
                                                 <option value="{{ $value['id'] }}" {{ $quiz_category_details[0]['quiz_type'] == $value['id'] ? 'selected="selected"' : ''}} >{{ $value['name'] }}</option>
                                             @endforeach

                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Quiz Category
                                        <span class="text-danger">*</span></label>
                                        <input type="hidden" name="editId" class="form-control" placeholder="Enter editId" value="{{ $quiz_category_details[0]['id'] }}">
                                        <input type="text" name="quiz_category" class="form-control" placeholder="Enter Quiz Category" value="{{ $quiz_category_details[0]['name'] }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Status<span class="text-danger">*</span></label>
                                        <div class="radio-inline" style="margin-top:10px">
                                            <label class="radio radio-lg radio-success" >
                                            <input type="radio" name="status" class="radio-btn" value="Y" {{ $quiz_category_details[0]['status'] == 'Y' ? 'checked="checked"': ''}}/>
                                            <span></span>Active</label>
                                            <label class="radio radio-lg radio-danger" >
                                            <input type="radio" name="status" class="radio-btn" value="N" {{ $quiz_category_details[0]['status'] == 'N' ? 'checked="checked"': ''}}/>
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
