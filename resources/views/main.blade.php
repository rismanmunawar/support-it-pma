<x-app-layout>
    <div x-data="faqPage(@js($categories))" class="px-4 py-6 flex-1 flex flex-col no-scrollbar relative">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">FAQ & Docs</h1>
        </div>

        <div class="flex space-x-4 flex-1">
            <!-- Sidebar -->
            <div x-ref="sidebarScroll"
                class="w-2/6 bg-white dark:bg-gray-800 p-4 rounded shadow max-h-screen overflow-y-auto no-scrollbar">
                <template x-for="(category, index) in categories" :key="index">
                    <div class="mb-4">
                        <button @click="toggleCategory(index)"
                            class="w-full text-left font-semibold text-gray-800 dark:text-white hover:underline mb-2">
                            <span x-text="category.name"></span>
                        </button>
                        <div x-show="openCategory === index" x-transition>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <template x-for="(item, i) in category.items" :key="i">
                                    <div @click="selectedContent = item.content"
                                        class="cursor-pointer bg-gray-100 dark:bg-gray-700 rounded-lg shadow p-4 hover:bg-gray-200 dark:hover:bg-gray-600 transition">
                                        <img :src="item.image || '{{ asset('images/sample/Group 404.png') }}'" alt=""
                                            class="w-full h-32 object-cover rounded mb-2">
                                        <h3 class="text-sm font-semibold text-gray-800 dark:text-white" x-text="item.title"></h3>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>
                </template>
            </div>

            <!-- Main content -->
            <div x-ref="contentScroll" @scroll="checkScroll()"
                class="w-4/6 bg-white dark:bg-gray-800 p-6 rounded shadow max-h-screen overflow-y-auto text-gray-900 dark:text-gray-100 no-scrollbar relative">
                <div x-html="selectedContent"></div>

                <!-- Scroll to top button -->
                <button
                    x-show="showScrollTopButton"
                    @click="scrollToTop()"
                    class="fixed bottom-6 right-6 bg-blue-600 bg-opacity-70 hover:bg-opacity-100 text-white p-3 rounded-full shadow-lg transition-opacity"
                    style="display: none;"
                    aria-label="Scroll to top">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7" />
                    </svg>
                </button>


            </div>
        </div>
    </div>
</x-app-layout>