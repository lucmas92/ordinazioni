<?php

namespace Lucmas\Reservations\Seeds;

use Lucmas\Reservations\Model\Permission;
use Lucmas\Reservations\Model\PermissionGroup;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $group_id = PermissionGroup::where('slug', '=', 'order')->first()->id;
        Permission::create([
            'group_id' => $group_id,
            'slug' => 'view-order',
            'it' => ['name' => 'Visualizzazione ordini', 'description' => 'L\'utente può visualizzare gli ordini']
        ]);
        Permission::create([
            'group_id' => $group_id,
            'slug' => 'edit-order',
            'it' => ['name' => 'Modifica ordini', 'description' => 'L\'utente può modificare gli ordini']
        ]);
        Permission::create([
            'group_id' => $group_id,
            'slug' => 'create-order',
            'it' => ['name' => 'Creazione ordini', 'description' => 'L\'utente può creare nuovi ordini']
        ]);
        Permission::create([
            'group_id' => $group_id,
            'slug' => 'delete-order',
            'it' => ['name' => 'Eliminazione ordini', 'description' => 'L\'utente può eliminare gli ordini']
        ]);


        $group_id = PermissionGroup::where('slug', '=', 'product')->first()->id;
        Permission::create([
            'group_id' => $group_id,
            'slug' => 'view-product',
            'it' => ['name' => 'Visualizzazione prodotti', 'description' => 'L\'utente può visualizzare i prodotti visibili']
        ]);
        Permission::create([
            'group_id' => $group_id,
            'slug' => 'edit-product',
            'it' => ['name' => 'Modifica prodotti', 'description' => 'L\'utente può modificare i prodotti']
        ]);
        Permission::create([
            'group_id' => $group_id,
            'slug' => 'create-product',
            'it' => ['name' => 'Creazione prodotti', 'description' => 'L\'utente può creare nuovi prodotti']
        ]);
        Permission::create([
            'group_id' => $group_id,
            'slug' => 'delete-product',
            'it' => ['name' => 'Eliminazione prodotti', 'description' => 'L\'utente può eliminare i prodotti']
        ]);
        Permission::create([
            'group_id' => $group_id,
            'slug' => 'view-inactive-product',
            'it' => ['name' => 'Visualizzazione prodotti non attivi', 'description' => 'L\'utente può visualizzare i prodotti non attivi']
        ]);
        Permission::create([
            'group_id' => $group_id,
            'slug' => 'edit-product-category',
            'it' => ['name' => 'Modifica delle categorie di un prodotto', 'description' => 'L\'utente può modificare l\'ordine delle categorie alle quali appartiene un prodotto']
        ]);

        $group_id = PermissionGroup::where('slug', '=', 'product-image')->first()->id;
        Permission::create([
            'group_id' => $group_id,
            'slug' => 'view-product-image',
            'it' => ['name' => 'Visualizzazione immagini dei prodotti', 'description' => 'L\'utente può visualizzare le immagini dei prodotti']
        ]);
        Permission::create([
            'group_id' => $group_id,
            'slug' => 'edit-product-image',
            'it' => ['name' => 'Modifica immagini dei prodotti', 'description' => 'L\'utente può modificare le immagini dei prodotti']
        ]);
        Permission::create([
            'group_id' => $group_id,
            'slug' => 'create-product-image',
            'it' => ['name' => 'Aggiunta immagini ai prodotti', 'description' => 'L\'utente può aggiungere immagini ai prodotti']
        ]);
        Permission::create([
            'group_id' => $group_id,
            'slug' => 'delete-product-image',
            'it' => ['name' => 'Eliminazione immagini dei prodotti', 'description' => 'L\'utente può eliminare le immagini dei prodotti']
        ]);
        Permission::create([
            'group_id' => $group_id,
            'slug' => 'download-product-image',
            'it' => ['name' => 'Download immagini dei prodotti', 'description' => 'L\'utente può scaricare le immagini dei prodotti']
        ]);

        $group_id = PermissionGroup::where('slug', '=', 'product-related')->first()->id;
        Permission::create([
            'group_id' => $group_id,
            'slug' => 'view-product-related',
            'it' => ['name' => 'Visualizzazione dei prodotti correlati', 'description' => 'L\'utente può visualizzare i prodotti correlati']
        ]);
        Permission::create([
            'group_id' => $group_id,
            'slug' => 'edit-product-related',
            'it' => ['name' => 'Modifica prodotti correlati', 'description' => 'L\'utente può modificare i prodotti correlati']
        ]);
        Permission::create([
            'group_id' => $group_id,
            'slug' => 'add-product-related',
            'it' => ['name' => 'Aggiunta di prodotti correlati', 'description' => 'L\'utente può aggiungere dei prodotti correlati']
        ]);
        Permission::create([
            'group_id' => $group_id,
            'slug' => 'delete-product-related',
            'it' => ['name' => 'Rimozione legami tra prodotti', 'description' => 'L\'utente può eliminare i prodotti dai correlati di un\'altro prodotti']
        ]);

        $group_id = PermissionGroup::where('slug', '=', 'product-category')->first()->id;
        Permission::create([
            'group_id' => $group_id,
            'slug' => 'view-product-category',
            'it' => ['name' => 'Visualizzazione delle categorie dei prodotti', 'description' => 'L\'utente può visualizzare le categorie dei prodotti']
        ]);
        Permission::create([
            'group_id' => $group_id,
            'slug' => 'create-product-category',
            'it' => ['name' => 'Aggiunta di un prodotto a categorie', 'description' => 'L\'utente può aggiungere i prodotti alle categorie']
        ]);
        Permission::create([
            'group_id' => $group_id,
            'slug' => 'delete-product-category',
            'it' => ['name' => 'Rimozione prodotti da categorie', 'description' => 'L\'utente può rimuovere i prodotti dalle categorie']
        ]);

        $group_id = PermissionGroup::where('slug', '=', 'category')->first()->id;
        Permission::create([
            'group_id' => $group_id,
            'slug' => 'view-category',
            'it' => ['name' => 'Visualizzazione categorie', 'description' => 'L\'utente può visualizzare le categorie']
        ]);
        Permission::create([
            'group_id' => $group_id,
            'slug' => 'edit-category',
            'it' => ['name' => 'Modifica categorie', 'description' => 'L\'utente può modificare le categorie']
        ]);
        Permission::create([
            'group_id' => $group_id,
            'slug' => 'create-category',
            'it' => ['name' => 'Creazione nuove categorie', 'description' => 'L\'utente può creare nuove categorie']
        ]);
        Permission::create([
            'group_id' => $group_id,
            'slug' => 'delete-category',
            'it' => ['name' => 'Eliminazione categorie', 'description' => 'L\'utente può eliminare categorie']
        ]);
        Permission::create([
            'group_id' => $group_id,
            'slug' => 'view-category-product',
            'it' => ['name' => 'Visualizzazione prodotti delle categorie', 'description' => 'L\'utente può visualizzare i prodotti contenuti nelle categorie']
        ]);

        $group_id = PermissionGroup::where('slug', '=', 'category-image')->first()->id;
        Permission::create([
            'group_id' => $group_id,
            'slug' => 'view-category-image',
            'it' => ['name' => 'Visualizzazione immagini di categoria', 'description' => 'L\'utente può visualizzare le immagini appartenenti ad una categoria']
        ]);
        Permission::create([
            'group_id' => $group_id,
            'slug' => 'edit-category-image',
            'it' => ['name' => 'Modifica immagini delle categoria', 'description' => 'L\'utente può modificare le immagini delle categorie']
        ]);
        Permission::create([
            'group_id' => $group_id,
            'slug' => 'create-category-image',
            'it' => ['name' => 'Agginuta nuove immagini alle categorie', 'description' => 'L\'utente può aggiungere nuove immagini alle categorie']
        ]);
        Permission::create([
            'group_id' => $group_id,
            'slug' => 'delete-category-image',
            'it' => ['name' => 'Eliminazione immagini delle categorie', 'description' => 'L\'utente può rimuovere le immagini dalle categorie']
        ]);
        Permission::create([
            'group_id' => $group_id,
            'slug' => 'download-category-image',
            'it' => ['name' => 'Download immagini delle categorie', 'description' => 'L\'utente può scaricare le immagini delle categorie']
        ]);

        $group_id = PermissionGroup::where('slug', '=', 'user')->first()->id;
        Permission::create([
            'group_id' => $group_id,
            'slug' => 'view-user',
            'it' => ['name' => 'Visualizzazione utenti', 'description' => 'L\'utente può visualizzare gli utenti della piattaforma']
        ]);
        Permission::create([
            'group_id' => $group_id,
            'slug' => 'edit-user',
            'it' => ['name' => 'Modifica utenti', 'description' => 'L\'utente può modificare gli utenti registrati alla piattaforma']
        ]);
        Permission::create([
            'group_id' => $group_id,
            'slug' => 'create-user',
            'it' => ['name' => 'Creazione nuovi utenti', 'description' => 'L\'utente può creare nuovi utenti']
        ]);
        Permission::create([
            'group_id' => $group_id,
            'slug' => 'delete-user',
            'it' => ['name' => 'Rimozione utenti', 'description' => 'L\'utente può rimuovere gli utenti dalla piattaforma']
        ]);
        Permission::create([
            'group_id' => $group_id,
            'slug' => 'give-user-permission',
            'it' => ['name' => 'Assegnazione permessi ad utenti', 'description' => 'L\'utente può assegnare permessi ad altri utenti']
        ]);
        Permission::create([
            'group_id' => $group_id,
            'slug' => 'login-as-others',
            'it' => ['name' => 'Effettuare login con altri account', 'description' => 'L\'utente può effettuare login su account di altri utenti']
        ]);

        $group_id = PermissionGroup::where('slug', '=', 'role')->first()->id;
        Permission::create([
            'group_id' => $group_id,
            'slug' => 'view-role',
            'it' => ['name' => 'Visualizzazione ruoli', 'description' => 'L\'utente può visualizzare i ruoli']
        ]);
        Permission::create([
            'group_id' => $group_id,
            'slug' => 'edit-role',
            'it' => ['name' => 'Modifica ruoli', 'description' => 'L\'utente può modificare i ruoli']
        ]);
        Permission::create([
            'group_id' => $group_id,
            'slug' => 'create-role',
            'it' => ['name' => 'Creazione ruoli', 'description' => 'L\'utente può creare nuovi ruoli']
        ]);
        Permission::create([
            'group_id' => $group_id,
            'slug' => 'delete-role',
            'it' => ['name' => 'Eliminazione ruoli', 'description' => 'L\'utente può eliminare i ruoli']
        ]);

        Permission::create([
            'group_id' => NULL,
            'slug' => 'send-message',
            'it' => ['name' => 'Invio Messaggi', 'description' => 'L\'utente può inviare messaggi ad altri utenti']
        ]);

        $group_id = PermissionGroup::where('slug', '=', 'checkout')->first()->id;
        Permission::create([
            'group_id' => $group_id,
            'slug' => 'view-checkout',
            'it' => ['name' => 'Visualizzazione checkout', 'description' => 'L\'utente può visualizzare i conti da pagare']
        ]);
    }
}
