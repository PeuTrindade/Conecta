<!-- Componente da Navbar -->

<!-- Importando o css da Navbar -->
<style>
    <?php include "../css/header.css"; ?>
</style>

<?php


function Navbar($src,$src2,$src3){
    echo "
    <header class='header'>
    <nav class='navbarDesktop'>
        <div class='brand'>
            <img src='$src'/>
            <h3>Conecta</h3>
        </div>
        <ul class='desktopItems'>
            <li><a href='/Conecta'>Home</a></li>
            <li><a href='/Conecta/#sobre'>Sobre nós</a></li>
            <li><a href='/Conecta/#contato'>Contato</a></li>
        </ul>
        <img onClick='openMobileDisplay()' class='menuMobileDisabled' src='$src2'/>
        <img onClick='closeMobileDisplay()' class='menuMobileCloseDisabled' src='$src3'/>
    </nav>
    <div class='mobileDisplayDisabled'>
    <img onClick='closeMobileDisplay()' class='menuMobileClose2Disabled' src='$src3'/>
        <ul class='mobileDisplayItems'>
            <li><a onClick='closeMobileDisplay()' href='/Conecta'>Home</a></li>
            <li><a onClick='closeMobileDisplay()' href='/Conecta/#sobre'>Sobre nós</a></li>
            <li><a onClick='closeMobileDisplay()' href='/Conecta/#contato'>Contato</a></li>
        </ul>
    </div>
</header>
    ";
}