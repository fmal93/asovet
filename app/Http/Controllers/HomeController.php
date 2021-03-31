<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMessage;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::whereHas('productStokc', function (Builder $query){ $query->where('stock', '>', 0);})->inRandomOrder()->take(12)->get();
        
        return view('Inicio', compact('products'));
    }

    public function contacts()
    {

        return view('Contacts');

    }

    public function getSendMessage(Request $request) 
    {

        $validatedData = $request->validate([
            'contact_nombre' => 'required|max:255',
            'contact_email' => 'email',
            'contact_subject' => 'required',
            'contact_msg' => 'required',
        ]);

        $name = $request->contact_nombre;

        $email = $request->contact_email;

        $subject = $request->contact_subject;

        $msg = $request->contact_msg;

        Mail::send(new ContactMessage($name, $email, $subject, $msg));

        return view('msgSend');

    }
}
