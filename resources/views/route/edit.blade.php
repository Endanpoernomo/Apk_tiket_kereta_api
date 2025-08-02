@extends('template.template')

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Ganti Rute {{ $route->journey->kereta->train_name }}</h3>
        </div>
        <form action="{{ asset("routes/$route->id") }}" method="POST">
            @csrf
            @method('put')
            <div class="card-body">
                <div class="form-group">
                    <label for="id_train">Kereta</label>
                    <select name="id_train" id="id_train" class="custom-select" value="{{ $route->id_train }}">
                        @foreach ($trains as $kereta)
                        <option value="{{ $kereta->id }}" @if ($kereta->id == $route->id_train) selected @endif>{{ $kereta->train_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="train_no">No Kereta</label>
                    <input type="text" name="train_no" class="form-control" id="train_no" placeholder="No Kereta" value="{{ $route->train_no }}">
                </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="depart_station">Stasiun Keberangkatan</label>
                    <select name="depart_station" id="depart_station" class="custom-select">
                        @foreach ($stations as $stasiun)
                        <option value="{{ $stasiun->id }}" @if ($stasiun->id == $route->journey->depart_station) selected @endif>{{ $stasiun->station_code . " | " . $stasiun->station_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="arrival_station">Stasiun Kedatangan</label>
                    <select name="arrival_station" id="arrival_station" class="custom-select">
                        @foreach ($stations as $stasiun)
                        <option value="{{ $stasiun->id }}" @if ($stasiun->id == $route->journey->arrival_station) selected @endif>{{ $stasiun->station_code . " | " . $stasiun->station_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="arrival_time">Jam Keberangkatan</label>
                    <input type="datetime-local" name="arrival_time" class="form-control" id="arrival_time" value="{{ $route->journey->arrival_time }}">
                </div>
                <div class="form-group">
                    <label for="depart_time">Jam Kedatangan</label>
                    <input type="datetime-local" name="depart_time" class="form-control" id="depart_time" value="{{ $route->journey->depart_time }}">
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Edit</button>
            </div>
        </form>
    </div>
    <!-- /.card -->
@endsection
