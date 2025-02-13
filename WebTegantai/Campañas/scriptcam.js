document.querySelectorAll(".tab-btn").forEach(button => {
    button.addEventListener("click", function () {
        const archivo = this.getAttribute("data-tab");

        // Remueve la clase 'active' de todos los botones
        document.querySelectorAll(".tab-btn").forEach(btn => btn.classList.remove("active"));
        this.classList.add("active"); // Activa el botón seleccionado

        // Cargar el contenido dinámicamente con fetch()
        fetch(archivo)
            .then(response => response.text())
            .then(data => {
                document.getElementById("contenido-dinamico").innerHTML = data;
            })
            .catch(error => console.error("Error al cargar el archivo:", error));
    });
});
