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
                echo "<div class = 'tituloZona'>";
                    echo $result[0]['nombreZona'] . " <br>(" . $result[0]['nombreBarrio'] . ")";
                echo "</div>";
                echo "<span class = 'irA'>";
                    echo "Ir a Otra Zona";
                echo "</span>";
                echo "<div class='seccionMapaZona'>" ;
                
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

                echo "</div>"; //FIN DE div seccionMapa
                echo "</span>"; //FIN DE CONTENEDOR1
                
                echo "<span class='contenedor2'>";
                echo "<div class='seccionDescripcionZona'>";
                    echo "<div class='seccionDescripcionZonaImagen'>";
                        if($spotID === 0){
                            $imagenZona = "<img src='/design/img/zonas/" . $result[0]['imagenZona'] . "'>";
                            echo $imagenZona;
                        }
                        else{
                            $sql = "SELECT * FROM spots WHERE idS = '$spotID'";
                            $stmt = $db->query($sql);
                            $res = $stmt->fetchAll();
                            
                            $imagenSpot = "<img src='/design/img/spots/" . $res[0]['imagenSpot'] . "'>";
                            echo $imagenSpot;
                            
                        }
                    
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
                            echo "<div class='textoDescripcionSpot'>";
                                echo $nombreSpot;
                            echo "</div>";
                            echo "<br>";
                            echo "<div class='iconoDescripcionSpot'>";
                                echo $iconoSpot;
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
    
    if(isset($_POST['spotId'])){
        siguienteSpot($_POST['spotId']);
    }

?>



