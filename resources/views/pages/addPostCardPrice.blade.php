{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

    @if (\Session::has('success'))
        <div class="alert alert-success">
            <ul>
                <li>{!! \Session::get('success') !!}</li>
            </ul>
        </div>
    @endif
    @if (\Session::has('error'))
        <div class="alert alert-danger">
            <ul>
                <li>{!! \Session::get('error') !!}</li>
            </ul>
        </div>
    @endif
    <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">Add Post Card Price
                </h3>
            </div>
        </div>

        <div class="card-body">
            <form class="form"  action="{{ route('submitPostCardPrice') }}" method="POST">
            {{ csrf_field() }}
            <!--begin::Search Form-->
                <div class="mt-2 mb-5 mt-lg-5 mb-lg-12">
                    <div class="row align-items-center">
                        <div class="col-lg-10 col-xl-8">
                            <div class="row align-items-center">
                                <div class="col-md-10 my-2 my-md-0">
                                    <div class="input-icon">
                                        <input type="text" name="postCardPrice" class="form-control" placeholder="Add Current Price Here..." id="kt_datatable_search_query"/>
                                        <span><i class="flaticon2-pen text-danger"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-2 mb-5 mt-lg-5 mb-lg-12">
                    <div class="row align-items-center">
                        <div class="col-lg-2 col-xl-4 mt-5 mt-lg-0">
                            <button type="submit" class="btn btn-light-primary px-6 font-weight-bold">Submit</button>
                        </div>
                    </div>
                </div>
                <!--end::Search Form-->
            </form>
        </div>


    </div>

@endsection

{{-- Styles Section --}}
@section('styles')
    <link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css"/>
@endsection


{{-- Scripts Section --}}
@section('scripts')
    {{-- vendors --}}
    <script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>

    {{-- page scripts --}}
    <script src="{{ asset('js/pages/crud/datatables/basic/basic.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>


@endsection
