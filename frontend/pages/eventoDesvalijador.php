<?php
global $db;
        include (__ROOT__.'/backend/comprobaciones.php');
        include (__ROOT__.'/backend/getFotos.php');
        $id = $_SESSION['loggedIn'];
        comprobarZona1Barrio6();
        
        echo "<div id='moduloZona'>";
        
            echo "<span class = 'tituloSpot'>";
                echo "<h4>" . getNombreSpot(109) . "</h4>";
            echo "</span>";
            
            echo "<div class='contenido'>";
            echo "<span class='contenedor1'>";
              $cofres=objetosDesequipadosCofres();
               
               
                echo "<div class='seccionSpotOpciones'>";
                 echo "<div class='semiTransparente'>"; 
                echo "<div class='textoDependiente'>";
                    echo "\"¡Ssshh! Calla o nos van a oir. Tráeme lo que quieras, yo lo desvalijo\".";
                echo "</div>"; //FIN textoDependiente
                echo "<div class='imagenDependiente'>";
                    echo '<img src="/design/img/dependientes/desvalijador.png">';
                echo "</div>"; //FIN imagenDependiente
                echo '<form id = "selectorOpciones" action="?bPage=actualizaciones&action=accionSpot&nonUI" method="post">';
                    //CONSULTAR OBJETOS DE TIPO COFRE QUE LLEVO DESEQUIPADOS

                    if(!$cofres){
                        echo "<br>¡Oh! Ahora no lleva nada que me puedas desbloquear.";
                        echo "<br><br><a href='?page=zona'><button class='botonVolver'></button></a><br>";
                    }
                    else{
                        echo '<form id = "selectorOpciones" action="?bPage=actualizaciones&action=accionSpot&nonUI" method="post">';
                        foreach($cofres as $cadaObjeto){
                            echo "<div class='opcionesTienda'>";
                            echo "<div class='opcionesTiendaCheckbox'>";
                                echo '<input type="checkbox" name="cbox1" value="' . $cadaObjeto['nombre'] . '">';
                            echo "</div>";
                            echo "<div class='opcionesTiendaTitulo'>";
                                echo $cadaObjeto['nombre'];
                            echo "</div>";
                            echo '<label for="cbox3"><div id="opcionBox">' . '<img src="/design/img/objetos/' . $cadaObjeto['imagenObjeto'] . '">' . '</div><div class="monedaTienda"></div><div class="precioTienda">' . 'Gratis' . '</div></label>';
                        echo "</div>";
                            
                        }

                        echo "<div class='submitTienda'>";
                            echo'<input type="submit" class="botonCerrajeria" value=" ">';
                        echo "</div>";
                            
                    }
                echo '</form>';
?>
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
                echo "</div>";    
                echo "</div>"; //FIN DE div seccionSpotOpciones

                    echo "</span>"; //FIN Contenedor1
                
            echo "<span class='contenedor2'>";
            echo "<div class='seccionSpotInfo'>";
            echo "<div class='opcionSpot0 opcionSpot' style='display: inline'>";
                echo "<div class='seccionDescripcionZonaImagen'>";
                    echo "<div class='seccionSpotImagen'>" ;
                        $spotImagen = getFotoSpot(109);
                        echo $spotImagen;
                    echo "</div>";
                echo "</div>";
                               
            echo "</div>"; //FIN opcionSpot0
                    
               
            echo "</div>";
                
        echo "</span>"; //FIN Contenedor2
    echo "</div>"; //FIN DE div contenido

echo "</div>"; //FIN DE div moduloZona