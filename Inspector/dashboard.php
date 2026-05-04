<?php
session_start();
include("db.php");

$usuario_id = $_SESSION['usuario_id'];

$sql = "SELECT resultado, COUNT(*) as total 
        FROM mediciones 
        WHERE usuario_id = '$usuario_id'
        GROUP BY resultado";

$result = $conn->query($sql);

$labels = [];
$datos = [];

while($row = $result->fetch_assoc()){
    $labels[] = $row['resultado'];
    $datos[] = $row['total'];
}
?>

<!DOCTYPE html>
<html>
<head>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<h2>Dashboard</h2>

<canvas id="grafica"></canvas>

<script>
let labels = <?php echo json_encode($labels); ?>;
let datos = <?php echo json_encode($datos); ?>;

new Chart(document.getElementById("grafica"), {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [{
            label: 'Piezas',
            data: datos
        }]
    }
});
</script>

<br>
<a href="index.php">Volver</a>

</body>
</html>