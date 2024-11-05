<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../style/index.css">

</head>

<body>
    <div class="container mb-4 mt-4">
        <div class="mb-4 d-flex">
            <h1 class="logo">Рецепты коктелей</h1>
        </div>
        <ul class="nav nav-tabs justify-content-center">
            <li class="nav-item"><a href="../index.php" class="nav-link router-link-exact-active router-link-active" target="_self" aria-current="page">Коктели</a></li>
            <li class="nav-item"><a href="#" class="nav-link" target="_self">Случайный</a></li>
            <li class="nav-item"><a href="./search.php" class="nav-link" target="_self">Поиск</a></li>
            <li class="nav-item"><a href="./favorites.php" class="nav-link" target="_self">Избранные</a></li>
            <li class="nav-item"><a target="_self" href="<?php echo isset($_SESSION['username']) ? './userRoom.php' : './login.php'; ?>" class="nav-link">
                    <?php echo isset($_SESSION['username']) ? $_SESSION['username'] : 'Войти/Регистрация'; ?></a>
            </li>
        </ul>
    </div>
    <div class="featured container">
        <div class="featured-recipes">
            <div>
                <h2>Случайный напиток</h2>
                <div class="card-deck" id="load_coctail">
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                    <script>
                        $(document).ready(function() {
                            $.ajax({
                                url: '../php/load_random_cocktail.php', // Замените на путь к вашему PHP-скрипту
                                type: 'GET',
                                success: function(response) {
                                    // Вставляем полученный HTML в нужное место на странице
                                    $('#load_coctail').html(response); // Замените '#cocktailContainer' на селектор вашего контейнера
                                },
                                error: function(jqXHR, textStatus, errorThrown) {
                                    console.log(textStatus, errorThrown);
                                }
                            });
                        });
                    </script>
                </div>
            </div>
        </div>
</body>

</html>