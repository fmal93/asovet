@extends('layouts.app')

@section('title', 'Asovet Tienda de Mascotas')

@section('content') 
    <div class="container">
        <div class="row justify-content-center py-4 m-1">
            <div class="col-md-8">
                <div class="col-md-12 w-100 py-3 d-flex justify-content-center">
                    <img src="{{ asset('storage/settings/logo.png')}}" class="img-responsive w-25" alt="">
                </div>
                <h1 class="text-center p-2" style="letter-spacing: 2px;">Checkout / Caja!</h1>
                <p class="text-muted"></p>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="/checkout" method="POST" role="form" id="pay-form">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="c_nombre">Nombre Completo</label>
                            <input type="text" class="form-control" name="c_nombre" placeholder="Ingreasa tu Nombre" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="c_telefono">Telefono</label>
                            <input type="tel" class="form-control" name="c_telefono" placeholder="ejemplo +56 9 1234 5678" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="c_email">Email</label>
                        <input type="email" class="form-control" name="c_email" placeholder="ejemplo@ejemplo.com" required>
                    </div>
                    <div class="form-group">
                        <label for="c_direccion">Direccion</label>
                        <input type="text" class="form-control" name="c_direccion" placeholder="Ingreasa tu Direccion de envio" required>
                    </div>
                    <state-select-componet total="{{ Session::has('cart') ? (Session::get('cart')->totalPrice + Session::get('cart')->extraCost) : '0' }}"></state-select-componet>
                    <button type="submit" id="submit-payment" class="btn btn-primary my-3">Avanzar </button>                   
                </form>
            </div>
        </div>
    </div>
@endsection

