<?php

namespace App\Http\Controllers\Api;

use App\Brand;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\BrandResource;

class BrandController extends Controller
{
    public function index()
    {
        $Brands = Brand::withCount(['products' => function ($query) {
                $query->withFilters();
            }])
            ->get();

        return BrandResource::collection($Brands);
    }
}
