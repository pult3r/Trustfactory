<?php

namespace App\Livewire\Cart;

use App\Models\CartItem;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\On;

class CartPanel extends Component
{
    public Collection $items;

    public float $total = 0.0;

    protected $listeners = [
        'cartUpdated' => 'loadItems',
    ];

    public function mount(): void
    {
        $this->items = collect();
        $this->loadItems();
    }

    #[On('cart.add')]
    public function add(int $productId): void
    {
        if (! Auth::check()) {
            return;
        }

        $item = CartItem::with('product')
            ->where('user_id', Auth::id())
            ->where('product_id', $productId)
            ->first();

        if ($item) {
            if ($item->quantity < $item->product->stock_quantity) {
                $item->increment('quantity');
            }
        } else {
            $productStock = optional(
                \App\Models\Product::find($productId)
            )->stock_quantity ?? 0;

            if ($productStock > 0) {
                CartItem::create([
                    'user_id' => Auth::id(),
                    'product_id' => $productId,
                    'quantity' => 1,
                ]);
            }
        }

        $this->loadItems();
    }

    public function increase(int $itemId): void
    {
        if (! Auth::check()) {
            return;
        }

        $item = CartItem::with('product')
            ->where('id', $itemId)
            ->where('user_id', Auth::id())
            ->first();

        if (! $item) {
            return;
        }

        if ($item->quantity < $item->product->stock_quantity) {
            $item->increment('quantity');
        }

        $this->loadItems();
    }

    public function decrease(int $itemId): void
    {
        if (! Auth::check()) {
            return;
        }

        $item = CartItem::where('id', $itemId)
            ->where('user_id', Auth::id())
            ->first();

        if (! $item) {
            return;
        }

        if ($item->quantity <= 1) {
            $item->delete();
        } else {
            $item->decrement('quantity');
        }

        $this->loadItems();
    }

    public function remove(int $itemId): void
    {
        if (! Auth::check()) {
            return;
        }

        CartItem::where('id', $itemId)
            ->where('user_id', Auth::id())
            ->delete();

        $this->loadItems();
    }

    protected function calculateTotal(): void
    {
        $this->total = $this->items->sum(function ($item) {
            return $item->quantity * $item->product->price;
        });
    }

    public function loadItems(): void
    {
        if (! Auth::check()) {
            $this->items = collect();
            $this->total = 0;
            return;
        }

        $this->items = CartItem::with('product')
            ->where('user_id', Auth::id())
            ->get();

        $this->calculateTotal();
    }

    public function render()
    {
        return view('livewire.cart.cart-panel');
    }
}
