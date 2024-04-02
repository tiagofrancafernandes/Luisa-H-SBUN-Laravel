<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 gap-4 md:grid-cols-2 md:gap-6 xl:grid-cols-4 2xl:gap-7.5">
            <div
                class="w-full max-w-md p-4 bg-white border-gray-200 shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700
                rounded-sm border border-stroke px-7.5 py-6 shadow-default dark:border-strokedark dark:bg-boxdark">
                <div class="flex items-center justify-between">
                    <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">@lang('Borrow Requests')</h5>
                    <a href="#" class="text-sm font-medium text-blue-600 hover:underline dark:text-blue-500">
                        View all
                    </a>
                </div>
            </div>
            <div
                class="w-full max-w-md p-4 bg-white border-gray-200 shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700
                rounded-sm border border-stroke px-7.5 py-6 shadow-default dark:border-strokedark dark:bg-boxdark">
                <div class="flex items-center justify-between">
                    <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">@lang('Return Requests')</h5>
                    <a href="#" class="text-sm font-medium text-blue-600 hover:underline dark:text-blue-500">
                        View all
                    </a>
                </div>
            </div>
            <div
                class="w-full max-w-md p-4 bg-white border-gray-200 shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700
                rounded-sm border border-stroke px-7.5 py-6 shadow-default dark:border-strokedark dark:bg-boxdark">
                <div class="flex items-center justify-between">
                    <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">@lang('Adicionar Livro')</h5>
                    <a href="#" class="text-sm font-medium text-blue-600 hover:underline dark:text-blue-500">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                    </a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
