<!DOCTYPE html>
<?php 
    include("templates/language.php"); 
    include("class/allclass.php"); 
?>   
<head>
    <title>Descubre destinos únicos diseñados para mujeres y vive experiencias turísticas inolvidables. ¡Explora con nosotras!</title>    
    <meta name="description" content="Vive aventuras inolvidables con nuestras experiencias de viaje exclusivas para mujeres. Celebra despedidas de soltera y quinceañeras de ensueño. ¡Explora y disfruta al máximo!">
    <meta name="keywords" content="experiencias para mujeres, experiencias de viaje para mujeres, tours para mujers, tour mujer holística, viajes para quinceañeras, despedidas de solteras, viajes para sibaritas">	
    <?php include("templates/head.php"); ?>
</head>

<body>
	<div class="layer"></div>
	<!-- Mobile menu overlay mask -->

    <?php include("templates/preloader.php") ?>
	<!-- End Preload -->

	<!-- Header================================================== -->
	<div id="header_1"><?php include("templates/header.php"); ?></div>
	<!-- End Header 1-->

	<!-- SubHeader =============================================== -->
	<section class="header-video">
		<div id="hero_video">
			<div id="animate_intro">
				<h3>Encuentra la experiencia perfecta</h3>
				<p>
					Vive una experiencia mágica con nosotros
				</p>
			</div>
		</div>
		<img src="img/video_fix.png" alt="" class="header-video--media" data-video-src="video/intro" data-teaser-source="video/intro" data-provider="" data-video-width="1920" data-video-height="750">
	</section>
	<!-- End Header video -->
	<!-- End SubHeader ============================================ -->

	<section class="wrapper">
		<div class="divider_border"></div>

		<div class="container">
			<div class="main_title">
				<h2>Las <span>experiencias</span> más solicitadas</h2>
				<p>Estos son las experiencias más solicitadas por nuestros clientes</p>
			</div>
			<div class="row">
                <?php
                    $respuesta = $tours->homeTours();
                    $ids = [];
                    $precios = $respuesta["data"]["precios"];
                    $incluyes = $respuesta["data"]["incluye"];
					$compara = [];
                    foreach($incluyes as $incluye){
                        $compara[] = $incluye["id_excursion"];
                    }
                    
                    $contador = 0;
                    foreach($respuesta["data"]["tours"] as $x => $data){ 
                        $clave = array_search($data["id"], array_column($precios, 'id_paquete'));   
                        $ids["ids"][$contador]=$data["id"];              
                ?>                
                    <div class="col-md-4 col-sm-6 wow fadeIn animated" data-wow-delay="0.2s">
                        <div class="img_wrapper">
                            <div class="ribbon">
                                <span>Popular</span>
                            </div>
                            <div class="price_grid">
								<?php
									if($clave != ''){
										//Buscamos el precio
										if($precios[$clave]["adulto_cuadruple"] > 0){
											$precio = $precios[$clave]["adulto_cuadruple"];
										}

										if($precios[$clave]["adulto_triple"] > 0){
											$precio = $precios[$clave]["adulto_triple"];
										}
										
										if($precios[$clave]["adulto_doble"] > 0){
											$precio = $precios[$clave]["adulto_doble"];
										}
										
										if($precios[$clave]["adulto_sencilla"] > 0){
											$precio = $precios[$clave]["adulto_sencilla"];
										}
									}else{
										$precio = 0;
									}									

								?>
                                <sup>$</sup><?php echo $fn->moneda($precio); ?> <small>MXN</small>
                            </div>
                            <div class="img_container">
                                <a href="tour/<?php echo mb_strtolower($data["carpeta_seo"]); ?>/<?php echo $fn->stringToUrl($data["nombre"])."/".$data["id"]; ?>" title="<?php echo mb_strtoupper($data["nombre"]); ?>">
                                    <img src="<?php echo $data["imagen"]; ?>" width="800" height="533" class="img-responsive" alt="<?php echo "Tour ".$data["nombre"]; ?>">
                                    <div class="short_info">
                                        <h3><?php echo mb_strtoupper($data["nombre"]); ?></h3>
                                        <em>Duración <?php echo $data["cantidad_dias"] > 1 ? $data["cantidad_dias"]." días " : $data["cantidad_dias"]." día "; ?></em>
                                        <p><?php echo $fn->recortar_cadena($data["descripcion"], 100); ?></p>
                                        <div class="score_wp">Tripadvisor
                                            <div class="score">9.5</div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <!-- End img_wrapper -->
                    </div>
                <?php $contador++; } ?>
			</div>
			<!-- End row -->

			<div class="main_title_2">
				<h3>Otras <span>experiencias</span> populares</h3>
				<p>Disfruta de las mejores experiencias</p>
			</div>
			<div class="row list_tours">
                <ul>
                    <?php 
						$data = '';
                        $otrosTours = $tours->toursOthers($ids);
                        $precios = $otrosTours["data"]["precios"];

                        $incluyes = $otrosTours["data"]["incluye"];
                        $compara = [];
                        foreach($incluyes as $incluye){
                            $compara[] = $incluye["id_excursion"];
                        }   
                        
                        foreach($otrosTours["data"]["tours"] as $x => $data){ 
                            $clave = array_search($data["id"], array_column($precios, 'id_paquete'));   

							if($clave != ''){
								//Buscamos el precio
								if($precios[$clave]["adulto_cuadruple"] > 0){
									$precio = $precios[$clave]["adulto_cuadruple"];
								}

								if($precios[$clave]["adulto_triple"] > 0){
									$precio = $precios[$clave]["adulto_triple"];
								}
								
								if($precios[$clave]["adulto_doble"] > 0){
									$precio = $precios[$clave]["adulto_doble"];
								}
								
								if($precios[$clave]["adulto_sencilla"] > 0){
									$precio = $precios[$clave]["adulto_sencilla"];
								}
							}else{
								$precio = 0;
							}							                          
                    ?>                    
                        <div class="col-sm-6">
                            <!-- <h3>New Tours</h3> -->
                                <li>
                                    <div>
                                        <a href="tour/<?php echo mb_strtolower($data["carpeta_seo"]); ?>/<?php echo $fn->stringToUrl($data["nombre"])."/".$data["id"]; ?>" title="<?php echo mb_strtoupper($data["nombre"]); ?>">
                                            <figure><img src="<?php echo $data["imagen"]; ?>" alt="<?php echo "Tour ".$data["nombre"]; ?>" class="img-rounded" width="60" height="60"></figure>
                                            <h4><?php echo mb_strtoupper($data["nombre"]); ?></h4>
                                            <small><?php echo $data["cantidad_dias"] > 1 ? $data["cantidad_dias"]." días " : $data["cantidad_dias"]." día "; ?></small>
                                            <span class="price_list">$ <?php echo $fn->moneda($precio); ?> <small>MXN</small></span>
                                        </a>
                                    </div>
                                </li>	
                        </div>
                    <?php } ?>    
                </ul>
			</div>
			<!-- End row -->

			<p class="text-center add_bottom_45 add_top_45">
				<a href="tours" class="btn_1">Ver todos los experiencias</a>
			</p>

		</div>
	</section>
	<!-- End section -->

	<section class="container margin_60">
		<div class="main_title">
			<h3>Por que elegir a ViajaMujer</h3>
			<p>Somos una empresa verdaderamente comprometida con nuestros clientes.</p>
		</div>
		<div class="row">
			<div class="col-sm-4">
				<div class="box_how">
					<div class="icon_how"><span class="icon_set_1_icon-81"></span>
					</div>
					<h4>Mejor precio</h4>
					<p>Disfruta de las mejores experiencias en los mejores destinos.</p>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="box_how">
					<div class="icon_how"><span class="icon_set_1_icon-94"></span>
					</div>
					<h4>Equipo profesional</h4>
					<p>Contamos con un equipo de profesionales que te atenderán como tu te mereces.</p>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="box_how">
					<div class="icon_how"><span class="icon_set_1_icon-92"></span>
					</div>
					<h4>Certificacion de SECTUR</h4>
					<p>Estamos registrados ante la SECRETARÍA DE TURISMO, somos una agencia confiable.</p>
				</div>
			</div>
		</div>
		<!-- End Row -->
	</section>
	<!-- End Container -->

	<section class="promo_full">
		<div class="promo_full_wp">
			<div>
				<h3>Lo que nuestros clientes dicen<span>Es un verdadero placer para nosotros atenderlos.</span></h3>
				<div class="container">
					<div class="row">
						<div class="col-md-8 col-md-offset-2">
						<script src="https://static.elfsight.com/platform/platform.js" data-use-service-core defer></script>
						<div class="elfsight-app-247d5d86-ff02-45df-a788-1dddcd78b50b"></div>
						</div>
						<!-- End col-md-8 -->
					</div>
					<!-- End row -->
				</div>
				<!-- End container -->
			</div>
			<!-- End promo_full_wp -->
		</div>
		<!-- End promo_full -->
	</section>
	<!-- End section -->

    <!-- Footer -->
	<footer><?php include("templates/footer.php"); ?></footer>
	<!-- End footer -->

	<div id="toTop"></div>
	<!-- Back to top button -->

	<!-- Search Menu -->
	<div class="search-overlay-menu">
		<span class="search-overlay-close"><i class="icon_close"></i></span>
		<form role="search" id="searchform" method="get">
			<input value="" name="q" type="search" placeholder="Search..." />
			<button type="submit"><i class="icon-search-6"></i>
			</button>
		</form>
	</div>
	<!-- End Search Menu -->

    <!-- COMMON SCRIPTS -->
    <?php include("templates/js.php") ?>

	<!-- SPECIFIC SCRIPTS -->
	<script src="js/video_header.js"></script>
	<script>
        $(document).ready(function(){
            $(".WidgetTitle__Container-sc-173f1y-0").remove();
        });
		'use strict';
		HeaderVideo.init({
			container: $('.header-video'),
			header: $('.header-video--media'),
			videoTrigger: $("#video-trigger"),
			autoPlayVideo: true
		});
	</script>
</body>
</html>