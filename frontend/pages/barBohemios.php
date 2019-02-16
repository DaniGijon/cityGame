<?php
global $db;
        include (__ROOT__.'/backend/comprobaciones.php');
        $id = $_SESSION['loggedIn'];
        comprobarZona1Barrio1();
        
        echo "<div id='moduloZona'>";
            
            echo "<div class='contenido'>";
                echo "<div class='seccionSpotImagen'>" ;
                    echo"seccionSpotImagen";
                echo "</div>"; //FIN DE div seccionSpotImagen
               
                echo "<div class='seccionSpotOpciones'>";
                echo "El camarero te saluda con una amable sonrisa, es un lugar acogedor. \"¿Qué desea tomar?\" <br><br>";
                ?>
                
                <label><input type="checkbox" id="cbox1" value="first_checkbox"> Quesadillas (+15 Salud) (10€)</label><br>
                <input type="checkbox" id="cbox2" value="second_checkbox"> <label for="cbox2">Fajitas (+30 Salud) (18€)</label><br><br>
                <input type="checkbox" id="cbox3" value="third_checkbox"> <label for="cbox3">Cafe con leche (+10 Energia) (2€)</label><br>
                <input type="checkbox" id="cbox4" value="fourth_checkbox"> <label for="cbox4">Cafe irlandes (+15 Energia) (3€)</label><br><br>
                <input type="submit" value="Tomar">
                <?php
                    
                echo "</div>"; //FIN DE div seccionSpotOpciones

                
            echo "</div>"; //FIN DE div contenido

        echo "</div>"; //FIN DE div moduloZona
