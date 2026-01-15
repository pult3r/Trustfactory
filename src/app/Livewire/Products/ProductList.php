<?php

namespace App\Livewire\Products;

use App\Models\Product;
use App\Services\CartService;
use Livewire\Component;

class ProductList extends Component
{
    protected $listeners = [
        'localeChanged' => '$refresh',
    ];

    public function addToCart(int $productId, CartService $cartService): void
    {
        $product = Product::findOrFail($productId);
        $cartService->addProduct($product);

        $this->dispatch('cartUpdated');
    }

    public function render()
    {
        return view('livewire.products.product-list', [
            'products' => Product::all(),
        ]);
    }
}
