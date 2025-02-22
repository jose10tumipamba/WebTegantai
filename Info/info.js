document.querySelectorAll(".tab-btn").forEach(button => {
    button.addEventListener("click", function () {
        document.querySelectorAll(".tab-btn").forEach(btn => btn.classList.remove("active"));
        document.querySelectorAll(".tab-content").forEach(tab => tab.classList.remove("active"));

        this.classList.add("active");
        document.getElementById(this.dataset.tab).classList.add("active");
    });
});
document.addEventListener("DOMContentLoaded", function () {
    const tabButtons = document.querySelectorAll(".tab-btn");
    const tabContents = document.querySelectorAll(".tab-content");

    tabButtons.forEach(button => {
        button.addEventListener("click", () => {
            // Remover la clase 'active' de todos los botones y pestañas
            tabButtons.forEach(btn => btn.classList.remove("active"));
            tabContents.forEach(content => content.classList.remove("active"));

            // Agregar la clase 'active' a la pestaña seleccionada
            button.classList.add("active");
            document.getElementById(button.dataset.tab).classList.add("active");

            // Agregar animación de fade-in a las tarjetas dentro de la pestaña activa
            setTimeout(() => {
                document.querySelectorAll(".tab-content.active .fade-in")
                    .forEach(el => el.classList.add("fade-in"));
            }, 100);
        });
    });
});
