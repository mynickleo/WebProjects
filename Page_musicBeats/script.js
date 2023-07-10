let menuToggle = document.querySelector(".toggle");
let showcase = document.querySelector(".showcase_section");

menuToggle.addEventListener("click", ()=>{
    menuToggle.classList.toggle("active");
    showcase.classList.toggle("active");
});