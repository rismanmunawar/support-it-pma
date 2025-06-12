<x-app-layout>
    <div x-data="{ open: false, search: '' }" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 space-y-6">
        <!-- Header -->
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 dark:text-white">📊 Dashboard Monitoring ZNDSU</h1>
                <p class="text-gray-500 dark:text-gray-400 text-sm">Pantau data harian plant dan info terkini</p>
            </div>
            <button
                @click="open = true"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md shadow text-sm">
                📊 View Monitoring
            </button>
        </div>

        <!-- Grid Info -->
        <div class="grid gap-4 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">
            <!-- Total Data -->
            <div class="bg-white dark:bg-gray-800 dark:border dark:border-gray-700 rounded-xl shadow-md p-4">
                <h2 class="text-sm font-medium text-gray-600 dark:text-gray-400">📈 Total Data</h2>
                <p class="text-3xl font-bold text-blue-600 mt-1">150</p>
                <p class="text-xs text-gray-400 mt-1">Jumlah record plant yang dimonitor</p>
            </div>

            <!-- Last Update -->
            <div class="bg-white dark:bg-gray-800 dark:border dark:border-gray-700 rounded-xl shadow-md p-4">
                <h2 class="text-sm font-medium text-gray-600 dark:text-gray-400">🕒 Update Terakhir</h2>
                <p class="text-xl font-bold text-gray-800 dark:text-white mt-1">{{ $lastUpdate }}</p>
                <p class="text-xs text-gray-400 mt-1">Waktu terakhir data diupdate</p>
            </div>

            <!-- Upload Monitoring (khusus IT) -->
            @if (auth()->user()->role === 'IT')
            <div class="bg-white dark:bg-gray-800 dark:border dark:border-gray-700 rounded-xl shadow-md p-4">
                <h2 class="text-sm font-medium text-gray-600 dark:text-gray-400 mb-2">⬆️ Upload Excel</h2>
                <form action="{{ route('zndsu.upload') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="file" accept=".xlsx,.xls"
                        class="block w-full text-xs text-gray-500 dark:text-gray-400 file:mr-2 file:py-1.5 file:px-3 file:rounded file:border-0 file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" required>
                    <button type="submit"
                        class="mt-2 bg-green-600 hover:bg-green-700 text-white px-3 py-1.5 text-xs rounded-md w-full">
                        🚀 Upload
                    </button>
                </form>
            </div>
            @endif
        </div>

        <!-- Konten Tambahan -->
        <div class="grid gap-4 grid-cols-1 sm:grid-cols-2 lg:grid-cols-2">
            <div class="bg-white dark:bg-gray-800 dark:border dark:border-gray-700 rounded-xl shadow-md p-4 min-h-[160px]">
                <h2 class="text-lg font-semibold text-gray-800 dark:text-white">🛠️ Ticketing Support</h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">Fitur pelaporan masalah dan keluhan dari user ke tim IT, dengan tracking status tiket secara real-time.</p>
            </div>
            <div class="bg-white dark:bg-gray-800 dark:border dark:border-gray-700 rounded-xl shadow-md p-4 min-h-[160px]">
                <h2 class="text-lg font-semibold text-gray-800 dark:text-white">📢 Informasi & Announcement</h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">Tempat untuk membagikan pengumuman penting, notifikasi update sistem, dan jadwal maintenance.</p>
            </div>
            <div class="bg-white dark:bg-gray-800 dark:border dark:border-gray-700 rounded-xl shadow-md p-4 min-h-[160px]">
                <h2 class="text-lg font-semibold text-gray-800 dark:text-white">📬 Email Blast & Reminder</h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">Kirim pengingat otomatis via email ke user terkait downtime, reminder tugas, atau update sistem.</p>
            </div>
            <div class="bg-white dark:bg-gray-800 dark:border dark:border-gray-700 rounded-xl shadow-md p-4 min-h-[160px]">
                <h2 class="text-lg font-semibold text-gray-800 dark:text-white">📚 Dokumentasi & FAQ</h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">Akses cepat ke panduan penggunaan sistem, FAQ, serta prosedur standar operasional IT.</p>
            </div>
        </div>

        <!-- Modal atau komponen tambahan -->
        @include('dashboard.modal-monitoring')
    </div>
</x-app-layout>