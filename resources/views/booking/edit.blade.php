@extends('template.template')

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Status</h3>
        </div>
        <form action="{{ asset("booking/$booking->id") }}" method="POST">
            @csrf
            @method('put')
            <div class="card-body">
                <div class="form-group">
                    <label for="booking_date">Pembayaran</label>
                    <select name="payment_status" id="payment_status" class="custom-select" required>
                        <option value="belum_dibayar" @if ($booking->booking->payment_status == 'belum_dibayar') selected @endif>Belum Dibayar</option>
                        <option value="sudah_dibayar" @if ($booking->booking->payment_status == 'sudah_dibayar') selected @endif>Sudah Dibayar</option>
                    </select>
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
