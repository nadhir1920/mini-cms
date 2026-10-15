<x-layout>
    <x-slot:title>Archive {{ $year }} - Mini-CMS</x-slot:title>

    <h1 class="text-3xl font-bold">Articles de {{ $year }}</h1>

    @if ($posts->isEmpty())
        <p class="mt-4 text-gray-700">Aucun article pour cette année.</p>
    @else
        <div class="mt-6 space-y-4">
            @foreach ($posts as $post)
                <article class="rounded-lg border border-gray-200 bg-white p-4">
                    <h2 class="text-xl font-semibold">
                        <a href="{{ route('posts.show', $post['slug']) }}">
                            {{ $post['title'] }}
                        </a>
                    </h2>
                </article>
            @endforeach
        </div>
    @endif
</x-layout>