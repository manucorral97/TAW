<!DOCTYPE html>
<html dir="ltr" lang="es">

<head>
    <title>Volant - Carrito</title>
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
                    echo 'Este es tu carrito, ';
                    echo $varsesion;

                    echo' <a href="../includes/CerrarSesion.php">Cerrar Sesión</a>';
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
            include ("../includes/ConexDB.php");
            
            /*Mostraremos los viajes sleccioandos por el usuario*/
            $id_usuario = $_SESSION['id'];
            
        ?>

        <!-- Mostrar lo que hemos añadido en el carrito -->
        <!-- El form y el action por si quiero usar inputs y enviar la info por post -->
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">
        <table id="resultados">
            <tbody>
                <?php
                    /*Si el carrito NO esta vacio mostramos la lista*/
                    if(!empty($_SESSION['Carrito'])){
                        ?>
                        <tr>
                            <th>ORIGEN</th>
                            <th>DESTINO</th>
                            <th>SALIDA</th>
                            <th>LLEGADA</th>
                            <th>NÚMERO DE PERSONAS</th>
                            <th>PRECIO BILLETE</th>
                            <th>PRECIO TOTAL</th>
                        </tr>
                    <?php
                        /*Para cada uno de los items agregados en el carrito ¿o hacerlo con count?*/
                        foreach($_SESSION['Carrito'] as $id_vuelo => $cantidad ){
                            /*Recogemos los datos de los vuelos a partir del ID del vuelo, sacado de la tabla del carrito*/
                            $datosVuelo = "SELECT * FROM Vuelos WHERE ID_Vuelos = '$id_vuelo' ";
                            $datosVuelos = mysqli_query($conex, $datosVuelo);
                            $res = mysqli_fetch_assoc($datosVuelos);     
                    ?>
                <tr>
                    <!-- Mejor ponerlo a input para hacer un form y en el submit que aparezca abajo el calendario y el procesar compra -->
                    <td><input type="text"   value="<?php echo $res["Origen"];?>"   readonly></td>
                    <td><input type="text"   value="<?php echo $res["Destino"];?>"  readonly></td>
                    <td><input type="text"   value="<?php echo $res["Salida"];?>"   readonly></td>
                    <td><input type="text"   value="<?php echo $res["Llegada"];?>"  readonly></td>
                    <!-- El numero de pasajeros (cantidad) lo recogemos de la primera consulta (row) que recogimos por GET -->
                    <td><?php echo $cantidad;?></td>
                    <?php
                        @$precioVuelo = ($cantidad*$res["Precio"]);
                        @$precioTotal = $precioTotal + $precioVuelo;     
                    ?>
                    <td><?php echo $res["Precio"].'€';?></td>
                    <td><?php echo $precioVuelo.'€';?></td>

                    <!-- Pasamos el ID de la fila del carrito y la accion de borrado -->
                    <td><a href="../logic/TratamientoCarrito.php?ID_Vuelo=<?php echo $id_vuelo;?>&action=delete" class="eliminar">Eliminar</a></td>
                </tr>
                <?php
                    }
                ?>
                <tr>

                    <td colspan="6"><h3 class="total">TOTAL</h3></td>
                    <td><h4><?php echo @$precioTotal.'€';?></h4></td>
                </tr>
                <tr>
                    <!-- Enviar a chekout o mirar algo para que salga justo debajo el calendario de envio -->
                    <td colspan="7"><input type="submit" class="comprar" name="comprar" value="IR A CHECKOUT"></td>
                </tr>
                <?php
                    // Si esta vacio avisamos por pantalla 
                    } else {
                ?>
                
                    <h3>Tu carrito esta vacio...</h3>
                    <h4><a href="../pages/index.php">EMPEZAR A COMPRAR</a></h4>
                <?php    
                    }
                ?>
            </tbody>
        </table>
        </form>
    </main>

    <!-- Aquí aparecera el calendario para que el usuario eliga el dia de envio de los billetes y finalice la compra-->
    <?php
        if(isset($_POST['comprar'])){
            include ("../includes/calendar.php");
           ?>
                <form action="../logic/Checkout.php" method="POST">
                    <table class="fin">
                        <caption>Elija el dia de envio de los billetes</caption>
                        <tbody>
                            <label for="envioBilletes"></label>
                            <tr>
                                <td>
                                    <input type="date" name="envioBilletes" id="Salida" min="" onclick="minDay()" required>
                                </td> 
                            </tr>
                                <input type="hidden" value="<?php echo $precioTotal;?>" name="Precio_Total">
                            <tr>
                                <td>
                                    <input type="submit" name="fin" value="FINALIZAR COMPRA">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            <?php
            
            /*Hacer el calendario en Calendario.php y hacer un include.
            Ver que tengo que registrar en la ultima tabla*/
        }
    ?>
    <?php
    include ("../includes/footer.php");
    ?>
</body>

</html>