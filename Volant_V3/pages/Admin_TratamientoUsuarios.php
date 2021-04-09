<!DOCTYPE html>
<html dir="ltr" lang="es">

<head>
    <title>ADMIN - USUARIOS</title>
    <!-- Incluimos el fichero CSS-->
    <link href="../styles/estilo.css" rel="stylesheet" type="text/css">
    <link href="../styles/estiloINDEX.css" rel="stylesheet" type="text/css">
    <?php
        include("../includes/head.php");
    ?>
</head>

<body>
    <nav>
        <div class="logo">
            <!-- Alt para accesibilidad -->
            <a href="../pages/Admin_TratamientoVuelos.php"> <img src="../images/logo.png" alt="Logo de la empresa" width="350px" height="200px"></a>
        </div>
        <ul class="nav-links" id="nav-links">
            <li><a href="../pages/Admin_TratamientoVuelos.php">Vuelos</a></li>
            <li><a href="../pages/Admin_TratamientoUsuarios.php">Usuarios</a></li>


        </ul>
        <div class="burger">
            <div class="line1"></div>
            <div class="line2"></div>
            <div class="line3"></div>
        </div>
    </nav>
    <main>
        <div class="sesion">
            <?php
            session_start();

            @$rolsesion = $_SESSION['rol'];
            /*Si no existe sesion, o se logea como un usuario, no podra acceder a la pagina de administradores*/
            if ($rolsesion == 2 || !$rolsesion) {
                echo '
                    <script>   
                        window.history.go(-1);
                    </script>
                    ';
                die;
            }
            /*Si tiene el privilegio adecuado, accede a la pagina de administradores*/
            if ($rolsesion == 1) {
                echo 'ESTAS EN LA PÁGINA DE ADMINISTRADORES';

                echo '<a href="../includes/CerrarSesion.php">Cerrar Sesión</a>';
            }
            ?>
        </div>

        <h3>ESTOS SON LOS USUARIOS REGISTRADOS</h3>

        <?php
        /*Realizamos conexion con la BD*/
        include("../includes/ConexDB.php");

        /*Recogemos todos los usuarios almacenados en la BD*/
        $usuarios = "SELECT * FROM Datos_Clientes";
        $resultado = mysqli_query($conex, $usuarios);

        /*Mostramos los resultados en una tabla*/
        if ($resultado) {
        ?>
            <div class="tabla">
                <table id="resultados" summary="Viajes posibles con los datos incluidos.">
                    <tr>
                        <th>NOMBRE</th>
                        <th>EMAIL</th>
                        <th>DNI</th>
                        <th>CONTRASEÑA</th>
                        <th>TIPO</th>
                        <th>FECHA REGISTRO</th>
                        <th>ROL</th>
                        <th>ACCIÓN</th>
                    </tr>

                    <?php
                    /*Vamos recorriendo todos los vuelos*/
                    while ($row = mysqli_fetch_assoc($resultado)) {
                    ?>
                        <tr>
                            <td><?php echo $row["Nombre"];?></td>
                            <td><?php echo $row["Email"];?></td>
                            <td><?php echo $row["DNI"];?></td>
                            <td><?php echo $row["Pass"];?></td>
                            <td><?php echo $row["Tipo"];?></td>
                            <td><?php echo $row["Fecha_Registro"];?></td>
                            <td><?php echo $row["Privilegio"];?></td>
                            <td>
                                <a href="../pages/ModificarUsuario.php?ID_Usuario=<?php echo $row["ID_Clientes"];?>">Modificar</a>
                                <b> | </b>
                                <a href="../logic/EliminarUsuario.php?ID_Usuario=<?php echo $row["ID_Clientes"];?>" class="eliminar">Eliminar</a>
                            </td>
                        </tr>
                    <?php
                    }
            }
            mysqli_free_result($resultado);
            mysqli_close($conex);
            ?>
                </table>
            </div>
    </main>

    <?php
    include("../includes/footer.php");
    ?>

</body>

</html>