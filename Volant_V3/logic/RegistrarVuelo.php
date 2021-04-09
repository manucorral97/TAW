<?php
    /*Realizamos conexion con la BD*/
    include("../includes/ConexDB.php");

    /*Si se ha pulsado en Agregar vuelo*/
    if(isset($_POST['registrarVuelo'])){
        /*Evitamos campos vacios elimiando espacios en blanco*/
        $origen     = trim($_POST['Origen']);
        $destino    = trim($_POST['Destino']);
        $salida     = trim($_POST['Salida']);
        $llegada    = trim($_POST['Llegada']);
        $precio     = trim($_POST['Precio']);
        $company    = trim($_POST['Company']);

        /*Primera en mayus y resto es minus*/
        $origen  = ucwords(strtolower($origen));
        $destino = ucwords(strtolower($destino));
        $company = ucwords(strtolower($company));

        /*Si no se han introducido todos los datos*/
        if(!$origen || !$destino || !$salida || !$llegada || !$precio || !$company){
            /*Redireccion al formulario por que no esta todo cumplimentado*/
            echo'
                <script>
                    alert("Mal rellenado");
                    window.history.go(-1);
                </script>
            ';
        }else{
            /*Añadimos / en los caracteres extraños y en los espacios para su almacenamiento en la base de datos*/
            $origen     = addslashes($origen);
            $destino    = addslashes($destino);
            $salida     = addslashes($salida);
            $llegada    = addslashes($llegada);
            $precio     = addslashes($precio);
            $company    = addslashes($company);
            
            /*Insertamos el nuevo vuelo en la base de datos*/
            $consulta = "INSERT INTO Vuelos(Origen, Destino, Salida, Llegada, Precio, Company) VALUES ('$origen','$destino','$salida','$llegada','$precio','$company')";
            $resultado = mysqli_query($conex, $consulta);

            if($resultado){
                echo'
                <script>
                    window.location = "../pages/Admin_TratamientoVuelos.php";
                </script>
            ';
                
            }else{
                echo'
                <script>
                    alert("NO registrado!");
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