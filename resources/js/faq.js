export function faqPage(data) {
    return {
        categories: data,
        openCategory: null,
        openSubitem: null,
        selectedContent: '<p>Silakan pilih topik dari menu di kiri.</p>',
        showScrollTopButton: false,

        toggleCategory(index) {
            // Buka/tutup kategori
            this.openCategory = this.openCategory === index ? null : index;
            // Reset subitem agar tidak terbuka otomatis
            this.openSubitem = null;
        },

        toggleSubitem(categoryIndex, itemIndex) {
            const isSame = this.openSubitem &&
                this.openSubitem.categoryIndex === categoryIndex &&
                this.openSubitem.itemIndex === itemIndex;

            this.openSubitem = isSame ? null : { categoryIndex, itemIndex };
        },

        selectItem(category, item, categoryIndex, itemIndex) {
            if (item.subitems && item.subitems.length > 0) {
                // Toggle subitem jika punya
                this.toggleSubitem(categoryIndex, itemIndex);
            } else {
                // Tampilkan konten langsung jika tidak ada subitems
                this.selectedContent = item.content || '<p>Tidak ada konten.</p>';
                this.openSubitem = null;
            }
        },

        selectSubItem(subitem) {
            this.selectedContent = subitem.content || '<p>Tidak ada konten.</p>';
        },

        checkScroll() {
            const scrollEl = this.$refs.contentScroll;
            this.showScrollTopButton = scrollEl.scrollTop > 100;
        },

        scrollToTop() {
            this.$refs.contentScroll.scrollTo({ top: 0, behavior: 'smooth' });
        }
    };
}
