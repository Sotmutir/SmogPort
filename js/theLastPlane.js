

const back = document.getElementById('back');
const cover = document.getElementById('cover');
back.addEventListener('click', () => {
    cover.style.display = 'block';
    cover.style.animationName = 'animateCover';

    setTimeout(() => {
        window.location.href = 'game.php';
    }, 500);
});























var isRunning = false;
var turretDeg = 0;
const play = document.getElementById('play');
const main = document.getElementById('main');
const turret = document.getElementById('turret');
const playArea = document.getElementById('play-area');
const progress = document.getElementById('progress');



{
    let menuOpened = false;
    window.addEventListener('keydown', e => {
        if(e.key === 'Escape') {
            if(!menuOpened) {
                isRunning = false;
        
                main.style.display = 'flex'; 
            } else {
                isRunning = true;
        
                main.style.display = 'none'; 
            }

            menuOpened = !menuOpened;
        }
    });
}



function start() {
    main.style.animationPlayState = 'running';
    progress.style.width = '0%';
    playArea.style.display = 'flex';

    back.innerText = "Powrót do menu";
    play.innerText = 'Poddaj się';

    main.style.animationDirection = 'normal';
    main.style.animationPlayState = 'running';


    const chargeInterval = setInterval(() => {
        if(!isRunning) return;

        let w = parseInt(progress.style.width.replace('%', ''));
        w += 2;
        if(w <= 100) progress.style.width = w + '%';
    }, 10);
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





play.addEventListener('click', e => {
    setTimeout(() => {
        main.style.display = 'none';
        isRunning = true;

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