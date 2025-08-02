@extends("template.template")

@section("content")
<div class="card">
    <div class="card-header w-100 d-flex justify-content-between align-items-center">
        <div>
            <h3 class="card-title">Kereta</h3>
        </div>
        <div>
            <a href="{{ asset('kereta/tambah_kereta') }}" class="btn btn-primary">
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
          <th>Nama Kereta</th>
          <th>Kursi Ekonomi</th>
          <th>Kursi Bisnis</th>
          <th>Kursi Eksekutif</th>
          <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($trains as $kereta)
            <tr>
                <td class="align-middle text-left">{{ $loop->iteration }}</td>
                <td class="align-middle text-left">{{ $kereta->eco_seat_num }}</td>
                <td class="align-middle text-left">{{ $kereta->busines_seat_num }}</td>
                <td class="align-middle text-left">{{ $kereta->exec_seat_num }}</td>
                <td class="align-middle text-left d-flex justify-content-around align-items-center">
                    <a href="{{ asset("kereta/$kereta->id") }}" class="btn btn-success">
                        <div class="text-white">Edit</div>
                    </a>
                    <form action="{{ asset("kereta/$kereta->id") }}" method="POST">
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
          <th>Nama Kereta</th>
          <th>Kursi Ekonomi</th>
          <th>Kursi Bisnis</th>
          <th>Kursi Eksekutif</th>
          <th>Aksi</th>
        </tr>
        </tfoot>
      </table>
    </div>
    <!-- /.card-body -->
  </div>
@endsection