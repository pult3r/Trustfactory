<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('app.common.dashboard') }}
            </h2>

            <livewire:language.language-switcher />
        </div>
    </x-slot>

    <livewire:dashboard.dashboard-page />
</x-app-layout>
