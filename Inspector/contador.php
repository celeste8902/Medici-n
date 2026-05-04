<?php
session_start();
include("../db.php");

$turno = $_SESSION['turno'] ?? '';
$maquina = $_SESSION['maquina'] ?? '';

$sql = "
SELECT 
modelo,
SUM(CASE WHEN resultado='NO OK' THEN 1 ELSE 0 END) AS malas,
SUM(CASE WHEN resultado='OK' OR resultado='DESVIADO' THEN 1 ELSE 0 END) AS buenas
FROM mediciones
WHERE 
fecha >= NOW() - INTERVAL 1 HOUR
AND turno = '$turno'
AND maquina = '$maquina'
GROUP BY modelo
";

$res = $conn->query($sql);

$datos = [];

if($res){
    while($row = $res->fetch_assoc()){
        $datos[] = $row;
    }
}

echo json_encode($datos);
?>