<?php

//Importações

require_once("./backend/Data.php");
require("./backend/FilterByTitle_class.php");

// Variável onde recebe informações do post
$post = null;

// Estados para o sistema saber quais filtros deve realizar
$filterByTitle = false;
$filterByTags = false;

// Variável para mostrar qual o filtro está ativo
$filterTags = null;

// Função para o filtro por título
if(isset($_POST["search_btn"])){
    $text = $_POST["title_search"];

    if($text){
        foreach ($data as $key => $value) {
            if($value["title"] === $text){
                $filterByTitle = true;
                $filterTags = $text;
                $post = new FilterByTitle(
                    $value["id"],
                    $value["title"],
                    $value["image"],
                    $value["creationDate"],
                    $value["updateDate"]
                );
            }
        }
    }
}

// Função para deletar os filtros e mostrar todos os posts
if(isset($_POST["deleteFilter"])){
    $post = null;
    $filterByTitle = false;
    $filterTags = null;
    $filterByTags = false;
    header("Location: /Conecta/");
}

// Variável que armazena a URL da página
$url = $_SERVER["REQUEST_URI"];

// Função para o filtro por categorias
if($url !== "/Conecta/"){
   $tag = explode("?",$url)[1]; 
   if($tag){
        $filterByTitle = false;
        $filterByTags = true;
        $filterTags = $tag;
    }
}

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
        <div class="content">
        <div class="posts">
            <?php  
                if(!$filterByTitle && !$filterByTags){
                foreach ($data as $post => $value) { ?>
                <div id=<?php echo $value["id"];?> class="post">
                    <img src="<?php echo $value["image"];?>"/>
                    <div class="postInfo">
                        <h4><a href="/Conecta/Pages/PostPage.php/<?php echo $value["id"]; ?>"><?php echo $value["title"]; ?></a></h4>
                        <p>Criado em <?php echo $value["creationDate"]; ?></p>
                        <p>Atualizado em <?php echo $value["updateDate"]; ?></p>
                    </div>
                </div>
            <?php
                }
                } else if($filterByTitle && !$filterByTags) { ?>
                <div id=<?php echo $post -> id;?> class="post">
                    <img src="<?php echo $post -> image;?>"/>
                    <div class="postInfo">
                        <h4><a href="/Conecta/Pages/PostPage.php/<?php echo $post -> id; ?>"><?php echo $post -> title; ?></a></h4>
                        <p>Criado em <?php echo $post -> creationDate; ?></p>
                        <p>Atualizado em <?php echo $post -> updateDate; ?></p>
                    </div>
                </div>
            <?php  
                }
                else if(!$filterByTitle && $filterByTags){
                    foreach ($data as $post => $value) {
                        if($value["category"] === $tag){ ?>
                        <div id=<?php echo $value["id"];?> class="post">
                            <img src="<?php echo $value["image"];?>"/>
                            <div class="postInfo">
                                <h4><a href="/Conecta/Pages/PostPage.php/<?php echo $value["id"]; ?>"><?php echo $value["title"]; ?></a></h4>
                                <p>Criado em <?php echo $value["creationDate"]; ?></p>
                                <p>Atualizado em <?php echo $value["updateDate"]; ?></p>
                            </div>
                        </div> <?php }
                    }
                }
            ?>
        </div>
        <div class="sideBar">
            <form action="" method="POST" class="search">
                <input name="title_search" type="text" placeholder="Busque por um título"/> <br>
                <button name="search_btn" type="submit">Pesquisar</button>
            </form>
            <?php  
                if($filterTags){ ?>
                <form class="filterTags" action="" method="POST">
                    <h4><?php echo $filterTags; ?></h4>
                    <button name="deleteFilter" type="submit">Deletar</button>
                </form>
            <?php }
            ?>
            <h3>Tags</h3>
            <ul class="tags">
                <li><a href="/Conecta/?Empreendedorismo">Empreendedorismo</a></li>
                <li><a href="/Conecta/?Tecnologia">Tecnologia</a></li>
                <li><a href="/Conecta/?Trabalho">Trabalho</a></li>
            </ul>
        </div>
        </div>
        <ul class="pages">
            <li class="pageActive">1</li>
            <li class="pageDisabled">2</li>
            <li class="pageDisabled">3</li>
        </ul>
    </section>
    </section>

    <script src="./script.js"></script>
</body>
</html>