<?php
    /*Realizamos conexion con la BD*/
    include ("../includes/ConexDB.php");
    session_start();

    /*Recogo por GET el ID del vuelo afectado*/
    $id_vuelo = $_GET["ID_Vuelo"];

    /*Recogo por GET la accion a realizar (agregar o eliminar del carrito)*/
    $action = $_GET["action"];

    /*Si se ha pulsado en agregar al carrito*/
    if($action == 'add'){

        $cantidad = $_GET["personas"];
        /*Convertimos a entero*/
        $cantidad = intval($cantidad);

        @$_SESSION['Carrito'];

        /*Si el carrito esta vacio, añado en la posicion del id del vuelo el numero de personas*/
        if(!isset($_SESSION['Carrito'][$id_vuelo])){
            $_SESSION['Carrito'][$id_vuelo]=$cantidad;
        }else{
            /*Si ya tiene en su carrito el vuelo seleccionado, recalculamos el nuevo numero de pasajeros*/
            $_SESSION['Carrito'][$id_vuelo]+=$cantidad;
        }

        header("Location: ../pages/MostrarCarrito.php");

    }
    /*Si se ha pulsado en agregar al carrito*/
    if($action == "delete"){

        /*Eliminamos el vuelo seleccioando mendiante un UNSET del carrito en la posicion seleccionada*/
        unset($_SESSION['Carrito'][$id_vuelo]);

        header("Location: ../pages/MostrarCarrito.php");
    }

    /*Creada ya que si el usuario desea ver todos los vuelos, añade el numero de viajeros antes de seleccionar el vuelo deseado*/
    if($action == "addFromAll"){
        $cantidad = $_POST["personas"];
        /*Si el carrito esta vacio, añado en la posicion del id del vuelo el numero de personas*/
        if(!isset($_SESSION['Carrito'][$id_vuelo])){
            $_SESSION['Carrito'][$id_vuelo]=$cantidad;
        }else{
            /*Si ya tiene en su carrito el vuelo seleccionado, recalculamos el nuevo numero de pasajeros*/
            $_SESSION['Carrito'][$id_vuelo]+=$cantidad;
        }
        
        header("Location: ../pages/MostrarCarrito.php");
    }


?>