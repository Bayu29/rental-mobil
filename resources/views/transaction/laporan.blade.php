@extends('layouts.master')
@section('title', 'Laporan Transaksi')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Laporan Transaksi</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('transaction.index') }}">Transaction</a></li>
                            <li class="breadcrumb-item active">Report</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('transaction.export_excel') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="date">Range Transaction Report</label>
                                <input type="text" name="date" class="form-control border-0 dash-filter-picker shadow" data-provider="flatpickr" data-range-date="true" data-date-format="d M, Y" data-deafult-date="{{ date('d M,Y', strtotime($start_month)) }} to {{ date('d M,Y', strtotime($end_month)) }}">
                                @error('date')
                                <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <a href="{{ route('transaction.index') }}" class="btn btn-warning"><i class="mdi mdi-arrow-left-thin"></i> Back</a>
                                <button type="submit" class="btn btn-primary" ><i class="mdi mdi-content-save"></i> Download laporan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection

@push('js')
<script>
flatpickr('#birthday', {});
</script>
@endpush
