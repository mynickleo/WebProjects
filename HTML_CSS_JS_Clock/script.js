let hourElement = document.querySelector(".hour");
let minuteElement = document.querySelector(".minute");
let secondElement = document.querySelector(".second");
let timeElement = document.querySelector(".time");
let dateElement = document.querySelector(".date");
let toggle = document.querySelector(".toggle");

let days = [
    "Sunday",
    "Monday",
    "Tuesday",
    "Wednesday",
    "Thursday",
    "Friday",
    "Saturday",
];

let months = [
    "Jan",
    "Feb",
    "Mar",
    "Apr",
    "May",
    "Jun",
    "Jul",
    "Aug",
    "Sep",
    "Oct",
    "Nov",
    "Dec",
];

toggle.addEventListener("click", (e) => {
    let html = document.querySelector("html");
    if(html.classList.contains("dark")){
        html.classList.remove("dark");
        e.target.innerHTML = "Dark mode";
    }
    else{
        html.classList.add("dark");
        e.target.innerHTML = "Light mode";
    }
});

let scale = (num, in_min, in_max, out_min, out_max) =>{
    return ((num - in_min) * (out_max - out_min)) / (in_max - in_min) + out_min;
};

let setTime = ()=>{
    let time = new Date();
    let date = time.getDate();
    let month = time.getMonth();
    let day = time.getDay();
    let hours = time.getHours();
    let hoursForClock = hours >= 13? hours % 12 : hours;
    let minutes = time.getMinutes();
    let seconds = time.getSeconds();
    let ampm = hours >= 12? "PM" : "AM";

    hourElement.style.transform = `translate(-50%, -100%) rotate(${scale(
        hoursForClock,
        0,
        11,
        0,
        360
    )}deg)`;
    
    minuteElement.style.transform = `translate(-50%, -100%) rotate(${scale(
        minutes,
        0,
        59,
        0,
        360
    )}deg)`;

    secondElement.style.transform = `translate(-50%, -100%) rotate(${scale(
        seconds,
        0,
        59,
        0,
        360
    )}deg)`;

    timeElement.innerHTML = `${hoursForClock}:${
        minutes < 10 ? `0${minutes}` : minutes
    } ${ampm}`;
    dateElement.innerHTML = `${days[day]}, ${months[month]} <span class = "circle">${date}</span>`;
};

setTime();

setInterval(setTime, 1000);