<?php

return [
    'field' => [
        'id' => ['name' => 'Id', 'placeholder' => '', 'help' => ''],
        'name' => ['name' => 'Nome', 'placeholder' => 'Inserisci il nome dell\' immagine del prodotto', 'help' => 'Inserisci il nome dell\'immagine prodotto in lingua'],
        'active' => ['name' => 'Stato', 'placeholder' => '', 'type' => ['enabled' => 'Attiva', 'disabled' => 'Non attiva'], 'help' => 'Imposta lo stato della caratteristica'],
        'collection' => ['name' => 'Collezione', 'placeholder' => 'Seleziona la collezione', 'help' => 'Seleziona la collezione'],
        'file' => ['name' => 'File', 'placeholder' => 'Seleziona il file', 'help' => 'Seleziona il file'],
        'cover' => ['name' => 'Cover del prodotto', 'type' => ['disabled' => 'Non sarà cover', 'enabled' => 'Sarà cover'], 'help' => 'Seleziona se l\'immagine sarà cover del prodotto']
    ],
];
