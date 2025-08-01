<?php 
    session_start();
    include("class/paquetes.class.php");
    include("class/utilities.class.php");

    use PaquetesClass\Paquetes;
    use funcionesglobales\funciones;
    $info = new Paquetes();
    $fn = new funciones();

    $tours = new Paquetes();
    $hotels = new Paquetes();
    $fn = new funciones(); 
    
    //Monedas
    $monedas       = $tours->monedas();
    $monedaDefault = $monedas["data"]["0"]["iso"];
    $tipoCambio    = $monedas["data"]["0"]["tipo_cambio"];

    if(isset($_SESSION["moneda"])){
        $monedaSeleccionada = $_SESSION["moneda"];
    }else{
        $monedaSeleccionada = $monedas["data"]["0"]["iso"];
    }

    $idtour       = $_GET["tour"];
    $fecha        = strval($_GET["fecha"]);
    $dias         = $_GET["dias"];
    $mostrarpromo = $_GET["mostrar"];
    $booking      = $_GET["booking"];
    $travel       = $_GET["travel"];
    $clase        = $_GET["clase"];

    if(isset($_GET["generales"])){
        $grales = 1;
        $generales = $_GET["generales"];
        $booking_window_inicio = $generales[0]["booking_window_inicio"];
        $booking_window_fin = $generales[0]["booking_window_fin"];
        $travel_window_inicio = $generales[0]["travel_window_inicio"];
        $travel_window_fin = $generales[0]["travel_window_fin"];
    }else{
        $grales = 0;
    }

    $txtFechaPromo='';

    if($booking == 1 && $mostrarpromo == 1){
        $txtFechaPromo='<span class="text-danger">';
        $txtFechaPromo.="Reservando entre las fechas del ".$fn->fechaAbreviada($booking_window_inicio)." al ".$fn->fechaAbreviada($booking_window_fin). " y viajando en cualquier fecha";

        if($travel_window_inicio != ''){
            $txtFechaPromo.=", y viajando entre las fechas del ".$fn->fechaAbreviada($travel_window_inicio)." al ".$fn->fechaAbreviada($travel_window_fin);
        }
        $txtFechaPromo.='</span';
    }

    if($travel == 1 && $mostrarpromo == 1){
        $txtFechaPromo='<span class="text-danger">';
        $txtFechaPromo.="Viajando entre las fechas del ".$fn->fechaAbreviada($travel_window_inicio)." al ".$fn->fechaAbreviada($travel_window_fin);
        $txtFechaPromo.='</span';
    }

    $precios = $info->getPrices($idtour, $dias, $fecha, $clase);
    $promocion = isset($_GET["generales"]) ? $_GET["generales"] : 0;  
