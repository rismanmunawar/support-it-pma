<x-app-layout>
    <div class="max-w-2xl mx-auto p-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white mb-4">Tambah Pengumuman</h1>

        <form action="{{ route('pengumuman.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div>
                <label for="judul" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Judul</label>
                <input type="text" name="judul" id="judul" class="mt-1 block w-full rounded-md bg-gray-100 dark:bg-gray-800 border-transparent focus:border-blue-500 focus:ring-blue-500 text-gray-800 dark:text-white" value="{{ old('judul') }}">
                @error('judul')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label for="gambar" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Upload Gambar (opsional)</label>
                <input type="file" name="gambar" id="gambar" class="mt-1 block w-full text-gray-700 dark:text-gray-300" accept="image/*">
                @error('gambar')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="isi" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Isi</label>
                <textarea name="isi" id="isi" rows="5" class="mt-1 block w-full rounded-md bg-gray-100 dark:bg-gray-800 border-transparent focus:border-blue-500 focus:ring-blue-500 text-gray-800 dark:text-white">{{ old('isi') }}</textarea>
                @error('isi')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="kategori" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Kategori</label>
                <select name="kategori" id="kategori"
                    class="mt-1 block w-full rounded-md bg-gray-100 dark:bg-gray-800 border-transparent focus:border-blue-500 focus:ring-blue-500 text-gray-800 dark:text-white" require>
                    <option value="">-- Pilih Kategori --</option>
                    <option value="System" {{ old('kategori') == 'System' ? 'selected' : '' }}>System</option>
                    <option value="Monitoring" {{ old('kategori') == 'Monitoring' ? 'selected' : '' }}>Monitoring</option>
                    <option value="Umum" {{ old('kategori') == 'Umum' ? 'selected' : '' }}>Umum</option>
                </select>
            </div>

            <div class="flex justify-end">
                <a href="{{ route('pengumuman.index') }}" class="px-4 py-2 bg-gray-300 dark:bg-gray-600 text-gray-800 dark:text-white rounded hover:bg-gray-400 dark:hover:bg-gray-500 mr-2">Batal</a>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Simpan</button>
            </div>
        </form>
    </div>
</x-app-layout>