let current = 0;
const total      = window.totalProduits;
const track      = document.getElementById('slider-track');
const dots       = document.querySelectorAll('.dot');
const miniatures = document.querySelectorAll('.miniature');

function updateSlider() {
    track.style.transform = `translateX(-${current * 100}%)`;

    dots.forEach((dot, i) => {
        if (i === current) {
            dot.classList.add('bg-[#c17f3a]', 'w-6');
            dot.classList.remove('bg-gray-300');
        } else {
            dot.classList.remove('bg-[#c17f3a]', 'w-6');
            dot.classList.add('bg-gray-300');
        }
    });

    miniatures.forEach((m, i) => {
        if (i === current) {
            m.classList.add('border-[#c17f3a]');
        } else {
            m.classList.remove('border-[#c17f3a]');
        }
    });
}

function nextSlide() {
    current = (current + 1) % total;
    updateSlider();
}

function prevSlide() {
    current = (current - 1 + total) % total;
    updateSlider();
}

function goToSlide(index) {
    current = index;
    updateSlider();
}

setInterval(nextSlide, 4000);
