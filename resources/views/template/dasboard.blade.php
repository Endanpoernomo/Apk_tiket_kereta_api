@extends("template.template")

@section("content")

<div class="container">
<div class="row">
    <div class="col-sm-6">
    <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
    <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="https://images.unsplash.com/photo-1612527670286-1912f78763f2?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MXx8a2VyZXRhJTIwYXBpfGVufDB8fDB8fA%3D%3D&w=1000&q=8" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        
      </div>
    </div>
    <div class="carousel-item">
      <img src="https://i.pinimg.com/originals/7e/c0/9b/7ec09bfc5d5b966111057c599ef9b74b.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
       
      </div>
    </div>
    <div class="carousel-item">
      <img src="https://c1.wallpaperflare.com/preview/913/437/169/train-transportation-locomotive-railway.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
     
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-target="#carouselExampleCaptions" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-target="#carouselExampleCaptions" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </button>
</div>
</div>
<div class="col-sm-6">
<div class="card" style="width: 18rem;">
  <img src="https://asset.kompas.com/crops/4veOjiGXgEPkKOdyRJUSQlfndIo=/0x0:3000x1500/750x500/data/photo/2021/09/28/6152c5b609b3f.jpg" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">Card title</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    <a href="#" class="btn btn-primary">Go somewhere</a>
  </div>
</div>
</div>
</div>

@endsection