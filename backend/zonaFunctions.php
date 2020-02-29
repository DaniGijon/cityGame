<?php
    function dibujarZona($id,$spotID){
        global $db;
        
                    
                    $sql = "SELECT personajes.barrio,personajes.zona,zonas.nombreZona,barrios.nombreBarrio FROM personajes INNER JOIN zonas ON (personajes.zona = zonas.idZ) AND (personajes.barrio = zonas.idB) INNER JOIN barrios ON barrios.idb = zonas.idB WHERE id='$id'";
                    $stmt = $db->query($sql);
                    $result = $stmt->fetchAll();
                    
                    $barrioActual = $result[0]['barrio'];
                    $zonaActual = $result[0]['zona'];
        
        
        echo "<div id='moduloZona'>";
            
            
            echo "<div class='contenido'>";
                echo "<span class='contenedor1'>";
                $cartel = elegirCartel($barrioActual,$zonaActual);
                if($cartel === 1){
                    echo "<div class = 'tituloZona1'>";
                        echo "<div class = 'textoZona1 cool'>";
                            echo $result[0]['nombreZona'];
                        echo "</div>";
                    echo "</div>";
                }
                elseif($cartel === 2){
                    echo "<div class = 'tituloZona2'>";
                        echo "<div class = 'textoZona2 cool'>";
                            echo $result[0]['nombreZona'];
                        echo "</div>";
                    echo "</div>";
                }
                elseif($cartel === 3){
                    echo "<div class = 'tituloZona3'>";
                        echo "<div class = 'textoZona3 cool'>";
                            echo $result[0]['nombreZona'];
                        echo "</div>";
                    echo "</div>";
                }
                    
                echo "<span class = 'irA cool'>";
                    echo "Ir a Otra Zona";
                echo "</span>";
                echo "<div class='seccionMapaZona'>" ;
                
                    //CARGAR MAPA BACKGROUND DE LA ZONA EN LA QUE ESTOY
                    echo "<div class='loadMapaB" . $barrioActual . "Z" . $zonaActual . "'>";
                
                    $sql = "SELECT spots.*, zonas.nombreZona, zonas.textoZona, zonas.imagenZona FROM spots INNER JOIN zonas ON (spots.idZ = zonas.idZ) AND (spots.idB = zonas.idB) WHERE spots.idB='$barrioActual' AND spots.idZ='$zonaActual'";
                    $stmt = $db->query($sql);
                    $result = $stmt->fetchAll();
                    
                    foreach ($result as $spots) {
                        //EUROEL
                       if($spots['idS'] === '24'){
                           $sql = "SELECT completada FROM progresos WHERE idM='2' AND idP='$id'";
                           $stmt = $db->query($sql);
                           $mision = $stmt->fetchAll();
                           if(isset($mision[0]))
                                $activa = $mision[0]['completada'];
                           if(isset($activa) && $activa === '1'){
                               echo "<div id = '" . $spots['idS'] . "' class='cajitaSpot fila" . $spots['fila'] . " columna" . $spots['columna'] .
                                 " tipo" . $spots['tipo'] .   
                                "'>";
                           }
                               
                       }
                       else{
                            echo "<div id = '" . $spots['idS'] . "' class='cajitaSpot fila" . $spots['fila'] . " columna" . $spots['columna'] .
                                 " tipo" . $spots['tipo'] .   
                            "'>";
                       }
                       echo "</div>";
                    }
                echo "</div>"; //FIN DE loadMapa
                echo "</div>"; //FIN DE div seccionMapa
                echo "</span>"; //FIN DE CONTENEDOR1
                
                echo "<span class='contenedor2'>";
                echo "<div class='seccionDescripcionZona'>";
                    echo "<div class='seccionDescripcionZonaImagen'>";
                        if($spotID === 0){
                            $imagenZona = "<img src='/design/img/zonas/" . $result[0]['imagenZona'] . "' style='border-radius:15px; border:1px solid silver'>";
                            echo $imagenZona;
                        }
                        else{
                            $sql = "SELECT * FROM spots WHERE idS = '$spotID'";
                            $stmt = $db->query($sql);
                            $res = $stmt->fetchAll();
                            
                            $imagenSpot = "<img src='/design/img/spots/" . $res[0]['imagenSpot'] . "' style='border-radius:15px; border: 1px solid silver;'>";
                            echo $imagenSpot;
                            
                        }
                    
                    echo "</div>";
                    
                    echo"<div class='sombraImagen'>";
                    echo "</div>";
                    
                    echo "<div class='seccionDescripcionZonaTexto'>";
                        if($spotID === 0){
                            echo "<span class='textoDescripcionSpot'>";
                                $descripcionZona = $result[0]['textoZona'];
                                echo $descripcionZona;
                            echo "</span>";
                            
                        }
                        else{
                            $sql = "SELECT * FROM spots WHERE idS = '$spotID'";
                            $stmt = $db->query($sql);
                            $res = $stmt->fetchAll();
                            
                            $cortoSpot = $res[0]['corto'];
                            $nombreSpot = $res[0]['nombre'];
                            $iconoSpot = $res[0]['tipo'];
                            echo "<div class='textoDescripcionSpot cool'>";
                                echo $nombreSpot;
                            echo "</div>";
                            echo "<br>";
                            echo "<div class='iconoDescripcionSpot'>";
                                mostrarIconoSpot($iconoSpot);
                            echo "</div>";
                            echo "<br>";
                            echo "<div class='caracteristicasDescripcionSpot'>";
                                echo $res[0]['principal'];
                                echo "<br>";
                                echo $res[0]['secundario'];
                            echo "</div>";
                            echo "<br>";
                            
                        }
                        
                    echo "</div>";
                echo "</div>";
                echo "</span>"; //FIN DE contenedor2
                
            echo "</div>"; //FIN DE div contenido

        echo "</div>"; //FIN DE div moduloZona
?>
<script>
$(".irA").click(function(event){                   
                   
        window.location = 'index.php?page=ciudad';
                      
});


 $(function() {
    $(".cajitaSpot").hover(function(){
        var spotId = $(this).attr('id');
        

        $.post("?bPage=zonaFunctions", {

            spotId: spotId

        }).done(function(){
               
               $("#zonaArea").load("index.php?bPage=zonaFunctions&dibujarZona&nonUI")
                
        })
    });
    
    $(".cajitaSpot").click(function(){
       $("#zonaArea").load("index.php?bPage=zonaFunctions&llegarASpot&nonUI")
    });
});
                    
</script>
<?php
    }
    
    function taquillear($idObjeto, $slot, $idInv, $inv){
        global $db;
        $id = $_SESSION['loggedIn'];
        
        
        //veo si realmente ese jugador tiene esos objetos en esos slots y si es afirmativo los intercambio.
        $sql = "SELECT idO FROM empenos WHERE (idP = '$id' AND slot = '$slot' AND idO = '$idObjeto')";
        $stmt = $db->query($sql);
        $resultTaquilla = $stmt->fetchAll();
        
        $sql = "SELECT idO FROM inventario WHERE (idP = '$id' AND slot = '$inv' AND idO = '$idInv')";
        $stmt = $db->query($sql);
        $resultInventario = $stmt->fetchAll();
       
        if(isset($resultTaquilla[0]) && isset($resultInventario[0])){
        
            
            $sql = "UPDATE inventario SET idO=$idObjeto WHERE (idP='$id' AND slot='$inv')";
            $db->query($sql);
            
            $sql = "UPDATE empenos SET idO=$idInv WHERE (idP='$id' AND slot='$slot')";
            $db->query($sql);
         
       }
    }
    
    function comprarTaquilla(){
        global $db;
        $id = $_SESSION['loggedIn'];
        
        //ver si tengo dinero para comprar la taquilla (10.000 monedas)
        $puedoComprar = comprobarCoste(10000);
        if($puedoComprar === 1){
            //restar dinero cash, el precio de haber comprado la taquilla (-10.000 monedas)
            $sql = "UPDATE personajes SET cash=cash-10000 WHERE id='$id'";
            $db->query($sql);

            //añadir taquilla a este personaje
            $sql = "SELECT COUNT(*) FROM empenos WHERE (idP = '$id')";
            $stmt = $db->query($sql);
            $result = $stmt->fetchAll();
            $nuevoSlot = $result[0]['COUNT(*)'];
            $sql = "INSERT INTO empenos (idP, slot, idO) VALUES ('$id','$nuevoSlot', '0')";
            $db->query($sql);
        }
        else{
            //decirle que no tiene dinero para pagar
            ?>
            <script>
                alert("No tienes dinero para comprar más taquillas.");
            </script>
            <?php
        }
        
    }
    
    function siguienteSpot($idS){
        global $db;
        $id = $_SESSION['loggedIn'];
        
        $sql = "UPDATE siguientespot SET idS=$idS WHERE idP='$id'";
        $db->query($sql);
    }
    
    function llegarAZona($idP, $voyABarrio, $voyAZona, $costeViaje){
        include_once (__ROOT__.'/backend/comprobaciones.php');
        global $db;
        //Mirar mi Vehiculo para saber cuanto va a ser el tiempoViaje        
        $tiempoViaje = TiempoViaje($idP);
        
        $sql = "UPDATE personajes SET cash = cash-$costeViaje, zona=$voyAZona, barrio=$voyABarrio, viaje = ADDTIME(NOW(), '0:$tiempoViaje:0') WHERE id='$idP'";
        $db->query($sql);
        
    }
    
    function llegarASpot($idP){
        global $db;
        
        $sql = "SELECT idS FROM siguientespot WHERE idP='$idP'";
        $stmt = $db->query($sql);
        $result = $stmt->fetchAll();
        
        $llegoASpot = $result[0]['idS'];
        
        $sql = "SELECT corto FROM spots WHERE idS = '$llegoASpot'";
        $stmt = $db->query($sql);
        $res = $stmt->fetchAll();
                            
        $cortoSpot = $res[0]['corto'];
        
        return $cortoSpot;
        
    }
    
    function elegirCartel($idB, $idZ){
        $cartel = 1;
        if(($idB === '6' && $idZ === '2') || ($idB === '6' && $idZ === '3')){ //Paseo de San Gregorio, Paseo El Bosque
            $cartel = 3;
        }
        elseif(($idB === '2' && $idZ === '1') || ($idB === '2' && $idZ === '3') || ($idB === '4' && $idZ === '1') || ($idB === '5' && $idZ === '1') || ($idB === '6' && $idZ === '1')|| ($idB === '8' && $idZ === '1') || ($idB === '9' && $idZ === '3') ||$idB === '10'){
            $cartel = 2;
        }
        return $cartel;
    }
    
    function mostrarIconoSpot($iconoSpot){
        if($iconoSpot === 'apuestas')
            echo "<div class = 'iconoSpotApostar iconoSpot'></div>";
        elseif($iconoSpot === 'tienda'){
            echo "<div class = 'iconoSpotTienda iconoSpot'></div>";
        }
        elseif($iconoSpot === 'cerrajeria'){
            echo "<div class = 'iconoSpotCerrajeria iconoSpot'></div>";
        }
        elseif($iconoSpot === 'gimnasio'){
            echo "<div class = 'iconoSpotGimnasio iconoSpot'></div>";
        }
        elseif($iconoSpot === 'hotel'){
            echo "<div class = 'iconoSpotHotel iconoSpot'></div>";
        }
        elseif($iconoSpot === 'trabajo'){
            echo "<div class = 'iconoSpotTrabajo iconoSpot'></div>";
        }
        elseif($iconoSpot === 'banco'){
            echo "<div class = 'iconoSpotBanco iconoSpot'></div>";
        }
    }
    
    if(isset($_GET['dibujarZona'])){
        $id = $_SESSION['loggedIn'];
        include (__ROOT__.'/backend/comprobaciones.php');
        
        $spotSeleccionado = getSiguienteSpot($id);
        dibujarZona($id, $spotSeleccionado);
    }
    
    if(isset($_GET['llegarAZona'])){
        $id = $_SESSION['loggedIn'];
        include (__ROOT__.'/backend/comprobaciones.php');
        include (__ROOT__.'/backend/costesViajes.php');
        global $db;
        //Comprobar que la zona&barrio DESTINO no es igual a la zona&barrio ACTUAL y en caso OK, llevarle allí
        $esDistintoSitio = esDistintoSitio($id);
        if($esDistintoSitio === 1){
            //Comprobar que puede viajar
            $puedoViajar = puedoViajar();
            if($puedoViajar === 1){
                $sql = "SELECT barrio,zona FROM personajes WHERE id='$id'";
                $stmt = $db->query($sql);
                $resultado = $stmt->fetchAll();
                            
                $estoyEnZona = $resultado[0]['zona'];
                $estoyEnBarrio = $resultado[0]['barrio'];
                
                $sql = "SELECT idB,idZ FROM siguientespot WHERE idP='$id'";
                $stmt = $db->query($sql);
                $resultado = $stmt->fetchAll();
                
                $voyABarrio = $resultado[0]['idB'];
                $voyAZona = $resultado[0]['idZ'];
                
                $costeViaje = calcularCosteViaje($voyABarrio, $voyAZona, $estoyEnBarrio, $estoyEnZona);
                $puedoPagar = comprobarCoste($costeViaje);
                if($puedoPagar === 1){
                    llegarAZona($id, $voyABarrio, $voyAZona, $costeViaje);
                    header("location: ?page=accion&nonUI&message=Llegaste a una nueva Zona");
                }
                else{
                    header("location: ?page=accion&nonUI&message=No tengo dinero para ir hasta allí");
                }
            }
            else{
                header("location: ?page=accion&nonUI&message=Aún no he descansado de mi último viaje");
            }
        }
        else{
            header("location: ?page=accion&nonUI&message=Ya estabas en esa Zona");
        }
    }
    
    if(isset($_GET['llegarASpot'])){
        $id = $_SESSION['loggedIn'];
        
        $cortoSpot = llegarASpot($id);
        header("location: ?page=$cortoSpot&nonUI");
        
    }
    
    if(isset($_GET['comprarTaquilla'])){
        $id = $_SESSION['loggedIn'];
        comprarTaquilla();
    }
    
    if(isset($_POST['idObjeto'])){
        taquillear($_POST['idObjeto'], $_POST['slot'], $_POST['idInv'], $_POST['inv']);
    }
    
    if(isset($_POST['spotId'])){
        siguienteSpot($_POST['spotId']);
    }
    
    if(isset($_POST['compraTaquilla'])){
        comprarTaquilla();
    }

?>



