@extends('layouts.app')

@section('title', $id->name)

@section('content')
    <div class="container py-3">
        <div class="row">
            <div class="col-md-2 my-2" id="detail-ad"></div>
            <div class="col-md-10">
                <div class="row">
            <div class="col-md-6" style="background: none;">
                <img src="/storage/product_images/{{ $id->slug}}.jpg" class="img-responsive w-100 rounded p-4 shadow" alt="">
            </div>
            <div class="col-md-6 shadow">
                <h3 class="text-center font-weight-bold py-3 pl-3 m-0" style="letter-spacing: 4px; color: black; ;"><u><em>Informacion</em></u></h3>
                <div class="">
                    <h4 class="text-dark ml-4 pt-3" style="letter-spacing: 1px;"><em>{{ $id->name }}</em></h4>
                    <p class="text-primary ml-4 pt-1" style="font-size: 16px;">{{ $id->details }}</p>
                        <form action="{{ route('cart.addMany') }}" method="GET" class="ml-4 pt-3">
                        <div class="w-100 d-flex justify-content-around">
                            <input type="hidden" name="id" value="{{ $id->id }}">
                            <label for="qty" class="text-dark" style="font-size: 22px; letter-spacing: 2px;">
                                <em>Cantidad</em>
                            </label>
                            @if ( $id->productStokc->stock < 1)
                                <p class="text-muted m-2" style="font-size:1rem;">Agotado</p>
                            @else
                                <input type="number" name="qty" min="1" max="{{ $id->productStokc->stock }}" value="1" class="form-control w-50">
                            @endif
                        </div>
                        <h4 class="text-center font-weight-bold text-success pt-4" style="letter-spacing: 3px;"><em>PRECIO</em></h4>
                        <h1 class="text-center font-weight-bold text-dark pt-1" style="letter-spacing: 2px;">&#36; {{ number_format($id->price) }}</h1>
                        <div class="w-100 p-4 text-center">
                            @if ( $id->productStokc->stock < 1)
                                <p class="text-muted m-2" style="font-size:1rem;">Agotado</p>
                            @else
                                <input type="submit" class="btn w-50 mb-3 btn-success" name="add_cart" value="Añadir al carrito" style="color: white;">
                            @endif
                        </div>                     
                    </form>
                </div>
            </div>
        </div>
            </div>
        </div>
        
        <div class="row pt-5">
            <div class="col-md-12 pt-4">
                <h1 class="font-weight-bold border rounded py-2 pl-3" style="letter-spacing: 4px; color: black;"><u><em>Descripcion</em></u></h1>
                <p class="lead p-3 text-muted" style="font-size: 18px;">{{ $id->description }}</p>
            </div>
        </div>
    </div>
@endsection
    
