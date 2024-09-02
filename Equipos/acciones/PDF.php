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
$options->set('isHtml5ParserEnabled', true);

// Inicializar DOMPDF
$dompdf = new Dompdf($options);

// Conexión a la base de datos
include("../config/conexion.php");

if (!$conexion) {
    die("La conexión a la base de datos falló: " . mysqli_connect_error());
}

// Consulta para obtener los registros necesarios
$sql = "SELECT * FROM tbl_entrega"; // Ajusta el WHERE según tu necesidad
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
            font-size: 12px;
        }

        .header {
            width: 100%;
            text-align: center;
            position: fixed;
            top: -50px;
            left: 0;
            right: 0;
            height: 150px;
            z-index: -1;
        }

        .header img {
            width: 120%;
            height: 160%;
        }

        .content {
            position: relative;
            z-index: 1;
            margin-top: 195px;
            padding: 10px;
        }

        .content .info {
            font-size: 12px;
            margin-right: 20px;
        }

        .content .info table {
            width: auto;
            margin: 0;
            padding: 0;
        }

        .text-section {
            margin-top: 10px;
            text-align: justify;
        }

        .table-section {
            margin-top: 10px;
        }

        .table-section table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }

        .table-section th, .table-section td {
            border: 1px solid #000;
            padding: 4px;
            text-align: left;
        }

        .table-section th {
            background-color: #f2f2f2;
        }

        .sign-section {
            margin-top: 50px;
            text-align: center;
        }

        .sign-section .signature {
            width: 30%;
            display: inline-block;
            margin: 5% 1%;
            border-top: 1px solid #000;
            padding-top: 30px;
            font-size: 15px;
        }

        .footer {
            text-align: center;
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            height: 40px;
            font-size: 10px;
            font-weight: bold;
        }

        .footer .page-number:after {
            content: counter(page);
        }

        .page-break {
            page-break-before: always;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="http://localhost/Equipos/acciones/SIG.png" alt="Imagen de fondo">
    </div>
    <?php
    $rowCount = 0;
    while ($row = $result->fetch_assoc()) {
        if ($rowCount > 0) {
            echo '<div class="page-break"></div>';
        }
        $rowCount++;
    ?>
    <div class="content">
        <div class="info">
            <table>
                <tr>
                    <th>Nombre:</th>
                    <td><?php echo htmlspecialchars($row['nombre']); ?></td>
                </tr>
                <tr>
                    <th>Puesto:</th>
                    <td><?php echo htmlspecialchars($row['puesto']); ?></td>
                </tr>
                <tr>
                    <th>Departamento:</th>
                    <td><?php echo htmlspecialchars($row['departamento']); ?></td>
                </tr>
                <tr>
                    <th>Fecha:</th>
                    <td><?php echo htmlspecialchars($row['fecha']); ?></td>
                </tr>
            </table>
        </div>

        <div class="text-section">
            <p>
                El cual me fue asignado como herramienta de trabajo para el desempeño de mis funciones. Me
                comprometo a respetar, aplicar y cumplir las políticas de uso, manejo de información,
                seguridad, asignación y recuperación de equipo, así como todas aquellas que SIG establezca.
            </p>
            <p>
                Al no requerir el equipo y/o programas instalados por razón de terminación de mi relación
                laboral con SERVICIOS INDUSTRIALES GONZALEZ S.A de C.V., reasignación de
                actividades, etc., soy responsable de regresarlos a la Gerencia de TI para la cancelación de
                este documento. En caso de no devolverlo total o parcialmente se me descontará de mi sueldo
                al costo de reposición vigente del mercado; en caso de robo es mi responsabilidad levantar una
                denuncia ante el Ministerio Público y entregar una copia e informar a la Gerencia de RRHH y TI
                para que se hagan los trámites correspondientes.
            </p>
        </div>
    
        <div class="table-section">
            <!-- Primera Tabla -->
            <table>
                <thead>
                    <tr>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Serie</th>
                        <th>S.O.</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>Tipo:</th>
                        <td colspan="3"></td>
                    </tr>
                    <tr>
                        <th>Descripción:</th>
                        <td colspan="3"></td>
                    </tr>
                    <tr>
                        <th>Nombre:</th>
                        <td></td>
                        <th>RAM:</th>
                        <td></td>
                    </tr>
                    <tr>
                        <th>CPU:</th>
                        <td></td>
                        <th>HDD:</th>
                        <td></td>
                    </tr>
                </tbody>
            </table>

            <!-- Segunda Tabla -->
            <table style="margin-top: 10px;">
                <thead>
                    <tr>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Serie</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>Tipo:</th>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <th>Tipo:</th>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <th>Descripción:</th>
                        <td colspan="2"></td>
                    </tr>
                </tbody>
            </table>
        </div>
    
        <div class="sign-section">
            <div class="signature">FIRMA USUARIO</div>
            <div class="signature">FIRMA RH</div>
            <div class="signature">FIRMA GERENTE</div>
        </div>

        <div class="footer">
            <p>FTI-494.00</p>
            <p class="page-number">Página </p>
        </div>
    </div>
    <?php } ?>
</body>
</html>

<?php
// Finaliza el buffer y genera el PDF
$html = ob_get_clean();
$dompdf->loadHtml($html);
$dompdf->setPaper('letter', 'portrait');
$dompdf->render();
$dompdf->stream("Responsiva_Equipos_SIG.pdf", array("Attachment" => 1));
$conexion->close();
?>
