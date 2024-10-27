import './bootstrap';

const load = function() {
    const div = document.getElementById("animatedDiv");
    if (!div) {
        return;
    }

    div.classList.remove("-translate-x-full");
    div.classList.add("translate-x-0");
};

window.onload = load;

document.addEventListener('livewire:navigated', () => {
    console.log('navigated');
    load();
});
