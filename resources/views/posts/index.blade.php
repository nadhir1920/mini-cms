<x-layout>
    <x-slot:title>Articles - Mini-CMS</x-slot:title>

    <h1 class="text-3xl font-bold">Nos articles</h1>

    <div class="mt-6 space-y-4">
        @foreach ($posts as $post)
            <article class="rounded-lg border border-gray-200 bg-white p-4">
                <h2 class="text-xl font-semibold">
                    {{ $post['title'] }}
                </h2>

                <p class="mt-2 text-sm text-gray-500">
                    Année : {{ $post['year'] }}
                </p>
            </article>
        @endforeach
    </div>
</x-layout>