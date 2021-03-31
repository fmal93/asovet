<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Region;
use App\Http\Resources\Region as RegionResource;

class RegioneController extends Controller
{
    public function index() {
        
        $regiones = Region::all();

        return RegionResource::collection($regiones);
    }
    
}
