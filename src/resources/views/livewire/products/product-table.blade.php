<div class="relative flex h-full flex-col">
    {{-- Header --}}
    <div class="mb-4 flex items-center justify-between">
        <h1 class="text-xl font-semibold">
            {{ __('app.product.title') }}
            @if($showTrashed)
                <span class="text-sm text-gray-500">
                    ({{ __('app.product.trash') }})
                </span>
            @endif
        </h1>

        <div class="flex gap-2">
            @if($canManage)
                <button
                    wire:click="toggleTrash"
                    wire:loading.attr="disabled"
                    class="rounded border px-3 py-1 text-sm disabled:opacity-50 disabled:cursor-not-allowed"
                >
                    {{ $showTrashed
                        ? __('app.product.actions.show_active')
                        : __('app.product.actions.show_trash') }}
                </button>

                @if(! $showTrashed)
                    <button
                        wire:click="$dispatch('product.create')"
                        wire:loading.attr="disabled"
                        class="rounded bg-indigo-600 px-4 py-2 text-sm text-white hover:bg-indigo-700 disabled:opacity-50 disabled:cursor-not-allowed"
                    >
                        + {{ __('app.product.actions.create') }}
                    </button>
                @endif
            @endif
        </div>
    </div>

    {{-- Table --}}
    <div
        class="relative flex-1 overflow-auto rounded border"
        wire:loading.class="opacity-70"
    >
        {{-- Loading overlay --}}
        <div
            wire:loading.delay
            class="absolute inset-0 z-10 flex items-center justify-center bg-white/60 backdrop-blur-sm"
        >
            <div class="text-sm text-gray-500">
                {{ __('common.loading') }}
            </div>
        </div>

        <table class="min-w-full table-fixed divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="w-12 px-2">#</th>
                    <th class="w-16 px-2"></th>

                    <th
                        wire:click="sortBy('name')"
                        wire:loading.attr="disabled"
                        class="cursor-pointer px-2 text-left font-medium"
                    >
                        {{ __('app.product.fields.name') }}
                        @if($sortField === 'name')
                            {{ $sortDirection === 'asc' ? '▲' : '▼' }}
                        @endif
                    </th>

                    <th
                        wire:click="sortBy('price')"
                        wire:loading.attr="disabled"
                        class="w-32 cursor-pointer px-2 text-right font-medium"
                    >
                        {{ __('app.product.fields.price') }}
                        @if($sortField === 'price')
                            {{ $sortDirection === 'asc' ? '▲' : '▼' }}
                        @endif
                    </th>

                    <th
                        wire:click="sortBy('stock_quantity')"
                        wire:loading.attr="disabled"
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

                {{-- Filters --}}
                <tr class="bg-white">
                    <th></th>
                    <th></th>

                    <th class="px-2 py-1">
                        <input
                            type="text"
                            wire:model.live.debounce.300ms="filterName"
                            wire:loading.class="bg-gray-100"
                            placeholder="{{ __('app.product.filters.name') }}"
                            class="w-full rounded border-gray-300 text-xs"
                        />
                    </th>

                    <th class="px-2 py-1">
                        <input
                            type="text"
                            inputmode="decimal"
                            wire:model.live.debounce.300ms="filterPrice"
                            wire:loading.class="bg-gray-100"
                            placeholder="{{ __('app.product.filters.price') }}"
                            class="w-full rounded border-gray-300 text-xs text-right"
                        />
                    </th>

                    <th class="px-2 py-1">
                        <input
                            type="text"
                            inputmode="numeric"
                            wire:model.live.debounce.300ms="filterStock"
                            wire:loading.class="bg-gray-100"
                            placeholder="{{ __('app.product.filters.stock_quantity') }}"
                            class="w-full rounded border-gray-300 text-xs text-right"
                        />
                    </th>

                    <th></th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-100 bg-white">
                @forelse($products as $i => $product)
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

                        {{-- Name with highlight --}}
                        <td class="px-2 py-2 truncate">
                            @if($filterName !== '')
                                {!! str_replace(
                                    $filterName,
                                    '<mark class="rounded bg-yellow-200 px-1">'.$filterName.'</mark>',
                                    e($product->name)
                                ) !!}
                            @else
                                {{ $product->name }}
                            @endif
                        </td>

                        {{-- Price with highlight --}}
                        <td class="px-2 py-2 text-right">
                            @php $price = number_format($product->price, 2); @endphp
                            @if($filterPrice !== '')
                                {!! str_replace(
                                    $filterPrice,
                                    '<mark class="rounded bg-yellow-200 px-1">'.$filterPrice.'</mark>',
                                    $price
                                ) !!}
                            @else
                                {{ $price }}
                            @endif
                        </td>

                        {{-- Stock with highlight --}}
                        <td class="px-2 py-2 text-right">
                            @if($filterStock !== '')
                                {!! str_replace(
                                    $filterStock,
                                    '<mark class="rounded bg-yellow-200 px-1">'.$filterStock.'</mark>',
                                    (string) $product->stock_quantity
                                ) !!}
                            @else
                                {{ $product->stock_quantity }}
                            @endif
                        </td>

                        <td class="px-2 py-2 text-right space-x-2">
                            @if($canManage)
                                @if($showTrashed)
                                    <button
                                        wire:click="restore({{ $product->id }})"
                                        wire:loading.attr="disabled"
                                        class="text-green-600 disabled:opacity-50"
                                    >♻️</button>
                                @else
                                    <button
                                        wire:click="$dispatch('product.edit', {{ $product->id }})"
                                        wire:loading.attr="disabled"
                                    >✏️</button>

                                    <button
                                        wire:click="delete({{ $product->id }})"
                                        wire:loading.attr="disabled"
                                        class="text-red-600 disabled:opacity-50"
                                    >🗑</button>
                                @endif
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
