<?php

// Classe para receber as informações do post do filtro por título
class FilterByTitle {
    public $id;
    public $title;
    public $image;
    public $creationDate;
    public $updateDate;

    function __construct($id,$title,$image,$creationDate,$updateDate){
        $this -> id = $id;
        $this -> title = $title;
        $this -> image = $image;
        $this -> creationDate = $creationDate;
        $this -> updateDate = $updateDate;
    }
}