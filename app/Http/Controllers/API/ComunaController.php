<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Comuna;
use App\Http\Resources\ComunaResource;
use Illuminate\Http\Request;

class ComunaController extends Controller
{
        public function index($id) {

            $comunas = Comuna::where('region_id', '=', $id)->get();

            return ComunaResource::collection($comunas);
        }
}
