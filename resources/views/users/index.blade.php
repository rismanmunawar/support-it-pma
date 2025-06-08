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
                            <th class="w-32 px-4 py-2 border-b dark:border-gray-600">
                                <a href="#" class="sort-link flex items-center space-x-1" data-sort="role">
                                    <span>Role</span>
                                    <svg class="w-3 h-3 sort-icon hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </a>
                            </th>
                            <th class="w-40 px-4 py-2 border-b dark:border-gray-600">Role Desc</th>
                            <th class="w-32 px-4 py-2 border-b dark:border-gray-600">Branch</th>
                            <th class="w-48 px-4 py-2 border-b dark:border-gray-600">Email</th>
                            <th class="w-32 px-4 py-2 border-b dark:border-gray-600">Telepon</th>
                            <th class="w-28 px-4 py-2 border-b dark:border-gray-600">Action</th>
                        </tr>
                    </thead>
                    <tbody id="usersTableBody">
                        @include('users.partials.table', ['users' => $users])
                    </tbody>
                </table>
            </div>
            <div id="entriesInfo" class="text-sm text-gray-600 dark:text-gray-300 mb-2">
                Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }} entries
            </div>
            <div id="paginationWrapper" class="mt-4">
                @include('users.partials.pagination', ['users' => $users])
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const searchInput = document.getElementById('searchInput');
            const filterBy = document.getElementById('filterBy');
            const usersTableBody = document.getElementById('usersTableBody');
            const paginationWrapper = document.getElementById('paginationWrapper');

            let debounceTimer;

            function fetchUsers(url = window.location.href) {
                const query = searchInput ? searchInput.value.trim() : '';
                const filter = filterBy ? filterBy.value : '';

                const fullUrl = new URL(url);
                fullUrl.searchParams.set('query', query);
                fullUrl.searchParams.set('filter', filter);

                const activeSortLink = document.querySelector('.sort-link[data-direction]');
                if (activeSortLink) {
                    fullUrl.searchParams.set('sort', activeSortLink.getAttribute('data-sort'));
                    fullUrl.searchParams.set('direction', activeSortLink.getAttribute('data-direction'));
                }

                fetch(fullUrl.toString(), {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        usersTableBody.innerHTML = data.table;
                        paginationWrapper.innerHTML = data.pagination;
                        attachPaginationLinks();
                    });
            }

            function attachPaginationLinks() {
                const links = paginationWrapper.querySelectorAll('a');
                links.forEach(link => {
                    link.addEventListener('click', function(e) {
                        e.preventDefault();
                        const url = new URL(this.href);
                        url.searchParams.set('query', searchInput ? searchInput.value.trim() : '');
                        url.searchParams.set('filter', filterBy ? filterBy.value : '');
                        fetchUsers(url.toString());
                    });
                });
            }

            document.querySelectorAll('.sort-link').forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const sort = this.getAttribute('data-sort');
                    const currentDirection = this.getAttribute('data-direction') || 'asc';
                    const newDirection = currentDirection === 'asc' ? 'desc' : 'asc';
                    this.setAttribute('data-direction', newDirection);
                    fetchUsers();
                });
            });

            if (searchInput) {
                searchInput.addEventListener('input', () => {
                    clearTimeout(debounceTimer);
                    debounceTimer = setTimeout(() => {
                        fetchUsers();
                    }, 300);
                });
            }

            if (filterBy) {
                filterBy.addEventListener('change', () => fetchUsers());
            }

            attachPaginationLinks();
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