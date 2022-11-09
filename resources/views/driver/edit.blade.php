@extends('layouts.master')
@section('title', 'Edit Driver')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Driver</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('driver.index') }}">Driver</a></li>
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
                        <form action="{{ route('driver.update', $driver->id) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="name">Nama Driver</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="" value="{{ old('name') ? old('name') : $driver->name }}" autocomplete="off">
                                @error('name')
                                <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="number_sim_card">Nomor SIM</label>
                                <input type="text" class="form-control @error('number_sim_card') is-invalid @enderror" name="number_sim_card" id="number_sim_card" placeholder="" value="{{ old('number_sim_card') ? old('number_sim_card') : $driver->number_sim_card }}" autocomplete="off">
                                @error('number_sim_card')
                                <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="type">Gender</label>
                                <select class="form-control @error('gender') is-invalid @enderror" name="gender" id="gender">
                                    <option value="">Pilih Type</option>
                                    <option {{ $driver->gender == 'male' ? 'selected' : '' }} value="male">Pria</option>
                                    <option {{ $driver->gender == 'female' ? 'selected' : '' }} value="female">Wanita</option>
                                </select>
                                @error('gender')
                                <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="birthday">Birthday</label>
                                <input type="text" class="form-control @error('birthday') is-invalid @enderror" name="birthday" id="birthday" placeholder="" value="{{ old('birthday') ? old('birthday') : $driver->birthday }}" autocomplete="off">
                                @error('birthday')
                                <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="phone">Phone</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone" placeholder="" value="{{ old('phone') ? old('phone') : $driver->phone }}" autocomplete="off">
                                @error('phone')
                                <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="capacity">Address</label>
                                <textarea name="address" class="form-control @error('address') is-invalid @enderror" id="address" cols="30" rows="10">{{ $driver->address }}</textarea>
                                @error('address')
                                <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="status">Status</label>
                                <select class="form-control @error('status') is-invalid @enderror" name="status" id="car_status">
                                    <option value="">Pilih Status</option>
                                    <option {{ $driver->status == 'available' ? 'selected' : '' }} value="available">Tersedia</option>
                                    <option {{ $driver->status == 'non_available' ? 'selected' : '' }} value="non_available">Tidak Tersedia</option>
                                </select>
                                @error('status')
                                <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="fee">Sewa / Hari</label>
                                <input type="number" class="form-control @error('fee') is-invalid @enderror" name="fee" id="fee" placeholder="" value="{{ old('fee') ? old('fee') : $driver->fee }}" autocomplete="off">
                                @error('fee')
                                <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <a href="{{ route('driver.index') }}" class="btn btn-warning"><i class="mdi mdi-arrow-left-thin"></i> Back</a>
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
flatpickr('#birthday', {});
</script>
@endpush
