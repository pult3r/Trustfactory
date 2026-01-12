<?php

return [

    'common' => [
        'dashboard' => 'Dashboard',
    ],

    'product' => [
        'title' => 'Produkte',

        'fields' => [
            'lp' => 'Nr.',
            'name' => 'Name',
            'price' => 'Preis',
            'stock_quantity' => 'Menge',
            'actions' => 'Aktionen',
        ],

        'filters' => [
            'name' => 'Name',
            'price' => 'Preis',
            'stock_quantity' => 'Menge',
        ],

        'actions' => [
            'create' => 'Produkt hinzufügen',
            'edit' => 'Bearbeiten',
            'delete' => 'Löschen',
        ],

        'empty' => 'Keine Produkte vorhanden.',
    ],

    'cart' => [
        'title' => 'Warenkorb',
        'add' => 'In den Warenkorb',
        'remove' => 'Entfernen',
        'empty' => 'Warenkorb ist leer',
    ],

    'auth' => [
        'login' => 'Anmelden',
        'register' => 'Registrieren',
        'logout' => 'Abmelden',
        'email' => 'E-Mail',
        'password' => 'Passwort',
        'confirm_password' => 'Passwort bestätigen',
    ],

];
