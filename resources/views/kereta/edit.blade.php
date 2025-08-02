@extends('template.template')

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Edit Kereta {{ $kereta->train_name }}</h3>
        </div>
        <form action="{{ asset("kereta/$kereta->id") }}" method="POST">
            @csrf
            @method('put')
            <div class="card-body">
                <div class="form-group">
                    <label for="train_name">Nama Kereta</label>
                    <input type="text" name="train_name" class="form-control" id="train_name" placeholder="Nama Kereta" value="{{ $kereta->train_name }}">
                </div>
                <div class="form-group">
                    <label for="eco_seat_num">Jumlah Kursi Ekonomi</label>
                    <input type="text" name="eco_seat_num" class="form-control" id="eco_seat_num" placeholder="Jumlah Kursi" value="{{ $kereta->eco_seat_num }}">
                </div>
                <div class="form-group">
                    <label for="busines_seat_num">Jumlah Kursi Bisnis</label>
                    <input type="text" name="busines_seat_num" class="form-control" id="busines_seat_num" placeholder="Jumlah Kursi" value="{{ $kereta->busines_seat_num }}">
                </div>
                <div class="form-group">
                    <label for="exec_seat_num">Jumlah Kursi Eksekutif</label>
                    <input type="text" name="exec_seat_num" class="form-control" id="exec_seat_num" placeholder="Jumlah Kursi" value="{{ $kereta->exec_seat_num }}">
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Kereta</button>
            </div>
        </form>
    </div>
    <!-- /.card -->
@endsection
