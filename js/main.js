// Existing Carousel Functionality
const slides = document.querySelectorAll('.slide');
const dots = document.querySelectorAll('.dot');
let currentIndex = 0;

// Function to show a specific slide
function showSlide(index) {
    slides.forEach((slide, i) => {
        slide.classList.remove('active');
        dots[i].classList.remove('active');
    });
    slides[index].classList.add('active');
    dots[index].classList.add('active');
}

// Automatically switch slides
function autoSlide() {
    currentIndex = (currentIndex + 1) % slides.length;
    showSlide(currentIndex);
}

// Add event listeners for dots
dots.forEach((dot, index) => {
    dot.addEventListener('click', () => {
        currentIndex = index;
        showSlide(currentIndex);
    });
});

// Start auto-slide
setInterval(autoSlide, 4000); // Switch every 4 seconds

// Consolidated Carousel Change Function
const carouselItems = document.querySelectorAll('.carousel-item');

function changeSlide() {
    carouselItems.forEach((item, index) => {
        item.classList.remove('active');
        if (index === currentIndex) {
            item.classList.add('active');
        }
    });
    currentIndex = (currentIndex + 1) % carouselItems.length;
}

setInterval(changeSlide, 3000); // Change slide every 3 seconds

document.addEventListener("DOMContentLoaded", function () {
    const swiper = new Swiper('.swiper-container', {
        loop: true,
        slidesPerView: 3, // Show 3 images at a time
        spaceBetween: 15, // Space between images
        autoplay: {
            delay: 2000, // Switch every 2 seconds
            disableOnInteraction: false,
        },
        breakpoints: {
            0: {
                slidesPerView: 1, // Small screens: show 1 image
                spaceBetween: 10,
            },
            576: {
                slidesPerView: 2, // Tablets: show 2 images
                spaceBetween: 10,
            },
            768: {
                slidesPerView: 3, // Medium screens: show 3 images
                spaceBetween: 15,
            },
            1024: {
                slidesPerView: 4, // Large screens: show 4 images
                spaceBetween: 20,
            },
        },
    });
});



(function ($) {
    "use strict";

    // Initiate WOW.js for animations
    new WOW().init();

    // Back to top button with IntersectionObserver
    const backToTop = document.querySelector('.back-to-top');
    const header = document.querySelector('header');
    const observer = new IntersectionObserver(
        (entries) => {
            if (!entries[0].isIntersecting) {
                backToTop.classList.add('visible');
            } else {
                backToTop.classList.remove('visible');
            }
        },
        { threshold: 0.1 }
    );
    observer.observe(header); // Observe header visibility

    backToTop.addEventListener('click', () => {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });

    // Sticky Navbar with throttled scroll
    let lastScrollY = 0;
    const navbar = document.querySelector('.navbar');

    window.addEventListener('scroll', () => {
        if (window.scrollY > lastScrollY) {
            navbar.classList.add('nav-sticky');
        } else {
            navbar.classList.remove('nav-sticky');
        }
        lastScrollY = window.scrollY;
    });

    // Dropdown on mouse hover
    const dropdowns = document.querySelectorAll('.navbar .dropdown');
    if (window.innerWidth > 992) {
        dropdowns.forEach((dropdown) => {
            dropdown.addEventListener('mouseenter', () => {
                dropdown.classList.add('show');
            });
            dropdown.addEventListener('mouseleave', () => {
                dropdown.classList.remove('show');
            });
        });
    }

    // Testimonials carousel using OwlCarousel
    $(".testimonials-carousel").owlCarousel({
        center: true,
        autoplay: true,
        autoplayTimeout: 5000,
        dots: true,
        loop: true,
        responsive: {
            0: { items: 1 },
            768: { items: 2 },
            992: { items: 3 },
        },
    });

    // Blogs carousel with navigation
    $(".blog-carousel").owlCarousel({
        autoplay: true,
        autoplayTimeout: 5000,
        dots: false,
        loop: true,
        nav: true,
        navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
        responsive: {
            0: { items: 1 },
            768: { items: 2 },
            992: { items: 3 },
        },
    });

    // Class filter with CSS Grid
    const classItems = document.querySelectorAll('.class-item');
    const filterButtons = document.querySelectorAll('#class-filter li');

    filterButtons.forEach((button) => {
        button.addEventListener('click', () => {
            const activeFilter = document.querySelector('#class-filter .filter-active');
            activeFilter?.classList.remove('filter-active');
            button.classList.add('filter-active');

            const filter = button.dataset.filter;
            classItems.forEach((item) => {
                if (filter === '*' || item.matches(filter)) {
                    item.style.display = 'grid';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });

    // Portfolio filter with CSS Grid
    const portfolioItems = document.querySelectorAll('.portfolio-item');
    const portfolioButtons = document.querySelectorAll('#portfolio-filter li');

    portfolioButtons.forEach((button) => {
        button.addEventListener('click', () => {
            const activeFilter = document.querySelector('#portfolio-filter .filter-active');
            activeFilter?.classList.remove('filter-active');
            button.classList.add('filter-active');

            const filter = button.dataset.filter;
            portfolioItems.forEach((item) => {
                if (filter === '*' || item.matches(filter)) {
                    item.style.display = 'grid';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });
})(jQuery);
