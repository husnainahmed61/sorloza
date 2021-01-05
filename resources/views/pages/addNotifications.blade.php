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
                <h3 class="card-label">Add Notifications
                </h3>
            </div>
        </div>

        <div class="card-body">
            <form class="form"  action="{{ route('submitNotification') }}" method="POST">
            {{ csrf_field() }}
            <!--begin::Search Form-->
            <div class="mt-2 mb-5 mt-lg-5 mb-lg-12">
                <div class="row align-items-center">
                    <div class="col-lg-10 col-xl-8">
                        <div class="row align-items-center">
                            <div class="col-md-10 my-2 my-md-0">
                                <div class="input-icon">
                                    <input type="text" name="notification" class="form-control" placeholder="Write notification here...." id="kt_datatable_search_query"/>
                                    <span><i class="flaticon2-pen text-danger"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-md-4">
                    <label class="">Select Users:</label>
                    <select class="form-control mt-multiselect" name="users[]" id="example-selectAllJustVisible"  multiple="multiple">
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="type" value="notification" checked>
                        <label class="form-check-label" for="inlineRadio1">Notification</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="type" value="email">
                        <label class="form-check-label" for="inlineRadio2">E-mail</label>
                    </div>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-light-primary px-6 font-weight-bold">Send</button>
                </div>
            </div>
            <!--end::Search Form-->
            </form>
        </div>

        <hr>
        <div class="card-body">
            <table class="table table-bordered table-hover" id="">
                <thead>
                <tr>
                    <th>Record ID</th>
                    <th>Notification Body</th>
                    <th>Type</th>
                    <th>Created At</th>
                </tr>
                </thead>
                <tbody>
                <?php $i=1 ?>
                @foreach ($notifications as $notification)
                    <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $notification->body }}</td>
                        <td>{{ $notification->type }}</td>
                        <td>{{ $notification->created_at }}</td>
                        <td nowrap></td>
                    </tr>
                    <?php $i++ ?>
                @endforeach
                </tbody>
            </table>

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
    <script type="text/javascript">
        $(document).ready(function() {
            $('#example-selectAllJustVisible').multiselect({
                enableFiltering: true,
                includeSelectAllOption: true,
                selectAllJustVisible: false
            });
        });
    </script>

@endsection
