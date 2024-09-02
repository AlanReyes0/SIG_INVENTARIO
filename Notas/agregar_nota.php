<?php
/*Inicia validación del lado del servidor*/
if (empty($_POST['note-has-title'])) {
    $errors[] = "Ingresa el título de la nota";
} else if (!empty($_POST['note-has-title'])) {
    require_once("conexion.php"); // Contiene función que conecta a la base de datos
    
    $titulo = mysqli_real_escape_string($link, strip_tags($_POST["note-has-title"], ENT_QUOTES));
    $descripcion = mysqli_real_escape_string($link, strip_tags($_POST["note-has-description"], ENT_QUOTES));
    $date_added = date("Y-m-d H:i:s");
    
    $sql = "INSERT INTO notas (titulo, descripcion, fecha, categoria) 
            VALUES ('$titulo', '$descripcion', '$date_added', 'social');";
    
    $query_new_insert = mysqli_query($link, $sql);
    
    if ($query_new_insert) {
        $messages[] = "La nota ha sido ingresada satisfactoriamente.";
    } else {
        $errors[] = "Lo siento, algo ha salido mal. Intenta nuevamente. " . mysqli_error($link);
    }
} else {
    $errors[] = "Error desconocido.";
}

if (isset($errors)) {
    ?>
    <div class="alert alert-danger" role="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Error!</strong>
        <?php
        foreach ($errors as $error) {
            echo $error;
        }
        ?>
    </div>
    <?php
}

if (isset($messages)) {
    ?>
    <div class="alert alert-success" role="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>¡Bien hecho!</strong>
        <?php
        foreach ($messages as $message) {
            echo $message;
        }
        ?>
    </div>
    <?php
}
?>
