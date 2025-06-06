export function faqPage(data) {
    return {
        categories: data,
        openCategory: null,
        selectedContent: '<p>Silakan pilih topik dari menu di kiri.</p>',
        showScrollTopButton: false, // jangan lupa ini supaya reactive

        toggleCategory(index) {
            this.openCategory = this.openCategory === index ? null : index;
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
