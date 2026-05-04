<?php
session_start();
include("db.php");

// 🔒 BLOQUEAR CACHE
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// 🔥 BLOQUEO BOTÓN ATRÁS (refuerzo)
header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");

// 🔥 SI YA ESTÁ LOGUEADO, NO PUEDE VOLVER AL LOGIN
if(isset($_SESSION['usuario_id'])){
    if($_SESSION['rol'] == 'supervisor'){
        header("Location: Supervisor/supervisor.php");
    } else {
        header("Location: Inspector/index.php");
    }
    exit();
}

// 🔐 LOGIN
if($_SERVER["REQUEST_METHOD"] == "POST"){

    $usuario = $_POST['usuario'] ?? '';
    $password = $_POST['password'] ?? '';

    if(empty($usuario) || empty($password)){
        echo "Completa todos los campos";
        exit();
    }

    $password = md5($password);

    $sql = "SELECT * FROM usuarios WHERE usuario = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $usuario, $password);
    $stmt->execute();

    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();

        session_regenerate_id(true); // 🔥 seguridad extra

        $_SESSION['usuario_id'] = $fila['id'];
        $_SESSION['usuario'] = $fila['usuario'];
        $_SESSION['rol'] = $fila['rol'];

        if ($fila['rol'] == 'supervisor') {
            header("Location: Supervisor/supervisor.php");
        } else {
            header("Location: Inspector/index.php");
        }
        exit();

    } else {
        echo "Usuario o contraseña incorrectos";
    }
}
?>