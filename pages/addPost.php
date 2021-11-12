<?php

// Importações
require("../components/Navbar.php");
require("../components/Footer.php");
require("../backend/data.php");
require("../backend/Post.php");

// Classes
$addPostNavbar = new Navbar("../images/logo.svg","../images/menumobile.svg","../images/closeMenu.svg");
$addPostFooter = new Footer("../images/insta.png","../images/face.png");

$message = "";

// Função responsável por adicionar um post
if(isset($_POST["sendPost"])){
    $title = $_POST["postTitle"];
    $text = $_POST["postText"];
    $category = $_POST["postCategory"];
    $image = $_POST["postImage"];
    $author = $_POST["postAuthor"];

    $post = new Post(
            $title,
            $text,
            $author,
            $category,
            $image
    );

    $data = $post->generatePost($data);
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
            if($message){ ?>
                <h5 class="alert"><?php echo $message;?></h5>
        <?php 
            } 
        ?>
        <form action="" method="POST" class="form">
            <label for="title">Título</label> <br>
            <input required placeholder="Ambientes de Coworking..." id="title" name="postTitle" type="text"></input> <br>
            <label for="image">Imagem</label> <br>
            <input required id="image" name="postImage" type="text"></input> <br>
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