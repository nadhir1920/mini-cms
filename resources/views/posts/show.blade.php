```blade
<x-layout>
    <x-slot:title>{{ $post['title'] }} - Mini-CMS</x-slot:title>

    <h1 class="text-3xl font-bold">{{ $post['title'] }}</h1>

    <p class="mt-2 text-sm text-gray-500">
        Année : {{ $post['year'] }}
    </p>

    <p class="mt-4 text-gray-700">{{ $post['content'] }}</p>

    <p class="mt-6">
        <a href="{{ route('posts.index') }}" class="text-red-600 underline">
            Retour aux articles
        </a>
    </p>
</x-layout>
```