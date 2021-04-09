<!DOCTYPE html>
<html dir="ltr" lang="es">

<head>
    <title>Volant - Configurar mis datos</title>
    <!-- Incluimos el fichero CSS-->
    <link href="../styles/estiloMODIFICAR.css" rel="stylesheet" type="text/css">
    <link href="../styles/estilo.css" rel="stylesheet" type="text/css">
    
    <?php
        include ("../includes/head.php");
    ?>
</head>
<body>
    <?php
        include ("../includes/header.php");
    ?>

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
        </div>
            <form id="buscador" method="POST" action="../logic/ProcesoModificacionUsuario.php" class="tabla">
                <div class="tabla">
                            <table id="resultados" >
                                <tr><th>NOMBRE</th><th>EMAIL</th><th>DNI</th><th>CONTRASEÑA</th><th>TIPO</th><th>OPERACIÓN</th></tr>
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
                            <input type="hidden"      name="fechareg"    value="<?php echo $row["Fecha_Registro"];?>"   required>
                            
                            <input type="hidden" min="1" max="2"     name="rol"        value="<?php echo $row["Privilegio"];?>"       required>
                            
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