<div
    x-show="showModal"
    x-cloak
    class="fixed inset-0 z-50 bg-black/50 backdrop-blur-sm flex items-center justify-center px-4 sm:px-6 lg:px-8">

    <div
        @click.away="showModal = false"
        class="bg-white dark:bg-gray-900 rounded-lg w-full max-w-7xl h-[85vh] overflow-hidden p-6 shadow-xl border border-gray-300 dark:border-gray-700"
        x-data="{ search: '' }">
        {{-- Modal Header --}}
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white">📋 Data Monitoring</h3>
            <button @click="showModal = false" class="text-gray-500 hover:text-red-600 text-xl">×</button>
        </div>

        {{-- Search Input --}}
        <div class="mb-4">
            <input
                type="text"
                x-model="search"
                placeholder="🔍 Cari nama atau plant..."
                class="w-full border border-gray-300 dark:border-gray-700 px-4 py-2 rounded text-sm dark:bg-gray-800 dark:text-white focus:outline-none focus:ring focus:ring-blue-400" />
        </div>

        {{-- Upload Form --}}
        <form method="POST" action="{{ route('monitoring.upload') }}" enctype="multipart/form-data"
            class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow mb-4">
            @csrf
            <div class="flex flex-col sm:flex-row sm:items-center gap-4">
                <input type="file" name="file" accept=".xlsx" required
                    class="border border-gray-300 dark:border-gray-600 rounded px-4 py-2 text-sm dark:bg-gray-900 dark:text-white focus:outline-none focus:ring focus:ring-blue-400">
                <button type="submit"
                    class="px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm rounded shadow transition">
                    📤 Upload Excel
                </button>
            </div>
        </form>

        {{-- Info --}}
        @if($lastUpdated)
        <p class="text-xs text-gray-500 dark:text-gray-400 mb-2">
            Terakhir diperbarui: {{ \Carbon\Carbon::parse($lastUpdated)->format('d M Y H:i') }}
        </p>
        @endif

        {{-- Data Table Scrollable with Sticky Header --}}
        @if($data && count($data))
        <div class="overflow-x-auto border border-gray-200 dark:border-gray-700 rounded-lg">
            <div class="max-h-[50vh] overflow-y-auto">
                <table class="min-w-full text-sm border-collapse">
                    <thead class="bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-100 sticky top-0 z-10">
                        <tr>
                            <th class="p-2 border dark:border-gray-600 bg-inherit">🏭 Plant</th>
                            <th class="p-2 border dark:border-gray-600 bg-inherit">👤 Name</th>
                            @foreach($headers as $header)
                            <th class="p-2 border dark:border-gray-600 text-center bg-inherit">{{ $header }}</th>
                            @endforeach
                            <th class="p-2 border dark:border-gray-600 text-center text-red-500 font-semibold bg-inherit">❌ Jml</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-900 text-gray-700 dark:text-gray-200">
                        @foreach($data as $row)
                        <tr
                            class="hover:bg-gray-50 dark:hover:bg-gray-800 transition"
                            x-show="
                                search === '' || 
                                '{{ strtolower($row->plant) }}'.includes(search.toLowerCase()) || 
                                '{{ strtolower($row->name) }}'.includes(search.toLowerCase())
                            ">
                            <td class="p-2 border dark:border-gray-700">{{ $row->plant }}</td>
                            <td class="p-2 border dark:border-gray-700">{{ $row->name }}</td>
                            @foreach($row->statuses ?? [] as $status)
                            <td class="p-2 border text-center dark:border-gray-700">
                                @switch($status)
                                @case('ok') <span class="text-green-600">✅</span> @break
                                @case('fail') <span class="text-red-600">❌</span> @break
                                @case('libur') <span class="text-yellow-500">🛌</span> @break
                                @case('warn') <span class="text-orange-500">⚠️</span> @break
                                @default <span class="text-gray-400">—</span>
                                @endswitch
                            </td>
                            @endforeach
                            <td class="p-2 border text-center font-bold text-red-600 dark:border-gray-700">
                                {{ $row->jml_x }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @else
        <div class="p-4 text-center text-gray-500 dark:text-gray-400">
            📭 Belum ada data yang tersedia.
        </div>
        @endif
    </div>
</div>