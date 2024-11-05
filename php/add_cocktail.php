<?php
session_start();
include "db.php";

if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_FILES['image']) && isset($_POST['name']) && isset($_POST['methodCook']) && isset($_POST['ingredients'])){
    $name = $_POST['name'];
    $methodCook = $_POST['methodCook'];
    $ingredients = $_POST['ingredients'];
    $image = addslashes(file_get_contents($_FILES['image']['tmp_name'])); //SQL Injection defence!
    $image_name = addslashes($_FILES['image']['name']);
    $sql = "INSERT INTO `coctailreciept` (`name`, `methodCook`, `ingredients`, `image`) VALUES ('$name', '$methodCook', '$ingredients', '{$image}');";
    if ($conn->query($sql) === TRUE) {
        echo "Новая запись создана!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Пожалуйста заполните все поля!";
}
?>
