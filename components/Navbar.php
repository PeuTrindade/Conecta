<?php

class Navbar {
    public $logo;
    public $mobileMenu;
    public $closeIcon;
    public $homePath;
    public $aboutPath;
    public $contactPath;

    function __construct($logo,$mobileMenu,$closeIcon,$homePath,$aboutPath = null,$contactPath = null) {
        $this->logo = $logo;
        $this->mobileMenu = $mobileMenu;
        $this->closeIcon = $closeIcon;
        $this->homePath = $homePath;
        $this->aboutPath = $aboutPath;
        $this->contactPath = $contactPath;
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
                <li><a href='$this->homePath'>Home</a></li>
                <li id='about'><a href='$this->aboutPath'>Sobre nós</a></li>
                <li id='contact'><a href='$this->contactPath'>Contato</a></li>
            </ul>
            <img onClick='openMobileDisplay()' class='menuMobileDisabled' src='$this->mobileMenu'/>
            <img onClick='closeMobileDisplay()' class='menuMobileCloseDisabled' src='$this->closeIcon'/>
        </nav>
        <div class='mobileDisplayDisabled'>
        <img onClick='closeMobileDisplay()' class='menuMobileClose2Disabled' src='$this->closeIcon'/>
            <ul class='mobileDisplayItems'>
                <li><a onClick='closeMobileDisplay()' href='$this->homePath'>Home</a></li>
                <li id='aboutMobile'><a onClick='closeMobileDisplay()' href='$this->aboutPath'>Sobre nós</a></li>
                <li id='contactMobile'><a onClick='closeMobileDisplay()' href='$this->contactPath'>Contato</a></li>
            </ul>
        </div>
    </header> ";
    }
}