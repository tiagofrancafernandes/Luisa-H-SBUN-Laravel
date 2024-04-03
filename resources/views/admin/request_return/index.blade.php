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
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            #
                        </th>
                        <th scope="col" class="px-6 py-3">
                            @lang('Request date')
                        </th>
                        <th scope="col" class="px-6 py-3">
                            @lang('Book title')
                        </th>
                        <th scope="col" class="px-6 py-3">
                            @lang('User')
                        </th>
                        <th scope="col" class="px-6 py-3">
                            @lang('Status')
                        </th>
                        <th scope="col" class="px-6 py-3">
                            @lang('Return')?
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
                                {{ $item->created_at?->diffForHumans() }}
                            </td>
                            <td class="px-6 py-4">
                                <a
                                    href="#!book={{ $item?->book?->id }}"
                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline"
                                >
                                    {{ $item?->book?->title }}
                                </a>
                            </td>
                            <td class="px-6 py-4">
                                <a
                                    href="#!user={{ $item?->user?->id }}"
                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline"
                                >
                                    {{ $item?->user?->name }}
                                </a>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div
                                        @class([
                                            'h-2.5 w-2.5 rounded-full me-2',
                                            'bg-yellow-500' => $item?->status === \App\Enums\RequestBorrowStatus::PENDING,
                                            'bg-green-500' => $item?->status === \App\Enums\RequestBorrowStatus::APPROVED,
                                            'bg-red-500' => $item?->status === \App\Enums\RequestBorrowStatus::REJECTED,
                                        ])></div>
                                    {{ $item?->status?->name }}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                [XYZ]
                                <x-blocks.button-link
                                    color="green"
                                    icon="fas-check"
                                    class="px-2 py-1"
                                >@lang('Approve')</x-blocks.button-link>

                                <x-blocks.button-link
                                    color="red"
                                    icon="fas-x"
                                    class="px-2 py-1"
                                >@lang('Reject')</x-blocks.button-link>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    {{ $records->links('pagination::tailwind') }}
    </div>
</div>
</x-app-layout>
