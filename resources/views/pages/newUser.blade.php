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
                <h3 class="card-label">Create New User
                    <div class="text-muted pt-2 font-size-sm">Create New User</div>
                </h3>
            </div>
        </div>

        <div class="card-body">
        <form method="post" action="{{ route('store-user') }}">
            @csrf
            <div class="row">
                <div class="form-group col-sm-6 row">
                    <label for="inputPassword" class="col-sm-3 col-form-label">Email :</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="email" id="inputPassword" placeholder="Email...">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-sm-6 row">
                    <label for="inputPassword" class="col-sm-3 col-form-label">First Name :</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="first_name" id="inputPassword" placeholder="First Name...">
                    </div>
                </div>
                <div class="form-group col-sm-6 row">
                    <label for="inputPassword" class="col-sm-3 col-form-label">Last Name :</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="last_name" id="inputPassword" placeholder="Last Name...">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-sm-6 row">
                    <label for="inputPassword" class="col-sm-3 col-form-label">Contact :</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="contact" id="inputPassword" placeholder="Contact...">
                    </div>
                </div>
                <div class="form-group col-sm-6 row">
                    <label for="inputPassword" class="col-sm-3 col-form-label">Postal Address :</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="postal_address" id="inputPassword" placeholder="Postal Address...">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-sm-6 row">
                    <label for="inputPassword" class="col-sm-3 col-form-label">Permanent Address :</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="permenant_address" id="inputPassword" placeholder="Permanent Address...">
                    </div>
                </div>
                <div class="form-group col-sm-6 row">
                    <label for="inputPassword" class="col-sm-3 col-form-label">Postal Code :</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="postal_code" id="inputPassword" placeholder="Postal Code...">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-sm-6 row">
                    <label for="inputPassword" class="col-sm-3 col-form-label">City :</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="city" id="inputPassword" placeholder="City...">
                    </div>
                </div>
                <div class="form-group col-sm-6 row">
                    <label for="inputPassword" class="col-sm-3 col-form-label">Country :</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="country" id="inputPassword" placeholder="Country...">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-sm-6 row">
                    <label for="inputPassword" class="col-sm-3 col-form-label">State :</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="state" id="inputPassword" placeholder="State...">
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="form-group col-sm-6 row">
                    <button type="submit" class="btn btn-light-primary px-6 font-weight-bold">Submit</button>
                </div>
            </div>
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
