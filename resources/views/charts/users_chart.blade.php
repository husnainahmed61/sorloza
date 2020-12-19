{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')
    <div class="card card-custom">
        <div class="card-body">
            <form class="form"  action="{{ route('users-chart') }}" method="get">
            {{ csrf_field() }}
            <!--begin::Search Form-->
                <div class="mt-2 mb-5 mt-lg-5 mb-lg-12">
                    <div class="row align-items-center">
                        <div class="col-lg-4 col-xl-8">
                            <div class="row align-items-center">
                                <div class="col-md-6 my-2 my-md-0">
                                    <div class="input-icon">
                                        <input type="date" name="dateFrom" class="form-control" id="kt_datatable_search_query"/>
                                        <span><i class="flaticon2-pen text-danger"></i></span>
                                    </div>
                                </div>
                                <div class="col-md-6 my-2 my-md-0">
                                    <div class="input-icon">
                                        <input type="date" name="dateTo" class="form-control" id="kt_datatable_search_query"/>
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
                            <button type="submit" class="btn btn-light-primary px-6 font-weight-bold">Search</button>
                        </div>
                    </div>
                </div>
                <!--end::Search Form-->
            </form>
        </div>
    </div>


    <hr>
<script type = "text/javascript" src = "https://www.gstatic.com/charts/loader.js">
</script>
<script type = "text/javascript">
    google.charts.load('current', {packages: ['corechart','line']});
</script>
<script type="text/javascript">

    function drawChart() {
        // Define the chart to be drawn.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Month');
        data.addColumn('number', 'Registered Users ');

        data.addRows([
                @foreach($users as $user)
            ["{{ date( 'Y-m-d',strtotime($user->date) ) }}", {{ $user->users }}],
            @endforeach
        ]);

        // Set chart options
        var options = {'title' : 'Number of Users Registered Per Day.',
            hAxis: {
                title: 'Date'
            },
            vAxis: {
                title: 'Users'
            },
            'width':1000,
            'height':400,
            pointsVisible: true
        };

        // Instantiate and draw the chart.
        var chart = new google.visualization.LineChart(document.getElementById('container'));
        chart.draw(data, options);
    }
    google.charts.setOnLoadCallback(drawChart);
</script>

<div id="container" ></div>
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



