<!DOCTYPE html>
<html dir="ltr" lang="es">

<head>

    <title>Volant - Contacta con nosotros</title>
    <link href="../styles/estilo.css" rel="stylesheet" type="text/css">
    <link href="../styles/estiloCONTACT.css" rel="stylesheet" type="text/css">
    <?php
        include ("../includes/head.php");
    ?>
</head>

<body>
    <?php
        include ("../includes/header.php");
    ?>

    <main>
        <div class="contenedor-correo">
            <h3>¿Qué quieres comentarnos?</h3>
            <form id="correo">
                <label for="emailUser">Introduce tu email</label>
                <input type="email" id="emailUser" placeholder="ejemplo@google.es" autocomplete="off" required>
                <textarea id="texto" cols="40" rows="5" placeholder="Te leemos"></textarea>
                <input type="reset" value="Enviar" onclick="return validarCorreo()">
            </form>
        </div>
    </main>

    <?php
        include ("../includes/footer.php");
    ?>
</body>

</html>