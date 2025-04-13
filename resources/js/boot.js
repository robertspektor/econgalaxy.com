document.addEventListener('alpine:init', () => {
    Alpine.data('bootScreen', () => ({
        showBoot: true,
        bootSteps: [
            '[Checking Hardware Integrity]... [OK]',
            '[Loading Core Modules]... [OK]',
            '[Fusion Reactor Online]... [OK]',
            '[Initializing Nebula OS v2.7.1]... [OK]',
            '[System Ready]... [WELCOME]'
        ],
        currentStep: -1,
        init() {
            if (this.showBoot) {
                this.currentStep = 0;
                this.showNextStep();
            }
        },
        showNextStep() {
            if (this.currentStep < this.bootSteps.length - 1) {
                this.currentStep++;
                setTimeout(() => this.showNextStep(), 1000);
            } else {
                setTimeout(() => {
                    this.$dispatch('boot:complete');
                }, 1000);
            }
        }
    }));
});
