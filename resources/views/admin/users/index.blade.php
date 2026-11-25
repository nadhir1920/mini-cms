<x-layout>
    <x-slot:title>Utilisateurs - Mini-CMS</x-slot:title>

    <div class="mb-6 flex items-center justify-between">
        <h1 class="text-3xl font-bold text-gray-900">Utilisateurs</h1>
    </div>

    <div class="overflow-x-auto rounded-lg border border-gray-200 bg-white">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-50 text-left font-medium text-gray-700">
                <tr>
                    <th class="px-4 py-3">Nom</th>
                    <th class="px-4 py-3">E-mail</th>
                    <th class="px-4 py-3">Rôle</th>
                    <th class="px-4 py-3">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ($users as $user)
                    <tr>
                        <td class="px-4 py-3 font-medium text-gray-900">{{ $user->name }}</td>
                        <td class="px-4 py-3 text-gray-600">{{ $user->email }}</td>
                        <td class="px-4 py-3 text-gray-600">{{ $user->role }}</td>
                        <td class="px-4 py-3">
                            @if (auth()->id() === $user->id)
                                <span class="text-xs text-gray-400">Vous-même</span>
                            @else
                                @php($nextRole = $user->isAdmin() ? 'author' : 'admin')
                                <form method="POST" action="{{ route('admin.users.role', $user) }}">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="role" value="{{ $nextRole }}">
                                    <button type="submit" class="text-indigo-600 hover:underline">
                                        {{ $user->isAdmin() ? 'Passer en auteur' : 'Promouvoir admin' }}
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layout>
