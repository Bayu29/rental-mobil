@extends('layouts.master')

@section('title', 'Dashboard')
@push('style')
<style>
.ui-datepicker-calendar {
   display: none;
}
</style>
@endpush
@section('content')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Dashboard</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col">

                <div class="h-100">
                    <div class="row mb-3 pb-1">
                        <div class="col-12">
                            <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                                <div class="flex-grow-1">
                                    <h4 class="fs-16 mb-1">Good Morning, {{ Auth::user()->name }}</h4>
                                </div>
                            </div><!-- end card header -->
                        </div>
                        <!--end col-->
                    </div>
                    <!--end row-->

                    <div class="row">
                        <!-- Transaksi Perbulan -->
                        <div class="col-xl-6">
                            <div class="card">
                                <div class="card-header p-0 border-0 bg-soft-light">
                                    <div class="d-flex">
                                        <h6 class="float-start mt-3 ml-3">Transaction Per Month</h6>
                                        <div class="float-end">
                                            <form action="{{ route('dashboard') }}" method="get" id="filter_date">
                                                @csrf
                                                <div class="input-group" style="left:100px;" >
                                                   <input type="text" class="form-control border-0 dash-filter-picker shadow" data-provider="flatpickr" data-range-date="true" data-date-format="d M, Y" value="{{ date('d M Y', strtotime($start)) }} to {{ date('d M Y', strtotime($end)) }}" id="filter_month_transaction"/>
                                                    <div class="input-group-text bg-primary border-primary text-white">
                                                        <i class="ri-calendar-2-line"></i>
                                                    </div>
                                                </div>
                                                <!--end row-->
                                            </form>
                                        </div>
                                    </div>
                                </div><!-- end card header -->
                                <div class="card-body p-0 pb-2">
                                    <div class="w-100">
                                        <div id="transaction_by_month" data-colors='["--vz-success", "--vz-primary", "--vz-danger"]' class="apex-charts" dir="ltr"></div>
                                    </div>
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div><!-- end col -->
                        <!-- End Transaksi Perbulan -->

                    </div>

                </div> <!-- end .h-100-->
            </div> <!-- end col -->
        </div>
    </div>
    <!-- container-fluid -->
</div>
<!-- End Page-content -->
@endsection
@push('js')
<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
</script>

<script>
    //Transaction By Month
    var options_month = {
        chart: {
            type: 'bar',
            animations: {
                enabled: true,
                easing: 'easeinout',
                speed: 800,
                animateGradually: {
                    enabled: true,
                    delay: 150
                },
                dynamicAnimation: {
                    enabled: true,
                    speed: 350
                }
            }
        },
        dataLabels: {
            enable: false,
        },
        legend: {
            show: false,
        },
        series: [{
            data: [
                @foreach ($car_chart as $data)
                {
                    x: "{{ $data->car_name }}",
                    y: "{{ $data->total_pemakaian }}"
                },
                @endforeach
            ]
        }]
    }
    var chart_month = new ApexCharts(document.querySelector("#transaction_by_month"), options_month);
    chart_month.render();
    //End Transaction by month
</script>

<script>
$('#filter_month_transaction').change(function() {
    var dates = $(this).val();
       var split_dates = dates.split(" to ");
       if ( split_dates.length >= 2 ) {
            var start_date = split_dates[0];
            var end_date = split_dates[1];

            $.ajax({
                type: 'post',
                url: "{{ route('dashboard.car_chart') }}",
                data: {
                    start_date: start_date,
                    end_date: end_date,
                }, success:function(result) {
                    chart_month.updateSeries([{
                        data:result
                    }])
                }
            })
       }
})

</script>
@endpush
