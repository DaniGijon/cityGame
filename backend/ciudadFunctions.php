<?php
    function dibujarCiudad(){
        
        global $db;
        
        $id = $_SESSION['loggedIn'];
        
        
        echo "<div id='moduloZona'>";
            
            echo "<div class='contenido'>";
                echo "<div class='seccionMapaCiudad'>" ;
                    $id = $_SESSION['loggedIn'];
                    
                    $sql = "SELECT * FROM zonas";
                    $stmt = $db->query($sql);
                    $result = $stmt->fetchAll();
                    
                    foreach ($result as $zonas) {
                       echo "<div id = 'barrio" . $zonas['idB'] . "zona" . $zonas['idZ'] .  
                       "' class='" . "barrio" . $zonas['idB'] . " cuadritoZona'>";
                       echo $zonas['nombreZona'];
                       echo "</div>";
                    }
                echo "</div>"; //FIN DE div seccionMapaCiudad
               
                echo "<div class='seccionDescripcionZona'>";
                    echo "<div class='seccionDescripcionZonaImagen'>";
                        
                        $imagenZona = "<img src='/design/img/zonas/" . $result[1]['imagenZona'] . "'>";
                        echo $imagenZona;
                    
                    echo "</div>";
                    echo "<div class='seccionDescripcionZonaTexto'>";
                        echo'Caja de Texto';
                        ?>
                <form action="?bPage=actualizaciones&action=actualizarZona&nonUI" method="post">
                   <input type="hidden" name="casilla" value="3"> <!-- Value hay que automatizarlo -->
                   <input type="submit" value="Ir allí">
		</form>
                        <?php
                    echo "</div>";
                echo "</div>";
                
                echo "<div class='seccionDescripcionSpot'>";
                    mostrarSpot($spotId);
                
                echo "</div>";
                
            echo "</div>"; //FIN DE div contenido

        echo "</div>"; //FIN DE div moduloZona
    }
?>