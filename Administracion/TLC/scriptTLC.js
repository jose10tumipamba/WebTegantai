function confirmarEliminacion(id) {
    let confirmar = confirm("¿Estás seguro de que deseas eliminar este archivo?");
    if (confirmar) {
        window.location.href = 'eliminarTLC.php?id=' + id;
    }
}

document.getElementById("formSubida").addEventListener("submit", function(e) {
    e.preventDefault(); // Evitar recarga

    let formData = new FormData(this);
    let mensaje = document.getElementById("mensaje");

    fetch("subirTLC.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        mensaje.innerHTML = data;
        mensaje.style.color = "green";
        actualizarListaArchivos();
        this.reset(); // Limpiar formulario tras subir archivo
    })
    .catch(error => {
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