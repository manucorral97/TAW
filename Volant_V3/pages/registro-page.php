<!DOCTYPE html>
<html dir="ltr" lang="es">

<head>
    <title>Volant - Registro</title>
    <link href="../styles/estilo.css" rel="stylesheet" type="text/css">
    <link href="../styles/estiloREGISTRO.css" rel="stylesheet" type="text/css">
    <?php
        include ("../includes/head.php");
    ?>
</head>
<body>
    <?php
        include ("../includes/header.php");
    ?>
    <main>
        <!-- action=formulario.php
        GET se envian datos por URL (no es seguro, asique no sirve para password)
        POST es transparente para el usuario 
        ENCTYPE = ''-->
        <form id="register-box" method="post" action="../logic/RegistrarUsuario.php">
            <div class="form">
                <h2>Registrate</h2>
                <div class="grupo">
                    <i class="fas fa-user-tie"></i>
                    <!--Añadir maxlength con el máximo posible en la BD -->
                    <input type="text" id="name" name="name" maxlength="50" autocomplete="off" ><span class="barra"></span>
                    <label for="name">Nombre</label>
                </div>
                <div class="grupo">
                    <i class="fas fa-address-card"></i>
                    <input type="text" id="DNI" name="DNI" maxlength="9" autocomplete="off" ><span class="barra"></span>
                    <label for="name">DNI</label>
                </div>
                <div class="grupo">
                    <i class="fas fa-envelope"></i>
                    <input type="email" id="email" name="email" maxlength="50" autocomplete="off" ><span class="barra"></span>
                    <label for="name">Email</label>
                </div>
                <div class="grupo">
                    <i class="fas fa-lock"></i>
                    <input type="password" id="password" name="pass" maxlength="50" autocomplete="off" ><span class="barra"></span>
                    <label for="name">Password</label>
                </div>
                <div class="grupo2">
                    <i class="fas fa-people-arrows"></i>

                    <input type="radio" name="tipo" id="Alumno" value="Alumno">
                    <label for="Alumno">Alumno</label>

                    <?php /*$type = ''; if($type == "Profesor") echo "checked";*/ ?>
                    <input type="radio" name="tipo" id="Profesor" value="Profesor">
                    <label for="Profesor">Profesor</label>
                </div>
                <div class="pregunta">
                    <h4>¿Ya estas registrado?</h4>
                    <a href="login-page.php">Inicia sesión</a>
                </div>
                <!-- Meter quizá algun input tipo checkbox o diferente por conocimeinto-->
                <!-- ¡¡¡¡¡¡ Mejor usar input en vez de button !!!!-->
                <button type="submit" name="register">Unirse</button>
            </div>
        </form>
    </main>

    <?php
        include ("../includes/footer.php");
    ?>
</body>
</html>