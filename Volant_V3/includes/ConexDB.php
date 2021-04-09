<?php
    $conex = mysqli_connect("localhost","root","","Volant");

        /*Para comprobar que se ha conectado con la base de datos*/
        if(!$conex){
            echo "Conexion incorrecta con la BD";
            exit;
        }
?>