<?php
include "conn.php";
session_start(); // Iniciar la sesión

if (!empty($_POST["validar"])) {
    $inputUsername = $_POST['username'];
    $inputPassword = $_POST['pass'];

    // Verificación de campos vacíos
    if (empty($inputUsername) || empty($inputPassword)) {
        echo "Ambos campos son obligatorios.";
    } else {
        // Consulta para verificar las credenciales del usuario
        $sql = "SELECT * FROM Inicio WHERE username = '$inputUsername' and pass = '$inputPassword'";
        $result = $conn->query($sql);
        
        if ($result->num_rows == 1) {
            // Guardar el nombre de usuario en la sesión
            $_SESSION['username'] = $inputUsername;
            $_SESSION['loggedin'] = true;
            header("Location:../Remplazo/index.php");
            exit(); // Asegura que el script se detenga después de redirigir
        } else {
            echo "No existes en mi base de datos.";
        }
    }
} else {
    echo "Formulario no enviado correctamente.";
}

$conn->close();
?>
