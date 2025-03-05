

const LASER_COOLDOWN = 0.5;


const back = document.getElementById('back');
const cover = document.getElementById('cover');



var isRunning = false;
var isRunningMode = false;
var turretDeg = 0;
var speed = 2;
const play = document.getElementById('play');
const main = document.getElementById('main');
const turret = document.getElementById('turret');
const playArea = document.getElementById('play-area');
const progress = document.getElementById('progress');





back.addEventListener('click', () => {
    cover.style.display = 'block';
    cover.classList.add('cover-ani');


    setTimeout(() => {
        if(!isRunningMode) window.location.href = 'game.php';
        else {
            back.innerText = "Powrót";
            play.innerText = 'Graj';

            cover.classList.remove('cover-ani');
            cover.classList.add('cover-ani-rev');

            playArea.style.display = 'none';

            isRunningMode = false;
            isRunning = false;

            setTimeout(() => {
                cover.classList.remove('cover-ani-rev');
                cover.style.display = 'none';
            }, 500);
        }
    }, 500);
});




var menuOpened = false;
window.addEventListener('keydown', e => {
    if(e.key === 'Escape') {
        if(!menuOpened) {
            isRunning = false;
    
            main.style.display = 'flex';
            main.classList.add('main-ani');

            setTimeout(() => {
                main.classList.remove('main-ani');
            }, 300);
        } else {
            main.classList.add('main-ani-rev');

            setTimeout(() => {
                isRunning = true;
                main.classList.remove('main-ani-rev');
                main.style.display = 'none'; 
            }, 300);
        }

        menuOpened = !menuOpened;
    }
});



function start() {
    main.style.animationPlayState = 'running';
    progress.style.width = '0%';
    playArea.style.display = 'flex';

    back.innerText = "Powrót do menu";
    play.innerText = 'Konntynuuj';

    main.style.animationDirection = 'normal';
    main.style.animationPlayState = 'running';


    const chargeInterval = setInterval(() => {
        if(!isRunningMode) clearInterval(chargeInterval);
        if(!isRunning) return;

        let w = parseInt(progress.style.width.replace('%', ''));
        if(w + 1 / LASER_COOLDOWN <= 100) w += 1 / LASER_COOLDOWN;
        if(w <= 100) progress.style.width = w + '%';
    }, 10);


    generatePlane();
};



function fire() {
    if(!isRunning) return;

    progress.style.width = '0%';

    const deg = turretDeg;
    const beam = document.createElement('img');
    beam.src = 'img/beam.svg';
    beam.className= 'beam';
    beam.style.transform = 'translateY(0px)';

    beam.style.rotate = deg + 'deg';
    playArea.appendChild(beam);

    const movingInterval = setInterval(() => {
        if(!isRunningMode) {
            playArea.removeChild(beam);
            clearInterval(movingInterval);
        }
        if(!isRunning) return;
        
        
        let a = beam.style.transform;
        a = a.replace('translateY(', "");
        a = a.replace('px)', "");
        a = parseInt(a);

        let max = Math.sqrt(Math.pow(window.innerHeight, 2) + Math.pow((window.innerWidth / 2), 2)) * (-1);
        if(a <= max) {
            playArea.removeChild(beam);
            clearInterval(movingInterval);
        } else {
            a -= 5;
            beam.style.transform = `translateY(${a}px)`;
        }
    }, 10);
}


function generatePlane() {
    const element = document.createElement('img');
    element.src = 'img/planeWhite.svg';
    element.className = 'plane';
    element.style.transform = 'translateY(0px)';

    const locY = Math.floor(Math.random() * (playArea.clientHeight - 50 - 500 - 25 + 1));
    element.style.top = 100 + 'px';

    playArea.appendChild(element);

    const movingInterval = setInterval(() => {
        let a = element.style.transform;
        a = a.replace('translateY(', "");
        a = a.replace('px)', "");
        a = parseInt(a);

        console.log(a + " | " + playArea.clientWidth);

        if(a * (-1) <= playArea.clientWidth) {
            a -= speed;
            element.style.transform = `translateY(${a}px)`;
        } else {
            console.log('plane del')
            playArea.removeChild(element);
            clearInterval(movingInterval);
        }
    }, 10);
}





play.addEventListener('click', e => {
    if(isRunningMode) main.classList.add('main-ani-rev');
    else main.classList.add('main-ani');

    setTimeout(() => {
        if(isRunningMode) main.classList.remove('main-ani-rev');
        else main.classList.remove('main-ani');

        main.style.display = 'none';
        if(isRunningMode) menuOpened = !menuOpened;

        isRunning = true;
        isRunningMode = true;

        start();


        window.addEventListener('mousemove', e => {
            if(!isRunning) return;
            
            let input;
            input = (window.innerHeight - e.y) / (window.innerWidth / 2 - e.x);

            let rad = Math.atan(input);
            let deg = (rad * 180) / Math.PI - 90;

            if(e.x > window.innerWidth / 2) deg += 180;

            turret.style.rotate = deg + "deg";
            turretDeg = deg;
        });


        window.addEventListener('click', e => {
            if(!isRunning) return;
            
            if(parseInt(progress.style.width.replace('%', '')) >= 100) fire();
        });
    }, 300);
});