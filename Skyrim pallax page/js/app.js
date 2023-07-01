window.addEventListener('scroll', e =>{
    document.body.style.cssText += `--scrollTop: ${this.scrollY}px`;
})
gsap.registerPlugin(ScrollTrigger, ScrollSmoother)
ScrollSmoother.create({
    wrapper: '.wrapper',
    content: '.content'
})

var Months = ["Месяц Утренней звезды", "Месяц Восхода Солнца", "Месяц Первого зерна",
"Месяц Руки дождя", "Месяц Второго зерна", "Месяц Середины года", "Месяц Высокого солнца",
"Месяц Последнего зерна", "Месяц Огня очага", "Месяц Начала морозов", "Месяц Заката солнца",
"Месяц Вечерней звезды"];

var Days = ["Морндас", "Сандас", "Тирдас", "Миддас", "Турдас", "Фредас", "Лордас", "Сандас"];

let day = new Date();

let printdate_and_time = document.querySelector('#time');
function SetDate(){
printdate_and_time.innerHTML = day.getDate() + " " + Days[day.getDay()] + " " + Months[day.getMonth()];
}
SetDate();

class Clock{
    constructor({template}) {
        this.template = template;
    }

    timer;
    render(){
        let date = new Date();
        let hours = date.getHours();
        if(hours < 10) hours = "0" + hours;
        
        let mins = date.getMinutes();
        if(mins < 10) mins = "0" + mins;

        let secs = date.getSeconds();
        if(secs < 10) secs = "0" + secs;

        let output = this.template
        .replace("h", hours)
        .replace("m", mins)
        .replace("s", secs);

        printdate_and_time.textContent = output;
    }

    stop(){
        clearInterval(this.timer);
    }

    start(){
        this.render();
        this.timer = setInterval(() => this.render(), 1000); 
    }
}

let clock = new Clock({template: "h:m:s"});
printdate_and_time.addEventListener('mouseover', function() { printdate_and_time.classList.remove('copy_time_1'); printdate_and_time.classList.add('copy_time_2'); clock.start();});
printdate_and_time.addEventListener('mouseout', function() { printdate_and_time.classList.remove('copy_time_2'); printdate_and_time.classList.add('copy_time_1'); clock.stop(); SetDate();});

let footer_href = document.querySelector('#href_id');
footer_href.addEventListener('mouseover', function(){footer_href.classList.remove('footer_href'); footer_href.classList.add('footer_href_big');});
footer_href.addEventListener('mouseout', function(){footer_href.classList.remove('footer_href_big'); footer_href.classList.add('footer_href');});