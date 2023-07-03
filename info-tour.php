<!DOCTYPE html>
<?php 
    include("templates/language.php"); 
    include("class/allclass.php"); 
	$categoriasArray = [];
    $idtour          = filter_input(INPUT_GET, 'tour', FILTER_SANITIZE_NUMBER_INT);
    $tour            = $tours->getList($idtour); 
	$categorias      = $tour["categorias"];	
	$isotour         = $tour["paquete"][0]["iso"];

	$precioMinimoB   = $fn->precioMinimo($tour["fechas"]);
	$precioMinimo    = $fn->precio($precioMinimoB, $tour["paquete"][0]["iso"], $monedaSeleccionada, $monedaDefault, $monedas);

	foreach($categorias as $i => $categoria){
		$categoriasArray[$i] = $categoria["id_categoria"];
	}

	$categorias_txt = implode(",", $categoriasArray);
	$formCategorias["categorias"] = $categorias_txt;
	$formCategorias["idexcursion"] = $idtour;

	$toursRelacionados = $tours->relatedTours($formCategorias);
?>   
<head>
    <base href="<?php echo $fn->baseMeta(); ?>">
    <title><?php echo $tour["paquete"][0]["titulo_sitio"]; ?></title>
    <meta name="description" content="<?php echo $tour["paquete"][0]["descripcion_sitio"]; ?>">
    <meta name="keywords" content="<?php echo $tour["paquete"][0]["keywords_sitio"]; ?>">
    <?php include("templates/head.php"); ?>
    
	<!-- SPECIFIC CSS -->
	<!-- <link href="css/date_time_picker.css" rel="stylesheet"> -->
	<link href="css/timeline.css" rel="stylesheet">
    
    <!-- JQUERY UI -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/themes/base/jquery-ui.min.css" integrity="sha512-ELV+xyi8IhEApPS/pSj66+Jiw+sOT1Mqkzlh8ExXihe4zfqbWkxPRi8wptXIO9g73FSlhmquFlUOuMSoXz5IRw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <?php include("templates/preloader.php") ?>
	<!-- End Preload -->

	<!-- Header================================================== -->
    <div id="header_1"><?php include("templates/header.php"); ?></div>
	<!-- End Header 1-->

	<!-- SubHeader =============================================== -->
	<section class="parallax_window_in" data-parallax="scroll" data-image-src="<?php echo $tour["imagenes"][0]["imagen"]; ?>" data-natural-width="1400" data-natural-height="470">
		<div id="sub_content_in">
			<div id="animate_intro">
				<h1><?php echo $tour["paquete"][0]["nombre"]; ?></h1>
				<p>"<?php echo $tour["paquete"][0]["nombre"]; ?>" te espera para pasar las mejores vacaciones</p>
			</div>
		</div>
	</section>
	<!-- End section -->
	<!-- End SubHeader ============================================ -->

	<section class="wrapper">
		<div class="divider_border"></div>

		<div class="container">
			<div class="row">
				<div class="col-md-8">

					<div class="owl-carousel owl-theme carousel_detail add_bottom_15">
                        <?php foreach($tour["imagenes"] as $i => $imagen){ ?>
						    <div class="item"><img src="<?php echo $imagen["imagen"]; ?>" alt="<?php echo $tour["paquete"][0]["nombre"]; ?>" height="422px"></div>
                        <?php } ?>
					</div>

					<ul class="nav nav-tabs">
						<li class="active"><a href="#tab_1" data-toggle="tab">General</a></li>
						<li><a href="#tab_4" data-toggle="tab">Video</a></li>
                        <!-- <li><a href="#tab_2" data-toggle="tab">Reviews</a></li>
						<li><a href="#tab_3" data-toggle="tab">Map</a></li> -->
					</ul>

					<div class="tab-content">
						<div class="tab-pane fade in active" id="tab_1">
							<p><?php echo nl2br($tour["paquete"][0]["descripcion"]); ?></p>
							<div class="row">
								<div class="col-12">
                                    <h5 class="second_title tituloIncluyes col-sm-4">Incluye:</h5>
                                    <?php foreach($tour["incluye"] as $i => $incluye){ ?>
									<div class="feature-box add_padding_bottom_5">
										<div class="feature-box-icon">
											<i class="icon-ok-4"></i>
										</div>
										<div class="feature-box-info">
											<h4><?php echo $incluye["nombre"]; ?></h4>
										</div>
									</div>
                                    <?php } ?>
								</div>
								<!-- End col -->

								<div class="col-12">
                                <h5 class="second_title tituloIncluyes col-sm-4">No incluye:</h5>
                                    <?php foreach($tour["noincluye"] as $i => $noincluye){ ?>
									<div class="feature-box add_padding_bottom_5">
										<div class="feature-box-icon">
											<i class="icon-cancel-4 text-danger"></i>
										</div>
										<div class="feature-box-info">
											<h4><?php echo $noincluye["nombre"]; ?></h4>
										</div>
									</div>
                                    <?php } ?>
								</div>

								<div class="col-12">
                                <h5 class="second_title tituloIncluyes col-sm-4">Recomendaciones:</h5>
                                    <?php foreach($tour["recomendaciones"] as $i => $recomendacion){ ?>
									<div class="feature-box add_padding_bottom_5">
										<div class="feature-box-icon">
											<i class="icon-lightbulb yellow"></i>
										</div>
										<div class="feature-box-info">
											<h4><?php echo $recomendacion["nombre"]; ?></h4>
										</div>
									</div>
                                    <?php } ?>
								</div>                                
								<!-- End col -->
							</div>
							<!-- End row -->

							<hr>

							<h3>Itinerario 
                                <span>(<?php echo $tour["paquete"][0]["cantidad_dias"] > 1 ? $tour["paquete"][0]["cantidad_dias"]." días" : $tour["paquete"][0]["cantidad_dias"]." día"; ?>)</span>
                            </h3>
							<ul class="cbp_tmtimeline">
                                <?php foreach($tour["itinerarios"] as $i => $itinerario){ ?>

                                <?php if( $tour["paquete"][0]["cantidad_dias"] > 1){ ?>    
                                    <li>
                                        <!-- <time class="cbp_tmtime" datetime="09:30"><span>30 min.</span><span>09:30</span></time> -->
                                        <div class="cbp_tmicon">
                                            <?php echo $itinerario["dia"]; ?>
                                        </div>
                                        <div class="cbp_tmlabel">
                                            <!-- <div class="hidden-xs">
                                                <img src="img/tour_plan_1.jpg" alt="" class="img-circle thumb_visit">
                                            </div> -->
                                            <!-- <h4>Augue invidunt has</h4> -->
                                            <p><?php echo nl2br($itinerario["contenido"]); ?></p>
                                        </div>
                                    </li>
                                <?php }else{ 
                                    $contenido = $itinerario["contenido"];
                                    $tamano = strlen($contenido);

                                    $posiciones = [];
                                    //Buscamos los horarios marcados entre corchetes, ejemplo: [08:00]
                                    preg_match_all('/\[+[0-9:0-9]+\]/', $contenido, $horarios);
                                    $loshorarios = $horarios[0];

                                    //Buscamos la posicion donde inicia el horario señalado, que se tomara como el inicio de una nueva actividad horaria
                                    foreach($loshorarios as $r => $horario){
                                        $pos = strpos($contenido, $horario);
                                        $posiciones[$r] = $pos;
                                    }

                                    //Escribimos el itinerario del dia
                                    $siguiente = 1;
                                    $posEncontradas = count($posiciones)-1;
                                    foreach($posiciones as $p => $posicion){
                                        $hora = $p + 1;
                                        if($siguiente <= $posEncontradas){
                                            $limiteTexto = ($posiciones[$siguiente] - 1) - $tamano;
                                            $texto = substr($contenido, $posicion, $limiteTexto);
                                        }else{
                                            $texto = substr($contenido, $posicion);
                                        }
                                        
                                        $texto = $fn->removeTime($texto, $loshorarios[$p]);
                                        $siguiente++;
                                    ?>

                                    <li>
                                        <time class="cbp_tmtime" datetime="09:30">
                                            <span></span>
                                            <span><?php echo $fn->removeCorchetes($loshorarios[$p]); ?></span>
                                        </time>
                                        <div class="cbp_tmicon">
                                            <?php echo $hora; ?>
                                        </div>        
                                        <div class="cbp_tmlabel">
                                            <!-- <div class="hidden-xs">
                                                <img src="img/tour_plan_1.jpg" alt="" class="img-circle thumb_visit">
                                            </div> -->
                                            <!-- <h4>Titulo</h4> -->
                                            <p><?php echo nl2br($texto); ?></p>
                                        </div>                                                                        
                                    </li>
                                    <?php } ?>
                                    <?php }} ?>  
							</ul>
						</div>
						<!-- End tab_1 -->

						<div class="tab-pane fade" id="tab_2">

							<div id="summary_review">
								<div class="review_score"><span>8,9</span>
								</div>
								<div class="review_score_2">
									<h4>Fabulous  <span>(Based on 34 reviews)</span></h4>
									<p>
										Vero consequat cotidieque ad eam. Ea duis errem qui, impedit blandit sed eu. Ius diam vivendo ne.
									</p>
								</div>
							</div>
							<!-- End review summary -->

							<div class="reviews-container">

								<div class="review-box clearfix">
									<figure class="rev-thumb"><img src="img/avatar1.jpg" alt="">
									</figure>
									<div class="rev-content">
										<div class="rating">
											<i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star-empty"></i>
										</div>
										<div class="rev-info">
											Admin – April 03, 2016:
										</div>
										<div class="rev-text">
											<p>
												Sed eget turpis a pede tempor malesuada. Vivamus quis mi at leo pulvinar hendrerit. Cum sociis natoque penatibus et magnis dis
											</p>
										</div>
									</div>
								</div>
								<!-- End review-box -->

								<div class="review-box clearfix">
									<figure class="rev-thumb"><img src="img/avatar2.jpg" alt="">
									</figure>
									<div class="rev-content">
										<div class="rating">
											<i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star-empty"></i>
										</div>
										<div class="rev-info">
											Ahsan – April 01, 2016:
										</div>
										<div class="rev-text">
											<p>
												Sed eget turpis a pede tempor malesuada. Vivamus quis mi at leo pulvinar hendrerit. Cum sociis natoque penatibus et magnis dis
											</p>
										</div>
									</div>
								</div>
								<!-- End review-box -->

								<div class="review-box clearfix">
									<figure class="rev-thumb"><img src="img/avatar3.jpg" alt="">
									</figure>
									<div class="rev-content">
										<div class="rating">
											<i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star-empty"></i>
										</div>
										<div class="rev-info">
											Sara – March 31, 2016:
										</div>
										<div class="rev-text">
											<p>
												Sed eget turpis a pede tempor malesuada. Vivamus quis mi at leo pulvinar hendrerit. Cum sociis natoque penatibus et magnis dis
											</p>
										</div>
									</div>
								</div>
								<!-- End review-box -->

							</div>
							<!-- End review-container -->

							<hr>

							<div class="add-review">
								<h4>Leave a Review</h4>
								<div id="message-review"></div>
								<form method="post" action="assets/review.php" id="review" autocomplete="off">
									<input type="hidden" id="tour_name_review" name="tour_name_review" value="General Louvre Tour">
									<div class="row">
										<div class="form-group col-md-6">
											<label>Name *</label>
											<input type="text" name="name_review" id="name_review" placeholder="" class="form-control">
										</div>
										<div class="form-group col-md-6">
											<label>Lastname *</label>
											<input type="text" name="lastname_review" id="lastname_review" placeholder="" class="form-control">
										</div>
										<div class="form-group col-md-6">
											<label>Email *</label>
											<input type="email" name="email_review" id="email_review" class="form-control">
										</div>
										<div class="form-group col-md-6">
											<label>Rating </label>
											<select name="rating_review" id="rating_review" class="form-control">
												<option value="">Select</option>
												<option value="1">1 (lowest)</option>
												<option value="2">2</option>
												<option value="3">3</option>
												<option value="4">4</option>
												<option value="5">5 (medium)</option>
												<option value="6">6</option>
												<option value="7">7</option>
												<option value="8">8</option>
												<option value="9">9</option>
												<option value="10">10 (highest)</option>
											</select>
										</div>
										<div class="form-group col-md-12">
											<label>Your Review</label>
											<textarea name="review_text" id="review_text" class="form-control" style="height:130px;"></textarea>
										</div>
										<div class="form-group col-md-6">
											<label>Are you human? 3 + 1 =</label>
											<input type="text" id="verify_review" class=" form-control" placeholder="Are you human? 3 + 1 =">
										</div>
										<div class="form-group col-md-12">
											<input type="submit" value="Submit" class="btn_1" id="submit-review">
										</div>
									</div>
								</form>
							</div>

						</div>
						<!-- End tab_2 -->

						<div class="tab-pane fade" id="tab_3">
							<div id="map"></div>
							<!-- end map-->

							<div class="box_map">
								<i class="icon_set_1_icon-25"></i>
								<h4>By Train/tube</h4>
								<p>Per cu esse assentior delicatissimi, qui adipiscing dissentiunt mediocritatem in, dicat voluptaria no eam. No est alia eloquentiam. Has rebum vulputate adversarium no. Pro cibo delenit scripserit id.</p>
							</div>


							<div class="box_map">
								<i class="icon_set_1_icon-26"></i>
								<h4>By bus</h4>
								<p>Per cu esse assentior delicatissimi, qui adipiscing dissentiunt mediocritatem in, dicat voluptaria no eam. No est alia eloquentiam. Has rebum vulputate adversarium no. Pro cibo delenit scripserit id.</p>
							</div>

							<div class="box_map">
								<i class="icon_set_1_icon-21"></i>
								<h4>By Taxi/cabs</h4>
								<p>Per cu esse assentior delicatissimi, qui adipiscing dissentiunt mediocritatem in, dicat voluptaria no eam. No est alia eloquentiam. Has rebum vulputate adversarium no. Pro cibo delenit scripserit id.</p>
							</div>

						</div>
						<!-- End tab_3 -->


						<div class="tab-pane fade" id="tab_4">
                            <iframe 
                            width="560" 
                            height="400" 
                            src="<?php echo $tour["paquete"][0]["youtube"]; ?>" 
                            frameborder="0" 
                            allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" 
                            allowfullscreen style="height: 400px !important;"></iframe>
						</div>
						<!-- End tab 4 -->                        
					</div>
					<!-- End tabs -->
				</div>
				<!-- End Col -->

				<aside class="col-md-4">
					<div class="box_style_1">
						<div class="price">
                            <small>Desde</small>
                            <strong>$ <?php echo $precioMinimo["precioformato"]; ?><small> <?php echo $precioMinimo["iso"]; ?> </small></strong>
							
							<br>
                            <small>por persona</small>
						</div>
						<ul class="list_ok">
                            <?php foreach($tour["incluye"] as $i => $incluye){ ?>
                                <li><?php echo $incluye["nombre"]; ?></li>
                            <?php } ?>                            
						</ul>
						<small>*Selecciona una fecha para ver el precio vigente</small>
					</div>
					<div class="box_style_2">
						<h3>Reserva tu tour<span>Confirmación inmediata</span></h3>
						<form method="post" action="assets/check_avail.php" id="check_avail" autocomplete="off">
							<input type="hidden" id="tour_name" name="tour_name" value="General Louvre Tour">
							<div class="form-group">
								<?php if($tour["paquete"][0]["cantidad_dias"] > 1){  
                                    $fechas =  $tour["fechas"]; 
									// print_r($fechas);
									$cpromos = count($tour["promociones"]);
									if($cpromos > 0){
										$promociones =  $tour["promociones"][0]; 
									}else{
										$promociones = '';
									}
								?>

								<input type="hidden" name="tipo_descuento_cir" id="tipo_descuento_cir" value="<?php echo $cpromos > 0 ? $promociones["tipo_descuento"] : ''; ?>">    
								<input type="hidden" name="valor_promocion_cir" id="valor_promocion_cir" value="<?php echo $cpromos > 0 ? $promociones["valor_promocion"] : ''; ?>">    
								<input type="hidden" name="descuento_cir" id="descuento_cir" value="<?php echo $cpromos > 0 ? $promociones["descuento"] : ''; ?>">                 
								<input type="hidden" name="paxes_promocion_cir" id="paxes_promocion_cir" value="<?php echo $cpromos > 0 ? $promociones["paxes_promocion"] : ''; ?>">  								

                                        <select id="fecha_viaje" name="fecha" class="form-control" onchange="mostrarPreciosCircuitos(this)">
                                            <option value="0" disabled selected>Selecciona una fecha</option>
                                            <optgroup label="<?php echo "Temporada ".$fechas[0]["nombre_temporada"]; ?>" style="color: #EC237F; font-size: 16px;">
                                            <?php 
                                            $indice = 0;
                                            $temp = '';                       
                                            
                                            function check_in_range($fecha_inicio, $fecha_fin, $fecha){
                                                $fecha_inicio = strtotime($fecha_inicio);
                                                $fecha_fin = strtotime($fecha_fin);
                                                $fecha = strtotime($fecha);
                                        
                                                if(($fecha >= $fecha_inicio) && ($fecha <= $fecha_fin)) {  
                                                    // echo "Fi: ".$fecha_inicio." Ff: ".$fecha_fin." Fe: ".$fecha." y si esta"; 
                                                    return 1;   
                                                } else {   
                                                    // echo "Fi: ".$fecha_inicio." Ff: ".$fecha_fin." Fe: ".$fecha." y no esta"; 
                                                    return 0;   
                                                }
                                            }  

											$hoy = date('Y-m-d');
											if($cpromos > 0){
												$nombrepromo = $promociones["nombre"];
												$descripcionpromo = $promociones["descripcion"];
												
												$travel_win_inicio =  $promociones["travel_window_inicio"];
												$travel_win_fin =  $promociones["travel_window_fin"];	
												
												$booking_win_inicio =  $promociones["booking_window_inicio"];
												$booking_win_fin =  $promociones["booking_window_fin"];  
											}                                    
                                            
                                            foreach($fechas as $fecha){  
                                            $finicio = $fecha["fecha_inicio"];

											if($cpromos > 0){
												if(check_in_range($booking_win_inicio, $booking_win_fin, $hoy) == 1){
													$promo_booking_win = 1;
													$title= 'title="Promoción disponible si reservas hoy: '.$descripcionpromo.'"';
												}else{
													$promo_booking_win = 0;
													$title= "";
	
													if(check_in_range($travel_win_inicio, $travel_win_fin, $finicio) == 1){
														$promo_travel_win = 1;
														$title= 'title="Promoción disponible: '.$descripcionpromo.'"';
													}else{
														$promo_travel_win = 0;
														$title= "";
													}
												}
											}else{
												$promo_booking_win = 0;
												$title= "";
											}


                                            ?>
                                                <?php if($indice == 0){ ?>
                                                    <option <?php echo $title; ?> value="<?php echo $fecha["id"]; ?>" data-booking="<?php echo $promo_booking_win; ?>" data-travel="<?php echo $promo_travel_win; ?>"><?php echo $fn->fechaAbreviada($fecha["fecha_inicio"])." - ".$fn->fechaAbreviada($fecha["fecha_fin"]).": ".$fecha["nombre_servicio"]; ?></option>
                                                <?php }else{ if($temp == $fecha["id_temporada"]){ ?>
                                                    <option <?php echo $title; ?> value="<?php echo $fecha["id"]; ?>" data-booking="<?php echo $promo_booking_win; ?>" data-travel="<?php echo $promo_travel_win; ?>"><?php echo $fn->fechaAbreviada($fecha["fecha_inicio"])." - ".$fn->fechaAbreviada($fecha["fecha_fin"]).": ".$fecha["nombre_servicio"]; ?></option>
                                                <?php }else{ ?>
                                                    </optgroup>
                                                    <optgroup label="<?php echo "Temporada ".$fecha["nombre_temporada"]; ?>" style="color: #EC237F; font-size: 16px;">
                                                    <option <?php echo $title; ?> value="<?php echo $fecha["id"]; ?>" data-booking="<?php echo $promo_booking_win; ?>" data-travel="<?php echo $promo_travel_win; ?>"><?php echo $fn->fechaAbreviada($fecha["fecha_inicio"])." - ".$fn->fechaAbreviada($fecha["fecha_fin"]).": ".$fecha["nombre_servicio"]; ?></option>
                                                <?php }} ?>
                                            <?php $temp = $fecha["id_temporada"]; $indice++; } ?>                                     
                                        </select>		
										
                                        <?php foreach($fechas as $fecha){ ?>
											<!-- $precioReal    = $fn->precio($precio, $iso["iso"], $monedaSeleccionada, $monedaDefault, $monedas); -->
                                            <input type="hidden" id="fecha_inicio_<?php echo $fecha["id"]; ?>" value="<?php echo $fecha["fecha_inicio"]; ?>">
                                            <input type="hidden" id="fecha_fin_<?php echo $fecha["id"]; ?>" value="<?php echo $fecha["fecha_fin"]; ?>"> 
                                            <input type="hidden" id="id_temporada_<?php echo $fecha["id"]; ?>" value="<?php echo $fecha["id_temporada"]; ?>"> 
                                            <input type="hidden" id="nombre_temporada_<?php echo $fecha["id"]; ?>" value="<?php echo $fecha["nombre_temporada"]; ?>"> 
                                            <input type="hidden" id="id_clase_servicio_<?php echo $fecha["id"]; ?>" value="<?php echo $fecha["id_clase_servicio"]; ?>"> 
                                            <input type="hidden" id="nombre_servicio_<?php echo $fecha["id"]; ?>" value="<?php echo $fecha["nombre_servicio"]; ?>"> 
                                            <input type="hidden" id="id_temporada_costo_<?php echo $fecha["id"]; ?>" value="<?php echo $fecha["id_temporada_costo"]; ?>"> 

											<?php 
												$adulto_sencilla   = $fn->precio($fecha["adulto_sencilla"], $isotour, $monedaSeleccionada, $monedaDefault, $monedas);
												$adulto_doble      = $fn->precio($fecha["adulto_doble"], $isotour, $monedaSeleccionada, $monedaDefault, $monedas);
												$adulto_triple     = $fn->precio($fecha["adulto_triple"], $isotour, $monedaSeleccionada, $monedaDefault, $monedas); 
												$adulto_cuadruple  = $fn->precio($fecha["adulto_cuadruple"], $isotour, $monedaSeleccionada, $monedaDefault, $monedas); 
	
												$menor_sencilla    = $fn->precio($fecha["menor_sencilla"], $isotour, $monedaSeleccionada, $monedaDefault, $monedas); 
												$menor_doble       = $fn->precio($fecha["menor_doble"], $isotour, $monedaSeleccionada, $monedaDefault, $monedas); 
												$menor_triple      = $fn->precio($fecha["menor_triple"], $isotour, $monedaSeleccionada, $monedaDefault, $monedas); 
												$menor_cuadruple   = $fn->precio($fecha["menor_cuadruple"], $isotour, $monedaSeleccionada, $monedaDefault, $monedas); 
												
												$infante_sencilla  = $fn->precio($fecha["infante_sencilla"], $isotour, $monedaSeleccionada, $monedaDefault, $monedas); 
												$infante_doble     = $fn->precio($fecha["infante_doble"], $isotour, $monedaSeleccionada, $monedaDefault, $monedas); 
												$infante_triple    =  $fn->precio($fecha["infante_triple"], $isotour, $monedaSeleccionada, $monedaDefault, $monedas); 
												$infante_cuadruple =  $fn->precio($fecha["infante_cuadruple"], $isotour, $monedaSeleccionada, $monedaDefault, $monedas); 												
											?>
                                            
                                            <input type="hidden" id="adulto_sen_<?php echo $fecha["id"]; ?>" value="<?php echo $adulto_sencilla["preciosimple"]; ?>">
                                            <input type="hidden" id="adulto_dbl_<?php echo $fecha["id"]; ?>" value="<?php echo $adulto_doble["preciosimple"]; ?>"> 
                                            <input type="hidden" id="adulto_tpl_<?php echo $fecha["id"]; ?>" value="<?php echo $adulto_triple["preciosimple"]; ?>"> 
                                            <input type="hidden" id="adulto_cpl_<?php echo $fecha["id"]; ?>" value="<?php echo $adulto_cuadruple["preciosimple"]; ?>"> 

                                            <input type="hidden" id="menor_sen_<?php echo $fecha["id"]; ?>" value="<?php echo $menor_sencilla["preciosimple"]; ?>"> 
                                            <input type="hidden" id="menor_dbl_<?php echo $fecha["id"]; ?>" value="<?php echo $menor_doble["preciosimple"]; ?>"> 
                                            <input type="hidden" id="menor_tpl_<?php echo $fecha["id"]; ?>" value="<?php echo $menor_triple["preciosimple"]; ?>"> 
                                            <input type="hidden" id="menor_cpl_<?php echo $fecha["id"]; ?>" value="<?php echo $menor_cuadruple["preciosimple"]; ?>"> 
                                            
                                            <input type="hidden" id="infante_sen_<?php echo $fecha["id"]; ?>" value="<?php echo $infante_sencilla["preciosimple"]; ?>"> 
                                            <input type="hidden" id="infante_dbl_<?php echo $fecha["id"]; ?>" value="<?php echo $infante_doble["preciosimple"]; ?>"> 
                                            <input type="hidden" id="infante_tpl_<?php echo $fecha["id"]; ?>" value="<?php echo $infante_triple["preciosimple"]; ?>"> 
                                            <input type="hidden" id="infante_cpl_<?php echo $fecha["id"]; ?>" value="<?php echo $infante_cuadruple["preciosimple"]; ?>">                                        
                                        <?php } ?>										
							    <?php }else{ ?>
									<label>Selecciona una fecha</label>
                                	<input type="text" name="fecha" id="fecha_viaje_input" class="form-control" placeholder="Fecha">
								<?php } ?>
							</div>						

                            <div id="precios" class="mleft10 mright10">
                                <div id="contieneprecios">
                                    <table class="table table-bordered text-center">
                                        <thead>
                                            <tr>
                                                <th scope="col" style="background-color:#f1f1f1">ADULTOS</th>
                                                <th scope="col" style="background-color:#f1f1f1">MENORES</th>
                                                <th scope="col" style="background-color:#f1f1f1;">INFANTES</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td colspan="3" style="background-color: #c7dff2; color:black;">
                                                    <p class="text-center">Seleccione una fecha para ver los precios</p>
                                                </td>
                                            </tr>                                       
                                        </tbody>
                                    </table>                                    
                                </div>

                                <div id="loadingPrices" class="row d-none">
                                    <img src="img/loading.gif" alt="Cargando precios" class="position-relative" style="max-width: 100%;margin-top: -115px;">
                                    <p style="position: absolute; top: 5px; left: 10px; font-size: 20px;">Cargando precios</p>
                                </div>
                            </div>      
							
							<?php if($tour["paquete"][0]["hoteleria"] == 1){ ?>
                            <div class="form-group">
								<!-- <label>Seleccione habitación</label> -->
								<select name="tip_habitacion" id="tip_habitacion_1" class="form-control selecthabitacion" <?php if($tour["paquete"][0]["cantidad_dias"] > 1){ ?> onchange="calculaPreciosCircuito()" <?php }else{ ?> onchange="calculaPrecios()" <?php } ?>>
									<option value="" selected="" disabled="">Seleccione tipo de habitación</option>
									<?php if($tour["fechas"][0]["adulto_sencilla"] > 0){ ?>
										<option value="sen">Habitación sencilla</option>
									<?php } ?>

									<?php if($tour["fechas"][0]["adulto_doble"] > 0){ ?>
										<option value="dbl">Habitación doble</option>
									<?php } ?>
									
									<?php if($tour["fechas"][0]["adulto_triple"] > 0){ ?>
										<option value="tpl">Habitación triple</option>
									<?php } ?>
									
									<?php if($tour["fechas"][0]["adulto_cuadruple"] > 0){ ?>
										<option value="cpl">Habitación cuádruple</option>
									<?php } ?> 
								</select>
                            </div>
                     	   <?php } ?> 								

							<table id="tickets" class="table">
								<thead>
									<tr>
										<th></th>
										<th>Cantidad</th>
										<th class="text-center"><span class="subtotal">Subtotal</span></th>
									</tr>
								</thead>
								<tfoot>
									<tr class="total_row">
										<td colspan="2"><strong>TOTAL</strong></td>
										<td class="text-center">
											<input name="total" id="total" value="" class="text-center" readonly>
										</td>
									</tr>
								</tfoot>
								<tbody>
									<tr>
										<td>
                                            <strong>Adultos</strong>
                                            <a href="#" class="tooltip-1" data-placement="top" title="" data-original-title="A partir de 16 años">
                                                <sup class="icon-info-4"></sup>
                                            </a>
											<span id="priceAdulto" class="price">$0</span>
										</td>
										<td>
											<div class="styled-select">
												<select class="form-control" name="adultos" id="adultos" <?php if($tour["paquete"][0]["cantidad_dias"] > 1){ ?> onchange="calculaPreciosCircuito()" <?php }else{ ?> onchange="calculaPrecios()" <?php } ?> disabled>
													<option value="0" selected>0</option>
													<option value="1">1</option>
													<option value="2">2</option>
													<option value="3">3</option>
													<option value="4">4</option>
													<option value="5">5</option>
													<option value="6">6</option>
													<option value="7">7</option>
													<option value="8">8</option>
													<option value="9">9</option>
												</select>
											</div>
										</td>
										<td class="text-center"><span class="subtotal subtotalAdulto">$0</span></td>
									</tr>
									<tr>
										<td>
                                            <strong>Menores</strong>
                                            <a href="#" class="tooltip-1" data-placement="top" title="" data-original-title="Entre 3 y 15 años">
                                                <sup class="icon-info-4"></sup>
                                            </a>
                                            <span id="priceMenor" class="price">$0</span>
										</td>
										<td>
											<div class="styled-select">
												<select class="form-control" name="menores" id="menores" <?php if($tour["paquete"][0]["cantidad_dias"] > 1){ ?> onchange="calculaPreciosCircuito()" <?php }else{ ?> onchange="calculaPrecios()" <?php } ?> disabled>
													<?php for($i=0; $i<=10; $i++){ ?>
														<option value="<?php echo $i; ?>" <?php echo $i == 0 ? 'selected':''; ?>><?php echo $i; ?></option>
													<?php } ?>
												</select>
											</div>
										</td>
										<td class="text-center"><span class="subtotal subtotalMenor">$0</span>
										</td>
									</tr>
									<tr>
										<td><strong>Infantes</strong> <span id="priceInfante" class="price">$0</span> </td>
										<td>
											<div class="styled-select">
												<select class="form-control" name="infantes" id="infantes" <?php if($tour["paquete"][0]["cantidad_dias"] > 1){ ?> onchange="calculaPreciosCircuito()" <?php }else{ ?> onchange="calculaPrecios()" <?php } ?> disabled>
													<?php for($i=0; $i<=10; $i++){ ?>
														<option value="<?php echo $i; ?>" <?php echo $i == 0 ? 'selected':''; ?>><?php echo $i; ?></option>
													<?php } ?>
												</select>
											</div>
										</td>
										<td class="text-center"><span class="subtotal subtotalInfante">$0</span></td>
									</tr>
								</tbody>
							</table>

                            <div id="message-booking"></div>
							<div class="form-group">
								<input type="submit" value="Reserva ahora" class="btn_full" id="submit-booking">
							</div>                              
						</form>
						<hr>
						<a href="tel:<?php echo $myWebSite["telefono"]; ?>" class="btn_outline"> ó contáctanos</a>
						<a href="tel:<?php echo $myWebSite["telefono"]; ?>" id="phone_2"><i class="icon_set_1_icon-91"></i><?php echo $myWebSite["telefono"]; ?></a>
					</div>
				</aside>
			</div>
			<!-- End row -->
		</div>
		<!-- End container -->
	</section>
	<!-- End section -->

	<div>
	<form id="frmReserva" action="datos-compra" method="post">
		<input type="hidden" name="imagen" value="<?php echo $imagen["imagen"]; ?>">
		<input type="hidden" name="idtour" value="<?php echo $idtour; ?>">
		<input type="hidden" name="nombretour" value="<?php echo $tour["paquete"][0]["nombre"]; ?>">
		<input type="hidden" name="fechaviaje" id="fechaviaje">
		<input type="hidden" name="cadultos" id="cadultos">
		<input type="hidden" name="cmenores" id="cmenores">
		<input type="hidden" name="cinfantes" id="cinfantes">
		<input type="hidden" name="padulto" id="padulto">
		<input type="hidden" name="pmenor" id="pmenor">
		<input type="hidden" name="pinfante" id="pinfante">
		<input type="hidden" name="gtotal" id="gtotal">
		<input type="hidden" name="hoteleria" value="<?php echo $tour["paquete"][0]["hoteleria"]; ?>">

		<input type="hidden" name="id_temporada" id="id_temporada">
		<input type="hidden" name="nombre_temporada" id="nombre_temporada">
		<input type="hidden" name="id_clase_servicio" id="id_clase_servicio">
		<input type="hidden" name="nombre_servicio" id="nombre_servicio">
		<input type="hidden" name="fecha_inicio" id="fecha_inicio">
		<input type="hidden" name="fecha_fin" id="fecha_fin">
		<input type="hidden" name="id_paquete_fecha" id="id_paquete_fecha">
		<input type="hidden" name="id_temporada_costo" id="id_temporada_costo">    
		
		<input type="hidden" name="tipo_descuento_frm" id="tipo_descuento_frm">    
		<input type="hidden" name="valor_promocion_frm" id="valor_promocion_frm">   
		<input type="hidden" name="descuento_frm" id="descuento_frm">    
		<input type="hidden" name="idpromo_frm" id="idpromo_frm">    
		<input type="hidden" name="idexpromo_frm" id="idexpromo_frm"> 
		<input type="hidden" name="aplicapromo" id="aplicapromo"> 
		
		<input type="hidden" name="tipohabitacion" id="tipohabitacion"> 

		<button for="frmReserva" id="btnReservar" type="submit" class="p-0 titulo-rosa text-white d-none">
			Reservar
		</button>                          
	</form> 	
	</div>

	<?php if(count($toursRelacionados["data"]["tours"]) > 0){ ?>
	<div class="container margin_30">
		<h3 class="second_title">Experiencias similares</h3>
		<div class="owl-carousel owl-theme carousel add_bottom_30">

			<?php 
			$incluyes = $toursRelacionados["data"]["incluye"];
			$compara = [];
			foreach($incluyes as $incluye){
				$compara[] = $incluye["id_excursion"];
			}
			
			foreach($toursRelacionados["data"]["tours"] as $x => $data){                 
				$precio = 0;
							
				if($data["adulto_sencilla"] > 0){
					$precio = $data["adulto_sencilla"];
				}

				if($data["adulto_doble"] > 0){
					$precio = $data["adulto_doble"];
				}
				
				if($data["adulto_triple"] > 0){
					$precio = $data["adulto_triple"];
				}
				
				if($data["adulto_cuadruple"] > 0){
					$precio = $data["adulto_cuadruple"];
				}	
				
				$precioReal    = $fn->precio($precio, $data["iso"], $monedaSeleccionada, $monedaDefault, $monedas);				
			?>
			<div>
				<div class="img_wrapper">
					<div class="price_grid">
						<sup>$</sup><?php echo $precioReal["precioformato"]; ?><small><?php echo $precioReal["iso"]; ?></small>
					</div>
					<!-- End tools i-->
					<div class="img_container">
						<a href="tour/<?php echo mb_strtolower($data["carpeta_seo"]); ?>/<?php echo $fn->stringToUrl($data["nombre"])."/".$data["id"]; ?>" title="<?php echo mb_strtoupper($data["nombre"]); ?>">
							<img src="<?php echo $data["imagen"]; ?>" width="800" height="533" class="img-responsive" alt="">
							<div class="short_info">
								<h3><?php echo mb_strtoupper($data["nombre"]); ?></h3>
								<em>Duración <?php echo $data["cantidad_dias"] > 1 ? $data["cantidad_dias"]." días " : $data["cantidad_dias"]." día "; ?></em>
								<p><?php echo $fn->recortar_cadena($data["descripcion"], 100); ?></p>
								<div class="score_wp">
									<div class="score">9.5</div>
								</div>
							</div>
						</a>
					</div>
				</div>
				<!-- End img_wrapper -->
			</div>
			<?php } ?>
		</div>
		<!-- End carousel -->
	</div>
	<?php }else{
		echo "<br><br><br>";
	} ?>
	<!-- End container -->

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
	<!-- <script src="js/bootstrap-datepicker.js"></script> -->
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js" integrity="sha256-lSjKY0/srUM9BE3dPm+c4fBo1dky2v27Gdjm2uoZaL0=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js"></script>

	<script>
        $(document).ready(function(){
            $("#tip_habitacion_1").change(function(){
                valor = $(this).val();
                $("#tipohabitacion").val(valor);
            });

            if(("#fecha_viaje_input").length > 0){
            var objeto  = {};
            var generales = [];
            <?php $promociones = $tour["promociones"]; ?>
            <?php $cpromos =  count($promociones) > 0 ? count($promociones) : 0; ?>
            
            var promos = '<?php  if(count($promociones)==0) {echo '0';}else{count($promociones);} ?>';
            var booking = '<?php echo $cpromos > 0 ? $promociones[0]["booking_window_inicio"]: ''; ?>';
            var travel = '<?php echo $cpromos > 0 ? $promociones[0]["travel_window_inicio"]: ''; ?>';

            var nombreDescuento = '<?php echo $cpromos > 0 ? $promociones[0]["nombre"] : ''; ?>';
            var descuento = '<?php echo $cpromos > 0 ? $promociones[0]["descuento"] : ''; ?>';
            var mensaje = '<?php echo $cpromos > 0 ? $promociones[0]["descripcion"] : ''; ?>';
            var tipo_descuento = '<?php echo $cpromos > 0 ? $promociones[0]["tipo_descuento"] : ''; ?>';
            var valor_promocion = '<?php echo $cpromos > 0 ? $promociones[0]["valor_promocion"] : ''; ?>';
            var paxes_promocion = '<?php echo $cpromos > 0 ? $promociones[0]["paxes_promocion"] : ''; ?>';
            var limitado = '<?php echo $cpromos > 0 ? $promociones[0]["limitado"] : ''; ?>';
            var limite = '<?php echo $cpromos > 0 ? $promociones[0]["limite"] : ''; ?>';
            var id = '<?php echo $cpromos > 0 ? $promociones[0]["id"] : ''; ?>'; //id de la promocion
            var idexpromo = '<?php echo $cpromos > 0 ? $promociones[0]["idexpromo"] : ''; ?>'; //id de la fecha promovida  

            var booking_window_inicio = '<?php echo $cpromos > 0 ? $promociones[0]["booking_window_inicio"] : ''; ?>';
            var booking_window_fin = '<?php echo $cpromos > 0 ? $promociones[0]["booking_window_fin"] : ''; ?>';
            var travel_window_inicio = '<?php echo $cpromos > 0 ? $promociones[0]["travel_window_inicio"] : ''; ?>';
            var travel_window_fin = '<?php echo $cpromos > 0 ? $promociones[0]["travel_window_fin"] : ''; ?>';         

            objeto["nombreDescuento"] = nombreDescuento;
            objeto["descuento"] = descuento;
            objeto["mensaje"] = mensaje;
            objeto["tipo_descuento"] = tipo_descuento;
            objeto["valor_promocion"] = valor_promocion;
            objeto["paxes_promocion"] = paxes_promocion;
            objeto["limitado"] = limitado;
            objeto["limite"] = limite;
            objeto["id"] = id;
            objeto["idexpromo"] = idexpromo; 
            
            objeto["booking_window_inicio"] = booking_window_inicio; 
            objeto["booking_window_fin"] = booking_window_fin; 
            objeto["travel_window_inicio"] = travel_window_inicio; 
            objeto["travel_window_fin"] = travel_window_fin; 

            $("#tipo_descuento_frm").val(tipo_descuento);
            $("#valor_promocion_frm").val(valor_promocion);
            $("#descuento_frm").val(descuento);
            $("#idpromo_frm").val(id);
            $("#idexpromo_frm").val(idexpromo);

            <?php if(count($promociones) > 0){ ?>
            generales.push(objeto);    
            if(booking === null || booking === '' || booking === '0000-00-00'){
                booking = 0;
                if(travel === null || travel === '' || travel === '0000-00-00'){
                    travel = 0;
                }else{
                    travel = 1;
                    var travelinicio = updateFecha('<?php echo $promociones[0]["travel_window_inicio"]; ?>');
                    var travelfin = updateFecha('<?php echo $promociones[0]["travel_window_fin"]; ?>');            
                }

            }else{
                booking = 1;
                var bookingInicio = updateFecha('<?php echo $promociones[0]["booking_window_inicio"]; ?>');
                var bookingFin = updateFecha('<?php echo $promociones[0]["booking_window_fin"]; ?>');  
                
                if(travel === null || travel === '' || travel === '0000-00-00'){
                    travel = 0;
                }else{
                    travel = 1;
                    var travelinicio = updateFecha('<?php echo $promociones[0]["travel_window_inicio"]; ?>');
                    var travelfin = updateFecha('<?php echo $promociones[0]["travel_window_fin"]; ?>');            
                }
            }
            <?php }else{ ?>
                var travel = 0;
                var booking = 0;
            <?php } ?>    


            $("#fecha_viaje_input").datepicker({
                changeMonth: true, 
                changeYear: true,                 
                dateFormat: 'yy-mm-dd',
                minDate: 1,
                beforeShowDay: function( date ) {                    
                    var fecha = $.datepicker.formatDate('mm/dd/yy', date);
                    if(booking === 1){  
                        if(validaFecha(bookingInicio, bookingFin, fecha) === 1){
                            if(travel === 1){
                                return [true, "eventBooking", 'Reserva esta fecha y obtén: '+nombreDescuento+' para viajar del '+travelinicio+' al '+travelfin];
                            }else{
                                return [true, "eventBooking", 'Reserva esta fecha y obtén: '+nombreDescuento+' para viajar en la fecha que desees'];
                            }                            
                        }else{
                            return [true, '', ''];
                        } 
                    }else{
                        if(travel === 1){
                            if(validaFecha(travelinicio, travelfin, fecha) === 1){
                                return [true, "event", 'Promoción disponible: '+nombreDescuento];
                            }else{
                                return [true, '', ''];
                            } 
                        }else{
                            return [true, '', ''];
                        } 
                    }                                   
                },                
                onSelect: function(dateText) {
                    $("#contieneprecios").empty();
                    $("#loadingPrices").removeClass("d-none");
                    $("#fechaviaje").val(dateText);

                    $("#adultos").val(0);
                    $("#menores").val(0);
                    $("#infantes").val(0);

                    $(".subtotal").text("$0");

                    var fecha = updateFecha(dateText);                    
                    var hoy = formatoFecha(new Date(), 'mm/dd/yyyy')

                    var mostrarpromo = 0;
                    if(booking === 1){  
                        if(validaFecha(bookingInicio, bookingFin, hoy) === 1){
                            mostrarpromo = 1;                           
                        }else{
                            mostrarpromo = 0;
                        } 
                    }else{
                        if(travel === 1){
                            if(validaFecha(travelinicio, travelfin, fecha) === 1){
                                mostrarpromo = 1;
                            }else{
                                mostrarpromo = 0;
                            } 
                        }else{
                            mostrarpromo = 0;
                        } 
                    }
                    cargaPrecios('<?php echo $idtour; ?>', '<?php echo $tour["paquete"][0]["cantidad_dias"] ?>', dateText, generales, mostrarpromo, booking, travel);                    
                    //$("input#DateTo").datepicker('option', 'minDate', min);
                }                 
            });
        }            

            
        });
	</script>
	<script src="js/sidebar_carousel_detail_page_func.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js"></script>
	<script src="js/map.js"></script>
	<script src="js/infobox.js"></script>

</body>

</html>