<x-app-layout>
    <div class="w-full h-screen px-4 py-6">
        <h1 class="text-xl font-bold mb-4">Tambah User</h1>

        <form method="POST" action="{{ route('users.store') }}" class="w-full min-h-screen bg-[#254D70] p-8 rounded shadow text-white">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Kolom Kiri -->
                <div class="space-y-4">
                    <!-- Full Name -->
                    <div class="grid grid-cols-12 items-center gap-2">
                        <label for="name" class="col-span-3 text-left">Full Name</label>
                        <x-text-input id="name" name="name" type="text"
                            class="col-span-9 mt-1 w-full border border-white bg-[#1e40af] text-white placeholder-white"
                            placeholder="Masukkan nama lengkap" :value="old('name')" required />
                    </div>

                    <!-- Employee ID -->
                    <div class="grid grid-cols-12 items-center gap-2">
                        <label for="employee_id" class="col-span-3 text-left">Employee ID</label>
                        <x-text-input id="employee_id" name="employee_id" type="text"
                            class="col-span-9 mt-1 w-full border border-white bg-[#1e40af] text-white placeholder-white"
                            placeholder="Masukkan ID karyawan" />
                    </div>

                    <!-- Email -->
                    <div class="grid grid-cols-12 items-center gap-2">
                        <label for="email" class="col-span-3 text-left">Email</label>
                        <x-text-input id="email" name="email" type="email"
                            class="col-span-9 mt-1 w-full border border-white bg-[#1e40af] text-white placeholder-white"
                            placeholder="Masukkan email" />
                    </div>

                    <!-- Company -->
                    <div class="grid grid-cols-12 items-center gap-2">
                        <label for="company" class="col-span-3 text-left">Company</label>
                        <x-text-input id="company" name="company" type="text"
                            class="col-span-9 mt-1 w-full border border-white bg-gray-500 text-white"
                            value="PP01 - Pinus Merah Abadi, PT" readonly />
                    </div>

                    <!-- Country -->
                    <div class="grid grid-cols-12 items-center gap-2">
                        <label for="country" class="col-span-3 text-left">Country</label>
                        <x-text-input id="country" name="country" type="text"
                            class="col-span-9 mt-1 w-full border border-white bg-gray-500 text-white"
                            value="ID - Indonesia" readonly />
                    </div>

                    <!-- Branch -->
                    <div class="grid grid-cols-12 items-center gap-2">
                        <label for="branch" class="col-span-3 text-left">Branch</label>
                        <x-text-input id="branch" name="branch" type="text"
                            class="col-span-9 mt-1 w-full border border-white bg-[#1e40af] text-white placeholder-white"
                            placeholder="Masukkan branch" />
                    </div>

                    <!-- Role -->
                    <div class="grid grid-cols-12 items-center gap-2">
                        <label for="role" class="col-span-3 text-left">Role</label>
                        <x-text-input id="role" name="role" type="text"
                            class="col-span-9 mt-1 w-full border border-white bg-gray-500 text-white"
                            value="Admin" readonly />
                    </div>

                    <!-- Role Desc -->
                    <div class="grid grid-cols-12 items-center gap-2">
                        <label for="role_desc" class="col-span-3 text-left">Role Desc</label>
                        <x-text-input id="role_desc" name="role_desc" type="text"
                            class="col-span-9 mt-1 w-full border border-white bg-[#1e40af] text-white placeholder-white"
                            placeholder="Deskripsi Role" />
                    </div>

                    <!-- User Marketing -->
                    <div class="grid grid-cols-12 items-center gap-2">
                        <label for="user_marketing" class="col-span-3 text-left">User Marketing</label>
                        <select id="user_marketing" name="user_marketing"
                            class="col-span-9 mt-1 w-full border border-white bg-[#1e40af] text-white">
                            <option value="No">No</option>
                            <option value="Yes">Yes</option>
                        </select>
                    </div>
                </div>

                <!-- Kolom Kanan -->
                <div class="space-y-4">
                    <!-- Password -->
                    <div>
                        <x-input-label for="password" :value="'Password'" class="text-white" />
                        <x-text-input id="password" name="password" type="password"
                            class="mt-1 block w-full border border-white bg-[#1e40af] text-white placeholder-white"
                            placeholder="Masukkan password" required />
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400" />
                    </div>

                    <!-- Konfirmasi Password -->
                    <div>
                        <x-input-label for="password_confirmation" :value="'Konfirmasi Password'" class="text-white" />
                        <x-text-input id="password_confirmation" name="password_confirmation" type="password"
                            class="mt-1 block w-full border border-white bg-[#1e40af] text-white placeholder-white"
                            placeholder="Ulangi password" required />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-400" />
                    </div>
                </div>
            </div>

            <!-- Tombol Simpan -->
            <div class="flex justify-end mt-8">
                <x-primary-button class="bg-indigo-700 hover:bg-indigo-800 text-white">
                    Simpan
                </x-primary-button>
            </div>
        </form>

    </div>
</x-app-layout>