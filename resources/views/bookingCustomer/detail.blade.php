@extends("template.template")

@section("content")
<div class="row">
  <div class="card">
      <div class="card-header w-100 d-flex justify-content-between align-items-center">
          <div>
              <h3 class="card-title">Booking Tiket Kereta</h3>
          </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body dataTable-container">
        <table class="dataTable table table-bordered table-striped">
          <thead>
          <tr>
            <th>No</th>
            <th>No Kereta</th>
            <th>Kereta</th>
            <th>Kelas</th>
            <th>Tarif</th>
            <th>Kursi</th>
            <th>Tanggal Booking</th>
            <th>Stasiun Keberangkatan</th>
            <th>Stasiun Tujuan</th>
            <th>Jam Berangkat</th>
            <th>Status</th>
            <th>Aksi</th>
          </tr>
          </thead>
          <tbody>
              @foreach ($bookings as $booking)
              <tr>
                  <td class="">{{ $loop->iteration }}</td>
                  <td>{{ $booking->detailBooking->train_no }}</td>
                  <td class="align-middle text-left">{{ $booking->detailBooking->kereta->kereta->train_name }}</td>
                  <td class="align-middle text-left">{{ $booking->detailBooking->fare->class }}</td>
                  <td class="align-middle text-left">Rp.{{ number_format($booking->detailBooking->fare->fare, 0, ',', '.') }}</td>
                  <td class="align-middle text-left">{{ $booking->detailBooking->kursi->seat ?? "Kosong" }}</td>
                  <td class="align-middle text-left">{{ $booking->booking_date }}</td>
                  <td class="align-middle text-left">{{ $booking->detailBooking->kereta->keberangkatan->station_code . " | " . $booking->detailBooking->kereta->keberangkatan->station_name }}</td>
                  <td class="align-middle text-left">{{ $booking->detailBooking->kereta->kedatangan->station_code . " | " . $booking->detailBooking->kereta->keberangkatan->station_name }}</td>
                  <td class="align-middle text-left">{{ date("d F Y h:m", strtotime($booking->detailBooking->kereta->depart_time)) }}</td>
                  <td class="align-middle text-left">{{ $booking->payment_status == "belum_dibayar" ? "Belum Di Bayar" : "Sudah di Bayar" }}</td>
                  <span class="babge bg-danger"></span>
                  <td>
                      <form action="{{ asset("customers/booking/proses_batal_booking_customer/$booking->id") }}" method="POST">
                      @csrf
                      @method('delete')
                      <button class="btn btn-danger">
                          Batalkan
                      </button>
                      </form>
                      <a href="{{ asset("customers/booking/tiket/$booking->id") }}" class="btn btn-primary">
                        Tiket
                      </a>
                    </td>     
              </tr>
              @endforeach
          </tbody>
          <tfoot>
          <tr>
              <th>No</th>
              <th>No Kereta</th>
              <th>Kereta</th>
              <th>Kelas</th>
              <th>Tarif</th>
              <th>Kursi</th>
              <th>Tanggal Booking</th>
              <th>Stasiun Keberangkatan</th>
              <th>Stasiun Tujuan</th>
              <th>Jam Berangkat</th>
              <th>Status</th>
              <th>Aksi</th>
          </tr>
          </tfoot>
        </table>
      </div>
      <!-- /.card-body -->
  </div>
</div>
@endsection