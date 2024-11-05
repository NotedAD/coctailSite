<?php
session_start();
// подключение к базе данных
include "db.php";


$idCoctail = $_GET['idCoctail'];

// Выполняем запрос к базе данных
$result = $conn->query("DELETE FROM coctailreciept WHERE idCoctail = '$idCoctail'");

if ($result) {
    header('Location: ../pages/userRoom.php');
} else {
    echo "Ошибка удаления записи: " . $conn->error;
}

$conn -> close();
?>