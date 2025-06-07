<x-app-layout>
    <div x-data="faqPage(@js($categories))" class="px-4 py-6 flex-1 flex flex-col no-scrollbar relative">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">FAQ & Docs</h1>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow max-h-screen overflow-hidden flex flex-1">
            <!-- Sidebar (2/6) -->
            <div x-ref="sidebarScroll"
                class="w-2/6 p-4 overflow-y-auto no-scrollbar border-r border-gray-200 dark:border-gray-700">

                <template x-for="(category, index) in categories" :key="index">
                    <div class="mb-4">
                        <!-- Category Title -->
                        <div @click="toggleCategory(index)"
                            class="cursor-pointer text-gray-800 dark:text-white font-semibold mb-2 hover:underline transition">
                            <span x-text="category.name"></span>
                        </div>

                        <!-- Category Items -->
                        <div
                            x-show="openCategory === index"
                            x-transition:enter="transition-all ease-out duration-200"
                            x-transition:enter-start="opacity-0 -translate-y-2"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition-all ease-in duration-150"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 -translate-y-2"
                            class="pl-4 border-l border-gray-300 dark:border-gray-600">

                            <template x-for="(item, i) in category.items" :key="i">
                                <div>
                                    <!-- Item (can open subitems) -->
                                    <div
                                        @click="selectItem(category, item, index, i)"
                                        class="cursor-pointer flex justify-between items-center py-2 text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 transition">
                                        <span x-text="item.title"></span>
                                    </div>

                                    <!-- Subitems -->
                                    <div
                                        x-show="openSubitem && openSubitem.categoryIndex === index && openSubitem.itemIndex === i"
                                        x-transition
                                        class="pl-4 border-l border-gray-400 dark:border-gray-600">
                                        <template x-for="(subitem, si) in item.subitems" :key="si">
                                            <div
                                                @click="selectSubItem(subitem)"
                                                class="cursor-pointer py-1 text-gray-600 dark:text-gray-400 hover:text-blue-500 dark:hover:text-blue-300 transition">
                                                <span x-text="subitem.title"></span>
                                            </div>
                                        </template>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                </template>
            </div>

            <!-- Main content (4/6) -->
            <div x-ref="contentScroll" @scroll="checkScroll()"
                class="w-4/6 p-6 overflow-y-auto no-scrollbar text-gray-900 dark:text-gray-100 relative">
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