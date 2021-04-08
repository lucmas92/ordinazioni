<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */
    
    'accepted' => ':attribute deve essere acettato.',
    'active_url' => ':attribute non è un URL valido.',
    'after' => ':attribute deve essere una data successiva :date.',
    'after_or_equal' => ':attribute eve essere una data successiva o uguale a :date.',
    'alpha' => ':attribute può contenere solo lettere.',
    'alpha_dash' => ':attribute può contenere solo lettere, numeri, - and _.',
    'alpha_num' => ':attribute può contenere solo lettere e numeri.',
    'array' => ':attribute deve essere un array.',
    'before' => ':attribute deve essere una data precedente :date.',
    'before_or_equal' => ':attribute deve essere una data precedente o uguale a :date.',
    'between' => [
        'numeric' => ':attribute deve essere tra :min e :max.',
        'file' => ':attribute deve essere tra :min e :max kilobyte.',
        'string' => ':attribute deve essere tra :min e :max caratteri.',
        'array' => ':attribute deve essere tra :min e :max oggetti.',
    ],
    'boolean' => ':attribute deve essere vero o falso.',
    'confirmed' => 'Le :attribute non corrispondono.',
    'date' => ':attribute non è una data valida.',
    'date_equals' => ':attribute deve essere uguale a :date.',
    'date_format' => ':attribute non corrisponde al formato :format.',
    'different' => ':attribute e :other devono essere diversi.',
    'digits' => ':attribute deve essere lungo :digits cifre.',
    'digits_between' => ':attribute deve essere lungo tra :min e :max cifre.',
    'dimensions' => ':attribute ha una dimesnione invalida.',
    'distinct' => ':attribute ha un valore duplicato.',
    'email' => ':attribute deve essere un indirizzo email valido.',
    'ends_with' => ':attribute deve terminare con uno dei seguenti valori: :values',
    'exists' => ':attribute non è valido.',
    'file' => ':attribute deve essere un file.',
    'filled' => ':attribute deve avere un valore.',
    'gt' => [
        'numeric' => ':attribute deve essere più grande di :value.',
        'file' => ':attribute deve essere più grande di :value kilobyte.',
        'string' => ':attribute deve essere più lunga di :value caratteri.',
        'array' => ':attribute deve essere più grande di :value elementi.',
    ],
    'gte' => [
        'numeric' => ':attribute deve essere più grande o uguale a :value.',
        'file' => ':attribute deve essere più grande o uguale a :value kilobyte.',
        'string' => ':attribute deve essere più lunga o uguale a :value caratteri.',
        'array' => ':attribute deve avere :value elementi o più.',
    ],
    'image' => ':attribute deve essere un\'immagine.',
    'in' => 'L\'attributo :attribute non è valido.',
    'in_array' => ':attribute non è presente in :other.',
    'integer' => ':attribute deve essere un numero intero.',
    'ip' => ':attribute deve essere un indirizzo IP valido.',
    'ipv4' => ':attribute deve essere un indirizzo IPv4 valido.',
    'ipv6' => ':attribute deve essere un indirizzo IPv6 valido.',
    'json' => ':attribute deve essere una stringa JSON valida.',
    'lt' => [
        'numeric' => ':attribute deve essere minore di :value.',
        'file' => ':attribute deve essere minore :value kilobyte.',
        'string' => ':attribute deve essere minore :value caratteri.',
        'array' => ':attribute deve contenere meno di :value elementi.',
    ],
    'lte' => [
        'numeric' => ':attribute deve essere minore o uguale a :value.',
        'file' => ':attribute deve essere minore o uguale a :value kilobyte.',
        'string' => ':attribute deve essere minore o uguale a :value caratteri.',
        'array' => ':attribute non deve contenere più di :value elementi.',
    ],
    'max' => [
        'numeric' => ':attribute non può essere più grande di :max.',
        'file' => ':attribute non può essere più grande di :max kilobyte.',
        'string' => ':attribute non può essere più grande di  :max caratteri.',
        'array' => ':attribute non deve contenere più di :max oggetti.',
    ],
    'mimes' => ':attribute deve essere un file di tipo: :values.',
    'mimetypes' => ':attribute deve essere un file di tipo: :values.',
    'min' => [
        'numeric' => ':attribute deve almeno essere :min.',
        'file' => ':attribute deve pesare almeno :min kilobyte.',
        'string' => ':attribute deve essere lunga almeno :min caratteri.',
        'array' => ':attribute deve contenere almeno :min oggetti.',
    ],
    'not_in' => ':attribute non è valido.',
    'not_regex' => ':attribute non è in un formato valido.',
    'numeric' => ':attribute deve essere un numero.',
    'password' => 'La password è errata.',
    'present' => ':attribute deve essere presente.',
    'regex' => ':attribute non è in un formato valido.',
    'required' => ':attribute è richiesto.',
    'required_if' => ':attribute è richiesto quando :other è :value.',
    'required_unless' => ':attribute è richiesto almeno che :other sia in :values.',
    'required_with' => ':attribute è richiesto quando :values è presente.',
    'required_with_all' => ':attribute è richiesto quando :values sono presenti.',
    'required_without' => ':attribute è richiesto quando :values non è presente.',
    'required_without_all' => ':attribute è richiesto quando nessuno tra :values è presente.',
    'same' => ':attribute e :other devono essere uguali.',
    'size' => [
        'numeric' => ':attribute deve essere :size.',
        'file' => ':attribute deve pesare :size kilobyte.',
        'string' => ':attribute deve contenere :size caratteri.',
        'array' => ':attribute deve contenere :size elementi.',
    ],
    'starts_with' => ':attribute deve cominciare con uno dei seguenti valori: :values',
    'string' => ':attribute deve essere una stringa.',
    'timezone' => ':attribute deve essere un fuso orario valido.',
    'unique' => ':attribute è già stato preso.',
    'uploaded' => ':attribute non è stato caricato con successo.',
    'url' => ':attribute non ha un formato valido.',
    'uuid' => ':attribute deve essere un UUID valido.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        'email' => 'Indirizzo email',
        'password' => 'Password',
        'username' => 'Username',
        'name' => 'Nome',
        'description' => 'Descrizione',
        'description_short' => 'Descrizione breve',
        'name-' . config('translatable.locale') => 'Nome in ' . __('language.' . config('translatable.locale')),
        'desc-short-' . config('translatable.locale') => 'Descrizione breve in ' . __('language.' . config('translatable.locale')),
        'description-' . config('translatable.locale') => 'Descrizione in ' . __('language.' . config('translatable.locale')),
        'active' => 'Attivo',
        'value' => 'Valore',
        'file' => 'File',
        'visibility' => 'Visibilità',
        'type' => 'Tipologia',
        'code' => 'Codice',
        'feature' => 'Caratteristica',
        'role' => 'Ruolo',
        'permission' => 'Permesso',
        'collection' => 'Collezione',
        'parent' => 'Genitore',
        'slug' => 'Slug',
        'product' => 'Prodotto',
        'related' => 'Correlato',
        'image' => 'Immagine',
        'attachment' => 'Allegato',
        'sendTo' => 'Destinatario',
        'message' => 'Corpo del messaggio',
        'products' => 'Prodotti'
    ]
];
