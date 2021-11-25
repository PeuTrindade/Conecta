<?php

// Importações
require("../components/Navbar.php");
require("../components/Footer.php");
require("../components/postForm.php");
require("../backend/Post.php");
require("../backend/DbConnection.php");

// Classes
$addPostNavbar = new Navbar("../images/logo.svg","../images/menumobile.svg","../images/closeMenu.svg","../","./#sobre","./#contato");
$addPostFooter = new Footer("../images/insta.png","../images/face.png");

$message = "";
$errorMessage = "";

// Função responsável por adicionar um post
if(isset($_POST["sendPost"])){
    $title = $_POST["postTitle"];
    $text = $_POST["postText"];
    $category = $_POST["postCategory"];
    $image = $_FILES["postImage"];
    $author = $_POST["postAuthor"];

    $post = new Post(
            $title,
            $text,
            $author,
            $category
    );

    $post->uploadImage($image["name"],$image["tmp_name"]);
    $post->validateFields();

    if(!$post->getErrors()){
        $post->generatePost();
        $message = "Publicação realizada com sucesso!";
    } else {
        $errorPhrase = "";
        foreach ($post->getErrors() as $key => $field) {
            foreach ($field as $key => $value) {
                $errorPhrase = $errorPhrase.$value." ";
            }
        }
        $errorMessage = $errorPhrase;
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
            else if($errorMessage){
               echo "<h5 class='errorsMessage'>$errorMessage</h5>"; 
            }
            postForm("../pages/addPost.php","Publicar","Selecione uma imagem");
        ?>
    </section>
    <?php $addPostFooter->showElement(); ?>

    <script src="../javascript/navbar.js"></>
    <script src="../javascript/navigation.js"></script>
    <script>
        let inputFile = document.getElementById("image");
        let inputLabel = document.getElementById("imageLabel");
        inputFile.addEventListener("change", (event) => {
            inputLabel.innerText = event.srcElement.files[0].name;
        });
    </script>
</body>
</html>