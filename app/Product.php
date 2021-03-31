<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function ExtraCost()
    {
        return $this->hasOne(ExtraCost::class);
    }

    public function ProductStokc()
    {
        return $this->hasOne(ProductStokc::class);
    }

    public function ProductOptions()
    {
        return $this->hasMany(ProductOption::class);
    } 

    public function scopeWithFilters($query)
    {
        return $query->when(count(request()->input('brands', [])), function ($query) {
                $query->whereIn('brand_id', request()->input('brands'));
            })
            ->when(count(request()->input('categories', [])), function ($query) {
                $query->whereIn('category_id', request()->input('categories'));
            })->when(count(request()->input('types', [])), function ($query) {
                $query->whereIn('type_id', request()->input('types'));
            });            
    }
}
