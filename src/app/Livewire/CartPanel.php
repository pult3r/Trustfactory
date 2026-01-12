<?php

namespace App\Livewire;

use App\Models\CartItem;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CartPanel extends Component
{
    public Collection $items;

    protected $listeners = [
        'cartUpdated' => '$refresh',
    ];

    public function mount(): void
    {
        $this->items = collect();
    }

    public function render()
    {
        $this->items = CartItem::with('product')
            ->where('user_id', Auth::id())
            ->get();

        return view('livewire.cart-panel');
    }

    public function remove(int $itemId): void
    {
        CartItem::where('id', $itemId)
            ->where('user_id', Auth::id())
            ->delete();

        $this->dispatch('cartUpdated');
    }
}
