document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("btnRegister").addEventListener("click", function () {
        let usuario = document.getElementById("regUsuario").value;
        let email = document.getElementById("regEmail").value;
        let password = document.getElementById("regPassword").value;

        if (!usuario || !email || !password) {
            alert("Todos los campos son obligatorios");
            return;
        }

        fetch("register.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: `usuario=${usuario}&email=${email}&password=${password}`
        })
        .then(response => response.text())
        .then(data => {
            alert(data);
            if (data.includes("Registro exitoso")) {
                window.location.href = "index.php";
            }
        })
        .catch(error => console.error("Error:", error));
    });

    document.getElementById("btnLogin").addEventListener("click", function () {
        let usuario = document.getElementById("loginUsuario").value;
        let password = document.getElementById("loginPassword").value;

        if (!usuario || !password) {
            alert("Todos los campos son obligatorios");
            return;
        }

        fetch("validar.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: `usuario=${usuario}&password=${password}`
        })
        .then(response => response.text())
        .then(data => {
            alert(data);
            if (data.includes("Inicio de sesión exitoso")) {
                window.location.href = "../home/home.php";
            }
        })
        .catch(error => console.error("Error:", error));
    });
});

function toggleForms() {
    document.getElementById("loginForm").style.display = 
        document.getElementById("loginForm").style.display === "none" ? "block" : "none";
    document.getElementById("registerForm").style.display = 
        document.getElementById("registerForm").style.display === "none" ? "block" : "none";
}
