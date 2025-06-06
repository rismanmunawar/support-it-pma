<x-app-layout>
    <div class="w-full px-4 py-6">
        <h1 class="text-xl font-bold mb-4 text-gray-900 dark:text-gray-100">Tambah User</h1>
        <form method="POST" action="{{ route('users.store') }}"
            class="w-full bg-white dark:bg-gray-800 p-8 rounded shadow text-gray-900 dark:text-gray-100">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Kolom Kiri -->
                <div class="space-y-4">
                    <!-- NIK -->
                    <div class="grid grid-cols-12 items-center gap-2">
                        <label for="nik" class="col-span-3 text-left text-gray-700 dark:text-gray-300">NIK</label>
                        <x-text-input id="nik" name="nik" type="text"
                            class="col-span-9 mt-1 w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500"
                            placeholder="Masukkan NIK" value="{{ old('nik') }}" required autofocus />
                        <x-input-error :messages="$errors->get('nik')" class="col-span-9 col-start-4 mt-1 text-red-600 dark:text-red-400" />
                    </div>

                    <!-- Full Name -->
                    <div class="grid grid-cols-12 items-center gap-2">
                        <label for="name" class="col-span-3 text-left text-gray-700 dark:text-gray-300">Full Name</label>
                        <x-text-input id="name" name="name" type="text"
                            class="col-span-9 mt-1 w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500"
                            placeholder="Masukkan nama lengkap" value="{{ old('name') }}" required />
                        <x-input-error :messages="$errors->get('name')" class="col-span-9 col-start-4 mt-1 text-red-600 dark:text-red-400" />
                    </div>

                    <!-- Email -->
                    <div class="grid grid-cols-12 items-center gap-2">
                        <label for="email" class="col-span-3 text-left text-gray-700 dark:text-gray-300">Email</label>
                        <x-text-input id="email" name="email" type="email"
                            class="col-span-9 mt-1 w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500"
                            placeholder="Masukkan email @pinusmerahabadi.co.id" value="{{ old('email') }}" required />
                        <x-input-error :messages="$errors->get('email')" class="col-span-9 col-start-4 mt-1 text-red-600 dark:text-red-400" />
                    </div>

                    <!-- Phone -->
                    <div class="grid grid-cols-12 items-center gap-2">
                        <label for="phone" class="col-span-3 text-left text-gray-700 dark:text-gray-300">Phone</label>
                        <x-text-input id="phone" name="phone" type="text"
                            class="col-span-9 mt-1 w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500"
                            placeholder="Masukkan phone" value="{{ old('phone') }}" />
                        <x-input-error :messages="$errors->get('phone')" class="col-span-9 col-start-4 mt-1 text-red-600 dark:text-red-400" />
                    </div>

                    <!-- Company (readonly) -->
                    <div class="grid grid-cols-12 items-center gap-2">
                        <label for="company" class="col-span-3 text-left text-gray-700 dark:text-gray-300">Company</label>
                        <x-text-input id="company" name="company" type="text"
                            class="col-span-9 mt-1 w-full border border-gray-300 dark:border-gray-600 bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-gray-100"
                            value="PP01 - Pinus Merah Abadi, PT" readonly />
                    </div>

                    <!-- Country (readonly) -->
                    <div class="grid grid-cols-12 items-center gap-2">
                        <label for="country" class="col-span-3 text-left text-gray-700 dark:text-gray-300">Country</label>
                        <x-text-input id="country" name="country" type="text"
                            class="col-span-9 mt-1 w-full border border-gray-300 dark:border-gray-600 bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-gray-100"
                            value="ID - Indonesia" readonly />
                    </div>

                    <!-- Branch -->
                    <div class="grid grid-cols-12 items-center gap-2">
                        <label for="branch" class="col-span-3 text-left text-gray-700 dark:text-gray-300">Branch</label>
                        <x-text-input id="branch" name="branch" type="text"
                            class="col-span-9 mt-1 w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500"
                            placeholder="Masukkan branch" value="{{ old('branch') }}" required />
                        <x-input-error :messages="$errors->get('branch')" class="col-span-9 col-start-4 mt-1 text-red-600 dark:text-red-400" />
                    </div>

                    <!-- Role (readonly) -->
                    <div class="grid grid-cols-12 items-center gap-2">
                        <label for="role" class="col-span-3 text-left text-gray-700 dark:text-gray-300">Role</label>
                        <x-text-input id="role" name="role" type="text"
                            class="col-span-9 mt-1 w-full border border-gray-300 dark:border-gray-600 bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-gray-100"
                            value="Admin" readonly required />
                        <x-input-error :messages="$errors->get('role')" class="col-span-9 col-start-4 mt-1 text-red-600 dark:text-red-400" />
                    </div>

                    <!-- Role Desc -->
                    <div class="grid grid-cols-12 items-center gap-2">
                        <label for="role_desc" class="col-span-3 text-left text-gray-700 dark:text-gray-300">Role Desc</label>
                        <x-text-input id="role_desc" name="role_desc" type="text"
                            class="col-span-9 mt-1 w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500"
                            placeholder="Deskripsi Role" value="{{ old('role_desc') }}" />
                        <x-input-error :messages="$errors->get('role_desc')" class="col-span-9 col-start-4 mt-1 text-red-600 dark:text-red-400" />
                    </div>
                </div>

                <!-- Kolom Kanan -->
                <div class="space-y-4">
                    <!-- Password -->
                    <div>
                        <x-input-label for="password" :value="'Password'" class="text-gray-700 dark:text-gray-300" />
                        <x-text-input id="password" name="password" type="password"
                            class="mt-1 block w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500"
                            placeholder="Masukkan password" required />
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600 dark:text-red-400" />
                    </div>

                    <!-- Konfirmasi Password -->
                    <div>
                        <x-input-label for="password_confirmation" :value="'Konfirmasi Password'" class="text-gray-700 dark:text-gray-300" />
                        <x-text-input id="password_confirmation" name="password_confirmation" type="password"
                            class="mt-1 block w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500"
                            placeholder="Ulangi password" required />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-600 dark:text-red-400" />
                    </div>
                </div>
            </div>

            <div class="mt-8 flex justify-between items-center">
                <a href="{{ route('users.index') }}"
                    class="px-4 py-2 rounded bg-red-600 text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-600">
                    Batal
                </a>
                <button type="submit"
                    class="px-4 py-2 rounded bg-green-600 text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-600">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</x-app-layout>