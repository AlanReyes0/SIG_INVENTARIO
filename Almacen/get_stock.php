<?php
require_once 'db.php';

header('Content-Type: application/json');

// La consulta une las tablas componentes y entregas para traer el nombre del componente
$sql = "SELECT c.producto_componente, c.stock, SUM(e.cantidad_entregada) as entregados
        FROM componentes c
        LEFT JOIN entregas e ON c.id = e.producto_componente_id
        GROUP BY c.id";

$stmt = $pdo->query($sql);
$stock = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($stock);
?>
