<?php
require("../components/Sidebar.php");
require("../php/Data.php");
require_once("../components/Navbar.php");

$url = $_SERVER["REQUEST_URI"];
$postID = explode("/",$url)[4];

$getPost = $data[$postID - 1];

$post = new Post($getPost["id"]);
$post -> title = $getPost["title"];
$post -> creationDate = $getPost["creationDate"];
$post -> updateDate = $getPost["updateDate"];
$post -> image = $getPost["image"];
$post -> text = $getPost["text"];
$post -> author = $getPost["author"];
$post -> category = $getPost["category"];
$post -> coments = $getPost["coments"];

$newSrcImg = "../".".".$post -> image;

if(isset($_POST["sendComent"])){
    $text = $_POST["coment"];
    if($text){
       array_push($post -> coments,$text);
    } 
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conecta</title>
    <link rel="stylesheet" href="./css/header.css"></link>
    <link rel="stylesheet" href="../../css/post.css"></link>
</head>
<body>
    <?php Navbar();?>
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
</body>
</html>