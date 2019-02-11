<?php
    function dibujarCiudad(){
        global $db;
        
        $id = $_SESSION['loggedIn'];
        
        
        echo "<div id='moduloCiudad'>";
            echo "<a href='?page=callejero'><button>Ver Callejero</button></a><br>";

            echo "<div class='contenido'>";
                echo "<div class='seccionMapa'>" ;
                    $id = $_SESSION['loggedIn'];
                    
                    $sql = "SELECT barrio,zona FROM personajes WHERE id='$id'";
                    $stmt = $db->query($sql);
                    $result = $stmt->fetchAll();
                    
                    $barrioActual = $result[0]['barrio'];
                    $zonaActual = $result[0]['zona'];
                    
                    $sql = "SELECT spots.*, zonas.nombreZona, zonas.textoZona, zonas.imagenZona FROM spots JOIN zonas ON spots.idZ = zonas.idZ WHERE spots.idB='$barrioActual' AND spots.idZ='$zonaActual'";
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

        echo "</div>"; //FIN DE div moduloCiudad
?>
<script>
    $(".cajitaSpot").click(function(){
        var spotId = $(this).attr('id');
        alert(spotId);
        
        $.post("?bPage=ciudadFunctions", {
            spotId:spotId
        }).done(function(){
            $("#ciudadArea").load("index.php?bPage=ciudadFunctions&dibujarCiudad&nonUI&spotClickado");
        });
    });
                    
</script>
<?php
    }
    
    function mostrarSpot($spotId){
        echo "<div class='seccionDescripcionZonaImagen'>";
        global $db;
        
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
    
    if(isset($_GET['dibujarCiudad'])){
        dibujarCiudad();
    }
    
    if(isset($_POST['spotId'])){
        mostrarSpot($_POST['spotId']);
    }

?>



