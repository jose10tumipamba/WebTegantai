<?php
$host = "localhost";
$user = "root"; // Usuario por defecto de XAMPP
$pass = "";
$dbname = "system_login";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>