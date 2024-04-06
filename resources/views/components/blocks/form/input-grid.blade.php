@props([
    'name' => null,
    'id' => null,
    'label' => null,
    // 'value' => null,
    'colSpan' => null,
    'type' => 'text',
    'containerClass' => null,
    'placeholder' => null,
    'required' => false,
    'hideLabel' => false,
])

@php
\Validator::make([
    'name' => $name ?? null,
    'id' => $id ?? null,
    'label' => $label ?? null,
    'colSpan' => $colSpan ?? null,
    'type' => $type ?? 'text',
    'containerClass' => $containerClass ?? null,
    'placeholder' => $placeholder ?? null,
    'required' => $required ?? null,
], [
    'name' => 'required|string|min:1',
    'id' => 'nullable|string|min:1',
    'label' => 'nullable|string|min:1',
    'placeholder' => 'nullable|string|min:1',
    'required' => 'nullable|boolean',
    'colSpan' => 'nullable|in:' . implode(',', range(1, 12)),
])->validate();

$id ??= 'input_id_' . uniqid() . '_' . $name;

$label ??= __(str($name)?->title()?->toString());
$placeholder ??= $label;
$colSpan = ($colSpan ?? null) ? 'col-span-' . intval($colSpan) : null;

$containerClass ??= null;
$containerClass = is_string($containerClass) || is_array($containerClass)
    ? collect($containerClass)
        ?->merge([$colSpan])
        ?->filter()
        // ?->filter(fn($item) => filled($item) && is_string($item))
    : collect([$colSpan]);
@endphp

<div
    @class($containerClass?->toArray())>

    @unless ($hideLabel ?? null)
    <label
        for="{{ $id }}"
        @class([
            'block mb-2 text-sm font-medium text-gray-900 dark:text-white',
        ])
    >{{ $label }}</label>
    @endunless()
    <input
        type="{{ $type ?? 'text' }}"
        id="{{ $id }}"
        name="{{ $name }}"
        {{ $attributes->merge(['class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500']) }}
        placeholder="{{ $placeholder }}"
        {{ $required ? 'required' : '' }}
    />

    @error($name)
        <div class="alert alert-danger text-red-500">{{ $message }}</div>
    @enderror
</div>
