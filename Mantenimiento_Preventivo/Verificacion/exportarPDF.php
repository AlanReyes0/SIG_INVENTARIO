<?php
// Registrar errores en un archivo
ini_set('log_errors', 1);
ini_set('error_log', 'dompdf_errors.log');
error_reporting(E_ALL);

require_once __DIR__ . '/../vendor/autoload.php';
use Dompdf\Dompdf;
use Dompdf\Options;

// Opciones para DOMPDF
$options = new Options();
$options->set('isRemoteEnabled', true);

// Inicializar DOMPDF
$dompdf = new Dompdf($options);

// Conexión a la base de datos
include("../Conexion/config.php");

if (!$conexion) {
    die("La conexión a la base de datos falló.");
}

// Consulta para obtener todos los registros de mantenimiento
$sql = "SELECT * FROM tbl_mantenimiento"; // Ajusta el WHERE según tu necesidad
$result = $conexion->query($sql);

if (!$result) {
    die("Error en la consulta: " . $conexion->error);
}

// Verificar si hay resultados
if ($result->num_rows == 0) {
    die("No hay registros para mostrar.");
}

// Inicia el buffer de salida
ob_start();
?>

<!DOCTYPE html>
<html>
<head>
    <!-- Integrar Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #ffffff;
            color: #000000;
            margin: 0;
            padding: 0;
        }

        .header, .footer {
            width: 100%;
            text-align: center;
            position: fixed;
        }

        .header {
    width: 100%; /* Ocupa todo el ancho disponible */
    text-align: center; /* Centrar contenido */
    position: fixed; /* Posición fija */
    top: -50px; /* Posición desde el borde superior */
    left: 0; /* Posición desde el borde izquierdo */
    right: 0; /* Posición desde el borde derecho */
    height: 150px; /* Altura de la cabecera */
    z-index: -1; /* Z-index para controlar el apilamiento */
        }

        .header img {
            width: 120%; /* Ancho de la imagen (120% del contenedor) */
        height: 160%; /* Altura de la imagen */

        }

        .footer {
            bottom: 0;
            left: 0;
            right: 0;
            height: 50px;
            font-size: 10px;
            font-weight: bold;
        }

        .footer .page-number:after {
            content: counter(page);
        }

        .container {
            width: 100%;
            padding: 20px;
            box-sizing: border-box;
            margin-top: 170px;
            margin-bottom: 70px;
            page-break-inside: avoid;
        }

        .date-table {
            border-collapse: collapse;
            margin-bottom: 20px;
            margin-left: auto;
            margin-right: 0;
            width: auto;
        }

        .date-table th, .date-table td {
            border: 1px solid #000;
            padding: 10px;
            text-align: center;
            font-size: 14px;
        }

        .date-table th {
            background-color: #f2f2f2;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .info-table th, .info-table td {
            border: 1px solid #000;
            padding: 10px;
            text-align: left;
            font-size: 14px;
        }

        .info-table th {
            background-color: #f2f2f2;
        }

        .info-section {
            margin-top: 20px;
        }

        .activity-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .activity-table th, .activity-table td {
            border: 1px solid #000;
            padding: 10px;
            font-size: 14px;
            text-align: left;
        }

        .activity-table th {
            background-color: #f2f2f2;
        }

        .page-break {
            page-break-before: always;
        }

        .title {
            font-size: 18px;
            font-weight: bold;
        }

        .subtitle {
            font-size: 16px;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="http://localhost/Mantenimiento Preventivo/Verificacion/SIG.png" alt="Imagen">
    </div>

    <div class="footer">
        <p>Todos los derechos reservados</p>
        <p class="fixed-text">FSTI-543.00</p>
        <p class="page-number">Página </p>
    </div>

    <?php
    $rowCount = 0;
    while ($row = $result->fetch_assoc()) {
        if ($rowCount > 0) {
            echo '<div class="page-break"></div>';
        }
        $rowCount++;
    ?>
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <center>
                        <div class="title">MANTENIMIENTO PREVENTIVO DE EQUIPOS DE CÓMPUTO</div>
                        <div class="subtitle">Reporte de mantenimiento de Hardware y Software</div>
                    </center>
                </div>
                <div class="col-md-4 text-right">
                    <table class="date-table">
                        <tr>
                            <th>Fecha</th>
                        </tr>
                        <tr>
                            <td><?php echo htmlspecialchars($row['fecha']); ?></td>
                        </tr>
                    </table>
                </div>
            </div>

            <table class="info-table">
                <tr>
                    <th>Nombre</th>
                    <td><?php echo htmlspecialchars($row['nombre'] . ' ' . $row['apellido']); ?></td>
                </tr>
                <tr>
                    <th>No. Empleado</th>
                    <td><?php echo htmlspecialchars($row['nomina']); ?></td>
                </tr>
                <tr>
                    <th>Área</th>
                    <td><?php echo htmlspecialchars($row['cargo']); ?></td>
                </tr>
            </table>

            <div class="info-section">
                <table class="activity-table">
                    <thead>
                        <tr>
                            <th>Mantenimiento Preventivo de Hardware</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php echo htmlspecialchars($row['checklist']); ?></td>
                        </tr>
                    </tbody>
                </table>

                <table class="activity-table">
                    <thead>
                        <tr>
                            <th>Mantenimiento Preventivo de Software</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php echo htmlspecialchars($row['checklist']); ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    <?php
    }
    ?>
</body>
</html>

<?php
// Finaliza el buffer y genera el PDF
$html = ob_get_clean();

$dompdf->loadHtml($html);
$dompdf->setPaper('letter', 'portrait');

$dompdf->set_option('isHtml5ParserEnabled', true);
$dompdf->set_option('isPhpEnabled', true);

$dompdf->render();
$dompdf->stream("Mantenimiento_Preventivo.pdf", array("Attachment" => 1));

$conexion->close();
?>
