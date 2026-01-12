<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="grid gap-6 md:grid-cols-3">

            {{-- LEFT: Products --}}
            <div class="md:col-span-2">
                <div class="bg-white shadow rounded-lg p-6">
                    <livewire:product-table />
                </div>
            </div>

            {{-- RIGHT: Cart --}}
            <div class="md:col-span-1">
                <div class="sticky top-6">
                    <div class="bg-white shadow rounded-lg p-6">
                        <livewire:cart-panel />
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
