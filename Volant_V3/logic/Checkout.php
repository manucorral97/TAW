<?php
    /*Realizamos conexion con la BD*/
    include("../includes/ConexDB.php");

    /*Si se ha pulsado en finalizar compra*/
    if(isset($_POST['fin'])){
        session_start();
        $ID_Usuario = $_SESSION['id'];
        $FechaEnvio = $_POST['envioBilletes'];       
        $PrecioTotal = $_POST['Precio_Total'];

        /*No deberia de ser posible*/
        if (!$FechaEnvio || !$ID_Usuario || !$PrecioTotal){
            /*Redireccion al formulario por que no esta todo cumplimentado*/
            echo'
                <script>
                    alert("Mal rellenado");
                    window.history.go(-1);
                </script>
            ';
        }else{
            $FechaActual = getdate();
            $FechaActual = $FechaActual['year'] . "-" . $FechaActual['mon'] . "-" . $FechaActual['mday'] . " " . $FechaActual['hours'] . ":" . $FechaActual['minutes'] . ":" . $FechaActual['seconds'];
                
            $consulta1 = "INSERT INTO Pedidos (ID_Usuario, PrecioTotal, FechaCompra, FechaEnvio) VALUES ($ID_Usuario,$PrecioTotal,'".$FechaActual."', '".$FechaEnvio."')";
            $resultado = mysqli_query($conex, $consulta1);

            /*SELECT DEL ID_PEDIDO */
            $consulta2 = "SELECT * FROM Pedidos WHERE ID_Usuario = $ID_Usuario AND FechaCompra = '".$FechaActual."' ";
            $res = mysqli_query($conex, $consulta2);
            $row = mysqli_fetch_assoc($res);
            $ID_Pedido = $row["ID_Pedido"];
 
            foreach($_SESSION['Carrito'] as $id_vuelo => $cantidad ){
                /*INSERT */
                $consulta3 = "INSERT INTO Pedido_vuelo (ID_Pedido, ID_Vuelo, Cantidad) VALUES ($ID_Pedido,$id_vuelo,$cantidad)";
                $r = mysqli_query($conex, $consulta3);
            }
        }

        if($r){
            echo'
            <script>
                window.location = "../pages/index.php";
                alert("Gracias por comprar en Volant!");
            </script>
            ';
        /*Tendremos que borrar el carrito una vez se realice la compra*/
        unset($_SESSION['Carrito']);

        }else{
            echo'
            <script>
                alert("NO se ha completado tu peticion!");
                window.location = "../pages/index.php";
            </script>
        '; 
        }
        mysqli_free_result($resultado);
        mysqli_free_result($res);
        mysqli_free_result($r);
    }
    /*Cerramos la conexión con la BD*/
    mysqli_close($conex);
?>