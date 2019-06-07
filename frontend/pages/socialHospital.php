<?php
global $db;
        include (__ROOT__.'/backend/comprobaciones.php');
        include (__ROOT__.'/backend/getFotos.php');
        $id = $_SESSION['loggedIn'];
        comprobarZona1Barrio9();
        
        echo "<div id='moduloZona'>";
            echo "<span class = 'tituloSpot'>";
                echo "<h4>" . getNombreSpot(155) . "</h4>";
            echo "</span>";
            
            echo "<div class='contenido'>";
            echo "<span class='contenedor1'>"; 
            
                echo "<div class='seccionSpotOpciones'>";
                    echo "<div class='semiTransparente'>";
                        echo "<div class='textoDependiente'>";
                            echo "\"Me encanta el olor de la sangre fresca por las mañanas.\"";
                        echo "</div>"; //FIN textoDependiente
                        echo "<div class='imagenDependiente'>";
                            echo '<img src="/design/img/dependientes/centroMujer.png">';
                        echo "</div>"; //FIN imagenDependiente

                    echo "<form id = 'selectorOpciones' action='?bPage=actualizaciones&action=social&nonUI' method='post'>";
                            echo "<div class='opcionesTienda'>";
                                echo "<div class='opcionesTiendaCheckbox'>";
                                    echo '<input type="checkbox" name="cbox1" value="donarSangreHospital">';
                                echo "</div>";
                                echo "<label for='cbox1'>";
                                echo "<div class='opcionesTiendaTitulo'>";
                                    echo 'Donación de Sangre';
                                echo "</div>";
                                echo "<div id='opcionBox'><img src='/design/img/entrenamiento/ritmitoGeneroso.png'></div><div class='relojMini'></div><div class='precioTienda'>15M</div></label>";
                            echo "</div>";

                            echo "<div class='opcionesTienda'>";
                            
                            echo '<div class="opcionesTiendaCheckbox"><input type="checkbox" name="cbox1" value="donarPastaHospital"></div><label for="cbox4"><div class="opcionesTiendaTitulo">Donación de Dinero</div><div id="opcionBox"><img src="/design/img/entrenamiento/ritmitoGeneroso.png"></div><div class="monedaTienda"></div><div class="precioTiendaInput"><input name="cantidadDonacion" style="width:70%; border-radius:10px;" type=number min="100"></div></label>';
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
                    </script>

                    <?php
                echo "</div>"; //Fin semiTransparente   
                echo "</div>"; //FIN DE div seccionSpotOpciones
                echo "</span>"; //FIN Contenedor1
                
                echo "<span class='contenedor2'>";
                
                echo "<div class='seccionSpotInfo'>";
                echo "<div class='semiTransparente'>";
                   $popularidadAqui = getPopularidadSpot(155);
                   echo "<div class='popularidadLetras'>";
                        echo "<h4>Tu Popularidad aquí es de: </h4>";
                   echo "</div>";
                   echo "<div class='popularidadEstrellas'>";
                        if($popularidadAqui < 10){
                            echo "<img src='/design/img/social/0estrellas.png'";
                        }
                        elseif($popularidadAqui >= 10 && $popularidadAqui < 20){
                            echo "<img src='/design/img/social/0yMediaEstrellas.png'";
                        }
                        elseif($popularidadAqui >= 20 && $popularidadAqui < 30){
                            echo "<img src='/design/img/social/1Estrellas.png'";
                        }
                        elseif($popularidadAqui >= 30 && $popularidadAqui < 40){
                            echo "<img src='/design/img/social/1yMediaEstrellas.png'";
                        }
                        elseif($popularidadAqui >= 40 && $popularidadAqui < 50){
                            echo "<img src='/design/img/social/2Estrellas.png'";
                        }
                        elseif($popularidadAqui >= 50 && $popularidadAqui < 60){
                            echo "<img src='/design/img/social/2yMediaEstrellas.png'";
                        }
                        elseif($popularidadAqui >= 60 && $popularidadAqui < 70){
                            echo "<img src='/design/img/social/3Estrellas.png'";
                        }
                        elseif($popularidadAqui >= 70 && $popularidadAqui < 80){
                            echo "<img src='/design/img/social/3yMediaEstrellas.png'";
                        }
                        elseif($popularidadAqui >= 80 && $popularidadAqui < 90){
                            echo "<img src='/design/img/social/4Estrellas.png'";
                        }
                        elseif($popularidadAqui >= 90 && $popularidadAqui < 100){
                            echo "<img src='/design/img/social/4yMediaEstrellas.png'";
                        }
                        elseif($popularidadAqui >= 100){
                            echo "<img src='/design/img/social/5Estrellas.png'";
                        }
                   echo "</div>";
                   echo "<div class='populatidadTexto'>";
                        echo "<h4>" . $popularidadAqui . "%</h4>";
                   echo "</div>";
                    
                echo "</div>";
                echo "</div>";
                echo "</span>"; //FIN Contenedor2
                
            echo "</div>"; //FIN DE div contenido

        echo "</div>"; //FIN DE div moduloZona


