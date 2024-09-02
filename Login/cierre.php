<?php
session_start();

$_SESSION = [];

// Destruir la sesión
session_destroy();


// session_start();
// session_unset(); // Eliminar todas las variables de sesión
// session_destroy(); // Destruir la sesión
http_response_code(200);

// Redirigir al usuario al login después de destruir la sesión
// header("Location: ../Login/login.php");
// exit;

