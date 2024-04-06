<x-app-layout>
<x-slot name="header">
<h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
    <x-blocks.button-link
        color="sky"
        icon="fas-arrow-left"
        class="px-2 py-1 uppercase"
        href="{{
            route('admin.books.index')
        }}"
    />
    @lang('Book')
</h2>
</x-slot>
<div class="py-12">
    <div class="w-full bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <div class="flex flex-col bg-white border border-gray-200 rounded-lg shadow md:flex-row dark:border-gray-700 dark:bg-gray-800">
            <img
                class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-s-lg"
                src="https://flowbite.com/docs/images/blog/image-4.jpg"
                alt=""
            >
            <div class="w-full flex flex-col justify-start p-4 leading-normal">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $record?->title }}</h5>
                <div class="mb-3">
                    <x-blocks.button-link
                        color="sky"
                        icon="fas-edit"
                        class="px-2 py-1 uppercase"
                        href="{{
                            route('admin.books.edit', [
                                'book' => $record?->id,
                            ])
                        }}"
                    >@lang('Edit')</x-blocks.button-link>

                    <x-blocks.button-link
                        color="red"
                        icon="fas-trash"
                        class="px-2 py-1 uppercase"
                        href="{{
                            route('admin.books.destroy', [
                                'book' => $record?->id,
                            ])
                        }}"
                        onclick="return confirm('{{ __('Do you really want to delete this item?') }}')"
                    >
                        @lang('Delete')
                    </x-blocks.button-link>
                </div>
                <div class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                    <div class="w-full">
                        <p><strong>@lang('Quantity')</strong>: {{ $record?->quantity }}</p>
                        <p><strong>@lang('Reference')</strong>: {{ $record?->reference }}</p>
                        <p><strong>@lang('Author')</strong>: {{ $record?->author?->name }}</p>
                        <p><strong>@lang('Category')</strong>: {{ $record?->category?->name }}</p>
                    </div>
                    <div><strong>@lang('Sinopsis')</strong>:</div>
                    <div class="w-full border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 p-4">{!! $record?->sinopsis !!}</div>
                </div>
            </div>
        </div>
    </div>
</div>
</x-app-layout>
