@extends("template.template")

@section("content")
<div class="card">
    <div class="card-header w-100 d-flex justify-content-between align-items-center">
        <div>
            <h3 class="card-title">Tarif Kereta {{ $journey->kereta->train_name }}</h3>
        </div>
        <div>
          <a href="{{ asset("fare/tambah_fare/$journey->train_no") }}" class="btn btn-primary">
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
          <th>Kursi</th>
          <th>Harga</th>
          <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
          @foreach ($journey->fare as $tarif)
          <tr>
            <td class="align-middle text-left">{{ $loop->iteration }}</td>
            <td class="align-middle text-left">{{ $tarif->class }}</td>
            <td class="align-middle text-left">Rp.{{ number_format($tarif->fare, 0, ',', '.') }}</td>
            <td class="align-middle text-left d-flex justify-content-around align-items-center">
              <a href="{{ asset("fare/$tarif->id") }}" class="btn btn-success">
                <div class="text-white">Edit</div>
              </a>
              <form action="{{ asset("fare/$tarif->id") }}" method="POST">
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
          <th>Kursi</th>
          <th>Harga</th>
        </tr>
        </tfoot>
      </table>
    </div>
    <!-- /.card-body -->
  </div>
@endsection