function openLightbox(src) {
    const lightbox = document.getElementById('lightbox');
    const img = document.getElementById('lightbox-img');
    img.src = src;
    lightbox.classList.add('active');
    document.body.style.overflow = 'hidden';
}

function closeLightbox() {
    document.getElementById('lightbox').classList.remove('active');
    document.body.style.overflow = 'auto';
}

// Keyboard close
document.addEventListener('keydown', e => {
    if (e.key === 'Escape') closeLightbox();
});

// Navbar scroll ke galeri
document.querySelectorAll('a[href="#galeri"]').forEach(link => {
    link.addEventListener('click', e => {
        e.preventDefault();
        document.querySelector('#galeri').scrollIntoView({behavior: 'smooth'});
    });
});