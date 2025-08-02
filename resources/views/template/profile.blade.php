@extends("template.template")

@section("content")
<div class="card" style="width: 18rem;">
  <img class="card-img-top" src="{{ asset('dist/img/avatar4.png') }}" alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title">Name : {{ auth()->user()->name }}</h5>
    <h5 class="card-title">Email : {{ auth()->user()->email }}</h5>
    <!-- <h5 class="card-title">country : {{ auth()->user()->country}}</h5> -->
    <h5 class="card-title">Kota : {{ auth()->user()->city }}</h5>
    
  
  </div>
</div>
@endsection