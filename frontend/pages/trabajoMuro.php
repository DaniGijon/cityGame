<?php
global $db;
        include (__ROOT__.'/backend/comprobaciones.php');
        include (__ROOT__.'/backend/getFotos.php');
        $id = $_SESSION['loggedIn'];
        comprobarZona2Barrio9();
        $estoyLibre = comprobarEspera();
            if($estoyLibre === 1){
        
        echo "<div id='moduloZona'>";
            
            echo "<div class='contenido'>";
                echo "<div class='seccionSpotImagen'>" ;
                    $imagenSpot = getMuro();
                    echo $imagenSpot;
                echo "</div>"; //FIN DE div seccionSpotImagen
               
                echo "<div class='seccionSpotOpciones'>";
                echo "Un enorme muro se alza por encima del alcance de mi visión. Durante siglos, la Guardia de la Noche ha mantenido a la ciudad a salvo de los Salvajes del Norte.<br><br>";
                ?>
<form id = "selectorOpciones" action="?bPage=actualizaciones&action=accionSpot&nonUI" method="post">
                
                <label><input type="checkbox" name="cbox1" value="guardiaNoche"> Apatrullar durante 1 Hora</label><br><br>
                
                <input type="submit" value="Por la Guardia!">
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
            }
            else{
                header("location: ?page=zona&message=Aun no he descansado de mi última acción");
            }

