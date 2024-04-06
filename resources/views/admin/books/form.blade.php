@php
$record ??= null;
$editMode = boolval($record?->id);
$action = $record?->id ? route('admin.books.update', $record) : route('admin.books.store');
$method = $record?->id ? 'put' : 'post';
@endphp

<x-app-layout>
<x-slot name="header">
<h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
{{ $record?->id ? __('Edit') : __('Create') }}
</h2>
</x-slot>
<div class="py-12">
    <form method="POST" action="{{ $action }}">
        <div class="grid grid-cols-1 gap-9 sm:grid-cols-3 px-3">
            <div class="flex flex-col gap-9 col-span-2 bg-gray-300 dark:bg-gray-800 p-4 rounded-lg">
                @csrf
                @method($method)

                @if ($record?->id ?? null)
                    <input type="hidden" name="id" value="{{ $record?->id }}">
                @endif

                <div class="grid gap-6 mb-6 md:grid-cols-6">
                    <x-blocks.form.input-grid
                        name="title"
                        colSpan="2"
                        {{-- containerClass="col-span-6" --}}
                        :value="old('name') ?? $record?->title ?? null"
                        required
                    />

                    <x-blocks.form.input-grid
                        name="quantity"
                        colSpan="2"
                        :value="old('quantity') ?? $record?->quantity ?? null"
                        {{-- type="number" --}}
                        data-on-input-pattern="[0-9]+"
                        required
                    />

                    <x-blocks.form.input-grid
                        name="reference"
                        colSpan="2"
                        :value="old('reference') ?? $record?->reference ?? null"
                        minlength="1"
                        min="1"
                        required
                    />

                    <div class="col-span-6 bg-white dark:bg-gray-700 rounded-sm p-0 px-2 py-2">
                        <style>
                            .trix-button-row .trix-button-group { background: #fff; }
                            @media (prefers-color-scheme: dark) {
                                .trix-content { background: #fff; }
                            }
                        </style>

                        <input
                            name="sinopsis"
                            id="sinopsis"
                            value="{{ old('reference') ?? $record?->sinopsis ?? null }}"
                            type="hidden"
                        >
                        <trix-editor
                            input="sinopsis"
                            class="trix-content"
                        />
                    </div>
                </div>
            </div>

            <div class="flex flex-col gap-9 bg-gray-300 dark:bg-gray-800 p-4 rounded-lg">
                <h5
                    for="first_name"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                >@lang('Relations')</h5>

                <div class="hidden">
                    <label class="inline-flex items-center mb-5 cursor-pointer">
                        <input type="checkbox" value="" class="sr-only peer">
                        <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                        <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Default toggle</span>
                    </label>
                </div>

                <x-blocks.form.select
                    emptyOptionLabel="{{ __('Select an author') }}"
                    label="{{ __('Author') }}"
                    name="author_id"
                    :value="old('name') ?? $record?->author_id ?? null"
                    :selected="$record?->author_id ?? null"
                    :options="$authors?->toArray()"
                    :useChoices="true"
                />

                <x-blocks.form.select
                    emptyOptionLabel="{{ __('Select a category') }}"
                    label="{{ __('Category') }}"
                    name="category_id"
                    :value="old('name') ?? $record?->category_id ?? null"
                    :selected="$record?->category_id ?? null"
                    :options="$categories?->toArray()"
                    :useChoices="true"
                />
            </div>

            <div class="col-span-3">
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">@lang('Submit')</button>
            </div>
        </div>
    </form>
</div>
</x-app-layout>
