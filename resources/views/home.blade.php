<x-layout>
    <x-slot:title>Accueil - Mini-CMS</x-slot:title>

    <div class="mx-auto max-w-5xl px-4 py-8">
        <h1 class="text-3xl font-bold">
            Bienvenue sur Mini-CMS
        </h1>

        <p class="mt-4 text-gray-700">
            Mini-CMS est le projet fil rouge de l'Atelier Framework Côté Serveur (Laravel 13).
        </p>

        <p class="mt-6">
            <a href="{{ route('about') }}" class="text-red-600 underline">
                En savoir plus sur le projet
            </a>
        </p>

        <section class="mt-10">
            <h2 class="mb-6 text-2xl font-bold">
                Les derniers articles
            </h2>

            <div class="grid gap-6 md:grid-cols-3">
                @forelse ($latestPosts as $post)
                    <x-post-card :post="$post" />
                @empty
                    <p class="text-gray-600">
                        Aucun article publié pour le moment.
                    </p>
                @endforelse
            </div>

            <p class="mt-6">
                <a href="{{ route('posts.index') }}"
                   class="text-indigo-600 underline">
                    Voir tous les articles
                </a>
            </p>
        </section>
    </div>
</x-layout>
