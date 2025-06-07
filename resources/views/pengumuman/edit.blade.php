<x-app-layout>
    <div class="max-w-2xl mx-auto py-8">
        <h1 class="text-2xl font-bold mb-4 text-gray-800 dark:text-white">✏️ Edit Pengumuman</h1>

        <form action="{{ route('pengumuman.update', $pengumuman->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block mb-1 font-semibold text-gray-700 dark:text-gray-300">Judul</label>
                <input type="text" name="judul" value="{{ old('judul', $pengumuman->judul) }}"
                    class="w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white focus:ring focus:ring-blue-400 py-3" required>
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-semibold text-gray-700 dark:text-gray-300">Isi</label>
                <textarea name="isi"
                    class="w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white focus:ring focus:ring-blue-400 min-h-[150px] py-3" required>{{ old('isi', $pengumuman->isi) }}</textarea>
            </div>

            <div class="mb-4">
                <label for="kategori" class="block mb-1 font-semibold text-gray-700 dark:text-gray-300">Kategori</label>
                <select name="kategori" id="kategori"
                    class="w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white focus:ring focus:ring-blue-400 py-3">
                    <option value="System" {{ old('kategori', $pengumuman->kategori) == 'System' ? 'selected' : '' }}>System</option>
                    <option value="Monitoring" {{ old('kategori', $pengumuman->kategori) == 'Monitoring' ? 'selected' : '' }}>Monitoring</option>
                    <option value="Umum" {{ old('kategori', $pengumuman->kategori) == 'Umum' ? 'selected' : '' }}>Umum</option>
                </select>
                @error('kategori')
                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-semibold text-gray-700 dark:text-gray-300">Gambar (opsional)</label>
                @if($pengumuman->gambar)
                <img src="{{ asset('storage/'.$pengumuman->gambar) }}" alt="Gambar" class="h-32 rounded mb-2">
                @endif
                <input type="file" name="gambar"
                    class="block w-full text-gray-700 dark:text-gray-300 file:bg-blue-600 file:text-white file:rounded file:px-3 file:py-1 file:border-none file:mr-3">
            </div>

            <div class="flex gap-3">
                <button type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 focus:outline-none focus:ring focus:ring-blue-400">💾 Simpan Perubahan</button>
                <a href="{{ route('pengumuman.index') }}"
                    class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">←
                    Batal</a>
            </div>
        </form>
    </div>
</x-app-layout>