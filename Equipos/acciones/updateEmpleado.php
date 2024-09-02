<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include("../config/conexion.php");

    $id = trim($_POST['id']); // Asegúrate de recibir el ID del empleado que se actualizará
    $nombre = trim($_POST['nombre']);
    $apellido = trim($_POST['apellido']);
    $nomina = trim($_POST['nomina']);
    $fecha = ($_POST['fecha']);
    $marca = trim($_POST['marca']);
    $serie = trim($_POST['serie']);
    $puesto = trim($_POST['puesto']);
    $departamento = trim($_POST['departamento']);

    $avatar = null;

    // Verifica si se ha subido un nuevo archivo de avatar
    if (isset($_FILES['avatar']) && $_FILES['avatar']['size'] > 0) {
        $archivoTemporal = $_FILES['avatar']['tmp_name'];
        $nombreArchivo = $_FILES['avatar']['name'];

        $extension = strtolower(pathinfo($nombreArchivo, PATHINFO_EXTENSION));

        // Genera un nombre único y seguro para el archivo
        $dirLocal = "fotos_empleados";
        $nombreArchivo = substr(md5(uniqid(rand())), 0, 10) . "." . $extension;
        $rutaDestino = $dirLocal . '/' . $nombreArchivo;

        if (move_uploaded_file($archivoTemporal, $rutaDestino)) {
            $avatar = $nombreArchivo;
        }
    }

    // Actualiza los datos en la base de datos
    $sql = "UPDATE tbl_entrega
            SET nombre='$nombre', apellido='$apellido', nomina='$nomina', fecha='$fecha', marca='$marca',  numeroserie='$serie', puesto='$puesto', departamento='$departamento'";

    // Si hay un nuevo avatar, actualiza su valor
    if ($avatar !== null) {
        $sql .= ", avatar='$avatar'";
    }

    $sql .= " WHERE id='$id'";

    if ($conexion->query($sql) === TRUE) {
        header("location:../");
    } else {
        echo "Error al actualizar el registro: " . $conexion->error;
    }
}