?> 
    <input type="hidden" id="descuento" name="descuento" value="<?php echo $grales == 1 ? $promocion[0]["descuento"] : ''; ?>">
    <input type="hidden" id="tipo_descuento" name="tipo_descuento" value="<?php echo $grales == 1 ? $promocion[0]["tipo_descuento"] : ''; ?>">
    <input type="hidden" id="valor_promocion" name="valor_promocion" value="<?php echo $grales == 1 ? $promocion[0]["valor_promocion"] : ''; ?>">
    <input type="hidden" id="paxes_promocion" name="paxes_promocion" value="<?php echo $grales == 1 ? $promocion[0]["paxes_promocion"] : ''; ?>">
    <input type="hidden" id="mostrarpromo" name="mostrarpromo" value="<?php echo $mostrarpromo; ?>">
    <input type="hidden" id="nombre" name="nombredescuento" value="<?php echo $grales == 1 ? $promocion[0]["nombreDescuento"] : ''; ?>">
    <input type="hidden" id="idpromo" name="idpromo" value="<?php echo $grales == 1 ? $promocion[0]["id"] : ''; ?>">
    <input type="hidden" id="idexpromo" name="idexpromo" value="<?php echo $grales == 1 ? $promocion[0]["idexpromo"] : ''; ?>">
    <?php if(count($precios) > 0){ ?>
    <table class="table table-bordered text-center">
        <thead>
            <tr>
                <th scope="col" style="background-color:#f1f1f1">ADULTOS</th>
                <th scope="col" style="background-color:#f1f1f1">MENORES</th>
                <th scope="col" style="background-color:#f1f1f1;">INFANTES</th>
            </tr>
        </thead>
        <tbody>
            <?php if($promocion != 0 && $mostrarpromo == 1){ 
                //Tarifas promocionales
                ?>  
                <tr>
                    <td style="background-color: #c7dff2; color:black;">
                        <p class="text-center precios"> 
                            <label>
                                <?php 
                                    if($promocion[0]["descuento"] == 1){
                                        if($promocion[0]["tipo_descuento"]== 1){
                                            //Porcentaje
                                            $precioAdulto = $precios[0]["adulto_sencilla"] - ($precios[0]["adulto_sencilla"] * ($promocion[0]["valor_promocion"]/100));
                                        }else{
                                            //Monto
                                            $precioAdulto = $precios[0]["adulto_sencilla"] - $promocion[0]["valor_promocion"];
                                        }

                                        $precioAdultoNormal = $fn->precio($precios[0]["adulto_sencilla"], $precios[0]["iso"], $monedaSeleccionada, $monedaDefault, $monedas);                                            
                                        $precioAdulto  = $fn->precio($precioAdulto, $precios[0]["iso"], $monedaSeleccionada, $monedaDefault, $monedas);                                            

                                        echo '<span class="text-decoration-line-through text-danger">$ '.$precioAdultoNormal["precioformato"].' '.$precioAdultoNormal["iso"].'</span><br>';
                                        echo '<span class="">$ '.$precioAdulto["precioformato"]." ".$precioAdulto["iso"].'</span><br>';
                                    }else{
                                        echo "$ ".$precioAdulto["precioformato"]." ".$precioAdulto["iso"];
                                        // echo '$ '.$fn->moneda($precios[0]["adulto_sencilla"]).' MXN';
                                    }
                                ?>
                            </label>
                        </p>
                        <input type="hidden" id="adulto_precio" value="<?php echo $precioAdultoNormal["preciosimple"]; ?>">
                        <input type="hidden" id="adulto_precio_promo" value="<?php echo $precioAdulto["preciosimple"]; ?>">
                    </td>

                    <td style="background-color: #c7dff2; color:black;">
                        <p class="text-center precios">
                        <label>
                            <?php 
                                if($promocion[0]["descuento"] == 1){
                                    if($promocion[0]["tipo_descuento"]== 1){
                                        //Porcentaje
                                        $precioMenor = $precios[0]["menor_sencilla"] - ($precios[0]["menor_sencilla"] * ($promocion[0]["valor_promocion"]/100));
                                    }else{
                                        //Monto
                                        $precioMenor = $precios[0]["menor_sencilla"] - $promocion[0]["valor_promocion"];
                                    }

                                    $precioMenorNormal = $fn->precio($precios[0]["menor_sencilla"], $precios[0]["iso"], $monedaSeleccionada, $monedaDefault, $monedas);                                            
                                    $precioMenor  = $fn->precio($precioMenor, $precios[0]["iso"], $monedaSeleccionada, $monedaDefault, $monedas);  

                                    echo '<span class="text-decoration-line-through text-danger">$ '.$precioMenorNormal["precioformato"].' '.$precioMenorNormal["iso"].'</span><br>';
                                    echo '<span class="">$ '.$precioMenor["precioformato"].' '.$precioMenor["iso"].'</span><br>';
                                }else{
                                    $precioMenor  = $fn->precio($precios[0]["menor_sencilla"], $precios[0]["iso"], $monedaSeleccionada, $monedaDefault, $monedas);  
                                    echo "$ ".$preciomenor["precioformato"]." ".$preciomenor["iso"];
                                }
                            ?>
                        </label></p>
                        <input type="hidden" id="menor_precio" value="<?php echo $precioMenorNormal["preciosimple"] ?>">
                        <input type="hidden" id="menor_precio_promo" value="<?php echo $precioMenor["preciosimple"]; ?>">
                    </td>

                    <td style="background-color: #c7dff2; color:black;">
                        <p class="text-center precios">
                            <label>
                            <?php 
                                if($promocion[0]["descuento"] == 1){
                                    if($promocion[0]["tipo_descuento"]== 1){
                                        //Porcentaje
                                        $precioInfante = $precios[0]["infante_sencilla"] - ($precios[0]["infante_sencilla"] * ($promocion[0]["valor_promocion"]/100));
                                    }else{
                                        //Monto
                                        $precioInfante = $precios[0]["infante_sencilla"] - $promocion[0]["valor_promocion"];
                                    }

                                    $precioInfanteNormal = $fn->precio($precios[0]["infante_sencilla"], $precios[0]["iso"], $monedaSeleccionada, $monedaDefault, $monedas);                                            
                                    $precioInfante  = $fn->precio($precioInfante, $precios[0]["iso"], $monedaSeleccionada, $monedaDefault, $monedas); 
                                    
                                    echo '<span class="text-decoration-line-through text-danger">$ '.$precioInfanteNormal["precioformato"].' '.$precioInfanteNormal["iso"].'</span><br>';
                                    echo '<span class="">$ '.$precioInfante["precioformato"].' '.$precioInfante["iso"].'</span><br>';                                    
                                }else{
                                    $precioInfante  = $fn->precio($precios[0]["infante_sencilla"], $precios[0]["iso"], $monedaSeleccionada, $monedaDefault, $monedas);  
                                    echo "$ ".$precioInfante["precioformato"]." ".$precioInfante["iso"];
                                }
                            ?>                                
                            </label></p>
                        <input type="hidden" id="infante_precio" value="<?php echo $precioInfanteNormal["preciosimple"]; ?>">
                        <input type="hidden" id="infante_precio_promo" value="<?php echo $precioInfante["preciosimple"]; ?>">
                    </td>
                </tr> 
                <tr>
                    <td colspan="3">
                        <?php echo $promocion[0]["mensaje"]."<br><b>Promoción válida a partir de ".$promocion[0]["paxes_promocion"]." persona(s)</b>"; ?>
                        <?php echo "<br>".$txtFechaPromo; ?>
                    </td>
                </tr>                                
            <?php }else{ 
                    //NO TIENE PROMOCION
                    $precioAdulto  = $fn->precio($precios[0]["adulto_sencilla"], $precios[0]["iso"], $monedaSeleccionada, $monedaDefault, $monedas);
                    $precioMenor   = $fn->precio($precios[0]["menor_sencilla"], $precios[0]["iso"], $monedaSeleccionada, $monedaDefault, $monedas);
                    $precioInfante = $fn->precio($precios[0]["infante_sencilla"], $precios[0]["iso"], $monedaSeleccionada, $monedaDefault, $monedas);
                ?>   
                <tr>
                    <td style="background-color: #c7dff2; color:black;">
                        <p class="text-center precios">$ <label id="menorescostoscuadruple_1"><?php echo $precioAdulto["precioformato"]; ?></label><?php echo $precioAdulto["iso"]; ?></p>
                        <input type="hidden" id="adulto_precio" value="<?php echo $precioAdulto["preciosimple"]; ?>">
                    </td>

                    <td style="background-color: #c7dff2; color:black;">
                        <p class="text-center precios">$ <label id="menorescostostriple_1"><?php echo $precioMenor["precioformato"]; ?></label> <?php echo $precioMenor["iso"]; ?></p>
                        <input type="hidden" id="menor_precio" value="<?php echo $precioMenor["preciosimple"]; ?>">
                    </td>

                    <td style="background-color: #c7dff2; color:black;">
                        <p class="text-center precios">$ <label id="menorescostosdoble_1"><?php echo $precioInfante["precioformato"]; ?></label> <?php echo $precioInfante["iso"]; ?></p>
                        <input type="hidden" id="infante_precio" value="<?php echo $precioInfante["preciosimple"]; ?>">
                    </td>
                </tr>                  
            <?php } ?>                                     
        </tbody>
    </table>
    <?php }else{ ?>
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
                        <p class="text-center">La fecha seleccionada no tiene disponibilidad</p>
                    </td>
                </tr>                                       
            </tbody>
        </table>
    <?php } ?>
