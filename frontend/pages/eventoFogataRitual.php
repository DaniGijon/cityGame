<?php
global $db;
        include (__ROOT__.'/backend/comprobaciones.php');
        include (__ROOT__.'/backend/getFotos.php');
        $id = $_SESSION['loggedIn'];
        comprobarZona1Barrio1();
        $estoyLibre = comprobarEspera();
        if($estoyLibre === 1){

            echo "<div id='moduloZona'>";
            echo "<span class = 'tituloSpot'>";
                echo "<h4>" . getNombreSpot(9) . "</h4>";
            echo "</span>";

                echo "<div class='contenido'>";
                echo "<span class='contenedor1'>"; 
                    echo "<div class='seccionSpotImagen'>" ;
                        $spotImagen = getFotoSpot(9);
                        echo $spotImagen;
                    echo "</div>"; //FIN DE div seccionSpotImagen

                    echo "<div class='seccionSpotOpciones'>";
                    echo "<br>En una noche sin luna, todos los vecinos se reúnen a la luz de la inmensa Fogata. Las hechiceras avivan la llama arrojando ofrendas y los espíritus acuden a la llamada. <br><br>";
                    
                    echo "<form id = 'selectorOpciones' action='?bPage=actualizaciones&action=accionSpot&nonUI' method='post'>";
                        echo "<div class='opcionesTienda'>";
                            echo "<label><input type='checkbox' name='cbox1' value='ritual'>Ritual<div id='opcionBox'><img src='/design/img/entrenamiento/ritmitoGeneroso.png'></div><div class='relojMini'></div><div class='precioTienda'>1H</div></label>";
                        echo "</div>";
                        
                        echo "<div class='opcionesTienda'>";
                            echo "<label><input type='checkbox' name='cbox1' value='tragoVino'>Trago Vino<div id='opcionBox'><img src='/design/img/entrenamiento/ritmitoGeneroso.png'></div><div class='monedaTienda'></div><div class='precioTienda'>40</div><div class='corazonTienda'></div><div class='vidaTienda'>+10</div></label>";
                        echo "</div>";
                        
                        echo "<div class='opcionesTienda'>";
                            echo "<label><input type='checkbox' name='cbox1' value='guarroAsao'>Guarro Asao<div id='opcionBox'><img src='/design/img/entrenamiento/ritmitoGeneroso.png'></div><div class='monedaTienda'></div><div class='precioTienda'>150</div><div class='corazonTienda'></div><div class='vidaTienda'>+50</div></label>";
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
                            
                            if (valor === 'ritual') {
                                $(".opcionSpot1").show();
                                $(".opcionSpot2").hide();
                                $(".opcionSpot3").hide();
                            }
                            else if (valor === 'tragoVino'){
                                $(".opcionSpot2").show();
                                $(".opcionSpot1").hide();
                                $(".opcionSpot3").hide();
                            }
                            else if (valor === 'guarroAsao'){
                                $(".opcionSpot3").show();
                                $(".opcionSpot1").hide();
                                $(".opcionSpot2").hide();
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
                                        $descripcionZona = "\"Asereje, ja, dejé, dejebe tu dejébere sebi nouva ma jabi andebugui andegüinidipí\"";
                                        echo $descripcionZona;
                                    echo "</span>";
                                echo "</div>"; //Fin seccionDescripcionZonaTexto
                            echo "</div>"; //FIN opcionSpot1
                            
                            echo "<div class='opcionSpot2 opcionSpot'>";
                                echo "<div class='seccionDescripcionZonaImagen'>";
                                    $imagenSpot = "<img src='/design/img/especial/tragoVino.png'>";
                                    echo $imagenSpot;
                                echo "</div>";
                                echo "<div class='seccionDescripcionZonaTexto'>";
                        
                                    echo "<span class='textoDescripcionSpot'>";
                                        $descripcionZona = "\"¡Ay qué bien sabe de gañote!\".";
                                        echo $descripcionZona;
                                    echo "</span>";
                                echo "</div>"; //Fin descripcionZonaTexto
                            echo "</div>"; //FIN opcionSpot2
                            
                             echo "<div class='opcionSpot3 opcionSpot'>";
                                echo "<div class='seccionDescripcionZonaImagen'>";
                                    $imagenSpot = "<img src='/design/img/especial/guarroAsao.png'>";
                                    echo $imagenSpot;
                                echo "</div>";
                                echo "<div class='seccionDescripcionZonaTexto'>";
                        
                                    echo "<span class='textoDescripcionSpot'>";
                                        $descripcionZona = "\"No comía un guarro así desde la comunión de la Saray\".";
                                        echo $descripcionZona;
                                    echo "</span>";
                                echo "</div>"; //Fin descripcionZonaTexto
                            echo "</div>"; //FIN opcionSpot3
                       
                    echo "</span>"; //FIN de contenedor2


                echo "</div>"; //FIN DE div contenido

            echo "</div>"; //FIN DE div moduloZona

        }
        else{
            header("location: ?page=zona&nonUI&message=Aun no he descansado de mi última acción");
        }