@extends("template.template")

@section("content")
<div class="card">
    <div class="card-header w-100 d-flex justify-content-between align-items-center">
        <div>
            <h3 class="card-title">Cari Tiket Kereta</h3>
        </div>
    </div>
    <!-- /.card-header -->
    <form action="" method="GET">
    <div class="card-body dataTable-container">
        <div class="form-group">
          <label for="depart_station">Stasiun Keberangkatan</label>
        <select name="depart_station" id="depart_station" class="custom-select" required>
          <option value="" selected>Pilih</option>
            @foreach ($stations as $stasiun)
            <option value="{{ $stasiun->id }}" @if (request('depart_station') == $stasiun->id) selected @endif>{{ $stasiun->station_code . " | " . $stasiun->station_name . " | " . $stasiun->city }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="arrival_station">Stasiun Kedatangan</label>
        <select name="arrival_station" id="arrival_station" class="custom-select" required>
            <option value="" selected>Pilih</option>
            @foreach ($stations as $stasiun)
            <option value="{{ $stasiun->id }}" @if (request('arrival_station') == $stasiun->id) selected @endif>{{ $stasiun->station_code . " | " . $stasiun->station_name . " | " . $stasiun->city}}</option>
            @endforeach
        </select>
    </div>
      <div class="form-group">
        <label for="depart_time">Hari Keberangkatan</label>
        <input type="date" name="depart_time" class="form-control" id="depart_time" required value="{{ request('depart_time') }}">
      </div>
    </div>
    <div class="card-footer">
      <button type="submit" class="btn btn-primary">Cari</button>
    </div>
  </form>
    <!-- /.card-body -->
  </div>
<div class="card">
    <div class="card-header w-100 d-flex justify-content-between align-items-center">
        <div>
            <h3 class="card-title">Booking Tiket Kereta</h3>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body dataTable-container">
      <table class="dataTable table table-bordered table-striped ">
        <thead>
        <tr>
          <th>No</th>
          <th>Kereta</th>
          <th>No Kereta</th>
          <th>Stasiun Keberangkatan</th>
          <th>Stasiun Tujuan</th>
          <th>Jam Berangkat</th>
          <th>Jam Kedatangan</th>
          <th>Booking</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($journeys as $journey)
            <tr>
                <td class="align-middle text-left">{{ $loop->iteration }}</td>
                <td class="align-middle text-left">{{ $journey->kereta->train_name }}</td>
                <td class="align-middle text-left">{{ $journey->train_no }}</td>
                <td class="align-middle text-left">{{$journey->keberangkatan->station_code . " | " . $journey->keberangkatan->station_name . " | " . $journey->keberangkatan->city}}</td>
                <td class="align-middle text-left">{{ $journey->kedatangan->station_code . " | " . $journey->kedatangan->station_name . " | " . $journey->kedatangan->city}}</td>
                <td class="align-middle text-left">{{ date("d F Y h:m", strtotime($journey->depart_time)) }}</td>
                <td class="align-middle text-left">{{ date("d F Y h:m", strtotime($journey->arrival_time)) }}</td>
                <td class="align-middle text-left d-flex justify-content-around align-items-center" style="gap: 12px">
                    <a href="{{ asset("customers/booking/$journey->id") }}" class="btn btn-primary">
                      <div class="text-white">Booking</div>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
        <tr>
          <th>No</th>
          <th>Kereta</th>
          <th>No Kereta</th>
          <th>Stasiun Keberangkatan</th>
          <th>Stasiun Tujuan</th>
          <th>Jam Berangkat</th>
          <th>Jam Kedatangan</th>
          <th>Booking</th>
        </tr>
        </tfoot>
      </table>
    </div>
    <!-- /.card-body -->
  </div>
@endsection