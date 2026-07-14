document.addEventListener('DOMContentLoaded', () => {
  // Mobile Navigation Toggle
  const navToggle = document.getElementById('nav-toggle');
  const mobileMenu = document.getElementById('mobile-menu');

  if (navToggle && mobileMenu) {
    navToggle.addEventListener('click', () => {
      const isOpen = mobileMenu.classList.contains('open');
      if (isOpen) {
        mobileMenu.classList.remove('open');
        navToggle.querySelector('i').className = 'fas fa-bars';
      } else {
        mobileMenu.classList.add('open');
        navToggle.querySelector('i').className = 'fas fa-times';
      }
    });
  }

  // Tutup dropdown jika klik link
  if (mobileMenu) {
    mobileMenu.querySelectorAll('a').forEach(link => {
      link.addEventListener('click', () => {
        mobileMenu.classList.remove('open');
        if (navToggle) navToggle.querySelector('i').className = 'fas fa-bars';
      });
    });
  }

  // Mobile Sub-menu Toggle (Accordion)
  const subToggles = document.querySelectorAll('.mobile-sub-toggle');
  subToggles.forEach(toggle => {
    toggle.addEventListener('click', () => {
      const subList = toggle.nextElementSibling;
      const icon = toggle.querySelector('.fa-chevron-down');

      if (subList) {
        subList.classList.toggle('open');
        if (icon) icon.style.transform = subList.classList.contains('open') ? 'rotate(180deg)' : '';
      }
    });
  });

  // Sticky Header on Scroll
  const navbar = document.getElementById('navbar');
  const topbar = document.getElementById('topbar');

  if (navbar) {
    window.addEventListener('scroll', () => {
      if (window.scrollY > 40) {
        navbar.classList.add('navbar-scrolled');
        if (topbar) topbar.classList.add('topbar-hidden');
      } else {
        navbar.classList.remove('navbar-scrolled');
        if (topbar) topbar.classList.remove('topbar-hidden');
      }
    });
  }

  // Hero Carousel Logic
  const track = document.getElementById('carousel-track');
  const prevBtn = document.getElementById('carousel-prev');
  const nextBtn = document.getElementById('carousel-next');

  if (track && prevBtn && nextBtn) {
    const slides = Array.from(track.children);
    let currentIndex = 0;

    const updateSlidePosition = () => {
      track.style.transform = `translateX(-${currentIndex * 100}%)`;
    };

    nextBtn.addEventListener('click', () => {
      currentIndex = currentIndex < slides.length - 1 ? currentIndex + 1 : 0;
      updateSlidePosition();
    });

    prevBtn.addEventListener('click', () => {
      currentIndex = currentIndex > 0 ? currentIndex - 1 : slides.length - 1;
      updateSlidePosition();
    });

    setInterval(() => {
      currentIndex = currentIndex < slides.length - 1 ? currentIndex + 1 : 0;
      updateSlidePosition();
    }, 7000);
  }
});
