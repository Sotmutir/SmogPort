







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



animateMarker(document.getElementById('flights'));




const cover = document.getElementById('cover');


function reserve(id) {
    let el = document.getElementById(id + "");

    if(el.innerHTML !== "Odwołaj rezerwację") {
        fetch(`scripts/reserveFlight.php?id=${id}`);

        el.innerHTML = "Odwołaj rezerwację";
        el.classList.add('btn-white');
        el.classList.remove('btn-blue');
    }
    else {
        fetch(`scripts/removeReservedFlight.php?id=${id}`);

        el.innerHTML = "Zarezerwuj";
        el.classList.add('btn-blue');
        el.classList.remove('btn-white');
    }
}



const main = document.getElementById('main');

const airline = document.getElementById('airline');
const destination = document.getElementById('destination');
const date = document.getElementById('date');

airline.addEventListener('change', e => {
    let s = "?";
    if(airline.selectedIndex >= 1) s += "airline=" + airline.options[airline.selectedIndex].innerHTML;
    if(destination.selectedIndex >= 1) {
        if(s.length > 1) s += "&";
        s += "destination=" + destination.options[destination.selectedIndex].innerHTML;
    }
    if(date.value) {
        if(s.length > 1) s += "&";

        let parts = date.value.split('-');
        let final = parts[2] + '.' + parts[1] + '.' + parts[0];
        s += "date=" + final;
    }

    fetch('scripts/getFlights.php' + s).then(res => res.text()).then(data => {
        main.innerHTML = data;
    });
});

destination.addEventListener('change', e => {
    let s = "?";
    if(airline.selectedIndex >= 1) s += "airline=" + airline.options[airline.selectedIndex].innerHTML;
    if(destination.selectedIndex >= 1) {
        if(s.length > 1) s += "&";
        s += "destination=" + destination.options[destination.selectedIndex].innerHTML;
    }
    if(date.value) {
        if(s.length > 1) s += "&";

        let parts = date.value.split('-');
        let final = parts[2] + '.' + parts[1] + '.' + parts[0];
        s += "date=" + final;
    }


    fetch('scripts/getFlights.php' + s).then(res => res.text()).then(data => {
        main.innerHTML = data;
    });
});

date.addEventListener('change', e => {
    let s = "?";
    if(airline.selectedIndex >= 1) s += "airline=" + airline.options[airline.selectedIndex].innerHTML;
    if(destination.selectedIndex >= 1) {
        if(s.length > 1) s += "&";
        s += "destination=" + destination.options[destination.selectedIndex].innerHTML;
    }
    if(date.value) {
        if(s.length > 1) s += "&";

        let parts = date.value.split('-');
        let final = parts[2] + '.' + parts[1] + '.' + parts[0];
        s += "date=" + final;
    }


    fetch('scripts/getFlights.php' + s).then(res => res.text()).then(data => {
        main.innerHTML = data;
    });
});