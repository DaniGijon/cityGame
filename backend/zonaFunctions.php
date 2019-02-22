<?php
    function dibujarZona(){
        global $db;
        
        $id = $_SESSION['loggedIn'];
                    
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
                        
                        $imagenZona = "<img src='/design/img/zonas/" . $result[0]['imagenZona'] . "'>";
                        echo $imagenZona;
                    
                    echo "</div>";
                    echo "<div class='seccionDescripcionZonaTexto'>";
                        $descripcionZona = $result[0]['textoZona'];
                        echo $descripcionZona;
                    echo "</div>";
                echo "</div>";
                
                echo "<div class='seccionDescripcionSpot'>";
                
                    mostrarSpot($spotId);
                
                echo "</div>";
            echo "</div>"; //FIN DE div contenido

        echo "</div>"; //FIN DE div moduloZona
?>
<script>
    $(".cajitaSpot").click(function(){
        var spotId = $(this).attr('id');
        alert(spotId);
        $(".seccionDescripcionZona").toggle();
        $(".seccionDescripcionSpot").toggle();

        $.post("?bPage=zonaFunctions", {

            spotId: spotId

        }).done(function(){
               $("#zonaArea").load("index.php?bPage=zonaFunctions&dibujarZona&nonUI&spotClickado")
        })
    });
                    
</script>
<?php
    }

    function mostrarSpot($spotId){
        echo "<div class='seccionDescripcionZonaImagen'>";
        global $db;
        var_dump($spotId);
        
        $sql = "SELECT * FROM spots WHERE id = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($spotId));
        
        //SI EL OBJETO EXISTE
        if($stmt->rowCount() > 0){
            echo 'Me estas pasando idS: ' . $spotId;
        }
        else{
            echo 'Tu padre';
        }
        echo "</div>";
        echo "<div class='seccionDescripcionZonaTexto'>";
            echo 'Texto del spot';
        echo "</div>";
    }
    
    if(isset($_GET['dibujarZona'])){
        dibujarZona();
    }
    
    if(isset($_POST['spotId'])){
       mostrarSpot($_POST['spotId']);
    }

?>



