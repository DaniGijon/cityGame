<?php
global $db;
        include (__ROOT__.'/backend/comprobaciones.php');
        $id = $_SESSION['loggedIn'];
        comprobarZona1Barrio2();
        
        echo "<div id='moduloZona'>";
            
            echo "<div class='contenido'>";
                echo "<div class='seccionSpotImagen'>" ;
                    echo"seccionSpotImagen";
                echo "</div>"; //FIN DE div seccionSpotImagen
                
                echo "<div class='seccionSpotInfo'>";
                    $popularidadAqui = getPopularidadCentroMujer();
                    echo "Tu popularidad aquí es: " . $popularidadAqui . "%";
                echo "</div>"; //FIN DE div seccionSpotInfo
               
                echo "<div class='seccionSpotOpciones'>";
                echo "Esto es el Centro de la Mujer. <br><br>";
                ?>
<form id = "selectorOpciones" action="?bPage=actualizaciones&action=social&nonUI" method="post">
                <input type="checkbox" name="cbox1" value="conferenciaCentroMujer"> <label for="cbox3">Participar en conferencia feminista (1 Hora)</label><br>
                <label><input type="checkbox" name="cbox1" value="donacionCentroMujer"> Hacer donación <input name="cantidadDonacion" style="width:25%" type=number min="100">€</label><br><br>
                
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
        
        


