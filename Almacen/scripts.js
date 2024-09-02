document.addEventListener('DOMContentLoaded', function () {
    // Botones para mostrar formularios
    document.getElementById('add-component-btn').addEventListener('click', function () {
        showModal('add-component-form');
    });

    document.getElementById('add-delivery-btn').addEventListener('click', function () {
        showModal('add-delivery-form');
        loadProductComponents(); // Carga los productos al abrir el formulario de entrega
    });

    document.getElementById('verify-stock-btn').addEventListener('click', function () {
        showModal('verify-stock');
        loadStock(); // Carga el stock al abrir la vista de verificación
    });

    // Función para mostrar modales usando Bootstrap
    function showModal(modalId) {
        let modalElement = new bootstrap.Modal(document.getElementById(modalId));
        modalElement.show();
    }

    // Función para cargar los productos/componentes
    function loadProductComponents() {
        fetch('get_products.php') // Archivo PHP que devuelve los productos
        .then(response => {
            if (!response.ok) {
                throw new Error('La respuesta de la red no fue correcta');
            }
            return response.json();
        })
        .then(data => {
            const productSelect = document.getElementById('producto_componente_entrega');
            productSelect.innerHTML = ''; // Limpiar opciones anteriores
            data.forEach(item => {
                const option = document.createElement('option');
                option.value = item.id; // Suponiendo que el JSON tiene un campo 'id'
                option.textContent = item.producto_componente; // Suponiendo que el JSON tiene un campo 'producto_componente'
                productSelect.appendChild(option);
            });
        })
        .catch(error => {
            console.error('Hubo un problema:', error);
        });
    }

    // Función para cargar el stock
    function loadStock() {
        fetch('get_stock.php')
            .then(response => {
                if (!response.ok) {
                    throw new Error('La respuesta de la red no fue correcta');
                }
                return response.json();
            })
            .then(data => {
                const stockTableBody = document.getElementById('stock-table-body');
                stockTableBody.innerHTML = '';
                data.forEach(item => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${item.producto_componente}</td>
                        <td>${item.stock}</td>
                        <td>${item.entregados || 0}</td>
                        <td>${item.stock - (item.entregados || 0)}</td>
                    `;
                    stockTableBody.appendChild(row);
                });
            })
            .catch(error => {
                console.error('Hubo un problema:', error);
            });
    }

    // Formulario de agregar componente
    document.getElementById('component-form').addEventListener('submit', function (e) {
        e.preventDefault();
        const formData = new FormData(e.target);

        Swal.fire({
            title: 'Agregando...',
            text: 'Por favor, espere.',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        fetch('add_component.php', {
            method: 'POST',
            body: formData,
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('La respuesta de la red no fue correcta');
            }
            return response.json();
        })
        .then(data => {
            Swal.close(); // Cierra el loader

            if (data.status === 'success') {
                Swal.fire({
                    title: '¡Éxito!',
                    text: 'Componente agregado con éxito',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
                e.target.reset();
                loadStock(); // Actualiza la vista del stock después de agregar un componente
            } else {
                Swal.fire({
                    title: 'Error',
                    text: 'Error al agregar componente',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        })
        .catch(error => {
            Swal.close(); // Cierra el loader en caso de error
            Swal.fire({
                title: 'Error',
                text: 'Error al agregar componente',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            console.error('Hubo un problema:', error);
        });
    });

    // Formulario de agregar entrega
    document.getElementById('delivery-form').addEventListener('submit', function (e) {
        e.preventDefault();
        const formData = new FormData(e.target);
    
        Swal.fire({
            title: 'Registrando...',
            text: 'Por favor, espere.',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        fetch('add_delivery.php', {
            method: 'POST',
            body: formData,
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('La respuesta de la red no fue correcta');
            }
            return response.json();
        })
        .then(data => {
            Swal.close(); // Cierra el loader

            if (data.status === 'success') {
                Swal.fire({
                    title: '¡Éxito!',
                    text: 'Entrega registrada con éxito',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
                e.target.reset();
                loadStock(); // Actualiza la vista del stock después de registrar una entrega
            } else {
                Swal.fire({
                    title: 'Error',
                    text: `Error al registrar entrega: ${data.message || 'Desconocido'}`,
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        })
        .catch(error => {
            Swal.close(); // Cierra el loader en caso de error
            Swal.fire({
                title: 'Error',
                text: 'Error al registrar entrega',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            console.error('Hubo un problema:', error);
        });
    });

    // Búsqueda de nómina
    document.getElementById('search-btn').addEventListener('click', function() {
        const nomina = document.getElementById('search-nomina').value.trim();
    
        Swal.fire({
            title: 'Buscando...',
            text: 'Por favor, espere.',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        fetch(`buscar_nomina.php?nomina=${nomina}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('La respuesta de la red no fue correcta');
                }
                return response.json();
            })
            .then(data => {
                Swal.close(); // Cierra el loader

                const resultsContainer = document.getElementById('results-container');
                const resultsBody = document.getElementById('results-body');
                resultsBody.innerHTML = '';

                if (data.length > 0) {
                    data.forEach(row => {
                        const tr = document.createElement('tr');
                        tr.innerHTML = `
                            <td>${row.nomina}</td>
                            <td>${row.nombre_apellido}</td>
                            <td>${row.producto_componente}</td>
                            <td>${row.fecha}</td>
                            <td>${row.puesto}</td>
                        `;
                        resultsBody.appendChild(tr);
                    });

                    resultsContainer.classList.add('visible');
                } else {
                    resultsContainer.classList.remove('visible');
                    Swal.fire({
                        title: 'No se encontraron resultados',
                        text: 'No se encontraron coincidencias para tu búsqueda.',
                        icon: 'info',
                        confirmButtonText: 'OK'
                    });
                }
            })
            .catch(error => {
                Swal.close(); // Cierra el loader en caso de error
                Swal.fire({
                    title: 'Error',
                    text: 'Error al realizar la búsqueda.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
                console.error('Hubo un problema:', error);
            });
    });
});