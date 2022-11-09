@extends('layouts.master')
@section('title', 'Data Mobil')
@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Mobil</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Mobil</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        @can('car_create')
                        <a href="{{ route('car.create') }}" class="btn btn-md btn-secondary"> <i
                                class="mdi mdi-plus"></i> Create</a>
                        @endcan
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm" id="dataTable" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Warna</th>
                                        <th>Plat Nomor</th>
                                        <th>cc</th>
                                        <th>Kapasitas</th>
                                        <th>Tahun</th>
                                        <th>Type</th>
                                        <th>Status</th>
                                        <th>Sewa / Jam</th>
                                        @canany(['car_update', 'car_delete'])
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
    const action = '{{ auth()->user()->can('car_update') || auth()->user()->can('car_delete') ? 'yes yes yes' : '' }}'
        let columns = [
            {
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                orderable: false,
                searchable: false
            },
            {
                data: 'name',
                name: 'name'
            },
            {
                data: 'color',
                name: 'color'
            },
            {
                data: 'police_number',
                name: 'police_number'
            },
            {
                data: 'cc',
                name: 'cc'
            },
            {
                data: 'capacity',
                name: 'capacaity'
            },
            {
                data: 'year',
                name: 'year'
            },
            {
                data: 'type',
                name: 'type'
            },
            {
                data: 'status',
                name: 'status'
            },
            {
                data: 'fee',
                name: 'fee'
            },
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
            ajax: "{{ route('car.index') }}",
            columns: columns
        });
</script>
@endpush
