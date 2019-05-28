<?php
global $db;
        include (__ROOT__.'/backend/comprobaciones.php');
        include (__ROOT__.'/backend/getFotos.php');
        $id = $_SESSION['loggedIn'];
        comprobarZona1Barrio9();
        $estoyLibre = comprobarEspera();
        if($estoyLibre === 1){

            echo "<div id='moduloZona'>";
            echo "<span class = 'tituloSpot'>";
                echo "<h4>" . getNombreSpot(159) . "</h4>";
            echo "</span>";

                echo "<div class='contenido'>";
                echo "<span class='contenedor1'>"; 
                    echo "<div class='seccionSpotImagen'>" ;
                        $spotImagen = getFotoSpot(159);
                        echo $spotImagen;
                    echo "</div>"; //FIN DE div seccionSpotImagen

                    echo "<div class='seccionSpotOpciones'>";
                    echo "<br>En los cubos de basura frente al Wok han tirado un lote de Galletitas de la Suerte. En serio, estamos pensando lo mismo, ¿no? Tampoco hay nada de malo por acercarse a curiosear las frases un poco, digo yo.<br><br>";
                    
                    echo "<form id = 'selectorOpciones' action='?bPage=actualizaciones&action=accionSpot&nonUI' method='post'>";
                        echo "<div class='opcionesTienda'>";
                            echo "<label><input type='checkbox' name='cbox1' value='galletitaSuerte'>Galletita<div id='opcionBox'><img src='/design/img/entrenamiento/ritmitoGeneroso.png'></div><div class='relojMini'></div><div class='precioTienda'>1H</div></label>";
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
                            
                            if (valor === 'galletitaSuerte') {
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
                                        $descripcionZona = "\"¡Puaj! Quiero pensar que eso que acabo de tocar es sirope de soja. Está todo pringado, pero ya no hay vuelta atrás.\"";
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