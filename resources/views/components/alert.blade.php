@props([
    'type' => 'info',
    'title' => null,
])

@php
    $styles = [
        'success' => 'border-green-200 bg-green-50 text-green-800',
        'warning' => 'border-amber-200 bg-amber-50 text-amber-800',
        'info' => 'border-blue-200 bg-blue-50 text-blue-800',
        'error' => 'border-red-200 bg-red-50 text-red-800',
    ];

    $style = $styles[$type] ?? $styles['info'];
@endphp

<div {{ $attributes->class(['rounded-lg border p-4', $style]) }} role="status">
    @if ($title)
        <h2 class="font-semibold mb-1">{{ $title }}</h2>
    @endif

    <div>{{ $slot }}</div>
</div>
