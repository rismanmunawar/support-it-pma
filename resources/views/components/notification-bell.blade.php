@props(['count' => 0])

<a href="{{ route('pengumuman.index') }}"
    class="relative p-2 rounded hover:bg-gray-200 dark:hover:bg-gray-700 focus:outline-none focus:ring focus:ring-gray-500"
    aria-label="Notifications">
    <svg class="h-6 w-6 text-gray-700 dark:text-gray-200" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round"
            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
    </svg>

    @if($count > 0)
    <span
        class="absolute top-0 right-0 inline-flex items-center justify-center px-1.5 py-0.5 text-xs font-bold leading-none text-white bg-red-600 rounded-full">
        {{ $count }}
    </span>
    @endif
</a>