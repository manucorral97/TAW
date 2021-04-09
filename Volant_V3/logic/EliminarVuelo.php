<?php
    /*Realizamos conexion con la BD*/
    include("../includes/ConexDB.php");

    /*Evitamos borrar por URL no siendo admin*/
    session_start();
    @$rolsesion = $_SESSION['rol'];

    if ($rolsesion == 2 || !$rolsesion) {
        echo '
            <script>
                alert(listo...);   
                window.location = "../pages/index.php";
            </script>
            ';
        exit;
    }

    $id_vuelos = $_GET["ID_Vuelos"];

    /*Problemas al eliminar despues de crear tablas de pedidos. ¿Algo que ver las FK? ¿Borrar en cascada?*/

    /*Eliminamos el vuelo en la base de datos*/
    $consulta = "DELETE FROM Vuelos WHERE ID_Vuelos = '$id_vuelos' ";
    $resultado = mysqli_query($conex, $consulta);

    if($resultado){
    echo '
        <script>
            window.location = "../pages/Admin_TratamientoVuelos.php";
        </script>';

    } else {
    echo '
        <script>
            alert("NO ELIMINADO!");
            window.location = "../pages/Admin_TratamientoVuelos.php";
        </script>';
    }

    mysqli_free_result($resultado);
    /*Cerramos la conexión con la BD*/
    mysqli_close($conex);
?>