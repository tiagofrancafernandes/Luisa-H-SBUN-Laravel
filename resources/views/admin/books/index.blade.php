<x-app-layout>
<x-slot name="header">
<h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
{{ __('Return Requests') }}
</h2>
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
                            #
                        </th>
                        <th scope="col" class="px-6 py-3">
                            @lang('Title')
                        </th>
                        <th scope="col" class="px-6 py-3">
                            @lang('Quantity')
                        </th>
                        <th scope="col" class="px-6 py-3">
                            @lang('Reference')
                        </th>
                        <th scope="col" class="px-6 py-3">
                            @lang('Author')
                        </th>
                        <th scope="col" class="px-6 py-3">
                            @lang('Category')
                        </th>
                        <th scope="col" class="px-6 py-3">
                            @lang('Available Quantity')
                        </th>
                        <th scope="col" class="px-6 py-3">
                            @lang('Available')
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
                                {{ $item->title }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $item->quantity }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $item->reference }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $item->author_id }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $item->category_id }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $item->availableQuantity }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div
                                        @class([
                                            'h-2.5 w-2.5 rounded-full me-2',
                                            'bg-green-500' => $item->available,
                                            'bg-red-500' => !$item->available,
                                        ])></div>
                                    {{ $item->available ? __('Yes') : __('No') }}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="inline-flex rounded-md shadow-sm" role="group">
                                    <x-blocks.button-link
                                        color="sky"
                                        icon="fas-edit"
                                        class="px-2 py-1 uppercase"
                                        href="{{
                                            route('admin.books.edit', [
                                                'book' => $item?->id,
                                            ])
                                        }}"
                                    >@lang('Edit')</x-blocks.button-link>

                                    <x-blocks.button-link
                                        color="red"
                                        icon="fas-trash"
                                        class="px-2 py-1 uppercase"
                                        href="{{
                                            route('admin.books.destroy', [
                                                'book' => $item?->id,
                                            ])
                                        }}"
                                    >
                                        @lang('Delete')
                                    </x-blocks.button-link>

                                    <x-blocks.button-link
                                        color="gray"
                                        icon="fas-eye"
                                        class="px-2 py-1 uppercase"
                                        href="{{
                                            route('admin.books.show', [
                                                'book' => $item?->id,
                                            ])
                                        }}"
                                    >@lang('Show')</x-blocks.button-link>
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
