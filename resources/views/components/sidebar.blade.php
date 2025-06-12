<nav x-data="{
    openMenu: null,
    openSubMenus: {},
    toggleMainMenu(key) {
        this.openMenu = (this.openMenu === key) ? null : key;
    },
    isMainMenuOpen(key) {
        return this.openMenu === key;
    },
    toggleSubMenu(key) {
        this.openSubMenus[key] = !this.openSubMenus[key];
    },
    isSubMenuOpen(key) {
        return !!this.openSubMenus[key];
    },
    init() {
        const path = window.location.pathname;
        if (path.includes('/users')) this.openMenu = 'auth';
        if (path.includes('/menu-multilevel')) this.openMenu = 'multi';
    }
}" x-init="init()" data-turbolinks-permanent
    class="w-56 h-screen bg-sidebar-light dark:bg-sidebar-dark border-r border-gray-200 dark:border-gray-700 flex flex-col">

    <!-- Logo -->
    <div class="h-16 flex items-center justify-center border-b border-gray-200 dark:border-gray-700">
        <a href="{{ route('dashboard') }}">
            <x-application-logo class="h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
        </a>
    </div>

    <!-- Menu -->
    <!-- <div class="flex-1 overflow-y-auto px-2 py-4 space-y-1"> -->
    <div class="flex-1 px-2 py-4 space-y-1 min-h-screen md:max-h-screen overflow-y-auto">

        <!-- Dashboard -->
        <a href="{{ route('dashboard') }}"
            class="group flex items-center px-2 py-2 text-sm font-medium rounded-md
        {{ request()->routeIs('dashboard') 
            ? 'bg-active-light dark:bg-active-dark font-semibold'
            : 'hover:bg-menubg-light dark:hover:bg-menubg-dark' }}">

            <svg class="mr-3 h-6 w-6 
        {{ request()->routeIs('dashboard') 
            ? 'text-gray-900 dark:text-white' 
            : 'text-white group-hover:text-gray-900 dark:group-hover:text-white' }}"
                fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                stroke-linecap="round" stroke-linejoin="round">
                <path d="M3 12l2-2m0 0l7-7 7 7M13 5v6h6" />
            </svg>

            <span class="
        {{ request()->routeIs('dashboard') 
            ? 'text-gray-900 dark:text-white' 
            : 'text-white group-hover:text-gray-900 dark:group-hover:text-white' }}">
                Dashboard
            </span>
        </a>

        <a href="{{ route('pengumuman.index') }}"
            class="group flex items-center px-2 py-2 text-sm font-medium rounded-md
    {{ request()->routeIs('pengumuman.index') 
        ? 'bg-active-light dark:bg-active-dark font-semibold' 
        : 'hover:bg-menubg-light dark:hover:bg-menubg-dark' }}">

            <svg xmlns="http://www.w3.org/2000/svg"
                class="mr-3 h-6 w-6 
        {{ request()->routeIs('pengumuman.index') 
            ? 'text-gray-900 dark:text-white' 
            : 'text-white group-hover:text-gray-900 dark:group-hover:text-white' }}"
                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round">
                <path d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
            </svg>

            <span class="
        {{ request()->routeIs('pengumuman.index') 
            ? 'text-gray-900 dark:text-white' 
            : 'text-white group-hover:text-gray-900 dark:group-hover:text-white' }}">
                Pengumuman
            </span>
        </a>


        <!-- Menu Multilevel -->
        <div>
            <!-- MENU UTAMA -->
            <button @click="toggleMainMenu('multi')"
                class="group w-full flex items-center justify-between px-2 py-2 text-sm font-medium rounded-md
        {{ request()->is('menu-multilevel*') || request()->is('submenu1_1') || request()->is('submenu2*') 
            ? 'bg-active-light dark:bg-active-dark font-semibold' 
            : 'hover:bg-menubg-light dark:hover:bg-menubg-dark' }}">
                <div class="flex items-center">
                    <svg class="mr-3 h-6 w-6 
                {{ request()->is('menu-multilevel*') || request()->is('submenu1_1') || request()->is('submenu2*') 
                    ? 'text-gray-900 dark:text-white' 
                    : 'text-white group-hover:text-gray-900 dark:group-hover:text-white' }}"
                        fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                        stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="4" width="18" height="16" rx="2" ry="2" />
                        <line x1="3" y1="10" x2="21" y2="10" />
                    </svg>
                    <span class="{{ request()->is('menu-multilevel*') || request()->is('submenu1_1') || request()->is('submenu2*') 
                ? 'text-gray-900 dark:text-white' 
                : 'text-white group-hover:text-gray-900 dark:group-hover:text-white' }}">
                        Menu Multilevel
                    </span>
                </div>
                <svg :class="{ 'transform rotate-90': isMainMenuOpen('multi') }"
                    class="h-5 w-5 text-gray-400 transition-transform duration-200"
                    fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="M9 5l7 7-7 7" />
                </svg>
            </button>

            <!-- SUBMENUS -->
            <div
                x-show="isMainMenuOpen('multi') || '{{ request()->is('menu-multilevel*') || request()->is('submenu1_1') || request()->is('submenu2*') ? 'true' : 'false' }}' === 'true'"
                x-collapse class="pl-9 mt-1 space-y-1">

                <!-- SUBMENU 1 -->
                <a href="{{ url('/submenu1_1') }}"
                    class="group flex items-center px-2 py-2 text-sm rounded-md
            {{ request()->is('submenu1_1') 
                ? 'bg-active-light dark:bg-active-dark font-semibold' 
                : 'hover:bg-menubg-light dark:hover:bg-menubg-dark' }}">
                    <span class="{{ request()->is('submenu1_1') 
                ? 'text-gray-900 dark:text-white' 
                : 'text-white group-hover:text-gray-900 dark:group-hover:text-white' }}">
                        Submenu 1-1
                    </span>
                </a>

                <!-- SUBMENU 2 (DENGAN CHILDREN) -->
                <div>
                    <button @click="toggleSubMenu('multi.sub2')"
                        class="group w-full flex items-center justify-between px-2 py-2 text-sm rounded-md
                    {{ request()->is('submenu2*') 
                        ? 'bg-active-light dark:bg-active-dark font-semibold' 
                        : 'hover:bg-menubg-light dark:hover:bg-menubg-dark' }}">
                        <span class="{{ request()->is('submenu2*') 
                    ? 'text-gray-900 dark:text-white' 
                    : 'text-white group-hover:text-gray-900 dark:group-hover:text-white' }}">
                            Submenu 2
                        </span>
                        <svg :class="{ 'transform rotate-90': isSubMenuOpen('multi.sub2') }"
                            class="h-4 w-4 text-gray-400 transition-transform duration-200" fill="none"
                            stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M9 5l7 7-7 7" />
                        </svg>
                    </button>

                    <div
                        x-show="isSubMenuOpen('multi.sub2') || '{{ request()->is('submenu2*') ? 'true' : 'false' }}' === 'true'"
                        x-collapse class="pl-4 mt-1 space-y-1">

                        <a href="{{ url('submenu1') }}"
                            class="group flex items-center px-2 py-2 text-sm rounded-md
                        {{ request()->is('submenu1') 
                            ? 'bg-active-light dark:bg-active-dark font-semibold' 
                            : 'hover:bg-menubg-light dark:hover:bg-menubg-dark' }}">
                            <span class="{{ request()->is('submenu1') 
                        ? 'text-gray-900 dark:text-white' 
                        : 'text-white group-hover:text-gray-900 dark:group-hover:text-white' }}">
                                Submenu 2-1
                            </span>
                        </a>

                        <a href="{{ url('submenu2/2') }}"
                            class="group flex items-center px-2 py-2 text-sm rounded-md
                        {{ request()->is('submenu2/2') 
                            ? 'bg-active-light dark:bg-active-dark font-semibold' 
                            : 'hover:bg-menubg-light dark:hover:bg-menubg-dark' }}">
                            <span class="{{ request()->is('submenu2/2') 
                        ? 'text-gray-900 dark:text-white' 
                        : 'text-white group-hover:text-gray-900 dark:group-hover:text-white' }}">
                                Submenu 2-2
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <button @click="toggleMainMenu('auth')"
                class="group w-full flex items-center justify-between px-2 py-2 text-sm rounded-md
        {{ request()->is('users*') 
            ? 'bg-active-light dark:bg-active-dark font-semibold' 
            : 'hover:bg-menubg-light dark:hover:bg-menubg-dark' }}">
                <div class="flex items-center">
                    <svg class="mr-3 h-6 w-6 fill-current text-gray-500 dark:text-white"
                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                    </svg>
                    <span class="{{ request()->is('users*') 
                ? 'text-gray-900 dark:text-white' 
                : 'text-white group-hover:text-gray-900 dark:group-hover:text-white' }}">
                        Authorization
                    </span>
                </div>
                <svg :class="{ 'transform rotate-90': isMainMenuOpen('auth') }"
                    class="h-4 w-4 text-gray-400 transition-transform duration-200"
                    fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="M9 5l7 7-7 7" />
                </svg>
            </button>

            <div
                x-show="isMainMenuOpen('auth') || '{{ request()->is('users*') ? 'true' : 'false' }}' === 'true'"
                x-collapse
                class="pl-9 mt-1 space-y-1">
                <a href="{{ route('users.index') }}"
                    class="group flex items-center px-2 py-2 text-sm rounded-md
            {{ request()->routeIs('users.index') 
                ? 'bg-active-light dark:bg-active-dark font-semibold' 
                : 'hover:bg-menubg-light dark:hover:bg-menubg-dark' }}">
                    <span class="{{ request()->routeIs('users.index') 
                ? 'text-gray-900 dark:text-white' 
                : 'text-white group-hover:text-gray-900 dark:group-hover:text-white' }}">
                        Users
                    </span>
                </a>
            </div>
        </div>
        <!-- FAQ & Documentation -->
        <a href="{{ route('faq') }}"
            class="group flex items-center px-2 py-2 text-sm rounded-md
    {{ request()->routeIs('faq') 
        ? 'bg-active-light dark:bg-active-dark font-semibold' 
        : 'hover:bg-menubg-light dark:hover:bg-menubg-dark' }}">

            <!-- Question Mark Circle Icon -->
            <svg xmlns="http://www.w3.org/2000/svg"
                class="mr-3 h-6 w-6 text-gray-400 group-hover:text-gray-600 dark:text-gray-500 dark:group-hover:text-gray-300"
                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M8.227 9a3.001 3.001 0 115.546 2.042c-.572.884-1.226 1.241-1.773 1.648-.527.393-.846.93-.846 1.56M12 17h.01M12 3a9 9 0 100 18 9 9 0 000-18z" />
            </svg>

            <span class="{{ request()->routeIs('faq') 
        ? 'text-gray-900 dark:text-white' 
        : 'text-white group-hover:text-gray-900 dark:group-hover:text-white' }}">
                FAQ & Docs
            </span>
        </a>

    </div>
</nav>