// Código Javascript que gerencia os estados da Navbar

// Variável que calcula a largura da tela
const screenSize = window.innerWidth;
// Selecionando elementos html
let menuMobileDisabled = document.querySelector(".menuMobileDisabled");
let mobileDisplay = document.querySelector(".mobileDisplayDisabled");

// Toggle para trocar os items da Navbar pelo menu hambúrguer
if(screenSize <= 600){
    menuMobileDisabled.className = "menuMobileActive";
} else {
    menuMobileDisabled.className = "menuMobileDisabled";
}

// Função para abrir o display mobile
function openMobileDisplay(){
    menuMobileDisabled.className = "menuMobileDisabled";
    let closeMenu = document.querySelector(".menuMobileCloseDisabled");
    closeMenu.className = "menuMobileCloseActive";
    mobileDisplay.className = "mobileDisplayActive";
}

// Função para fechar o display mobile
function closeMobileDisplay(){
    let closeMenu = document.querySelector(".menuMobileCloseActive");
    closeMenu.className = "menuMobileCloseDisabled";
    menuMobileDisabled.className = "menuMobileActive";
    mobileDisplay.className = "mobileDisplayDisabled";
}