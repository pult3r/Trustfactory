<?php

namespace App\Livewire\Products;

use App\Models\Product;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Livewire\Attributes\On;

class ProductModal extends Component
{
    public bool $open = false;
    public string $mode = 'create'; // create|edit|delete
    public ?int $productId = null;

    public string $name = '';
    public float $price = 0;
    public int $stock_quantity = 0;
    public string $image_url = '';

    #[On('product.create')]
    public function create(): void
    {
        Gate::authorize('manage-products');

        $this->resetForm();
        $this->mode = 'create';
        $this->open = true;
    }

    #[On('product.edit')]
    public function edit(int $id): void
    {
        Gate::authorize('manage-products');

        $product = Product::findOrFail($id);

        $this->productId = $product->id;
        $this->name = $product->name;
        $this->price = $product->price;
        $this->stock_quantity = $product->stock_quantity;
        $this->image_url = $product->image_url;

        $this->mode = 'edit';
        $this->open = true;
    }

    #[On('product.delete')]
    public function confirmDelete(int $id): void
    {
        Gate::authorize('manage-products');

        $this->productId = $id;
        $this->mode = 'delete';
        $this->open = true;
    }

    public function save(): void
    {
        Gate::authorize('manage-products');

        if ($this->mode === 'delete') {
            Product::findOrFail($this->productId)->delete();

            $this->close();
            $this->dispatch('product.saved');
            return;
        }

        $this->validate($this->rules());

        if ($this->mode === 'create') {
            Product::create($this->only([
                'name',
                'price',
                'stock_quantity',
                'image_url',
            ]));
        }

        if ($this->mode === 'edit') {
            Product::findOrFail($this->productId)->update(
                $this->only([
                    'name',
                    'price',
                    'stock_quantity',
                    'image_url',
                ])
            );
        }

        $this->close();
        $this->dispatch('product.saved');
    }

    protected function rules(): array
    {
        if ($this->mode === 'delete') {
            return [];
        }

        return [
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
            'stock_quantity' => ['required', 'integer', 'min:0'],
            'image_url' => ['nullable', 'url'],
        ];
    }

    protected function resetForm(): void
    {
        $this->reset([
            'productId',
            'name',
            'price',
            'stock_quantity',
            'image_url',
        ]);
    }

    protected function close(): void
    {
        $this->open = false;
        $this->resetErrorBag();
    }

    public function render()
    {
        return view('livewire.products.product-modal');
    }
}
