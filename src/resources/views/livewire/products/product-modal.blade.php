<div>
    @if($open)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50">
            <div class="w-full max-w-lg rounded-lg bg-white p-6 shadow-xl">
                <h2 class="mb-4 text-lg font-semibold">
                    {{ __('products.modal.' . $mode . '.title') }}
                </h2>

                @if($mode !== 'delete')
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium">
                                {{ __('products.fields.name') }}
                            </label>
                            <input type="text" wire:model.live="name"
                                   class="mt-1 w-full rounded border-gray-300" />
                            @error('name') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium">
                                {{ __('products.fields.price') }}
                            </label>
                            <input type="number" step="0.01" wire:model.live="price"
                                   class="mt-1 w-full rounded border-gray-300" />
                            @error('price') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium">
                                {{ __('products.fields.stock_quantity') }}
                            </label>
                            <input type="number" wire:model.live="stock_quantity"
                                   class="mt-1 w-full rounded border-gray-300" />
                            @error('stock_quantity') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium">
                                {{ __('products.fields.image_url') }}
                            </label>
                            <input type="text" wire:model.live="image_url"
                                   class="mt-1 w-full rounded border-gray-300" />
                            @error('image_url') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                    </div>
                @else
                    <p class="text-sm text-gray-700">
                        {{ __('products.modal.delete.confirm') }}
                    </p>
                @endif

                <div class="mt-6 flex justify-end gap-2">
                    <button wire:click="$set('open', false)"
                            class="rounded bg-gray-200 px-4 py-2">
                        {{ __('common.cancel') }}
                    </button>

                    <button wire:click="save"
                            @class([
                                'rounded px-4 py-2 text-white',
                                'bg-red-600' => $mode === 'delete',
                                'bg-indigo-600' => $mode !== 'delete',
                            ])>
                        {{ __('products.modal.' . $mode . '.submit') }}
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>
