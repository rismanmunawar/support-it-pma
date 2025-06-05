<nav x-data="{ openSubMenu: null }"
    class="w-56 h-screen bg-sidebar-light dark:bg-sidebar-dark border-r border-gray-200 dark:border-gray-700 flex flex-col"">

    <!-- Logo -->
    <div class=" h-16 flex items-center justify-center border-b border-gray-200 dark:border-gray-700">
    <a href="{{ route('dashboard') }}">
        <x-application-logo class="h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
    </a>
    </div>

    <!-- Menu -->
    <div class="flex-1 overflow-y-auto px-2 py-4 space-y-1">
        <!-- Dashboard -->
        <a href="{{ route('dashboard') }}"
            class="group flex items-center px-2 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 rounded-md hover:bg-gray-100 dark:hover:bg-gray-900">
            <svg class="mr-3 h-6 w-6 text-gray-400 group-hover:text-gray-500 dark:group-hover:text-gray-300"
                fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round"
                stroke-linejoin="round">
                <path d="M3 12l2-2m0 0l7-7 7 7M13 5v6h6" />
            </svg>
            Dashboard
        </a>
        <!-- Menu dengan submenu -->
        <div>
            <button @click="openSubMenu === 1 ? openSubMenu = null : openSubMenu = 1"
                class="w-full flex items-center justify-between px-2 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 rounded-md hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none">
                <div class="flex items-center">
                    <!-- Icon menu utama -->
                    <svg class="mr-3 h-6 w-6 text-gray-400 group-hover:text-gray-500 dark:group-hover:text-gray-300"
                        fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round"
                        stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10" />
                        <line x1="12" y1="8" x2="12" y2="12" />
                        <line x1="12" y1="16" x2="12" y2="16" />
                    </svg>
                    Menu Utama 1
                </div>
                <!-- Icon panah -->
                <svg :class="{ 'transform rotate-90': openSubMenu === 1 }"
                    class="h-5 w-5 text-gray-400 transition-transform duration-200" fill="none" stroke="currentColor"
                    stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M9 5l7 7-7 7" />
                </svg>
            </button>

            <!-- Submenu -->
            <div x-show="openSubMenu === 1" x-collapse class="pl-9 mt-1 space-y-1">
                <a href="#"
                    class="block px-2 py-1 text-sm text-gray-600 dark:text-gray-400 rounded-md hover:bg-gray-100 dark:hover:bg-gray-900">
                    Submenu 1-1
                </a>
                <a href="#"
                    class="block px-2 py-1 text-sm text-gray-600 dark:text-gray-400 rounded-md hover:bg-gray-100 dark:hover:bg-gray-900">
                    Submenu 1-2
                </a>
            </div>
        </div>

        <!-- Multilevel menu -->
        <div>
            <button @click="openSubMenu === 2 ? openSubMenu = null : openSubMenu = 2"
                class="w-full flex items-center justify-between px-2 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 rounded-md hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none">
                <div class="flex items-center">
                    <!-- Icon menu utama -->
                    <svg class="mr-3 h-6 w-6 text-gray-400 group-hover:text-gray-500 dark:group-hover:text-gray-300"
                        fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round"
                        stroke-linejoin="round">
                        <rect x="3" y="4" width="18" height="16" rx="2" ry="2" />
                        <line x1="3" y1="10" x2="21" y2="10" />
                    </svg>
                    Menu Multilevel
                </div>
                <svg :class="{ 'transform rotate-90': openSubMenu === 2 }"
                    class="h-5 w-5 text-gray-400 transition-transform duration-200" fill="none" stroke="currentColor"
                    stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M9 5l7 7-7 7" />
                </svg>
            </button>

            <!-- Submenu tingkat 1 -->
            <div x-show="openSubMenu === 2" x-collapse class="pl-9 mt-1 space-y-1">
                <a href="#"
                    class="block px-2 py-1 text-sm text-gray-600 dark:text-gray-400 rounded-md hover:bg-gray-100 dark:hover:bg-gray-900">
                    Submenu 2-1
                </a>

                <!-- Submenu tingkat 2 -->
                <div x-data="{ openInner: false }" class="space-y-1">
                    <button @click="openInner = !openInner"
                        class="w-full flex items-center justify-between px-2 py-1 text-sm text-gray-600 dark:text-gray-400 rounded-md hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none">
                        Submenu 2-2
                        <svg :class="{ 'transform rotate-90': openInner }"
                            class="h-4 w-4 transition-transform duration-200" fill="none" stroke="currentColor"
                            stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M9 5l7 7-7 7" />
                        </svg>
                    </button>

                    <div x-show="openInner" x-collapse class="pl-4 mt-1 space-y-1">
                        <a href="#"
                            class="block px-2 py-1 text-sm text-gray-600 dark:text-gray-400 rounded-md hover:bg-gray-100 dark:hover:bg-gray-900">
                            Submenu 2-2-1
                        </a>
                        <a href="#"
                            class="block px-2 py-1 text-sm text-gray-600 dark:text-gray-400 rounded-md hover:bg-gray-100 dark:hover:bg-gray-900">
                            Submenu 2-2-2
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Menu Authorization -->
        <div>
            <!-- Atur openSubMenu untuk membuka submenu -->
            <button @click="openSubMenu === 3 ? openSubMenu = null : openSubMenu = 3"
                class="w-full flex items-center justify-between px-2 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 rounded-md hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none">
                <div class="flex items-center">
                    <!-- Icon menu utama -->
                    <svg class="mr-3 h-6 w-6 fill-current text-gray-500 dark:text-white" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24">
                        <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                    </svg>

                    Authorization
                </div>
                <!-- Icon panah -->
                <svg :class="{ 'transform rotate-90': openSubMenu === 3 }"
                    class="h-5 w-5 text-gray-400 transition-transform duration-200" fill="none" stroke="currentColor"
                    stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M9 5l7 7-7 7" />
                </svg>
            </button>

            <!-- Submenu -->
            <div x-show="openSubMenu === 3" x-collapse class="pl-9 mt-1 space-y-1">
                <a href="{{ route('users.index') }}"
                    class="block px-2 py-1 text-sm text-gray-600 dark:text-gray-400 rounded-md hover:bg-gray-100 dark:hover:bg-gray-900">
                    Users
                </a>
                <!-- <a href="#"
                    class="block px-2 py-1 text-sm text-gray-600 dark:text-gray-400 rounded-md hover:bg-gray-100 dark:hover:bg-gray-900">
                    Submenu 1-2
                </a> -->
            </div>
        </div>
    </div>
</nav>