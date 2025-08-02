@extends("template.template")

@section("content")
<div class="card">
    <div class="card-header w-100 d-flex justify-content-between align-items-center">
        <div>
            <h3 class="card-title">Booking Kereta {{ $journey->kereta->train_name }}</h3>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body dataTable-container">
      <table class="dataTable table table-bordered table-striped ">
      <a href="{{asset("booking/laporan/$journey->id")}}" class="btn btn-primary">Laporan</a>

        <thead>
        <tr>
          <th>No</th>
          <th>Booking Code</th>
          <th>Customer</th>
          <th>Email</th>
          <th>Kelas</th>
          <th>Kursi</th>
          <th>Tanggal Booking</th>
          <th>Status</th>
          <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($bookings as $booking)
            <tr>
                <td class="align-middle text-left">{{ $loop->iteration }}</td>
                <td class="align-middle text-left">{{ $booking->booking_code }}</td>
                <td class="align-middle text-left">{{ $booking->booking->customers->name }}</td>
                <td class="align-middle text-left">{{ $booking->booking->customers->email }}</td>
                <td class="align-middle text-left">{{ $booking->fare->class }}</td>
                <td class="align-middle text-left">{{ $booking->kursi->seat ?? "Kosong" }}</td>
                <td class="align-middle text-left">{{ $booking->booking->booking_date }}</td>
                <td class="align-middle text-left">
                      {{ $booking->booking->payment_status == "belum_dibayar" ? "Belum Bayar" : "Sudah Bayar" }}
                </td>
                <td class="d-flex justify-content-around align-items-center">
                    <a href="{{ asset("booking/$booking->id") }}" class="btn btn-success">
                      Status
                    </a>
                    <form action="{{ asset("booking/$booking->id") }}" method="POST">
                    @csrf
                    @method('delete')
                    <button class="btn btn-danger">
                        Batalkan
                    </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
        <tr>
        <th>No</th>
          <th>Booking Code</th>
          <th>Customer</th>
          <th>Email</th>
          <th>Kelas</th>
          <th>Kursi</th>
          <th>Tanggal Booking</th>
          <th>Status</th>
          <th>Aksi</th>
        </tr>
        </tfoot>
      </table>
    </div>
    <!-- /.card-body -->
  </div>
@endsection