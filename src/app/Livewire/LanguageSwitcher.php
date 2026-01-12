<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LanguageSwitcher extends Component
{
    public array $availableLocales = [];
    public string $currentLocale;

    public function mount(): void
    {
        $this->availableLocales = config('app.available_locales', ['en']);
        $this->currentLocale = app()->getLocale();
    }

    public function changeLocale(string $locale)
    {
        if (! in_array($locale, $this->availableLocales, true)) {
            return;
        }

        // Persist locale in session
        session(['locale' => $locale]);

        // Persist locale for authenticated user
        if (Auth::check()) {
            Auth::user()->update([
                'locale' => $locale,
            ]);
        }

        // Force new HTTP request so middleware can apply locale
        return redirect(request()->header('Referer'));
    }

    public function render()
    {
        return view('livewire.language-switcher');
    }
}
