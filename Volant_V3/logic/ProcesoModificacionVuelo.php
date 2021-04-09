<?php
    /*Realizamos conexion con la BD*/
    include("../includes/ConexDB.php");

    /*Si se ha pulsado en modificar vuelo*/
    if(isset($_POST['modificarVuelo'])){
        $id_vuelos = $_POST["ID_Vuelos"];
        $origen = trim($_POST['Origen']);
        $destino = trim($_POST['Destino']);
        $salida = trim($_POST['Salida']);
        $llegada = trim($_POST['Llegada']);
        $precio = trim($_POST['Precio']);
        $company = trim($_POST['Company']);

        /*Primera en mayus y resto es minus (de cada palabra)*/
        $origen = ucwords(strtolower($origen));
        $destino = ucwords(strtolower($destino));
        $company = ucwords(strtolower($company));

        if(!$origen || !$destino || !$salida || !$llegada || !$precio || !$company){
            /*Redireccion al formulario por que no esta todo cumplimentado*/
            echo'
                <script>
                    alert("Mal rellenado");
                    window.history.go(-1);
                </script>
            ';
        
        }else {
            $origen = addslashes($origen);
            $destino = addslashes($destino);
            $salida = addslashes($salida);
            $llegada = addslashes($llegada);
            $precio = addslashes($precio);
            $company = addslashes($company);
                    
            /*Insertamos el nuevo vuelo en la base de datos*/
            $consulta = "UPDATE Vuelos SET Origen='$origen', Destino='$destino', Salida='$salida', Llegada='$llegada', Precio='$precio', Company='$company' WHERE ID_Vuelos = '$id_vuelos' ";
            $resultado = mysqli_query($conex, $consulta);
        
            if($resultado){
                echo'
                <script>
                    window.location = "../pages/Admin_TratamientoVuelos.php";
                </script>
            ';
                        
            } else {
                echo'
                <script>
                    alert("NO MODIFICADO!");
                    window.location = "../pages/Admin_TratamientoVuelos.php";
                </script>
            ';
                        
            }
            mysqli_free_result($resultado);
        }
    }
    /*Cerramos la conexión con la BD*/
    mysqli_close($conex);
?>