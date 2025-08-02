@extends("template.template")

@section("content")
<div class="card">
    <div class="card-header w-100 d-flex justify-content-between align-items-center">
        <div>
            <h3 class="card-title">Stasiun Kereta</h3>
        </div>
        <div>
            <a href="{{ asset('stasiun/tambah_stasiun') }}" class="btn btn-primary">
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
          <th>Kode Stasiun</th>
          <th>Nama Stasiun</th>
          <th>Kota</th>
          <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($stations as $stasiun)
            <tr>
                <td class="align-middle text-left">{{ $loop->iteration }}</td>
                <td class="align-middle text-left">{{ $stasiun->station_code }}</td>
                <td class="align-middle text-left">{{ $stasiun->station_name }}</td>
                <td class="align-middle text-left">{{ $stasiun->city }}</td>                 
                <td class="align-middle text-left d-flex justify-content-around align-items-center">
                    <a href="{{ asset("stasiun/$stasiun->id") }}" class="btn btn-success">
                        <div class="text-white">Edit</div>
                    </a>
                    <form action="{{ asset("stasiun/$stasiun->id") }}" method="POST">
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
          <th>Kode Stasiun</th>
          <th>Nama Stasiun</th>
          <th>Kota</th>
          <th>Aksi</th>
        </tr>
        </tfoot>
      </table>
    </div>
    <!-- /.card-body -->
  </div>
@endsection