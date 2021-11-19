<?php

// Importações
require("../components/Navbar.php");
require("../components/Footer.php");
require("../backend/Post.php");
require("../backend/DbConnection.php");

// Classes
$addPostNavbar = new Navbar("../images/logo.svg","../images/menumobile.svg","../images/closeMenu.svg","../","./#sobre","./#contato");
$addPostFooter = new Footer("../images/insta.png","../images/face.png");

$message = "";

// Função responsável por adicionar um post
if(isset($_POST["sendPost"])){
    $title = $_POST["postTitle"];
    $text = $_POST["postText"];
    $category = $_POST["postCategory"];
    $image = $_FILES["postImage"];
    $author = $_POST["postAuthor"];

    if($image){
        $fileName = time().".jpg";
        if(move_uploaded_file($image['tmp_name'], $fileName)){
        $fileSize = filesize($fileName);
        $mysqlImg = addslashes(fread(fopen($fileName,"r"),$fileSize));
        }
    }
    $post = new Post(
            $title,
            $mysqlImg,
            $text,
            $author,
            $category
    );

    $post->generatePost();
    $message = "Publicação realizada com sucesso!";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conecta</title>
    <link rel="stylesheet" href="../css/header.css"></link>
    <link rel="stylesheet" href="../css/addPost.css"></link>
    <link rel="stylesheet" href="../css/footer.css"></link>
</head>
<body>
    <?php $addPostNavbar->showElement(); ?>
    <section class="addPostContainer">
        <h2>Publique um artigo na nossa página!</h2>
        <h3>Compartilhe informações relevantes para a comunidade.</h3>
        <?php  
            if($message){
               echo "<h5 class='alert'>$message</h5>"; 
            } 
        ?>
        <form action="" method="POST" class="form" enctype="multipart/form-data">
            <label for="title">Título</label> <br>
            <input required placeholder="Ambientes de Coworking..." id="title" name="postTitle" type="text"></input> <br>
            <label for="image">Imagem</label> <br>
            <input required id="image" name="postImage" type="file"></input> <br>
            <label for="author">Autor</label> <br>
            <input required id="author" name="postAuthor" type="text"></input> <br>
            <label for="text">Texto</label> <br>
            <textarea required id="text" name="postText" type="text"></textarea> <br>
            <label for="category">Categoria</label> <br>
            <select required name="postCategory" id="category">
                <option value="Empreendedorismo" selected >Empreendedorismo</option>
                <option value="Trabalho">Trabalho</option>
                <option value="Tecnologia">Tecnologia</option>
            </select> <br>
            <button name="sendPost" type="submit">Publicar</button>
        </form>
    </section>
    <?php $addPostFooter->showElement(); ?>

    <script src="../javascript/navbar.js"></script>
    <script src="../javascript/navigation.js"></script>
</body>
</html>