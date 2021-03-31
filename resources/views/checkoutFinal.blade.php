@extends('layouts.app')

@section('title', 'Asovet Tienda de Mascotas')

@section('content')
    @if (!$error)
    <div class="container">
        <h3 class="text-success text-center py-3">Pago realizado exitosamente</h3>
        <div class="row d-flex justify-content-center">
            <div class="col-md-8">
                <table class="table table-hover shadow p-0">
                    <thead>
                        <tr class="bg-success rounded-top text-white text-center">
                            <th>Producto</th>
                            <th colspan="2">Valor</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                            <tr class="border">
                                <td class="text-muted m-0 py-0" style="font-size: 16px;">
                                    <p class="p-2">Nombre: {{ $item['item']['name'] }}  <br> Cantidad: {{ $item['qty'] }} <br>Precio: {{ number_format((int)$item['item']['price'])}} </p>
                                </td>
                                <td id="amount" class="d-flex justify-content-center border-0 align-items-center mt-3"><strong>CLP {{ number_format($item['price'] )}}</strong></td>
                            </tr>
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
            <div class="col-md-4">
                <table class="table table-hover shadow">
                    <thead>
                        <tr>
                            <th colspan="2" class="bg-success rounded-top text-white">Detalles de Transaccion</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border">
                            <td class="text-muted" style="font-size: 14px;">Número de orden</td>
                            <td> <p class="text-primary" id="buyOrder" style="font-size: 14px; padding: 0px; margin: 0;">#{{ $webpay->buyOrder }}</p> </td>
                        </tr>
                        <tr class="border" style="font-size: 14px;">
                            <td class="text-muted">Código de autorización</td>
                            <td> <p class="text-primary" style="font-size: 14px; padding: 0px; margin: 0;" id="authorizationCode">{{ strstr($webpay->authorizationCode, " ", true) }}</p> </td>
                        </tr>
                        <tr class="border" style="font-size: 14px;">
                            <td class="text-muted">Fecha de la transacción</td>
                            <td> <p class="text-primary"  id="transactionDate" style="font-size: 14px; padding: 0px; margin: 0;">{{ $webpay->created_at }}</p> </td>
                        </tr>
                        <tr class="border" style="font-size: 14px;">
                            <td class="text-muted">Tipo de pago realizado</td>
                            <td> <p class="text-primary"  id="paymentTypeCode" style="font-size: 14px; padding: 0px; margin: 0;">
                                    @if(substr(strrchr($webpay->authorizationCode, " "), 1) == 'VD')
                                        Venta Debito
                                    @elseif(substr(strrchr($webpay->authorizationCode, " "), 1) == 'VN')
                                        Venta Normal
                                    @elseif(substr(strrchr($webpay->authorizationCode, " "), 1) == 'VP')
                                        Venta Prepago
                                    @else
                                        Venta Credito 
                                    @endif
                                </p> 
                            </td>
                        </tr>
                        <tr class="border" style="font-size: 14px;">
                            <td class="text-muted">Cantidad de cuotas</td>
                            <td> <p class="text-primary"  id="sharesNumber" style="font-size: 14px; padding: 0px; margin: 0;"> {{ substr(strrchr($webpay->amount, " "), 1) }}</p> </td>
                        </tr>                      
                        <tr class="border rounded-bottom">
                            <td class="text-dark" colspan="2" style="text-align: center; padding:20px;"> <strong>TOTAL: CLP <span id="total"></span></strong> </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>        
    </div>
    
    
    @else 
        <div class="container">
            <h3 class="text-danger">{{ $error }}</h3>
        </div>        
    @endif
    
@endsection
@section('extraScript')
        <script>

            document.getElementById('total').innerHTML = window.localStorage.getItem('amount');
            document.getElementById('authorizationCode').innerHTML = window.localStorage.getItem('authorizationCode');
            document.getElementById('buyOrder').innerHTML = window.localStorage.getItem('buyOrder');

        </script>
    
@endsection