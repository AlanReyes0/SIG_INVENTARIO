<?php
require_once 'db.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $producto_componente = $_POST['producto_componente'];
    $fecha = $_POST['fecha'];
    $stock = $_POST['stock'];

    $sql = "INSERT INTO componentes (producto_componente, fecha, stock) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$producto_componente, $fecha, $stock]);

    echo json_encode(['status' => 'success']);
}
?>
