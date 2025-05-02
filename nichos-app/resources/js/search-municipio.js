document.addEventListener("DOMContentLoaded", function () {
    const departamentoSelect = document.getElementById('departamento');
    const municipioSelect = document.getElementById('municipio');

    departamentoSelect.addEventListener('change', function () {
        const departamentoId = this.value;
        municipioSelect.innerHTML = '<option value="0">Seleccione un municipio</option>';
        if (departamentoId) {
            fetch(`/municipios/${departamentoId}`)
                .then(response => response.json())
                .then(data => {
                    data.forEach(municipio => {
                        const option = document.createElement('option');
                        option.value = municipio.id_municipio;
                        option.text = municipio.nombre_municipio;
                        municipioSelect.appendChild(option);
                    });
                })
                .catch(error => {
                    console.error('Error al obtener los municipios:', error);
                });
        }
    });
});
