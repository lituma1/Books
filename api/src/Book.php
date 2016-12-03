<?php

class Book implements JsonSerializable {

    private $id;
    private $name;
    private $author;

    function __construct() {
        $this->id = -1;
        $this->name = '';
        $this->author = '';
    }

    function getId() {
        return $this->id;
    }

    function getName() {
        return $this->name;
    }

    function getAuthor() {
        return $this->author;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setAuthor($author) {
        $this->author = $author;
    }

    static function loadFromDb(mysqli $conn, $id) {
        $sql = "SELECT * FROM Book WHERE id=$id";

        $res = $conn->query($sql);
        if ($res && $res->num_rows > 0) {
            foreach ($res as $row) {
                $loadedBook = new Book();
                $loadedBook->id = $id;
                $loadedBook->setAuthor($row['author']);
                $loadedBook->setName($row['name']);
            }

            return $loadedBook;
        }
        return null;
    }

    function create(mysqli $conn, $name, $author) {
        if ($this->id == -1) {
            $sql = "INSERT INTO Book (name, author) VALUES ('$name', '$author')";
            $result = $conn->query($sql);
            if ($result) {
                $this->id = $conn->insert_id;
                return true;
            } else {
                echo 'niepoprawne zapytanie do bazy' . $conn->error;
            }
        }
        return false;
    }
    function update($conn, $name, $author){
        if($this->id != -1){
            $sql = "UPDATE Book SET name='$name', author='$author' WHERE id=$this->id";
            $result = $conn->query($sql);
            if($result){
                return true;
            }
            echo 'modyfikacja nie powiodła się'.$conn->error;
            return false;
        }
    }
// Zamiast tej funkcji zastosowałem funkcję statyczną
//    function delete($conn){
//        if($this->id !=-1){
//            $sql = "DELETE FROM Book WHERE id=$this->id";
//            $result = $conn->query($sql);
//            if($result){
//                $this->id = -1;
//                echo 'rekord usunięty z bazy';
//                return true;
//            }
//            echo 'niepoprawne zapytanie do bazy'. $conn->error;
//            return false;
//        }
//    }
    static function delete($conn, $id){
        $sql = "DELETE FROM Book WHERE id=$id";
        $result = $conn->query($sql);
            if($result && $result == null){
               
                echo 'rekord usunięty z bazy';
                return true;
            }
            echo 'niepoprawne zapytanie do bazy lub obiekt o podanym id nieistnieje'. $conn->error;
            return false;
        
    }
    static function loadAllBooks($conn){
        $ret = [];
        $sql = "SELECT * FROM Book";
        $result = $conn->query($sql);
        if ($result && $result->num_rows > 0) {
            foreach ($result as $row) {
                $loadedBook = new Book();
                $loadedBook->id = $row['id'];
                $loadedBook->setName($row['name']);
                $loadedBook->setAuthor($row['author']);
                
                $ret[] = $loadedBook;
            }
        }
        return $ret;
    }
    
            function jsonSerialize() {
        return [
            'id'=>  $this->id,
            'name'=> $this->name,
            'author'=>  $this->author
        ];
    }

}

