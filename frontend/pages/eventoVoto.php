<?php
global $db;
        include (__ROOT__.'/backend/comprobaciones.php');
        include (__ROOT__.'/backend/getFotos.php');
        $id = $_SESSION['loggedIn'];
        comprobarZona3Barrio6();
        $estoyLibre = comprobarEspera();
        if($estoyLibre === 1){

            echo "<div id='moduloZona'>";
            echo "<span class = 'tituloSpot'>";
                echo "<h4>" . getNombreSpot(129) . "</h4>";
            echo "</span>";

                echo "<div class='contenido'>";
                echo "<span class='contenedor1'>"; 
                    echo "<div class='seccionSpotImagen'>" ;
                        $spotImagen = getFotoSpot(129);
                        echo $spotImagen;
                    echo "</div>"; //FIN DE div seccionSpotImagen

                    echo "<div class='seccionSpotOpciones'>";
                    echo "<br>Un mágico y emocionante acto, en el que el fuego está presente, da el inicio al Guiso del Santo Voto<br><br>";
                    
                    echo "<form id = 'selectorOpciones' action='?bPage=actualizaciones&action=accionSpot&nonUI' method='post'>";
                        echo "<div class='opcionesTienda'>";
                            echo "<label><input type='checkbox' name='cbox1' value='tomarGuiso'>Guiso<div id='opcionBox'><img src='/design/img/entrenamiento/ritmitoGeneroso.png'></div><div class='relojMini'></div><div class='precioTienda'>1H</div></label>";
                        echo "</div>";
                        
                        echo "<div class='submitTienda'>";
                            echo "<input type='submit' class='botonCarrilBici' value=' '>";
                        echo "</div>";
                    echo "</form>";           
            ?>
                    <script>

                       $(":checkbox").change(function(){
                            var $box = $(this);

                            $box.parents('#selectorOpciones').find(':checkbox').each(function(){
                               $(this).prop('checked', false); 
                            });
                            $box.prop("checked", true);

                        });
                        
                        $(":checkbox").click(function(){
                            var valor = $(this).val();
                            
                            if (valor === 'tomarGuiso') {
                                $(".opcionSpot1").show();
                            }
                            
                        });
                        
                        
                    </script>

                    <?php

                    echo "</div>"; //FIN DE div seccionSpotOpciones
                    echo "</span>"; //Fin de Contenedor1
                    
                    echo "<span class='contenedor2'>";
                        
                            echo "<div class='opcionSpot1 opcionSpot'>";
                                echo "<div class='seccionDescripcionZonaImagen'>";
                                    $imagenSpot = "<img src='/design/img/especial/ritual.png'>";
                                    echo $imagenSpot;
                                echo "</div>";
                                echo "<div class='seccionDescripcionZonaTexto'>";
                        
                                    echo "<span class='textoDescripcionSpot'>";
                                        $descripcionZona = "\"Probar un poco del Guiso sagrado que se lleva ofreciendo a la Virgen de Gracia desde la Peste del año 1348.\"";
                                        echo $descripcionZona;
                                    echo "</span>";
                                echo "</div>"; //Fin seccionDescripcionZonaTexto
                            echo "</div>"; //FIN opcionSpot1
                                                   
                    echo "</span>"; //FIN de contenedor2


                echo "</div>"; //FIN DE div contenido

            echo "</div>"; //FIN DE div moduloZona

        }
        else{
            header("location: ?page=zona&nonUI&message=Aun no he descansado de mi última acción");
        }

