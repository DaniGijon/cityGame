<?php
    function dibujarCiudad(){
        global $db;
        
        $id = $_SESSION['loggedIn'];
        $spotId = 0;
        
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
                    
                    $sql = "SELECT * FROM spots WHERE idB='$barrioActual' AND idZ='$zonaActual'";
                    $stmt = $db->query($sql);
                    $result = $stmt->fetchAll();
                    
                    foreach ($result as $spots) {
                       echo "<div id = '" . $spots['idS'] . "' class='cajitaSpot fila" . $spots['fila'] . " columna" . $spots['columna'] .
                            " tipo" . $spots['tipo'] .   
                       "'>";
                       echo $spots['nombre'];
                       echo "</div>";
                    }

                echo "</div>";
                
                
                
                echo "<div class='seccionDescripcionZona'>";
                    echo "<div class='seccionDescripcionZonaImagen'>";
                        echo "Aqui irá una foto de esta zona";
                    echo "</div>";
                    echo "<div class='seccionDescripcionZonaTexto'>";
                        echo 'Asdrúbal fue construido durante el siglo XX para alojar a las familias de los trabajadores de empresas mineras y petroquímicas ubicadas en la zona Sur de la ciudad.';
                    echo "</div>";
                echo "</div>";
                
                echo "<div class='seccionDescripcionSlot'>";
                    mostrarSpot($spotId);
                
                echo "</div>";
            echo "</div>";

        echo "</div>";
?>
<script>
    /*$(".cajitaSpot").hover(function(){
        $(this).css("background-color", "lightblue");
    },
    function(){
        $(this).css("background-color", "red");
    });            
    */            
    $(".cajitaSpot").click(function(){
        var id = $(this).attr('id');
        /*$(this).css("background-color", "lightblue");*/
                   
        $.post("?bPage=ciudadFunctions", {
        spotId: id
                       
        }).done(function(){
            $("#ciudadArea").load("index.php?bPage=ciudadFunctions&dibujarCiudad&nonUI&spotClickado")
        });
    });
                    
</script>
<?php
    }
    
    function mostrarSpot($spotId){
       
       
        echo "<div class='seccionDescripcionZonaImagen'>";
            echo 'Me estas pasando idS: ' . $spotId;
        echo "</div>";
        echo "<div class='seccionDescripcionZonaTexto'>";
            echo 'Texto del slot';
        echo "</div>";
        
    }
    
    if(isset($_GET['dibujarCiudad'])){
        dibujarCiudad();
    }
    
    if(isset($_POST['spotId'])){
        mostrarSpot($_POST['spotId']);
    }

?>



