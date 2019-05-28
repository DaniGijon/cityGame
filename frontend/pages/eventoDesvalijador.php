<?php
global $db;
        include (__ROOT__.'/backend/comprobaciones.php');
        include (__ROOT__.'/backend/getFotos.php');
        $id = $_SESSION['loggedIn'];
        comprobarZona1Barrio4();
        
        echo "<div id='moduloZona'>";
        
            echo "<span class = 'tituloSpot'>";
                echo "<h4>" . getNombreSpot(69) . "</h4>";
            echo "</span>";
            
            echo "<div class='contenido'>";
            echo "<span class='contenedor1'>";
                echo "<div class='seccionSpotImagen'>" ;
                    $imagenSpot = getFotoSpot(69);
                    echo $imagenSpot;
                echo "</div>"; //FIN DE div seccionSpotImagen
               
                echo "<div class='seccionSpotOpciones'>";
                echo "\"Sshhh. ¡Calla o nos van a oir!\". He pillado a este tipo desvalijando una tumba. Me ofrece abrir gratis cualquier objeto que se me resista si a cambio guardo silencio.<br><br>"; 
                
                echo '<form id = "selectorOpciones" action="?bPage=actualizaciones&action=accionSpot&nonUI" method="post">';
                    //CONSULTAR OBJETOS DE TIPO COFRE QUE LLEVO DESEQUIPADOS
                    $cofres=objetosDesequipadosCofres();
                    
                    if(!$cofres){
                        echo "¡Oh! Ahora no llevo nada para desbloquear.<br>";
                        echo "<br><a href='?page=zona'><button class='botonVolver'>Volver</button></a><br>";
                    }
                    else{
                        foreach($cofres as $cadaObjeto){
                            echo "<div class='opcionesTienda'>";
                                echo "<input type='checkbox' name='cbox1' value='G" . $cadaObjeto['nombre'] . "'>" . $cadaObjeto['nombre'] . "<label for='cbox2'><div id='opcionBox'>" . "<img src='/design/img/objetos/" . $cadaObjeto['imagenObjeto'] . "'>" . "</div><div class='monedaTienda'></div><div class='precioTienda'>" . "0" . "</div></label>";
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
                    
                echo "</div>"; //FIN DE div seccionSpotOpciones

                    echo "</span>"; //FIN Contenedor1
                
            echo "<span class='contenedor2'>";
            echo "<div class='seccionSpotInfo'>";
                echo "<div class = 'seccionContacto'>";
                    echo "<div class = 'mapaCallejero'>";
                        echo '<iframe width="300" height="225" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.openstreetmap.org/export/embed.html?bbox=-4.086366891860963%2C38.67729360355424%2C-4.072569608688355%2C38.683148025708874&amp;layer=mapnik&amp;marker=38.680213424805736%2C-4.0794725420710165" style="border: 1px solid black"></iframe><br/>';
                    echo "</div>";
                    echo "<div class = 'infoSpot'>";
                        echo "<table border = '0' style = 'text-align:left'>";
                            echo "<tr>";
                               echo "<td><div class='mapaMini'></div> En algún rincón del Cementerio<br></td>";
                            echo "</tr>";
                            echo "<tr>";
                               echo "<td><div class='telefonoMini'></div>  ????<br></td>";
                            echo "</tr>";
                            echo "<tr>";
                                echo "<td><div class='relojMini'></div> ????</td>";
                            echo "</tr>";
                        echo "</table>";
                    echo "</div>";
                echo "</div>";
                    
               
            echo "</div>";
                
        echo "</span>"; //FIN Contenedor2
    echo "</div>"; //FIN DE div contenido

echo "</div>"; //FIN DE div moduloZona