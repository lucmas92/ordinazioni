<?php

return [
    'total_count' => 'Numero totale categorie',
    'create_button' => 'Nuova Categoria',
    'product' => [
        'categories' => 'Categorie del prodotto',
        'empty' => 'Questo prodotto non appartiene a nessuna categoria',
        'no-categories' => 'Non sono presenti categorie',
        'add' => 'Aggiungi il prodotto ad una categoria',
        'addProduct' => 'Aggiungi prodotti alla categoria',
        'delete-ask' => 'Sei sicuro di voler rimuovere il prodotto da questa categoria?',
        'delete-success' => 'Prodotto rimosso dalla categoria con successo',
        'add-success' => 'Prodotto aggiunto alla categoria con successo'
    ],
    'update-success' => 'Categoria modificata con successo',
    'parent-loop' => 'Impossibile salvare le modifiche perchè ciò creerebbe un loop con la categoria genitore',
    'create-success' => 'Categoria creata con successo',
    'store-success' => 'Categoria creata con successo',
    'delete-ask' => 'Sei sicuro di voler eliminare questa categoria?',
    'delete-success' => 'Categoria eliminata con successo',
    'has-children' => 'Impossibile eliminare questa categoria perchè è genitore di altre categorie',
    'has-products' => 'Impossibile eliminare questa categoria perchè contiene prodotti',
    'has-images' => 'Impossibile eliminare questa categoria perchè contiene immagini',
    'has-attachments' => 'Impossibile eliminare questa categoria perchè contiene allegati',
    'categories' => 'Categorie',
    'sub-categories' => 'Sotto Categorie',
    'edit' => 'Modifica categoria',
    'detail' => 'Dettaglio categoria',
    'view-detail' => 'Vedi categoria',
    'no-parent' => 'Nessun genitore',
    'create' => 'Creazione nuova categoria',
    'create_with_parent' => 'Creazione nuova sottocategoria: :Name',
    'empty' => 'Non sono presenti categorie',
    'children' => 'È genitore delle seguenti categorie:',
    'children-categories' => 'È genitore di',
    'no-child' => 'Nessuna categoria',
    'products' => 'Prodotti',
    'no-product' => 'Non contiene prodotti',
    'images' => 'Immagini',
    'no-image' => 'Non contiene immagini',
    'attachments' => 'Allegati',
    'no-attachment' => 'Non contiene allegati',
    'view-product-image' => 'Visualizza immagini',
    'view-product-attachment' => 'Visualizza allegati',
    'category-products' => 'Prodotti della categoria',
    'all-products' =>  'Prodotti nella categoria',
    'view-product' => 'Visualizza prodotti',
    'return-to-category' => 'Ritorna alla categoria',
    'no-default-description' => 'È necessario inserire la descrizione in ' . __('Reservations::language.'.config('translatable.locale')) . 'se la si vuole inserire anche in altre lingue',
    'field' => [
        'id' => ['name' => 'Id', 'placeholder' => '', 'help' => ''],
        'code' => ['name' => 'Codice', 'placeholder' => 'Codice Categoria', 'help' => ''],
        'name' => ['name' => 'Nome', 'placeholder' => 'Inserisci il nome della categoria in :LANGUAGE', 'help' => 'Inserisci il nome della categoria in lingua'],
        'description_short' => ['name' => 'Descrizione breve', 'placeholder' => 'Inserisci la descrizione breve della categoria in :LANGUAGE', 'help' => 'Inserisci la descrizione breve della categoria in lingua'],
        'description' => ['name' => 'Descrizione', 'placeholder' => 'Inserisci la descrizione della categoria in :LANGUAGE', 'help' => 'Inserisci la descrizione della categoria in lingua'],
        'parent' => ['name' => 'Categoria Superiore', 'placeholder' => 'Seleziona la categoria superiore', 'help' => 'Seleziona la categoria superiore'],
        'position' => ['name' => 'Posizione', 'placeholder' => 'Seleziona la posizione della categoria', 'help' => 'Seleziona la posizione della categoria'],
        'photo' => ['name' => 'Foto', 'placeholder' => 'Carica una foto', 'help' => 'Carica una foto per la categoria'],
        'active' => ['name' => 'Stato', 'placeholder' => '', 'type' => ['enabled' => 'Attivo','disabled' => 'Non attivo'], 'help' => 'Imposta lo stato della categoria'],

    ],
    'return-to-categories' => 'Ritorna alle categorie',
];