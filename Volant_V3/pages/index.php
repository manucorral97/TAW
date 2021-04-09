<!DOCTYPE html>
<html dir="ltr" lang="es">

<head>
    <title>Volant - Inicio</title>
    <!-- Incluimos el fichero CSS-->
    <link href="../styles/estilo.css" rel="stylesheet" type="text/css">
    <link href="../styles/estiloINDEX.css" rel="stylesheet" type="text/css">

    <?php
        include ("../includes/head.php");
    ?>
</head>

<body>
    <?php
        include ("../includes/header.php");
    ?>

    <main>
        <div class="sesion">
            <?php
                /*Sesion ya iniciada en el header*/
                //session_start();

                @$rolsesion = $_SESSION['rol'];
                /*Quiero que si el usuario es admin, acceda directamente a Admin_TratamientoVuelos.php*/
                if($rolsesion == 1)
                {
                    header('Location: ../pages/Admin_TratamientoVuelos.php');
                }

                @$varsesion = $_SESSION['usuario'];
                if($varsesion){
                    echo 'Bienvenido ';
                    echo $varsesion;
                    echo' <a href="../includes/CerrarSesion.php">Cerrar Sesión</a>';
                    ?>
                    <a href="../pages/MostrarCarrito.php" class="fas fa-shopping-cart" id="icon"><?php
                    echo ' ';
                    /*Colocamos el numero de elementos incluidos en el carrito*/
                    echo (empty($_SESSION['Carrito']))?0:count($_SESSION['Carrito']);
                    
                    ?></a>
                    <?php
                }
            ?>
        </div>

        <h3>¿A dónde quieres ir?</h3>
        <form id="buscador" method="POST" onreset="resetTabla()" action="../logic/VerVuelos.php?action=find">
            <!-- Divido el buscador en una lista con dos filas -->
            <ol>
                <input type="text" placeholder="Origen" list="listaOrigen" id="Origen" name="Origen" autocomplete="off" required>
                <datalist id="listaOrigen">
                    <option value="Madrid">Madrid</option>
                    <option value="Londres">Londres</option>
                    <option value="Milan">Milan</option>
                </datalist>

                <input type="text" placeholder="Destino" list="listaDestino" id="Destino" name="Destino" autocomplete="off" required>
                <datalist id="listaDestino">
                    <option value="Madrid">Madrid</option>
                    <option value="Londres">Londres</option>
                    <option value="Milan">Milan</option>
                </datalist>

                <label for="Salida">Salida</label>
                <input type="date" id="Salida" name="Salida" min="" onclick="minDay()" required>

                <label for="Viajeros">Personas</label>
                <input type="number" min="1" max="5" id="Viajeros" name="Personas" required>
            </ol>
            <ol>
                <!-- Envio el origen y destino seleccionado para la posterior tabla-->
                <input type="submit" value="Buscar" class="pulsador"
                    onclick="return validar(document.getElementById('Origen').value, document.getElementById('Destino').value)">
                <input type="reset" value="Limpiar" class="reset">
            </ol>
        </form>
        <br>
        <!-- Otros buscadores -->
        <form class="byPrice" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST">
            <input type="submit" class="BuscaXPrecio" name="BuscaXPrecio" value="Buscar por rango de precio">
        </form>
        
        <?php
            if(isset($_POST['BuscaXPrecio'])){
                ?>
                    <form class="byPrice" action="../logic/VerVuelos.php?action=price" method="POST" >
                        
                        <label for="min">Introduzca un precio minimo</label>
                        <ol><input type="number" name="min" min="10" class="price" required>€</ol>
                        <label for="max">Introduzca un precio maximo</label>
                        <ol><input type="number" name="max" min="10" class="price" required>€</ol>
                        <ol><input type="submit" name="buscar" value="Probar suerte" class="findprice"></ol>
                        
                    </form>
                <?php
            }
        ?>
        <br>
        <h3>Mostrar todos los vuelos: <a href="../logic/VerVuelos.php?action=all" class="fab fa-avianex"></a></h3>
    </main>

    <?php
        include ("../includes/footer.php");
    ?>
    
</body>

</html>