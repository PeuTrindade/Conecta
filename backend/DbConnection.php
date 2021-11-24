<?php

class DbConnection {
    private static $db_hostname = "localhost";
    private static $db_name = "conecta_blog";
    private static $db_username = "root";
    private static $db_password = "";
    private static $con;

    public static function getConnection() {
        if(!self::$con){
            try {
                self::$con = new PDO("mysql:host=".self::$db_hostname.";dbname=".self::$db_name, self::$db_username,self::$db_password);
                self::$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(PDOException $e) {
                echo "Houve algum erro durante a conexão: ".$e->getMessage();
            }
        }

        return self::$con;
    }

    public static function getComents($postId) {
        $connection = self::getConnection($postId);

        $sql = "SELECT * FROM coments WHERE postId = $postId";
        $result = $connection->query($sql);
        $rows = $result->fetchAll();

        $rowsFomarted = array();

        foreach ($rows as $key => $value) {
            $formatedInfo = array(
               "postId" => $value["postId"],
               "text" => $value["text"],
               "author" => $value["author"],
               "creationDate" => self::formatDate($value["creationDate"]),
               "updateDate" => self::formatDate($value["updateDate"]),
               "id" => $value["id"]
            );
            array_push($rowsFomarted,$formatedInfo);
        }
        return $rowsFomarted;
    }

    public static function addComent($coment) {
        $connection = self::getConnection();

        $res = $connection->prepare("INSERT INTO coments (postId,text,creationDate,updateDate,author) VALUES (:postId,:text,:creationDate,:updateDate,:author)");
        $res->bindParam(":postId",$coment->postId);
        $res->bindParam(":text",$coment->text);
        $res->bindParam(":creationDate",$coment->creationDate);
        $res->bindParam(":updateDate",$coment->updateDate);
        $res->bindParam(":author",$coment->author);

        $res->execute();
    }

    public static function deleteComent($postId) {
        $connection = self::getConnection();

        $res = $connection->prepare("DELETE FROM coments WHERE postId = :postId");
        $res->bindParam(":postId",$postId);

        $res->execute();
    }

    public static function updatePost($post) {
        $connection = self::getConnection();

        $res = $connection->prepare("UPDATE posts SET title = :title, text = :text, image = :image, creationDate = :creationDate, updateDate = :updateDate, author = :author, category = :category WHERE id = :id");
        $res->bindParam(":title",$post->title);
        $res->bindParam(":text",$post->text);
        $res->bindParam(":creationDate",$post->creationDate);
        $res->bindParam(":updateDate",$post->updateDate);
        $res->bindParam(":image",$post->image);
        $res->bindParam(":author",$post->author);
        $res->bindParam(":category",$post->category);
        $res->bindParam(":id",$post->id);

        $res->execute();
    }
 
    public static function deletePost($postId){
        $connection = self::getConnection();

        $res = $connection->prepare("DELETE FROM posts WHERE id = :postId");
        $res->bindParam(":postId",$postId);

        $res->execute();
    }

    public static function getPosts() {
        $connection = self::getConnection();

        $sql = "SELECT * FROM posts";
        $result = $connection->query($sql);
        $rows = $result->fetchAll();

        $rowsFomarted = array();

        foreach ($rows as $key => $value) {
            $formatedInfo = array(
               "title" => $value["title"],
               "text" => $value["text"],
               "author" => $value["author"],
               "category" => $value["category"],
               "image" => $value["image"],
               "creationDate" => self::formatDate($value["creationDate"]),
               "updateDate" => self::formatDate($value["updateDate"]),
               "id" => $value["id"]
            );
            array_push($rowsFomarted,$formatedInfo);
        }
        return $rowsFomarted;
    }

    public static function getPostById($id) {
        $connection = self::getConnection();

        $sql = "SELECT * FROM posts WHERE id = $id";
        $result = $connection->query($sql);
        $row = $result->fetchAll();
        $rowsFomarted = array();

        foreach ($row as $key => $value) {
            $formatedInfo = array(
               "title" => $value["title"],
               "text" => $value["text"],
               "author" => $value["author"],
               "category" => $value["category"],
               "image" => $value["image"],
               "creationDate" => self::formatDate($value["creationDate"]),
               "updateDate" => self::formatDate($value["updateDate"]),
               "id" => $value["id"]
            );
            array_push($rowsFomarted,$formatedInfo);
        }
        return $rowsFomarted;
    }

    public static function getPostsByCategory($category) {
        $connection = self::getConnection();

        $sql = "SELECT * FROM posts WHERE category LIKE '%$category%'";
        $result = $connection->query($sql);
        $row = $result->fetchAll();

        $rowsFomarted = array();

        foreach ($row as $key => $value) {
            $formatedInfo = array(
               "title" => $value["title"],
               "text" => $value["text"],
               "author" => $value["author"],
               "category" => $value["category"],
               "image" => $value["image"],
               "creationDate" => self::formatDate($value["creationDate"]),
               "updateDate" => self::formatDate($value["updateDate"]),
               "id" => $value["id"]
            );
            array_push($rowsFomarted,$formatedInfo);
        }
        return $rowsFomarted;
    }

    public static function getPostsByTitle($title) {
        $connection = self::getConnection();

        $sql = "SELECT * FROM posts WHERE title LIKE '%$title%'";
        $result = $connection->query($sql);
        $rows = $result->fetchAll();

        $rowsFomarted = array();

        foreach ($rows as $key => $value) {
            $formatedInfo = array(
               "title" => $value["title"],
               "text" => $value["text"],
               "author" => $value["author"],
               "category" => $value["category"],
               "image" => $value["image"],
               "creationDate" => self::formatDate($value["creationDate"]),
               "updateDate" => self::formatDate($value["updateDate"]),
               "id" => $value["id"]
            );
            array_push($rowsFomarted,$formatedInfo);
        }

        return $rowsFomarted;
    }

    public static function addPost($post) {
        $connection = self::getConnection();

        $res = $connection->prepare("INSERT INTO posts (title,text,creationDate,updateDate,image,author,category) VALUES (:title,:text,:creationDate,:updateDate,:image,:author,:category)");
        $res->bindParam(":title",$post->title);
        $res->bindParam(":text",$post->text);
        $res->bindParam(":creationDate",$post->date);
        $res->bindParam(":updateDate",$post->date);
        $res->bindParam(":image",$post->image);
        $res->bindParam(":author",$post->author);
        $res->bindParam(":category",$post->category);

        $res->execute();
    }

    private static function formatDate($date) {
        $date = implode("/",array_reverse(explode("-",$date)));
        return $date;
    }
}