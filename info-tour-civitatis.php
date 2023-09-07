<!DOCTYPE html>
<?php 
    include("templates/language.php"); 
    include("class/allclass.php"); 

	$data["id"]       = filter_input(INPUT_GET, 'tour', FILTER_SANITIZE_NUMBER_INT);
	$data["currency"] = $monedaSeleccionada;
	$data["sandbox"]  = true;
	$tour = $tours->getCivitatisTour($data);	
	// print_r($tour);

	$actividad  = $tour->actividad;
	$calendario = $tour->calendario; 
	$markup     = $tour->empresa[0]->comision_tours;

    foreach($actividad->rates as $rate){
        $categoriasTours[$rate->id] = $rate->text;
    }

    foreach($actividad->rates[0]->categories as $tipo){
        $tipos[$tipo->id] = $tipo->text;
    } 	
	
?>   
<head>
    <base href="<?php echo $fn->baseMeta(); ?>">
    <title><?php echo $actividad->title; ?></title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <?php include("templates/head.php"); ?>
    
	<!-- SPECIFIC CSS -->
	<!-- <link href="css/date_time_picker.css" rel="stylesheet"> -->
	<link href="css/timeline.css" rel="stylesheet">
    
    <!-- JQUERY UI -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/themes/base/jquery-ui.min.css" integrity="sha512-ELV+xyi8IhEApPS/pSj66+Jiw+sOT1Mqkzlh8ExXihe4zfqbWkxPRi8wptXIO9g73FSlhmquFlUOuMSoXz5IRw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
		<style>
			.campoReserva, .campoReservaHorario{
				display: none;
			}

		</style>
</head>

