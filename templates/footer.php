<div class="container">
    <div class="row fix-footer-pedrito-2">
        <div class="col-md-4">
            <h3>¿Necesitas ayuda?</h3>
            <?php if($afiliado == 0){ ?>
                <a href="tel:<?php echo $myWebSite["telefono"]; ?>" id="phone"><?php echo $myWebSite["telefono"]; ?></a>
            <?php }else{ ?>
                <a href="tel:<?php echo $telefono_celular_codigo_pais.$telefono_celular; ?>" id="phone"><?php echo $telefono_celular_codigo_pais.$telefono_celular;; ?></a>
            <?php } ?>
            
            <a href="mailto:<?php echo $afiliado > 0 ? $emailAfiliado : $myWebSite["email_publico"]; ?>" id="email_footer"><?php echo $afiliado > 0 ? $emailAfiliado : $myWebSite["email_publico"]; ?></a>
            <?php if($afiliado > 0){ ?>
                <p><?php echo $nombreAfiliado; ?></p>
            <?php } ?>
        </div>
        <div class="col-md-3">
            <h3>Menú</h3>
            <ul>
                <li><a href="/">Inicio</a></li>
                <li><a href="experiencias">Experiencias</a></li>
                <li><a href="nosotros">Nosotros</a></li>
                <li><a href="contacto">Contáctanos</a></li>
                <li style="display: none;"><a href="login">Login</a></li>
                <li><a href="terminos-condiciones">Términos y condiciones</a></li>
                <li><a href="aviso-privacidad">Aviso de privacidad</a></li>
            </ul>
        </div>

        <?php
        $respuesta = $hotels->galeria();
        if (!empty($respuesta)) {
        ?>
        <div class="col-md-3">
            <div class="carousel-pedrito-footer owl-carousel owl-theme add_bottom_15">


				<?php
                foreach ($respuesta as $x => $data) {
                ?>		
				<div class="item"><img src="https://app.bookingtrap.com/public/storage/<?php echo $data['archivo'] ?>" alt=""></div>
                <?php } ?>
		    </div>
        </div>
        <?php } ?>

        <!-- <div class="col-md-4 col-sm-6">
            <h3>Dirección</h3>
            <p>
                Dirección de la agencia de viajes
            </p>
        </div> -->

        <div class="col-md-4" style="display: none;">
            <h3>Newsletter</h3>
            <div id="message-newsletter_2">
            </div>
            <form method="post" action="assets/newsletter.php" name="newsletter_2" id="newsletter_2">
                <div class="form-group">
                    <input name="email_newsletter_2" id="email_newsletter_2" type="email" value="" placeholder="Recibe nuestras ofertas" class="form-control">
                </div>
                <input type="submit" value="Suscribirme" class="btn_1" id="submit-newsletter_2">
            </form>
        </div>
    </div>
    <!-- End row -->
    <hr>
    <div class="row">
        <div class="col-sm-8">
            <div class="styled-select">
                <select class="form-control" name="currency" id="currency" onchange="changeCurrency(value)">
                    <?php foreach($monedas["data"] as $i => $moneda){ ?>
                    <option value="<?php echo $moneda["iso"] ?>" <?php echo $moneda["iso"]==$monedaSeleccionada ? 'selected' : ''; ?>><?php echo $moneda["iso"] ?></option>    
                    <?php } ?>
                </select>
            </div>
            <span id="copy"><?php echo strip_tags($myWebSite["footer_copyright"]); ?></span>
        </div>
        <div class="col-sm-4" id="social_footer">
            <ul>
                <?php if ($myWebSite["whatsapp"] != '') { ?>
                    <li><a target="_blank" href="https://wa.me/<?php echo $telefono_celular_codigo_pais.$telefono_celular.'?text=Estoy interesada(o) en un tour'; ?>"><i class="fab fa-whatsapp"></i></a></li>
                <?php } ?>

                <?php if ($myWebSite["facebook"] != '') { ?>
                    <li><a href="<?php echo $myWebSite["facebook"]; ?>" target="_blank"><i class="icon-facebook"></i></a></li>
                <?php } ?>                

                <?php if ($myWebSite["twitter"] != '') { ?>
                    <li><a target="_blank" href="<?php echo $myWebSite["twitter"]; ?>"><i class="icon-twitter"></i></a></li>
                <?php } ?>

                <?php if ($myWebSite["google"] != '') { ?>
                    <li><a target="_blank" href="<?php echo $myWebSite["google"]; ?>"><i class="icon-google"></i></a></li>
                <?php } ?>                                

                <?php if ($myWebSite["instagram"] != '') { ?>
                    <li><a target="_blank" href="<?php echo $myWebSite["instagram"]; ?>"><i class="icon-instagram"></i></a></li>
                <?php } ?>   
                
                <?php if ($myWebSite["pinterest"] != '') { ?>
                    <li><a target="_blank" href="<?php echo $myWebSite["pinterest"]; ?>"><i class="icon-pinterest"></i></a></li>
                <?php } ?>  
                
                <?php if ($myWebSite["youtube"] != '') { ?>
                    <li><a target="_blank" href="<?php echo $myWebSite["youtube"]; ?>"><i class="icon-youtube"></i></a></li>
                <?php } ?>

                <?php if ($myWebSite["linkedin"] != '') { ?>
                    <li><a target="_blank" href="<?php echo $myWebSite["linkedin"]; ?>"><i class="icon-linkedin"></i></a></li>
                <?php } ?>

                <?php if ($myWebSite["tiktok"] != '') { ?>
                    <li><a target="_blank" href="<?php echo $myWebSite["tiktok"]; ?>"><i class="fab fa-tiktok"></i></a></li>
                <?php } ?>                
            </ul>
        </div>
    </div>
    <!-- End row -->
</div>
<!-- End container -->


<div class="container">
    <div class="row">
        <div class="col-sm-12 text-center">
            <div class="superfooter-copyright">
               Copyright © <?php echo ($myWebSite["footer_copyright"] !== "") ? $myWebSite["footer_copyright"] : "2023 Mujer Viaja";  ?>
               <div>Powered by <b><a href="https://bookingtech.mx/" target="_blank" style="color:white">booking<span style="color: #088de7">tech</span></a></b></div>
            </div>
        </div>
    </div>
</div>

<?php if($myWebSite["whatsapp"] != ''){ 
    if($afiliado > 0){
        $whatsappNumero = $telefono_celular_codigo_pais.$telefono_celular;
    }else{
        $whatsappNumero = $myWebSite["whatsapp"];
    }
    
?>
<div id="whatsIcon" style="display: block;">
    <a class="btn-whatsapp-icon" target="_blank" href="https://api.whatsapp.com/send/?phone=<?php echo $whatsappNumero; ?>&amp;text=Hola%2C+Me+podría+brindar+más+información+de+sus+tours&amp;app_absent=0">
    <img src="img/whatsapp.png" alt="Escríbenos por whatsapp">    
    <!-- <span class="fab fa-whatsapp iconitowhats" aria-hidden="true"></span> -->
    </a>    
</div>
<?php } ?>