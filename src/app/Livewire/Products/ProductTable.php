<?php

namespace App\Livewire\Products;

use App\Models\Product;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;

class ProductTable extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    protected string $paginationTheme = 'tailwind';
    protected string $sessionKey = 'products.filters';

    public const LOW_STOCK_THRESHOLD = 5;

    #[Url]
    public bool $showTrashed = false;

    #[Url]
    public string $sortField = 'name';

    #[Url]
    public string $sortDirection = 'asc';

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

    protected function storeFilters(): void
    {
        Session::put($this->sessionKey, [
            'filterName' => $this->filterName,
            'filterPrice' => $this->filterPrice,
            'filterStock' => $this->filterStock,
        ]);
    }

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

    /**
     * Add product to cart (logged users only)
     */
    public function addToCart(int $productId): void
    {
        if (! auth()->check()) {
            return;
        }

        $this->dispatch('cart.add', $productId);
    }

    public function render()
    {
        return view('livewire.products.product-table', [
            'products' => Product::query()
                ->when($this->filterName !== '', fn ($q) =>
                    $q->where('name', 'like', "%{$this->filterName}%")
                )
                ->when($this->filterPrice !== '', fn ($q) =>
                    $q->whereRaw('CAST(price AS CHAR) LIKE ?', [$this->filterPrice . '%'])
                )
                ->when($this->filterStock !== '', fn ($q) =>
                    $q->whereRaw('CAST(stock_quantity AS CHAR) LIKE ?', [$this->filterStock . '%'])
                )
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate(20),

            'canManage' => auth()->check()
                && auth()->user()->can('create', Product::class),

            'lowStockThreshold' => self::LOW_STOCK_THRESHOLD,
        ]);
    }
}
