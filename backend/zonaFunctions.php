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
                            echo "<div class='botonDescripcionSpot'>";
                                echo"<a href='?page=$cortoSpot'><button>Ir allí</button></a>";
                            echo "</div>";
                        }
                        
                    echo "</div>";
                echo "</div>";
                
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
    
    function siguienteSpot($idS){
        global $db;
        $id = $_SESSION['loggedIn'];
        
        $sql = "UPDATE siguientespot SET idS=$idS WHERE idP='$id'";
        $db->query($sql);
    }
    
    function llegarAZona($idP){
        global $db;
        
        $sql = "SELECT idZ,idB FROM siguienteSpot WHERE idP='$idP'";
        $stmt = $db->query($sql);
        $result = $stmt->fetchAll();
        
        $llegoAZona = $result[0]['idZ'];
        $llegoABarrio = $result[0]['idB'];
        
        $sql = "UPDATE personajes SET zona=$llegoAZona, barrio=$llegoABarrio WHERE id='$idP'";
        $db->query($sql);
        
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
        //Comprobar que la zona&barrio DESTINO no es igual a la zona&barrio ACTUAL y en caso OK, llevarle allí
        $esDistintoSitio = esDistintoSitio($id);
        if($esDistintoSitio === 1){
            llegarAZona($id);
            header("location: ?page=accion&nonUI&message=Llegaste a una nueva Zona");
        }
        else{
            header("location: ?page=accion&nonUI&message=Ya estabas en esa Zona");
        }
    }
    
    if(isset($_POST['spotId'])){
        siguienteSpot($_POST['spotId']);
    }

?>



