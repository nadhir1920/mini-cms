<x-layout>
    <x-slot:title>Catégories - Mini-CMS</x-slot:title>

    <div class="mb-6 flex items-center justify-between">
        <h1 class="text-3xl font-bold text-gray-900">Catégories</h1>
        <a href="{{ route('admin.categories.create') }}" class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-700">
            Nouvelle catégorie
        </a>
    </div>

    @if ($categories->isEmpty())
        <x-alert type="info" title="Aucune catégorie">
            Aucune catégorie pour l'instant.
        </x-alert>
    @else
        <div class="overflow-x-auto rounded-lg border border-gray-200 bg-white">
            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-gray-50 text-left font-medium text-gray-700">
                    <tr>
                        <th class="px-4 py-3">Nom</th>
                        <th class="px-4 py-3">Slug</th>
                        <th class="px-4 py-3">Articles</th>
                        <th class="px-4 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($categories as $category)
                        <tr>
                            <td class="px-4 py-3 font-medium text-gray-900">{{ $category->name }}</td>
                            <td class="px-4 py-3 text-gray-600">{{ $category->slug }}</td>
                            <td class="px-4 py-3 text-gray-600">{{ $category->posts_count }}</td>
                            <td class="px-4 py-3">
                                <div class="flex flex-wrap items-center gap-4">
                                    <a href="{{ route('admin.categories.edit', $category) }}" class="text-indigo-600 hover:underline">Modifier</a>
                                    <details>
                                        <summary class="cursor-pointer text-red-600 hover:underline">Supprimer</summary>
                                        <form method="POST" action="{{ route('admin.categories.destroy', $category) }}" class="mt-2 rounded border border-red-200 bg-red-50 p-3">
                                            @csrf
                                            @method('DELETE')
                                            <p class="mb-2 text-xs text-red-800">Supprimer cette catégorie ? Ses articles resteront sans catégorie.</p>
                                            <button type="submit" class="rounded bg-red-600 px-3 py-1 text-xs font-medium text-white hover:bg-red-700">
                                                Confirmer la suppression
                                            </button>
                                        </form>
                                    </details>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</x-layout>
