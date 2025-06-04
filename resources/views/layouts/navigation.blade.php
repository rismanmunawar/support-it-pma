<div x-data="{ sidebarOpen: window.innerWidth >= 768 }" @resize.window="sidebarOpen = window.innerWidth >= 768 ? true : false"
    class="flex h-screen bg-gray-100 dark:bg-gray-900 relative">

    <!-- Sidebar -->
    <nav x-show="sidebarOpen" x-transition:enter="transition transform duration-300"
        x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
        x-transition:leave="transition transform duration-300" x-transition:leave-start="translate-x-0"
        x-transition:leave-end="-translate-x-full"
        class="fixed inset-y-0 left-0 w-56 bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700 z-50 flex flex-col">
        @include('components.sidebar')
    </nav>

    <!-- Overlay (mobile only) -->
    <div x-show="sidebarOpen && window.innerWidth < 768" x-transition.opacity @click="sidebarOpen = false"
        class="fixed inset-0 bg-black bg-opacity-40 z-40 md:hidden"></div>

    <!-- Main content -->
    <div :class="sidebarOpen && window.innerWidth >= 768 ? 'ml-56' : 'ml-0'"
        class="flex-1 flex flex-col transition-all duration-300 relative z-10">

        <!-- Top Navbar -->
        <header class="bg-white dark:bg-gray-800 shadow flex items-center px-4 h-16 justify-between">
            <div class="flex items-center">
                <!-- Toggle Button -->
                <button @click="sidebarOpen = !sidebarOpen"
                    class="mr-2 p-2 rounded hover:bg-gray-300 dark:hover:bg-gray-700 focus:outline-none focus:ring focus:ring-gray-500"
                    aria-label="Toggle sidebar">
                    <svg class="h-6 w-6 text-gray-700 dark:text-gray-200" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
                <h1 class="text-xl font-bold text-gray-800 dark:text-white">Dashboard</h1>
            </div>

            <!-- User Dropdown -->
            <div class="flex items-center ml-4 md:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="flex items-center text-sm font-medium text-gray-500 dark:text-gray-300 hover:text-gray-700 dark:hover:text-white focus:outline-none transition duration-150 ease-in-out">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 011.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </header>

        <!-- Page Content -->
        <main class="flex-1 p-6 overflow-auto">
            {{ $slot }}
        </main>
    </div>
</div>
