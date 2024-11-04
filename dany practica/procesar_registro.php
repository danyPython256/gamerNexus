<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $nombre = $conn-> real_escape_string(trim($_POST['nombre']));
    $email = $conn-> real_escape_string(trim($_POST['email']));
    $contraseña = $conn-> real_escape_string(trim($_POST['contraseña']));

    if (empty($nombre) || empty($email) || empty($contraseña)){
        echo "Por favor complete todos los campos. ";
        exit;
    }

    if (!filter_var ($email, FILTER_VALIDATE_EMAIL)){
        echo "Formato de correo electronio invalido";
        exit;
    }

    if (strlen($contraseña) <6 ){
        echo "La contraseña debe tener al menos 6 caracteres.";
        exit;

    }

    $contraseña_hashed = password_hash($contraseña, PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios (nombre, email, contrasena) VALUES ('$nombre', '$email', '$contraseña_hashed' )";

    if ($conn->query($sql)=== TRUE){
        echo "Registro exitoso. ¡Bienvenido, " .  htmlspecialchars($nombre) . "!";
    } else{
        if($conn->errno == 1062){
            echo "El correo ingresado ya esta registrado.";

        } else {
            echo "Error: ". $conn->error;
        }
    }

    $conn-> close();
} else{
    echo "Metodo de solicitud no valido.";
}
?>