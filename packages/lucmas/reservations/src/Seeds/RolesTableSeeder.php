<?php

namespace Lucmas\Reservations\Seeds;

use Lucmas\Reservations\Model\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {


        $role = app()->make(Role::class);

        $role->parent_id = NULL;
        $role->slug = "superadmin";
        $role->name = "Superadmin";
        $role->description = "L'utente è superadmin, possiede tutti i permessi";
        $role->save();


        $role = app()->make(Role::class);

        $role->parent_id = NULL;
        $role->slug = "guest";
        $role->name = "Guest";
        $role->description = "Ospite";
        $role->save();

    }
}
