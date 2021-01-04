<?php

use Illuminate\Database\Seeder;

class ProductTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_types')->insert([
            [
                'name' => 'Classic T-shirt',
                'description' => 'Standard Cotton Combed 30s T-shirt. Comfy and perfect for budget',
                'base_price' => 50000,
                'weight' => 70,
                'image' => 'images/product_types/classic_t_shirt.png'
            ],
            [
                'name' => 'Long Sleeve T-shirt',
                'description' => 'Standard Cotton Combed 30s Long Sleeve T-shirt',
                'base_price' => 60000,
                'weight' => 100,
                'image' => 'images/product_types/long_sleeve_t_shirt.png'
            ],
            [
                'name' => 'V-Neck T-shirt',
                'description' => 'Cotton Combed 30s V-Neck T-shirt',
                'base_price' => 55000,
                'weight' => 70,
                'image' => 'images/product_types/v_neck_t_shirt.png'
            ],
            [
                'name' => 'Tank Top',
                'description' => 'Cotton Combed 30s Tank Top',
                'base_price' => 60000,
                'weight' => 50,
                'image' => 'images/product_types/tank_top.png'
            ],
            [
                'name' => 'Classic Hoodie',
                'description' => 'Classic, High Quality Hoodie',
                'base_price' => 110000,
                'weight' => 170,
                'image' => 'images/product_types/classic_hoodie.png'
            ]
        ]);
    }
}
