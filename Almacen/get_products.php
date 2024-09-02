<?php
require_once 'db.php';

header('Content-Type: application/json');

$sql = "SELECT id, producto_componente FROM componentes";
$stmt = $pdo->query($sql);
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($products);
?>
