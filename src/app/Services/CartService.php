<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartService
{
    public function getCart(): Cart
    {
        return Cart::firstOrCreate([
            'user_id' => Auth::id(),
        ]);
    }

    public function addProduct(Product $product): void
    {
        $cart = $this->getCart();

        $item = $cart->items()->where('product_id', $product->id)->first();

        if ($item) {
            $item->increment('quantity');
        } else {
            $cart->items()->create([
                'product_id' => $product->id,
                'quantity' => 1,
                'price_snapshot' => $product->price,
            ]);
        }
    }

    public function updateQuantity(int $productId, int $quantity): void
    {
        $cart = $this->getCart();

        if ($quantity <= 0) {
            $cart->items()->where('product_id', $productId)->delete();
            return;
        }

        $cart->items()
            ->where('product_id', $productId)
            ->update(['quantity' => $quantity]);
    }

    public function removeProduct(int $productId): void
    {
        $this->getCart()
            ->items()
            ->where('product_id', $productId)
            ->delete();
    }
}
