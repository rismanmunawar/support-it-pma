<x-app-layout>
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center my-6">
            <h1 class="text-2xl font-bold">Daftar User</h1>
            <a href="{{ route('users.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">+
                Tambah
                User</a>
        </div>

        @if (session('success'))
            <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white shadow-md rounded border">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="py-2 px-4 text-left">Nama</th>
                        <th class="py-2 px-4 text-left">Email</th>
                        <th class="py-2 px-4 text-left">Kode Depo</th>
                        <th class="py-2 px-4 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="py-2 px-4">{{ $user->name }}</td>
                            <td class="py-2 px-4">{{ $user->email }}</td>
                            <td class="py-2 px-4">{{ $user->kode_depo }}</td>
                            <td class="py-2 px-4">
                                <a href="{{ route('users.edit', $user->id) }}"
                                    class="text-blue-600 hover:underline">Edit</a>
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline ml-2"
                                        onclick="return confirm('Yakin hapus user ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
