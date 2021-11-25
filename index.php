<?php

//Importações
require("./backend/Post.php");
require("./components/Navbar.php");
require("./components/Banner.php");
require("./components/Footer.php");
include("./backend/DbConnection.php");

// Classes
$postsArray = Post::getPosts();
$navbarHomePage = new Navbar("./images/logo.svg","./images/menumobile.svg","./images/closeMenu.svg","./","./#sobre","./#contato");
$welcomeBanner = new Banner("Olá, somos o Conecta","Seu blog de notícias sobre Coworking e afins!","Ao contrário do que se acredita, Lorem Ipsum não é simplesmente um texto randômico. Com mais de 2000 anos, suas raízes podem ser encontradas em uma obra de literatura latina clássica datada de 45 AC. Richard McClintock, um professor de latim do Hampden-Sydney College na Virginia, pesquisou uma das mais obscuras palavras em latim, consectetur, oriunda de uma passagem de Lorem Ipsum, e, procurando por entre citações da palavra na literatura clássica, descobriu a sua indubitável origem. Lorem Ipsum vem das seções 1.10.32 e 1.10.33 do 'de Finibus Bonorum et Malorum' (Os Extremos do Bem e do Mal), de Cícero, escrito em 45 AC. Este livro é um tratado de teoria da ética muito popular na época da Renascença. A primeira linha de Lorem Ipsum, 'Lorem Ipsum dolor sit amet...' vem de uma linha na seção 1.10.32.","./images/coworking1.jpg","welcomeSection","textContainer","coworkingImg");
$aboutBanner = new Banner("Conheça um pouco mais sobre o Conecta","Nossa história e nossa missão","Ao contrário do que se acredita, Lorem Ipsum não é simplesmente um texto randômico. Com mais de 2000 anos, suas raízes podem ser encontradas em uma obra de literatura latina clássica datada de 45 AC. Richard McClintock, um professor de latim do Hampden-Sydney College na Virginia, pesquisou uma das mais obscuras palavras em latim, consectetur, oriunda de uma passagem de Lorem Ipsum, e, procurando por entre citações da palavra na literatura clássica, descobriu a sua indubitável origem. Lorem Ipsum vem das seções 1.10.32 e 1.10.33 do 'de Finibus Bonorum et Malorum' (Os Extremos do Bem e do Mal), de Cícero, escrito em 45 AC. Este livro é um tratado de teoria da ética muito popular na época da Renascença. A primeira linha de Lorem Ipsum, 'Lorem Ipsum dolor sit amet...' vem de uma linha na seção 1.10.32.","./images/coworking3.jpg","aboutContainer","aboutText","aboutUsImg","sobre");
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
        header("Location: ./?$text/1");
    }
}

// Função para deletar os filtros e mostrar todos os posts
if(isset($_POST["deleteFilter"])){
    $post = null;
    $filterByTitle = false;
    $filterTags = null;
    $filterByTags = false;
    header("Location: ./");
}

// Variável que armazena a URL da página
$url = $_SERVER["REQUEST_URI"];
$urlExplode = explode("/",$url);
$lastIndexUrl = array_key_last($urlExplode);

// Função para o filtro por título
$titleSearchValue = str_replace("?","",$urlExplode[2]);

if($titleSearchValue && count($urlExplode) >= 4){
    $filterByTitle = true;
    $filterTags = $titleSearchValue;
    $postsArray = DbConnection::getPostsByTitle($titleSearchValue);
}

// Função para o filtro por categorias
$category1 = array_search("?Empreendedorismo",$urlExplode);
$category2 = array_search("?Tecnologia",$urlExplode);
$category3 = array_search("?Trabalho",$urlExplode);

