@extends("template.template")

@section("content")
<div class="card">
    <div class="card-header w-100 d-flex justify-content-between align-items-center">
        <div>
            <h3 class="card-title">Tarif Kereta</h3>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body dataTable-container">
      <table class="dataTable table table-bordered table-striped ">
        <thead>
        <tr>
          <th>No</th>
          <th>No Kereta</th>
          <th>Kereta</th>
          <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($journeys as $journey)
            <tr>
                <td class="align-middle text-left">{{ $loop->iteration }}</td>
                <td class="align-middle text-left">{{ $journey->kereta->train_name }}</td>
                <td class="align-middle text-left">{{ $journey->train_no }}</td>
                <td class="align-middle text-left d-flex justify-content-around align-items-center">
                    <a href="{{ asset("fare/detail/$journey->train_no") }}" class="btn btn-info">
                      <div class="text-white">Fare Detail</div>
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
          <th>Aksi</th>
        </tr>
        </tfoot>
      </table>
    </div>
    <!-- /.card-body -->
  </div>
@endsection