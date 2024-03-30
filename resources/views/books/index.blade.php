<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Books') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-3">
            {{ $books->links('pagination::tailwind') }}
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @foreach($books as $book)
            <a href="#"
                class="w-full mb-6 flex flex-col bg-white border border-gray-200 rounded-lg shadow md:flex-row hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700 ">
                <img class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-s-lg"
                    src="https://flowbite.com/docs/images/blog/image-4.jpg" alt="">
                <div class="flex flex-col p-4 justify-between w-full">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                        {{ $book->title }}
                    </h5>
                    <div class="mb-3">
                        <p>
                            <span
                                class="text-sm font-medium text-gray-900 truncate dark:text-white">{{ __('Author') }}:</span>
                            <span
                                class="text-sm text-gray-500 truncate dark:text-gray-400">{{ $book->author?->name }}</span>
                        </p>
                        <p>
                            <span
                                class="text-sm font-medium text-gray-900 truncate dark:text-white">{{ __('Category') }}:</span>
                            <span
                                class="text-sm text-gray-500 truncate dark:text-gray-400">{{ $book->category?->name }}</span>
                        </p>
                        <p>
                            <span
                                class="text-sm font-medium text-gray-900 truncate dark:text-white">{{ __('Reference') }}:</span>
                            <span
                                class="text-sm text-gray-500 truncate dark:text-gray-400">{{ $book->reference }}</span>
                        </p>
                    </div>
                    <div class="w-full">
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $book->sinopsis }}</p>
                    </div>
                    <div class="flex justify-end">
                        @if ($myBorrowedBooks?->contains($book->id))
                            <span class="text-md text-gray-500 truncate dark:text-orange-400">
                                @lang('Book already borrowed.')
                            </span>
                        @else
                            @php
                                $available = $book->available;
                            @endphp
                            <button
                                type="button"
                                @if (!$available)
                                    disabled
                                @endif
                                @class([
                                    'focus:outline-none text-white  focus:ring-4  font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2',
                                    'bg-green-700  hover:bg-green-800 focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800' => $available,
                                    'bg-gray-700  hover:bg-gray-800 focus:ring-gray-300 dark:bg-gray-500 dark:hover:bg-gray-600 dark:focus:ring-gray-800' => !$available,
                                ])>@lang($available ? 'Borrow' : 'Unavailable')</button>
                        @endif
                    </div>
                </div>
            </a>
            @endforeach
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{ $books->links('pagination::tailwind') }}
        </div>
    </div>
</x-app-layout>