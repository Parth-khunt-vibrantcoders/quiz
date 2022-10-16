@extends('backend.layout.layout')
@section('section')
<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                @csrf
                <!--begin::Card-->
                <div class="card card-custom gutter-b">
                    <div class="card-header flex-wrap py-3">
                        <div class="card-title">
                            <h3 class="card-label">{{ $header['title'] }}</h3>
                        </div>


                        <div class="card-toolbar">
                            <!--begin::Button-->
                            <a href="{{ route('quiz-add') }}" class="btn btn-primary font-weight-bolder">
                                Add Quiz
                            </a>
                            <!--end::Button-->
                        </div>


                    </div>
                    <div class="card-body">
                        <!--begin: Datatable-->
                        <table class="table table-bordered table-checkable"  id="quiz-master">
                            <thead>
                                <tr>
                                    <th>Sr. No</th>
                                    <th>Image</th>
                                    <th>Type</th>
                                    <th>Category</th>
                                    <th>Name</th>
                                    <th>Per Question Time</th>
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
    </div>
</div>

@endsection
