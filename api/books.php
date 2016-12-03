<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//header('Content-type: application/json');
include_once 'src/Book.php';
include_once 'connection.php';
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
   
//    $sql = "SELECT id FROM Book";
//    $res = $conn->query($sql);
//    if($res && $res->num_rows > 0){
//        foreach ($res as $row){
//            $id = $row['id'];
//            $book = Book::loadFromDb($conn, $id);
//            $json = json_encode($book);
//            echo $json;
//        }
//    } else {
//   echo 'niepoprawne zapytnie do bazy';        
//}


    if (!empty($_GET['id'])) {
        $id = $_GET['id'];
        $book = Book::loadFromDb($conn, $id);
        $json = json_encode($book);
        echo $json;
    } else {
        $books = Book::loadAllBooks($conn);
        $json = json_encode($books);
        echo $json;
    }
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   if(isset($_POST['data'])){
    echo 'successful czy to się udało'. $_POST['data'];
}
//    if (!empty($_POST)) {
//
//        $book = json_decode();
//        //var_dump($book);
//        $name = $book->name;
//        $author = $book->author;
//        echo $name . '<br>';
//        echo $author . '<br>';
//        $b = new Book();
//        $b->create($conn, $name, $author);
//    }
}

?>