<?php

require_once("./php/Data.php");

?>


<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conecta</title>
    <link rel="stylesheet" href="./css/header.css"></link>
    <link rel="stylesheet" href="./css/body_1.css"></link>
    <link rel="stylesheet" href="./css/body_2.css"></link>
</head>
<body>
    <header class="header">
        <nav class="navbarDesktop">
            <div class="brand">
                <img src="./images/logo.svg" alt="logo"/>
                <h3>Conecta</h3>
            </div>
            <ul class="desktopItems">
                <li><a href="/Conecta">Home</a></li>
                <li><a href="/Conecta/sobre">Sobre nós</a></li>
                <li><a href="/Conecta/contato">Contato</a></li>
            </ul>
            <img onClick="openMobileDisplay()" class="menuMobileDisabled" src="./images/menumobile.svg"/>
            <img onClick="closeMobileDisplay()" class="menuMobileCloseDisabled" src="./images/closeMenu.svg"/>
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
    <section class="allContent">
    <section class="welcomeSection">
        <div class="textContainer">
            <h1>Olá, somos o Conecta</h1>
            <h3>Seu blog de notícias sobre Coworking e afins!</h3>
            <p>Ao contrário do que se acredita, Lorem Ipsum não é simplesmente um texto randômico. Com mais de 2000 anos, suas raízes podem ser encontradas em uma obra de literatura latina clássica datada de 45 AC. Richard McClintock, um professor de latim do Hampden-Sydney College na Virginia, pesquisou uma das mais obscuras palavras em latim, consectetur, oriunda de uma passagem de Lorem Ipsum, e, procurando por entre citações da palavra na literatura clássica, descobriu a sua indubitável origem. Lorem Ipsum vem das seções 1.10.32 e 1.10.33 do "de Finibus Bonorum et Malorum" (Os Extremos do Bem e do Mal), de Cícero, escrito em 45 AC. Este livro é um tratado de teoria da ética muito popular na época da Renascença. A primeira linha de Lorem Ipsum, "Lorem Ipsum dolor sit amet..." vem de uma linha na seção 1.10.32.</p>
        </div>
        <img src="./images/coworking1.jpg" alt="coworking_image"/>
    </section>
    <section class="postsContainer">
        <h2>Confira nossos posts</h2>
        <h3>Fique por dentro das novidades</h3>
        <img class="arrow" src="./images/arrow.svg" alt="arrow"/>
        <div class="posts">
            <?php   
                foreach ($data as $post => $value) { ?>
                <div id=<?php echo $value["id"];?> class="post">
                    <img src="<?php echo $value["image"];?>"/>
                    <div class="postInfo">
                        <h4><a href="/Conecta/Pages/Post.php/<?php echo $value["id"]; ?>"><?php echo $value["title"]; ?></a></h4>
                        <p>Criado em <?php echo $value["creationDate"]; ?></p>
                        <p>Atualizado em <?php echo $value["updateDate"]; ?></p>
                    </div>
                </div>
            <?php
                }
            ?>
        </div>
    </section>
    </section>

    <script src="./script.js"></script>
</body>
</html>