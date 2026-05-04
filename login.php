<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: 0");
// Tu lógica PHP aquí (session_start, validación, etc.)
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate, max-age=0">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&family=DM+Sans:wght@400;500&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="estilos/login.css">
   <script>
        history.pushState(null, null, location.href);
        window.onpopstate = function () { history.pushState(null, null, location.href); };
    </script>
   
</head>
<body>
    <div class="login-card">
        <div class="login-icon">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="rgba(139,141,255,0.9)" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/>
            </svg>
        </div>
        <p class="login-title">Iniciar sesión</p>
        <p class="login-subtitle">Bienvenido de nuevo — ingresa tus credenciales</p>

        <form action="loginnn.php" method="POST">
            <div class="field-wrap">
                <label class="field-label">Usuario</label>
                <div style="position:relative">
                    <svg class="field-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/>
                    </svg>
                    <input class="field-input" type="text" name="usuario" placeholder="Tu nombre de usuario" required>
                </div>
            </div>

            <div class="field-wrap">
                <label class="field-label">Contraseña</label>
                <div style="position:relative">
                    <svg class="field-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                    </svg>
                    <input class="field-input" type="password" name="password" placeholder="••••••••" required>
                </div>
            </div>

            <button type="submit" class="btn-submit">Ingresar</button>
        </form>

        <hr>
        <p class="footer-note">Sistema de acceso seguro</p>
    </div>
</body>
</html>