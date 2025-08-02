@extends('template.template')

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Edit Tarif Kereta {{ $fare->kereta->kereta->train_name }}</h3>
        </div>
        <form action="{{ asset("fare/proses_edit_fare/$fare->id") }}" method="POST">
            @csrf
            @method('put')
            <div class="card-body">
                <div class="form-group">
                    <label for="class">Kelas</label>
                    <select name="class" id="class" class="custom-select">
                        <option value="economy" @if ($fare->class == 'economy') selected @endif>Ekonomi</option>
                        <option value="business" @if ($fare->class == 'business') selected @endif>Bisnis</option>
                        <option value="executive" @if ($fare->class == 'executive') selected @endif>Eksekutif</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="fare">Tarif</label>
                    <input type="number" name="fare" class="form-control" id="fare" placeholder="Tarif" value="{{ $fare->fare }}">
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
