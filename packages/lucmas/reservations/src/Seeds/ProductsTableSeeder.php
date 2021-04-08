<?php

namespace Lucmas\Reservations\Seeds;

use Lucmas\Reservations\Model\Category;
use Lucmas\Reservations\Model\Product;
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
        $prod = app()->make(Product::class);
        $prod->fill([
            'code' => 'APE1',
            'active' => true,
        ]);
        $prod->name = 'Americano';
        $prod->price = 5;
        $prod->save();



        $prod = app()->make(Product::class);
        $prod->fill([
            'code' => 'APE2',
            'active' => true,
        ]);
        $prod->name = 'Spritz Aperol';
        $prod->price = 3;
        $prod->save();



        $prod = app()->make(Product::class);
        $prod->fill([
            'code' => 'BEV1',
            'active' => true,
        ]);
        $prod->name = 'Acqua e menta';
        $prod->price = 1.5;
        $prod->save();

        $prod = app()->make(Product::class);
        $prod->fill([
            'code' => 'BEV2',
            'active' => true,
        ]);
        $prod->name = 'Acqua Brillante';
        $prod->price = 2.5;
        $prod->save();

        $prod = app()->make(Product::class);
        $prod->fill([
            'code' => 'CAF1',
            'active' => true,
        ]);
        $prod->name = 'Caffè Deca';
        $prod->price = 1.3;
        $prod->save();

        $prod = app()->make(Product::class);
        $prod->fill([
            'code' => 'CAF2',
            'active' => true,
        ]);
        $prod->name = 'Caffè';
        $prod->price = 1.1;
        $prod->save();
    }
}
