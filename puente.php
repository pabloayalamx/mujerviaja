<?php

    session_start();
    $_SESSION["afiliadoSession"] = $_GET["affiliate"];
    header('Location: /');

?>