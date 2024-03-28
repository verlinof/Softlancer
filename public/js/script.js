// Navbar Fixed
window.onscroll = function() {
    const header = document.querySelector('header');
    const fixedNav = header.offsetTop;

    if (window.pageYOffset > fixedNav) {
        header.classList.add('navbar-fixed');
    } else {
        header.classList.remove('navbar-fixed');
    }
};

// Hamburger
const hamburger = document.querySelector('#hamburger');
const navMenu = document.querySelector('#nav-menu');

hamburger.addEventListener('click', function() {
    hamburger.classList.toggle('is-active');
    navMenu.classList.toggle('hidden');
});

document.querySelectorAll('.pagination-button').forEach(button => {
    button.addEventListener('click', () => {
      // Ganti slide atau halaman sesuai tombol yang ditekan
      // Misalnya, dapat menggunakan transform: translateX() untuk menggeser slide
    });
  });