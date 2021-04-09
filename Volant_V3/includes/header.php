<nav>
        <div class="logo">
            <!-- Alt para accesibilidad -->
            <a href="../pages/index.php"> <img src="../images/logo.png" alt="Logo de la empresa" width="350px" height="200px"></a>
        </div>
        <ul class="nav-links" id="nav-links">

            <?php
                session_start();
                @$rolsesion = $_SESSION['rol'];
                @$ID_Cliente = $_SESSION['id'];
                /*Si ya esta logado, que acceda a modificar sus datos*/
                if($rolsesion == 2){
                    ?>
                        <li><a href="../pages/ModificarUsuarioPropio.php?ID_Usuario=<?php echo $ID_Cliente;?>">Mi cuenta</a></li>
                    <?php
                }
                /*Si no esta logado, que acceda a la pagina de login o registro*/
                else{
                    ?>
                    <li><a href="login-page.php">Mi cuenta</a></li>
                    <?php
                }
            ?>
            <li><a href="us-page.php" title="Informacion sobre Volant">Nosotros</a></li>
            <li><a href="help-page.php" title="Ayuda y preguntas frecuentes">FaQ</a></li>
            <li><a href="contact-page.php" title="Contacta con nosotros">Contacto</a></li>
            <li><a href="../pages/MisPedidos.php" title="Mis viajes">Mis viajes</a></li>
            
        </ul>
        <div class="burger">
            <div class="line1"></div>
            <div class="line2"></div>
            <div class="line3"></div>
        </div>
</nav>