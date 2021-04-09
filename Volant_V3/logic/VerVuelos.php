<!DOCTYPE html>
<html dir="ltr" lang="es">

<head>
    <title>Estos son tus vuelos</title>
    <!-- Incluimos el fichero CSS-->
    <link href="../styles/estilo.css" rel="stylesheet" type="text/css">
    <link href="../styles/estiloCARRITO.css" rel="stylesheet" type="text/css">
    <?php
        include ("../includes/head.php");
    ?>
</head>

<body>
    <?php
        include ("../includes/header.php");
    ?>

    <main>
        <div class="sesion">
            <?php
                @$varsesion = $_SESSION['usuario'];
                if($varsesion){
                    echo 'Bienvenido ';
                    echo $varsesion;
                    echo' <a href="../includes/CerrarSesion.php">Cerrar Sesión</a>';
                    
                    ?><a href="../pages/MostrarCarrito.php" class="fas fa-shopping-cart" id="icon"><?php
                    echo ' ';
                    /*Colocamos el numero de elementos incluidos en el carrito*/
                    echo (empty($_SESSION['Carrito']))?0:count($_SESSION['Carrito']);  
                    ?></a>
                    <?php
                }
                
                /*Tiene que estar registrado y autenticado para ver los vuelos*/
                else{
                    echo'
                    <script>
                        alert("Por favor, inicia sesión");
                        window.location = "../pages/login-page.php";
                    </script>
                    ';
                    die;
                }
            ?>
        </div>

        <?php
            /*Realizamos conexion con la BD*/
            include("../includes/ConexDB.php");

            /*Recogemos que tipo de busqueda realiza el usuario*/
            $accion = $_GET["action"];

            /*Para buscar por una palabra concreto, por ejemplo, mostrar los vuelos con origen y destino MADRID:
                //Esta funciona OK
                $consulta = "SELECT * FROM Vuelos WHERE Origen = '$origen' OR Destino = '$origen' ";
                //Para esta tendria que modificar la BD
                $consulta = "SELECT * FROM Vuelos WHERE MATCH * AGAINST ('$PALABRA_CLAVE') ";
            */
            

            if($accion == "all"){
                $consulta = "SELECT * FROM Vuelos ORDER BY Salida";
            }

            else if($accion == "price"){
                @$PrecioMinimo = $_POST['min'];
                @$PrecioMaximo = $_POST['max'];
                /*Evitamos accesos inadecuados*/
                if(!$PrecioMaximo || !$PrecioMinimo){
                    echo'
                    <script>
                        alert("no....");
                        window.location = "../pages/index.php";
                    </script>
                    ';
                }
                
                $consulta = "SELECT * FROM Vuelos WHERE Precio BETWEEN '$PrecioMinimo' AND '$PrecioMaximo' ORDER BY Precio ";
            }

            else if($accion == "find"){
                $origen = $_POST['Origen'];
                $destino = $_POST['Destino'];
                $cantidad = $_POST['Personas'];
                $fecha = $_POST['Salida'];
                /*Evitamos accesos inadecuados*/
                if(!$origen || !$destino || !$cantidad || !$fecha){
                    echo'
                    <script>
                        alert("no....");
                        window.location = "../pages/index.php";
                    </script>
                    ';
                }

                /*Vamos a realizar una consulta filtrando por meses*/

                /*explode*/
                /*Transforma una fecha en formato ingles a formato UNIX*/
                $fechaTroceada = strtotime($fecha);
                /*Obtenemos el mes en formato 01 a 12*/
                $mes = date("m", $fechaTroceada);
                /*Obtenemos el año en formato de 4 cifras*/
                $year = date("Y", $fechaTroceada);

                $Year_Month = $year . '-' . $mes;

                /*Asi funciona*/
                /* _____$mes% */
                $consulta = "SELECT * FROM Vuelos WHERE Origen = '$origen' AND Destino = '$destino' AND Salida LIKE '$Year_Month%' ORDER BY Salida ";

                /*Para proporcionar el nombre del mes elegido (aunque sea en ingles)*/
                $month = date("F", $fechaTroceada);
                ?>
                    <h4>Debido a la baja disponibilidad de vuelos, te ofrecemos los vuelos del mes de <?php echo $month;?></h4>
                <?php
            }

            else{
                echo'
                <script>
                    alert("no....");
                    window.location = "../pages/index.php";
                </script>
            ';
            }

            $resultado = mysqli_query($conex, $consulta);

            /*Comprobamos si existe algun vuelo disponible*/
            $filas = mysqli_num_rows($resultado);
            if($filas > 0){
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
                                <!-- Simplemente añadimos la columna de personas si accede a la lista de vuelos mediante
                                una busqueda por precio o si lista todos los vuelos del sistema -->
                                <?php
                                    if($accion == "price" || $accion == "all"){
                                        ?>
                                            <th>PERSONAS</th>
                                        <?php
                                    }
                                ?>

                            </tr>
                    
                <?php
                /*Vamos recorriendo todos los vuelo*/
                /*mysqli_fetch_assoc devuelve un array de la fila obtenida del conjunto de resultados,
                donde cada clave del array representa el nombre de una de las columnas de éste*/
                while($row = mysqli_fetch_assoc($resultado)){
                    ?>
                        <tr>
                            <form action="
                            <?php
                                if($accion == "price" || $accion == "all"){
                                    ?>../logic/TratamientoCarrito.php?ID_Vuelo=<?php echo $row["ID_Vuelos"];?>&action=addFromAll" method="POST"><?php
                                }
                                else{
                                    /*¿Problemas? -> Funciona*/
                                    ?>../logic/TratamientoCarrito.php?ID_Vuelo=<?php echo $row["ID_Vuelos"];?>&action=add&personas=<?php echo $cantidad;?>" method="POST"><?php
                                }
                            ?>
                            
                                <input type="hidden"   value="<?php echo $row["ID_Vuelos"];?>">
                                <td><input type="text" value="<?php echo $row["Origen"];?>"         readonly></td>
                                <td><input type="text" value="<?php echo $row["Destino"];?>"        readonly></td>
                                <td><input type="text" value="<?php echo $row["Salida"];?>"         readonly></td>
                                <td><input type="text" value="<?php echo $row["Llegada"];?>"        readonly></td>
                                <td><input type="text" value="<?php echo $row["Precio"];echo '€';?>"readonly></td>
                                <td><input type="text" value="<?php echo $row["Company"];?>"        readonly></td>
                                <?php
                                    if($accion == "price" || $accion == "all"){
                                        ?>
                                            <td><input type="number" name="personas" min='1' max='5'            required></td>
                                        <?php
                                    }
                                ?>
                                <td>
                                    <input type="submit" name="AgregarCarrito" value="Agregar al carrito">
                                </td>
                            </form>
                        </tr>
                    <?php
                }
            }else{
                ?>
                    <h3>Lo sentimos... No hay vuelos disponibles a tus necesidades.</h3>
                    <h4><a href="../pages/index.php">¿Hacer otra busqueda?</a></h4>
                <?php
                
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