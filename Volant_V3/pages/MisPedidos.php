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
                    echo 'Estas son tus compras, ';
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

            /*Primero seleccionamos los pedidos que ha realizado dicho usuario*/
            $consulta = "SELECT * FROM Pedidos WHERE ID_Usuario = $id_usuario ORDER BY FechaCompra";
            $resultado = mysqli_query($conex, $consulta);
            $filas = mysqli_num_rows($resultado);
            /*Si existen compras*/
            if($filas > 0){
                ?>
                    <table id="resultados">
                        <tbody>
                            <tr>
                                <th>ORIGEN</th>
                                <th>DESTINO</th>
                                <th>SALIDA</th>
                                <th>LLEGADA</th>
                                <th>NÚMERO DE PERSONAS</th>
                                <th>PRECIO POR BILLETE</th>
                                <th>PRECIO TOTAL</th>
                                <th>FECHA DE COMPRA</th>
                            </tr>
                            <?php
                                /*De cada una de las compras realizadas obtenemos el ID_Pedido asociado*/
                                while ($row = mysqli_fetch_assoc($resultado)){
                                    $ID_Pedido = $row["ID_Pedido"];
                                    $FechaCompra = $row["FechaCompra"];
                                    /*A traves del ID_Pedido podemos obtener la tabla de Pedido_vuelo */
                                    $con = "SELECT * FROM Pedido_vuelo WHERE ID_Pedido = $ID_Pedido ";
                                    $res = mysqli_query($conex, $con);
                                    while ($row = mysqli_fetch_assoc($res)){
                                        $Personas = $row["Cantidad"];
                                        /*La tabla Pedido_vuelo tiene asociado el ID_Vuelo*/
                                        $ID_Vuelo = $row["ID_Vuelo"];
                                        /*Con el ID_Vuelo podemos sacar los datos para mostrar al usuario*/
                                        $con = "SELECT * FROM Vuelos WHERE ID_Vuelos = $ID_Vuelo ";
                                        $resul = mysqli_query($conex, $con);
                                        while ($round = mysqli_fetch_assoc($resul)){
                                            $PrecioTotal = $Personas * $round["Precio"];
                                            ?>
                                            <tr>
                                                <td><?php echo $round["Origen"];?></td>
                                                <td><?php echo $round["Destino"];?></td>
                                                <td><?php echo $round["Salida"];?></td>
                                                <td><?php echo $round["Llegada"];?></td>
                                                <td><?php echo $Personas;?></td>
                                                <td><?php echo $round["Precio"];?></td>
                                                <td><?php echo $PrecioTotal;?></td>
                                                <td><?php echo $FechaCompra;?></td>
                                            </tr>
                                            <?php
                                        }
                                    } 
                                }
                            ?>
                        </tbody>
                    </table>
                <?php
                /*Si no existen compras*/
            }else{
                ?>
                    <h3>Lo sentimos... No has realizado ninguna compra en Volant.</h3>
                    <h4><a href="../pages/index.php">EMPEZAR A COMPRAR</a></h4>
                <?php
            }
            
        ?>

    </main>

    <?php
    include ("../includes/footer.php");
    ?>
</body>

</html>