<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </div>
    </x-slot>

    {{-- NASZ LIVEWIRE DASHBOARD --}}
    <livewire:dashboard.dashboard-page />
</x-app-layout>
