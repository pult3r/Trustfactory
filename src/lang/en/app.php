<?php

return [

    'common' => [
        'dashboard' => 'Dashboard',
    ],

    'product' => [
        'title' => 'Products',

        'fields' => [
            'lp' => '#',
            'name' => 'Name',
            'price' => 'Price',
            'stock_quantity' => 'Quantity',
            'actions' => 'Actions',
        ],

        'filters' => [
            'name' => 'Name',
            'price' => 'Price',
            'stock_quantity' => 'Quantity',
        ],

        'actions' => [
            'create' => 'Add product',
            'edit' => 'Edit',
            'delete' => 'Delete',
        ],

        'empty' => 'No products found.',
    ],

    'cart' => [
        'title' => 'Your Cart',
        'add' => 'Add to cart',
        'remove' => 'Remove',
        'empty' => 'Cart is empty',
    ],

    'auth' => [
        'login' => 'Log in',
        'register' => 'Register',
        'logout' => 'Log out',
        'email' => 'Email',
        'password' => 'Password',
        'confirm_password' => 'Confirm Password',
    ],

];
