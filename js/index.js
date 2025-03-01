



    // /|--------------------------------------------------------|\
    // ||>              HANDLING THE SCROLL EVENTS              <||
    // ||> Changing the header and managing the current section <||
    // \|--------------------------------------------------------|/


window.location.href = '#main';

var currSection = 'home';
document.getElementById(currSection).style.marginLeft = '37px';

const header = document.querySelector('header');
const headerLoginBtn = document.querySelector('header .btn-black');
const headerMarker = document.getElementById('headerMarker');
var headerMarkerLeft = 0;
headerMarker.style.marginLeft = headerMarkerLeft + 'px';
headerMarker.style.marginTop = 22.5 + 'px';

const navs = {
    home: 0,
    aboutUs: 1,
    contact: 2,
    flights: 3,
    game: 4
};

const animateMarker = (to) => {
    const from = document.getElementById(currSection);
    
    to.style.marginLeft = '37px';
    from.style.marginLeft = '0px';

    if(navs[currSection] < navs[to.id]) {
        let d = 0;
        Object.keys(navs).slice(navs[currSection], navs[to.id]).forEach(key => d+=document.getElementById(key).clientWidth + 32);

        headerMarkerLeft += d;
        headerMarker.style.marginLeft = headerMarkerLeft + 'px';
    } else {
        let d2 = 0;
        Object.keys(navs).slice(navs[to.id], navs[currSection]).forEach(key => d2 += document.getElementById(key).clientWidth + 32);

        headerMarkerLeft -= d2;
        headerMarker.style.marginLeft = headerMarkerLeft + 'px';
    }
};

const handleScroll = e => {
    if(window.scrollY > 0) {
        header.classList.add('header--scrolled');
        headerLoginBtn.classList.add('btn-white');
    } else {
        header.classList.remove('header--scrolled');
        headerLoginBtn.classList.remove('btn-white');
    }


    if(window.scrollY >= 0 && window.scrollY < window.innerHeight / 2.0 && currSection !== 'home') {
        animateMarker(document.getElementById('home'));
        currSection = 'home';
    } else if(window.scrollY >= window.innerHeight / 2.0 && window.scrollY < window.innerHeight * 2 + window.innerHeight / 4.0 && currSection !== 'aboutUs') {
        animateMarker(document.getElementById('aboutUs'));
        currSection = 'aboutUs';
    }  else if(window.scrollY >= window.innerHeight * 2 + window.innerHeight / 4.0 && currSection !== 'contact') {
        animateMarker(document.getElementById('contact'));
        currSection = 'contact';
    }
};

window.addEventListener('scroll', handleScroll);
window.addEventListener('load', handleScroll);

document.getElementById('aboutUs').addEventListener('click', e => {
    setTimeout(() => {
        window.scrollTo(0, window.innerHeight);
    }, 10);
});