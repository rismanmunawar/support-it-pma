<div
    x-show="open"
    x-data="{
        search: '',
        get filteredCount() {
            return Array.from($refs.tbody?.children || []).filter(row => !row.classList.contains('hidden')).length;
        }
    }"
    x-transition
    x-init="$nextTick(() => window.initExcelMonitoring())"
    class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm px-4"
    style="display: none;"
    @keydown.window.escape="open = false">

    <div
        @click.outside="open = false"
        class="w-full max-w-[80rem] h-[85vh] bg-white dark:bg-gray-900 rounded-2xl shadow-xl flex flex-col overflow-hidden">

        <!-- Header Modal -->
        <div class="px-6 pt-4 pb-3 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 z-10">
            <div class="flex justify-between items-start">
                <div>
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-white">📊 Monitoring ZNDSU</h2>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                        🕒 Terakhir diperbarui: {{ $lastUpdate }}
                    </p>
                </div>
                <button @click="open = false" class="text-gray-400 hover:text-red-500 text-2xl font-bold">&times;</button>
            </div>

            <input
                type="text"
                x-model="search"
                placeholder="🔍 Cari nama plant..."
                class="w-full mt-3 px-4 py-2 rounded-md border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500" />
        </div>

        <!-- Isi Tabel -->
        <div class="flex-1 overflow-x-auto overflow-y-auto relative no-scrollbar px-6 py-4 bg-white dark:bg-gray-900">
            @if ($data->count())
            <table class="min-w-max text-sm border-collapse">
                <thead class="bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-200 sticky top-0 z-10">
                    <tr>
                        <th class="border px-3 py-2 text-left font-medium">Plant</th>
                        <th class="border px-3 py-2 text-left font-medium">Plant Name</th>
                        @for ($i = 1; $i <= $dayCount; $i++)
                            <th class="border px-2 py-1 text-center font-medium">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</th>
                            @endfor
                            <th class="border px-2 py-1 text-center text-red-600 dark:text-red-400 font-semibold">Jml ❌</th>
                    </tr>
                </thead>
                <tbody x-ref="tbody">
                    @foreach ($data as $row)
                    @php $searchKey = strtolower($row->plant . ' ' . $row->name); @endphp
                    <tr
                        :class="!search || '{{ $searchKey }}'.includes(search.toLowerCase()) ? '' : 'hidden'"
                        class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                        <td class="border px-3 py-2 text-gray-800 dark:text-gray-100">{{ $row->plant }}</td>
                        <td class="border px-3 py-2 text-gray-800 dark:text-gray-100">{{ $row->name }}</td>
                        @for ($i = 1; $i <= $dayCount; $i++)
                            @php $status=$row->{'day_' . $i}; @endphp
                            <td class="border text-center px-2 py-2">
                                @switch($status)
                                @case('ok') ✅ @break
                                @case('fail') ❌ @break
                                @case('warn') ⚠️ @break
                                @default {{-- kosong --}} @break
                                @endswitch
                            </td>
                            @endfor
                            <td class="border text-center px-2 py-2 text-red-600 dark:text-red-400 font-bold">
                                {{ $row->jml_x }}
                            </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Tidak ada hasil -->
            <div
                x-show="search && filteredCount === 0"
                class="absolute inset-0 flex items-center justify-center text-gray-500 dark:text-gray-400 text-lg font-medium">
                🔍 Tidak ada hasil pencarian.
            </div>
            @else
            <p class="text-center text-gray-500 dark:text-gray-400">🚫 Tidak ada data ditemukan.</p>
            @endif
        </div>
    </div>
</div>