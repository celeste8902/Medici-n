<?php
session_start();
include("../db.php");

$usuario_id = $_SESSION['usuario_id'] ?? 0;

// 🔥 OBTENER LIMITES
$sql_limites = "SELECT * FROM limites LIMIT 1";
$res = $conn->query($sql_limites);

if(!$res){
    die("Error en limites: " . $conn->error);
}

$lim = $res->fetch_assoc();

$nominal = $lim['nominal_diam'];
$tol = $lim['tol_diam'];
$lim_red = $lim['lim_red'];
$lim_arm = $lim['lim_arm'];

$lim_inf = $nominal - $tol;
$lim_sup = $nominal + $tol;

// 🔹 DATOS
$d1 = $_POST['d1'];
$d2 = $_POST['d2'];
$d3 = $_POST['d3'];
$d4 = $_POST['d4'];

$r1 = $_POST['r1'];
$r2 = $_POST['r2'];
$r3 = $_POST['r3'];
$r4 = $_POST['r4'];

$a1 = $_POST['a1'];
$a2 = $_POST['a2'];
$a3 = $_POST['a3'];
$a4 = $_POST['a4'];

$modelo = $_POST['modelo'];
$turno = $_POST['turno'];
$maquina = $_POST['maquina'];

// 🔥 LÓGICA
$resultado = "OK";

// DIÁMETROS
foreach([$d1,$d2,$d3,$d4] as $d){
    if($d < $lim_inf || $d > $lim_sup){
        $resultado = "NO OK";
        break;
    }
}

// REDONDEZ
if($resultado != "NO OK"){
    foreach([$r1,$r2,$r3,$r4] as $r){
        if($r > $lim_red){
            $resultado = "DESVIADO";
        }
    }
}

// ARMÓNICOS
if($resultado != "NO OK"){
    foreach([$a1,$a2,$a3,$a4] as $a){
        if($a > $lim_arm){
            $resultado = "DESVIADO";
        }
    }
}

// 🔥 GUARDAR
$sql = "INSERT INTO mediciones 
(usuario_id, modelo, maquina, turno,
diam1,diam2,diam3,diam4,
red1,red2,red3,red4,
arm1,arm2,arm3,arm4,
resultado)

VALUES 
('$usuario_id','$modelo','$maquina','$turno',
'$d1','$d2','$d3','$d4',
'$r1','$r2','$r3','$r4',
'$a1','$a2','$a3','$a4',
'$resultado')";

if(!$conn->query($sql)){
    die("Error al guardar: " . $conn->error);
}

// 🔥 GUARDAR RESULTADO EN SESIÓN
$_SESSION['resultado'] = $resultado;

// 🔥 REDIRECCIÓN
header("Location: index.php");
exit();
?>