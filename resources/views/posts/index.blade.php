<x-layout>
    <x-slot:title>{{ $heading }} - Mini-CMS</x-slot:title>
    
<a href="{{ route('posts.create') }}"
   class="inline-block rounded bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-700">
    + Nouvel article
</a>


    <x-page-header :title="$heading" />

    <div class="grid gap-6 md:grid-cols-2">
        @forelse ($posts as $post)
            <x-post-card :post="$post" />
        @empty
            <x-alert type="warning" title="Aucun article" class="md:col-span-2">
                Il n'y a pas encore d'article.
            </x-alert>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $posts->links() }}
    </div>
</x-layout>
