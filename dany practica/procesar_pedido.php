<?php

require_once 'config.php';

$data = json_decode(file_get_contents("php://input"), true);

if ($data) {
    foreach ($data as $producto) {
        $nombre = $conn->real_escape_string($producto['nombre']);
        $precio = $producto['precio'];
        $cantidad = $producto['cantidad'];

        $sql = "INSERT INTO pedidos (nombre_producto, precio, cantidad) VALUES ('$nombre', $precio, $cantidad)";

        if (!$conn->query($sql)) {
            echo "Error: " . $conn->error;
            exit;
        }
    }

    echo "Pedido realizado con éxito.";
} else {
    echo "Error al procesar el pedido.";
}


$conn->close();
?>
