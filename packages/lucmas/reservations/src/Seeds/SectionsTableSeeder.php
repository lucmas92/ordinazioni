<?php

namespace Lucmas\Reservations\Seeds;

use Lucmas\Reservations\Model\Section;
use Illuminate\Database\Seeder;

class SectionsTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Section::create([
            'name' => 'Dentro'
        ]);
        Section::create([
            'name' => 'Fuori'
        ]);
    }
}
