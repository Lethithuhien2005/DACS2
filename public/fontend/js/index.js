// js for navbar when user scrolling
window.addEventListener('scroll', function() {
    var navbar = document.querySelector('.navbar');
    if (window.scrollY > 50) {
        navbar.classList.add('scrolled');
    } else {
        navbar.classList.remove('scrolled');
    }
});

// transiting effect img
$('.header-container').owlCarousel({
    loop:true,
    margin:10,
    nav:false,
    autoplay: true,
    autoplayTimeout: 4000,
    autoplaySpeed: 1500,
    dotSpeed: 1500,
    autoplayHoverPause: true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:1
        },
        1000:{
            items:1
        }
    }
})
//Hide or display input search:
document.addEventListener('DOMContentLoaded', function () {
    const searchBtn = document.querySelector('.search-container .btn');
    const searchInput = document.querySelector('.search-container .form-control');

    searchBtn.addEventListener('click', function() {
        if (window.innerWidth >= 767 && window.innerWidth <= 899) {
            searchInput.style.display = searchInput.style.display === 'none' || searchInput.style.display === '' ? 'block' : 'none';
        }
    });
});

// transiting best-seller img
$('.best-seller-card').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
    autoplay: true,
    autoplayTimeout: 3000,
    autoplaySpeed: 1500,
    dotSpeed: 1500,
    autoplayHoverPause: true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:2
        },
        1000:{
            items:3
        }
    }
})
