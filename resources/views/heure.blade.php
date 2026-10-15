<x-layout>
    <x-slot:title>Heure du serveur - Mini-CMS</x-slot:title>

    <h1 class="text-3xl font-bold">Heure du serveur</h1>

    <p class="mt-4 text-gray-700">
        Date : {{ $date }}
    </p>

    <p class="mt-2 text-gray-700">
        Heure : {{ $heure }}
    </p>
</x-layout>