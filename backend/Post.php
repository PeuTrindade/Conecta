<?php

// Classe das informações gerais dos posts
class Post {
    public $id;
    public $title;
    public $creationDate;
    public $updateDate;
    public $image;
    public $text;
    public $author;
    public $category;
    public $coments;
 
    function __construct($title,$image,$text,$author,$category,$coments = [],$creationDate = null,$updateDate = null,$id = null) {
     $this->id = $id;
     $this->title = $title;
     $this->creationDate = $creationDate;
     $this->updateDate = $updateDate;
     $this->image = $image;
     $this->text = $text;
     $this->author = $author;
     $this->category = $category;
     $this->coments = $coments;
    }

    public static function filterByTitle($data,$max,$min) {
        foreach ($data as $key => $value) {
            if($key >= $min && $key < $max){
            $postId = $value["id"];
            $postImage = $value["image"];
            $postTitle = $value["title"];
            $postCreationDate = $value["creationDate"];
            $postUpdateDate = $value["updateDate"];

            echo "
                  <div id='$postId' class='post'>
                      <img src='$postImage'/>
                      <div class='postInfo'>
                          <h4><a href='./pages/postPage.php/$postId'>$postTitle</a></h4>
                          <p>Criado em $postCreationDate</p>
                          <p>Atualizado em $postUpdateDate</p>
                      </div>
                  </div>"; 
            }
        }
    }

    public static function filterByCategory($data,$max,$min) {
        foreach ($data as $key => $value) {
            if($key >= $min && $key < $max){
            $postId = $value["id"];
            $postImage = $value["image"];
            $postTitle = $value["title"];
            $postCreationDate = $value["creationDate"];
            $postUpdateDate = $value["updateDate"];

            echo "
                  <div id='$postId' class='post'>
                      <img src='$postImage'/>
                      <div class='postInfo'>
                          <h4><a href='./pages/postPage.php/$postId'>$postTitle</a></h4>
                          <p>Criado em $postCreationDate</p>
                          <p>Atualizado em $postUpdateDate</p>
                      </div>
                  </div>"; 
            }
        }
    }

    public static function getPosts() {
        $data = DbConnection::getPosts();
        $posts = [];

        foreach ($data as $key => $value) {
            $post = new Post(
                $value["title"],
                $value["image"],
                $value["text"],
                $value["author"],
                $value["category"],
                [],
                $value["creationDate"],
                $value["creationDate"],
                $value["id"],
            );
            array_push($posts,$post);
        }
        return $posts;
    }

    function showPost($fomartImageSrc) {
        echo "
        <section class='postContainer'>
            <img class='postImg' src='$fomartImageSrc'/>
            <h2>$this->title</h2>
            <p class='postCategory'>$this->category</p>
            <p class='postText'>$this->text</p>
            <div class='moreInfo'>
                <p>Criado por $this->author</p>
                <p>Criado em $this->creationDate</p>
                <p>Atualizado em $this->updateDate</p>
            </div>
        </section>
        ";
    }

    function generatePost() {
        if($this->title && $this->text && $this->image && $this->author && $this->category) {
            date_default_timezone_set("America/Sao_Paulo");
            $this->date = date('y/m/d');
            
            // Enviando dados do post para a classe do Banco de dados
            DbConnection::addPost($this);
        }
    }
}