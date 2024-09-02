<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Redirigir al usuario a la página de inicio de sesión si no está autenticado
  
    header('Location:../Login/login.php');
    exit;
  }
include ("menu.html");

$usuario_logged =  $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ENTREGA DE EQUIPOS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <link rel="stylesheet" href="assets/css/home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/dataTables.bootstrap5.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<body>
<div class="main-content">
        <div class="header">
            <h2>SERVICIOS INDUSTRIALES GONZÁLEZ</h2>
            <div class="user-info">
                <img src="../imagenes/INICO.png" alt="User Avatar">
                <span>BIENVENIDO:</span>
                <span style="padding: 10px;"><b><?php echo htmlspecialchars($usuario_logged) ?></b></span>
            </div>
        </div>

        <div class="form-container">
            <h3 class="text-center mt-3"></h3>
            <?php
            include("config/conexion.php");
            include("acciones/acciones.php");
            $empleados = obtenerEmpleados($conexion);
            $totalEmpleados = $empleados->num_rows;
            ?>

            <div class="container mt-5">
                <div class="row justify-content-md-center">
                    <div class="col-md-12">
                        <h1 class="text-center mb-3">
                            <span class="float-start">
                                <a href="#" onclick="modalRegistrarEmpleado()" class="btn btn-success" title="Foto">
                                    <i class="bi bi-person-plus"></i>
                                </a>
                            </span>
                            ENTREGA DE EQUIPOS (<?php echo $totalEmpleados ?>)
                            <span class="float-end">
                                <a href="acciones/exportar.php" class="btn btn-success" title="Exportar a CSV" download="remplazo.csv"><i class="bi bi-filetype-csv"></i></a>
                                <a href="acciones/PDF.php" class="btn btn-success" title="Exportar a PDF" download="Entrega_De_Equipos.pdf"><i class="bi bi-filetype-pdf"></i></a>
                            </span>
                            <hr>
                        </h1>
                        <?php include("empleados.php"); ?>
                    </div>
                </div>
            </div>

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
            <script src="assets/js/detallesEmpleado.js"></script>
            <script src="assets/js/addEmpleado.js"></script>
            <script src="assets/js/editarEmpleado.js"></script>
            <script src="assets/js/eliminarEmpleado.js"></script>
            <script src="assets/js/refreshTableAdd.js"></script>
            <script src="assets/js/refreshTableEdit.js"></script>
            <script src="assets/js/alertas.js"></script>
            <!-------------------------Librería  datatable para la tabla -------------------------->
    <script src="https://cdn.datatables.net/2.0.2/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.2/js/dataTables.bootstrap5.js"></script>
    <script>
        $(document).ready(function() {
            $("#table_empleados").DataTable({
                pageLength: 5,
                language: {
                    url: "https://cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json",
                },
            });
        });
    </script>
        </div>
    </div>
</body>
</html>
