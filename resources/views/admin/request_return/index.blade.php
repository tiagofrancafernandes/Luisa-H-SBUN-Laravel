<x-app-layout>
<x-slot name="header">
    <div class="w-full grid grid-cols-12 gap-9">
        <div class="col-span-6">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Return Requests') }}
            </h2>
        </div>

        <div class="col-span-4">
            {{-- <form class="grid gap-6 mb-6 md:grid-cols-6">
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
            </form> --}}
        </div>

        <div class="col-span-2">
            {{--  --}}
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
                                    href="#!book={{ $item?->borrow?->book?->id }}"
                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline"
                                >
                                    {{ $item?->borrow?->book?->title }}
                                </a>
                            </td>
                            <td class="px-6 py-4">
                                <a
                                    href="#!user={{ $item?->borrow?->user?->id }}"
                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline"
                                >
                                    {{ $item?->borrow?->user?->name }}
                                </a>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div
                                        @class([
                                            'h-2.5 w-2.5 rounded-full me-2',
                                            'bg-yellow-500' => $item?->status === \App\Enums\RequestReturnStatus::PENDING,
                                            'bg-green-500' => $item?->status === \App\Enums\RequestReturnStatus::APPROVED,
                                            'bg-red-500' => $item?->status === \App\Enums\RequestReturnStatus::REJECTED,
                                        ])></div>
                                    {{ $item?->status?->name }}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <x-blocks.button-link
                                    color="green"
                                    icon="fas-check"
                                    class="px-2 py-1 uppercase"
                                    href="{{
                                        route('admin.request_return.update', [
                                            'requestBorrow' => $item?->id,
                                            'status' => \App\Enums\RequestReturnStatus::APPROVED,
                                        ])
                                    }}"
                                >@lang('Confirm')</x-blocks.button-link>

                                <x-blocks.button-link
                                    color="red"
                                    icon="fas-x"
                                    class="px-2 py-1 uppercase"
                                    href="{{
                                        route('admin.request_return.update', [
                                            'requestBorrow' => $item?->id,
                                            'status' => \App\Enums\RequestReturnStatus::REJECTED,
                                        ])
                                    }}"
                                >@lang('Reject')</x-blocks.button-link>
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
