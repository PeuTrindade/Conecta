const screenSize = window.innerWidth;
let menuMobileDisabled = document.querySelector(".menuMobileDisabled");
let mobileDisplay = document.querySelector(".mobileDisplayDisabled");

if(screenSize <= 600){
    menuMobileDisabled.className = "menuMobileActive";
} else {
    menuMobileDisabled.className = "menuMobileDisabled";
}

function openMobileDisplay(){
    menuMobileDisabled.className = "menuMobileDisabled";
    let closeMenu = document.querySelector(".menuMobileCloseDisabled");
    closeMenu.className = "menuMobileCloseActive";
    mobileDisplay.className = "mobileDisplayActive";
}

function closeMobileDisplay(){
    let closeMenu = document.querySelector(".menuMobileCloseActive");
    closeMenu.className = "menuMobileCloseDisabled";
    menuMobileDisabled.className = "menuMobileActive";
    mobileDisplay.className = "mobileDisplayDisabled";
}