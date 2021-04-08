<?php

namespace Lucmas\Reservations\Seeds;

use Lucmas\Reservations\Model\Category;
use Lucmas\Reservations\Model\Product;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cat = app()->make(Category::class);
        $cat->fill([
            'code' => '1',
            'active' => true,
        ]);
        $cat->name = 'Piatti';
        $cat->description = "";
        $cat->description_short = '';
        $cat->save();

        $cat = app()->make(Category::class);
        $cat->fill([
            'code' => '1',
            'active' => true,
        ]);
        $cat->name = 'Bevande';
        $cat->description = "";
        $cat->description_short = '';
        $cat->save();

        $cat = app()->make(Category::class);
        $cat->fill([
            'code' => '3',
            'active' => true,
        ]);
        $cat->name = 'Birre';
        $cat->parent_id = 2;
        $cat->description = "";
        $cat->description_short = '';
        $cat->save();

        $cat = app()->make(Category::class);
        $cat->fill([
            'code' => '3',
            'active' => true,
        ]);
        $cat->name = 'Aperitivi';
        $cat->parent_id = 2;
        $cat->description = "";
        $cat->description_short = '';
        $cat->save();

        $cat = app()->make(Category::class);
        $cat->fill([
            'code' => '3',
            'active' => true,
        ]);
        $cat->name = 'Bibite';
        $cat->parent_id = 2;
        $cat->description = "";
        $cat->description_short = '';
        $cat->save();

        $cat = app()->make(Category::class);
        $cat->fill([
            'code' => '3',
            'active' => true,
        ]);
        $cat->name = 'Bianchi Fermi';
        $cat->parent_id = 2;
        $cat->description = "";
        $cat->description_short = '';
        $cat->save();

        $cat = app()->make(Category::class);
        $cat->fill([
            'code' => '3',
            'active' => true,
        ]);
        $cat->name = 'Birre alla spina';
        $cat->parent_id = 2;
        $cat->description = "";
        $cat->description_short = '';
        $cat->save();

        $cat = app()->make(Category::class);
        $cat->fill([
            'code' => '3',
            'active' => true,
        ]);
        $cat->name = 'Birre in bottiglia';
        $cat->parent_id = 2;
        $cat->description = "";
        $cat->description_short = '';
        $cat->save();

        $cat = app()->make(Category::class);
        $cat->fill([
            'code' => '3',
            'active' => true,
        ]);
        $cat->name = 'Caffetteria';
        $cat->parent_id = 2;
        $cat->description = "";
        $cat->description_short = '';
        $cat->save();

        $cat = app()->make(Category::class);
        $cat->fill([
            'code' => '3',
            'active' => true,
        ]);
        $cat->name = 'Spumanti';
        $cat->parent_id = 2;
        $cat->description = "";
        $cat->description_short = '';
        $cat->save();

        $cat = app()->make(Category::class);
        $cat->fill([
            'code' => '3',
            'active' => true,
        ]);
        $cat->name = 'Metodo Classico';
        $cat->parent_id = 2;
        $cat->description = "";
        $cat->description_short = '';
        $cat->save();

    }
}
