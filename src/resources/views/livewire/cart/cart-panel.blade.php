<div>
    <h2 class="mb-4 text-xl font-semibold">
        {{ __('app.cart.title') }}
    </h2>

    @if ($items->isEmpty())
        <p class="text-gray-500">
            {{ __('app.cart.empty') }}
        </p>
    @else
        <ul class="space-y-3">
            @foreach ($items as $item)
                <li class="flex items-center justify-between rounded border p-3">
                    <div>
                        <p class="font-medium">
                            {{ $item->product->name }}
                        </p>

                        <p class="text-sm text-gray-600">
                            {{ number_format($item->product->price, 2) }}
                        </p>

                        <p class="text-sm text-gray-800">
                            Subtotal:
                            <strong>
                                {{ number_format($item->product->price * $item->quantity, 2) }}
                            </strong>
                        </p>
                    </div>

                    <div class="flex items-center gap-3">
                        <button
                            wire:click="decrease({{ $item->id }})"
                            class="rounded border px-2 py-1 text-sm hover:bg-gray-100"
                            type="button"
                        >
                            −
                        </button>

                        <span class="min-w-[2rem] text-center font-medium">
                            {{ $item->quantity }}
                        </span>

                        <button
                            wire:click="increase({{ $item->id }})"
                            @disabled($item->quantity >= $item->product->stock_quantity)
                            class="rounded border px-2 py-1 text-sm hover:bg-gray-100 disabled:opacity-40"
                            type="button"
                        >
                            +
                        </button>

                        <button
                            wire:click="remove({{ $item->id }})"
                            class="ml-2 text-sm text-red-600 underline"
                            type="button"
                        >
                            {{ __('app.cart.remove') }}
                        </button>
                    </div>
                </li>
            @endforeach
        </ul>

        <div class="mt-6 flex justify-end border-t pt-4">
            <div class="text-lg font-semibold">
                Total:
                <span class="ml-2">
                    {{ number_format($total, 2) }}
                </span>
            </div>
        </div>
    @endif
</div>
