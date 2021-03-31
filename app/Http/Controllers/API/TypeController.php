<?php

namespace App\Http\Controllers\Api;

use App\Type;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\TypeResource;

class TypeController extends Controller
{
    public function index()
    {
        $Types = Type::withCount(['products' => function ($query) {
                $query->withFilters();
            }])
            ->get();

        return TypeResource::collection($Types);
    }
}
