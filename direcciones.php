<!DOCTYPE html>
<?php 
    include("templates/language.php"); 
    include("class/allclass.php"); 
?>   
<head>
    <?php include("templates/head.php"); ?>
    <style>
        .form-inline .form-group { margin-right:10px; }
        .well-primary {
        color: rgb(255, 255, 255);
        background-color: rgb(66, 139, 202);
        border-color: rgb(53, 126, 189);
        }
        .glyphicon { margin-right:5px; } 
        .liCiudad{
            height: 40px;
            margin-bottom: 9px;
            padding-top: 7px;
            list-style: none;
            width: auto;
            float: left;
            clear: left;
            min-width: 300px;
            padding-left: 10px;
            background: #DE5870;
            color: #fff;
        }  
        .liCiudad a{
            text-decoration: none;
            color: #fff;
        }
        .liCiudad:hover{
            background: #83CACC;
            font-weight: bold;
        } 
        .ulCiudad{
            padding-left: 0;
        }    
    </style>
</head>
<body>
<?php include("templates/js.php") ?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel-group" id="accordion">

                <?php
                    $respuesta = $tours->getAddress();
                    foreach($respuesta["data"]["direcciones"] as $i => $paises){
                    $anterior    = $i - 1;
                    $siguiente   = $i + 1;
                    $nestado[$i] = $paises["estado_comercial"];
                    $link        = "https://".$paises["pagina_web"]."?affiliate=".$paises["link_afiliado"]; 

                    if($i==0){
                ?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#pais_<?php echo $i; ?>">
                                    <span class="icon-flag"></span><?php echo $paises["estado_comercial"].", ".$paises["nombre"]; ?></a>
                            </h4>
                        </div>
                        <div id="pais_<?php echo $i; ?>" class="panel-collapse collapse">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <ul class="ulCiudad">
                                            <li class="liCiudad"><a href="<?php echo $link; ?>"><?php echo $paises["ciudad_comercial"]; ?></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php }else{ 
                    if( $paises["estado_comercial"] != $nestado[$anterior]){
                ?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#pais_<?php echo $i; ?>">
                                    <span class="icon-flag"></span><?php echo $paises["estado_comercial"].", ".$paises["nombre"]; ?></a>
                            </h4>
                        </div>
                        <div id="pais_<?php echo $i; ?>" class="panel-collapse collapse">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <ul class="ulCiudad" id="lista_<?php echo $fn->reemplaza_espacios($paises["estado_comercial"]); ?>">
                                            <li class="liCiudad"><a href="<?php echo $link; ?>"><?php echo $paises["ciudad_comercial"]; ?></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>                    
                <?php }else{ ?>

                    <script>
                        $("#lista_<?php echo $fn->reemplaza_espacios($paises["estado_comercial"]); ?>").append('<li class="liCiudad"><a href="<?php echo $link; ?>"><?php echo $paises["ciudad_comercial"]; ?></a></li>');
                    </script>

                <?php } ?>
                <?php } ?>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
</body>
</html>