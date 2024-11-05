<?php
// Подключение к базе данных
include "db.php";


if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}

// Запрос к базе данных для получения случайного коктейля
$sql = "SELECT * FROM coctailreciept ORDER BY RAND() LIMIT 1";
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
            <div id="idCoctail" style="display:none;">'.$row['idCoctail'].'</div>
            <div class="card-body">
                <h4 class="card-title">
                    <a href="#" class="" target="_self">
                        <h5>'.$row['name'].'</h5>
                    </a>
                </h4>
                <p class="card-text">'.$row['methodCook'].'</p>
                <p class="card-text">'.$row['ingredients'].'</p>
            </div>
        </div>';
    }
} else {
    echo "Нет результатов";
}
$conn->close();
?>
