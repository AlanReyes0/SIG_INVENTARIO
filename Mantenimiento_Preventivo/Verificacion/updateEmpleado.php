<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include("../Conexion/config.php");

    $id = trim($_POST['id']); // Asegúrate de recibir el ID del empleado que se actualizará
    $nombre = trim($_POST['nombre']);
    $apellido = trim($_POST['apellido']);
    $nomina = trim($_POST['nomina']);
    $fecha = $_POST['fecha'];
    $estado = trim($_POST['estado']);
    $equipo = trim($_POST['equipo']);
    $cargo = trim($_POST['cargo']);
    $checklist = trim($_POST['checklist']);

    // Imprimir los datos recibidos
    echo "Datos recibidos: ";
    echo "ID: $id, Nombre: $nombre, Apellido: $apellido, Nomina: $nomina ,Fecha: $fecha, Estado: $estado,  equipo: $equipo, Cargo: $cargo, checklist: $checklist";

    // Actualiza los datos en la base de datos
    $sql = "UPDATE tbl_mantenimiento 
            SET nombre='$nombre', apellido='$apellido', nomina= '$nomina' ,fecha='$fecha', estado='$estado', equipo='$equipo', cargo='$cargo', checklist='$checklist' WHERE id='$id'";

    if ($conexion->query($sql) === TRUE) {
        echo "Se actualizo: ";
    } else {
        echo "Error al actualizar el registro: " . $conexion->error;
    }
}
