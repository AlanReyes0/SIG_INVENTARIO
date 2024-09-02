<?php
require_once 'db.php';

header('Content-Type: application/json');

// Obtener datos del formulario
$nombre_apellido = $_POST['nombre'] ?? null;
$nomina = $_POST['nomina'] ?? null;
$puesto = $_POST['puesto'] ?? null;
$producto_componente = $_POST['producto_componente_entrega'] ?? null;
$fecha = $_POST['fecha_entrega'] ?? null;
$cantidad_stock = $_POST['cantidad_stock'] ?? null;

if (!$nombre_apellido || !$nomina || !$puesto || !$producto_componente|| !$fecha || !$cantidad_stock) {
    echo json_encode(['status' => 'error', 'message' => 'Todos los campos son obligatorios']);
    exit;
}



// Insertar los datos en la tabla entregas
$sql = "INSERT INTO entregas (nombre_apellido, nomina, producto_componente_id, fecha, puesto, cantidad_entregada) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $pdo->prepare($sql);

try {
    $stmt->execute([$nombre_apellido, $nomina, $producto_componente, $fecha, $puesto, $cantidad_stock]);
    echo json_encode(['status' => 'success']);
} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
?>
