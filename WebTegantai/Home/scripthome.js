document.addEventListener("DOMContentLoaded", function () {
    // Funcionalidad de los botones del menú
    document.querySelectorAll("nav ul li a").forEach(button => {
        button.addEventListener("click", function (event) {
            event.preventDefault(); // Evita el comportamiento predeterminado del enlace
            const href = this.getAttribute("href"); // Obtiene la URL del atributo href
            if (href) {
                window.location.href = href; // Redirige a la URL especificada
            }
        });
    });

    // Funcionalidad del buscador
    document.querySelector("form").addEventListener("submit", function (event) {
        event.preventDefault(); // Evita el envío del formulario
        const query = document.querySelector("input[name='query']").value; // Obtiene el valor del input de búsqueda
        if (query.trim() !== "") {
            window.location.href = `buscar.php?query=${encodeURIComponent(query)}`; // Redirige a buscar.php con la query
        } else {
            alert("Por favor, escribe algo para buscar."); // Alerta si el input está vacío
        }
    });
});
