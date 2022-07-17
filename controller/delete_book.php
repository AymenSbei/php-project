<?php
$id=$_GET["id"];
require_once '../controller/book_controller.php';
$controller= new BookController();
$controller -> deleteBook("id= ". $id);
?>