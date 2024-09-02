<?php
$servername = "localhost";
$username = "root";
$password = "AdminSIG2024";
$dbname = "SIG_Inventory";

// Crear conexión
$conexion = new mysqli($servername, $username, $password, $dbname);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
?>