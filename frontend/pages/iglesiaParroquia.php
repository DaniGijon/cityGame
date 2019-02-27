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
                echo "Me adentro en la angosta Parroquia del barrio Cañamares. Un lugar para el rezo y oración.<br><br>";
                ?>
<form id = "selectorOpciones" action="?bPage=actualizaciones&action=accionSpot&nonUI" method="post">
                
                <label><input type="checkbox" name="cbox1" value="plegaria"> Entonar una pequeña plegaria (Energia Muy Baja)</label><br><br>
                
                <input type="submit" value="Amén">
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
