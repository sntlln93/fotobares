<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Quota;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product = Product::create([
            'name' => 'Clásico'
        ]);

        Quota::create([
            'quantity' => 1,
            'quota_amount' => 3000,
            'product_id' => $product->id
        ]);

        Quota::create([
            'quantity' => 2,
            'quota_amount' => 1600,
            'product_id' => $product->id
        ]);

        Quota::create([
            'quantity' => 3,
            'quota_amount' => 1400,
            'product_id' => $product->id
        ]);

        $product = Product::create([
            'name' => 'Moderno'
        ]);

        Quota::create([
            'quantity' => 1,
            'quota_amount' => 3000,
            'product_id' => $product->id
        ]);

        Quota::create([
            'quantity' => 2,
            'quota_amount' => 1600,
            'product_id' => $product->id
        ]);

        Quota::create([
            'quantity' => 3,
            'quota_amount' => 1400,
            'product_id' => $product->id
        ]);
    }
}
