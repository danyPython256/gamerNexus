<?php
require_once 'config.php';

$sql = "SELECT id, nombre, email, fecha_registro FROM usuarios ORDER BY fecha_registro DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>Usuarios Registrados</h2>";
    echo "<table class='table table-striped'>";
    echo "<thead><tr><th>ID</th><th>Nombre</th><th>Email</th><th>Fecha de Registro</th></tr></thead>";
    echo "<tbody>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row["id"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["nombre"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["email"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["fecha_registro"]) . "</td>";
        echo "</tr>";
    }
    echo "</tbody></table>";
} else {
    echo "No hay usuarios registrados.";
}

$conn->close();
?>
