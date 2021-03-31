<?php

namespace App\Http\Controllers;

require_once '../vendor/autoload.php';

use App\Preorder;
use App\Product;
use App\ProductStokc;
use App\Order;
use App\WebpayToken;
use Illuminate\Support\Facades\Mail;
use App\Mail\orderPlaced;
use Transbank\Webpay\Configuration;
use Transbank\Webpay\Webpay;
use App\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{

    public $configuration;

    public function __construct()
    {
        $this->configuration = new Configuration();
        $this->configuration->setEnvironment("PRODUCCION");
        $this->configuration->setCommerceCode("597020000540");
        $this->configuration->setPrivateKey(
            "-----BEGIN RSA PRIVATE KEY-----\n" .
            "MIIEogIBAAKCAQEArqpMl54A5zBuq5Nsbu04Y/U2D6vpKvwCy9Rw3slCF5ghfQRR\n" .
            "30L6EmMvtYQ5B1J7kQso5PJwqY5koAGoJG9xTRUqLoS1TFQYSI1rWRTuf1bravcg\n" .
            "PaGgXK4OHUUWFCNqzQPkxaGx+8vkBlgFg4WJflQi36w/JSgHmrm59BJeIdtKnz4W\n" .
            "bwjFEnu3rMxXvGEK2gMVD7FVs2baPzexyI/mKTRR1/ZOoxD/lzOT6UD2uJMuyUR+\n" .
            "n1Z5vBy+8WhwD6dMQKpMwvjR0E78jdBPxDlm+H/i/apeEyyEW2rbqwVfx5e5yRE8\n" .
            "8rmL8EkdLPI1CO24s01Y15fTnO74XF510VHbxQIDAQABAoIBAGkRWleOHV703G3r\n" .
            "lbu4iUZf2DBfKjjINeplFax+hnpo8iQg+BsEUCfFcIqRSjjkXh5nByeJy0nDtTYn\n" .
            "KP0Z6J8Ez0YCYIjUwXLLVzrUA4+oOp8ynztTwYJe1XC4AUsF7xX6dKCJ3uXnxXgn\n" .
            "dNGj/4x1kjDYjXeNd92UQY7XibZ1FATxBOOjCZHe4wF9HddP7AEBwX/ILcuK3sBD\n" .
            "cuOPJAQDSTGwgO1i7aeHPA5wtTJl4UjrGE00Rkz08tGIV/iOMiq8uYyAUyUi1DBj\n" .
            "BtIueqWlhAGYI+Mvi993oUFpn79hgkgl6x1iPeDrmC+t1fO7PLIBHCja38DTh28K\n" .
            "MxZUu1UCgYEA2uxdvNcZ0dfqWUTYwY+RMrx8FaoMYt+FY88p13Jyo8miVBSRwkNb\n" .
            "ClgNnRFJjDCy/WLFkEsv/wME8tGN1DcCsfKRmPo4cVsZd2pGOYYErt216HxcwF8n\n" .
            "ocM6uCk5B9pHaDLaM91nMkWoNo3RAorQTXD00Hg4Nf6PjEqoMlz9yCMCgYEAzD8U\n" .
            "uqFydWbJapyZ9XXcWVVXjTV2oBzzHfXoJ/faGr95LXdGom1V3vHG5KGIE/gtQw0t\n" .
            "7W/oMf+3bR5v8MIW4VOn4R8ck4O8Tp3W/XY36J44RpqMtJW0LMcxRTjNu2j27dOk\n" .
            "0NbymXCXbQhGajRkGzdzYgpnUdo5G5iOMLJ+VvcCgYBOae9BXoJfCUllZCWHXxcQ\n" .
            "5zZCxD/fglRS5bcE9ndddzFvkFaNEHchg1yM7846Ko9R9vjwsB2m57v0BV8ZrgKH\n" .
            "Hm1MMAPbhlfez/ALVpeC0uL/PNw0A2E8raLwp8NHrsV46w4BGcKG3TBdKfq9QF9P\n" .
            "/a+SpBzuKhnclDkeoPQ9pQKBgBsvbj/lC0oLE1YIYAmm1VximpOmARMQp19egrcH\n" .
            "K1WSFLvze0hVSy+weKunwGgACW46S9mlon89LRnuCjI+czMsolS5gmE0EJVaNupn\n" .
            "mMtye8UR/xZuMpwfKzSueduu/ebr260cXxADR3RwvIaYUJa6y7XJ8rSXWjCNHqfm\n" .
            "qiBDAoGAGaj2+XXr2Wvu+6nmG4/2oFsotngnrCTcR1YJGQ/VE/1rtkTz4hcO/RKL\n" .
            "+OTpxNkv5BULwpei4Hgn24/YVlW3G7VBkUAC5v57aYt2Kxiiy/Jw2OqeQZ//5rnc\n" .
            "SK2PvgF+B8YqR38Kv7KFvi0/Ts3ubg7CcoL4r2TaroF5qvHfeyI=\n" .
            "-----END RSA PRIVATE KEY-----"
        );
        $this->configuration->setPublicCert(
            "-----BEGIN CERTIFICATE-----\n" .
            "MIIDtjCCAp4CCQDFnrRdy6vX9TANBgkqhkiG9w0BAQsFADCBnDELMAkGA1UEBhMC\n" .
            "Q0wxKjAoBgNVBAgMIVJlZ2nCom4gTWV0cm9wb2xpdGFuYSBkZSBTYW50aWFnbzER\n" .
            "MA8GA1UEBwwIUHVkYWh1ZWwxEzARBgNVBAoMCkFzb3ZldCBTcEExFTATBgNVBAMM\n" .
            "DDU5NzAzNTkyMzI2ODEiMCAGCSqGSIb3DQEJARYTYXNvdmV0c3BhQGdtYWlsLmNv\n" .
            "bTAeFw0yMDA5MDQxODM3MDBaFw0yNDA5MDMxODM3MDBaMIGcMQswCQYDVQQGEwJD\n" .
            "TDEqMCgGA1UECAwhUmVnacKibiBNZXRyb3BvbGl0YW5hIGRlIFNhbnRpYWdvMREw\n" .
            "DwYDVQQHDAhQdWRhaHVlbDETMBEGA1UECgwKQXNvdmV0IFNwQTEVMBMGA1UEAwwM\n" .
            "NTk3MDM1OTIzMjY4MSIwIAYJKoZIhvcNAQkBFhNhc292ZXRzcGFAZ21haWwuY29t\n" .
            "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEArqpMl54A5zBuq5Nsbu04\n" .
            "Y/U2D6vpKvwCy9Rw3slCF5ghfQRR30L6EmMvtYQ5B1J7kQso5PJwqY5koAGoJG9x\n" .
            "TRUqLoS1TFQYSI1rWRTuf1bravcgPaGgXK4OHUUWFCNqzQPkxaGx+8vkBlgFg4WJ\n" .
            "flQi36w/JSgHmrm59BJeIdtKnz4WbwjFEnu3rMxXvGEK2gMVD7FVs2baPzexyI/m\n" .
            "KTRR1/ZOoxD/lzOT6UD2uJMuyUR+n1Z5vBy+8WhwD6dMQKpMwvjR0E78jdBPxDlm\n" .
            "+H/i/apeEyyEW2rbqwVfx5e5yRE88rmL8EkdLPI1CO24s01Y15fTnO74XF510VHb\n" .
            "xQIDAQABMA0GCSqGSIb3DQEBCwUAA4IBAQBgBZJfKgVfqkjUPq/G6fUSJTNlL/h8\n" .
            "aAJebL+GCE7QVdQk6tEAafLtqTfatqZqDudDB2q7ktSWoyPnGaqXnWYc3WbWdCcH\n" .
            "4vJBUXH0ghrup32aYsEoA6sz9lzBCueE5ZH0b8bXug/EDchU2a9onL5e0g+eAHVC\n" .
            "ciFXGlBKSoYHVbF+4Mau5zIuve6wqLKs7ugELLtEIdCUJxk4cNcUa+aVVzrs7yfP\n" .
            "zPTNQVjWLCYirPbuWG/2N883LVmLGpJdJUzVDyzlwe1m7ud9tF79V6mSGbFdZLQj\n" .
            "G54gvfUPLII2ajYoKSFCe8C2knJQeOdUNniBxO6+T02WXCJUBcqYt6/r\n" .
            "-----END CERTIFICATE-----"
        );
    }
    public function getCheckoutForm() {
        if (!Session::has('cart')) {
            return view('carrito');
        }
        $cart = Session::get('cart');
        
        $total = $cart->totalPrice; 

        return view('checkoutForm', ['total' => $total]);
    }
    public function getCheckout(Request $request) 
    {
        $validatedData = $request->validate([
            'c_nombre' => 'required|max:255',
            'c_telefono' => 'regex:/^[\+0-9\-\(\)\s]*$/',
            'c_email' => 'email',
            'c_direccion' => 'required',
            'c_region' => 'required',
            'c_comuna' => 'required',
        ]);
        if (!Session::has('cart')) {
            return view('carrito');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $total = $request->c_amount;
        
        $transaction = (new Webpay(Configuration::forTestingWebpayPlusNormal()))
               ->getNormalTransaction();

        $amount = $total;
        // Identificador que será retornado en el callback de resultado:
        $sessionId = "asovet-id";
        // Identificador único de orden de compra:
        $buyOrder = strval(rand(100000, 999999999));
        $returnUrl = "http://localhost:8000/checkout-return";
        $finalUrl = "http://localhost:8000/checkout-final";
        $initResult = $transaction->initTransaction($amount, $buyOrder, $sessionId, $returnUrl, $finalUrl);
        $formAction = $initResult->url;
        $tokenWs = $initResult->token;

        $p_cart = $cart->items;
        $serialized_items = serialize($p_cart); 
        $p_datos = serialize($request->toArray());
        $PreOrder = new Preorder;
        $PreOrder->buyOrder = $buyOrder;
        $PreOrder->cart = $serialized_items;
        $PreOrder->datos = $p_datos;
        $PreOrder->tokenWS	 = $tokenWs;
        $PreOrder->save();

        return view('checkout', ['total' => $amount, 'formAction' => $formAction, 'tokenWs' => $tokenWs, 'buyOrder' => $buyOrder]);
    }

    public function getReturnCheckout(Request $request) 
    {
        $error = "";
        
        $transaction = (new Webpay(Configuration::forTestingWebpayPlusNormal()))
               ->getNormalTransaction();
        $tokenWs = filter_input(INPUT_POST, 'token_ws');
        $result = $transaction->getTransactionResult($tokenWs);
    
        if (is_array($result)){
           if(isset($result['error'])){
                $preOrder_fallido = Preorder::where('tokenWS', $tokenWs)->firstOrFail();
                $items_in_cart = unserialize($preOrder_fallido->cart);
                foreach ($items_in_cart as $item){
                    $oldCart = Session::has('cart') ? Session::get('cart') : null;
                    $cart = new Cart($oldCart);
                    $product = Product::findOrFail($item['item']['id']);
                    $extra_cost_exist = $product->extraCost != null ? $product->extraCost->cargo : 0;
                    $cart->restoreCart($item['item'], $item['item']['id'], $item['qty'], $extra_cost_exist);
                    Session::put('cart', $cart);
                }
                $delete_preorder = Preorder::find($preOrder_fallido->id);
                $delete_preorder->delete();
                $oldCart = Session::has('cart') ? Session::get('cart') : null;
                $cart = new Cart($oldCart);
                $error = "Ha ocurrido un Error, Intentalo de Nuevo";
                return view('checkoutFinal', ['error' => $error]);
           }
        }
        $output = $result->detailOutput;
        if ($output->responseCode == 0) {
            $wpToken = new WebpayToken;
            $wpToken->buyOrder = $output->buyOrder;
            $wpToken->tokenWs = $tokenWs;
            $wpToken->authorizationCode = $output->authorizationCode . " PTC " . $output->paymentTypeCode;
            $wpToken->responseCode = $output->responseCode . " VCI " . $result->VCI;
            $wpToken->amount = $output->amount. " CC " . $output->sharesNumber;
            $wpToken->save();            

            echo '<script>window.localStorage.clear();</script>'; 
            echo '<script>window.localStorage.setItem("authorizationCode", ' . $output->authorizationCode . ');</script>';
            echo '<script>window.localStorage.setItem("buyOrder", ' . $output->buyOrder . ');</script>'; 
            echo '<script>window.localStorage.setItem("amount", ' . $output->amount . ');</script>'; 
            echo '<script>window.localStorage.setItem("responseCode", ' . $output->responseCode . ');</script>'; 
            return view('checkoutReturn', ['tokenWs' => $tokenWs, 'result' => $result, 'output' => $output]);   
        }else {
            $wpToken = new WebpayToken;
            $wpToken->buyOrder = $output->buyOrder;
            $wpToken->tokenWs = $tokenWs;
            $wpToken->authorizationCode = $output->authorizationCode  . " PTC " . $output->paymentTypeCode;
            $wpToken->responseCode = $output->responseCode . " VCI " . $result->VCI;
            $wpToken->amount = $output->amount;
            $wpToken->save();

            $preOrder_fallido = Preorder::where('buyOrder', $output->buyOrder)->firstOrFail();
            $items_in_cart = unserialize($preOrder_fallido->cart);
            foreach ($items_in_cart as $item){
                $oldCart = Session::has('cart') ? Session::get('cart') : null;
                $cart = new Cart($oldCart);
                $product = Product::findOrFail($item['item']['id']);
                $extra_cost_exist = $product->extraCost != null ? $product->extraCost->cargo : 0;
                $cart->restoreCart($item['item'], $item['item']['id'], $item['qty'], $extra_cost_exist);
                Session::put('cart', $cart);
            }
            $delete_preorder = Preorder::findOrFail($preOrder_fallido->id);
            $delete_preorder->delete();
            $oldCart = Session::has('cart') ? Session::get('cart') : null;
            $cart = new Cart($oldCart);
            $error = "Orden de Compra " . $output->buyOrder . " rechazada Las posibles causas de este rechazo son:
            * Error en el ingreso de los datos de su tarjeta de Crédito o Débito (fecha y/o código de seguridad).
            * Su tarjeta de Crédito o Débito no cuenta con saldo suficiente.
            * Tarjeta aún no habilitada en el sistema financiero.";
            return view('checkoutFinal', ['error' => $error]);
        }             
    }

    public function getFinalCheckout(Request $request) 
    {
        $error = "";
        if ($request->has('TBK_TOKEN')) {
            $token_anulacion = $request->get('TBK_TOKEN');
            $buyOrder_anulacion = $request->get('TBK_ORDEN_COMPRA');
            $preOrder_anulacion = Preorder::where('buyOrder', $buyOrder_anulacion)->firstOrFail();
            $items_in_cart = unserialize($preOrder_anulacion->cart);
            foreach ($items_in_cart as $item){
                $oldCart = Session::has('cart') ? Session::get('cart') : null;
                $cart = new Cart($oldCart);
                $product = Product::find($item['item']['id']);
                $extra_cost_exist = $product->extraCost != null ? $product->extraCost->cargo : 0;
                $cart->restoreCart($item['item'], $item['item']['id'], $item['qty'], $extra_cost_exist);
                Session::put('cart', $cart);
            }
            $delete_preorder = Preorder::find($preOrder_anulacion->id);
            $delete_preorder->delete();
            $oldCart = Session::has('cart') ? Session::get('cart') : null;
            $cart = new Cart($oldCart);
            return view('carrito', ['products' => $cart->items, 'totalPrice' => $cart->totalPrice]);
        }
        
        $token = $request->get('token_ws');
        $wpTokenRow = WebpayToken::where('tokenWS', $token)->firstOrFail();
        $buyOrder = $wpTokenRow->buyOrder;
        $preOrder = Preorder::where('buyOrder', $buyOrder)->firstOrFail();
        $tems_cart = unserialize($preOrder->cart);
        $unser_datos = unserialize($preOrder->datos);
        Mail::send(new OrderPlaced($tems_cart, $unser_datos, $buyOrder));
        $item_names = [];
        $items_qty = [];
        foreach ($tems_cart as $item) {
            array_push($item_names, $item['item']['name']);
            array_push($items_qty, $item['qty']);
            $stock = Product::findOrFail($item['item']['id'])->productStokc->stock - $item['qty'];
            $affected = ProductStokc::where('product_id', $item['item']['id']) ->update(['stock' => $stock]);
        }
        $items_names_implode = implode(",", $item_names);
        $items_qty_implode = implode(",",$items_qty);
        $ordenFinal = new Order;
        $ordenFinal->buyOrder = $wpTokenRow->buyOrder;
        $ordenFinal->status = $wpTokenRow->responseCode;
        $ordenFinal->items = $items_names_implode; 
        $ordenFinal->cantidad = $items_qty_implode;
        $ordenFinal->total = $wpTokenRow->amount;
        $ordenFinal->nombre = $unser_datos['c_nombre'];
        $ordenFinal->telefono = $unser_datos['c_telefono'];
        $ordenFinal->email = $unser_datos['c_email'];
        $ordenFinal->direccion = $unser_datos['c_direccion'];
        $ordenFinal->region = $unser_datos['c_region'];
        $ordenFinal->comuna = $unser_datos['c_comuna'];
        $ordenFinal->save();
        $delete_preorder = Preorder::find($preOrder->id);
        $delete_preorder->delete();
        return view('checkoutFinal', ['error' => $error, 'items' => $tems_cart, 'webpay' => $wpTokenRow ]);
    }
}