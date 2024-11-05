<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Регистрация и Авторизация</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .form-container { width: 300px; margin: 0 auto; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; }
        .form-group input { width: 100%; padding: 10px; }
        .form-group button { padding: 10px 20px; }
    </style>
</head>
<body>
    <div class="form-container">
        <div class="form-group">
            <label for="username">Имя пользователя:</label>
            <input type="text" id="username" name="username">
        </div>
        <div class="form-group">
            <label for="password">Пароль:</label>
            <input type="password" id="password" name="password">
        </div>
        <div class="form-group">
            <button id="submit">Отправить</button>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#submit').click(function(e){
                e.preventDefault();
                $.ajax({
                    url: '../php/authorize.php',
                    type: 'post',
                    data: {username: $('#username').val(), password: $('#password').val()},
                    success: function(response){
                    location.href = './userRoom.php';
                    }
                });
            });
        });
    </script>
</body>
</html>
