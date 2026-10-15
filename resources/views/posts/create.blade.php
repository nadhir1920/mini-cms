<x-layout>
    <x-slot:title>Nouvel article - Mini-CMS</x-slot:title>

    <div class="mx-auto max-w-2xl py-8">
        <h1 class="mb-2 text-3xl font-bold text-gray-900">
            Nouvel article
        </h1>

        <p class="mb-6 text-gray-600">
            Remplissez les champs pour créer un nouvel article.
        </p>

        @if ($errors->any())
            <div class="mb-6 rounded-md border border-red-300 bg-red-50 p-4 text-red-700">
                <p class="mb-2 font-semibold">Le formulaire contient des erreurs :</p>
                <ul class="list-inside list-disc">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('posts.store') }}" class="space-y-5">
            @csrf

            <div>
                <label for="title" class="mb-1 block font-medium text-gray-700">
                    Titre
                </label>
                <input
                    type="text"
                    id="title"
                    name="title"
                    value="{{ old('title') }}"
                    required
                    class="w-full rounded-md border border-gray-300 px-3 py-2"
                >
                @error('title')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="slug" class="mb-1 block font-medium text-gray-700">
                    Slug (minuscules, chiffres et tirets)
                </label>
                <input
                    type="text"
                    id="slug"
                    name="slug"
                    value="{{ old('slug') }}"
                    required
                    pattern="[a-z0-9-]+"
                    class="w-full rounded-md border border-gray-300 px-3 py-2"
                >
                @error('slug')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="body" class="mb-1 block font-medium text-gray-700">
                    Contenu
                </label>
                <textarea
                    id="body"
                    name="body"
                    rows="8"
                    required
                    class="w-full rounded-md border border-gray-300 px-3 py-2"
                >{{ old('body') }}</textarea>
                @error('body')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center gap-2">
                <input
                    type="checkbox"
                    id="is_published"
                    name="is_published"
                    value="1"
                    @checked(old('is_published'))
                >
                <label for="is_published" class="text-gray-700">
                    Publier immédiatement
                </label>
            </div>

            <div class="flex flex-wrap gap-3">
                <button
                    type="submit"
                    class="rounded-md bg-indigo-600 px-5 py-2.5 font-medium text-white hover:bg-indigo-700"
                >
                    Enregistrer
                </button>

                <a
                    href="{{ route('posts.index') }}"
                    class="rounded-md border border-gray-300 px-5 py-2.5 text-gray-700 hover:bg-gray-50"
                >
                    Annuler
                </a>
            </div>
        </form>
    </div>
</x-layout>
