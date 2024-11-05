<?php
session_start();
// Подключение к базе данных
include "db.php";


if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}

// Получение данных из POST-запроса
$idUser = $_POST['idUser'];
$idCoctail = $_POST['idCoctail'];
$sqlSelect = "SELECT idUser from users where username = '$idUser'";

$result = $conn->query($sqlSelect);

if ($result->num_rows > 0) {
    // Вывод данных каждого ряда
    while($row = $result->fetch_assoc()) {
        // Конвертируем изображение обратно из base64
        $idUserSelect = $row['idUser'];
    }
} else {
    echo "Нет результатов";
}
// Запрос к базе данных для добавления в избранное
$sql = "INSERT INTO favourits (idUser, idCoctail) VALUES ('$idUserSelect', '$idCoctail')";

if ($conn->query($sql) === TRUE) {
    echo "Коктейль успешно добавлен в избранное!";
} else {
    echo "Ошибка: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
