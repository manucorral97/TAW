<?php
    /*Realizamos conexion con la BD*/
    include("../includes/ConexDB.php");

    /*Si se ha pulsado en modificar usuario*/
    if(isset($_POST['modificarUsuario'])){
        $id_usuario = $_POST["ID_Clientes"];
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $DNI = trim($_POST['DNI']);
        $pass = trim($_POST['pass']);
        $type = $_POST['tipo'];
        
        @$fechareg = $_POST['fechareg'];
        @$rol = trim($_POST['rol']);

        /*Primera en mayus y resto es minus*/
        $name = ucwords(strtolower($name));

        /*Corroboro DNI*/
        $patronDNI = "/^[0-9]{1,8}[a-zA-Z]{1}$/";
            if(!preg_match($patronDNI, $DNI)){
                echo'
                <script>
                    alert("Mal rellenado el DNI");
                    window.history.go(-1);
                </script>
                ';
                exit;
            }

        if(!$name || !$email || !$DNI || !$pass || !$type || !$fechareg || !$rol){
            /*Redireccion al formulario por que no esta todo cumplimentado*/
            echo'
                <script>
                    alert("Mal rellenado");
                    window.history.go(-1);
                </script>
            ';
        
        }else {
            /*Insertamos el nuevo usuario en la base de datos*/
            $consulta = "UPDATE Datos_Clientes SET Nombre='$name', Email='$email', DNI='$DNI', Pass='$pass', Tipo='$type', Fecha_Registro='$fechareg', Privilegio='$rol' WHERE ID_Clientes = '$id_usuario' ";
            $resultado = mysqli_query($conex, $consulta);
        
            if($resultado){
                echo'
                <script>
                    window.location = "../pages/Admin_TratamientoUsuarios.php";
                </script>
            ';
                        
            } else {
                echo'
                <script>
                    alert("NO MODIFICADO!");
                    window.location = "../pages/Admin_TratamientoUsuarios.php";
                </script>
            ';
                        
            }
            mysqli_free_result($resultado);
        }
    }
    /*Cerramos la conexión con la BD*/
    mysqli_close($conex);
?>