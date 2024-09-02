<?php
// Descomentar para depurar errores
ini_set('display_errors', 1);
error_reporting(E_ALL);

//session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include("../Conexion/config.php");

    $nombre = trim($_POST['nombre']);
    $apellido = trim($_POST['apellido']);
    $nomina = trim($_POST['nomina']);
    $fecha = $_POST['fecha'];
    $estado = trim($_POST['estado']);
    $equipo = trim($_POST['equipo']);
    $cargo = trim($_POST['cargo']);
    $checklist = $_POST['checklist'];

    // Convierte el array del checklist en una cadena separada por comas
    $checklistStr = implode(", ", $checklist);

    // Imprimir los datos recibidos
    echo "Datos recibidos: ";
    echo "Nombre: $nombre, Apellido: $apellido, Nomina: $nomina , Fecha: $fecha, Estado: $estado , Equipo: $equipo, Cargo: $cargo, Checklist: $checklistStr";

    // Escapar entradas para evitar inyección SQL
    $nombre = $conexion->real_escape_string($nombre);
    $apellido = $conexion->real_escape_string($apellido);
    $nomina = $conexion->real_escape_string($nomina);
    $fecha = $conexion->real_escape_string($fecha);
    $estado = $conexion->real_escape_string($estado);
    $equipo = $conexion->real_escape_string($equipo);
    $cargo = $conexion->real_escape_string($cargo);
    $checklistStr = $conexion->real_escape_string($checklistStr);

    // Asegúrate de definir el nombre de la tabla
    $tabla = 'tbl_mantenimiento'; // Reemplaza con el nombre correcto de tu tabla

    $sql = "INSERT INTO $tabla (nombre, apellido, nomina, fecha, estado, equipo, cargo, checklist) 
            VALUES ('$nombre', '$apellido', '$nomina', '$fecha', '$estado', '$equipo', '$cargo', '$checklistStr')";
            
    if ($conexion->query($sql) === TRUE) {
        echo "Registro creado exitosamente";
    } else {
        echo "Error al crear el registro: " . $conexion->error;
    }
}

//validar que existen las variables
if(isset($_POST['checklist'])){
    $checklist = $_POST['checklist'];
}else{
    $checklist = [];
}



/**
 * Función para obtener todos los empleados 
 */

function obtenerEmpleados($conexion)
{
    $sql = "SELECT * FROM `tbl_mantenimiento` ORDER BY id ASC";
    $resultado = $conexion->query($sql);
    if (!$resultado) {
        return false;
    }
    return $resultado;
}
?>
