<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div
                class="w-full max-w-md p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                <div class="flex items-center justify-between mb-4">
                    <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">@lang('My latest books')</h5>
                    <a href="#" class="text-sm font-medium text-blue-600 hover:underline dark:text-blue-500">
                        View all
                    </a>
                </div>
                <div class="flow-root">
                    <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700 h-96">
                        @foreach($myBorrowedBooks as $myBorrowedBook)
                        <li class="py-3 sm:py-4">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <img class="w-8 h-8 rounded-full" src="https://www.marytribble.com/wp-content/uploads/2020/12/book-cover-placeholder.png"
                                        alt="Neil image">
                                </div>
                                <div class="flex-1 min-w-0 ms-4">
                                    <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                        {{ $myBorrowedBook->book?->title }}
                                    </p>
                                    <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                        {{ $myBorrowedBook->book?->author?->name }}
                                    </p>
                                </div>
                                <div
                                    class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                    @if (!$myBorrowedBook->returned_at)
                                        <x-blocks.button-link
                                            color="orange"
                                            icon="tabler-arrow-back"
                                            class="px-2 py-1 uppercase relative"
                                        >
                                            <span class="absolute inline-flex items-center justify-center w-10 h-6 px-5 text-xs font-bold text-white bg-red-500 border-2 border-white rounded-full -top-4 -end-2 dark:border-gray-900">Late</span>
                                            @lang('Return')
                                    </x-blocks.button-link>
                                    @endif
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
