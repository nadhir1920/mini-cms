<x-layout>
    <x-slot:title>Catégorie introuvable - Mini-CMS</x-slot:title>

    <x-page-header
        title="Catégorie introuvable"
        subtitle="Cette catégorie n'existe pas ou a été supprimée."
    />

    <x-alert type="info" title="Que faire ?" class="max-w-2xl">
        Vérifiez l'adresse, ou choisissez une catégorie existante ci-dessous.
    </x-alert>

    @if (isset($categories) && $categories->isNotEmpty())
        <section class="mt-8">
            <h2 class="text-xl font-bold mb-3">Catégories disponibles</h2>
            <ul class="flex flex-wrap gap-3">
                @foreach ($categories as $category)
                    <li>
                        <a href="{{ route('posts.category', $category) }}" class="inline-block rounded-md border border-gray-300 bg-white px-3 py-1.5 text-sm text-gray-700 hover:border-indigo-600 hover:text-indigo-600">
                            {{ $category->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </section>
    @endif

    <p class="mt-6">
        <a href="{{ route('posts.index') }}" class="font-medium text-indigo-600 hover:underline">
            Voir tous les articles
        </a>
    </p>
</x-layout>
