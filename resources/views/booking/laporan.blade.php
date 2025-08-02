<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<div class="container">
  <div class="col-md-12">
    <h2>Laporan hasil keberangkatan</h2>
<table class="table table-bordered" style="margin-top: 100px">
      
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
              
            </tr>
            @endforeach
        </tbody>
      </table>
      </div>
      </div>
      <script>
        window.print();
      </script>