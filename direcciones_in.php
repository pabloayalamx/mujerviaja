<!DOCTYPE html>
<?php 
    include("templates/language.php"); 
    include("class/allclass.php"); 
?>   
<head>
    <title>Selecciona una agencia</title>    
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
    <!-- COMMON SCRIPTS -->
    <?php include("templates/js.php") ?>

	<div class="layer"></div>
	<!-- Mobile menu overlay mask -->

    <?php include("templates/preloader.php") ?>
	<!-- End Preload -->

	<!-- Header================================================== -->
	<div id="header_1"><?php include("templates/header.php"); ?></div>
	<!-- End Header 1-->

	<section class="wrapper">
		<div class="divider_border"></div>

		<div class="container">
            <div class="row">
                <br><br>
                <br><br><br><br>
                <div class="main_title">
                    <h2>Selecciona tu <span>agencia</span> más cercana</h2>
			    </div>
                <div class="col-md-12">
                    <div class="panel-group" id="accordion">

                        <?php
                            $respuesta = $tours->getAddress();
                            foreach($respuesta["data"]["direcciones"] as $i => $paises){
                            $anterior    = $i - 1;
                            $siguiente   = $i + 1;
                            $nestado[$i] = $paises["estado_comercial"];
                            $link        = "https://".$paises["pagina_web"]."/agencia/".$paises["link_afiliado"]; 

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
	</section>
	<!-- End section -->


    <!-- Footer -->
	<footer><?php include("templates/footer.php"); ?></footer>
	<!-- End footer -->

	<div id="toTop"></div>
	<!-- Back to top button -->
</body>
</html>