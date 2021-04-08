<?php

return [
    'store-success' => 'Immagine aggiunta con successo',
    'cover-success' => 'Immagine impostata come cover',
    'update-success' => 'Immagine modificata con successo',
    'delete-success' => 'Immagine eliminata con successo',
    'edit' => 'Modifica immagine prodotto',
    'new' => 'Aggiungi nuova immagine',
    'delete-ask' => 'Sei sicuro di voler eliminare questa immagine dal prodotto?',
    'empty' => 'Questo prodotto non ha immagini',
    'product-images' => 'Immagini prodotto',
    'immagine' => 'Immagine',
    'detail' => 'Dettaglio immagine',
    'category' => [
        'empty' => 'Questa categoria non ha immagini',
        'images' => 'Immagini di categoria',
        'detail' => 'Dettaglio immagine',
        'delete-ask' => 'Sei sicuro di voler rimuovere questa questa immagine?',
        'delete-success' => 'Immagine eliminata con successo',
        'create' => 'Aggiungi nuova immagine',
        'store-success' => 'Immagine aggiunta alla categoria con successo',
        'edit' => 'Modifica immagine',
        'update-success' => 'Immagine modificata con successo',
        'field' => [
            'id' => ['name' => 'Id', 'placeholder' => '', 'help' => ''],
            'name' => ['name' => 'Nome', 'placeholder' => 'Inserisci il nome dell\'immagine della categoria in :LANGUAGE', 'help' => 'Inserisci il nome dell\'immagine in lingua'],
            'active' => ['name' => 'Stato', 'placeholder' => '', 'type' => ['enabled' => 'Attiva', 'disabled' => 'Non attiva'], 'help' => 'Imposta lo stato della caratteristica'],
            'collection' => ['name' => 'Collezione', 'placeholder' => 'Seleziona la collezione', 'help' => 'Seleziona la collezione'],
            'file' => ['name' => 'File', 'placeholder' => 'Seleziona il file', 'help' => 'Seleziona il file'],
            'cover' => ['name' => 'Cover del prodotto', 'type' => ['disabled' => 'Non sarà cover', 'enabled' => 'Sarà cover'], 'help' => 'Seleziona se l\'immagine sarà cover della categoria']
        ],
        'upload' => [
            'field' => [
                'image-name' => ['name' => 'Nome', 'placeholder' => 'Inserisci il nome dell\'immagine delle categorie in :LANGUAGE', 'help' => 'Inserisci il nome dell\'immagine in lingua'],
                'image-collection' => ['name' => 'Collezione', 'placeholder' => 'Seleziona la collezione', 'help' => 'Seleziona la collezione'],
            ]
        ]
    ],
    'product' => [
        'field' => [
            'id' => ['name' => 'Id', 'placeholder' => '', 'help' => ''],
            'name' => ['name' => 'Nome', 'placeholder' => 'Inserisci il nome dell\'immagine del prodotto in :LANGUAGE', 'help' => 'Inserisci il nome dell\'immagine in lingua'],
            'active' => ['name' => 'Stato', 'placeholder' => '', 'type' => ['enabled' => 'Attiva', 'disabled' => 'Non attiva'], 'help' => 'Imposta lo stato della caratteristica'],
            'collection' => ['name' => 'Collezione', 'placeholder' => 'Seleziona la collezione', 'help' => 'Seleziona la collezione'],
            'file' => ['name' => 'File', 'placeholder' => 'Seleziona il file', 'help' => 'Seleziona il file'],
            'cover' => ['name' => 'Cover del prodotto', 'type' => ['disabled' => 'Non sarà cover', 'enabled' => 'Sarà cover'], 'help' => 'Seleziona se l\'immagine sarà cover del prodotto']
        ],
        'upload' => [
            'field' => [
                'image-name' => ['name' => 'Nome', 'placeholder' => 'Inserisci il nome dell\'immagine dei prodotti in :LANGUAGE', 'help' => 'Inserisci il nome dell\'immagine in lingua'],
                'image-collection' => ['name' => 'Collezione', 'placeholder' => 'Seleziona la collezione', 'help' => 'Seleziona la collezione'],
            ]
        ]
    ],
    'return-to-images' => 'Ritorna alle immagini',
    'return-to-image' => 'Ritorna al dettaglio'
];
