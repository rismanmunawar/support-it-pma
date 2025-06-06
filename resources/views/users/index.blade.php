<x-app-layout>
    <div class="w-full px-4 py-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">Users</h1>
            <a href="{{ route('users.create') }}"
                class="bg-pink-500 hover:bg-pink-600 text-white font-semibold px-4 py-2 rounded shadow">
                Create New User
            </a>
        </div>

        <div class="flex gap-2 items-center mb-4 relative">
            <select id="filterBy"
                class="w-40 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-100 rounded px-3 py-2">
                <option value="name">Name</option>
                <option value="email">Email</option>
                <option value="branch">Branch</option>
            </select>

            <div class="relative w-full">
                <input type="text" id="searchInput" placeholder="Type to search..."
                    class="border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-100 rounded px-3 py-2 w-full"
                    autocomplete="off" />
                <ul id="suggestions"
                    class="absolute bg-white dark:bg-gray-800 border dark:border-gray-600 w-full mt-1 rounded shadow z-10 hidden max-h-48 overflow-y-auto text-gray-800 dark:text-gray-100">
                </ul>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-4">
            <div class="overflow-x-auto">
                <table class="min-w-full table-fixed border border-gray-200 dark:border-gray-700 text-sm text-gray-800 dark:text-gray-100">

                    <thead class="bg-gray-100 dark:bg-gray-700 font-semibold text-left">
                        <tr>
                            <th class="w-24 px-4 py-2 border-b dark:border-gray-600">NIK</th>
                            <th class="w-40 px-4 py-2 border-b dark:border-gray-600">Name</th>
                            <th class="w-32 px-4 py-2 border-b dark:border-gray-600">Role</th>
                            <th class="w-40 px-4 py-2 border-b dark:border-gray-600">Role Desc</th>
                            <th class="w-32 px-4 py-2 border-b dark:border-gray-600">Branch</th>
                            <th class="w-48 px-4 py-2 border-b dark:border-gray-600">Email</th>
                            <th class="w-32 px-4 py-2 border-b dark:border-gray-600">Telepon</th>
                            <th class="w-28 px-4 py-2 border-b dark:border-gray-600">Action</th>

                        </tr>
                    </thead>
                    <tbody id="usersTableBody">
                        @foreach ($users as $user)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-600 border-b dark:border-gray-700">
                            <td class="px-4 py-2">{{ $user->nik }}</td>
                            <td class="px-4 py-2">{{ $user->name }}</td>
                            <td class="px-4 py-2">{{ $user->role }}</td>
                            <td class="px-4 py-2">{{ $user->role_desc }}</td>
                            <td class="px-4 py-2">{{ $user->branch }}</td>
                            <td class="px-4 py-2">{{ $user->email }}</td>
                            <td class="px-4 py-2">{{ $user->phone }}</td>
                            <td class="px-4 py-2 space-x-2">
                                <a href="{{ route('users.edit', $user->id) }}"
                                    class="text-blue-600 dark:text-blue-400 hover:underline">Edit</a>
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 dark:text-red-400 hover:underline">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4 text-gray-800 dark:text-gray-100">
                {{ $users->links() }}
            </div>
        </div>
    </div>

    <script>
        const searchInput = document.getElementById('searchInput');
        const filterBy = document.getElementById('filterBy');
        const usersTableBody = document.getElementById('usersTableBody');
        const originalTableHTML = usersTableBody.innerHTML; // simpan isi awal

        let debounceTimer;
        searchInput.addEventListener('input', function() {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(() => {
                const query = searchInput.value.trim();
                const filter = filterBy.value;

                // Jika input kosong, kembalikan ke data awal
                if (query.length === 0) {
                    usersTableBody.innerHTML = originalTableHTML;
                    return;
                }

                fetch(`{{ route('users.search') }}?query=${encodeURIComponent(query)}&filter=${filter}`)
                    .then(res => res.json())
                    .then(data => {
                        usersTableBody.innerHTML = '';

                        if (data.length === 0) {
                            usersTableBody.innerHTML = `
                            <tr>
                                <td colspan="8" class="text-center text-gray-500 dark:text-gray-400 px-4 py-2">
                                    Tidak ada user ditemukan
                                </td>
                            </tr>`;
                            return;
                        }

                        data.forEach(user => {
                            const row = document.createElement('tr');
                            row.className = 'hover:bg-gray-50 dark:hover:bg-gray-600 border-b dark:border-gray-700';
                            row.innerHTML = `
                           <td class="px-4 py-2">${user.nik ?? '-'}</td>
                            <td class="px-4 py-2">${user.name ?? '-'}</td>
                            <td class="px-4 py-2">${user.role ?? '-'}</td>
                            <td class="px-4 py-2">${user.role_desc ?? '-'}</td>
                            <td class="px-4 py-2">${user.branch ?? '-'}</td>
                            <td class="px-4 py-2">${user.email ?? '-'}</td>
                            <td class="px-4 py-2">${user.phone ?? '-'}</td>

                            <td class="px-4 py-2 space-x-2">
                                <a href="/users/${user.id}/edit" class="text-blue-600 dark:text-blue-400 hover:underline">Edit</a>
                                <form method="POST" action="/users/${user.id}" class="inline" onsubmit="return confirm('Yakin hapus user ini?')">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="text-red-600 dark:text-red-400 hover:underline">Hapus</button>
                                </form>
                            </td>`;
                            usersTableBody.appendChild(row);
                        });
                    });
            }, 300); // debounce 300ms
        });
    </script>

    <script>
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault(); // Mencegah submit langsung

                Swal.fire({
                    title: 'Yakin ingin menghapus?',
                    text: "Data yang dihapus tidak bisa dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc2626', // Tailwind red-600
                    cancelButtonColor: '#6b7280', // Tailwind gray-500
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit(); // Submit form jika dikonfirmasi
                    }
                });
            });
        });
    </script>

</x-app-layout>