<?php
include("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = trim($_POST["usuario"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    if (empty($usuario) || empty($email) || empty($password)) {
        exit("Todos los campos son obligatorios.");
    }

    $checkQuery = "SELECT * FROM usuario WHERE usuario='$usuario' OR email='$email'";
    $result = $conn->query($checkQuery);

    if ($result->num_rows > 0) {
        exit("El usuario o email ya están registrados.");
    }

    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    $query = "INSERT INTO usuario (usuario, email, password) VALUES ('$usuario', '$email', '$passwordHash')";

    if ($conn->query($query) === TRUE) {
        exit("Registro exitoso. Redirigiendo...");
    } else {
        exit("Error al registrar: " . $conn->error);
    }
}
$conn->close();
?>
