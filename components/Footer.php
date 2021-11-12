<?php

class Footer {
    public $instagramImage;
    public $facebookImage;

    function __construct($instagramImage,$facebookImage) {
        $this->instagramImage = $instagramImage;
        $this->facebookImage = $facebookImage;
    }

    function showElement() {
        echo "  
        <footer id='contato' class='footerContainer'>
        <div class='firstInfo'>
            <div class='local'>
                <h3>Localização</h3>
                <p>Feira de Santana,BA</p>
                <p>Rua Exemplo, 15</p>
            </div>
            <div class='contato'>
                <h3>Contato</h3>
                <p>(75)99999-9999</p>
                <p>3333-3333</p>
            </div>
        </div>
        <div class='secondInfo'>
            <div class='socialMedia'>
                <h3>Redes sociais</h3>
                <div class='insta'><img src='$this->instagramImage'/> <span>@conecta</span></div>
                <div class='face'><img src='$this->facebookImage'/> <span>conecta_blog</span></div>
            </div>
            <div class='rights'>
                <p>@Todos direitos reservados</p>
            </div>
        </div>
    </footer>
        ";
    }
}