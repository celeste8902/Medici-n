<?php
$conn = new mysqli("localhost:33065", "root", "", "usuarios");

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>