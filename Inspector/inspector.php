<?php
session_start();

if ($_SESSION['rol'] != 'inspector') {
    header("Location: login.php");
    exit();
}
?>

<h2>Panel Inspector</h2>
<p>Bienvenido <?php echo $_SESSION['usuario']; ?></p>