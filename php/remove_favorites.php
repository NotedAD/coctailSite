<?php
session_start();
// Подключение к базе данных
include "db.php";


if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}

// Получение данных из POST-запроса
$idFav = $_POST['idFav'];
// Запрос к базе данных для добавления в избранное
$sql = "DELETE FROM favourits WHERE idFav = '$idFav'";

if ($conn->query($sql) === TRUE) {
    echo "Коктейль успешно удален из избранного!";
} else {
    echo "Ошибка: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>