<?php
class DBManager {
    const DB_SERVER = "localhost:3308";
    const DB_USERNAME = "root";
    const DB_PASSWORD = "";
    protected $conn, $results;
    function __construct() {
        $this->conn = mysqli_connect(self::DB_SERVER, self::DB_USERNAME, self::DB_PASSWORD);
        if ($this->conn == FALSE) {
            die("<h4>connection failed</h4>");
        }

        $db_selected = mysqli_select_db($this->conn, "articles");
        set_error_handler(function() { /* ignore errors */ });
        $tableExist = mysqli_connect(self::DB_SERVER, self::DB_USERNAME, self::DB_PASSWORD, "articles") or '';
        restore_error_handler();
        if(!$db_selected) {
            $this->results = mysqli_query($this->conn, "CREATE DATABASE articles");
            $this->conn = mysqli_connect(self::DB_SERVER, self::DB_USERNAME, self::DB_PASSWORD, "articles");
            $this->results = mysqli_query($this->conn, "CREATE TABLE articles_table(
                                id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                                title VARCHAR(80) NOT NULL,
                                summary VARCHAR(500) NOT NULL,
                                status VARCHAR(40) NOT NULL DEFAULT 'draft'
                                )");
            for($count=1; $count<4; $count++){
                $title = "exampleTitle-".$count;
                $summary = "This is summary example number ".$count;
                $this->results = mysqli_query($this->conn, 
                "INSERT INTO articles_table(title, summary) VALUES('$title','$summary')");
            }
        }elseif($db_selected and !(mysqli_query($tableExist, "SELECT 1 FROM articles_table LIMIT 1"))) {
            $this->conn = $tableExist;
            $this->results = mysqli_query($this->conn, "CREATE TABLE articles_table(
                                id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                                title VARCHAR(80) NOT NULL,
                                summary VARCHAR(500) NOT NULL,
                                status VARCHAR(40) NOT NULL DEFAULT 'draft'
                                )");

            for($count=1; $count<4; $count++){
                $title = "exampleTitle-".$count;
                $summary = "This is summary example number ".$count;
                $this->results = mysqli_query($this->conn, 
                "INSERT INTO articles_table(title, summary) VALUES('$title','$summary')");
            }
        }
        
        $this->conn = mysqli_connect(self::DB_SERVER, self::DB_USERNAME, self::DB_PASSWORD, "articles");
    }

    function display() {
        $this->results = mysqli_query($this->conn, "SELECT * FROM articles_table");
        $returnResults = $this->results;
        return $returnResults;
    }

    function getEntryUsingId($id) {
        $returnResults = mysqli_query($this->conn, "SELECT * FROM articles_table WHERE id=$id");
        return $returnResults;
    }
    function delete($id) {
        mysqli_query($this->conn, "DELETE FROM articles_table WHERE id=$id");
    }

    function add($title, $summary) {
        mysqli_query($this->conn, "INSERT INTO articles_table(title, summary) VALUES('$title','$summary')");
    }

    function update($id, $title, $summary) {
        mysqli_query($this->conn, "UPDATE articles_table SET title='$title', summary='$summary' WHERE id=$id");
    }

    function acceptArticle($id) {
        mysqli_query($this->conn, "UPDATE articles_table SET status='accepted' WHERE id=$id");
    }
}
?>