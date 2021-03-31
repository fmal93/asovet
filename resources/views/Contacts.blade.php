@extends('layouts.app')

@section('title', 'Contactanos')

@section('content')
    <div class="container py-3">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
        <div class="row">
            <div class="col-md-8">
                <div class="d-flex justify-content-center py-4">
                    <div class="rounded shadow p-3" style="background: width:600px;">
                        <h1 class="text-center" style="color:black; font-weight: bold;">Contactanos</h1>
                        <p class="text-center" style="color:black; font-weight: bold;">Si tienes alguna sugerencia, consulta o queja no dudes en enviarnos un mensaje!!</p>
                        <form method="POST" action="/send-message" id="contact-message">
                            @csrf
                            <div class="form-group" style="color: black; font-weight: bold; font-size: 16px;">
                              <label for="contact_nombre">Nombre</label>
                              <input type="text" class="form-control" name="contact_nombre" placeholder="Nombre Completo">
                            </div>
                            
                            <div class="form-group" style="color: black; font-weight: bold; font-size: 16px;">
                                <label for="contact_email">Direccion Email</label>
                                <input type="email" class="form-control" name="contact_email" placeholder="name@example.com">
                            </div>

                            <div class="form-group" style="color: black; font-weight: bold; font-size: 16px;">
                                <label for="contact_subject">Asunto</label>
                                <input type="text" class="form-control" name="contact_subject" placeholder="Asunto del mensaje">
                            </div>
                        
                            <div class="form-group" style="color: black; font-weight: bold; font-size: 16px;">
                              <label for="contact_msg">Tu mensaje</label>
                              <textarea class="form-control border" name="contact_msg" rows="5"></textarea>
                            </div>
                            <input type="submit" class="w-100 m-3 btn btn-primary mx-auto" style="color: black; font-weight: bold; font-size: 16px;"value="Enviar">
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="py-4">
                    <img src="/storage/settings/contact-card.jpg" class="img-responsive w-100 shadow rounded" alt="">
                    <p class="pt-4" style="font-size: 18px; font-weight: bold;">
                        <span class="pr-3">
                            <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-chat-dots-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M16 8c0 3.866-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.584.296-1.925.864-4.181 1.234-.2.032-.352-.176-.273-.362.354-.836.674-1.95.77-2.966C.744 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7zM5 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                            </svg>
                        </span>
                        Siguenos en nuestras redes
                    </p>
                    <hr>
                    <a href="https://www.facebook.com/asovetcl-110755194040420/" class="text-muted"><p class="text-muted text-center" style="font-size: 18px;">Instagram: @asovet.cl</p></a>
                    <a href="https://www.instagram.com/asovet.cl/?hl=es-la" class="text-muted"><p class="text-muted text-center" style="font-size: 18px;">Facebook: asovet.cl</p></a>
                </div>
                <p class="pt-1" style="font-size: 18px; font-weight: bold;">
                    <span class="pr-3">
                        <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-telephone-forward-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511zm10.761.135a.5.5 0 0 1 .708 0l2.5 2.5a.5.5 0 0 1 0 .708l-2.5 2.5a.5.5 0 0 1-.708-.708L14.293 4H9.5a.5.5 0 0 1 0-1h4.793l-1.647-1.646a.5.5 0 0 1 0-.708z"/>
                        </svg>
                    </span>
                    Nuestros numeros
                </p>
                <hr>      
                <a href="https://wa.me/56955277677" class="text-muted"><p class="text-muted text-center" style="font-size: 18px;">+56 9 5527 7677</p></a>
                <p class="pt-1" style="font-size: 18px; font-weight: bold;">
                    <span class="pr-3">
                        <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-envelope-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555zM0 4.697v7.104l5.803-3.558L0 4.697zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757zm3.436-.586L16 11.801V4.697l-5.803 3.546z"/>
                          </svg>
                    </span>
                    Correo
                </p>
                <hr>      
                <p class="text-muted text-center" style="font-size: 18px;">asovetspa@gmail.com</p>                 
            </div>
            
        </div>
    </div>
@endsection
