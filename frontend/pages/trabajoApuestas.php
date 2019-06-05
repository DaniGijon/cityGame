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
                echo "<h4>" . getNombreSpot(0) . "</h4>";
            echo "</span>";

                echo "<div class='contenido'>";
                echo "<span class='contenedor1'>";

                    echo "<div class='seccionSpotOpciones'>";
                    echo "<div class='semiTransparente'>";
                        echo "<div id='comprar'>";
                            echo '<form id = "selectorOpciones" action="?bPage=actualizaciones&action=accionSpot&nonUI" method="post">';
                            echo "<div class='textoDependiente'>";
                                echo "\"Ofrezcamos una diversión extra a los espectadores que vienen a pasar un día en las carreras.\"";
                            echo "</div>";
                            echo "<div class='imagenDependiente'>";
                                echo '<img src="/design/img/dependientes/yoHombre.png">';
                            echo "</div>"; //FIN imagenDependiente
                   
                    
                    echo "<form id = 'selectorOpciones' action='?bPage=actualizaciones&action=accionSpot&nonUI' method='post'>";
                            echo "<div class='opcionesTienda'>";
                                echo "<div class='opcionesTiendaCheckbox'>";
                                    echo '<input type="checkbox" name="cbox1" value="qualy">';
                                echo "</div>";
                                echo "<div class='opcionesTiendaTitulo'>";
                                    echo 'Qualy';
                                echo "</div>";
                                echo '<label for="cbox3"><div id="opcionBox">' . '<img src="/design/img/entrenamiento/ritmitoGeneroso.png">' . '</div><div class="relojMini"></div><div class="precioTienda">15M</div></label>';
                            echo "</div>"; 
                            
                            echo "<div class='opcionesTienda'>";
                                echo "<div class='opcionesTiendaCheckbox'>";
                                    echo '<input type="checkbox" name="cbox1" value="carrera">';
                                echo "</div>";
                                echo "<div class='opcionesTiendaTitulo'>";
                                    echo 'Carrera';
                                echo "</div>";
                                echo '<label for="cbox3"><div id="opcionBox">' . '<img src="/design/img/entrenamiento/ritmitoGeneroso.png">' . '</div><div class="relojMini"></div><div class="precioTienda">30M</div></label>';
                            echo "</div>"; 
                            
                            echo "<div class='opcionesTienda'>";
                                echo "<div class='opcionesTiendaCheckbox'>";
                                    echo '<input type="checkbox" name="cbox1" value="series">';
                                echo "</div>";
                                echo "<div class='opcionesTiendaTitulo'>";
                                    echo 'Series';
                                echo "</div>";
                                echo '<label for="cbox3"><div id="opcionBox">' . '<img src="/design/img/entrenamiento/ritmitoGeneroso.png">' . '</div><div class="relojMini"></div><div class="precioTienda">1H</div></label>';
                            echo "</div>"; 
                        
                        echo "<div class='submitTienda'>";
                            echo "<input type='submit' class='botonTrabajar' value=' '>";
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
                            
                            if (valor === 'qualy') {
                                $(".opcionSpot1").show();
                                $(".opcionSpot2").hide();
                                $(".opcionSpot3").hide();
                                $(".opcionSpot0").hide();
                            }
                            else if (valor === 'carrera'){
                                $(".opcionSpot2").show();
                                $(".opcionSpot1").hide();
                                $(".opcionSpot3").hide();
                                $(".opcionSpot0").hide();
                            }
                            else if (valor === 'series'){
                                $(".opcionSpot3").show();
                                $(".opcionSpot1").hide();
                                $(".opcionSpot2").hide();
                                $(".opcionSpot0").hide();                                
                            }
                        });
                        
                        
                    </script>

                    <?php
                    echo "</div>";
                    echo "</div>"; //FIN de semiTransparente
                    echo "</div>"; //FIN DE div seccionSpotOpciones
                    echo "</span>"; //Fin de Contenedor1
                    
                    echo "<span class='contenedor2'>";
                            echo "<div class='opcionSpot0 opcionSpot' style='display: inline'>";
                                echo "<div class='seccionDescripcionZonaImagen'>";
                                    echo "<div class='seccionSpotImagen'>" ;
                                        $spotImagen = getFotoSpot(0);
                                        echo $spotImagen;
                                    echo "</div>";
                                echo "</div>";
                            echo "</div>"; //FIN opcionSpot0
                        
                            echo "<div class='opcionSpot1 opcionSpot'>";
                                echo "<div class='seccionDescripcionZonaImagen'>";
                                    $imagenSpot = "<img src='/design/img/trabajo/qualy.png'>";
                                    echo $imagenSpot;
                                echo "</div>";
                                echo "<div class='seccionDescripcionZonaTexto'>";
                                    echo "<div class='semiTransparente'>";
                                    echo "<span class='textoDescripcionSpot'>";
                                        $descripcionZona = "¡Capta rápido apostantes para la Qualy que está a punto de empezar!";
                                        echo $descripcionZona;
                                    echo "</span>";
                                    echo "</div>";
                                echo "</div>"; //Fin seccionDescripcionZonaTexto
                            echo "</div>"; //FIN opcionSpot1
                            
                            echo "<div class='opcionSpot2 opcionSpot'>";
                                echo "<div class='seccionDescripcionZonaImagen'>";
                                    $imagenSpot = "<img src='/design/img/trabajo/carrera.png'>";
                                    echo $imagenSpot;
                                echo "</div>";
                                echo "<div class='seccionDescripcionZonaTexto'>";
                                    echo "<div class='semiTransparente'>";
                                    echo "<span class='textoDescripcionSpot'>";
                                        $descripcionZona = "Coloca apuestas para la próxima carrera que empezará en 30 Minutos";
                                        echo $descripcionZona;
                                    echo "</span>";
                                    echo "</div>";
                                echo "</div>"; //Fin descripcionZonaTexto
                            echo "</div>"; //FIN opcionSpot2
                            
                             echo "<div class='opcionSpot3 opcionSpot'>";
                                echo "<div class='seccionDescripcionZonaImagen'>";
                                    $imagenSpot = "<img src='/design/img/trabajo/series.png'>";
                                    echo $imagenSpot;
                                echo "</div>";
                                echo "<div class='seccionDescripcionZonaTexto'>";
                                    echo "<div class='semiTransparente'>";
                                    echo "<span class='textoDescripcionSpot'>";
                                        $descripcionZona = "¡Cómo controlas! Haz negocio para las próximas series de carreras";
                                        echo $descripcionZona;
                                    echo "</span>";
                                    echo "</div>";
                                echo "</div>"; //Fin descripcionZonaTexto
                            echo "</div>"; //FIN opcionSpot3
                       
                    echo "</span>"; //FIN de contenedor2


                echo "</div>"; //FIN DE div contenido

            echo "</div>"; //FIN DE div moduloZona

        }
        else{
            header("location: ?page=zona&nonUI&message=Aun no he descansado de mi última acción");
        }