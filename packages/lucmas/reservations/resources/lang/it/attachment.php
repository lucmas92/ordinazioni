<?php

return [
    'store-success' => 'Allegato aggiunto con successo',
    'update-success' => 'Allegato modificato con successo',
    'delete-success' => 'Allegato eliminato con successo',
    'edit' => 'Modifica informazioni allegato',
    'new' => 'Inserimento nuovo allegato',
    'attachments' => 'Allegati prodotto',
    'empty' => 'Non sono presenti allegati',
    'delete-ask' => 'Sei sicuro di voler eliminare questo allegato?',
    'detail' => 'Dettaglio allegato',
    'video' => [
        'new' => 'Inserimento nuovo video',
        'edit' =>'Modifica informazioni video'
    ],
    'category' => [
        'attachments' => 'Allegati della categoria',
        'delete-ask' => 'Sei sicuro di voler eliminare questo allegato dalla categoria?',
        'delete-success' => 'Allegato eliminato con successo dalla categoria',
        'store-success' => 'Allegato aggiunto con successo alla categoria',
        'update-success' => 'Allegato modificato con successo',
        'detail' => 'Dettaglio allegato di categoria',
        'edit' => 'Modifica allegato della categoria',
        'create' => 'Creazione nuovo allegato della categoria',
        'empty' => 'Questa categoria non ha allegati',
        'field' => [
            'id' => ['name' => 'Id', 'placeholder' => '', 'help' => ''],
            'name' => ['name' => 'Nome', 'placeholder' => 'Inserisci il nome dell\'allegato :LANGUAGE', 'help' => 'Inserisci il nome dell\'allegato in lingua'],
            'collection' => ['name' => 'Collezione', 'placeholder' => 'Seleziona la collezione', 'help' => 'Seleziona la collezione'],
            'position' => ['name' => 'Posizione', 'placeholder' => 'Seleziona la posizione', 'help' => 'Seleziona la posizione'],
            'file' => ['name' => 'File', 'placeholder' => 'Selezione un file', 'help' => 'Seleziona un file'],
        ],
        'upload' => [
            'field' => [
                'attachment-name' => ['name' => 'Nome', 'placeholder' => 'Inserisci il nome dell\'allegato delle categorie in :LANGUAGE', 'help' => 'Inserisci il nome dell\'immagine in lingua'],
                'attachment-collection' => ['name' => 'Collezione', 'placeholder' => 'Seleziona la collezione', 'help' => 'Seleziona la collezione'],
            ]
        ]
    ],
    'product' => [
        'field' => [
            'id' => ['name' => 'Id', 'placeholder' => '', 'help' => ''],
            'name' => ['name' => 'Nome', 'placeholder' => 'Inserisci il nome dell\'allegato :LANGUAGE', 'help' => 'Inserisci il nome dell\'allegato in lingua'],
            'collection' => ['name' => 'Collezione', 'placeholder' => 'Seleziona la collezione', 'help' => 'Seleziona la collezione'],
            'position' => ['name' => 'Posizione', 'placeholder' => 'Seleziona la posizione', 'help' => 'Seleziona la posizione'],
            'file' => ['name' => 'File', 'placeholder' => 'Selezione un file', 'help' => 'Seleziona un file'],
        ],
        'upload' => [
            'field' => [
                'attachment-name' => ['name' => 'Nome', 'placeholder' => 'Inserisci il nome dell\'allegato dei prodotti in :LANGUAGE', 'help' => 'Inserisci il nome dell\'immagine in lingua'],
                'attachment-collection' => ['name' => 'Collezione', 'placeholder' => 'Seleziona la collezione', 'help' => 'Seleziona la collezione'],
            ]
        ]
    ],
    'return-to-attachments' => 'Ritorna agli allegati',
    'return-to-attachment' => 'Ritorna al dettaglio'
];
