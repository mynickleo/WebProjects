let button = document.getElementById("btn");
let jokeText = document.getElementById("joke");

let lastJokeIndex = 0;

let arrayJokes = ["Can a kangaroo jump higher than a house? <br>-<br>Of Course, a house doesn't jump at all", 
                "Dentist: You need a crown <br>-<br>Patient: Finally someone who understand me", 
                "It has four legs and it can fly, what is it? <br>-<br>A pair of birds"];

function getRandom(min, max){
    return Math.floor(Math.random() * (max - min) + min);
}

function getJokes(){
    let rand = getRandom(0, arrayJokes.length);
    while(lastJokeIndex == rand){
        rand = getRandom(0, arrayJokes.length);
    }
    lastJokeIndex = rand;
    
    jokeText.innerHTML = arrayJokes[rand];
}

button.addEventListener('click', function(){getJokes();});