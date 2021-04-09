<?php
    /*Realizamos conexion con la BD*/
    include("../includes/ConexDB.php");

    /*Comprobamos que se hace click en registrarse*/
    if(isset($_POST['register'])){
        /*CON TRIM RECORTAMOS LOS DATOS AL TAMAÑO EFECTIVO (RECORTAMOS ESPACIOSENBLANCO POR DELANTE Y POR DETRAS)*/
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $DNI = trim($_POST['DNI']);
        $pass = trim($_POST['pass']);
        $type = $_POST['tipo'];
        $fechareg = date("Y-m-d");

        /*Primera en mayus y resto es minus*/
        $name = ucwords(strtolower($name));

        /*Evitamos dobles cuentas ya que el DNI ha de ser unico y el correo para poder iniciar sesion*/
        $doblesDNI = mysqli_query($conex, "SELECT * FROM Datos_Clientes WHERE DNI = '$DNI'");
        $doblesMAIL = mysqli_query($conex, "SELECT * FROM Datos_Clientes WHERE Email = '$email'");
        if(mysqli_num_rows($doblesDNI) > 0 || mysqli_num_rows($doblesMAIL) > 0){
            echo'
            <script>
                alert("Usuario ya registrado");
                window.location = "../pages/login-page.php";
            </script>
            ';
            exit();
        }

        /*Expresiones regulares para comprobar correos, DNI,...*/
        /*CORROBORO DATOS*/
        $patronDNI = "/^[0-9]{1,8}[a-zA-Z]{1}$/";
        if(!preg_match($patronDNI, $DNI)){
            echo'
            <script>
                alert("Mal rellenado el DNI");
                window.location = "../pages/registro-page.php";
            </script>
            ';
            exit();
        }

        $patronEmail = "/\b[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,6}\b/";
        if(!preg_match($patronEmail, $email)){
            echo'
            <script>
                alert("Mal rellenado el email");
                window.location = "../pages/registro-page.php";
            </script>
            ';
            exit();
        }

        $name = addslashes($name);
        /*mysqli_real_escape_string()
        

        /*Comprabciones de fechas, DNI por ejemplo que sean numeros y una letra...*/
        /*$NAME = addslashes($name) habra que usar ADDslasheh al recoger los datos de la BD tb por que asi fueron guardados (usaremos stripslasesh al mostrar por pantalla)
        Nos cambia caracteres especiales por \ (O'Riley por O\Riley)*/
        /*Nos hace daño que no este ajustado el tamaño o que intoruduzcamos un text en un date..., un int en un char...-> Comprobamos los datos*/
        /* $fecha = Jueves Diciembre 19/11/2020 Explode (' ', $fecha) -> Array con [Jueves, Dciiembre, 19/11/2020]*/

        if(strlen($name) >= 1 && strlen($email) >= 1 && strlen($pass) >= 1 && strlen($DNI) >= 1 && isset($_POST['tipo'])){

            $consulta = "INSERT INTO Datos_Clientes(Nombre, Email, DNI, Pass, Tipo, Fecha_Registro) VALUES ('$name','$email','$DNI','$pass','$type','$fechareg')";
            $resultado = mysqli_query($conex, $consulta);

            if($resultado){
                header("Location: ../pages/login-page.php");
                
            } else {
                header("Location: ../pages/registro-page.php");
                echo "No introducido en la BD";
                
            }
            mysqli_free_result($resultado);

        } else {
            /*Redireccion al formulario por que no esta todo cumplimentado*/
            /*
            echo("<script>")
            history.back();
            */
        
            echo'
                <script>
                    alert("Mal rellenado");
                    window.location = "../pages/registro-page.php";
                </script>
            ';
        }
        
    }
    /*Cerramos la conexión con la BD*/
    mysqli_close($conex);
    
?>