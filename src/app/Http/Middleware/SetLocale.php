<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class SetLocale
{
    public function handle(Request $request, Closure $next)
    {
        $availableLocales = config('app.available_locales', []);

        // 1️⃣ Session locale (highest priority)
        if (
            session()->has('locale') &&
            in_array(session('locale'), $availableLocales, true)
        ) {
            App::setLocale(session('locale'));
        }
        // 2️⃣ User locale (fallback)
        elseif (
            Auth::check() &&
            Auth::user()->locale &&
            in_array(Auth::user()->locale, $availableLocales, true)
        ) {
            App::setLocale(Auth::user()->locale);
        }
        // 3️⃣ App default
        else {
            App::setLocale(config('app.locale'));
        }

        return $next($request);
    }
}
