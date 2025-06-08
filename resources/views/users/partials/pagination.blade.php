@if ($users->hasPages())
<nav>
    <ul class="pagination flex items-center space-x-2">
        {{-- Previous Page Link --}}
        @if ($users->onFirstPage())
        <li class="disabled px-3 py-1 border rounded text-gray-400 cursor-not-allowed select-none leading-none">«</li>
        @else
        <li>
            <a href="{{ $users->previousPageUrl() }}" class="px-3 py-1 border rounded hover:bg-gray-200 inline-block leading-none">«</a>
        </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($users->getUrlRange(1, $users->lastPage()) as $page => $url)
        @if ($page == $users->currentPage())
        <li class="px-3 py-1 border rounded bg-blue-500 text-white cursor-default select-none leading-none">{{ $page }}</li>
        @else
        <li>
            <a href="{{ $url }}" class="px-3 py-1 border rounded hover:bg-gray-200 inline-block leading-none">{{ $page }}</a>
        </li>
        @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($users->hasMorePages())
        <li>
            <a href="{{ $users->nextPageUrl() }}" class="px-3 py-1 border rounded hover:bg-gray-200 inline-block leading-none">»</a>
        </li>
        @else
        <li class="disabled px-3 py-1 border rounded text-gray-400 cursor-not-allowed select-none leading-none">»</li>
        @endif
        s
    </ul>
</nav>
@endif