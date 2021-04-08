<?php

namespace Lucmas\Reservations\Seeds;

use Lucmas\Reservations\Model\PermissionGroup;
use Illuminate\Database\Seeder;

class PermissionGroupTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        PermissionGroup::create([
            'slug' => 'order',
            'it' => ['name' => 'Gestione ordini', 'description' => 'Gruppo di permessi riguardanti gli ordini']
        ]);

        PermissionGroup::create([
            'slug' => 'product',
            'it' => ['name' => 'Gestione prodotti', 'description' => 'Gruppo di permessi riguardanti i prodotti']
        ]);

        PermissionGroup::create([
            'slug' => 'product-feature',
            'it' => ['name' => 'Gestione caratteristiche dei prodotti', 'description' => 'Gruppo di permessi riguardanti le caratteristiche dei prodotti']
        ]);

        PermissionGroup::create([
            'slug' => 'product-image',
            'it' => ['name' => 'Gestione immagini dei prodotti', 'description' => 'Gruppo di permessi riguardanti le immagini dei prodotti']
        ]);

        PermissionGroup::create([
            'slug' => 'product-attachment',
            'it' => ['name' => 'Gestione allegati dei prodotti', 'description' => 'Gruppo di permessi riguardanti gli allegati dei prodotti']
        ]);

        PermissionGroup::create([
            'slug' => 'product-related',
            'it' => ['name' => 'Gestione prodotti correlati', 'description' => 'Gruppo di permessi riguardanti i prodotti correlati']
        ]);

        PermissionGroup::create([
            'slug' => 'product-category',
            'it' => ['name' => 'Gestione delle categorie di un prodotto', 'description' => 'Gruppo di permessi riguardanti le categorie dei prodotti']
        ]);

        PermissionGroup::create([
            'slug' => 'data-sheet',
            'it' => ['name' => 'Gestione schede tecniche', 'description' => 'Gruppo di permessi riguardanti le schede tecniche']
        ]);

        PermissionGroup::create([
            'slug' => 'category',
            'it' => ['name' => 'Gestione categorie', 'description' => 'Gruppo di permessi riguardanti le categorie']
        ]);

        PermissionGroup::create([
            'slug' => 'category-feature',
            'it' => ['name' => 'Gestione caratteristiche delle categorie', 'description' => 'Gruppo di permessi riguardanti le caratteristiche delle categorie']
        ]);

        PermissionGroup::create([
            'slug' => 'category-image',
            'it' => ['name' => 'Gestione immagini della categoria', 'description' => 'Gruppo di permessi riguardanti le immagini della categoria']
        ]);

        PermissionGroup::create([
            'slug' => 'category-attachment',
            'it' => ['name' => 'Gestione allegati della categoria', 'description' => 'Gruppo di permessi riguardanti gli allegati della categoria']
        ]);

        PermissionGroup::create([
            'slug' => 'feature',
            'it' => ['name' => 'Gestione generale delle caratteristiche', 'description' => 'Gruppo di permessi riguardanti le caratteristiche in generale']
        ]);

        PermissionGroup::create([
            'slug' => 'type',
            'it' => ['name' => 'Gestione delle tipologie', 'description' => 'Gruppo di permessi riguardanti le tipologie']
        ]);

        PermissionGroup::create([
            'slug' => 'collection',
            'it' => ['name' => 'Gestione collezioni', 'description' => 'Gruppo di permessi riguardanti le collezioni']
        ]);

        PermissionGroup::create([
            'slug' => 'user',
            'it' => ['name' => 'Gestione utenti', 'description' => 'Gruppo di permessi riguardanti gli utenti']
        ]);

        PermissionGroup::create([
            'slug' => 'role',
            'it' => ['name' => 'Gestione ruoli', 'description' => 'Gruppo di permessi riguardanti i ruoli degli utenti']
        ]);

        PermissionGroup::create([
            'slug' => 'permission',
            'it' => ['name' => 'Gestione permessi', 'description' => 'Gruppo di permessi riguardanti i permessi']
        ]);

        PermissionGroup::create([
            'slug' => 'permission-group',
            'it' => ['name' => 'Gestione gruppi di permessi', 'description' => 'Gruppo di permessi riguardanti i gruppi di permessi']
        ]);

        PermissionGroup::create([
            'slug' => 'api-clients',
            'it' => ['name' => 'Gestione api', 'description' => 'Gestione Clients Api']
        ]);

        PermissionGroup::create([
            'slug' => 'checkout',
            'it' => ['name' => 'Gestione Ceckout', 'description' => 'Gestione Checkout']
        ]);
    }
}
