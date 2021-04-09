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

    $id_usuario = $_GET["ID_Usuario"];

    /*Eliminamos el vuelo en la base de datos*/
    $consulta = "DELETE FROM Datos_Clientes WHERE ID_Clientes = '$id_usuario' ";
    $resultado = mysqli_query($conex, $consulta);

    if($resultado){
    echo '
        <script>
            window.location = "../pages/Admin_TratamientoUsuarios.php";
        </script>';

    } else {
    echo '
        <script>
            alert("NO ELIMINADO!");
            window.location = "../pages/Admin_TratamientoUsuarios.php";
        </script>';
    }

    mysqli_free_result($resultado);
    /*Cerramos la conexión con la BD*/
    mysqli_close($conex);
?>