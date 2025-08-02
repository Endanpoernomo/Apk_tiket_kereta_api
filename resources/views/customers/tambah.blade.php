@extends('template.template')

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Tambah Customers</h3>
        </div>
        <form action="{{ asset('customers/proses_tambah_customers') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Nama</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Nama">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="Email">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                </div>
                <div class="form-group">
                    <label for="city">Kota</label>
                    <input type="text" name="city" class="form-control" id="city" placeholder="Kota">
                </div>
                <div class="form-group">
                    <label for="country">Negara</label>
                    <input type="text" name="country" class="form-control" id="country" placeholder="Negara">
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Tambah</button>
            </div>
        </form>
    </div>
    <!-- /.card -->
@endsection
