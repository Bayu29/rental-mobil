<table class="table table-bordered" id="dataTable" style="width:100%">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama Pelanggan</th>
            <th>No Hp Pelanggan</th>
            <th>Alamat Pelanggan</th>
            <th>Tujuan Pelanggan</th>
            <th>No Nik Pelanggan</th>
            <th>No Sim Pelanggan</th>
            <th>Mobil</th>
            <th>Driver</th>
            <th>Kasir</th>
            <th>Tgl Ambil</th>
            <th>Tenggat Waktu peminjaman</th>
            <th>Tgl Kembali</th>
            <th>Status Mobil</th>
            <th>Status Transaksi</th>
            <th>Persetujuan 1</th>
            <th>Persetujuan 2</th>
            <th>Biaya Mobil</th>
            <th>Biaya Driver</th>
            <th>Biaya Keterlambatan</th>
            <th>Total Biaya</th>
            <th>Tgl Transaksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($transactions as $transaction)
        <tr>
            <td>{{ $transaction->id }}</td>
            <td>{{ $transaction->customer_name }}</td>
            <td>{{ $transaction->customer_phone }}</td>
            <td>{{ $transaction->customer_address }}</td>
            <td>{{ $transaction->customer_destination }}</td>
            <td>{{ $transaction->customer_id_card_number }}</td>
            <td>{{ $transaction->customer_sim_card_number }}</td>
            <td>{{ $transaction->car->name }}</td>
            <td>{{ $transaction->driver->name }}</td>
            <td>{{ $transaction->user->name }}</td>
            <td>{{ date('d F Y H:i:s', strtotime($transaction->pick_date)) }}</td>
            <td>{{ date('d F Y H:i:s', strtotime($transaction->due_date)) }}</td>
            <td>{{ date('d F Y H:i:s', strtotime($transaction->return_date)) }}</td>
            <td>
                @if ($transaction->car_status == 'unpickup')
                Belum Diambil
                @elseif ($transaction->car_status == 'unreturn')
                Belum kembali
                @elseif ($transaction->car_status == 'returned')
                Kembali
                @endif
            </td>
            <td>
                @if ($transaction->status == 'unpaid')
                Belum Dibayar
                @elseif ($transaction->status == 'paid')
                Dibayar
                @elseif ($transaction->status == 'canceled')
                Dibatalkan
                @endif
            </td>
            <td>
                @if ($transaction->approved1 == 'pending')
                Menunggu Persetujuan
                @elseif ($transaction->approved1 == 'approved')
                Disetujui
                @elseif ($transaction->approved1 == 'rejected')
                Ditolak
                @endif
            </td>
            <td>
                @if ($transaction->approved2 == 'pending')
                Menunggu Persetujuan
                @elseif ($transaction->approved2 == 'approved')
                Disetujui
                @elseif ($transaction->approved2 == 'rejected')
                Ditolak
                @endif
            </td>
            <td>Rp. {{ number_format($transaction->car_fee,0, '.', '.') }}</td>
            <td>Rp. {{ number_format($transaction->driver_fee,0, '.', '.') }}</td>
            <td>Rp. {{ number_format($transaction->late_fee,0, '.', '.') }}</td>
            <td>Rp. {{ number_format($transaction->total_charge,0, '.', '.') }}</td>
            <td>{{ date('d F Y H:i:s', strtotime($transaction->created_at)) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
