<?php

class Navbar {
    public $logo;
    public $mobileMenu;
    public $closeIcon;

    function __construct($logo,$mobileMenu,$closeIcon) {
        $this->logo = $logo;
        $this->mobileMenu = $mobileMenu;
        $this->closeIcon = $closeIcon;
    }

    function showElement() {
        echo " 
        <header class='header'>
        <nav class='navbarDesktop'>
            <div class='brand'>
                <img src='$this->logo' alt='logo'/>
                <h3>Conecta</h3>
            </div>
            <ul class='desktopItems'>
                <li><a href='/Conecta'>Home</a></li>
                <li><a href='/Conecta/#sobre'>Sobre nós</a></li>
                <li><a href='/Conecta/#contato'>Contato</a></li>
            </ul>
            <img onClick='openMobileDisplay()' class='menuMobileDisabled' src='$this->mobileMenu'/>
            <img onClick='closeMobileDisplay()' class='menuMobileCloseDisabled' src='$this->closeIcon'/>
        </nav>
        <div class='mobileDisplayDisabled'>
        <img onClick='closeMobileDisplay()' class='menuMobileClose2Disabled' src='$this->closeIcon'/>
            <ul class='mobileDisplayItems'>
                <li><a onClick='closeMobileDisplay()' href='/Conecta'>Home</a></li>
                <li><a onClick='closeMobileDisplay()' href='/Conecta/#sobre'>Sobre nós</a></li>
                <li><a onClick='closeMobileDisplay()' href='/Conecta/#contato'>Contato</a></li>
            </ul>
        </div>
    </header> ";
    }
}