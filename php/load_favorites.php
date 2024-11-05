<?php
session_start();
// Подключение к базе данных
include "db.php";


if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}

// Получение id пользователя из сессии
$idUser = $_SESSION['username'];
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
// Запрос к базе данных для получения избранных коктейлей
// Запрос к базе данных для получения избранных коктейлей
$sql = "SELECT coctailreciept.*, favourits.idFav FROM coctailreciept 
        INNER JOIN favourits ON coctailreciept.idCoctail = favourits.idCoctail 
        WHERE favourits.idUser = '$idUserSelect'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Вывод данных каждого ряда
    while($row = $result->fetch_assoc()) {
        // Конвертируем изображение обратно из base64
        $imageSrc = "data:image/jpeg;base64," . base64_encode( $row['image'] );
        echo '
        <div to="#" class="card mb-4" style="min-width: calc(33.333% - 30px);">
            <a href="#" class="" target="_self">
                <img src="'.$imageSrc.'" alt="'.$row['name'].'" class="card-img-top">
            </a>
            <div id="idFav" style="display:none;">'.$row['idFav'].'</div>
            <div class="card-body">
                <h4 class="card-title">
                    <a href="#" class="" target="_self">
                        <h5>'.$row['name'].'</h5>
                    </a>
                </h4>
                <p class="card-text">'.$row['methodCook'].'</p>
                <p class="card-text">'.$row['ingredients'].'</p>
                <button class="btn btn-outline-primary btn-block">Убрать из избранного</button>
            </div>
        </div>';
    }
} else {
    echo "Нет результатов";
}
$conn->close();
?>
