@extends("template.template")

@section("content")
<div class="card">
    <div class="card-header w-100 d-flex justify-content-between align-items-center">
        <div>
            <h3 class="card-title">Rute Kereta</h3>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body dataTable-container">
      <a class="btn btn-primary" href="routes/tambah">Tambah</a>
      <table class="dataTable table table-bordered table-striped ">
        <thead>
        <tr>
          <th>No</th>
          <th>No Kereta</th>
          <th>Nama Kereta</th>
          <th>Stasiun Keberangkatan</th>
          <th>Stasiun Tujuan</th>
          <th>Jam Berangkat</th>
          <th>Jam Kedatangan</th>
          <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($routes as $route)
            <tr>
                <td class="align-middle text-left">{{ $loop->iteration }}</td>
                <td class="align-middle text-left">{{ $route->journey->kereta->train_name }}</td>
                <td class="align-middle text-left">{{ $route->train_no }}</td>
                <td class="align-middle text-left">{{ $route->keberangkatan->station_code . " | " . $route->keberangkatan->station_name }}</td>
                <td class="align-middle text-left">{{ $route->kedatangan->station_code . " | " . $route->kedatangan->station_name }}</td>
                <td class="align-middle text-left">{{ date(" d F Y h:m", strtotime ($route->depart_time)) }}</td>
                <td class="align-middle text-left">{{  date(" d F Y h:m", strtotime ($route->arrival_time)) }}</td>
                <td class="align-middle text-left d-flex justify-content-around align-items-center">
                    <a href="{{ asset("routes/$route->id") }}" class="btn btn-success">
                        <div class="text-white">Edit</div>
                    </a>
                    <form action="{{ asset("routes/$route->id") }}" method="POST">
                    @csrf
                    @method("delete")
                      <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
        <tr>
          <th>No</th>
          <th>No Kereta</th>
          <th>Nama Kereta</th>
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