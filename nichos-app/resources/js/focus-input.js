document.addEventListener("DOMContentLoaded", () => {
    const inputs = Array.from(document.querySelectorAll("form input, form select, button"));

    inputs.forEach((input, index) => {
        input.addEventListener("keydown", (event) => {
            if (event.key === "Enter") {
                event.preventDefault(); // Evita enviar el formulario

                // Enfocar el siguiente input si existe
                const next = inputs[index + 1];
                if (next) {
                    next.focus();
                }
            }
        });
    });
});
