<div class="relative flex h-full flex-col">
    {{-- Header --}}
    <div class="mb-4 flex items-center justify-between">
        <h1 class="text-xl font-semibold">
            {{ __('app.product.title') }}
        </h1>
    </div>

    {{-- Table --}}
    <div class="relative flex-1 overflow-auto rounded border">
        <table class="min-w-full table-fixed divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="w-12 px-2">#</th>
                    <th class="w-16 px-2"></th>
                    <th class="px-2 text-left font-medium">{{ __('app.product.fields.name') }}</th>
                    <th class="w-32 px-2 text-right font-medium">{{ __('app.product.fields.price') }}</th>
                    <th class="w-32 px-2 text-right font-medium">{{ __('app.product.fields.stock_quantity') }}</th>
                    <th class="w-40 px-2 text-right font-medium">{{ __('app.product.fields.actions') }}</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-100 bg-white">
                @foreach($products as $i => $product)
                    <tr>
                        <td class="px-2 py-2">
                            {{ ($products->currentPage() - 1) * $products->perPage() + $i + 1 }}
                        </td>

                        <td class="px-2 py-2">
                            <img
                                src="{{ $product->image_url ?: 'https://picsum.photos/40' }}"
                                class="h-10 w-10 rounded object-cover"
                            />
                        </td>

                        <td class="px-2 py-2 truncate">{{ $product->name }}</td>
                        <td class="px-2 py-2 text-right">{{ number_format($product->price, 2) }}</td>
                        <td class="px-2 py-2 text-right">{{ $product->stock_quantity }}</td>

                        <td class="px-2 py-2 text-right space-x-2">
                            @auth
                                <button
                                    wire:click="addToCart({{ $product->id }})"
                                    class="text-sm text-indigo-600 underline"
                                >
                                    {{ __('app.cart.add') }}
                                </button>
                            @endauth

                            @if($canManage)
                                <button wire:click="$dispatch('product.edit', {{ $product->id }})">✏️</button>
                                <button wire:click="delete({{ $product->id }})" class="text-red-600">🗑</button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $products->links() }}
    </div>
</div>
