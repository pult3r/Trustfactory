<div>
    <h2 class="text-xl font-semibold mb-4">
        {{ __('app.cart.title') }}
    </h2>

    @if ($items->isEmpty())
        <p class="text-gray-500">
            {{ __('app.cart.empty') }}
        </p>
    @else
        <ul class="space-y-3">
            @foreach ($items as $item)
                <li class="flex justify-between items-center border p-3 rounded">
                    <div>
                        <p class="font-medium">
                            {{ $item->product->name }}
                        </p>
                        <p class="text-sm text-gray-600">
                            {{ $item->quantity }} × {{ $item->product->price }}
                        </p>
                    </div>

                    <button
                        wire:click="remove({{ $item->id }})"
                        class="text-sm text-red-600 underline"
                        type="button"
                    >
                        {{ __('app.cart.remove') }}
                    </button>
                </li>
            @endforeach
        </ul>
    @endif
</div>
