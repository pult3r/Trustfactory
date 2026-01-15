<?php

return [

    'common' => [
        'cancel' => 'Cancel',
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

        'modal' => [
            'create' => [
                'title' => 'Create product',
                'submit' => 'Create',
            ],
            'edit' => [
                'title' => 'Edit product',
                'submit' => 'Save',
            ],
            'delete' => [
                'title' => 'Delete product',
                'submit' => 'Delete',
                'confirm' => 'Are you sure you want to delete this product?',
            ],
        ],

        'empty' => 'No products found.',
    ],

    'cart' => [
        'title' => 'Your cart',
        'empty' => 'Cart is empty',
    ],

];
