<?php 

//połączenie z bazą danych
$db_name = 'mysql:host=localhost;dbname=food_db1';
$user_name = 'root';
$user_password = '';

$conn = new PDO($db_name, $user_name, $user_password);

?> 

