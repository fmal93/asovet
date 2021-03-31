<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'keyword' => 'required|min:3',
        ]);

        $query = str_replace(" ", "%%", preg_replace("/\s+/", " ", trim(request()->input('keyword'))));


        $products = Product::where('name', 'like', "%$query%")->orWhere('description', 'like', "%$query%")->orWhere('details', 'like', "%$query%")->get();
        

        return view('busqueda', compact('products'));
    }
}
