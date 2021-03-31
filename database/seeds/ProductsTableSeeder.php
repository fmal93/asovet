<?php

use App\Product;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'category_id' => '',
            'brand_id' => '',
            'name' => '',
            'slug' => '',
            'details' => '',
            'price' => '',
            'description' => '',
            'type_id' => '',
        ]);

    }
}
