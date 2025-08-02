@extends("template.template")

@section("content")
<div class="card">
    <div class="card-header w-100 d-flex justify-content-between align-items-center">
        <div>
            <h3 class="card-title">Users</h3>
        </div>
        <div>
            <a href="{{ asset('users/tambah_users') }}" class="btn btn-primary">
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
          <th>Nama</th>
          <th>Email</th>
          <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
          @foreach ($users as $user)
          {{-- cek kalo data nya itu punya yg login. biar gk bisa di apa2 in --}}
          @continue ($user->id == auth()->user()->id)
            <tr>
                <td class="align-middle text-left">{{ $loop->iteration }}</td>
                <td class="align-middle text-left">{{ $user->name }}</td>
                <td class="align-middle text-left">{{ $user->email }}</td>
                <td class="align-middle text-left d-flex justify-content-around align-items-center">
                    <a href="{{ asset("users/$user->id") }}" class="btn btn-success">
                        <div class="text-white">Edit</div>
                      </a>
                    <form action="{{ asset("users/$user->id") }}" method="POST">
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
          <th>Nama</th>
          <th>Email</th>
          <th>Aksi</th>
        </tr>
        </tfoot>
      </table>
    </div>
    <!-- /.card-body -->
  </div>
@endsection