<?php
$servername = "localhost";
$username = "root"; // Usuario por defecto de XAMPP
$password = ""; // XAMPP no tiene contraseña por defecto
$database = "system_yasuni";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
