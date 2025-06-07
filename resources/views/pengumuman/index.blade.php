<x-app-layout>
    <div class="w-full px-4 py-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 dark:text-white mb-2">📢 Portal Informasi & Pengumuman</h1>
                <p class="text-gray-600 dark:text-gray-400">Selalu terhubung dengan update terkini dari tim & sistem.</p>
            </div>
            <a href="{{ route('pengumuman.create') }}" class="px-4 py-2 rounded-md bg-blue-600 text-white hover:bg-blue-700">+ Tambah</a>
        </div>

        <form method="GET" class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
            <div class="flex flex-wrap gap-2">
                <button name="kategori" value="" class="px-4 py-2 rounded-full text-sm font-medium text-white bg-blue-600 hover:bg-blue-700">Semua</button>
                @foreach($kategoriList as $kategori)
                <button name="kategori" value="{{ $kategori }}" class="px-4 py-2 rounded-full text-sm font-medium text-gray-700 bg-gray-200 dark:bg-gray-700 dark:text-white hover:bg-gray-300 dark:hover:bg-gray-600">
                    {{ $kategori }}
                </button>
                @endforeach
            </div>
            <div class="relative w-full md:w-1/3">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari pengumuman..." class="w-full pl-10 pr-4 py-2 rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <svg class="absolute left-3 top-2.5 w-5 h-5 text-gray-500 dark:text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M16 10a6 6 0 11-12 0 6 6 0 0112 0z" />
                </svg>
            </div>
        </form>

        <div class="space-y-4">
            @foreach ($pengumuman as $item)
            <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-4 hover:shadow-md transition-shadow duration-300">
                <div class="flex items-start gap-3">
                    <div class="flex-shrink-0">
                        <div class="bg-blue-100 dark:bg-blue-900 p-2 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600 dark:text-blue-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 5.636a9 9 0 11-12.728 0m1.414 1.414a7 7 0 109.9 0M15 12h.01M9 12h.01M12 15h.01" />
                            </svg>
                        </div>
                    </div>
                    <div class="flex-1">
                        <h2 class="text-lg font-semibold text-gray-800 dark:text-white">📢 {{ $item->judul }}</h2>
                        @if ($item->gambar)
                        <img src="{{ asset('storage/' . $item->gambar) }}" alt="Gambar" class="mt-3 rounded-lg max-h-60">
                        @endif
                        <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">{!! nl2br(e($item->isi)) !!}</p>
                        <p class="text-xs text-gray-400 dark:text-gray-500 mt-2">Kategori: {{ $item->kategori ?? '-' }} · Oleh: {{ $item->user->name }} · {{ $item->created_at->format('d M Y') }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-6">
            {{ $pengumuman->withQueryString()->links() }}
        </div>
    </div>
</x-app-layout>