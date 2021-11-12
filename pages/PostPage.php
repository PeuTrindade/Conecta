<?php

// Importações
require("../components/sideBar.php");
require("../backend/data.php");
require("../backend/Post.php");
require_once("../components/Navbar.php");
require("../components/Footer.php");

// Classes
$postPageNavbar = new Navbar("../../images/logo.svg","../../images/menumobile.svg","../../images/closeMenu.svg");
$postPageFooter = new Footer("../../images/insta.png","../../images/face.png");

// Variável que armazena o URL da página
$url = $_SERVER["REQUEST_URI"];

// Variável que armazena o ID do post contido na URL
$postID = explode("/",$url)[4];

// Variável que seleciona o post no array de posts através do index
$getPost = $data[$postID - 1];

// Enviando dados do post para a classe
$post = new Post(
    $getPost["title"],
    $getPost["image"],
    $getPost["text"],
    $getPost["author"],
    $getPost["category"],
    $getPost["coments"],
    $getPost["creationDate"],
    $getPost["updateDate"],
    $getPost["id"]
);

// Alterando o caminho da pasta de imagens
$newSrcImg = "../".".".$post -> image;

// Função para adicionar comentários
if(isset($_POST["sendComent"])){
    $text = $_POST["coment"];
    if($text){
       array_push($post -> coments,$text);
    } 
}

// Função para o filtro por título
if(isset($_POST["search_btn"])){
    $text = $_POST["title_search"];
    if($text){
        foreach ($data as $key => $value) {
            if($value["title"] === $text){
                $getPost = $data[$value["id"] - 1];
                $post = new Post(
                    $getPost["title"],
                    $getPost["image"],
                    $getPost["text"],
                    $getPost["author"],
                    $getPost["category"],
                    $getPost["coments"],
                    $getPost["creationDate"],
                    $getPost["updateDate"],
                    $getPost["id"]
                );
            }
        }
    }
}

// Alterando o caminho da pasta de imagens
$newSrcImg = "../".".".$post -> image;
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conecta</title>
    <link rel="stylesheet" href="../../css/header.css"></link>
    <link rel="stylesheet" href="../../css/post.css"></link>
    <link rel="stylesheet" href="../../css/footer.css"></link>
</head>
<body>
    <?php $postPageNavbar->showElement(); ?>
    <section class="postContainerAll">
        <section class="postContainer">
        <img class="postImg" src="<?php echo $newSrcImg; ?>"/>
        <h2><?php echo $post -> title; ?></h2>
        <p class="postCategory"><?php echo $post -> category; ?></p>
        <p class="postText"><?php echo $post -> text ?></p>
        <h3 class="postComentsTitle">Comentários:</h3>
        <div class="postComents">
            <?php 
                foreach ($post -> coments as $key => $value) {
                    if($value){ ?>
                     <div class="postComent">
                        <h3><?php echo $value; ?></h3>
                     </div> <?php     
                    } else { ?>
                        <p class="postAlert">Nenhum comentário</p>
                        <?php
                    }
                }
            ?>
        </div>
        <form action="" method="POST" class="formContainer">
            <h3>Adicione seu comentário</h3>
            <textarea name="coment"></textarea> <br>
            <button type="submit" name="sendComent">Enviar</button>
        </form>
        <div class="moreInfo">
            <p>Criado por <?php echo $post -> author; ?></p>
            <p>Criado em <?php echo $post -> creationDate; ?></p>
            <p>Atualizado em <?php echo $post -> updateDate; ?></p>
        </div>
        </section>
        <?php SideBar();  ?>
    </section>
    <?php $postPageFooter->showElement();  ?>

    <script src="../../javascript/navbar.js"></script>
    <script src="../../javascript/navigation.js"></script>
</body>
</html>