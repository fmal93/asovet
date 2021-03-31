@extends('layouts.app')

@section('title', 'Busqueda')

@section('content')
    <div class="card my-4 p-3 shadow border-0" style="background: none;">
        <div class="card-body">
            <h3 class="text-muted text-center">Hay {{ $products->count() }} Resultado(s) que coinciden con '{{ request()->input('keyword') }}'</h3>
        </div>
    </div>
    
    <div class="container">  
        <div class="row pl-3 pr-3">      
            @foreach ($products as $product)
                <div class="col-sm-3 pb-3" >
                    <div class="card border-0">
                        <div class="card-body">
                            <a href="/tienda/{{ $product->id }}"><img class="card-img-top" src='storage/product_images/{{ $product->slug }}.jpg'></a>
                            <a href="/tienda/{{ $product->id }}" class="nav-link"><p class="card-text font-weight-bold text-center" 
                            style="text-decoration: none; color: black; font-size: 22px;">{{ $product->name }}</p></a>
                            <p class="text-muted text-center">{{ Str::limit($product->details, 50) }}</p>
                            <p class="text-center font-weight-bold shadow-sm" style="font-size:22px;">&#36;{{ number_format($product->price) }}</p>
                            <div class="text-center w-100 d-flex">
                                <a href="/tienda/{{ $product->id }}" class="btn btn-success w-50 m-1">Detalles</a>
                                @if ( $product->productStokc->stock < 1)
                                    <p class="text-muted m-2" style="font-size:1rem;">Agotado</p>
                                @else
                                    <a href="{{ route('cart.add', ['id' => $product->id])}}" class="btn btn-success w-50 m-1" style="font-size: 13px; padding-left: 0; padding-right: 0;"> Añadir carrito</a>
                                @endif
                            </div> 
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    
@endsection