<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
        }
        #cocktailForm {
            background: #ffffff;
            margin: 20px 0;
            padding: 20px;
            border-radius: 8px;
        }
        #cocktailForm label {
            font-weight: bold;
            display: block;
            margin: 5px 0;
        }
        #cocktailForm input[type="text"],
        #cocktailForm textarea {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #dddddd;
        }
        #cocktailForm input[type="submit"] {
            display: block;
            width: 100%;
            margin-top: 10px;
            padding: 10px;
            background-color: #333;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        #cocktailForm input[type="submit"]:hover {
            background-color: #444;
        }
        table {
            width: 100%;
            margin: 20px 0;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #333;
            color: #fff;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        img {
            max-width: 100px;
            height: auto;
        }
        a {
            color: #333;
            text-decoration: none;
        }
        a:hover {
            color: #555;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Здравствуйте <?php echo $_SESSION['username']; ?></h1>
        <?php
        if ($_SESSION['username'] == "root") {
            echo "<p>Добавить коктейл</p>";
        ?>
            <form id="cocktailForm">
                <label for="name">Название:</label>
                <input type="text" id="name" name="name">
                <label for="methodCook">Способ приготовления:</label>
                <textarea id="methodCook" name="methodCook" rows="4"></textarea>
                <label for="ingredients">Ингредиенты:</label>
                <textarea id="ingredients" name="ingredients" rows="4"></textarea>
                <label for="image">Изображение:</label>
                <input type="file" id="image" name="image">
                <input type="submit" value="Добавить">
            </form>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script>
                $(document).ready(function() {
                    $("#cocktailForm").submit(function(event) {
                        event.preventDefault();
                        var formData = new FormData();
                        formData.append('name', $('#name').val());
                        formData.append('methodCook', $('#methodCook').val());
                        formData.append('ingredients', $('#ingredients').val());
                        formData.append('image', $('#image')[0].files[0]);

                        $.ajax({
                            url: '../php/add_cocktail.php',
                            type: 'POST',
                            data: formData,
                            processData: false, // tell jQuery not to process the data
                            contentType: false, // tell jQuery not to set contentType
                            success: function(data) {
                                alert(data);
                            }
                        });
                    });
                })
            </script>
        <?php
        }
        ?>
        <a href="../index.php">На главную страницу</a>
        <form action="logout.php" method="post">
            <input type="submit" value="Выйти">
        </form>
    </div>
</body>

</html>


<?php
if (!isset($_SESSION['username'])) {
    // Если пользователь не авторизован, перенаправляем его на страницу входа
    header("Location: login.php");
    exit;
}
// Подключение к базе данных
include "../php/db.php";

if($_SESSION['username'] == "root"){ 
if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}
if($_SESSION['username'] == "root"){ 
    $result = $conn->query("SELECT * FROM coctailreciept");
}
// Выполняем запрос к базе данных
}
if($_SESSION['username'] == "root"){ 
if ($result->num_rows > 0) {
    echo "<table>";
    if($_SESSION['username'] == "root"){ 
        echo "<tr><th>Название</th><th>Метод приготовления</th><th>Ингридиенты</th><th>Фото</th></tr>";
    }
    while ($row = $result->fetch_assoc()) {
        // Выводим данные из базы данных
        if($_SESSION['username'] == "root"){ 
            echo "<tr><td>" . $row["name"] . "</td><td>" . $row["methodCook"] . "</td><td>" . $row["ingredients"] . "</td>";
        }

        // Выводим изображение
        echo "<td><img src='data:image/jpeg;base64," . base64_encode($row['image']) . "' /></td>";
        if($_SESSION['username'] == "root"){ 
            echo "<td><a href='../php/delete.php?idCoctail=" . $row["idCoctail"] ."'>Удалить</a></td></tr>";
        }
    }
    echo "</table>";
} else {
    echo "0 результатов";
}
}
?>
