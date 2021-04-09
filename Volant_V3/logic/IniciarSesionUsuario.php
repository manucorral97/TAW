<?php
    include("../includes/ConexDB.php");

    $mail = $_POST['email'];
    $pass = $_POST['pass'];

    if(isset($_POST['init'])){
        $consulta = "SELECT * FROM Datos_Clientes WHERE Email = '$mail' and Pass = '$pass' ";
        $resultado = mysqli_query($conex, $consulta);

        $filas = mysqli_num_rows($resultado);
        if($filas > 0){
            /*Iniciamos sesion*/
            session_start();
            
            /*Podemos leer los datos*/
            $res = mysqli_fetch_array($resultado);
            $_SESSION['usuario'] = $res['Nombre'];
            

            /*Validamos el privilegio del usuario*/
            $rol = $res['Privilegio'];
            $_SESSION['rol'] = $rol;

            /*ID del cliente logado*/
            $id = $res['ID_Clientes'];
            $_SESSION['id'] = $id;
   
            /*Admin*/
            if($rol == 1){
                header("Location: ../pages/Admin_TratamientoVuelos.php");
            }
            /*Usuario*/
            if($rol == 2){
                header("Location: ../pages/index.php");
            }
        }
        else{
            echo'
            <script>
                alert("Usuario no existe. Por favor, registarte aqui");
                window.location = "../pages/registro-page.php";
            </script>
            ';
        }
        mysqli_free_result($resultado);
    }
    mysqli_close($conex);

?>