<div class="flex h-full flex-col">
    {{-- Header --}}
    <div class="mb-4 flex items-center justify-between">
        <h1 class="text-xl font-semibold">
            {{ __('app.product.title') }}
        </h1>

        @if($canManage)
            <button
                wire:click="$dispatch('product.create')"
                class="rounded bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-700"
            >
                + {{ __('app.product.actions.create') }}
            </button>
        @endif
    </div>

    {{-- Table --}}
    <div class="flex-1 overflow-auto rounded border">
        <table class="min-w-full table-fixed divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-50">
                {{-- HEADER --}}
                <tr>
                    <th class="w-12 px-2 text-left">
                        {{ __('app.product.fields.lp') }}
                    </th>

                    <th class="w-16 px-2"></th>

                    <th
                        wire:click="sortBy('name')"
                        class="cursor-pointer px-2 text-left font-medium"
                    >
                        {{ __('app.product.fields.name') }}
                        @if($sortField === 'name')
                            {{ $sortDirection === 'asc' ? '▲' : '▼' }}
                        @endif
                    </th>

                    <th
                        wire:click="sortBy('price')"
                        class="w-32 cursor-pointer px-2 text-right font-medium"
                    >
                        {{ __('app.product.fields.price') }}
                        @if($sortField === 'price')
                            {{ $sortDirection === 'asc' ? '▲' : '▼' }}
                        @endif
                    </th>

                    <th
                        wire:click="sortBy('stock_quantity')"
                        class="w-32 cursor-pointer px-2 text-right font-medium"
                    >
                        {{ __('app.product.fields.stock_quantity') }}
                        @if($sortField === 'stock_quantity')
                            {{ $sortDirection === 'asc' ? '▲' : '▼' }}
                        @endif
                    </th>

                    <th class="w-24 px-2 text-right font-medium">
                        {{ __('app.product.fields.actions') }}
                    </th>
                </tr>

                {{-- FILTERS --}}
                <tr class="bg-white">
                    <th></th>
                    <th></th>

                    <th class="px-2 py-1">
                        <input
                            type="text"
                            wire:model.live.debounce.300ms="filters.name"
                            placeholder="{{ __('app.product.filters.name') }}"
                            class="w-full rounded border-gray-300 text-xs"
                        />
                    </th>

                    <th class="px-2 py-1">
                        <input
                            type="text"
                            inputmode="decimal"
                            wire:model.live.debounce.300ms="filters.price"
                            placeholder="{{ __('app.product.filters.price') }}"
                            class="w-full rounded border-gray-300 text-xs text-right"
                        />
                    </th>

                    <th class="px-2 py-1">
                        <input
                            type="text"
                            inputmode="numeric"
                            wire:model.live.debounce.300ms="filters.stock_quantity"
                            placeholder="{{ __('app.product.filters.stock_quantity') }}"
                            class="w-full rounded border-gray-300 text-xs text-right"
                        />
                    </th>

                    <th></th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-100 bg-white">
                @forelse($products as $index => $product)
                    <tr>
                        {{-- LP --}}
                        <td class="px-2 py-2">
                            {{ ($products->currentPage() - 1) * $products->perPage() + $index + 1 }}
                        </td>

                        {{-- IMAGE --}}
                        <td class="px-2 py-2">
                            <img
                                src="{{ $product->image_url ?: 'https://picsum.photos/40' }}"
                                alt="{{ $product->name }}"
                                class="h-10 w-10 rounded object-cover"
                            />
                        </td>

                        <td class="px-2 py-2 truncate">
                            {{ $product->name }}
                        </td>

                        <td class="px-2 py-2 text-right">
                            {{ number_format($product->price, 2) }}
                        </td>

                        <td class="px-2 py-2 text-right">
                            {{ $product->stock_quantity }}
                        </td>

                        <td class="px-2 py-2 text-right space-x-2">
                            @if($canManage)
                                <button
                                    wire:click="$dispatch('product.edit', {{ $product->id }})"
                                    class="text-indigo-600"
                                    title="{{ __('app.product.actions.edit') }}"
                                >
                                    ✏️
                                </button>

                                <button
                                    wire:click="$dispatch('product.delete', {{ $product->id }})"
                                    class="text-red-600"
                                    title="{{ __('app.product.actions.delete') }}"
                                >
                                    🗑
                                </button>
                            @else
                                —
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-6 text-center text-gray-500">
                            {{ __('app.product.empty') }}
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $products->links() }}
    </div>
</div>
