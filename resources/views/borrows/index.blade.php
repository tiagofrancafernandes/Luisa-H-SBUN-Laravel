<x-app-layout>
<x-slot name="header">
    <div class="w-full grid grid-cols-12 gap-9">
        <div class="col-span-6">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My Borrows') }}
            </h2>
        </div>

        <div class="col-span-4">
            <form class="grid gap-6 mb-6 md:grid-cols-6">
                <div class="text-gray-800 dark:text-gray-200 leading-tight pt-1">Search</div>
                <x-blocks.form.input-grid
                    type="search"
                    name="search"
                    placeholder="{{ __('Search') }}"
                    containerClass="col-span-4"
                    class="py-1"
                    :value="request()->input('search')"
                    hideLabel
                />
            </form>
        </div>

        <div class="col-span-2">
            <x-blocks.button-link
                color="green"
                icon="fas-plus"
                class="px-2 py-1 uppercase"
                href="{{
                    route('admin.books.create')
                }}"
            >@lang('Create')</x-blocks.button-link>
        </div>
    </div>
</x-slot>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-3">
    {{ $records->links('pagination::tailwind') }}
    </div>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-3">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            @if ($records?->count())
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            <a href="?orderBy=id&dir=desc">#</a>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <a href="?orderBy=book_id&dir=desc">@lang('Book')</a>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <a href="?orderBy=id&dir=desc">@lang('Author')</a>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <a href="?orderBy=id&dir=desc">@lang('Category')</a>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <a href="?orderBy=id&dir=desc">@lang('Is late')</a>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <a href="?orderBy=borrowed_at&dir=desc">@lang('Borrowed at')</a>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <a href="?orderBy=returned_at&dir=desc">@lang('Returned at')</a>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <a href="?orderBy=return_by&dir=desc">@lang('Return by')</a>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            @lang('Actions')?
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($records as $item)
                        <tr class="odd:bg-white odd:dark:bg-gray-800 even:bg-gray-50 even:dark:bg-gray-700 border-b dark:border-gray-700">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $item->id }}
                            </th>
                            <td class="px-6 py-4">
                                <a
                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline"
                                    href="#book={{ $item->book_id }}">{{ $item->book?->title }}</a>
                            </td>
                            <td class="px-6 py-4">
                                <a
                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline"
                                    href="#author={{ $item->book?->author_id }}">{{ $item->book?->author?->name }}</a>
                            </td>
                            <td class="px-6 py-4">
                                <a
                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline"
                                    href="#category={{ $item->book?->category_id }}">{{ $item->book?->category?->name }}</a>
                            </td>
                            <td class="px-6 py-4">
                                <div class="inline-flex rounded-md shadow-sm" role="group">
                                    <a
                                        href="#book={{ $item?->book_id }}"

                                        @class([
                                            'rounded-full me-2 inline-flex items-center me-2 border border-transparent rounded-md font-semibold text-xs text-white tracking-widest   focus:outline-none ring-0 transition ease-in-out duration-150 px-2 py-1 uppercase',
                                            // 'bg-green-500' => !$item->isLate,
                                            // 'bg-red-500' => $item->isLate,
                                        ])
                                    >
                                        {{ $item->isLate ? __('Late') : 'Up' }}
                                        @svg('fas-circle', 'w-3.5 h-3.5 ml-1 ' . ($item->isLate ? 'text-red-500' : 'text-green-500'))
                                    </a>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                {{ $item->borrowed_at }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $item->returned_at }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $item->return_by }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="inline-flex rounded-md shadow-sm" role="group">
                                    <div
                                    class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                    @if (!$item->returned_at)
                                        @if ($item->request_returns_count)
                                            <span
                                                class="uppercase inline-flex items-center justify-center w-20 h-6 px-5 py-3 text-xs font-bold text-white bg-gray-500 border-2 border-white rounded-full dark:border-gray-900 relative"
                                            >
                                                <span
                                                    class="absolute inline-flex items-center justify-center w-10 h-6 px-5 text-xs font-bold text-white bg-red-500 border-2 border-white rounded-full -top-4 -end-2 dark:border-gray-900"
                                                >@lang('Late')</span>
                                                @lang('Pending')
                                            </span>
                                        @else
                                        <x-blocks.button-link
                                            color="orange"
                                            icon="tabler-arrow-back"
                                            class="px-2 py-1 uppercase relative"
                                            href="{{
                                                route('request_return.store', [
                                                    'borrow_id' => $item->id,
                                                ])
                                            }}"
                                        >
                                            @if ($late ?? true)
                                                <span
                                                    class="absolute inline-flex items-center justify-center w-10 h-6 px-5 text-xs font-bold text-white bg-red-500 border-2 border-white rounded-full -top-4 -end-2 dark:border-gray-900"
                                                >@lang('Late')</span>
                                            @endif
                                            @lang('Return')
                                        </x-blocks.button-link>
                                        @endif
                                    @endif
                                </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <div class="text-xs text-center text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 py-3">
                @lang('No records')
            </div>
            @endif
        </div>
    </div>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    {{ $records->links('pagination::tailwind') }}
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', (event) => {
    /*
    document.querySelectorAll('[href$="update\?status=2"]')
        .forEach(link => {
            link.addEventListener('click', event => {
                event.preventDefault();

                if (!event.target?.href) {
                    return;
                }

                fetch(event.target.href)
                    .then(res => {

                        if (res.ok) {
                            event.target?.closest('tr')?.remove();
                            window?.Toaster?.success(`Item removed successfully`, null, null, 6000);
                        }

                        return res;
                    })
                    .catch(error => {
                    window?.Toaster?.error(`Error on remove item`, null, null, 6000);
                })
            })
        });
    */
});
</script>
</x-app-layout>
