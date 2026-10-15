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

        <div class="text-gray-800 leading-relaxed whitespace-pre-line">{{ $post->body }}</div>
       
<div class="mt-8 space-y-3">
    <a href="{{ route('posts.edit', $post) }}"
       class="block w-fit rounded-md bg-indigo-600 px-4 py-2 text-white">
        Modifier
    </a>

    <form method="POST" action="{{ route('posts.destroy', $post) }}">
        @csrf
        @method('DELETE')

       <form method="POST" action="{{ route('posts.destroy', $post) }}">
    @csrf
    @method('DELETE')

    <button type="submit"
        style="background-color: #dc2626; color: #ffffff; padding: 8px 16px; border-radius: 6px; font-weight: 600;">
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
    </form>
</div>

    </article>
</x-layout>
