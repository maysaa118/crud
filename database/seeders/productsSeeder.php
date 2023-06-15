<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class productsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            'name'=>'clothes',
            'slug'=>'product',
            'category_id'=>'1',
            'image' =>'11',
          
            'status' =>'1',
            'compare_price' =>'11',
            'price' =>'11',
            'short_description' =>'11',

            'description' =>'1111',


            'created_at'=>now(),
        ]);
    }
}
