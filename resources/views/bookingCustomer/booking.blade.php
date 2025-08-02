@extends('template.template')

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Booking Tiket Kereta {{ $kereta->kereta->train_name }}</h3>
        </div>
        <form action="{{ asset('customers/booking/proses_tambah_booking') }}" method="POST">
            @csrf
            <div class="card-body">
                <input type="hidden" name="train_no" value="{{ $kereta->train_no }}">
                <div class="form-group">
                    <label for="class">Kelas</label>
                    <select name="class" id="class" class="custom-select" data-kereta="{{ $kereta->train_no }}">
                        <option value="">Pilih Kelas</option>
                        @foreach ($kereta->fare as $fare)
                        <option value="{{ $fare->id }}">{{ $fare->class }} | Rp.{{number_format( $fare->fare, 0, ',', '.') }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="seat">Kursi</label>
                    <select name="seat" id="seat" class="custom-select">
                        <option value="">Pilih Kelas Dahulu</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="booking_date">Tanggal Booking</label>
                    <input type="datetime-local" name="booking_date" class="form-control" id="booking_date">
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
@section("script")
<script>
    $(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });
        
        let getData = e => {
            console.log(e.currentTarget.value)
            $.ajax({
                url: `{{ asset('getSeat') }}`,
                data: {
                    data: $("#class").data("kereta"),
                    fare: e.currentTarget.value
                },
                dataType: "json",
                success: resp => {
                    if (resp) {
                        let text = "";
                        for (let i = 1; i <= resp.total; i++) {
                            if (!resp.kursi.includes(`${i}`)) {
                                text += `<option value='${i}'>${i}</option>`
                            }
                        }
                        $("#seat").html(text)
                    }
                } 
            })
        }

        $("#class").on("change", getData);

        })
</script>
@endsection