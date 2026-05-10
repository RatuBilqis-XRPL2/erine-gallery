// Smooth Scroll Navigation
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener("click", function(e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute("href"));
        if (target) {
            target.scrollIntoView({
                behavior: "smooth",
                block: "start"
            });
        }
    });
});

// Navbar Scroll Effect
window.addEventListener('scroll', () => {
    const navbar = document.querySelector('.navbar');
    if (window.scrollY > 50) {
        navbar.style.background = 'rgba(17, 17, 17, 0.98)';
        navbar.style.boxShadow = '0 2px 20px rgba(0,0,0,0.2)';
    } else {
        navbar.style.background = 'rgba(17, 17, 17, 0.95)';
        navbar.style.boxShadow = 'none';
    }
});

// Active Navbar Link on Scroll
window.addEventListener('scroll', () => {
    const sections = document.querySelectorAll('section');
    const navLinks = document.querySelectorAll('.nav-link');
    
    let current = '';
    sections.forEach(section => {
        const sectionTop = section.offsetTop;
        const sectionHeight = section.clientHeight;
        if (scrollY >= (sectionTop - 200)) {
            current = section.getAttribute('id');
        }
    });

    navLinks.forEach(link => {
        link.classList.remove('active');
        if (link.getAttribute('href') === `#${current}`) {
            link.classList.add('active');
        }
    });
});

// Gallery Filter Functionality
const kategoriCards = document.querySelectorAll('.kategori-card');
const galleryPhotos = document.getElementById('gallery-photos');

// Load all photos initially
document.addEventListener('DOMContentLoaded', () => {
    loadGalleryPhotos('all');
});

// Function to load gallery photos
function loadGalleryPhotos(category) {
    // Simulate loading (ganti dengan AJAX nanti)
    setTimeout(() => {
        galleryPhotos.innerHTML = `
            <div class="loading">Loading photos...</div>
        `;
        
        // Demo photos - ganti dengan data real dari PHP
        const demoPhotos = getDemoPhotos(category);
        displayPhotos(demoPhotos);
    }, 500);
}

function getDemoPhotos(category) {
    const photos = {
        'daily': [
            {title: 'Hijab Daily', image: 'assets/img/daily1.jpg'},
            {title: 'Rambut Ayam', image: 'assets/img/daily2.jpg'}
        ],
        'fancam': [
            {title: 'Stage Performance', image: 'assets/img/erine2.jpg'}
        ],
        'friends': [
            {title: 'With JKT48 Members', image: 'assets/img/erine3.jpg'}
        ],
        'official_photobook': [
            {title: 'Official Photobook', image: 'assets/img/erine5.jpg'}
        ],
        'official_onair': [
            {title: 'TV Appearance', image: 'assets/img/erine6.jpg'}
        ]
    };
    return photos[category] || [];
}

function displayPhotos(photos) {
    if (photos.length === 0) {
        galleryPhotos.innerHTML = '<p style="text-align:center; color:#666;">Belum ada foto di kategori ini.</p>';
        return;
    }
    
    galleryPhotos.innerHTML = photos.map(photo => `
        <div class="photo-card">
            <img src="${photo.image}" alt="${photo.title}" loading="lazy">
            <div class="photo-info">
                <h4>${photo.title}</h4>
            </div>
        </div>
    `).join('');
}

// Intersection Observer untuk animasi scroll
const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.style.opacity = '1';
            entry.target.style.transform = 'translateY(0)';
        }
    });
}, observerOptions);

// Observe all sections and cards
document.querySelectorAll('.section, .kategori-card, .photo-card').forEach(el => {
    el.style.opacity = '0';
    el.style.transform = 'translateY(30px)';
    el.style.transition = 'all 0.6s ease';
    observer.observe(el);
});