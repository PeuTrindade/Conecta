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

        return $rows;
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

    public static function getPosts() {
        $connection = self::getConnection();

        $sql = "SELECT * FROM posts";
        $result = $connection->query($sql);
        $rows = $result->fetchAll();

        return $rows;
    }

    public static function getPostById($id) {
        $connection = self::getConnection();

        $sql = "SELECT * FROM posts WHERE id = $id";
        $result = $connection->query($sql);
        $row = $result->fetchAll();

        return $row;
    }

    public static function getPostsByCategory($category) {
        $connection = self::getConnection();

        $sql = "SELECT * FROM posts WHERE category LIKE '%$category%'";
        $result = $connection->query($sql);
        $row = $result->fetchAll();

        return $row;
    }

    public static function getPostsByTitle($title) {
        $connection = self::getConnection();

        $sql = "SELECT * FROM posts WHERE title LIKE '%$title%'";
        $result = $connection->query($sql);
        $rows = $result->fetchAll();

        return $rows;
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
}