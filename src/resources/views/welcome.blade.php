<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div>
            <x-input-label for="name" value="Name" />
            <x-text-input id="name" name="name" required />
            <x-input-error :messages="$errors->get('name')" />
        </div>

        <div class="mt-4">
            <x-input-label for="email" value="Email" />
            <x-text-input id="email" name="email" type="email" required />
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" value="Password" />
            <x-text-input id="password" name="password" type="password" required />
            <x-input-error :messages="$errors->get('password')" />
        </div>

        <div class="mt-4">
            <x-input-label for="password_confirmation" value="Confirm Password" />
            <x-text-input id="password_confirmation" name="password_confirmation" type="password" required />
        </div>

        <x-primary-button class="mt-6">
            Register
        </x-primary-button>
    </form>
</x-guest-layout>
