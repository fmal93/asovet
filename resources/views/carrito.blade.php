@extends('layouts.app')

@section('title', 'Asovet Tienda de Mascotas')

@section('content')       
    
    <div class="container">
               
        <div class="row">
            <div class="col-md-9">
                <div class="row">
                    
                    <div class="col-md-12">
                        <div class="card my-2 shadow border-0" style="background: none;">
                            <div class="card-body">
                                <h3 class="text-muted text-center">Hay {{ Session::has('cart') ? Session::get('cart')->totalQty : '0' }} articulos en el carrito!!</h3>
                            </div>
                        </div>
                    </div>

                    @if (session('status'))
                        @if (session('status') == 'cupon aplicado correctamente')  
                            <div class="alert alert-success col-md-12 mx -2">
                                {{ session('status') }}
                            </div>
                        @else
                            <div class="alert alert-danger col-md-12 mx -2">
                                {{ session('status') }}
                            </div>
                        @endif
                    @endif
                </div>
                <div class="row my-3 p-2 border rounded ml-1 mr-1">
                    @if (Session::has('cart'))
                        @foreach ($products as $product)
                            <div class="col-4 col-sm-2 d-flex justify-content-center pt-1">
                                <div class="w-100">
                                    <img src="{{ asset('storage/product_images/' . $product['item']['slug'] . '.jpg')}}" alt="" class="img-responsive w-100">
                                </div>
                            </div>
                            <div class="col-8 col-sm-4 pt-3 d-flex justify-content-between align-items-center">
                                <a href="{{ route('tienda.show', ['id' => $product['item']['id']]) }}"><h5 class="font-weight-bold mr-2">{{ $product['item']['name'] }}</h5>@if ($product['discount'] > 0)<span class="badge badge-danger" style="position: relative; top: -5px;">-{{ $product['discount'] }}%</span>@endif</a>
                                <a href="{{ route('cart.remove', ['id' => $product['item']['id']]) }}" class="btn btn-outline-danger btn-sm">Eliminar</a>
                            </div>
                            <div class="col-6 col-sm-3 pr-0 pr-1 border-bottom d-flex justify-content-between align-items-center">
                                <p class="font-weight-bold">Precio : </p>
                                <p class="font-weight-bold"> &#36; {{ number_format($product['item']['price']) }}</p>
                            </div>
                            <div class="col-6 col-sm-3 border-bottom">
                                <form action="{{ route('cart.update') }}" method="GET" class="pt-3 pl-0 m-0 d-flex justify-content-between align-items-center">
                                    <input type="hidden" name="id" value="{{$product['item']['id']}}">
                                    <input type="number" name="qty" value="{{ $product['qty']}}" min="0" max="" class="form-control m-2 h-50 w-100 m-0">
                                    <button type="submit" formaction="{{ route('cart.update') }}"class="btn btn-outline-primary btn-sm w-50 p-1">Actualizar</button> 
                                </form>                         
                            </div>
                        @endforeach                        
                    @else
                        <div class="col-md-12 d-flex justify-content-center">
                            <p class="text-muted">No hay Articulos en la bolsa</p>
                        </div>
                    @endif
                </div>
                
                @if (Session::has('cart'))
                    <hr>
                    <H3>Calcula tu envio</H3>
                    <state-select-componet total="{{ Session::has('cart') ? (Session::get('cart')->totalPrice + Session::get('cart')->extraCost) : '0' }}"></state-select-componet>
                @endif
            </div>
            <div class="col-md-3">
                <div class="row border-0 ml-1 mr-1 rounded-top">
                     <div class="col-md-12 p-0">
                        <h5 class="text-center py-2" style="color:black;">
                            <u>Resumen del Pedido</u>                            
                        </h5>
                     </div>
                </div>
                <div class="row border rounded-bottom shadow-sm mt-0 ml-1 mr-1">
                    <div class="col-md-12 p-4">
                        @if (Session::has('cart'))
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="text-muted d-flex justify-content-between align-items-end border-bottom" style="font-size: 12px;">
                                        Producto: <span> Cantidad: </span>
                                        <span>Precio:</span>
                                    </p>
                                </div>
                                @foreach ($products as $product)
                                    <div class="col-md-12">
                                        <p class="text-muted d-flex justify-content-between align-items-end" style="font-size: 12px;">
                                            {{ Str::limit($product['item']['name'], 15) }} <span class="badge badge-success"> {{ $product['qty'] }}</span>
                                            <span>&#36;{{ number_format($product['price']) }}</span>
                                        </p>
                                </div>
                                @endforeach
                                <p class="text-muted d-flex justify-content-between align-items-end mr-3 ml-3" style="font-size: 12px;">
                                    Costos Adicionales <span class="ml-3"> &#36;{{ number_format(Session::has('cart') ? Session::get('cart')->extraCost : '0') }}</span>
                                </p>
                                <div class="col-md-12 border-top pt-3">
                                    <form action="{{ route('cart.discountItems') }}" method="GET" >
                                        @csrf
                                        <label for="c_cupon" style="font-size: 12px;">Si tienes un codigo de descuento para algun articulo ingresalo aca</label>
                                        <div class="form-group pt-3 pl-0 mb-2 d-flex justify-content-between align-items-center">
                                            
                                            <input type="text" class="form-control w-75" name="c_cupon" placeholder="Codigo Descuento" required>
                                            <button type="submit" formaction="{{ route('cart.discountItems') }}" class="btn btn-outline-primary btn-sm p-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                                    <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <hr/>
                                <div class="col-md-12 border-top pt-3">
                                    <p class="font-weight-bold d-flex justify-content-between align-items-end" style="font-size: 16px; letter-spacing: 1px;">
                                        Total a Pagar : &#36; {{ number_format(Session::has('cart') ? (Session::get('cart')->totalPrice + Session::get('cart')->extraCost) : '0')}}
                                    </p>
                                </div>
                                <div class="col-md-12">
                                    <a href="{{ route('checkoutForm') }}" class="btn btn-success p-1 w-100 shadow">Ir a Pagar</a>
                                </div>
                            </div>
                        @else
                            <div class="col-md-12">
                                <p class="font-weight-bold d-flex justify-content-between align-items-end" style="font-size: 16px; letter-spacing: 2px;">
                                   Carro Vacio
                                </p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="row mx-1" id="banner-bottom"></div>
    </div>
        
@endsection  