<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ProductTable extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';

    public function render()
    {
        return view('livewire.product-table', [
            'products' => Product::orderBy('id', 'desc')
                ->paginate(20),
        ]);
    }
}
