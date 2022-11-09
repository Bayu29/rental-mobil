@extends('layouts.master')
@section('title', 'Edit Car')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Car</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('car.index') }}">Car</a></li>
                            <li class="breadcrumb-item active">Edit</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('car.update', $car->id) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="name">Nama Mobil</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="" value="{{ old('name') ? old('name') : $car->name }}" autocomplete="off">
                                @error('name')
                                <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="color">Warna Mobil</label>
                                <input type="text" class="form-control @error('color') is-invalid @enderror" name="color" id="color" placeholder="" value="{{ old('color') ? old('color') : $car->color }}" autocomplete="off">
                                @error('color')
                                <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="police_number">Nomor Polisi / Plat Nomor</label>
                                <input type="text" class="form-control @error('police_number') is-invalid @enderror" name="police_number" id="police_number" placeholder="" value="{{ old('police_number') ? old('police_number') : $car->police_number }}" autocomplete="off">
                                @error('police_number')
                                <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="cc">CC</label>
                                <input type="text" class="form-control @error('cc') is-invalid @enderror" name="cc" id="cc" placeholder="" value="{{ old('cc') ? old('cc') : $car->cc }}" autocomplete="off">
                                @error('cc')
                                <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="capacity">Capacity</label>
                                <input type="number" class="form-control @error('capacity') is-invalid @enderror" name="capacity" id="capacity" placeholder="" value="{{ old('capacity') ? old('capacity') : $car->capacity }}" autocomplete="off">
                                @error('capacity')
                                <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="color">year</label>
                                <input type="text" class="form-control @error('year') is-invalid @enderror" name="year" id="year" placeholder="" value="{{ old('year') ? old('year') : $car->year }}" autocomplete="off">
                                @error('year')
                                <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="type">Type</label>
                                <select class="form-control @error('type') is-invalid @enderror" name="type" id="type">
                                    <option value="">Pilih Type</option>
                                    <option {{ $car->type == 'manual' ? 'selected' : '' }} value="manual">Manual</option>
                                    <option {{$car->type == 'matic' ? 'selected' : ''}} value="matic">Matic</option>
                                </select>
                                @error('type')
                                <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="status">Status</label>
                                <select class="form-control @error('status') is-invalid @enderror" name="status" id="car_status">
                                    <option value="">Pilih Status</option>
                                    <option {{ $car->status == 'available' ? 'selected' : '' }} value="available">Tersedia</option>
                                    <option {{ $car->status == 'non_available' ? 'selected' : '' }} value="non_available">Tidak Tersedia</option>
                                    <option {{ $car->status == 'repaired' ? 'selected' : '' }} value="repaired">Sedang Perbaikan</option>
                                </select>
                                @error('status')
                                <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="fee">Sewa / Hari</label>
                                <input type="number" class="form-control @error('fee') is-invalid @enderror" name="fee" id="fee" placeholder="" value="{{ old('fee') ? old('fee') : $car->fee }}" autocomplete="off">
                                @error('fee')
                                <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <a href="{{ route('car.index') }}" class="btn btn-warning"><i class="mdi mdi-arrow-left-thin"></i> Back</a>
                                <button type="submit" class="btn btn-primary" ><i class="mdi mdi-content-save"></i> SIMPAN</button>
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

</script>
@endpush
