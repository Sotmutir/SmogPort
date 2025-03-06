

var LASER_COOLDOWN = 0.5;


const back = document.getElementById('back');
const cover = document.getElementById('cover');



var isRunning = false;
var isRunningMode = false;
var turretDeg = 0;
var speed = 1;
var playedSeconds = 0;
var planes = [];
var eliminated = 0;
var hearts = 3;
const eliminatedDisplay = document.getElementById('eliminated');
const lastScoreDisplay = document.getElementById('last-score');
const bestScoreDisplay = document.getElementById('best-score');
const play = document.getElementById('play');
const main = document.getElementById('main');
const turret = document.getElementById('turret');
const playArea = document.getElementById('play-area');
const progress = document.getElementById('progress');

setScores();





back.addEventListener('click', () => {
    cover.style.display = 'block';
    cover.classList.add('cover-ani');


    setTimeout(() => {
        if(!isRunningMode) window.location.href = 'index.php';
        else {
            cover.classList.remove('cover-ani');
            cover.classList.add('cover-ani-rev');

            stop();

            setTimeout(() => {
                cover.classList.remove('cover-ani-rev');
                cover.style.display = 'none';
            }, 500);
        }
    }, 500);
});



function stop() {
    playArea.style.display = 'none';
    
    back.innerText = "Powrót";
    play.innerText = 'Graj';

    isRunningMode = false;
    isRunning = false;

    hearts = 3;
    playedSeconds = 0;
    speed = 1;
    LASER_COOLDOWN = 0.5;

    fetch(`scripts/addTLPScore.php?score=${eliminated}`);
    eliminated = 0;

    setScores();
}


function setScores() {
    let display = false;
    fetch(`scripts/getTLPLastScore.php`).then(res => res.text()).then(data => {
        if(data && data != 'null') lastScoreDisplay.innerHTML = data;
        else display = true;
    });

    setTimeout(() => {
        fetch(`scripts/getTLPBestScore.php`).then(res => res.text()).then(data => {
            if(data && data != 'null') bestScoreDisplay.innerHTML = data;
            else display = true;
        });
    }, 10);

    displayIntroduction(display);
}


function displayIntroduction(toDisplay) {
    if(toDisplay) {document.getElementById('introduction-col').style.display = 'initial';
        document.getElementById('best-score-col').style.display = 'none';
        document.getElementById('last-score-col').style.display = 'none';
    } else {
        document.getElementById('introduction-col').style.display = 'none';
        document.getElementById('best-score-col').style.display = 'initial';
        document.getElementById('last-score-col').style.display = 'initial';
    }
}




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
    eliminated = 0;
    hearts = 3;
    playedSeconds = 0;
    speed = 1;
    LASER_COOLDOWN = 0.5;


    eliminatedDisplay.innerText = eliminated;

    document.getElementById('heart1').style.display = 'initial';
    document.getElementById('heart2').style.display = 'initial';
    document.getElementById('heart3').style.display = 'initial';
    

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
        else if(w < 100) w = 100;

        if(w <= 100) {
            progress.style.width = w + '%';
        }
    }, 10);


    const generatingInterval = setInterval(() => {
        if(!isRunningMode) {
            clearInterval(generatingInterval);
            return;
        }
        if(!isRunning) return;

        playedSeconds++;
        if(playedSeconds % 2 === 0) generatePlane();
        
        if(playedSeconds % 45 === 0) {
            speed += 0.3;
            if(LASER_COOLDOWN > 0.1) LASER_COOLDOWN -= 0.08;
            console.log(speed, LASER_COOLDOWN);
        }
    }, 1000);
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
            return;
        } else {
            a -= 8;
            beam.style.transform = `translateY(${a}px)`;
        }

        
        const newPlanes = [];
        for(let i = 0; i < planes.length; i++) {
            const plane = planes[i];
            
            if(czyNachodza(plane, beam)) {
                eliminated++;
                eliminatedDisplay.innerText = eliminated;

                playArea.removeChild(beam);
                playArea.removeChild(plane);
                clearInterval(movingInterval);
            } else {
                newPlanes.push(plane);
            }
        }
        planes = newPlanes;
    }, 10);
}


function generatePlane() {
    const element = document.createElement('img');
    element.src = 'img/planeWhite.svg';
    element.className = 'plane';
    element.style.left = 0 + 'px';

    const locY = Math.floor(Math.random() * (playArea.clientHeight - 50 - 500 - 25 + 1));
    element.style.top = locY + 'px';

    playArea.appendChild(element);
    planes.push(element);

    const movingInterval = setInterval(() => {
        if(!isRunningMode) {
            playArea.removeChild(element);
            clearInterval(movingInterval);
            return;
        }
        if(!planes.includes(element)) {
            clearInterval(movingInterval);
            return;
        }
        if(!isRunning) return;

        let a = parseFloat(element.style.left.replace('px', ""));

        if(a <= playArea.clientWidth) {
            a += speed;
            element.style.left = a + 'px';
        } else {
            hearts--;
            switch(hearts) {
                case 2: {
                    document.getElementById('heart1').style.display = 'none';
                    break;
                }
                case 1: {
                    document.getElementById('heart2').style.display = 'none';
                    break;
                }
                case 0: {
                    document.getElementById('heart3').style.display = 'none';
                    
                    isRunning = false;
                    isRunningMode = false;
                    
                    stop();

                    
                    main.style.display = 'flex';
                    main.classList.add('main-ani');
                    setTimeout(() => {
                        main.classList.remove('main-ani');
                    }, 300);

                    break;
                }
            }

            playArea.removeChild(element);
            clearInterval(movingInterval);
        }
    }, 10);
}



function czyNachodza(element1, element2) {
    const rect1 = element1.getBoundingClientRect();
    const rect2 = element2.getBoundingClientRect();

    // Sprawdzenie, czy elementy się przecinają
    return !(
        rect1.bottom < rect2.top || // rect1 jest powyżej rect2
        rect1.top > rect2.bottom || // rect1 jest poniżej rect2
        rect1.right < rect2.left || // rect1 jest na lewo od rect2
        rect1.left > rect2.right    // rect1 jest na prawo od rect2
    );
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