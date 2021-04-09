<!DOCTYPE html>
<html dir="ltr" lang="es">

<head>
    <title>ADMIN - MODIFICAR DATOS VUELOS</title>
    <!-- Incluimos el fichero CSS-->
    <link href="../styles/estiloMODIFICAR.css" rel="stylesheet" type="text/css">
    <link href="../styles/estilo.css" rel="stylesheet" type="text/css">
    
    <?php
        include ("../includes/head.php");
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
                if($rolsesion == 2 || !$rolsesion){
                    echo'
                    <script>   
                        window.history.go(-1);
                    </script>
                    ';
                    die;
                }
                /*Si tiene el privilegio adecuado, accede a la pagina de administradores*/
                if($rolsesion == 1){
                    echo 'ESTAS EN LA PÁGINA DE ADMINISTRADORES';
                    
                    echo '<a href="../includes/CerrarSesion.php">Cerrar Sesión</a>';
                }
            ?>
            <?php
                /*Realizamos conexion con la BD*/
                include ("../includes/ConexDB.php");
                /*Recogemos el ID del vuelo por la URL mediante GET*/
                $ID_Vuelos = $_GET["ID_Vuelos"];
                /*Recogemos la fila de la BD que corresponda*/
                $vuelo = "SELECT * FROM Vuelos WHERE ID_Vuelos = '$ID_Vuelos'";
                $resultado = mysqli_query($conex, $vuelo);
                $row = mysqli_fetch_assoc($resultado);
            ?>
        </div>
            <form id="buscador" method="POST" action="../logic/ProcesoModificacionVuelo.php" class="tabla">
                <div class="tabla">
                            <table id="resultados" summary="Viajes posibles con los datos incluidos.">
                                <tr><th>ORIGEN</th><th>DESTINO</th><th>SALIDA</th><th>LLEGADA</th><th>PRECIO</th><th>COMPAÑIA</th><th>OPERACIÓN</th></tr>
                            <tr><td>
                            <!-- Ocultamos el campo ID pero le necesitamos para hacer la actualizacion -->
                            <input type="hidden"           name="ID_Vuelos"value="<?php echo $row["ID_Vuelos"]?>">
                            <input type="text"             name="Origen"   value="<?php echo $row["Origen"];?>"    required>
                            </td><td>
                            <input type="text"             name="Destino"  value="<?php echo $row["Destino"];?>"   required>
                            </td><td>
                            <!-- No funciona con input datetime-local (no aparece en la BD)-->
                            <input type="datetime"         name="Salida"   value="<?php echo $row["Salida"];?>"    required>
                            </td><td>
                            <input type="datetime"         name="Llegada"  value="<?php echo $row["Llegada"];?>"   required>
                            </td><td>
                            <input type="text"             name="Precio"   value="<?php echo $row["Precio"]; ?>"   required>
                            </td><td>
                            <input type="text"             name="Company"  value="<?php echo $row["Company"];?>"   required>
                            </td><td>
                            <input type="submit" value="Modificar" class="pulsador" name="modificarVuelo">
                            </td></tr>
                            </table>
                </div>
            </form>

    </main>

    <?php
        mysqli_free_result($resultado);
        mysqli_close($conex);
        include ("../includes/footer.php");
    ?>

</body>

</html>