<body>
	<?php 
		foreach($categoriasTours as $c => $categoriaTour){
			foreach ($tipos as $t => $catTipo){
				?>
				<input type="hidden" id="precio_<?php echo $c."_".$t; ?>" value="<?php echo $fn->tarifaPublicaAgenciasToursSinFormato($calendario->schedule[0]->rates[$c][$t]->price, $markup); ?>">
			<?php
			}
		}
	
	?>
    <?php include("templates/preloader.php") ?>
	<!-- End Preload -->

	<!-- Header================================================== -->
    <div id="header_1"><?php include("templates/header.php"); ?></div>
	<!-- End Header 1-->

	<!-- SubHeader =============================================== -->
	<section class="parallax_window_in" data-parallax="scroll" data-image-src="<?php echo $actividad->photos->header[0]->paths->original; ?>" data-natural-width="1400" data-natural-height="470">
		<div id="sub_content_in">
			<div id="animate_intro">
				<h1><?php echo $actividad->title; ?></h1>
				<p>"<?php echo $actividad->title; ?>" te espera para pasar las mejores vacaciones</p>
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
                        <?php foreach($actividad->photos->gallery as $i => $imagen){ ?>
						    <div class="item"><img src="<?php echo $imagen->paths->original;; ?>" alt="<?php echo $actividad->title; ?>" height="422px"></div>
                        <?php } ?>
					</div>

					<ul class="nav nav-tabs">
						<li class="active"><a href="#tab_1" data-toggle="tab">General</a></li>
						<!-- <li><a href="#tab_4" data-toggle="tab">Video</a></li> -->
                        <!-- <li><a href="#tab_2" data-toggle="tab">Reviews</a></li>
						<li><a href="#tab_3" data-toggle="tab">Map</a></li> -->
					</ul>

					<div class="tab-content">
						<div class="tab-pane fade in active" id="tab_1">
							<p><?php echo nl2br($actividad->description); ?></p>
							<div class="row">
								<div class="col-12">
                                    <h5 class="second_title tituloIncluyes col-sm-4">Incluye:</h5>
                                    <?php foreach($actividad->included as $i => $incluye){ ?>
									<div class="feature-box add_padding_bottom_5">
										<div class="feature-box-icon">
											<i class="icon-ok-4"></i>
										</div>
										<div class="feature-box-info">
											<h4><?php echo $incluye; ?></h4>
										</div>
									</div>
                                    <?php } ?>
								</div>
								<!-- End col -->

								<?php if(count($actividad->notIncluded) > 1){ ?>
								<div class="col-12">
                                	<h5 class="second_title tituloIncluyes col-sm-4">No incluye:</h5>
                                    <?php foreach($actividad->notIncluded as $i => $noincluye){ ?>
									<div class="feature-box add_padding_bottom_5">
										<div class="feature-box-icon">
											<i class="icon-cancel-4 text-danger"></i>
										</div>
										<div class="feature-box-info">
											<h4><?php echo $noincluye; ?></h4>
										</div>
									</div>
                                    <?php } ?>
								</div>
								<?php } ?>

								<div class="col-12">
                                <h5 class="second_title tituloIncluyes col-sm-4">General:</h5>
									<div class="feature-box add_padding_bottom_5">
										<div class="feature-box-icon">
											<i class="icon-ok-4"></i>
										</div>
										<div class="feature-box-info">
											<h4>¿Cuándo reservar? <br>
												<small>
													<?php 
														if($actividad->advance->minutes_before/60 > 24){
															$horas = $actividad->advance->minutes_before/60;
															$dias = $horas/24;
															echo "Hasta ".$dias;
															echo $dias > 1 ? 'Días' : 'Día';
															echo "antes si aún se cuenta con disponibilidad";
														}else{
															$horas = $actividad->advance->minutes_before/60;
															echo $horas." horas antes si aún se cuenta con disponibilidad";
														}												
													?>													
												</small>
											</h4>

											<h4>
												Punto de encuentro: <br>
												<small>
													<?php echo $actividad->infoVoucher; ?>
												</small>
											</h4>

											<h4>
												Mínimo de personas para la actividad <br>
												<small>
													<?php echo $actividad->minimumPaxPerActivity; ?>
													<?php echo $actividad->minimumPaxPerActivity > 1 ? ' personas, si no se completa la cantidad de personas nos comunicaremos contigo para ofrecerte otras alternativas' : 'Persona'; ?>
												</small>											
											</h4>
										</div>
									</div>
								</div>		
								
								<div class="col-12">
                                <h5 class="second_title tituloIncluyes col-sm-4">Politicas de cancelación:</h5>
									<div class="feature-box add_padding_bottom_5">
										<div class="feature-box-icon">
											<i class="icon-ok-4"></i>
										</div>
										<div class="feature-box-info">
											<?php
												foreach($actividad->cancelPolicies as $politica){
													if($politica->penalty == 0){
											?>
												<h4>
												¡Gratis! Cancela sin gastos hasta <?php echo $politica->hours; ?> horas antes de la actividad. Si cancelas con 
												menos tiempo, llegas tarde o no te presentas, no se ofrecerá ningún reembolso.													
												</h4>
											<?php }else{ ?>
												<h4>
													<?php echo $politica->penalty; ?> % de penalización al cancelar antes de <?php echo $politica->hours; ?> horas antes de la actividad
												</h4>
											<?php } ?>
											<?php } ?>
										</div>
									</div>
								</div>								
                               
								<!-- End col -->
							</div>
							<!-- End row -->
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
						</div>
						<!-- End tab_2 -->
						<!-- End tab_3 -->


						<div class="tab-pane fade" id="tab_4">
                            <!-- youtube -->
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
                            <strong>$ <?php echo $fn->tarifaPublicaAgenciasTours($actividad->minimumPrice, $markup); ?><small> <?php echo $monedaSeleccionada; ?> </small></strong>
							
							<br>
                            <small>por persona</small>
						</div>
						<small>*Selecciona una fecha para ver el precio vigente</small>
					</div>
					<div class="box_style_2">
						<h3>Reserva tu tour<span>Confirmación inmediata</span></h3>
						<form id="check_avails" method="post" action="datos-compra-civi" autocomplete="off">
                                            <input type="hidden" name="idactividad" value="<?php echo $actividad->id; ?>">
                                            <input type="hidden" name="nombreActividad" value="<?php echo $actividad->title; ?>">
                                            <input type="hidden" name="markup" value="<?php echo $markup; ?>">
                                            <input type="hidden" name="currency" value="<?php echo $monedaSeleccionada; ?>">                
                                            <input type="hidden" name="imagen" value="<?php echo $actividad->photos->header[0]->paths->original; ?>">
                                            <input type="hidden" name="precioTotal" id="precioTotal" value="">

                                            <div class="fields">
                                                <div class="form-group pl-0">
                                                    <label>Fecha</label>
                                                    <div class="field-inner">
                                                        <input required type="text" name="fecha" id="fecha" class="form-control" placeholder="Fecha" autocomplete="off">
                                                        <!-- <i class="alt-icon fa fa-calendar-alt"></i> -->
                                                    </div>
                                                </div>
                                                <div class="form-group pl-0 campoReserva">
                                                    <label>Tipo de actividad</label>
                                                    <div class="field-inner">
                                                        <select class="form-control" name="rate" id="rate" onchange="muestraPrecios(value)" required>
                                                            <option value="" disabled selected>Selecciona una opción</option>
                                                            <?php foreach($categoriasTours as $c => $categoriaTour){ ?>
                                                                <option value="<?php echo $c; ?>"><?php echo $categoriaTour; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <?php foreach($tipos as $t => $tipoCat){ ?>
                                                    <div class="form-group pl-0 campoReserva">
                                                        <label><?php echo $tipoCat; ?></label>
                                                        <select class="<?php echo $actividad->rates[0]->categories[$t]->canBookAlone ? "adulto_canBook" : ""?> form-control tipoCat" name="campo[]" id="tipoCat_<?php echo $t; ?>" data-id="<?php echo $t; ?>" data-precio="" onchange="calculaPrecio(); poneCantidad(this, '<?php echo $t; ?>');">
                                                        <option value="" selected>Seleccione...</option>
                                                        <option value="precio" disabled>$ --- <?php echo $monedaSeleccionada; ?></option>
                                                            <?php for($i=0; $i<=10; $i++){ ?>
                                                                <option value="<?php echo $t; ?>" rel="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                            <?php } ?>
                                                        </select>   
                                                        <input type="hidden" name="cantidad[<?php echo $t; ?>]" id="cantidad_<?php echo $t; ?>">
                                                    </div>                              
                                                <?php } ?> 
                                                
                                                <div class="form-group pl-0 campoReservaHorario">
                                                    <label>Horario</label>
<select class="form-control" name="horario" id="horario" required>
                                                        <option value="" selected disabled>Selecciona un horario</option>
                                                    </select>       
                                                </div>      
                                                <div class="form-group pl-0 campoReserva">
                                                    <label>Total a pagar</label>
                                                    <input type="text" readonly class="form-control" id="total">
                                                </div>
                                                <div class="errores-adultos" style= "color: red; transition: all 0.5s ease;">
                                                </div>
                                            </div>
                                            <div class="proceed-link"><button type="submit" class="theme-btn btn-style-two">Reserva ahora</button></div>
                                        </form>
					</div>
				</aside>
			</div>
			<!-- End row -->
		</div>
		<!-- End container -->
	</section>
	<!-- End section -->

	<div>
	</div>

	<br><br><br>
	<!-- End container -->

    <!-- Footer -->
    <footer><?php include("templates/footer.php"); ?></footer>
	<!-- End footer -->

	<div id="toTop"></div>
	<!-- Back to top button -->

	<!-- COMMON SCRIPTS -->
    <?php include("templates/js.php") ?>

	<!-- SPECIFIC SCRIPTS -->
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js" integrity="sha256-lSjKY0/srUM9BE3dPm+c4fBo1dky2v27Gdjm2uoZaL0=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js"></script>

	<script src="js/sidebar_carousel_detail_page_func.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js"></script>
	<script src="js/map.js"></script>
	<script src="js/infobox.js"></script>

	<script>
        const arrayFechas = [];
        const arrayRates  = [];            

        let horarios    = [];
        let rates       = [];
        let ratesDetail = [];

        $(document).ready(function(){
            let availableDates = [
                <?php foreach($calendario->schedule as $fechitas){ ?>
                    '<?php echo $fn->datePickerFormat($fechitas->date); ?>',
                <?php } ?>       
            ];

            <?php foreach($calendario->schedule as $fechitasB){  ?>
                <?php foreach($fechitasB->times as $h => $horarios){ ?>
                 horarios[<?php echo $h; ?>] = ['<?php echo $horarios->time; ?>', '<?php echo $horarios->quota; ?>', '<?php echo $horarios->quotaAvailable; ?>', '<?php echo $fechitasB->availability; ?>'];
                <?php } ?> 

                <?php foreach($fechitasB->rates as $t => $typeRate){ ?>
                  <?php foreach($typeRate as $r => $rates) { ?>
                            ratesDetail[<?php echo $r; ?>] = '<?php echo $rates->price; ?>';
                        <?php } ?>      
                        rates[<?php echo $t; ?>] = [...ratesDetail];
                <?php } ?>      
                       
                arrayRates['<?php echo $fechitasB->date; ?>']  = [...rates];    
                arrayFechas['<?php echo $fechitasB->date; ?>'] = [...horarios];                     
            <?php } ?>         
            
            $("#fecha").datepicker({
                dateFormat: "yy-mm-dd",
                minDate: 1,
                maxDate: 270,
                monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
                dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
                dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
                dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],            
                beforeShowDay: function(d) {
                    var dmy = (d.getMonth()+1); 
                    if(d.getMonth()<9) 
                        dmy="0"+dmy; 
                    dmy+= "-"; 

                    if(d.getDate()<10) dmy+="0"; 
                        dmy+=d.getDate() + "-" + d.getFullYear(); 

                    if ($.inArray(dmy, availableDates) != -1) {
                        return [true, "","Available"]; 
                    } else{
                        return [false,"","unAvailable"]; 
                    }              
                },
                onSelect: function(date) {
                    var chorarios = arrayFechas[date].length;
                    if(chorarios === 1){
                        //Horarios
                        if(hora !== ''){
                            var hora           = arrayFechas[date][0][0];
                            var quota          = arrayFechas[date][0][0];
                            var quotaAvailable = arrayFechas[date][0][0];
                            var availability   = arrayFechas[date][0][0]; 

                            if(quotaAvailable === true){
                                if(availability > 0){
                                    $('#horario').append('<option rel="avail" value="'+hora+'">'+hora+'</option>');
                                }else{
                                    $('#horario').append('<option rel="notavail" value="'+hora+'" disabled>'+hora+' (no disponible)</option>');
                                }    
                                $(".campoReservaHorario").hide();                        
                            }else{
                                if(hora !== ''){
                                    $(".campoReservaHorario").hide();
                                    $('#horario').append('<option rel="noquota" value="'+hora+'">'+hora+'</option>');
                                }                           
                            } 

                        }else{
                            $(".campoReservaHorario").hide();
                        }
                    }else{
                        $(".campoReservaHorario").show();
                        $("#horario").empty();

                        $('#horario').append('<option value="0" selected disabled>Horario</option>');                    
                        for(i=0;i<chorarios;i++){
                            var hora           = arrayFechas[date][i][0];
                            var quota          = arrayFechas[date][i][0];
                            var quotaAvailable = arrayFechas[date][i][0];
                            var availability   = arrayFechas[date][i][0];

                            if(quotaAvailable === true){
                                if(availability > 0){
                                    $('#horario').append('<option value="'+hora+'">'+hora+'</option>');
                                }else{
                                    $('#horario').append('<option value="'+hora+'" disabled>'+hora+' (no disponible)</option>');
                                }
                                
                            }else{
                              $('#horario').append('<option value="'+hora+'">'+hora+'</option>');
                            }                        
                        }
                    }

                    //Precios
                    var cprecios = arrayRates[date].length;
                    var lista = arrayRates[date];

                    for(i=0; i<cprecios; i++){ //i=Tipo de actividad
                        details  = lista[i];
                        cdetails = details.length;

                        for(d=0; d<cdetails;d++){//d=tipo de pax + precios
                            //Actualizamos tarifas
                            $("#precio_"+i+"_"+d).val(tarifaPublicaAgenciasTours(details[d], '<?php echo $tour->empresa[0]->comision_tours; ?>'));
                        }                    
                    }

                    var tipoActividad = $("#rate").val();
                    muestraPrecios(tipoActividad);              

                    $(".campoReserva").show();
                }                          
            });   
        });        

        function mostrarCaja(){
            $("#subcajita").removeClass("d-none");
            $("#btnActiva").hide();
        }   
        
        function cerrarCaja(){
            $("#subcajita").addClass("d-none");
            $("#btnActiva").show();
        }
        
        function calculaPrecio(){
            let suma = 0;
            $(".tipoCat").each(function(){
                var id_cat = $(this).data("id");
                var precio = $(this).data("precio");
                var cant   = $('option:selected', this).attr("rel");
                
                if(precio > 0 && cant > 0){
                    suma = suma + (cant * precio);
                  }else{
                    suma = suma + 0;
                }
            });

            $("#total").val("$ "+formatearMoneda(suma.toFixed(2))+" <?php echo $monedaSeleccionada; ?>");
            $("#precioTotal").val(suma.toFixed(2));
        }
            
             //Script pedrito 2
            document.querySelector("#check_avails").addEventListener("submit", function(e) {
                const sels = document.querySelectorAll(".adulto_canBook")
                console.log(sels);
                //const adultos = sel.options[sel.selectedIndex].text;
                for(var i = 0; i<sels.length; i++){
                    var empty = true;
                    const adultos = sels[i].options[sels[i].selectedIndex].text;
                    console.log(adultos)
                    if (adultos != "Seleccione..." && adultos != "0") {
                        empty = false;
                        break
                    }
            }
                if(empty){
                    document.querySelector(".errores-adultos").innerHTML = "La actividad requiere adultos"
                    e.preventDefault()
                    return
                }
            })
      
    </script>


</body>
</html>