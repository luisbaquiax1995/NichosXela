<script>
    document.addEventListener('DOMContentLoaded', function () {
        const button = document.getElementById('user-menu-button');
        const dropdown = document.getElementById('user-dropdown');
        button.addEventListener('click', () => {
            dropdown.classList.toggle('hidden');
        });
        // Cierra el menú si se hace clic fuera de él
        document.addEventListener('click', function (event) {
            if (!button.contains(event.target) && !dropdown.contains(event.target)) {
                dropdown.classList.add('hidden');
            }
        });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>

