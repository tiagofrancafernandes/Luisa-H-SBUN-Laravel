@props([
    'name' => null,
    'id' => null,
    'label' => null,
    'options' => null,
    'default' => null,
    'selected' => null,
    'colSpan' => null,
    'containerClass' => null,
    'required' => false,
    'useChoices' => false,
    'emptyOptionLabel' => null,
])

@php

\Validator::make([
    'name' => $name ?? null,
    'id' => $id ?? null,
    'options' => $options ?? null,
    'label' => $label ?? null,
    'colSpan' => $colSpan ?? null,
    'required' => $required ?? null,
    'useChoices' => $required ?? null,
    'emptyOptionLabel' => $emptyOptionLabel ?? null,
], [
    'name' => 'required|string|min:1',
    'options' => 'required|array',
    'id' => 'nullable|string|min:1',
    'label' => 'nullable|string|min:1',
    'colSpan' => 'nullable|in:' . implode(',', range(1, 12)),
    'required' => 'nullable|boolean',
    'useChoices' => 'nullable|boolean',
    'emptyOptionLabel' => 'nullable|string|min:1',
])->validate();

$id ??= 'input_id_' . uniqid() . '_' . $name;
$label ??= __(str($name)?->title()?->toString());
$colSpan = ($colSpan ?? null) ? 'col-span-' . intval($colSpan) : null;

$containerClass ??= null;
$containerClass = is_string($containerClass) || is_array($containerClass)
    ? collect($containerClass)
        ?->merge([$colSpan])
        ?->filter()
        // ?->filter(fn($item) => filled($item) && is_string($item))
    : collect([$colSpan]);

$emptyOptionLabel ??= $label ?? null;
$selected ??= $default ?? null;
@endphp

<div
    @class($containerClass?->toArray())
>
    <label
        for="{{ $id }}"
        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
    >{{ $label }}</label>

    <select
        id="{{ $id }}"
        name="{{ $name }}"
        {{ $attributes->merge([
            'class' => implode(' ', ['bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block',
                'w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500',
                'dark:focus:border-blue-500',
                ($useChoices ?? null) ? 'choices-select' : '',
            ])
        ]) }}
        {{ $required ? 'required' : '' }}
    >
        @if ($emptyOptionLabel ?? null)
            <option selected>{{ $emptyOptionLabel }}</option>
        @endif

        @foreach ($options as $key => $value)
        <option
            value="{{ $key }}"
            {{ ($selected == $key) ? 'selected' : '' }}
        >{{ ($selected == $key) ? '* ' : '' }} {{ $value }}</option>
        @endforeach
    </select>
</div>
