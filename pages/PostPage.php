<?php

// Importações
require("../components/sideBar.php");
require("../backend/Post.php");
require_once("../components/Navbar.php");
require("../components/Footer.php");
include("../backend/DbConnection.php");
include("../backend/Coment.php");

// Classes
$postPageNavbar = new Navbar("../../images/logo.svg","../../images/menumobile.svg","../../images/closeMenu.svg","../../","../../#sobre","../../#contato");
$postPageFooter = new Footer("../../images/insta.png","../../images/face.png");

// Variável que armazena o URL da página
$url = $_SERVER["REQUEST_URI"];

// Variável que armazena o ID do post contido na URL
$urlArray = explode("/",$url);
$urlLastIndex = array_key_last($urlArray);
$postId = $urlArray[$urlLastIndex];

$filteredPostArray = DbConnection::getPostByid($postId);
$firstIndexFilteredPost = array_key_first($filteredPostArray);
$filteredPostItem = $filteredPostArray[$firstIndexFilteredPost];

$post = new Post(
    $filteredPostItem["title"],
    $filteredPostItem["text"],
    $filteredPostItem["author"],
    $filteredPostItem["category"],
    $filteredPostItem["image"],
    $filteredPostItem["creationDate"],
    $filteredPostItem["updateDate"],
    $postId,
);

//Função para adicionar comentários
if(isset($_POST["sendComent"])){
    $text = $_POST["coment"];
    if($text){
       $coment = new Coment(
            $postId,
            $text,
            "admin"
       );
       $coment->generateComent();
    } 
}

// Função para pegar comentários
$coments = Coment::getComent($postId);

//Função para o filtro por título
if(isset($_POST["search_btn"])){
    $text = $_POST["title_search"];
    if($text){
        $data = DbConnection::getPostsByTitle($text);
    }
}

// Função para deletar um post 
if(isset($_POST["deletePost"])){
   $post->deletePost();
}

?>
<script>
    if(localStorage["redirect"]){
        window.location.href = localStorage["redirect"];
    }

    function handleDeleteClick(){
        localStorage["redirect"] = "../../";
    }
</script>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conecta</title>
    <link rel="stylesheet" href="../../css/header.css"></link>
    <link rel="stylesheet" href="../../css/post.css"></link>
    <link rel="stylesheet" href="../../css/coments.css"></link>
    <link rel="stylesheet" href="../../css/footer.css"></link>
</head>
<body>
    <?php $postPageNavbar->showElement(); ?>
    <section class="postContainerAll">
        <?php $post->showPost("../../images/".$post->image,$coments); ?>
        <?php SideBar();  ?>
    </section>
    <section class="comentsContainer">
        <h3 class="postComentsTitle">Comentários</h3>
        <div class="postComents"> 
            <?php Coment::showComent($coments);  ?>
        </div>
        <form action="" method="POST" class="formContainer">
            <h3>Adicione um comentário</h3>
            <textarea name="coment"></textarea>
            <button type="submit" name="sendComent">Comentar</button>
        </form>
    </section>
    <section class="controlsContainer">
        <form action="" method="POST" class="formControls">
            <a href="../updatePost/<?php echo $post->id; ?>">Atualizar publicação</a>
            <button onClick="handleDeleteClick()" type='submit' name='deletePost'>Deletar publicação</button>
        </form>
    </section>
    <?php $postPageFooter->showElement();  ?>

    <script src="../../javascript/navbar.js"></script>
    <script src="../../javascript/navigation.js"></script>
</body>
</html>