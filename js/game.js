







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



animateMarker(document.getElementById('game'));






const theLastPlane = document.getElementById('the-last-plane');
const cover = document.getElementById('cover');
theLastPlane.addEventListener('click', () => {
    cover.style.display = 'block';
    cover.style.animationName = 'animateCover';

    setTimeout(() => {
        window.location.href = 'theLastPlane.php';
    }, 500);
});