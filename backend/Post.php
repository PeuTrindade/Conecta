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
 
    function __construct($id,$title,$creationDate,$updateDate,$image,$text,$author,$category,$coments) {
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
}