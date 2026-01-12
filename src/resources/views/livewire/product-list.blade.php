<div>
    <h2 class="text-xl font-semibold mb-4">
        {{ __('app.product.title') }}
    </h2>

    <div class="space-y-4">
        @forelse ($products as $product)
            <div class="flex justify-between items-center border p-4 rounded">
                <div>
                    <p class="font-medium">
                        {{ $product->name }}
                    </p>
                    <p class="text-sm text-gray-600">
                        {{ __('app.product.price') }}: {{ $product->price }}
                    </p>
                </div>

                <button
                    wire:click="addToCart({{ $product->id }})"
                    class="px-3 py-1 bg-indigo-600 text-white rounded text-sm"
                >
                    {{ __('app.cart.add') }}
                </button>
            </div>
        @empty
            <p class="text-gray-500">
                {{ __('app.product.empty') }}
            </p>
        @endforelse
    </div>
</div>
