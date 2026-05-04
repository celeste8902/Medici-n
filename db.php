<?php
$host = "localhost:33065";
$user = "root";
$pass = "";
$db = "usuarios"; // 👈 cambia por el nombre real de tu BD

$conn = new mysqli($host, $user, $pass, $db);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Opcional pero recomendable
$conn->set_charset("utf8");
?>