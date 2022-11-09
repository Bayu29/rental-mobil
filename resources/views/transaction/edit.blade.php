@extends('layouts.master')
@section('title', 'Edit Transaction')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Merchant</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('transaction.index') }}">Transaction</a></li>
                            <li class="breadcrumb-item active">Create</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('transaction.update', $transaction->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title text-bold">Data Informasi Customer</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="row gy-3">
                                                <div class="col-md-3 col-md-6">
                                                    <div>
                                                        <label for="customer_name">Nama Customer</label>
                                                        <input type="text"
                                                            class="form-control @error('customer_name') is-invalid @enderror"
                                                            name="customer_name" id="customer_name" placeholder=""
                                                            value="{{ old('customer_name') ? old('customer_name') : $transaction->customer_name }}" autocomplete="off">
                                                        @error('customer_name')
                                                        <span style="color: red;">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-md-6">
                                                    <div>
                                                        <label for="customer_phone">No HP Customer</label>
                                                        <input type="text"
                                                            class="form-control @error('customer_phone') is-invalid @enderror"
                                                            name="customer_phone" id="customer_phone" placeholder=""
                                                            value="{{ old('customer_phone') ? old('customer_phone') : $transaction->customer_phone }}" autocomplete="off">
                                                        @error('customer_phone')
                                                        <span style="color: red;">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-md-6">
                                                    <div>
                                                        <label for="customer_address">Alamat Customer</label>
                                                        <textarea name="customer_address" class="form-control @error('customer_address') is-invalid @enderror" id="customer_address" cols="30" rows="10">{{ old('customer_address') ? old('customer_address') : $transaction->customer_address }}</textarea>
                                                        @error('customer_address')
                                                        <span style="color: red;">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-md-6">
                                                     <div>
                                                        <label for="customer_address">Tujuan Customer</label>
                                                        <textarea name="customer_destination" class="form-control @error('customer_destination') is-invalid @enderror" id="customer_address" cols="30" rows="10">{{ old('customer_destination') ? old('customer_destination') : $transaction->customer_destination }}</textarea>
                                                        @error('customer_destination')
                                                        <span style="color: red;">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-md-6">
                                                    <div>
                                                        <label for="customer_id_card_number">NIK Customer</label>
                                                        <input type="text"
                                                            class="form-control @error('customer_id_card_number') is-invalid @enderror"
                                                            name="customer_id_card_number" id="customer_id_card_number" placeholder=""
                                                            value="{{ old('customer_id_card_number') ? old('customer_id_card_number') : $transaction->customer_id_card_number }}" autocomplete="off">
                                                        @error('customer_id_card_number')
                                                        <span style="color: red;">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-md-6">
                                                    <div>
                                                        <label for="customer_sim_card_number">Nomor Sim Customer</label>
                                                        <input type="text"
                                                            class="form-control @error('customer_sim_card_number') is-invalid @enderror"
                                                            name="customer_sim_card_number" id="customer_sim_card_number" placeholder=""
                                                            value="{{ old('customer_sim_card_number') ? old('customer_sim_card_number') : $transaction->customer_sim_card_number }}" autocomplete="off">
                                                        @error('customer_sim_card_number')
                                                        <span style="color: red;">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h3 class="card-title text-bold">Data Peminjaman Mobil</h3>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row gy-3">
                                                        <div class="col-md-3 col-md-6">
                                                            <div>
                                                                <label for="car_id">Mobil</label>
                                                                <select
                                                                    class="form-control @error('car_id') @enderror"
                                                                    name="car_id" id="car_id">
                                                                    <option value="">-- Select --</option>
                                                                    @foreach ($cars as $car)
                                                                    <option value="{{ $car->id }}" {{
                                                                        $transaction->car_id == $car->id ?
                                                                        'selected' : ''}}>{{ $car->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                                @error('car_id')
                                                                <span style="color: red;">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 col-md-6">
                                                            <div>
                                                                <label for="driver_id">Driver</label>
                                                                <select class="form-control @error('driver_id') @enderror"
                                                                    name="driver_id" id="driver_id">
                                                                    <option value="">-- Select --</option>
                                                                    @foreach ($drivers as $driver)
                                                                    <option value="{{ $driver->id }}" {{
                                                                        $transaction->driver_id == $driver->id ? 'selected' : ''}}>{{
                                                                        $driver->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                                @error('driver_id')
                                                                <span style="color: red;">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 col-md-6">
                                                            <div>
                                                                <label for="pick_date">Tgl Ambil</label>
                                                                <input type="text"
                                                                    class="form-control @error('pick_date') is-invalid @enderror"
                                                                    name="pick_date" id="pick_date" placeholder=""
                                                                    value="{{ old('pick_date') ? old('pick_date') : $transaction->pick_date }}"
                                                                    autocomplete="off">
                                                                @error('pick_date')
                                                                <span style="color: red;">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 col-md-6">
                                                            <div>
                                                                <label for="due_date">Tenggat Waktu pinjam</label>
                                                                <input type="text"
                                                                    class="form-control @error('due_date') is-invalid @enderror"
                                                                    name="due_date" id="due_date"
                                                                    placeholder="" value="{{ old('due_date') ? old('due_date') : $transaction->due_date }}"
                                                                    autocomplete="off">
                                                                @error('due_date')
                                                                <span style="color: red;">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 col-md-6">
                                                            <div>
                                                                <label for="return_date">Tanggal Kembali</label>
                                                                <input type="text"
                                                                    class="form-control @error('return_date') is-invalid @enderror"
                                                                    name="return_date" id="return_date"
                                                                    placeholder="" value="{{ old('return_date') ? old('return_date') : $transaction->return_date }}"
                                                                    autocomplete="off">
                                                                @error('return_date')
                                                                <span style="color: red;">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 col-md-6">
                                                            <div>
                                                                <label for="car_status">Status mobil</label>
                                                                <select class="form-control @error('car_status') @enderror"
                                                                    name="car_status" id="car_status">
                                                                    <option value="">-- Select --</option>
                                                                    <option value="unpickup" {{ $transaction->car_status == 'unpickup' ? 'selected' : '' }}>Belum diambil</option>
                                                                    <option value="unreturn" {{ $transaction->car_status == 'unreturn' ? 'selected' : '' }}>Belum Kembali</option>
                                                                    <option value="returned" {{ $transaction->car_status == 'returned' ? 'selected' : '' }}>Kembali</option>
                                                                </select>
                                                                @error('car_status')
                                                                <span style="color: red;">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 col-md-6">
                                                            <div>
                                                                <label for="transaction_status">Status</label>
                                                                <select class="form-control @error('transaction_status') @enderror"
                                                                    name="transaction_status" id="transaction_status">
                                                                    <option value="">-- Select --</option>
                                                                    <option {{ $transaction->status == 'unpaid' ? 'selected' : '' }} value="unpaid">Belum dibayar</option>
                                                                    <option {{ $transaction->status == 'paid' ? 'selected' : '' }} value="paid">Dibayar</option>
                                                                    <option {{ $transaction->status == 'refund' ? 'selected' : '' }} value="refund">Dibatalkan</option>
                                                                </select>
                                                                @error('transaction_status')
                                                                <span style="color: red;">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="card">
                                                 <div class="card-header">
                                                    <h3 class="card-title text-bold">Persetujuan</h3>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row gy-3">
                                                        <div class="col-md-3 col-md-6">
                                                            <div>
                                                                <label for="approved1">Persetujuan 1</label>
                                                                <select
                                                                    class="form-control @error('approved1') @enderror"
                                                                    name="approved1" id="approved1">
                                                                    <option value="">-- Select --</option>
                                                                    <option {{ $transaction->approved1 == 'pending' ? 'selected' : '' }} value="pending">Pending</option>
                                                                    <option {{ $transaction->approved1 == 'approved' ? 'selected' : '' }} value="approved">Disetujui</option>
                                                                    <option {{ $transaction->approved1 == 'rejected' ? 'selected' : '' }} value="rejected">Ditolak</option>
                                                                </select>
                                                                @error('approved1')
                                                                <span style="color: red;">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        @can('transaction_approved2')
                                                        <div class="col-md-3 col-md-6">
                                                            <div>
                                                                <label for="approved2">Persetujuan 2</label>
                                                                <select
                                                                    class="form-control @error('approved2') @enderror"
                                                                    name="approved2" id="approved2">
                                                                    <option value="">-- Select --</option>
                                                                    <option {{ $transaction->approved2 == 'pending' ? 'selected' : '' }} value="pending">Pending</option>
                                                                    <option {{ $transaction->approved2 == 'approved' ? 'selected' : '' }} value="approved">Disetujui</option>
                                                                    <option {{ $transaction->approved2 == 'rejected' ? 'selected' : '' }} value="rejected">Ditolak</option>
                                                                </select>
                                                                @error('approved2')
                                                                <span style="color: red;">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        @endcan
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="card">
                                                 <div class="card-header">
                                                    <h3 class="card-title text-bold">Biaya</h3>
                                                </div>
                                                <div class="card-body">
                                                    <div>
                                                        <table>
                                                            <tr>
                                                                <th>Biaya Sewa Mobil :</th>
                                                                <td class="ml-auto" id="biaya_sewa_mobil">Rp. 0</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Biaya Sewa Driver :</th>
                                                                <td class="ml-auto" id="biaya_sewa_driver">Rp. 0</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Total Biaya :</th>
                                                                <td class="ml-auto" id="total_biaya">Rp. 0</td>
                                                            </tr>
                                                        </table>
                                                    </div>

                                                    <div class="form-group float-end">
                                                        <button class="btn btn-primary" type="button" onclick="cekBiaya();">Cek Biaya</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <a href="{{ route('transaction.index') }}" class="btn btn-warning"><i
                                                class="mdi mdi-arrow-left-thin"></i> Back</a>
                                        <button type="submit" class="btn btn-primary"><i
                                                class="mdi mdi-content-save"></i> SIMPAN</button>
                                    </div>
                                </div>
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
flatpickr('#pick_date',{});
flatpickr('#due_date',{});
flatpickr('#return_date',{});
function cekBiaya()
{
    var car_id = $('select[name=car_id] option').filter(':selected').val();
    var driver_id = $('select[name=driver_id] option').filter(':selected').val()
    var pick_date = $('#pick_date').val();
    var due_date = $('#due_date').val();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'post',
        url: "{{ route('transaction.calculation') }}",
        data: {
            car_id : car_id,
            driver_id: driver_id,
            pick_date: pick_date,
            due_date: due_date,
        }, success:function(res) {
            $('#biaya_sewa_mobil').text(`Rp. ${convertToRupiah(res.car_fee)}`);
            $('#biaya_sewa_driver').text(`Rp. ${convertToRupiah(res.driver_fee)} `);
            $('#total_biaya').text(`Rp. ${convertToRupiah(res.total_charge)}`);
        }
    })
}

function convertToRupiah(angka) {
  var rupiah = "";
  var angkarev = angka.toString().split("").reverse().join("");
  for (var i = 0; i < angkarev.length; i++)
    if (i % 3 == 0) rupiah += angkarev.substr(i, 3) + ".";
  return rupiah
    .split("", rupiah.length - 1)
    .reverse()
    .join("");
}

</script>

@endpush
