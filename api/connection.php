<?php


$host = 'localhost';
$user = 'root';
$password = 'coderslab';
$database = 'books';

$conn = new mysqli($host, $user, $password, $database);
$conn->set_charset("utf8");
if($conn->connect_error){
    die('Połączenie nieudane. Błąd ' . $conn->error);
} 