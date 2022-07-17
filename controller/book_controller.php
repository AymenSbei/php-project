<?php
class BookController{
    private $conn;
    public function __construct(){
        require_once "connection_controller.php";
        require_once  "../model/book.php";
        $this->conn= new ConnectionController();
    }

    public function createBook($title,$author,$price){
        $colonnes= "title , author , price";
        $valeurs= "'". $title. "' ,'". $author."' ,'".$price."'";
        $res= $this->conn->insert("books", $colonnes, $valeurs);
        return $res;
    }

    public function readBook($conditions){
        $res= $this->conn->select("*", "books", $conditions, array("order_by"=>"price"));

        $tab=array();
        while ($row= mysqli_fetch_assoc($res)) {
            $book = new Book($row["id"],$row["title"], $row["author"], $row["price"]);
            array_push($tab, $book);
        }
        return $tab;
    }

    public function deleteBook($condition){
        return $this-> conn -> delete("books", $condition, "");

    }

    public function updateBook($colonnes, $valeurs, $condition ){
        return $this-> conn->update("books", $colonnes, $valeurs, $condition);
    }

    
}

