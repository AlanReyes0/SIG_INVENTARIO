<?php
require_once 'db.php';

header('Content-Type: application/json');

// Unir las tablas entregas y componentes para traer el nombre del componente
$sql = "SELECT e.nomina, e.nombre_apellido, e.fecha, e.puesto, e.cantidad_entregada, c.producto_componente
        FROM entregas e
        JOIN componentes c ON e.producto_componente_id = c.id
        WHERE e.nomina = ?";

$stmt = $pdo->prepare($sql);
$stmt->execute([$_GET['nomina']]);
$deliveries = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($deliveries);
?>
