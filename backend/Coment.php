<?php

class Coment {
    public $id;
    public $postId;
    public $text;
    public $creationDate;
    public $updateDate;
    public $author;

    public function __construct($postId,$text,$author,$creationDate=null,$updateDate=null,$id=null) {
        $this->postId = $postId;
        $this->text = $text;
        $this->author = $author;
        $this->creationDate = $creationDate;
        $this->updateDate = $updateDate;
        $this->id = $id;
    }

    public static function showComent($coments) {
        foreach ($coments as $key => $value) {
            $textComent = $value->text;
            $authorComent = $value->author;
            $creationDateComent = $value->creationDate;

            echo "
                <div class='postComent'>
                    <span>$authorComent comentou em $creationDateComent:</span>
                    <h3>$textComent</h3>
                </div>
            ";
        }
    }

    public static function getComent($postId) {
        $comentsArray = DbConnection::getComents($postId);
        $coments = [];
        foreach ($comentsArray as $key => $value) {
            $coment = new Coment(
                $value["postId"],
                $value["text"],
                $value["author"],
                $value["creationDate"],
                $value["updateDate"],
                $value["id"],
            );
            array_push($coments,$coment);
        }
        return $coments;
    }

    public static function deleteComent($postId) {
        DbConnection::deleteComent($postId);
    }

    public function generateComent() {
        if($this->postId && $this->text && $this->author) {
            date_default_timezone_set("America/Sao_Paulo");
            $this->creationDate = date('y/m/d');
            $this->updateDate = date('y/m/d');

            // Enviando dados do comentário para a classe do Banco de dados
            DbConnection::addComent($this);
        }
    }
}