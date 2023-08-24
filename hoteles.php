<!DOCTYPE html>
<?php 
    include("templates/language.php"); 
    include("class/allclass.php"); 
?>   

<head>
    <title>Descubre los mejores hoteles en todo el mundo</title>    
    <meta name="description" content="Hoteles en todo el mundo para mujeres">
    <meta name="keywords" content="hoteles para mujeres, hoteles todo incluido para mujeres">	
    <?php include("templates/head.php"); ?>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
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
                <h1>Nuestros hoteles</h1>
				<p>Estás a unos clics de reservar el mejor hotel del destino seleccionado</p>
			</div>
		</div>
	</section>
	<!-- End section -->
	<!-- End SubHeader ============================================ -->

	<section class="wrapper">
		<div class="divider_border_gray"></div>
		<!-- End filters -->

		<div class="container">
            <!-- INICIA MOTOR -->
            <div class="row borderMotor">
                <div class="col-12">

                    <!-- INICIA MOTOR -->
                    <form id="formbuscador" action="hotel-list" method="get" class="container-fluid">
                        <div class="row">
                            <h3 class="tituloMotor">¿A dónde quieres ir?</h3>                        
                            <div class="col-12 col-sm-5 text-left cajamotor">
                                <div class="form-group">
                                    <input type="hidden" name="nombreDestino" id="nombreDestino" value="">
                                    <input type="hidden" name="lang" id="lang" value="es">
                                    <label for="">Busca tu destino</label>
                                    <select style="width: 100%;" name="destino_tours" id="destino_tours" class="form-control" required></select>
                                </div>                             
                            </div>

                            <div class="col-12 col-sm-3 text-left cajamotor">
                                <div class="form-group">
                                    <label for="">Checkin / Checkout</label>
                                    <input type="hidden" name="checkin" id="date_start" value="">
                                    <input type="hidden" name="checkout" id="date_end" value="">
                                    <input type="text" id="fechas" name="fechas" class="form-control" readonly>
                                </div>                             
                            </div> 
                            
                            <div class="col-12 col-sm-2 text-left cajamotor">
                                <div class="form-group">
                                    <label for="">Adultos</label>
                                    <select name="adultos" id="adultos" class="form-control" required>
                                        <?php for($i=1; $i<=10; $i++){ ?>
                                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>                             
                            </div>  
                            
                            <div class="col-12 col-sm-2 text-left cajamotor">
                                <div class="form-group">
                                    <label for="">Menores</label>
                                    <select name="menores" id="menores" class="form-control" onchange="menoresEdadesPedrito(value)">
                                        <?php for($i=0; $i<=4; $i++){ ?>
                                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>                             
                            </div> 
                        </div> 
                        
                        <div class="row">
                            <div class="col-12 col-sm-2 text-left cajaEdad oculto" id="edad1">
                                <div class="form-group">
                                    <label for="">Edad</label>
                                    <select disabled required name="edad[]" class="form-control">
                                        <option value="" disabled selected>Seleccione</option>
                                        <?php for($i=1; $i<=16; $i++){ ?>
                                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                        <?php } ?>
                                    </select>                                            
                                </div>                                          
                            </div>

                            <div class="col-12 col-sm-2 text-left cajaEdad oculto" id="edad2">
                                <div class="form-group">
                                    <label for="">Edad</label>
                                    <select disabled required name="edad[]" class="form-control">
                                        <option value="" disabled selected>Seleccione</option>
                                        <?php for($i=1; $i<=16; $i++){ ?>
                                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                        <?php } ?>
                                    </select>                                            
                                </div>                                          
                            </div>
                            
                            <div class="col-12 col-sm-2 text-left cajaEdad oculto" id="edad3">
                                <div class="form-group">
                                    <label for="">Edad</label>
                                    <select disabled required name="edad[]" class="form-control">
                                        <option value="" disabled selected>Seleccione</option>
                                        <?php for($i=1; $i<=16; $i++){ ?>
                                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                        <?php } ?>
                                    </select>                                            
                                </div>                                          
                            </div>
                            
                            <div class="col-12 col-sm-2 text-left cajaEdad oculto" id="edad4">
                                <div class="form-group">
                                    <label for="">Edad</label>
                                    <select disabled required name="edad[]" class="form-control">
                                        <option value="" disabled selected>Seleccione</option>
                                        <?php for($i=1; $i<=16; $i++){ ?>
                                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                        <?php } ?>
                                    </select>                                            
                                </div>                                          
                            </div>                            

                            <div class="col-12 col-sm-3 cajamotor">
                                <label for="">&nbsp;</label>
                                <button id="btnBuscahotel" class="btn btn-primary w-100 btnMotor" type="submit">
                                    BUSCAR HOTELES
                                </button>                                                    
                            </div>                            
                        </div>
                    </form>               
                    <!-- TERMINA MOTOR -->
                </div>
            </div>            
            <!-- TERMINA MOTOR -->

			<!-- End strip list -->

			<!-- End row -->
		</div>
		<!-- End container -->
	</section>
	<!-- End section -->

	<div class="container margin_60">
		<div class="banner">
			<h3>Reserva con anticipación y paga poco a poco tu hospedaje. Para más información contáctanos</h3>
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

    <!-- Scripts -->  
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/i18n/es.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

 

	<!-- SPECIFIC SCRIPTS -->
	<script src="js/jquery.selectbox-0.2.js"></script>
    <script>
        $(document).ready(function(){          

            let today  = moment().add(5, 'days').format("YYYY/MM/DD")
            let maxday = moment().add(730, 'days').format("YYYY/MM/DD")

            $("#date_start").val(moment().add(5, 'days').format("YYYY-MM-DD"));
            $("#date_end").val(moment().add(6, 'days').format("YYYY-MM-DD"));

            $('#fechas').daterangepicker({
                autoApply: true,
                opens: 'left',
                minDate: today,
                maxDate: maxday,
                maxSpan:{
                    "days":30
                },
                startDate: today,
                endDate: moment().add(6, 'days').format("YYYY/MM/DD"),
                locale: {
                    applyLabel: "Aplicar",
                    format: 'YYYY-MM-DD'
                }                
            }, function(start, end, label) {
                $("#date_start").val(start.format('YYYY-MM-DD'));
                $("#date_end").val(end.format('YYYY-MM-DD'));
            });            

            $('#fechas').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
            });  

            $(".selectbox").selectbox();

            $('#destino_tours').select2({                
                minimumInputLength: 3,
                dropdownPosition: 'below',
                allowClear: true,
                width: 'resolve',
                placeholder: 'Escribe un destino ó un hotel',
                language: "es",                          
                ajax: {
                    url: 'destination-search',
                    delay: 150,
                    dataType: 'json',
                    data: function (params) {
                        var query = {
                            search: params.term
                        }
                            return query;
                            
                    }                            
                },
                      
            }); 
            
            $('#destino_tours').on('select2:select', function (e) {
                var data = e.params.data;
                $("#nombreDestino").val(data.text);
            });    
            
            $(document).on('select2:open', () => {
                document.querySelector('.select2-search__field').focus();
            });                
        });


        function menoresEdadesPedrito(menores) {
      for (i = 1; i <= 4; i++) {
        if (i <= menores) {
          $("#edad" + i).show();
          $(`#edad${i} select`).removeAttr('disabled')
        } else {
          $("#edad" + i).hide();
          $(`#edad${i} select`).prop("disabled", true);
        }
      }
    }
        
    </script>    

</body>

</html>