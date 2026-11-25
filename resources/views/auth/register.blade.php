<x-layout>
    <x-slot:title>Inscription - Mini-CMS</x-slot:title>

    <x-page-header
        title="Créer un compte"
        subtitle="Un compte auteur permet d'écrire et de modifier ses propres articles."
    />

    <form method="POST" action="{{ route('register.store') }}" class="max-w-md space-y-5">
        @csrf

        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Nom</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" class="mt-1 w-full rounded-md border border-gray-300 px-3 py-2">
            @error('name')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Adresse e-mail</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" class="mt-1 w-full rounded-md border border-gray-300 px-3 py-2">
            @error('email')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Mot de passe</label>
            <input type="password" id="password" name="password" class="mt-1 w-full rounded-md border border-gray-300 px-3 py-2">
            @error('password')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmer le mot de passe</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="mt-1 w-full rounded-md border border-gray-300 px-3 py-2">
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="rounded-md bg-indigo-600 px-5 py-2.5 font-medium text-white hover:bg-indigo-700">Créer mon compte</button>
            <a href="{{ route('login') }}" class="text-sm text-gray-600 hover:underline">Déjà inscrit ? Se connecter</a>
        </div>
    </form>
</x-layout>
