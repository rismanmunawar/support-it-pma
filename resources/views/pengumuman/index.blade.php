<x-app-layout>
    <!-- Container utama full screen dengan bg responsif -->
    <div class="min-h-screen w-full bg-gray-100 dark:bg-gray-900 px-4 py-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 dark:text-white mb-2">📢 Portal Informasi & Pengumuman</h1>
                <p class="text-gray-600 dark:text-gray-400 max-w-md">Selalu terhubung dengan update terkini dari tim & sistem.</p>
            </div>
            <a href="{{ route('pengumuman.create') }}" class="px-4 py-2 rounded-md bg-blue-600 text-white hover:bg-blue-700 whitespace-nowrap self-start sm:self-auto">+ Tambah</a>
        </div>

        @php
        $warnaKategori = [
        'System' => 'bg-green-600 hover:bg-green-700 text-white',
        'Monitoring' => 'bg-yellow-500 hover:bg-yellow-600 text-white',
        'Umum' => 'bg-blue-600 hover:bg-blue-700 text-white',
        ];
        @endphp

        <div x-data="kategoriFilter()" id="pengumuman-wrapper">
            <form method="GET" class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6" @submit.prevent>
                <div class="flex flex-wrap gap-2">
                    {{-- Tombol Semua --}}
                    <button
                        @click.prevent="filterKategori('')"
                        :class="kategoriAktif === '' ? 'bg-blue-600 text-white hover:bg-blue-700' : 'bg-gray-200 text-gray-700 hover:bg-gray-300 dark:bg-gray-700 dark:text-white dark:hover:bg-gray-600'"
                        class="px-4 py-2 rounded-full text-sm font-medium whitespace-nowrap">
                        Semua
                    </button>

                    {{-- Tombol per kategori --}}
                    @foreach($kategoriList as $kategori)
                    <button
                        @click.prevent="filterKategori('{{ $kategori }}')"
                        :class="kategoriAktif === '{{ $kategori }}' ? '{{ $warnaKategori[$kategori] ?? 'bg-gray-600 hover:bg-gray-700 text-white' }}' : 'bg-gray-200 text-gray-700 hover:bg-gray-300 dark:bg-gray-700 dark:text-white dark:hover:bg-gray-600'"
                        class="px-4 py-2 rounded-full text-sm font-medium whitespace-nowrap">
                        {{ $kategori }}
                    </button>
                    @endforeach
                </div>

                {{-- Input Search --}}
                <div class="relative w-full md:w-1/3">
                    <input
                        x-model.debounce.500="searchQuery"
                        @input.debounce.700="filterKategori(kategoriAktif)"
                        type="text"
                        name="search"
                        placeholder="Cari pengumuman..."
                        class="w-full pl-10 pr-4 py-2 rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <svg class="absolute left-3 top-2.5 w-5 h-5 text-gray-500 dark:text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 21l-4.35-4.35M16 10a6 6 0 11-12 0 6 6 0 0112 0z" />
                    </svg>
                </div>
            </form>

            <div id="konten-pengumuman">
                <div class="space-y-4">
                    @foreach ($pengumuman as $item)
                    <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-4 hover:shadow-md transition-shadow duration-300">
                        @php
                        // Tentukan ikon dan warna latar serta teks berdasarkan kategori
                        $kategoriData = match($item->kategori) {
                        'System' => [
                        'icon' => '<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 3v1.5m4.5-1.5v1.5M4.5 6h15M3 9.75h18M4.5 13.5h15M3 17.25h18M6 21v-1.5m12 1.5v-1.5" />
                        </svg>',
                        'bg' => 'bg-green-100 dark:bg-green-900',
                        'text' => 'text-green-700 dark:text-green-300',
                        ],
                        'Monitoring' => [
                        'icon' => '<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m4 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>',
                        'bg' => 'bg-yellow-100 dark:bg-yellow-900',
                        'text' => 'text-yellow-700 dark:text-yellow-300',
                        ],
                        'Umum' => [
                        'icon' => '<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6l4 2" />
                        </svg>',
                        'bg' => 'bg-blue-100 dark:bg-blue-900',
                        'text' => 'text-blue-700 dark:text-blue-300',
                        ],
                        default => [
                        'icon' => '<svg class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <circle cx="12" cy="12" r="10" />
                        </svg>',
                        'bg' => 'bg-gray-100 dark:bg-gray-800',
                        'text' => 'text-gray-700 dark:text-gray-300',
                        ],
                        };
                        @endphp

                        <div class="flex-shrink-0">
                            <div class="flex items-center gap-2 px-3 py-1.5 rounded-full text-sm font-medium {{ $kategoriData['bg'] }} {{ $kategoriData['text'] }}">
                                {!! $kategoriData['icon'] !!}
                                <span>{{ $item->kategori ?? '-' }}</span>
                            </div>
                        </div>

                        <h2 class="text-lg font-semibold text-gray-800 dark:text-white break-words">📢 {{ $item->judul }}</h2>
                        <div class="flex flex-col md:flex-row gap-4 items-start">

                            <div class="flex-1 md:flex-[7] min-w-0">
                                <p class="text-sm text-gray-600 dark:text-gray-300 mt-1 leading-tight break-words whitespace-pre-line">
                                    {!! nl2br(e($item->isi)) !!}
                                </p>
                                <p class="text-xs text-gray-400 dark:text-gray-500 mt-2">
                                    Kategori: {{ $item->kategori ?? '-' }} · Oleh: {{ $item->user->name }} · {{ $item->created_at->format('d M Y H:i') }}
                                    @if ($item->updated_at && $item->updated_at != $item->created_at)
                                    · Updated {{ $item->updated_at->format('d M Y H:i') }}
                                    @endif
                                </p>

                                <!-- Tombol Aksi -->
                                <div class="flex items-center gap-4">
                                    <a href="{{ route('pengumuman.edit', $item->id) }}" class="text-blue-600 hover:underline whitespace-nowrap">✏️ Edit</a>
                                    <form action="{{ route('pengumuman.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pengumuman ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline whitespace-nowrap">🗑️ Hapus</button>
                                    </form>
                                </div>
                            </div>

                            @if ($item->gambar)
                            <div class="relative w-full md:flex-[2] flex-shrink-0" x-data="{ open: false }" style="min-height:150px;">
                                <img src="{{ asset('storage/' . $item->gambar) }}"
                                    alt="Gambar"
                                    class="rounded-lg w-full object-cover max-h-[300px]">
                                <!-- Tombol View -->
                                <button
                                    @click="open = true"
                                    class="absolute bottom-1 right-1 bg-black bg-opacity-50 text-white px-2 py-1 text-xs rounded hover:bg-opacity-75 transition">
                                    🔍 View
                                </button>

                                <!-- Modal -->
                                <div
                                    x-show="open"
                                    x-transition
                                    @click.outside="open = false"
                                    class="fixed inset-0 bg-black bg-opacity-80 flex items-center justify-center z-50 p-4">
                                    <img src="{{ asset('storage/' . $item->gambar) }}" class="max-h-[80vh] max-w-[90vw] rounded shadow-lg">
                                    <button @click="open = false" class="absolute top-5 right-5 text-white text-3xl font-bold leading-none hover:text-gray-300">✖</button>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="mt-6">
                    {{ $pengumuman->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </div>
    <script src="//unpkg.com/alpinejs" defer></script>
    <script>
        function kategoriFilter() {
            return {
                kategoriAktif: "{{ request('kategori') ?? '' }}",
                searchQuery: "{{ request('search') ?? '' }}",
                filterKategori(kategori) {
                    this.kategoriAktif = kategori;
                    const params = new URLSearchParams();
                    if (kategori) params.append('kategori', kategori);
                    if (this.searchQuery) params.append('search', this.searchQuery);
                    fetch(`?${params.toString()}`, {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        })
                        .then(response => response.text())
                        .then(html => {
                            const parser = new DOMParser();
                            const doc = parser.parseFromString(html, 'text/html');
                            const newContent = doc.querySelector('#konten-pengumuman');
                            document.querySelector('#konten-pengumuman').innerHTML = newContent.innerHTML;
                            window.history.replaceState(null, '', `?${params.toString()}`);
                        });
                }
            }
        }
    </script>
</x-app-layout>