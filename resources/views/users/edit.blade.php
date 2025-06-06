<x-app-layout>

    <div class="w-full px-4 py-6">
        <h1 class="text-xl font-bold mb-4 text-gray-900 dark:text-gray-100">Edit User</h1>
        <form method="POST" action="{{ route('users.update', $user->id) }}"
            class="w-full bg-white dark:bg-gray-800 p-8 rounded shadow text-gray-900 dark:text-gray-100">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Kolom Kiri -->
                <div class="space-y-4">
                    <!-- NIK -->
                    <div class="grid grid-cols-12 items-center gap-2">
                        <label for="nik" class="col-span-3 text-left text-gray-700 dark:text-gray-300">NIK</label>
                        <x-text-input id="nik" name="nik" type="text"
                            class="col-span-9 mt-1 w-full" placeholder="Masukkan NIK"
                            value="{{ old('nik', $user->nik) }}" required autofocus />
                        <x-input-error :messages="$errors->get('nik')" class="col-span-9 col-start-4 mt-1" />
                    </div>

                    <!-- Full Name -->
                    <div class="grid grid-cols-12 items-center gap-2">
                        <label for="name" class="col-span-3 text-left">Full Name</label>
                        <x-text-input id="name" name="name" type="text"
                            class="col-span-9 mt-1 w-full"
                            value="{{ old('name', $user->name) }}" required />
                        <x-input-error :messages="$errors->get('name')" class="col-span-9 col-start-4 mt-1" />
                    </div>

                    <!-- Email -->
                    <div class="grid grid-cols-12 items-center gap-2">
                        <label for="email" class="col-span-3 text-left">Email</label>
                        <x-text-input id="email" name="email" type="email"
                            class="col-span-9 mt-1 w-full"
                            value="{{ old('email', $user->email) }}" required />
                        <x-input-error :messages="$errors->get('email')" class="col-span-9 col-start-4 mt-1" />
                    </div>

                    <!-- Phone -->
                    <div class="grid grid-cols-12 items-center gap-2">
                        <label for="phone" class="col-span-3 text-left">Phone</label>
                        <x-text-input id="phone" name="phone" type="text"
                            class="col-span-9 mt-1 w-full"
                            value="{{ old('phone', $user->phone) }}" />
                        <x-input-error :messages="$errors->get('phone')" class="col-span-9 col-start-4 mt-1" />
                    </div>

                    <!-- Company -->
                    <div class="grid grid-cols-12 items-center gap-2">
                        <label for="company" class="col-span-3 text-left">Company</label>
                        <x-text-input id="company" name="company" type="text"
                            class="col-span-9 mt-1 w-full bg-gray-100 dark:bg-gray-800"
                            value="{{ $user->company ?? 'PP01 - Pinus Merah Abadi, PT' }}" readonly />
                    </div>

                    <!-- Country -->
                    <div class="grid grid-cols-12 items-center gap-2">
                        <label for="country" class="col-span-3 text-left">Country</label>
                        <x-text-input id="country" name="country" type="text"
                            class="col-span-9 mt-1 w-full bg-gray-100 dark:bg-gray-800"
                            value="{{ $user->country ?? 'ID - Indonesia' }}" readonly />
                    </div>

                    <!-- Branch -->
                    <div class="grid grid-cols-12 items-center gap-2">
                        <label for="branch" class="col-span-3 text-left">Branch</label>
                        <x-text-input id="branch" name="branch" type="text"
                            class="col-span-9 mt-1 w-full"
                            value="{{ old('branch', $user->branch) }}" required />
                        <x-input-error :messages="$errors->get('branch')" class="col-span-9 col-start-4 mt-1" />
                    </div>

                    <!-- Role -->
                    <div class="grid grid-cols-12 items-center gap-2">
                        <label for="role" class="col-span-3 text-left">Role</label>
                        <x-text-input id="role" name="role" type="text"
                            class="col-span-9 mt-1 w-full bg-gray-100 dark:bg-gray-800"
                            value="{{ old('role', $user->role) }}" readonly required />
                        <x-input-error :messages="$errors->get('role')" class="col-span-9 col-start-4 mt-1" />
                    </div>

                    <!-- Role Desc -->
                    <div class="grid grid-cols-12 items-center gap-2">
                        <label for="role_desc" class="col-span-3 text-left">Role Desc</label>
                        <x-text-input id="role_desc" name="role_desc" type="text"
                            class="col-span-9 mt-1 w-full"
                            value="{{ old('role_desc', $user->role_desc) }}" />
                        <x-input-error :messages="$errors->get('role_desc')" class="col-span-9 col-start-4 mt-1" />
                    </div>
                </div>

                <!-- Kolom Kanan -->
                <div class="space-y-4">
                    <!-- Password -->
                    <div>
                        <x-input-label for="password" :value="'Password (Kosongkan jika tidak diubah)'" />
                        <x-text-input id="password" name="password" type="password"
                            class="mt-1 block w-full"
                            placeholder="Biarkan kosong jika tidak diubah" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Konfirmasi Password -->
                    <div>
                        <x-input-label for="password_confirmation" :value="'Konfirmasi Password'" />
                        <x-text-input id="password_confirmation" name="password_confirmation" type="password"
                            class="mt-1 block w-full"
                            placeholder="Ulangi password jika diubah" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>
                </div>
            </div>

            <div class="mt-8 flex justify-between items-center">
                <a href="{{ route('users.index') }}"
                    class="px-4 py-2 rounded bg-red-600 text-white hover:bg-red-700">
                    Batal
                </a>
                <button type="submit"
                    class="px-4 py-2 rounded bg-blue-600 text-white hover:bg-blue-700">
                    Update
                </button>
            </div>
        </form>
    </div>
</x-app-layout>