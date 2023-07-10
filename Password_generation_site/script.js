let outputPassword = document.getElementById("output");
let buttonGenerate = document.getElementById("buttonGenerate");
let clipboard = document.getElementById("clipboard");

let settingLength = document.getElementById("length");
let settingNumbers = document.getElementById("numbers");
let settingSymbols = document.getElementById("symbols");


function getRandomChar(){
    return String.fromCharCode(Math.floor(Math.random() * 26) + 97);
}

function getRandomNumber(){
    let numbers = "1234567890";
    return numbers[Math.floor(Math.random() * numbers.length)]; 
}

function getRandomSymbol(){
    let symbols = "!@#$%^&*(){}[]=<>/";
    return symbols[Math.floor(Math.random() * symbols.length)];
}

function createNotification(message){
    let notification = document.createElement("div");
    notification.classList.add("message");
    notification.innerText = message;
    document.body.appendChild(notification);
    setTimeout(() => notification.remove(), 3000);
}

function getRandomValue(min, max){
    return Math.floor(Math.random() * (max - min) + min);
}

function generatePassword(settingLength, settingNumbers, settingSymbols){
    let countFunction = 1;
    let arrayFunction = [getRandomChar];
    if(settingNumbers.checked == true){
        countFunction++;
        arrayFunction.push(getRandomNumber);
    }
    if(settingSymbols.checked == true){
        countFunction++;
        arrayFunction.push(getRandomSymbol);
    }

    let randomValue = 0;
    let generatedPassword = "";
    for(let i = 0; i < settingLength.value; i++){
        randomValue = getRandomValue(0, countFunction);
        generatedPassword += arrayFunction[randomValue]();
    }
    let finalPassword = generatedPassword.slice(0, settingLength.length);
    return finalPassword;
}

buttonGenerate.addEventListener("click", () =>{
    outputPassword.innerText = generatePassword(settingLength, settingNumbers, settingSymbols);
})

clipboard.addEventListener("click", ()=>{
    let password = outputPassword.innerText;
    if (!password) return;

    let textArea = document.createElement("textarea");
    textArea.value = password;
    document.body.appendChild(textArea);
    textArea.select();
    document.execCommand("copy");
    textArea.remove();
    createNotification("Password copied to clipboard");
})
