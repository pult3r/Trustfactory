<?php

return [

    'common' => [
        'cancel' => 'Anuluj',
    ],

    'product' => [
        'title' => 'Produkty',

        'fields' => [
            'lp' => '#',
            'name' => 'Nazwa',
            'price' => 'Cena',
            'stock_quantity' => 'Ilość',
            'actions' => 'Akcje',
        ],

        'filters' => [
            'name' => 'Nazwa',
            'price' => 'Cena',
            'stock_quantity' => 'Ilość',
        ],

        'actions' => [
            'create' => 'Dodaj produkt',
            'edit' => 'Edytuj',
            'delete' => 'Usuń',
        ],

        'modal' => [
            'create' => [
                'title' => 'Dodaj produkt',
                'submit' => 'Dodaj',
            ],
            'edit' => [
                'title' => 'Edytuj produkt',
                'submit' => 'Zapisz',
            ],
            'delete' => [
                'title' => 'Usuń produkt',
                'submit' => 'Usuń',
                'confirm' => 'Czy na pewno chcesz usunąć ten produkt?',
            ],
        ],

        'empty' => 'Brak produktów.',
    ],

    'cart' => [
        'title' => 'Twój koszyk',
        'empty' => 'Koszyk jest pusty',
    ],

];
