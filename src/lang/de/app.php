<?php

return [

    'common' => [
        'cancel' => 'Abbrechen',
    ],

    'product' => [
        'title' => 'Produkte',

        'fields' => [
            'lp' => '#',
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

        'modal' => [
            'create' => [
                'title' => 'Produkt erstellen',
                'submit' => 'Erstellen',
            ],
            'edit' => [
                'title' => 'Produkt bearbeiten',
                'submit' => 'Speichern',
            ],
            'delete' => [
                'title' => 'Produkt löschen',
                'submit' => 'Löschen',
                'confirm' => 'Möchten Sie dieses Produkt wirklich löschen?',
            ],
        ],

        'empty' => 'Keine Produkte gefunden.',
    ],

    'cart' => [
        'title' => 'Ihr Warenkorb',
        'empty' => 'Der Warenkorb ist leer',
    ],

];
