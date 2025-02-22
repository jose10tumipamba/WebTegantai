document.getElementById("formSubida").addEventListener("submit", function(e) {
    e.preventDefault();
    
    let formData = new FormData(this);
    let mensaje = document.getElementById("mensaje");

    fetch("subirTLC.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        mensaje.innerHTML = data;
        mensaje.style.color = data.includes("Error") ? "red" : "green";
        actualizarListaArchivos();
        this.reset();
    })
    .catch(error => {
        console.error("Error:", error);
        mensaje.innerHTML = "Error al subir el archivo.";
        mensaje.style.color = "red";
    });
});

function actualizarListaArchivos() {
    fetch("listarTLC.php")
    .then(response => response.text())
    .then(data => {
        document.getElementById("contenidoTabla").innerHTML = data;
    });
}

function recargarDespuesDeEnviar() {
    setTimeout(function() {
        location.reload();
    }, 500); // Recarga la página después de 0.5 segundos
}

