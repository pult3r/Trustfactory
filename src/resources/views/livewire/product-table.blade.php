<div>
    <h2 class="text-xl font-semibold mb-4">
        {{ __('app.product.title') }}
    </h2>

    <div class="space-y-4">
        @foreach ($products as $product)
            <div class="flex items-center gap-4 border p-4 rounded">

                {{-- Image --}}
                <img
                    src="{{ $product->image_url }}"
                    alt="{{ $product->name }}"
                    class="w-16 h-16 object-cover rounded"
                >

                {{-- Info --}}
                <div class="flex-1">
                    <p class="font-medium">
                        {{ $product->name }}
                    </p>
                    <p class="text-sm text-gray-600">
                        {{ __('app.product.price') }}: {{ $product->price }}
                    </p>
                    <p class="text-sm text-gray-500">
                        {{ __('app.product.stock') }}: {{ $product->stock_quantity }}
                    </p>
                </div>

                {{-- Action placeholder --}}
                <div>
                    <button
                        class="text-sm text-indigo-600 underline"
                        disabled
                    >
                        {{ __('app.product.edit') }}
                    </button>
                </div>

            </div>
        @endforeach
    </div>

    <div class="mt-6">
        {{ $products->links() }}
    </div>
</div>
