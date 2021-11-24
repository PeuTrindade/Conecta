<?php
// Importações
require("../components/Navbar.php");
require("../components/Footer.php");
require("../components/postForm.php");
require("../backend/Post.php");
require("../backend/DbConnection.php");

// Classes
$updatePostNavbar = new Navbar("../../images/logo.svg","../../images/menumobile.svg","../../images/closeMenu.svg","../../","./#sobre","./#contato");
$updatePostFooter = new Footer("../../images/insta.png","../../images/face.png");

$message = "";

$url = $_SERVER["REQUEST_URI"];
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

//Função responsável por atualizar um post
if(isset($_POST["sendPost"])){
    $title = $_POST["postTitle"];
    $text = $_POST["postText"];
    $category = $_POST["postCategory"];
    $image = $_FILES["postImage"];
    $author = $_POST["postAuthor"];
    $creationDate = $post->creationDate;
    $updateDate = $post->updateDate;
    $id = $postId;
    
    function reverseDate($date){
        $newDate = str_replace("/", "-", $date);
        return date('Y-m-d', strtotime($newDate));
    }

    if(!$image["name"]){
        $image = $post->image;
    }

    $post = new Post(
            $title,
            $text,
            $author,
            $category,
            $image,
            reverseDate($creationDate),
            reverseDate($updateDate),
            $id
    );

    $typeOfImage = gettype($image);

    if($typeOfImage === "array"){
        $post->uploadImage($image["name"],$image["tmp_name"]);
    }

    $post->updatePost();
    $message = "Publicação atualizada com sucesso!";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conecta</title>
    <link rel="stylesheet" href="../../css/header.css"></link>
    <link rel="stylesheet" href="../../css/addPost.css"></link>
    <link rel="stylesheet" href="../../css/footer.css"></link>
</head>
<body>
    <?php $updatePostNavbar->showElement(); ?>
    <section class="updatePostContainer">
        <h2>Atualize um artigo da nossa página!</h2>
        <h3>Altere as informações abaixo</h3>
        <?php  
            if($message){ 
               echo "<h5 class='alert'>$message</h5>"; 
            } 
            postForm("../../pages/updatePost.php/$post->id","Atualizar",$post->title,$post->author,$post->text);
        ?>
    </section>
    <section class="previewImg">
        <img src="../../images/<?php echo $post->image; ?>"/>
    </section>
    <?php $updatePostFooter->showElement(); ?>

    <script src="../../javascript/navbar.js"></script>
    <script src="../../javascript/navigation.js"></script>
</body>
</html>