<!DOCTYPE html>
<?php 
    include("templates/language.php"); 
    include("class/allclass.php"); 
?>   

<head>
    <title>Descubre las mejores experiencias de viaje para Mujeres</title>    
    <meta name="description" content="Experiencias mágicas de viaje exclusivas para mujeres">
    <meta name="keywords" content="viajes para mujeres, tours para mujeres, despedidas de solteras, quinceañeras, viajes para quinceañeras">	
    <?php include("templates/head.php"); ?>
</head>

<body>
    <?php include("templates/preloader.php") ?>
	<!-- End Preload -->

	<!-- Header================================================== -->
    <div id="header_1"><?php include("templates/header.php"); ?></div>
	<!-- End Header 1-->

	<!-- SubHeader =============================================== -->
	<section class="parallax_window_in" data-parallax="scroll" data-image-src="img/tours.jpg" data-natural-width="1400" data-natural-height="470">
		<div id="sub_content_in">
			<div id="animate_intro">
				<h1>Nuestras experiencias</h1>
				<p>"Estás a unos clics de tener tu mejor aventura viajera"</p>
			</div>
		</div>
	</section>
	<!-- End section -->
	<!-- End SubHeader ============================================ -->

	<section class="wrapper">
		<div class="divider_border_gray"></div>
		<!-- <div id="filters" class="clearfix">
			<div id="sort_filters">
				<select name="orderby" class="selectbox">
					<option value="popularity">Sort by Popularity</option>
					<option value="rating">Sort by Average Rating</option>
					<option value="date" selected='selected'>Sort by Newness</option>
					<option value="price">Sort by Price: Low to High</option>
					<option value="price-desc">Sort by Price: High to Low</option>
				</select>
			</div>
			<div id="view_change">
				<a href="grid.html" class="grid_bt"></a>
				<a href="list.html" class="list_bt"></a>
			</div>
		</div> -->
		<!-- End filters -->

		<div class="container">
			<?php 
                $respuesta = $tours->getList();
                $precios = $respuesta["data"]["precios"];
                $incluyes = $respuesta["data"]["incluye"];
                $compara = [];
                foreach($incluyes as $incluye){
                    $compara[] = $incluye["id_excursion"];
                }
                
                foreach($respuesta["data"]["tours"] as $x => $data){                 
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
				
				$precioReal = $fn->precio($precio, $data["iso"], $monedaSeleccionada, $monedaDefault, $monedas);				
			?>
			<div class="row strip_list wow fadeIn animated" data-wow-delay="0.2s">
				<div class="col-md-5">
					<div class="img_wrapper">
						<!-- <div class="ribbon">
							<span>Popular</span>
						</div> -->
						<div class="price_grid">
							<sup>$</sup><?php echo $precioReal["precioformato"]; ?> <small><?php echo $precioReal["iso"]; ?></small>
						</div>
						<div class="img_container">
							<a href="tour/<?php echo mb_strtolower($data["carpeta_seo"]); ?>/<?php echo $fn->stringToUrl($data["nombre"])."/".$data["id"]; ?>">
								<img src="<?php echo $data["imagen"]; ?>" width="800" height="533" class="img-responsive img-responsive-height" alt="<?php echo mb_strtoupper($data["nombre"]); ?>">
								<div class="short_info">
									<em>Duración <?php echo $data["cantidad_dias"] > 1 ? $data["cantidad_dias"]." días " : $data["cantidad_dias"]." día "; ?></em>
									<div class="score_wp">Tripadvisor
										<div class="score">7.5</div>
									</div>
								</div>
							</a>
						</div>
					</div>
					<!-- End img_wrapper -->
				</div>
				<div class="col-md-7">
					<h3><?php echo mb_strtoupper($data["nombre"]); ?></h3>
					<p><?php echo $fn->recortar_cadena($data["descripcion"], 500); ?></p>
					<p>
						<a href="tour/<?php echo mb_strtolower($data["carpeta_seo"]); ?>/<?php echo $fn->stringToUrl($data["nombre"])."/".$data["id"]; ?>" class="btn_1">Ver tour</a>
					</p>
				</div>
			</div>
			<?php } ?>
			<!-- End strip list -->

			<!-- End row -->
		</div>
		<!-- End container -->
	</section>
	<!-- End section -->

	<div class="container margin_60">
		<div class="banner">
			<h3>Reserva con anticipación y paga poco a poco tus tours. Para más información contáctanos</h3>
			<a href="contacto" class="btn_1 white">contáctanos ahora mismo</a>
		</div>
		<!-- end banner -->
	</div>
	<!-- end container -->

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
	<script src="js/jquery.selectbox-0.2.js"></script>
	<script>
		$(".selectbox").selectbox();
	</script>

</body>

</html>