<x-app-layout>
    <div class="w-full px-4 py-6">
        <h1 class="text-xl font-bold mb-4 text-gray-900 dark:text-gray-100">Edit User</h1>
        <form action="{{ route('users.update', $user->id) }}" method="POST" class="bg-white p-6 rounded shadow-md space-y-4">
            @csrf @method('PUT')
            <div>
                <label class="block font-semibold">Nama</label>
                <input type="text" name="name" value="{{ $user->name }}" class="w-full border px-3 py-2 rounded"
                    required>
            </div>
            <div>
                <label class="block font-semibold">Email</label>
                <input type="email" name="email" value="{{ $user->email }}" class="w-full border px-3 py-2 rounded"
                    required>
            </div>
            <div>
                <label class="block font-semibold">Kode Depo</label>
                <input type="text" name="kode_depo" value="{{ $user->kode_depo }}"
                    class="w-full border px-3 py-2 rounded" required>
            </div>
            <div>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update</button>
            </div>
        </form>
    </div>
</x-app-layout>