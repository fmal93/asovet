@extends('layouts.app')

@section('title', 'Asovet Tienda de Mascotas')

@section('content')
<div class="container-fluid pl-4 pr-4">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        </ol>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="storage/settings/banner.png" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="storage/settings/banner2.png" class="d-block w-100" alt="...">
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>   
</div>
<div style="background-image: url('storage/product_images/patitas.jpeg');">
  <div class="card my-4 p-3 shadow border-0" style="background: none;">
      <div class="card-body">
          <h5 class="text-muted text-center">REVISA NUESTROS PRODUCTOS!</h5>
      </div>
  </div>
  <h3 class="text-center" style="color: darkcyan;">Asovet SPA</h3>
  <div class="container pt-4">
    
      <div class="row pl-3 pr-3">
        @foreach ($products as $product)
          <div class="col-sm-3 pb-1" >
              <div class="card border-0">
                  <div class="card-body">
                      <a href="/tienda/{{ $product->id }}"><img class="card-img-top" src='storage/product_images/{{ $product->slug }}.jpg'></a>
                      <a href="/tienda/{{ $product->id }}" class="nav-link"><p class="card-text font-weight-bold text-center" 
                      style="text-decoration: none; color: black; font-size: 22px;">{{ $product->name }}</p></a>
                      <p class="text-muted text-center">{{ Str::limit($product->details, 50) }}</p>
                      <p class="text-center font-weight-bold shadow-sm" style="font-size:22px;">&#36;{{ number_format($product->price) }}</p>
                      <div class="text-center w-100 d-flex">
                        <a href="/tienda/{{ $product->id }}" class="btn btn-success w-50 m-1">Detalles</a>
                        <a href="{{ route('cart.add', ['id' => $product->id])}}" class="btn btn-success w-50 m-1" style="font-size: 13px; padding-left: 0; padding-right: 0;"> Añadir carrito</a>
                      </div>                      
                  </div>
              </div>
          </div>
          @endforeach
      </div>
      <div class="row mx-3" id="banner-bottom"></div>
  </div>
</div>

@endsection

