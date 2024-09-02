<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Redirigir al usuario a la página de inicio de sesión si no está autenticado
    header('Location:../Login/login.php');
    exit;
}
include ("menu.html");

$usuario_logged = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIG Inventario</title>
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <style>
        .button-container {
            display: flex;
            flex-wrap: wrap; /* Permite que los botones se ajusten en pantallas pequeñas */
            gap: 1rem; /* Espacio entre los botones */
            justify-content: center; /* Centra los botones */
            padding: 1rem; /* Espaciado adicional si es necesario */
        }
        
        .btn-primary-custom {
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-primary-custom:hover {
            background-color: #0056b3;
        }
        
        .modal-header.bg-primary {
            background-color: #007bff;
        }
    </style>
</head>
<body>
        
        <main class="main-content">
            <div class="button-container">
                <button id="add-component-btn" class="btn btn-primary btn-primary-custom">
                    <span class="material-icons">add_box</span> Agregar Componente
                </button>
                <button id="add-delivery-btn" class="btn btn-primary btn-primary-custom">
                    <span class="material-icons">local_shipping</span> Agregar Entrega
                </button>
                <button id="verify-stock-btn" class="btn btn-primary btn-primary-custom">
                    <span class="material-icons">inventory</span> Verificación de Stock
                </button>
            </div>

            <div class="search-container mt-3 d-flex justify-content-center">
                <div class="input-group w-100 w-md-50">
                    <input type="text" id="search-nomina" class="form-control form-control-lg" placeholder="Buscar por nómina...">
                    <button id="search-btn" class="btn btn-primary ms-2">
                        <span class="material-icons">search</span> Buscar
                    </button>
                </div>
            </div>

            <div id="results-container" class="mt-3">
                <div class="container bg-white shadow-md rounded-lg p-3">
                    <h2 class="text-center text-xl font-semibold mb-3">Resultados de la Búsqueda</h2>
                    <table class="table table-bordered table-striped">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th>Nomina</th>
                                <th>Nombre y Apellido</th>
                                <th>Producto/Componente</th>
                                <th>Fecha</th>
                                <th>Puesto</th>
                            </tr>
                        </thead>
                        <tbody id="results-body">
                            <!-- Aquí se llenarán los resultados de la búsqueda -->
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <!-- Modals -->
    <!-- Formulario para agregar componentes -->
    <div id="add-component-form" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Formulario de Agregar Componente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="component-form">
                        <div class="mb-3">
                            <label for="producto_componente" class="form-label">Producto/Componente:</label>
                            <input type="text" id="producto_componente" name="producto_componente" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="fecha" class="form-label">Fecha:</label>
                            <input type="date" id="fecha" name="fecha" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="stock" class="form-label">Stock:</label>
                            <input type="number" id="stock" name="stock" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-success w-100">Agregar Componente</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Formulario para agregar entrega -->
    <div id="add-delivery-form" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Formulario de Agregar Entrega</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="delivery-form">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre:</label>
                            <input type="text" id="nombre" name="nombre" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="nomina" class="form-label">Nomina:</label>
                            <input type="text" id="nomina" name="nomina" class="form-control" required maxlength="4">
                        </div>
                        <div class="mb-3">
                            <label for="puesto" class="form-label">Puesto:</label>
                            <input type="text" id="puesto" name="puesto" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="producto_componente_entrega" class="form-label">Producto/Componente:</label>
                            <select id="producto_componente_entrega" name="producto_componente_entrega" class="form-select" required></select>
                        </div>
                        <div class="mb-3">
                            <label for="fecha_entrega" class="form-label">Fecha:</label>
                            <input type="date" id="fecha_entrega" name="fecha_entrega" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="cantidad_stock" class="form-label">Cantidad de Stock para Entregar:</label>
                            <input type="number" id="cantidad_stock" name="cantidad_stock" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-success w-100">Registrar Entrega</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Verificación de stock -->
    <div id="verify-stock" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Verificación de Stock</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table id="stock-table" class="table table-bordered table-striped">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th>Componente/Producto</th>
                                <th>Stock</th>
                                <th>Entregados</th>
                                <th>Total del Stock</th>
                            </tr>
                        </thead>
                        <tbody id="stock-table-body">
                            <!-- Aquí se insertarán las filas dinámicamente -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script src="scripts.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const formComponent = document.getElementById('component-form');
            const formDelivery = document.getElementById('delivery-form');
            const searchInput = document.getElementById('search-nomina');
            const searchButton = document.getElementById('search-btn');
            
            if (formComponent) {
                formComponent.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                        const submitButton = formComponent.querySelector('button[type="submit"]');
                        if (submitButton) {
                            submitButton.click();
                        }
                    }
                });
            }

            if (formDelivery) {
                formDelivery.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                        const submitButton = formDelivery.querySelector('button[type="submit"]');
                        if (submitButton) {
                            submitButton.click();
                        }
                    }
                });
            }

            if (searchInput && searchButton) {
                searchInput.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                        searchButton.click();
                    }
                });
            }
        });
    </script>
</body>
</html>
