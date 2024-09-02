<?php
$servername = "localhost";
$username = "root";
$password = "AdminSIG2024";
$dbname = "subscriptions";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener suscriptores
$sql = "SELECT id, licencia, start_date, end_date, email, sender FROM subscriptions";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $to = $row['email'];
        $subject = "Recordatorio de LICENCIAS";
        $message = "Recordatorio: NO HAS PAGADO laS licencia de " . $row['licencia'] . " desde " . $row['start_date'] . " hasta " . $row['end_date'] . ".";
        $headers = "From: " . $row['sender'];

        if (mail($to, $subject, $message, $headers)) {
            echo "Correo enviado a " . $row['email'] . "<br>";
        } else {
            echo "Error al enviar correo a " . $row['email'] . "<br>";
        }
    }
} else {
    echo "No hay suscriptores.";
}

$conn->close();
?>
