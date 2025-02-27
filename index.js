
const header = document.querySelector('header');
const headerLoginBtn = document.querySelector('header .btn-black');
window.addEventListener('scroll', e => {
    if(window.scrollY > 0) {
        header.classList.add('header--scrolled');
        headerLoginBtn.classList.add('btn-white');
    } else {
        header.classList.remove('header--scrolled');
        headerLoginBtn.classList.remove('btn-white');
    }
});
window.addEventListener('load', e => {
    if(window.scrollY > 0) {
        header.classList.add('header--scrolled');
        headerLoginBtn.classList.add('btn-white');
    }
});