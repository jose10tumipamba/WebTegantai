<?php
$host = "localhost";
$user = "root"; 
$pass = ""; 
$dbname = "system_TLC"; 

// Usar la conexión global
$conexion = new mysqli($host, $user, $pass, $dbname);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
?>
