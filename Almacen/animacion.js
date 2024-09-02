document.addEventListener('DOMContentLoaded', function () {
    // Botón de búsqueda
    document.getElementById('search-btn').addEventListener('click', function() {
        const nomina = document.getElementById('search-nomina').value.trim();
    
        if (nomina === '') {
            alert('Por favor, ingrese una nómina.');
            return;
        }
    
        fetch(`buscar_nomina.php?nomina=${nomina}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('La respuesta de la red no fue correcta');
                }
                return response.json();
            })
            .then(data => {
                const resultsContainer = document.getElementById('results-container');
                const resultsBody = document.getElementById('results-body');
    
                // Limpiar la tabla de resultados
                resultsBody.innerHTML = '';

                if (data.length > 0) {
                    data.forEach(row => {
                        const tr = document.createElement('tr');
                        tr.innerHTML = `
                            <td>${row.nomina}</td>
                            <td>${row.nombre_apellido}</td>
                            <td>${row.producto_componente}</td> <!-- Aquí se muestra el nombre del componente -->
                            <td>${row.fecha}</td>
                            <td>${row.puesto}</td>
                        `;
                        resultsBody.appendChild(tr);
                    });
    
                    // Mostrar la tabla de resultados
                    resultsContainer.classList.remove('d-none');
                } else {
                    resultsContainer.classList.add('d-none');
                    alert('No se encontraron resultados.');
                }
            })
            .catch(error => {
                console.error('Hubo un problema:', error);
                alert('Error al realizar la búsqueda.');
            });
    });
});
