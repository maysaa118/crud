<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            'name'=>'new-clothes1',
            'slug'=>'new-product1',
            'category_id'=>'3',
            'image' =>'new-image1',
          
            'status' =>'active',
            'compare_price' =>'70',
            'price' =>'43',
            'short_description' =>'new-product',

            'description' =>'new-product-new',
            'quantity' =>'1',


            'created_at'=>now(),
        ]);
    }
}
