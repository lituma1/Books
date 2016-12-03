<?php
//header('Content-type: application/json'); nie potrafię tego poprawnie użyć
include_once 'src/Book.php';
include_once 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {


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

    if (!empty($_POST['name']) && !empty($_POST['author'])) {
        $name = $_POST['name'];
        $author = $_POST['author'];

        echo 'successful' . $name . " " . $author;
        $b = new Book();
        $b->create($conn, $name, $author);
    }
}
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {

    parse_str(file_get_contents("php://input"), $del_vars);
    if (!empty($del_vars['id'])) {
        $id = $del_vars['id'];
        echo 'successful' . $id;
        Book::delete($conn, $id);
    }
}

?>