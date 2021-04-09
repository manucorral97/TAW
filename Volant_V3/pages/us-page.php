<!DOCTYPE html>
<html dir="ltr" lang="es">

<head>
    <title>Volant - Quienes somos</title>
    <link href="../styles/estilo.css" rel="stylesheet" type="text/css">
    <link href="../styles/estiloUS.css" rel="stylesheet" type="text/css">
    <!-- Incluyo las librerias y el estilo de LightBox para la galeria de imagenes -->
    <link href="../styles/lightbox.min.css" rel="stylesheet" type="text/css">
    <script src="../script/lightbox-plus-jquery.min.js"></script>
    <script src="../script/lightbox.min.js"></script>

    <?php
        include ("../includes/head.php");
    ?>
</head>

<body>
    <?php
        include ("../includes/header.php");
    ?>

    <main>
        <div class="main-top">
            <h2>Desde 2020, te llevamos a tus lugares favoritos.</h2>

            <div class="galeria">
                <div class="galeria-card">
                    <a href="../images/Madrid.jpg" data-lightbox="roadtrip"><img src="../images/Madrid.jpg"
                            alt="Madrid"></a>
                </div>

                <div class="galeria-card">
                    <a href="../images/Londres.jpg" data-lightbox="roadtrip"><img src="../images/Londres.jpg"
                            alt="Londres"></a>
                </div>

                <div class="galeria-card">
                    <a href="../images/Milan.jpg" data-lightbox="roadtrip"><img src="../images/Milan.jpg"
                            alt="Milan"></a>
                </div>
            </div>
        </div>

        <div class="main-bottom">
            <p>En la actualidad, procesamos más de 6 mil millones de búsquedas de viajes en todas nuestras plataformas
                cada
                año y ayudamos a millones de viajeros en todo el mundo a tomar las mejores decisiones de viaje. Con cada
                solicitud, VOLANT busca en cientos de webs de viajes para mostrar a los viajeros toda la información que
                necesitan para encontrar el vuelo, hotel, coche de alquiler o viaje perfecto.</p>
            <p>En más de una década, hemos pasado de tener una pequeña oficina con 14 empleados a un equipo de más de
                1000
                apasionados de los viajes que trabajan en 7 marcas internacionales: VOLANT, SWOODOO, checkfelix,
                momondo,
                Cheapflights, Mundi y HotelsCombined. Juntos, hacemos que explorar el mundo esté al alcance de todos</p>
            <p>Desde 2013 somos parte de Booking Holding, líder mundial en la industria de viajes online.</p>
            <p>Por favor, nos gustaría que valorases nuetsros servicios, nos ayuda a una mejora constante.</p>
            <div class="star-rating">
                <form>
                    <p class="clasificacion">
                        <input id="radio1" type="radio" name="estrellas" value="5"
                            onclick="alert('Gracias. Vuelve pronto 🤩')">
                        <label for="radio1">★</label>
                        <input id="radio2" type="radio" name="estrellas" value="4" onclick="alert('Gracias 😊')">
                        <label for="radio2">★</label>
                        <input id="radio3" type="radio" name="estrellas" value="3"
                            onclick="alert('Gracias. Mejoraremos! 😀')">
                        <label for="radio3">★</label>
                        <input id="radio4" type="radio" name="estrellas" value="2"
                            onclick="alert('Gracias. Sentimos no haber sido de tu agrado 🤨')">
                        <label for="radio4">★</label>
                        <input id="radio5" type="radio" name="estrellas" value="1"
                            onclick="alert('Por favor, indicanos en la página de contacto tus problemas 🥺')">
                        <label for="radio5">★</label>
                    </p>
                </form>
            </div>
        </div>
    </main>

    <?php
        include ("../includes/footer.php");
    ?>
</body>

</html>