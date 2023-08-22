<!-- Este archivo es solo para crear un usuario en la DB. Cada vez que se llame la url localhost/user.php se crea un nuevo usuario en la DB con los mismos datos escritos en este archivo -->

<?php

// Importar la conexion a la DB
require 'includes/app.php';
$db_connection = connectDB();

// Crear email y password
$email    = 'correo@correo.com';
$password = 'jklñfdsa';
// md5($password); // Inseguro porque genera siempre el mismo hash

$password_hash = password_hash($password, PASSWORD_BCRYPT);


// Query para crear el user
$query_insert_user = "INSERT INTO users (email, password) VALUES ('${email}', '${password_hash}');";

// Agregarlo a DB
mysqli_query($db_connection, $query_insert_user);