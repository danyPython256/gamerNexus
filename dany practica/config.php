<?php

$servername = "localhost";
$username = "root";
$password = "";
$bdname = "gamer_nexus"; 

$conn = new mysqli($servername, $username, $password, $bdname);

if($conn->connect_error){
    die("Conexion fallida: ". $conn->connect_error);
}
?>