<?php
    $host= $_SERVER["HTTP_HOST"];
    $url= $_SERVER["REQUEST_URI"];
    $urls = explode("/", $url);
    echo end( $urls );

?>

