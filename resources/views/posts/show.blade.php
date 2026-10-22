<x-layout>
    <x-slot:title>{{ $post->title }} - Mini-CMS</x-slot:title>

    <article class="max-w-2xl">
        <a href="{{ route('posts.index') }}" class="text-sm text-indigo-600 hover:underline">
            Retour aux articles
        </a>

        <h1 class="text-3xl font-bold mt-4 mb-2">{{ $post->title }}</h1>

        @if ($post->excerpt)
            <p class="text-lg text-gray-600 mb-6">
                {{ $post->excerpt }}
            </p>
        @endif

        <p class="text-sm text-gray-500 mb-6">
            @if ($post->published_at)
                Publié le {{ $post->published_at->format('d/m/Y') }}
            @else
                Brouillon
            @endif
        </p>

        @if ($post->user)
            <p class="text-sm text-gray-500 mb-2">
                Auteur : {{ $post->user->name }}
            </p>
        @endif

        @if ($post->category)
            <p class="text-sm text-gray-500 mb-2">
                Catégorie : {{ $post->category->name }}
            </p>
        @endif

        @if ($post->tags->isNotEmpty())
            <div class="flex flex-wrap gap-2 my-4">
                @foreach ($post->tags as $tag)
                    <span class="rounded bg-gray-100 px-2 py-1 text-sm text-gray-700">
                        {{ $tag->name }}
                    </span>
                @endforeach
            </div>
        @endif

        <div class="text-gray-800 leading-relaxed whitespace-pre-line">
            {{ $post->body }}
        </div>

        <div class="mt-8 space-y-3">
            <a href="{{ route('posts.edit', $post) }}"
               class="block w-fit rounded-md bg-indigo-600 px-4 py-2 text-white">
                Modifier
            </a>

            <form method="POST" action="{{ route('posts.destroy', $post) }}">
                @csrf
                @method('DELETE')

                <button type="submit"
                        style="background-color: #dc2626; color: white; padding: 8px 16px; border-radius: 6px; font-weight: 600;">
                    Supprimer
                </button>
            </form>

            <form method="POST" action="{{ route('posts.publication', $post) }}">
                @csrf
                @method('PATCH')

                <button type="submit"
                        style="background-color: #0f766e; color: white; padding: 8px 16px; border-radius: 6px;">
                    {{ $post->is_published ? 'Dépublier' : 'Publier' }}
                </button>
            </form>
        </div>
    </article>

    @if (isset($relatedPosts) && $relatedPosts->isNotEmpty())
        <section class="mt-12 max-w-2xl">
            <h2 class="mb-4 text-2xl font-bold">Articles similaires</h2>

            <div class="space-y-4">
                @foreach ($relatedPosts as $relatedPost)
                    <div class="rounded-lg border border-gray-200 p-4">
                        <a href="{{ route('posts.show', $relatedPost) }}"
                           class="font-semibold text-indigo-600 hover:underline">
                            {{ $relatedPost->title }}
                        </a>

                        @if ($relatedPost->excerpt)
                            <p class="mt-2 text-gray-600">
                                {{ $relatedPost->excerpt }}
                            </p>
                        @endif
                    </div>
                @endforeach
            </div>
        </section>
    @endif
</x-layout>
