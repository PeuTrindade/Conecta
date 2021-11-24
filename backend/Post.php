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
    public $errors = array();
 
    function __construct($title,$text,$author,$category,$image = null,$creationDate = null,$updateDate = null,$id = null) {
     $this->id = $id;
     $this->title = $title;
     $this->creationDate = $creationDate;
     $this->updateDate = $updateDate;
     $this->image = $image;
     $this->text = $text;
     $this->author = $author;
     $this->category = $category;
    }

    public function validateFields(){
        $this->validateTitle();
        $this->validateAuthor();
        $this->validateImage();
        $this->validateText();

        if(!$this->errors["title"] &&
           !$this->errors["image"] &&
           !$this->errors["author"] &&
           !$this->errors["text"]){

            $this->errors = array();
        }
    }

    private function validateTitle(){
        $this->errors["title"] = array();

        $textWithoutSpaces = str_replace(" ","",$this->title);

        if(!$this->title){
            array_push($this->errors["title"],"Nenhum conteúdo identificado no campo de título!");
        }
        else if(!$textWithoutSpaces){
            array_push($this->errors["title"],"Nenhum conteúdo identificado no campo de título!");
        }
        else if(strlen($this->title) > 255){
            array_push($this->errors["title"],"Conteúdo muito longo no campo de título!");
        }
    }

    private function validateAuthor(){
        $this->errors["author"] = array();

        $textWithoutSpaces = str_replace(" ","",$this->author);

        if(!$this->author){
            array_push($this->errors["author"],"Nenhum conteúdo identificado no campo de autor!");
        }
        else if(!$textWithoutSpaces){
            array_push($this->errors["author"],"Nenhum conteúdo identificado no campo de autor!");
        }
        else if(strlen($this->author) > 55){
            array_push($this->errors["author"],"Conteúdo muito longo no campo de autor!");
        }
    }
    
    private function validateImage(){
        $this->errors["image"] = array();
        
        if(!$this->image){
            array_push($this->errors["image"],"Nenhum conteúdo identificado no campo de imagem!");
        }
        else if(strlen($this->image) > 255){
            array_push($this->errors["author"],"Conteúdo muito longo no campo de imagem!");
        }
    }

    private function validateText(){
        $this->errors["text"] = array();

        $textWithoutSpaces = str_replace(" ","",$this->text);

        if(!$this->text){
            array_push($this->errors["text"],"Nenhum conteúdo identificado no campo de texto!");
        }
        else if(!$textWithoutSpaces){
            array_push($this->errors["text"],"Nenhum conteúdo identificado no campo de texto!");
        }
    }

    public static function reverseDate($date) {
        $newDate = str_replace("/", "-", $date);
        return date('Y-m-d', strtotime($newDate));
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
                      <img src='images/$postImage'/>
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
                      <img src='images/$postImage'/>
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
                $value["text"],
                $value["author"],
                $value["category"],
                $value["image"],
                $value["creationDate"],
                $value["updateDate"],
                $value["id"],
            );
            array_push($posts,$post);
        }
        
        return $posts;
    }

    public function showPost($fomartImageSrc,$message) {
        if($message){
            echo "
            <section class='postContainer'>
                <h5 class='errorsMessage'>$message</h5>
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
        } else {
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
    }

    public function generatePost() {
        if($this->title && $this->text && $this->image && $this->author && $this->category) {
            date_default_timezone_set("America/Sao_Paulo");
            $this->date = date('y/m/d');
            
            // Enviando dados do post para a classe do Banco de dados
            DbConnection::addPost($this);
        }
    }

    public function updatePost() {
        if($this->title && $this->text && $this->image && $this->author && $this->category && $this->creationDate) {
            date_default_timezone_set("America/Sao_Paulo");
            $this->updateDate = date('y/m/d');

            // Enviando dados do post para a classe do Banco de dados
            DbConnection::updatePost($this);
        }
    }

    public function deletePost() {
        Coment::deleteComent($this->id);
        DbConnection::deletePost($this->id);
    }

    public function uploadImage($imageName,$imageTmpName) {
        if($imageName && $imageTmpName){
            $extension = strtolower(substr($imageName,-4));
            $newName = md5(time()).$extension;
            $directory = "../images/";
        
            move_uploaded_file($imageTmpName,$directory.$newName);
            $this->image = $newName;
        }
    }
}