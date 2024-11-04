<?php

require_once 'config.php';


session_start();


if (!isset($_SESSION['usuario_id'])) {
    echo "Debes iniciar sesión para agregar productos al carrito.";
    exit;
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $usuario_id = $_SESSION['usuario_id'];
    $producto = trim($_POST['producto']);
    $cantidad = intval($_POST['cantidad']);
    $precio = floatval($_POST['precio']);

    if (empty($producto) || $cantidad <= 0 || $precio <= 0) {
        echo "Datos de producto inválidos.";
        exit;
    }
    $stmt = $conn->prepare("INSERT INTO carritos (usuario_id, producto, cantidad, precio) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isid", $usuario_id, $producto, $cantidad, $precio);

    
    if ($stmt->execute()) {
        echo "Producto agregado al carrito exitosamente.";
    } else {
        echo "Error al agregar al carrito: " . $stmt->error;
    }

    
    $stmt->close();
    $conn->close();
} else {
    echo "Método de solicitud inválido.";
}
?>
