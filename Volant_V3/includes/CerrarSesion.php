<?php
    session_start();

    session_destroy();
    header("Location: ../pages/registro-page.php");
?>