@extends('layouts.master')
@section('title', 'Data Transaksi')
@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Transaksi</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Transaksi</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        @can('transaction_create')
                        <a href="{{ route('transaction.create') }}" class="btn btn-md btn-secondary"> <i
                                class="mdi mdi-plus"></i> Create</a>
                        @endcan
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm" id="dataTable" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Customer</th>
                                        <th>No HP Customer</th>
                                        <th>Mobil</th>
                                        <th>Driver</th>
                                        <th>Sewa hari</th>
                                        <th>Tgl Ambil</th>
                                        <th>Tgl Kembali</th>
                                        <th>Status</th>
                                        <th>Total Biaya</th>
                                        <th>Kasir</th>
                                        @canany(['transaction_show','transaction_update', 'transaction_delete'])
                                        <th>Action</th>
                                        @endcanany
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
@push('js')
<script>
    const action = '{{ auth()->user()->can('transaction_update') || auth()->user()->can('transaction_show') }}'
        let columns = [
            {
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                orderable: false,
                searchable: false
            },
            {
                data: 'customer_name',
                name: 'customer_name'
            },
            {
                data: 'customer_phone',
                name: 'customer_phone'
            },
            {
                data: 'car',
                name: 'car'
            },
            {
                data: 'driver',
                name: 'driver',
            },
            {
                data: 'loan_day',
                name: 'loan_day'
            },
            {
                data: 'pick_date',
                name: 'pick_date'
            },
            {
                data: 'due_date',
                name: 'due_date'
            },
            {
                data: 'status',
                name: 'status'
            },
            {
                data: 'total_charge',
                name: 'total_charge'
            },
            {
                data: 'user',
                name: 'user'
            }
        ]

        if (action) {
            columns.push({
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            })
        }

        $('#dataTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('transaction.index') }}",
            columns: columns
        });
</script>
@endpush