if($category1 || $category2 || $category3){
    $filterByTitle = false;
    $filterByTags = true;

    if($category1){
        $filterTags = str_replace("?","",$urlExplode[$category1]);
        $postsArray = DbConnection::getPostsByCategory($filterTags);
    }
    else if($category2){
        $filterTags = str_replace("?","",$urlExplode[$category2]);
        $postsArray = DbConnection::getPostsByCategory($filterTags);
    }
    else {
        $filterTags = str_replace("?","",$urlExplode[$category3]);
        $postsArray = DbConnection::getPostsByCategory($filterTags);
    }
}

// Função de paginação
$pageTag = $urlExplode[$lastIndexUrl];

$max = 5;
$min = 0;

if($pageTag){
    if($pageTag[0] === "?") {
        $pageTag = str_replace("?","",$pageTag);
    }

    if($pageTag !== "NaN"){
        if($pageTag){
            $max = 5 * $pageTag;
            $min = $max - 5;
        }
    }
}

// Número de posts salvos
$dataLength = count($postsArray);

?>

<script> 
    if(localStorage["redirect"]){
        localStorage["redirect"] = "";
    }

    function handleText(){
       let textValue = document.getElementById("titleSearch").value;
       localStorage["textValue"] = textValue;
    }

</script>

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
                    foreach ($postsArray as $key => $value) { 
                        if($key >= $min && $key < $max) {
                            $postId = $value->id;
                            $postImage = $value->image;
                            $postTitle = $value->title;
                            $postCreationDate = $value->getCreationDate();
                            $postUpdateDate = $value->getUpdateDate();

                            echo "<div id='$postId' class='post'>
                                        <img src='images/$postImage'/>
                                        <div class='postInfo'>
                                            <h4><a href='./pages/postPage.php/$postId'>$postTitle</a></h4>
                                            <p>Criado em $postCreationDate</p>
                                            <p>Atualizado em $postUpdateDate</p>
                                        </div>
                                 </div>";
                        }
                    }
                } else if($filterByTitle && !$filterByTags) {
                    Post::filterByTitle($postsArray,$max,$min);
                }
                else if(!$filterByTitle && $filterByTags){
                    Post::filterByCategory($postsArray,$max,$min);
                }
            ?>
        </div>
        <div class="sideBar">
            <form action="" method="POST" class="search">
                <input id="titleSearch" name="title_search" type="text" placeholder="Busque por um título"/> <br>
                <input name="title_search_value" id="titleSearchValue" type="hidden"/>
                <button onClick="handleText()" name="search_btn" type="submit">Pesquisar</button>
            </form>
            <?php  
                if($filterTags){ 
                    echo 
                    "<form class='filterTags' action='' method='POST'>
                        <h4>$filterTags</h4>
                        <button name='deleteFilter' type='submit'>Deletar</button>
                    </form>";
                }
            ?>
            <h3>Tags</h3>
            <ul class="tags">
                <li><a id="tag1" class="tag" href="./?Empreendedorismo/1">Empreendedorismo</a></li>
                <li><a id="tag2" class="tag" href="./?Tecnologia/1">Tecnologia</a></li>
                <li><a id="tag3" class="tag" href="./?Trabalho/1">Trabalho</a></li>
            </ul>
        </div>
        </div>
        <ul class="pages">
            <input id="dataLength" value=<?php echo $dataLength; ?> type="hidden"/>
            <li onClick="handleLeft()" class="leftArrow"><</li>
            <div id="pageNavigation">
                <li id="1" class="pageDisabled"><a href="./?1">1</a></li>
            </div>
            <li onClick="handleRight()" class="rightArrow">></li>
        </ul>
    </section>
    <?php $aboutBanner->showElement(); ?>
    <section class="addPostPage">
        <h2>Quer compartilhar alguma novidade?</h2>
        <h3>Publique artigos sobre Empreendedorismo, Tecnologia e Trabalho!</h3>
        <a href="./pages/addPost.php">Quero Publicar</a>
    </section>
    <?php $footerHome->showElement(); ?>
    </section>

    <script src="./javascript/navbar.js"></script>
    <script src="./javascript/navigation.js"></script>
</body>
</html>