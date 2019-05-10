<?php
global $db;
        include (__ROOT__.'/backend/comprobaciones.php');
        include (__ROOT__.'/backend/getFotos.php');
        include (__ROOT__.'/backend/fightFunctions.php');
        $id = $_SESSION['loggedIn'];
        comprobarZona1Barrio1();
        $estoyLibre = comprobarEspera();
        if($estoyLibre === 1){
            $puedoEmboscar = comprobarEmboscar();
            if($puedoEmboscar === 1){
            
        
        echo "<div id='moduloZona'>";
            
            echo "<div class='contenido'>";
                echo "<div class='seccionSpotImagen'>" ;
                    $imagenSpot = getPilanconBurros();
                    echo $imagenSpot;
                echo "</div>"; //FIN DE div seccionSpotImagen
               
                echo "<div class='seccionSpotOpciones'>";
                echo "Parece una plaza muy transitada. Me oculto durante un rato a observar. He detectado a los siguientes jugadores:  <br><br>";
                listRivales();
                ?>

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
            header("location: ?page=zona&nonUI&message=Aun no he descansado de mi última emboscada");
        }
    }
    else{
        header("location: ?page=zona&nonUI&message=Aun no he descansado de mi última acción");
    }
        
        
