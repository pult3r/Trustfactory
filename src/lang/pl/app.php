<?php

return [

    'common' => [
        'dashboard' => 'Panel',
    ],

    'product' => [
        'title' => 'Produkty',

        'fields' => [
            'lp' => 'Lp.',
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

        'empty' => 'Brak produktów do wyświetlenia.',
    ],

    'cart' => [
        'title' => 'Twój koszyk',
        'add' => 'Dodaj do koszyka',
        'remove' => 'Usuń',
        'empty' => 'Koszyk jest pusty',
    ],

    'auth' => [
        'login' => 'Zaloguj się',
        'register' => 'Zarejestruj się',
        'logout' => 'Wyloguj się',
        'email' => 'Email',
        'password' => 'Hasło',
        'confirm_password' => 'Potwierdź hasło',
    ],

];
