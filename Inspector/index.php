<?php
session_start();
include("../db.php");

// 🔒 PROTEGER ACCESO — FALTABA ESTO
if(!isset($_SESSION['usuario_id'])){
    header("Location: ../login.php");
    exit();
}

// resto de tu código igual...

// guardar selección
if(isset($_POST['turno'])){
    $_SESSION['turno'] = $_POST['turno'];
    $_SESSION['maquina'] = $_POST['maquina'];
}

// 🔒 CERRAR SESIÓN (CORREGIDO)
if(isset($_POST['logout'])){
    session_unset();
    session_destroy();
    setcookie(session_name(), '', time() - 3600, '/');

    header("Location: ../login.php");
    exit();
}

// volver
if(isset($_GET['reset'])){
    session_destroy();
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Inspector</title>
<link rel="stylesheet" href="../estilos/inspector.css">

<!-- 🔒 BLOQUEO BOTÓN ATRÁS -->
<script>
history.pushState(null, null, location.href);
window.onpopstate = function () {
    history.pushState(null, null, location.href);
};
</script>

</head>
<body>

<?php if(!isset($_SESSION['turno'])){ ?>

<h2>Selecciona Turno y Máquina</h2>

<form method="POST">
<select name="turno" required>
    <option value="">Turno</option>
    <option value="1">Turno 1</option>
    <option value="2">Turno 2</option>
    <option value="3">Turno 3</option>
</select>

<select name="maquina" required>
    <option value="">Máquina</option>
    <option value="C">C</option>
    <option value="B">B</option>
    <option value="D">D</option>
</select>

<button type="submit">Continuar</button>
</form>

<?php } else { ?>

<!-- 🔒 BOTÓN FIJO -->
<div style="
    position: fixed;
    top: 10px;
    right: 10px;
    z-index: 9999;
">

    <!-- 🔒 CERRAR SESIÓN -->
    <form method="POST" style="display:inline;">
        <button type="submit" name="logout"
        onclick="return confirm('¿Cerrar sesión?')"
        style="
            background:red;
            color:white;
            padding:10px 14px;
            border:none;
            border-radius:6px;
            cursor:pointer;
            font-weight:bold;">
            🔒 Cerrar sesión
        </button>
    </form>

</div>

<h2>
Turno: <?php echo $_SESSION['turno']; ?> |
Máquina: <?php echo $_SESSION['maquina']; ?>
</h2>



<!-- 🔥 RESULTADO -->
<?php
if(isset($_SESSION['resultado'])){
    $res = $_SESSION['resultado'];

    if($res == "OK"){
        echo "<h2 style='color:green;'>🟢 PIEZA OK</h2>";
    } elseif($res == "DESVIADO"){
        echo "<h2 style='color:orange;'>🟡 PIEZA DESVIADA</h2>";
    } else {
        echo "<h2 style='color:red;'>🔴 PIEZA NO OK</h2>";
    }

    unset($_SESSION['resultado']);
}
?>

<hr>

<form action="guardar.php" method="POST">

<input type="hidden" name="turno" value="<?php echo $_SESSION['turno']; ?>">
<input type="hidden" name="maquina" value="<?php echo $_SESSION['maquina']; ?>">

<h3>Modelo</h3>
<select name="modelo" required>
    <option value="413176">413176</option>
    <option value="413177">413177</option>
    <option value="413111">413111</option>
    <option value="413116">413116</option>
</select>

<h3>Diámetros</h3>
<input name="d1" required>
<input name="d2" required>
<input name="d3" required>
<input name="d4" required>

<h3>Redondez</h3>
<input name="r1" required>
<input name="r2" required>
<input name="r3" required>
<input name="r4" required>

<h3>Armónicos</h3>
<input name="a1" required>
<input name="a2" required>
<input name="a3" required>
<input name="a4" required>

<br><br>
<button type="submit">Guardar</button>

</form>

<hr>

<h3>Producción por hora</h3>

<h3 id="hora"></h3>
<div id="contenedor"></div>

<script>
function actualizarContador(){

    fetch("contador.php")
    .then(res => res.json())
    .then(data => {

        let html = "";

        let ahora = new Date();
        let hora = ahora.getHours();
        let siguiente = hora + 1;

        document.getElementById("hora").innerText = 
            hora + ":00 - " + siguiente + ":00";

        data.forEach(item => {
            html += `
                <p>
                Modelo ${item.modelo} → 
                🟢 ${item.buenas} OK | 
                🔴 ${item.malas} NO OK
                </p>
            `;
        });

        document.getElementById("contenedor").innerHTML = html;
    });
}

setInterval(actualizarContador, 5000);
actualizarContador();
</script>

<?php } ?>

</body>
</html>