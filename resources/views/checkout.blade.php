

<form action="{{ $formAction }}" method="POST" role="form" id="checkout-form">
    <input type="hidden" name="token_ws" value="{{ $tokenWs }}">   
    <button type="submit"></button>                   
</form>
      
<script>document.getElementById('checkout-form').submit();</script>