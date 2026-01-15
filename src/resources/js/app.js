import './bootstrap';

import Alpine from 'alpinejs';
window.Alpine = Alpine;

document.addEventListener('livewire:init', () => {
    Livewire.on('refresh-page', () => {
        window.location.reload();
    });
});
