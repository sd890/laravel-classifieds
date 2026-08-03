document.getElementById('menuToggle').addEventListener('click', function() {
    const nav = document.getElementById('mainNav');
    if (nav.style.display === 'block') {
        nav.style.display = 'none';
    } else {
        nav.style.display = 'block';
    }
});
