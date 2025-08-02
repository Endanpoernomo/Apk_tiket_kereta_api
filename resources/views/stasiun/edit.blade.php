@extends('template.template')

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Edit Stasiun {{ $stasiun->name }}</h3>
        </div>
        <form action="{{ asset("stasiun/$stasiun->id") }}" method="POST">
            @csrf
            @method("put")
            <div class="card-body">
                <div class="form-group">
                    <label for="station_code">Kode Stasiun</label>
                    <input type="text" name="station_code" class="form-control" id="station_code" value="{{ $stasiun->station_code }}" placeholder="Kode Stasiun">
                </div>
                <div class="form-group">
                    <label for="station_name">Nama Stasiun</label>
                    <input type="text" name="station_name" class="form-control" id="station_name" value="{{ $stasiun->station_name }}" placeholder="Nama Stasiun">
                </div>
                <div class="form-group">
                    <label for="city">Kota</label>
                    <input type="text" name="city" class="form-control" id="city" value="{{ $stasiun->city }}" placeholder="Kota">
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
