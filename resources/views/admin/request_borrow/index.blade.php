<x-app-layout>
<x-slot name="header">
<h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
{{ __('Books') }}
</h2>
</x-slot>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-3">
    {{ $records->links('pagination::tailwind') }}
    </div>

    <div
        class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-3"
        x-data="{
            showFilterForm: false,
            get showOrHideFilterFormLabel() {
                return this.showFilterForm ? 'Hide form filter' : 'Show form filter'
            },
        }"
    >
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <caption class="p-5 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                    <div class="w-full">
                        <button
                            type="button"
                            x-on:click="showFilterForm = !showFilterForm"
                            x-text="showOrHideFilterFormLabel"
                        ></button>
                    </div>
                    <form
                        class="grid grid-cols-5 gap-9"
                        x-bind:class="{
                            hidden: !showFilterForm,
                        }"
                    >
                        <div class="col-span-2">
                            <label class="mb-3 block text-sm font-medium text-black dark:text-white">Select a status</label>

                            <select name="" id="" class="w-full rounded-lg text-gray-500 dark:text-gray-400 dark:bg-form-input" required>
                                <option value="">Select a status</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                        </div>

                        <div class="col-span-2">
                            <label class="mb-3 block text-sm font-medium text-black dark:text-white">Search</label>
                            <input
                                type="text" placeholder="Search"
                                class="w-full rounded-lg border-[1.5px] text-black border-stroke bg-transparent py-3 px-5 font-normal outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:text-white dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">
                        </div>
                        <div class="pt-8">
                            <button type="submit" class="xl:hidden inline-flex items-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ml-1 sm:ml-3">Filter</button>
                        </div>
                    </form>
                </caption>
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
                            @lang('Actions')
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($records as $item)
                        <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
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
