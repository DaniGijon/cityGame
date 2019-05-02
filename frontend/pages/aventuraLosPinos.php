<?php
global $db;
        include (__ROOT__.'/backend/comprobaciones.php');
        include (__ROOT__.'/backend/getFotos.php');
        $id = $_SESSION['loggedIn'];
        comprobarZona1Barrio1();
        
        echo "<div id='moduloZona'>";
            
            echo "<div class='contenido'>";
                echo "<div class='seccionSpotImagen'>" ;
                    $imagenSpot = getLosPinos();
                    echo $imagenSpot;
                echo "</div>"; //FIN DE div seccionSpotImagen
               
                echo "<div class='seccionSpotOpciones'>";
                echo "Un espeso pinar se divisa a pocos kilómetros de aquí. Todos saben que es un bosque encantado en el que habitan criaturas mágicas. <br><br>";
                ?>
<form id = "selectorOpciones" action="?bPage=aventuras&action=zona&nonUI" method="post">
                <label><input type="checkbox" name="cbox1" value="aventuraLosPinos"> Ir en busca de aventuras, fama y objetos (-30 Energía)</label><br>
                <label><input type="checkbox" name="cbox1" value="aventuraLosPinosDebil"> Dar un paseo tranquilo (-30 Energía)</label><br>
                
                <input type="submit" value="¡Jerónimoooo!">
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
        
        
