<?php

namespace Lucmas\Reservations\Seeds;

use Illuminate\Database\Seeder;
use Lucmas\Reservations\Model\Table;

class TablesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!Table::find(1)){
            Table::create(['number' => 1]);
            Table::create(['number' => 2]);
            Table::create(['number' => 3]);
            Table::create(['number' => 4]);
            Table::create(['number' => 5]);
        }

    }
}
