<!DOCTYPE html>
<html dir="ltr" lang="es">

<head>
    <title>Volant - Iniciar Sesión</title>
    <link href="../styles/estilo.css" rel="stylesheet" type="text/css">
    <link href="../styles/estiloLOGIN.css" rel="stylesheet" type="text/css">
    <?php
        include ("../includes/head.php");
    ?>

</head>
<body>
    <?php
        include ("../includes/header.php");
    ?>

    <main>
        <form id="register-box" method="post" action="../logic/IniciarSesionUsuario.php">
            <div class="form">
                <h2>Iniciar Sesión</h2>
                <div class="grupo">
                    <i class="fas fa-envelope"></i>
                    <input type="email" id="email" name="email" maxlength="100" autocomplete="off" ><span class="barra"></span>
                    <label for="name">Email</label>
                </div>
                <div class="grupo">
                    <i class="fas fa-lock"></i>
                    <input type="password" id="password" name="pass" maxlength="100" autocomplete="off" ><span class="barra"></span>
                    <label for="name">Password</label>
                </div>
                <div class="pregunta">
                    <h4>¿Aún no estas registrado?</h4>
                    <a href="registro-page.php">Registrate</a>
                </div>
                <button type="submit" name="init">Unirse</button>
            </div>
        </form>
    </main>

    <?php
        include ("../includes/footer.php");
    ?>
</body>
</html>