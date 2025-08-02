@extends('template.template')

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Tambah Stasiun Kereta</h3>
        </div>
        <form action="{{ asset('stasiun/proses_tambah_stasiun') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="station_code">Kode Stasiun</label>
                    <input type="text" name="station_code" class="form-control" id="station_code" placeholder="Kode Stasiun">
                </div>
                <div class="form-group">
                    <label for="station_name">Nama Stasiun</label>
                    <input type="text" name="station_name" class="form-control" id="station_name" placeholder="Nama Stasiun">
                </div>
                <div class="form-group">
                    <label for="city">Kota</label>
                    <input type="text" name="city" class="form-control" id="city" placeholder="Kota">
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
