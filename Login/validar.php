<?php
session_start();
include("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = trim($_POST["usuario"]);
    $password = trim($_POST["password"]);

    if (empty($usuario) || empty($password)) {
        exit("Todos los campos son obligatorios.");
    }

    $query = "SELECT * FROM usuario WHERE usuario='$usuario'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user["password"])) {
            $_SESSION["usuario"] = $usuario;
            exit("Inicio de sesión exitoso.");
        } else {
            exit("Contraseña incorrecta.");
        }
    } else {
        exit("Usuario no encontrado.");
    }
}
$conn->close();
?>