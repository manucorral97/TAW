<!DOCTYPE html>
<html dir="ltr" lang="es">

<head>
    <title>ADMIN - VUELOS</title>
    <!-- Incluimos el fichero CSS-->
    
    <link href="../styles/estilo.css" rel="stylesheet" type="text/css">
    <link href="../styles/estiloINDEX.css" rel="stylesheet" type="text/css">
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
        </div>

        <h3>INTRODUCE UN NUEVO VIAJE</h3>
        <form id="buscador" method="POST" action="../logic/RegistrarVuelo.php">
            <!-- Divido el buscador en una lista con dos filas -->
            <ol>
                <input type="text" placeholder="Origen" list="listaOrigen" name="Origen" autocomplete="off" required>
                <datalist id="listaOrigen">
                    <option value="Madrid">Madrid</option>
                    <option value="Londres">Londres</option>
                    <option value="Milan">Milan</option>
                </datalist>

                <input type="text" placeholder="Destino" list="listaDestino" name="Destino" autocomplete="off" required>
                <datalist id="listaDestino">
                    <option value="Madrid">Madrid</option>
                    <option value="Londres">Londres</option>
                    <option value="Milan">Milan</option>
                </datalist>

                <label for="Salida">Salida</label>
                <input type="datetime-local" name="Salida" id="Salida" min="" onclick="minDay()" required>

                <label for="Vuelta">Llegada</label>
                <input type="datetime-local" name="Llegada" id="Llegada" min="" onclick="minDay()" required>

                <input type="text" placeholder="Precio"     name="Precio" autocomplete="off" required>
                <input type="text" placeholder="Compañia"   name="Company" autocomplete="off" required>

            </ol>
            <ol>
                <!-- Envio el origen y destino seleccionado para la posterior tabla-->
                <input type="submit" value="Agregar" class="pulsador" name="registrarVuelo">

            </ol>
        </form>

        <h3>ESTOS SON LOS VUELOS DISPONIBLES ACTUALMENTE</h3>
        
        <?php
            /*Realizamos conexion con la BD*/
            include("../includes/ConexDB.php");

            /*Recogemos todos los vuelos almacenados en la BD*/
            $consulta = "SELECT * FROM Vuelos";
            $resultado = mysqli_query($conex, $consulta);

            /*Mostramos los resultados en una tabla*/
            if($resultado){
                ?>
                    <div class="tabla">
                        <table id="resultados" summary="Viajes posibles con los datos incluidos.">
                            <tr>
                                <th>ORIGEN</th>
                                <th>DESTINO</th>
                                <th>SALIDA</th>
                                <th>LLEGADA</th>
                                <th>PRECIO</th>
                                <th>COMPAÑIA</th>
                                <th>OPERACIÓN</th>
                            </tr>
                <?php
                /*Vamos recorriendo todos los vuelos*/
                while($row = mysqli_fetch_assoc($resultado)){
                    ?>
                        <tr>
                            <td><?php echo $row["Origen"];?></td>
                            <td><?php echo $row["Destino"];?></td>
                            <td><?php echo $row["Salida"];?></td>
                            <td><?php echo $row["Llegada"];?></td>
                            <td><?php echo $row["Precio"]; echo '€';?></td>
                            <td><?php echo $row["Company"];?></td>
                            <td>
                                <a href="../pages/ModificarVuelo.php?ID_Vuelos=<?php echo $row["ID_Vuelos"];?>">Modificar</a>
                                <b> | </b>
                                <a href="../logic/EliminarVuelo.php?ID_Vuelos=<?php echo $row["ID_Vuelos"];?>" class="eliminar">Eliminar</a>
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
        include ("../includes/footer.php");
    ?>

</body>

</html>