<?php

namespace Lucmas\Reservations\Seeds;

use Lucmas\Reservations\Model\Role;
use Lucmas\Reservations\Model\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $role_id = Role::where('slug', '=', 'superadmin')->first()->id;

        User::create([
            'name' => 'Amministratore',
            'username' => 'superadmin',
            'email' => 'massignani.luca@hotmail.it',
            'password' => Hash::make('superadmin'),
            'role_id' => $role_id
        ]);
        User::create([
            'name' => 'Gueset',
            'username' => 'guest',
            'email' => 'guest@mail.com',
            'password' => Hash::make('guest'),
            'role_id' => $role_id
        ]);
        User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'massiluca@hotmail.it',
            'password' => Hash::make('admin'),
            'role_id' => $role_id
        ]);
    }
}
