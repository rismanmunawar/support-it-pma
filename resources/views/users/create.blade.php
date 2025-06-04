<x-app-layout>
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-xl font-bold mb-4">Tambah User</h1>

        <form action="{{ route('users.store') }}" method="POST" class="bg-white p-6 rounded shadow-md space-y-4">
            @csrf
            <div>
                <label class="block font-semibold">Nama</label>
                <input type="text" name="name" class="w-full border px-3 py-2 rounded" required>
            </div>
            <div>
                <label class="block font-semibold">Email</label>
                <input type="email" name="email" class="w-full border px-3 py-2 rounded" required>
            </div>
            <div>
                <label class="block font-semibold">Kode Depo</label>
                <input type="text" name="kode_depo" class="w-full border px-3 py-2 rounded" required>
            </div>
            <div>
                <label class="block font-semibold">Password</label>
                <input type="password" name="password" class="w-full border px-3 py-2 rounded" required>
            </div>
            <div>
                <label class="block font-semibold">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="w-full border px-3 py-2 rounded" required>
            </div>
            <div>
                <button type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
            </div>
        </form>
    </div>
</x-app-layout>
