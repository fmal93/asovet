<template>
    <div class="grid-navigation shadow-sm sticky-top patitas">
        <div class="search-bar p-3">
            <form action="/busqueda" method="GET">
                <input type="text" class="form-control" name="keyword" required>
                <button class="lupa">
                    <svg width="1.3em" height="1.3em" viewBox="0 0 16 16" class="bi bi-search" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"/>
                        <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
                    </svg>
                </button>
            </form>
        </div>
        <div class="cart-icon">
            <a href="/carrito" style="text-decoration: none; color: black;">
                <svg width="1.7em" height="1.7em" viewBox="0 0 16 16" class="bi bi-cart3" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm7 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                </svg>
                <span class="badge rounded-circle bg-dark" style="color: white;">{{badge}}</span>
            </a>
        </div>
        <div class="logo">
            <a href="/">
                <img src="/storage/settings/logo.png" alt="">
            </a>
        </div>
        <div class="navbar-burguer">
            <button type="button" id="burguer">
                <svg width="1.8em" height="1.8em" viewBox="0 0 16 16" class="bi bi-border-width" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 3.5A.5.5 0 0 1 .5 3h15a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5H.5a.5.5 0 0 1-.5-.5v-2zm0 5A.5.5 0 0 1 .5 8h15a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H.5a.5.5 0 0 1-.5-.5v-1zm0 4a.5.5 0 0 1 .5-.5h15a.5.5 0 0 1 0 1H.5a.5.5 0 0 1-.5-.5z"/>
                </svg>
            </button>
        </div>
        <div class="navigation-links">
            <ul>
                <li><a href="/">Inicio</a></li>
                <li><a href="/tienda">Productos</a></li>
                <li><a href="/carrito">Carrito</a></li>
                <li><a href="/contacts">Contactanos</a></li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                
            }
        },
        props: ['badge'],
        mounted() {
            $(document).ready(function(){
                var responsive_menu = $('.navigation-links ul');
                $('#burguer').on('click',function(e) {
                    e.preventDefault();
                    responsive_menu.slideToggle();
                });
                $(window).resize(function(){
                    var obtener_ancho = $(this).width();
                    if(obtener_ancho > 700 && responsive_menu.is(':hidden')) {
                    responsive_menu.removeAttr('style');
                    }
                });
                $('navigation-links ul li').on('click',function(e) {               
                    var obtener_ancho = $(window).width();
                    if(obtener_ancho < 480 ) {
                    responsive_menu.slideToggle();
                    }
                });

            });

        }
    }
    
</script>

<style scoped>
    .patitas {
        background-image: url('/storage/product_images/patitas.jpeg');
    }
    .grid-navigation {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        grid-template-rows: 1fr 1fr auto;
        grid-template-areas: 
        "search search search"
        "cart logo burguer"
        "nav-links nav-links nav-links";
    }
    .search-bar {
        grid-area: search;
        display: block;
        width: 100%;
    }
    .search-bar input {
        padding-right: 45px;
    }
    .lupa {
        position: absolute;
        top: 20px;
        right: 30px;
        background: none;
        border: 0px;
    }
    .cart-icon {
        grid-area: cart;
        margin: auto;
    }
    .cart-icon svg {
        margin-bottom: 5px;
        margin-top: 5px;
    }
    .logo {
        grid-area: logo;
        margin: auto;
    }
    .logo img {
        width: 80px;
        height: 45px;
    }
    .navbar-burguer {
        grid-area: burguer;
        padding-bottom: 5px;
        padding-top: 5px;
        margin: auto;
    }
    .navbar-burguer button {
        border: 0px;
        background: none;
        float: right;
    }
    .navigation-links {
        grid-area: nav-links;
    }
    .navigation-links ul {
        list-style: none;
        padding: 0px;
        display: none;
    }
    .navigation-links ul li {
        width: 100%;
        text-align: start;
        padding: 5px 30px;
        letter-spacing: 2px;
    }
    .navigation-links ul li a {
        text-decoration: none;
        color: #111111;
        font-size: 16px;
        text-transform: uppercase;
        font-weight: 700;
    }
    .badge {
        position: relative;
        right: 10px;
        top: -5px;
    }
    @media (min-width: 700px) {
        .grid-navigation {
            display: grid;
            grid-template-columns: 100px 1fr 1fr 80px;
            grid-template-rows: 1fr;
            grid-template-areas: 
            "logo nav-links search cart";
        }
        .search-bar {
            grid-area: search;
            position: relative;
        }
        .lupa {
            position: absolute;
        }
        .cart-icon {
            grid-area: cart;
        }
        .logo {
            grid-area: logo;
            padding-left: 30px;
        }
        .navbar-burguer {
            display: none;
        }
        .navigation-links {
            grid-area: nav-links; 
            margin: auto;
            display:block;           
        }
        .navigation-links ul {
            display: flex;
            margin: 0;
        }
        .navigation-links ul li {
            margin: auto;
            padding: 5px;
            letter-spacing: 0;
        }
        .navigation-links ul li a {
            font-weight: normal;
            text-transform: none;
            font-size: 18px;
            padding: 0 7px;
        }
        .navigation-links ul li a:hover {
            color: grey;
        }
    }
</style>