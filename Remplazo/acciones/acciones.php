<?php
/*
ini_set('display_errors', 1);
error_reporting(E_ALL);
*/
//session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include("../config/conexion.php");
    


    $nombre = $_POST['nombre'];
    $apellido =($_POST['apellido']);
    $nomina = ($_POST['nomina']);
    $sexo = ($_POST['sexo']);
    $telefono = ($_POST['telefono']);
    $puesto = ($_POST['puesto']);
    $departamento =($_POST['departamento']);

    $dirLocal = "fotos_empleados";

    if (isset($_FILES['avatar'])) {
        $archivoTemporal = $_FILES['avatar']['tmp_name'];
        $nombreArchivo = $_FILES['avatar']['name'];

        $extension = strtolower(pathinfo($nombreArchivo, PATHINFO_EXTENSION));

        // Generar un nombre único y seguro para el archivo
        $nombreArchivo = substr(md5(uniqid(rand())), 0, 10) . "." . $extension;
        $rutaDestino = $dirLocal . '/' . $nombreArchivo;

        // Mover el archivo a la ubicación deseada
        if (move_uploaded_file($archivoTemporal, $rutaDestino)) {

            $sql = "INSERT INTO tbl_empleados (nombre, apellido, nomina, sexo, telefono, puesto, departamento ,avatar) 
            VALUES ('$nombre', '$apellido', '$nomina', '$sexo', '$telefono', '$puesto', '$departamento','$nombreArchivo')";

            if ($conexion->query($sql) === TRUE) {
                header("location:../");
            } else {
                echo "Error al crear el registro: " . $conexion->error;
            }
        } else {
            echo json_encode(array('error' => 'Error al mover el archivo'));
        }
    } else {
        echo json_encode(array('error' => 'No se ha enviado ningún archivo o ha ocurrido un error al cargar el archivo'));
    }
}

/**
 * Función para obtener todos los empleados 
 */

function obtenerEmpleados($conexion)
{
    $sql = "SELECT * FROM `tbl_empleados` ORDER BY id ASC";
    $resultado = $conexion->query($sql);
    if (!$resultado) {
        return false;
    }
    return $resultado;
}
