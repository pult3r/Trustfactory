<nav class="bg-white border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">

        {{-- Left --}}
        <div class="font-semibold text-lg">
            {{ config('app.name') }}
        </div>

        {{-- Right --}}
        <div class="flex items-center gap-4">
            {{-- Language switcher --}}
            <livewire:language.language-switcher />

            {{-- Logout --}}
            <form method="POST" action="/logout">
                @csrf
                <button
                    type="submit"
                    class="text-sm text-gray-600 underline"
                >
                    {{ __('app.auth.logout') }}
                </button>
            </form>
        </div>

    </div>
</nav>
