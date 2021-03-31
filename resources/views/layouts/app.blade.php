<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel='icon' type='image/png' href='/storage/settings/logo-mini.png' sizes='16x16'>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>

      .patitas {
        background-image: url('/storage/product_images/patitas.jpeg');
      }
      #detail-ad{
        background-image: url('/storage/product_images/detail-ad.jpg');
        max-width: 100%;
        background-repeat: no-repeat;
        background-size: 100% 90%;
        background-position: center;
      }
      #banner-bottom{
        background-image: url('/storage/product_images/banner-bottom.jpg');
        max-width: 100%;
        background-repeat: no-repeat;
        background-size: contain;
        background-position: center;
        height: 150px;
      }
      @media only screen and (max-width: 600px) {
        #detail-ad{
        background-image: url('/storage/product_images/detail-ad-mobil.jpg');
        height: 120px;
        max-width: 100%;
        background-repeat: no-repeat;
        background-size: 100% 90%;
        background-position: center;
        margin-left: 20px;
        }
        #banner-bottom{
        background-image: url('/storage/product_images/banner-bottom-mobil.jpg');
        background-size: contain;
        }
      }
    
    </style>
     @livewireStyles
</head>
<body>
  <div id="app">
    <navbar-component badge="{{ Session::has('cart') ? count(Session::get('cart')->items) : 0 }}"></navbar-component>

    <main class="py-4 shadow" style="background-image: url('/storage/product_images/patitas.jpeg');">
        @yield('content')
    </main>

    <footer class="patitas">
      <div class="card my-4 pt-4 border-0" style="background: none;">
        <div class="card-body">
          <h5 class="text-muted text-center">Siguenos en las redes o contactanos por correo o Whatsapp!</h5>
        </div>
      </div>
      
      <div class="col-sm-12 pb-5 d-flex justify-content-center">
        <a href="https://www.facebook.com/asovetcl-110755194040420/" class="p-3">
          <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.0" x="0px" y="0px" width="3.5rem" height="3.5rem" viewBox="0 0 50 50" style="null" class="icon icons8-Facebook-Filled" >    
            <path d="M40,0H10C4.486,0,0,4.486,0,10v30c0,5.514,4.486,10,10,10h30c5.514,0,10-4.486,10-10V10C50,4.486,45.514,0,40,0z M39,17h-3 c-2.145,0-3,0.504-3,2v3h6l-1,6h-5v20h-7V28h-3v-6h3v-3c0-4.677,1.581-8,7-8c2.902,0,6,1,6,1V17z"></path>
          </svg>
        </a>
        <a href="https://www.instagram.com/asovet.cl/?hl=es-la" class="p-3">
          <svg class="instagram-logo" id="Layer_1" xmlns="http://www.w3.org/2000/svg" width="3.5rem" height="3.5rem" viewBox="0 0 551.034 551.034" style="enable-background:new 0 0 551.034 551.034;" xml:space="preserve">
            <path class="logo" id="XMLID_17_" d="M386.878,0H164.156C73.64,0,0,73.64,0,164.156v222.722 c0,90.516,73.64,164.156,164.156,164.156h222.722c90.516,0,164.156-73.64,164.156-164.156V164.156 C551.033,73.64,477.393,0,386.878,0z M495.6,386.878c0,60.045-48.677,108.722-108.722,108.722H164.156 c-60.045,0-108.722-48.677-108.722-108.722V164.156c0-60.046,48.677-108.722,108.722-108.722h222.722 c60.045,0,108.722,48.676,108.722,108.722L495.6,386.878L495.6,386.878z"/>
            <path id="XMLID_81_" fill="#555" d="M275.517,133C196.933,133,133,196.933,133,275.516 s63.933,142.517,142.517,142.517S418.034,354.1,418.034,275.516S354.101,133,275.517,133z M275.517,362.6 c-48.095,0-87.083-38.988-87.083-87.083s38.989-87.083,87.083-87.083c48.095,0,87.083,38.988,87.083,87.083 C362.6,323.611,323.611,362.6,275.517,362.6z"/>
            <circle id="XMLID_83_" fill="#555" cx="418.306" cy="134.072" r="34.149"/>
          </svg>
        </a>
        <a href="https://wa.me/56955277677" class="p-3">
          <svg xmlns="http://www.w3.org/2000/svg" width="3.5rem" height="3.5rem" viewBox="0 0 64 64" aria-labelledby="title" aria-describedby="desc" role="img" xmlns:xlink="http://www.w3.org/1999/xlink">
            <title>WhatsApp</title>
            <desc>A line styled icon from Orion Icon Library.</desc>
            <path data-name="layer2"
            d="M30.287 2.029A29.769 29.769 0 0 0 5.223 45.266L2.064 60.6a1.158 1.158 0 0 0 1.4 1.361L18.492 58.4A29.76 29.76 0 1 0 30.287 2.029zm17.931 46.2"
            fill="none" stroke="#202020" stroke-linecap="round" stroke-miterlimit="10"
            stroke-width="2" stroke-linejoin="round"></path>
            <path data-name="layer1" d="M46.184 38.205l-5.765-1.655a2.149 2.149 0 0 0-2.126.561l-1.41 1.436a2.1 2.1 0 0 1-2.283.482c-2.727-1.1-8.463-6.2-9.927-8.754a2.1 2.1 0 0 1 .166-2.328l1.23-1.592a2.148 2.148 0 0 0 .265-2.183l-2.424-5.485a2.149 2.149 0 0 0-3.356-.769c-1.609 1.361-3.517 3.428-3.749 5.719-.409 4.039 1.323 9.13 7.872 15.242 7.566 7.063 13.626 8 17.571 7.04 2.238-.542 4.026-2.714 5.154-4.493a2.15 2.15 0 0 0-1.218-3.221z"
            fill="none" stroke="#202020" stroke-linecap="round" stroke-miterlimit="10"
            stroke-width="2" stroke-linejoin="round"></path>
          </svg>
        </a>
      </div>  
      
    </div>
  </footer>
  @livewireScripts
</body>
<section>
    @yield('extraScript')
</section>
</html>
