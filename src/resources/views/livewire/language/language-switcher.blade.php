<div>
    <label for="language"
           class="sr-only">
        Language
    </label>

    <select
        id="language"
        class="border-gray-300 rounded-md text-sm focus:border-indigo-500 focus:ring-indigo-500"
        wire:change="changeLocale($event.target.value)"
    >
        @foreach ($availableLocales as $locale)
            <option
                value="{{ $locale }}"
                @selected($currentLocale === $locale)
            >
                @switch($locale)
                    @case('en') 🇬🇧 English @break
                    @case('pl') 🇵🇱 Polski @break
                    @case('de') 🇩🇪 Deutsch @break
                    @default {{ strtoupper($locale) }}
                @endswitch
            </option>
        @endforeach
    </select>
</div>
