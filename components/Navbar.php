<?php

function Navbar(){
    echo "
    <header class=\"header\">
    <nav class=\"navbarDesktop\">
        <div class=\"brand\">
            <img src=\"./images/logo.svg" alt="logo\"/>
            <h3>Conecta</h3>
        </div>
        <ul class=\"desktopItems\">
            <li><a href=\"/Conecta\">Home</a></li>
            <li><a href=\"/Conecta/sobre\">Sobre nós</a></li>
            <li><a href=\"/Conecta/contato\">Contato</a></li>
        </ul>
        <img onClick=\"openMobileDisplay()\" class=\"menuMobileDisabled\" src=\"./images/menumobile.svg\"/>
        <img onClick=\"closeMobileDisplay()\" class=\"menuMobileCloseDisabled\" src=\"./images/closeMenu.svg\"/>
    </nav>
    <div class="mobileDisplayDisabled">
    <img onClick="closeMobileDisplay()" class="menuMobileClose2Disabled" src="./images/closeMenu.svg"/>
        <ul class="mobileDisplayItems">
            <li><a href="/Conecta">Home</a></li>
            <li><a href="/Conecta/sobre">Sobre nós</a></li>
            <li><a href="/Conecta/contato">Contato</a></li>
        </ul>
    </div>
</header>
    ";
}