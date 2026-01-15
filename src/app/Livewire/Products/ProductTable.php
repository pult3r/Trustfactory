<?php

namespace App\Livewire\Products;

use App\Models\Product;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;

class ProductTable extends Component
{
    use WithPagination;

    protected string $paginationTheme = 'tailwind';
    protected string $sessionKey = 'products.filters';

    // URL state (shareable)
    #[Url]
    public bool $showTrashed = false;

    #[Url]
    public string $sortField = 'name';

    #[Url]
    public string $sortDirection = 'asc';

    // Live filters (not stored in URL)
    public string $filterName = '';
    public string $filterPrice = '';
    public string $filterStock = '';

    public function mount(): void
    {
        if ($stored = Session::get($this->sessionKey)) {
            $this->filterName = $stored['filterName'] ?? '';
            $this->filterPrice = $stored['filterPrice'] ?? '';
            $this->filterStock = $stored['filterStock'] ?? '';
        }
    }

    // Filter updates

    public function updatedFilterName(): void
    {
        $this->resetPage();
        $this->storeFilters();
    }

    public function updatedFilterPrice(): void
    {
        $this->resetPage();
        $this->storeFilters();
    }

    public function updatedFilterStock(): void
    {
        $this->resetPage();
        $this->storeFilters();
    }

    protected function storeFilters(): void
    {
        Session::put($this->sessionKey, [
            'filterName' => $this->filterName,
            'filterPrice' => $this->filterPrice,
            'filterStock' => $this->filterStock,
        ]);
    }

    // Actions

    public function toggleTrash(): void
    {
        Gate::authorize('manage-products');

        $this->showTrashed = ! $this->showTrashed;
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

    public function restore(int $id): void
    {
        Gate::authorize('manage-products');

        Product::onlyTrashed()->findOrFail($id)->restore();
        $this->resetPage();
    }

    public function delete(int $id): void
    {
        Gate::authorize('manage-products');

        Product::findOrFail($id)->delete();
        $this->resetPage();
    }

    #[On('product.saved')]
    public function refresh(): void
    {
        $this->resetPage();
    }

    // Render

    public function render()
    {
        $query = Product::query();

        if ($this->showTrashed) {
            $query->onlyTrashed();
        }

        return view('livewire.products.product-table', [
            'products' => $query
                ->when($this->filterName !== '', fn ($q) =>
                    $q->where('name', 'like', "%{$this->filterName}%")
                )
                ->when($this->filterPrice !== '', fn ($q) =>
                    $q->whereRaw(
                        'CAST(price AS CHAR) LIKE ?',
                        [$this->filterPrice . '%']
                    )
                )
                ->when($this->filterStock !== '', fn ($q) =>
                    $q->whereRaw(
                        'CAST(stock_quantity AS CHAR) LIKE ?',
                        [$this->filterStock . '%']
                    )
                )
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate(20),
            'canManage' => Gate::allows('manage-products'),
        ]);
    }
}
