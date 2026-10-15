<x-layout>
    <x-slot:title>Modifier l'article - Mini-CMS</x-slot:title>

    <div class="mx-auto max-w-2xl py-8">
        <h1 class="mb-6 text-3xl font-bold text-gray-900">
            Modifier l'article
        </h1>

        <form method="POST" action="{{ route('posts.update', $post) }}" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label for="title" class="block font-medium text-gray-700">Titre</label>
                <input type="text" id="title" name="title"
                    value="{{ old('title', $post->title) }}" required
                    class="mt-1 w-full rounded-md border border-gray-300 px-3 py-2">
                @error('title')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="slug" class="block font-medium text-gray-700">Slug</label>
                <input type="text" id="slug" name="slug"
                    value="{{ old('slug', $post->slug) }}" required
                    pattern="[a-z0-9-]+"
                    class="mt-1 w-full rounded-md border border-gray-300 px-3 py-2">
                @error('slug')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="excerpt" class="block font-medium text-gray-700">Extrait</label>
                <input type="text" id="excerpt" name="excerpt"
                    value="{{ old('excerpt', $post->excerpt) }}"
                    class="mt-1 w-full rounded-md border border-gray-300 px-3 py-2">
                @error('excerpt')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="body" class="block font-medium text-gray-700">Contenu</label>
                <textarea id="body" name="body" rows="8" required
                    class="mt-1 w-full rounded-md border border-gray-300 px-3 py-2">{{ old('body', $post->body) }}</textarea>
                @error('body')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center gap-2">
                <input type="checkbox" id="is_published" name="is_published"
                    value="1" @checked(old('is_published', $post->is_published))>
                <label for="is_published">Publié</label>
            </div>

            <div class="flex gap-3">
                <button type="submit"
                    class="rounded-md bg-indigo-600 px-5 py-2.5 text-white hover:bg-indigo-700">
                    Enregistrer les modifications
                </button>

                <a href="{{ route('posts.show', $post) }}"
                    class="rounded-md border border-gray-300 px-5 py-2.5 text-gray-700">
                    Annuler
                </a>
            </div>
        </form>
    </div>
</x-layout>