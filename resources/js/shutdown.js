document.addEventListener('alpine:init', () => {
    Alpine.data('shutdownScreen', () => ({
        showShutdown: false,
        init() {
            // Sicherstellen, dass showShutdown initialisiert ist
            this.showShutdown = false;
            this.$watch('showShutdown', (value) => {
                if (value) {
                    setTimeout(() => {
                        this.$dispatch('shutdown:complete');
                    }, 1000);
                }
            });
        }
    }));
});
