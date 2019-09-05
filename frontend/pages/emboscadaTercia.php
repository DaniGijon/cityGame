<?php
global $db;
        include (__ROOT__.'/backend/comprobaciones.php');
        include (__ROOT__.'/backend/getFotos.php');
        include (__ROOT__.'/backend/fightFunctions.php');
        $id = $_SESSION['loggedIn'];
        comprobarZona1Barrio6();
        $estoyLibre = comprobarEspera();
        if($estoyLibre === 1){
            $puedoEmboscar = comprobarEmboscar();
            if($puedoEmboscar === 1){
            
        
        echo "<div id='moduloZona'>";
            echo "<span class = 'tituloSpot'>";
                echo "<h4>" . getNombreSpot(102) . "</h4>";
            echo "</span>";
            
            echo "<div class='contenido'>";
                echo "<span class='contenedor1'>";
                
                    echo "<div class='seccionSpotOpciones'>";
                        echo "<div class='semiTransparente'>"; 
                            echo "<div class='textoDependiente'>";
                                echo "Un cruce estratégico donde puedo asaltar a la gente.";
                            echo "</div>"; //FIN textoDependiente
                            echo "<div class='imagenDependiente'>";
                                echo '<img src="/design/img/dependientes/yoHombre.png">';
                            echo "</div>"; //FIN imagenDependiente
                            
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
                    
                    echo "</div>"; //Fin de semiTransparente    
                echo "</div>"; //FIN DE div seccionSpotOpciones
                
            echo "</span>"; //FIN DE contenedor1    
            echo "<span class='contenedor2'>";
                
                
            echo "</span>"; //FIN Contenedor2
            
            echo "<div class='seccionSpotImagen'>" ;
                        $imagenSpot = getFotoSpot(102);
                        echo $imagenSpot;
                    echo "</div>"; //FIN DE div seccionSpotImagen
            
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
        
        
