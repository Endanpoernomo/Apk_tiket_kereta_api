@extends('template.template')

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Tambah Tarif Kereta {{ $journey->kereta->train_name }}</h3>
        </div>
        <form action="{{ asset("fare/proses_tambah_fare") }}" method="POST">
            @csrf
            <div class="card-body">
                <input type="hidden" value="{{ $journey->train_no }}" name="train_no">
                <div class="form-group">
                    <label for="class">Kelas</label>
                    <select name="class" id="class" class="custom-select">
                        <option value="economy">Ekonomi</option>
                        <option value="business">Bisnis</option>
                        <option value="executive">Eksekutif</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="fare">Tarif</label>
                    <input type="number" name="fare" class="form-control" id="fare" placeholder="Tarif">
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
