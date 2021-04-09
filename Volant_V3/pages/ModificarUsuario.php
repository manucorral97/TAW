<!DOCTYPE html>
<html dir="ltr" lang="es">

<head>
    <title>ADMIN - MODIFICAR DATOS USUARIOS</title>
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
    <?php
        /*Realizamos conexion con la BD*/
        include ("../includes/ConexDB.php");
        /*Recogemos el ID del cliente por la URL mediante GET*/
        $ID_Clientes = $_GET["ID_Usuario"];
        /*Recogemos la fila de la BD que corresponda*/
        $usuario = "SELECT * FROM Datos_Clientes WHERE ID_Clientes = '$ID_Clientes' ";
        $resultado = mysqli_query($conex, $usuario);
        $row = mysqli_fetch_assoc($resultado);
    ?>
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
        </div>
            <form id="buscador" method="POST" action="../logic/ProcesoModificacionUsuario.php" class="tabla">
                <div class="tabla">
                            <table id="resultados" summary="Viajes posibles con los datos incluidos.">
                                <tr><th>NOMBRE</th><th>EMAIL</th><th>DNI</th><th>CONTRASEÑA</th><th>TIPO</th><th>FECHA REGISTRO</th><th>ROL</th><th>OPERACIÓN</th></tr>
                            <!-- Ocultamos el campo ID pero le necesitamos para hacer la actualizacion -->
                            <tr><td>
                            <input type="hidden"    name="ID_Clientes"       value="<?php echo $row["ID_Clientes"]?>">
                            <input type="text"      name="name"            value="<?php echo $row["Nombre"];?>"           required>
                            </td><td>
                            <input type="email"     name="email"             value="<?php echo $row["Email"];?>"            required>
                            </td><td>
                            <input type="text"      name="DNI"               value="<?php echo $row["DNI"];?>"              required>
                            </td><td>
                            <input type="text"  name="pass"              value="<?php echo $row["Pass"];?>"             required>
                            </td><td>
                            <input type="text"      name="tipo" list="tipo"  value="<?php echo $row["Tipo"]; ?>"            required>
                            </td><td>
                                <datalist id="tipo">
                                    <option value="Profesor">Profesor</option>
                                    <option value="Alumno">Alumno</option>
                                </datalist>
                            <input type="date"      name="fechareg"    value="<?php echo $row["Fecha_Registro"];?>"   required>
                            </td><td>
                            <input type="number" min="1" max="2"     name="rol"        value="<?php echo $row["Privilegio"];?>"       required>
                            </td><td>
                            <input type="submit" value="Modificar" class="pulsador" name="modificarUsuario">
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