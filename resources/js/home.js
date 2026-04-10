document.querySelectorAll('.burger-dots button').forEach((btn, i, all) => {
    btn.addEventListener('click', () => {
        all.forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
    });
});
