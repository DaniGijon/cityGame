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
                echo "Un día soleado y tranquilo. Buen momento para subir a la bici y entrenar estas piernas. <br><br>";
                ?>
<form id = "selectorOpciones" action="?bPage=actualizaciones&action=accionSpot&nonUI" method="post">
                <input type="checkbox" name="cbox1" value="pedaleoSuave"> <label for="cbox3">Pedaleo Suave (Energia Baja)</label><br>
                <input type="checkbox" name="cbox1" value="pedaleoFuerte"> <label for="cbox4">Ritmito Generoso (Energia Media)</label><br>
                <label><input type="checkbox" name="cbox1" value="indurain"> ¡Miradme, soy el jodido Induráin! (Energia Alta)</label><br><br>
                
                <input type="submit" value="Vamos">
</form>                
                <script>
                    
                    $(":checkbox").change(function(){
                       var $box = $(this);
                      
                       $box.parents('#selectorOpciones').find(':checkbox').each(function(){
                          $(this).prop('checked', false); 
                       });
                       $box.prop("checked", true);

                    });
                </script>

                <?php
                    
                echo "</div>"; //FIN DE div seccionSpotOpciones

                
            echo "</div>"; //FIN DE div contenido

        echo "</div>"; //FIN DE div moduloZona
        
        
