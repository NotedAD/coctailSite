<?php
session_start();
include "db.php";


// Проверяем соединение
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Получаем данные из POST-запроса
$post_username = $_POST['username'];
$post_password = $_POST['password'];

// Проверяем, существует ли пользователь
$sql = "SELECT * FROM users WHERE username = '$post_username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // Пользователь существует, проверяем пароль
  $row = $result->fetch_assoc();
  if ($row['passwords'] == $post_password) {
    $_SESSION['username'] = $row['username'];
    echo "Успешная авторизация!";
  } else {
    echo "Неверный пароль!";
  }
} else {
  // Пользователя не существует, регистрируем нового пользователя
  $sql = "INSERT INTO users (username, passwords) VALUES ('$post_username', '$post_password')";
  if ($conn->query($sql) === TRUE) {
    $_SESSION['username'] = $post_username;
    echo "Успешная регистрация!";
  } else {
    echo "Ошибка: " . $sql . "<br>" . $conn->error;
  }
}

$conn->close();
?>
