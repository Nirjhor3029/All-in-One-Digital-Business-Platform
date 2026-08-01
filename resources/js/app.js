import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
    const nav = document.querySelector('nav');
    if (nav) {
        window.addEventListener('scroll', () => {
            nav.classList.toggle('shadow-sm', window.scrollY > 50);
        });
    }

    const roadmapCards = document.querySelectorAll('.stage-card');
    if (roadmapCards.length) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('opacity-100', 'translate-y-0');
                    entry.target.classList.remove('opacity-0', 'translate-y-8');
                }
            });
        }, { threshold: 0.2 });

        roadmapCards.forEach((card) => {
            card.classList.add('opacity-0', 'translate-y-8', 'transition-all', 'duration-700');
            observer.observe(card);
        });
    }
});
