<?php
session_start();
include("../db.php");

// 🔒 BLOQUEAR CACHE
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// 🔐 PROTEGER ACCESO
if(!isset($_SESSION['usuario_id'])){
    header("Location: ../login.php");
    exit();
}

// 🔒 CERRAR SESIÓN (CORREGIDO)
if(isset($_POST['logout'])){
    session_unset();
    session_destroy();
    setcookie(session_name(), '', time() - 3600, '/');

    header("Location: ../login.php");
    exit();
}



// 🔥 FILTROS
$fecha = $_GET['fecha'] ?? date("Y-m-d");
$turno = $_GET['turno'] ?? 1;

// 🔥 SALUDO
if($turno == 1){
    $saludo = "BUENOS DÍAS ☀️";
} elseif($turno == 2){
    $saludo = "BUENAS TARDES 🌤️";
} else {
    $saludo = "BUENAS NOCHES 🌙";
}

// 🔥 HORARIOS
if($turno == 1){
    $inicio = "$fecha 06:30:00";
    $fin    = "$fecha 16:00:00";
}
elseif($turno == 2){
    $inicio = "$fecha 16:00:00";
    $fin    = date("Y-m-d", strtotime($fecha . " +1 day")) . " 00:30:00";
}
else{
    $inicio = "$fecha 00:30:00";
    $fin    = "$fecha 06:30:00";
}

// 🔥 BLOQUES 2 HORAS
$bloques = [];
$inicio_ts = strtotime($inicio);
$fin_ts = strtotime($fin);

while($inicio_ts < $fin_ts){
    $fin_bloque = strtotime("+2 hours", $inicio_ts);

    if($fin_bloque > $fin_ts){
        $fin_bloque = $fin_ts;
    }

    $bloques[] = [
        "inicio" => date("Y-m-d H:i:s", $inicio_ts),
        "fin" => date("Y-m-d H:i:s", $fin_bloque)
    ];

    $inicio_ts = $fin_bloque;
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Supervisor</title>
</head>
<body>
<link rel="stylesheet" href="../estilos/supervisor.css">

<!-- 🔒 BOTONES -->
<div style="position:absolute; top:10px; right:10px;">

    <!-- 🔒 CERRAR SESIÓN (POST) -->
    <form method="POST" style="display:inline;">
        <button type="submit" name="logout" onclick="return confirm('¿Cerrar sesión?')"
        style="
            background:red;
            color:white;
            padding:8px 12px;
            border:none;
            border-radius:5px;
            cursor:pointer;">
            🔒 Cerrar sesión
        </button>
    </form>

</div>

<h2>📊 Reporte Supervisor</h2>

<!-- 🔎 FILTRO -->
<form method="GET">
    <input type="date" name="fecha" value="<?php echo $fecha; ?>" required>

    <select name="turno" required>
        <option value="1" <?php if($turno==1) echo "selected"; ?>>Turno 1</option>
        <option value="2" <?php if($turno==2) echo "selected"; ?>>Turno 2</option>
        <option value="3" <?php if($turno==3) echo "selected"; ?>>Turno 3</option>
    </select>

    <button type="submit">Generar</button>
</form>

<hr>

<pre>

*<?php echo $saludo; ?>*
*COMPARTO CUMPLIMIENTO DE PIEZAS MEDIDAS*

Fecha: <?php echo $fecha; ?>
Turno: <?php echo $turno; ?>

Área de metrología

<?php

$lista_maquinas = ['C','B','D'];

foreach($bloques as $b){

    echo "\n⏱️ " . date("H:i", strtotime($b['inicio'])) . " - " . date("H:i", strtotime($b['fin'])) . "\n";

    $sql = "
    SELECT 
    maquina,
    modelo,
    SUM(CASE WHEN resultado='NO OK' THEN 1 ELSE 0 END) AS malas,
    SUM(CASE WHEN resultado='OK' OR resultado='DESVIADO' THEN 1 ELSE 0 END) AS buenas
    FROM mediciones
    WHERE fecha BETWEEN '{$b['inicio']}' AND '{$b['fin']}'
    GROUP BY maquina, modelo
    ";

    $res = $conn->query($sql);

    if(!$res){
        echo "Error: " . $conn->error;
        continue;
    }

    $datos = [];

    while($row = $res->fetch_assoc()){
        $datos[$row['maquina']][] = $row;
    }

    foreach($lista_maquinas as $maq){

        echo "\n🟩 Máquina $maq\n";

        if(isset($datos[$maq])){
            foreach($datos[$maq] as $m){
                echo $m['modelo'] . ": 🟢 " . $m['buenas'] . " OK | 🔴 " . $m['malas'] . " NO OK\n";
            }
        } else {
            echo "Sin producción\n";
        }
    }
}

?>

</pre>

</body>
</html>