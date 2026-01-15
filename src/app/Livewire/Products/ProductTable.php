<?php

namespace App\Livewire\Products;

use App\Models\Product;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class ProductTable extends Component
{
    use WithPagination;

    protected string $paginationTheme = 'tailwind';

    public string $search = '';

    public array $filters = [
        'name' => '',
        'price' => '',
        'stock_quantity' => '',
    ];

    public string $sortField = 'name';
    public string $sortDirection = 'asc';

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedFilters(): void
    {
        $this->resetPage();
    }

    public function sortBy(string $field): void
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }

        $this->resetPage();
    }

    #[On('product.saved')]
    public function refresh(): void
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.products.product-table', [
            'products' => Product::query()
                ->when($this->search !== '', fn ($q) =>
                    $q->where('name', 'like', "%{$this->search}%")
                )
                ->when($this->filters['name'] !== '', fn ($q) =>
                    $q->where('name', 'like', "%{$this->filters['name']}%")
                )
                ->when($this->filters['price'] !== '', fn ($q) =>
                    $q->whereRaw(
                        'CAST(price AS CHAR) LIKE ?',
                        [$this->filters['price'] . '%']
                    )
                )
                ->when($this->filters['stock_quantity'] !== '', fn ($q) =>
                    $q->whereRaw(
                        'CAST(stock_quantity AS CHAR) LIKE ?',
                        [$this->filters['stock_quantity'] . '%']
                    )
                )
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate(20),
            'canManage' => Gate::allows('manage-products'),
        ]);
    }
}
