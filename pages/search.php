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
            <li class="nav-item"><a href="./random.php" class="nav-link" target="_self">Случайный</a></li>
            <li class="nav-item"><a href="#" class="nav-link" target="_self">Поиск</a></li>
            <li class="nav-item"><a href="./favorites.php" class="nav-link" target="_self">Избранные</a></li>
            <li class="nav-item"><a target="_self" href="<?php echo isset($_SESSION['username']) ? './userRoom.php' : './login.php'; ?>" class="nav-link">
                    <?php echo isset($_SESSION['username']) ? $_SESSION['username'] : 'Войти/Регистрация'; ?></a>
            </li>
        </ul>
    </div>
<div class="container mt-5">
         <h2 class="text-center">Найдите свой напиток</h2>
         <div class="form-group">
            <input type="text" class="form-control" name="inputSearch" id="inputSearch" placeholder="Введите инфомарцию для поиска">
         </div>
      </div>
      <ul id="list" type="none">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
         <script>
            $(document).ready(function() {
               $('#inputSearch').on('input', function() {
                  var searchKeyword = $(this).val();
                  $.ajax({
                     url: '../php/search_coctail.php',
                     type: 'POST',
                     data: {
                        inputSearch: searchKeyword
                     },
                     success: function(data) {
                        $('#list').html(data);
                     }
                  });
               });
            });
         </script>

      </ul>
</body>
</html>