<?php

//Importações
require_once("./backend/data.php");
require("./backend/Post.php");
require("./components/Navbar.php");
require("./components/Banner.php");
require("./components/Footer.php");

// Classes
$navbarHomePage = new Navbar("./images/logo.svg","./images/menumobile.svg","./images/closeMenu.svg");
$welcomeBanner = new Banner("Olá, somos o Conecta","Seu blog de notícias sobre Coworking e afins!","Ao contrário do que se acredita, Lorem Ipsum não é simplesmente um texto randômico. Com mais de 2000 anos, suas raízes podem ser encontradas em uma obra de literatura latina clássica datada de 45 AC. Richard McClintock, um professor de latim do Hampden-Sydney College na Virginia, pesquisou uma das mais obscuras palavras em latim, consectetur, oriunda de uma passagem de Lorem Ipsum, e, procurando por entre citações da palavra na literatura clássica, descobriu a sua indubitável origem. Lorem Ipsum vem das seções 1.10.32 e 1.10.33 do 'de Finibus Bonorum et Malorum' (Os Extremos do Bem e do Mal), de Cícero, escrito em 45 AC. Este livro é um tratado de teoria da ética muito popular na época da Renascença. A primeira linha de Lorem Ipsum, 'Lorem Ipsum dolor sit amet...' vem de uma linha na seção 1.10.32.","./images/coworking1.jpg","welcomeSection","textContainer","coworkingImg");
$aboutBanner = new Banner("Conheça um pouco mais sobre o Conecta","Nossa história e nossa missão","Ao contrário do que se acredita, Lorem Ipsum não é simplesmente um texto randômico. Com mais de 2000 anos, suas raízes podem ser encontradas em uma obra de literatura latina clássica datada de 45 AC. Richard McClintock, um professor de latim do Hampden-Sydney College na Virginia, pesquisou uma das mais obscuras palavras em latim, consectetur, oriunda de uma passagem de Lorem Ipsum, e, procurando por entre citações da palavra na literatura clássica, descobriu a sua indubitável origem. Lorem Ipsum vem das seções 1.10.32 e 1.10.33 do 'de Finibus Bonorum et Malorum' (Os Extremos do Bem e do Mal), de Cícero, escrito em 45 AC. Este livro é um tratado de teoria da ética muito popular na época da Renascença. A primeira linha de Lorem Ipsum, 'Lorem Ipsum dolor sit amet...' vem de uma linha na seção 1.10.32.","./images/coworking3.jpg","aboutContainer","aboutText","aboutUsImg");
$footerHome = new Footer("./images/insta.png","./images/face.png");

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
                $post = new Post (
                    $value["title"],
                    $value["image"],
                    $value["text"],
                    $value["author"],
                    $value["category"],
                    $value["coments"],
                    $value["creationDate"],
                    $value["updateDate"],
                    $value["id"],
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
   if($tag && $tag === "Empreendedorismo" || $tag === "Trabalho" || $tag === "Tecnologia"){
        $filterByTitle = false;
        $filterByTags = true;
        $filterTags = $tag;
    }
}

$max = 5;
$min = 0;

if($url !== "/Conecta/"){
    $tag = explode("?",$url)[1];
    if($tag !== "NaN"){
    if($tag && $tag !== "Empreendedorismo" && $tag !== "Trabalho" && $tag !== "Tecnologia"){
        $max = 5 * $tag;
        $min = $max - 5;
    }
    }
}

// Número de posts salvos
$dataLength = count($data);

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
    <link rel="stylesheet" href="./css/body_3.css"></link>
    <link rel="stylesheet" href="./css/footer.css"></link>
</head>
<body>
    <?php $navbarHomePage->showElement(); ?>
    <section class="allContent">
    <?php $welcomeBanner->showElement(); ?>
    <section class="postsContainer">
        <h2>Confira nossos posts</h2>
        <h3>Fique por dentro das novidades</h3>
        <img class="arrow" src="./images/arrow.svg" alt="arrow"/>
        <div class="content">
        <div class="posts">
            <?php  
                if(!$filterByTitle && !$filterByTags){
                foreach ($data as $key => $value) { 
                if($key >= $min && $key < $max) {?>
                <div id=<?php echo $value["id"];?> class="post">
                    <img src="<?php echo $value["image"];?>"/>
                    <div class="postInfo">
                        <h4><a href="/Conecta/Pages/PostPage.php/<?php echo $value["id"]; ?>"><?php echo $value["title"]; ?></a></h4>
                        <p>Criado em <?php echo $value["creationDate"]; ?></p>
                        <p>Atualizado em <?php echo $value["updateDate"]; ?></p>
                    </div>
                </div> <?php 
                }
                ?>
            <?php
                }
                } else if($filterByTitle && !$filterByTags) {
                    $post->filterByTitle();
                ?>
            <?php  
                }
                else if(!$filterByTitle && $filterByTags){
                    foreach ($data as $key => $value) {
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
                <li><a id="tag1" class="tag" href="/Conecta/?Empreendedorismo">Empreendedorismo</a></li>
                <li><a id="tag2" class="tag" href="/Conecta/?Tecnologia">Tecnologia</a></li>
                <li><a id="tag3" class="tag" href="/Conecta/?Trabalho">Trabalho</a></li>
            </ul>
        </div>
        </div>
        <ul class="pages">
            <input id="dataLength" value=<?php echo $dataLength; ?> type="hidden"/>
            <li onClick="handleLeft()" class="leftArrow"><</li>
            <div id="pageNavigation">
                <li id="1" class="pageDisabled"><a href="/Conecta/?1">1</a></li>
            </div>
            <li onClick="handleRight()" class="rightArrow">></li>
        </ul>
    </section>
    <?php $aboutBanner->showElement(); ?>
    <section class="addPostPage">
        <h2>Quer compartilhar alguma novidade?</h2>
        <h3>Publique artigos sobre Empreendedorismo, Tecnologia e Trabalho!</h3>
        <a href="/Conecta/pages/addPost.php">Quero Publicar</a>
    </section>
    <?php $footerHome->showElement(); ?>
    </section>

    <script src="./javascript/navbar.js"></script>
    <script src="./javascript/navigation.js"></script>
</body>
</html>