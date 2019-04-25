<?php
    function dibujarZona($id,$spotID){
        global $db;
        
                    
                    $sql = "SELECT personajes.barrio,personajes.zona,zonas.nombreZona,barrios.nombreBarrio FROM personajes INNER JOIN zonas ON (personajes.zona = zonas.idZ) AND (personajes.barrio = zonas.idB) INNER JOIN barrios ON barrios.idb = zonas.idB WHERE id='$id'";
                    $stmt = $db->query($sql);
                    $result = $stmt->fetchAll();
                    
                    $barrioActual = $result[0]['barrio'];
                    $zonaActual = $result[0]['zona'];
        
        
        echo "<div id='moduloZona'>";
            echo "<a href='?page=ciudad'><button>Ver Ciudad</button></a><br>";
            echo $result[0]['nombreZona'] . " (" . $result[0]['nombreBarrio'] . ")";
            echo "<div class='contenido'>";
                echo "<div class='seccionMapaZona'>" ;
                    
                    
                    $sql = "SELECT spots.*, zonas.nombreZona, zonas.textoZona, zonas.imagenZona FROM spots INNER JOIN zonas ON (spots.idZ = zonas.idZ) AND (spots.idB = zonas.idB) WHERE spots.idB='$barrioActual' AND spots.idZ='$zonaActual'";
                    $stmt = $db->query($sql);
                    $result = $stmt->fetchAll();
                    
                    foreach ($result as $spots) {
                       echo "<div id = '" . $spots['idS'] . "' class='cajitaSpot fila" . $spots['fila'] . " columna" . $spots['columna'] .
                            " tipo" . $spots['tipo'] .   
                       "'>";
                       echo $spots['nombre'];
                       echo "</div>";
                    }

                echo "</div>"; //FIN DE div seccionMapa
                
                
                
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
                            $descripcionZona = $result[0]['textoZona'];
                            echo $descripcionZona;
                        }
                        else{
                            $sql = "SELECT * FROM spots WHERE idS = '$spotID'";
                            $stmt = $db->query($sql);
                            $res = $stmt->fetchAll();
                            
                            $cortoSpot = $res[0]['corto'];
                            $nombreSpot = $res[0]['nombre'];
                            echo $nombreSpot;
                            echo"<a href='?page=$cortoSpot'><button>Ir allí</button></a>";
                            
                        }
                        
                    echo "</div>";
                echo "</div>";
                
            /*    echo "<div class='seccionDescripcionSpot'>";
                
                    mostrarSpot($spotID);
                
                echo "</div>";*/
            echo "</div>"; //FIN DE div contenido

        echo "</div>"; //FIN DE div moduloZona
?>
<script>
    $(".cajitaSpot").click(function(){
        var spotId = $(this).attr('id');
        
        /*$(".seccionDescripcionZona").toggle();
        $(".seccionDescripcionSpot").toggle();*/

        $.post("?bPage=zonaFunctions", {

            spotId: spotId

        }).done(function(){
               
               $("#zonaArea").load("index.php?bPage=zonaFunctions&dibujarZona&nonUI")
                
        })
    });
                    
</script>
<?php
    }

    function mostrarSpot($reciboSpotId){
        
        echo "<div class='seccionDescripcionZonaImagen'>";
        global $db;
        var_dump($reciboSpotId);
        
        $sql = "SELECT * FROM spots WHERE idS = '?'";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($reciboSpotId));
        $res = $stmt->fetch();
        $cuenta = $stmt->rowCount();
        
        //SI EL OBJETO EXISTE
        if($cuenta > 0){
            echo 'Me estas pasando idS: ' . $reciboSpotId;
        }
        else{
            echo 'Tu padre';
        }
        echo "</div>";
        echo "<div class='seccionDescripcionZonaTexto'>";
            echo 'Texto del spot';
        echo "</div>";
    }
    
    function siguienteSpot($idS){
        global $db;
        $id = $_SESSION['loggedIn'];
        
        $sql = "UPDATE siguientespot SET idS=$idS WHERE idP='$id'";
        $db->query($sql);
    }
    
    if(isset($_GET['dibujarZona'])){
        $id = $_SESSION['loggedIn'];
        include (__ROOT__.'/backend/comprobaciones.php');
        
        $spotSeleccionado = getSiguienteSpot($id);
        dibujarZona($id, $spotSeleccionado);
    }
    
    if(isset($_POST['spotId'])){
        siguienteSpot($_POST['spotId']);
    }

?>



