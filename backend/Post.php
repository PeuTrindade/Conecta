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
     $this -> id = $id;
     $this -> title = $title;
     $this -> creationDate = $creationDate;
     $this -> updateDate = $updateDate;
     $this -> image = $image;
     $this -> text = $text;
     $this -> author = $author;
     $this -> category = $category;
     $this -> coments = $coments;
    }

    function filterByTitle() {
        echo "
        <div id='$this->id' class='post'>
            <img src='$this->image'/>
            <div class='postInfo'>
                <h4><a href='/Conecta/Pages/PostPage.php/$this->id'>$this->title</a></h4>
                <p>Criado em $this->creationDate</p>
                <p>Atualizado em $this->updateDate</p>
            </div>
        </div>
        ";
    }

    function generatePost($data) {
        if($this->title && $this->text && $this->category && $this->image){
            $arraySize = count($data);
            date_default_timezone_set("America/Sao_Paulo");
            $this->date = date('y/m/d');
    
            $schema = array("id" => ($arraySize + 1), "title" => $this->title, "image" => $this->image, "creationDate" => $this->date, "updateDate" => $this->date , "text" => $this->text, "category" => $this->category, "coments" => array());
            array_push($data, $schema);
            return $data;
        }
    }
}