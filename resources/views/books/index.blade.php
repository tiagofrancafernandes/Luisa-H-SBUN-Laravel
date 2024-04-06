@php
$reasonBeacauseCannot = function($book) use(
    $myRequestBorrowedBooks,
    $myBorrowedBooks,
) {
    if (!$book) {
        return null;
    }

    if ($myBorrowedBooks?->contains($book->id)) {
        return __('Book already borrowed.');
    }

    if ($myRequestBorrowedBooks?->contains($book->id)) {
        return __('Book requested.');
    }

    return null;
};
@endphp
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
            <div
                class="w-full mb-6 flex flex-col bg-white border border-gray-200 rounded-lg shadow md:flex-row dark:border-gray-700 dark:bg-gray-800">
                <img class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-s-lg"
                    src="https://flowbite.com/docs/images/blog/image-4.jpg" alt="">
                <div class="flex flex-col p-4 justify-between w-full">
                    <div class="flex justify-between">
                        <div class="flex">
                            <a href="#!{{ $book->id }}">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                    {{ $book->title }} | #{{ $book->id }}
                                </h5>
                            </a>
                        </div>

                        <div>
                            @if ($reason = $reasonBeacauseCannot($book))
                                <span class="text-md text-gray-500 truncate dark:text-orange-400">
                                    {{ $reason }}
                                </span>
                            @else
                                @if ($book->available)
                                    <a
                                        href="{{ route('request_borrow.store', ['book_id' => $book->id]) }}"
                                        @class([
                                            'focus:outline-none text-white ring-0  font-medium rounded-lg text-sm px-5 py-2.5',
                                            'bg-green-700  hover:bg-green-800 ring-0 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800',
                                        ])
                                    >
                                        @lang('Borrow')
                                    </a>
                                @else
                                    <span
                                        @class([
                                            'focus:outline-none text-white ring-0 font-medium rounded-lg text-sm px-5 py-2.5',
                                            'bg-gray-700 dark:bg-gray-500 ring-0',
                                        ])
                                    >
                                        @lang('Unavailable')
                                    </span>
                                @endif
                            @endif
                        </div>
                    </div>
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
                        <div>
                            <span
                                class="text-sm font-medium text-gray-900 truncate dark:text-white">{{ __('Sinopsis') }}:</span></div>
                        <div
                            @class([
                                'w-full border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 px-4 py-2',
                                'mb-3 font-normal text-gray-700 dark:text-gray-400 overflow-y-auto h-32',
                            ])
                        >{!! $book->sinopsis !!}</div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{ $books->links('pagination::tailwind') }}
        </div>
    </div>
</x-app-layout>
