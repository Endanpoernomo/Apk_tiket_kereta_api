@extends("template.template")

@section("content")
<div class="card">
    <div class="card-header w-100 d-flex justify-content-between align-items-center">
        <div>
            <h3 class="card-title">Perjalanan Kereta</h3>
        </div>
        <div>
            <a href="{{ asset('journeys/tambah_journeys') }}" class="btn btn-primary">
                Tambah
            </a>
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
          <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($journeys as $journey)
            <tr>
                <td class="align-middle text-left">{{ $loop->iteration }}</td>
                <td class="align-middle text-left">{{ $journey->kereta->train_name }}</td>
                <td class="align-middle text-left">{{ $journey->train_no }}</td>
                <td class="align-middle text-left">{{ $journey->keberangkatan->station_code . " | " . $journey->keberangkatan->station_name . " | " . $journey->keberangkatan->city}}</td>
                <td class="align-middle text-left">{{ $journey->kedatangan->station_code . " | " . $journey->kedatangan->station_name . " | " . $journey->kedatangan->city}}</td>
                <td class="align-middle text-left">{{ date("d F Y  h:m", strtotime($journey->depart_time)) }}</td>
                <td class="align-middle text-left">{{ date(" d F Y h:m", strtotime($journey->arrival_time)) }}</td>
                <td class="align-middle text-left d-flex justify-content-around align-items-center">
                    <a href="{{ asset("journeys/$journey->id") }}" class="btn btn-success">
                        <div class="text-white">Edit</div>
                    </a>
                    <form action="{{ asset("journeys/$journey->id") }}" method="POST">
                    @csrf
                    @method('delete')
                    <button class="btn btn-danger">
                        Hapus
                    </button>
                    </form>
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
          <th>Aksi</th>
        </tr>
        </tfoot>
      </table>
    </div>
    <!-- /.card-body -->
  </div>
@endsection