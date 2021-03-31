<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pago Realizado</title>
    <style>
        table {
            font-family:Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
            border-collapse: collapse;
            width: 100%;
            line-height: 2rem;
        }
      
        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        p {
            font-family:Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
            padding: 8px;
            line-height: 2rem;
            letter-spacing: 1px;
        }
        h1, h3 {
            font-family:Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
            padding: 8px;
            line-height: 2rem;
            letter-spacing: 1px;
        }
      </style>
</head>
<body style="padding : 10px; background-image: url'{{ $message->embed('storage/product_images/patitas.jpeg') }}'; background-size: cover;">
    <h1 style="justify-content: center; align-items: center; display: flex;">
        <img src="{{ $message->embed('storage/settings/logo.png') }}" alt="" style="margin-right: 10px; max-width: 80px;">
        Confirmacion de Pedido
    </h1>

    <hr>

    <h3>Orden # {{ $buyOrder }} {{ $datos['c_email']}}</h3>
    
    <p>Gracias por preferir Asovet CL, hemos recibido tu pedido exitosamente, abajo te enviamos los detalles de tu compra y te confirmaremos a tu
        correo cuando el pedido sea despachado para mas informacion no dudes en contactarno por cualquiera de nuestros, en este correo podras encontrar
        toda nuestra informacion de contacto asi como nuestras redes.
    </p>
    <p>
        Los siguientes articulso seran enviados a {{ $datos['c_nombre']}} a la {{ $datos['c_direccion']}}, {{ $comuna}}. en caso de necesitar contactarte te avisaremos 
        al numero que otorgaste {{ $datos['c_telefono']}}
    </p>    
    <table>
        <tr>
          <th style="text-align: center; font-weight: bold; background: lightseagreen;">Articulo</th>
          <th style="text-align: center; font-weight: bold; background: lightseagreen;">Cantidad</th>
          <th style="text-align: center; font-weight: bold; background: lightseagreen;">precio</th>
        </tr>
        @foreach ($order as $item) 
            <tr>
                <td>{{ $item['item']['name'] }}</td>
                <td>{{ $item['qty'] }}</td>
                <td>{{ $item['price'] }}</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="2" style="text-align: center; font-size: 22px; font-weight: bold; background: lightgreen;">Total</td>
            <td>CLP {{ $datos['c_amount']}} </td>
        </tr>
      </table>
</body>
</html>