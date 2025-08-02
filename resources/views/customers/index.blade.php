@extends("template.template")

@section("content")
<div class="card">
    <div class="card-header w-100 d-flex justify-content-between align-items-center">
        <div>
            <h3 class="card-title">Customers</h3>
        </div>
        <div>
            <a href="{{ asset('customers/tambah_customers') }}" class="btn btn-primary">
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
          <th>Kota</th>
          <th>Negara</th>
          <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($customers as $customer)
            <tr>
                <td class="align-middle text-left">{{ $loop->iteration }}</td>
                <td class="align-middle text-left">{{ $customer->name }}</td>
                <td class="align-middle text-left">{{ $customer->email }}</td>
                <td class="align-middle text-left">{{ $customer->city }}</td>
                <td class="align-middle text-left">{{ $customer->country }}</td>
                <td class="align-middle text-left d-flex justify-content-around align-items-center">
                    <a href="{{ asset("customers/$customer->id") }}" class="btn btn-success">
                        <div class="text-white">Edit</div>
                    </a>
                    <form action="{{ asset("customers/$customer->id") }}" method="POST">
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
          <th>Kota</th>
          <th>Negara</th>
          <th>Aksi</th>
        </tr>
        </tfoot>
      </table>
    </div>
    <!-- /.card-body -->
  </div>
@endsection