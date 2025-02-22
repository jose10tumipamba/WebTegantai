<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login y Registro</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <!-- Logo -->
        <div class="logo">
            <img src="img/tegantai.png" alt="Tegantai">
        </div>

        <!-- Formulario -->
        <div class="form-container">
            <!-- Formulario de Inicio de Sesión -->
            <form id="loginForm">
                <h2>Iniciar Sesión</h2>
                <input type="text" id="loginUsuario" name="usuario" placeholder="Usuario" required>
                <input type="password" id="loginPassword" name="password" placeholder="Contraseña" required>
                <button type="button" id="btnLogin">Ingresar</button>
                <p><br>¿No tienes cuenta? <a href="#" onclick="toggleForms()">Regístrate</a></p>
            </form>

            <!-- Formulario de Registro -->
            <form id="registerForm" style="display: none;">
                <h2>Registro</h2>
                <input type="text" id="regUsuario" name="usuario" placeholder="Usuario" required>
                <input type="email" id="regEmail" name="email" placeholder="Correo Electrónico" required>
                <input type="password" id="regPassword" name="password" placeholder="Contraseña" required>
                <button type="button" id="btnRegister">Registrar</button>
                <p><br>¿Ya tienes cuenta? <a href="#" onclick="toggleForms()">Inicia Sesión</a></p>
            </form>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>
