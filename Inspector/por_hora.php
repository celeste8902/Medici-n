<?php
session_start();
include("db.php");

$usuario_id = $_SESSION['usuario_id'];

$sql = "
SELECT 
    HOUR(fecha) AS hora,
    resultado,
    COUNT(*) AS total
FROM mediciones
WHERE usuario_id = '$usuario_id'
GROUP BY HOUR(fecha), resultado
ORDER BY hora
";

$result = $conn->query($sql);

$datos = [];

while($row = $result->fetch_assoc()){
    $hora = $row['hora'];
    $resultado = $row['resultado'];
    $total = $row['total'];

    if(!isset($datos[$hora])){
        $datos[$hora] = ["OK"=>0, "DESVIADO"=>0, "NO OK"=>0];
    }

    $datos[$hora][$resultado] = $total;
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Conteo por hora</title>
</head>
<body>

<h2>Conteo por Hora</h2>

<table border="1">
<tr>
    <th>Hora</th>
    <th>OK</th>
    <th>DESVIADO</th>
    <th>NO OK</th>
</tr>

<?php foreach($datos as $hora => $valores){ ?>
<tr>
    <td><?php echo $hora; ?>:00</td>
    <td><?php echo $valores["OK"]; ?></td>
    <td><?php echo $valores["DESVIADO"]; ?></td>
    <td><?php echo $valores["NO OK"]; ?></td>
</tr>
<?php } ?>

</table>

<br>
<a href="index.php">Volver</a>

</body>
</html>