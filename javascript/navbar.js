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
    document.body.style = "overflow-y: hidden"
    menuMobileDisabled.className = "menuMobileDisabled";
    let closeMenu = document.querySelector(".menuMobileCloseDisabled");
    closeMenu.className = "menuMobileCloseActive";
    mobileDisplay.className = "mobileDisplayActive";
}

// Função para fechar o display mobile
function closeMobileDisplay(){
    document.body.style = "overflow-y: auto"
    let closeMenu = document.querySelector(".menuMobileCloseActive");
    closeMenu.className = "menuMobileCloseDisabled";
    menuMobileDisabled.className = "menuMobileActive";
    mobileDisplay.className = "mobileDisplayDisabled";
}


if(window.location.pathname !== "/Conecta/") {
    const aboutItem = document.getElementById("about");
    const contactItem = document.getElementById("contact");
    const aboutItemMobile = document.getElementById("aboutMobile");
    const contactItemMobile = document.getElementById("contactMobile");

    aboutItem.style = "display:none";
    contactItem.style = "display:none";
    aboutItemMobile.style = "display:none";
    contactItemMobile.style = "display:none";
}