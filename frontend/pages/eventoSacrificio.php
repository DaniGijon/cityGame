<?php
global $db;
        include (__ROOT__.'/backend/comprobaciones.php');
        include (__ROOT__.'/backend/getFotos.php');
        $id = $_SESSION['loggedIn'];
        comprobarZona2Barrio2();
        $estoyLibre = comprobarEspera();
        if($estoyLibre === 1){

            echo "<div id='moduloZona'>";
            echo "<span class = 'tituloSpot'>";
                echo "<h4>" . getNombreSpot(39) . "</h4>";
            echo "</span>";

                echo "<div class='contenido'>";
                echo "<span class='contenedor1'>";

                    echo "<div class='seccionSpotOpciones'>";
                     echo "<div class='semiTransparente'>"; 
                        echo "<div class='textoDependiente'>";
                            echo "\"Esta noche oficiamos Sacrificios. Y Barra Libre de 23h a 05h\".";
                        echo "</div>"; //FIN textoDependiente
                        echo "<div class='imagenDependiente'>";
                            echo '<img src="/design/img/dependientes/fogataRitual.png">';
                        echo "</div>"; //FIN imagenDependiente
                    
                    echo "<form id = 'selectorOpciones' action='?bPage=actualizaciones&action=accionSpot&nonUI' method='post'>";
                        echo "<div class='opcionesTienda'>";
                            echo "<div class='opcionesTiendaCheckbox'>";
                                echo '<input type="checkbox" name="cbox1" value="sacrificio">';
                            echo "</div>";
                            echo "<div class='opcionesTiendaTitulo'>";
                                echo 'Darme en Sacrificio';
                            echo "</div>";
                            echo '<label for="cbox3"><div id="opcionBox">' . '<img src="/design/img/entrenamiento/ritmitoGeneroso.png">' . '</div><div class="corazonTienda"></div><div class="precioTienda">↓</div><div class="energiaTienda"></div><div class="vidaTienda">+20</div></label>';
                        echo "</div>";
                        
                        echo "<div class='opcionesTienda'>";
                            echo "<div class='opcionesTiendaCheckbox'>";
                                echo '<input type="checkbox" name="cbox1" value="barraLibre">';
                            echo "</div>";
                            echo "<div class='opcionesTiendaTitulo'>";
                                echo 'Barra Libre de Copas';
                            echo "</div>";
                            echo '<label for="cbox3"><div id="opcionBox">' . '<img src="/design/img/entrenamiento/ritmitoGeneroso.png">' . '</div><div class="corazonTienda"></div><div class="precioTienda">↓↓</div><div class="energiaTienda"></div><div class="vidaTienda">+50</div></label>';
                        echo "</div>";
                        
                        //Esta solo la muestro si no he comenzado la mision o si la tengo comenzada pero no completada
                        $mostrar = comprobarMision(1);
                        if ($mostrar === 1){
                            echo "<div class='opcionesTienda'>";
                                echo "<div class='opcionesTiendaCheckbox'>";
                                    echo '<input type="checkbox" name="cbox1" value="misionMaimonides">';
                                echo "</div>";
                                echo "<div class='opcionesTiendaTitulo'>";
                                    echo 'Hablar con Mendigo';
                                echo "</div>";
                                echo '<label for="cbox3"><div id="opcionBox">' . '<img src="/design/img/entrenamiento/ritmitoGeneroso.png">' . '</div><div class="monedaTienda"></div><div class="precioTienda">3 etapas</div></label>';
                            echo "</div>";
                        }
                        
                        
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
                            
                            if (valor === 'sacrificio') {
                                $(".opcionSpot1").show();
                                $(".opcionSpot2").hide();
                                $(".opcionSpot3").hide();
                                $(".opcionSpot0").hide();
                            }
                            else if (valor === 'barraLibre'){
                                $(".opcionSpot2").show();
                                $(".opcionSpot1").hide();
                                $(".opcionSpot3").hide();
                                $(".opcionSpot0").hide();
                                
                            }
                            else if (valor === 'misionMaimonides'){
                                $(".opcionSpot3").show();
                                $(".opcionSpot1").hide();
                                $(".opcionSpot2").hide();
                                $(".opcionSpot0").hide();
                            }
                        });
                        
                        
                    </script>

                    <?php
                    echo "</div>"; //FIN DE semiTransparente
                    echo "</div>"; //FIN DE div seccionSpotOpciones
                    echo "</span>"; //Fin de Contenedor1
                    
                    echo "<span class='contenedor2'>";
                             echo "<div class='opcionSpot0 opcionSpot' style='display: inline'>";
                                echo "<div class='seccionDescripcionZonaImagen'>";
                                    echo "<div class='seccionSpotImagen'>" ;
                                        $spotImagen = getFotoSpot(169);
                                        echo $spotImagen;
                                    echo "</div>";
                                echo "</div>";
                               
                            echo "</div>"; //FIN opcionSpot0
                        
                            echo "<div class='opcionSpot1 opcionSpot'>";
                                echo "<div class='seccionDescripcionZonaImagen'>";
                                    $imagenSpot = "<img src='/design/img/especial/ritual.png'>";
                                    echo $imagenSpot;
                                echo "</div>";
                                echo "<div class='seccionDescripcionZonaTexto'>";
                                    echo "<div class='semiTransparente' style='border-radius: 0px 0px 10px 10px'>";
                                        echo "<span class='textoDescripcionSpot'>";
                                            $descripcionZona = "\"Si lo miras bien, es como una sesión de acupuntura\".";
                                            echo $descripcionZona;
                                        echo "</span>";
                                    echo "</div>"; //Fin semiTransparente
                                echo "</div>"; //Fin seccionDescripcionZonaTexto
                            echo "</div>"; //FIN opcionSpot1
                            
                            echo "<div class='opcionSpot2 opcionSpot'>";
                                echo "<div class='seccionDescripcionZonaImagen'>";
                                    $imagenSpot = "<img src='/design/img/especial/tragoVino.png'>";
                                    echo $imagenSpot;
                                echo "</div>";
                                echo "<div class='seccionDescripcionZonaTexto'>";
                                    echo "<div class='semiTransparente' style='border-radius: 0px 0px 10px 10px'>";
                                        echo "<span class='textoDescripcionSpot'>";
                                            $descripcionZona = "\"Voy a beber hasta el agua de los floreros\".";
                                            echo $descripcionZona;
                                        echo "</span>";
                                     echo "</div>"; //Fin de semiTransparente
                                echo "</div>"; //Fin descripcionZonaTexto
                            echo "</div>"; //FIN opcionSpot2
                            
                             echo "<div class='opcionSpot3 opcionSpot'>";
                                $progreso = comprobarProgreso(1);
                                if($progreso >= 1 && $progreso <=3){
                                    echo "<div class='seccionDescripcionZonaImagen'>";
                                    $imagenSpot = "<img src='/design/img/especial/guarroAsao.png'>";
                                    echo $imagenSpot;
                                echo "</div>";
                                echo "<div class='seccionDescripcionZonaTexto'>";
                                    echo "<div class='semiTransparente' style='border-radius: 0px 0px 10px 10px'>";
                                        echo "<span class='textoDescripcionSpot'>";
                                            $descripcionZona = getDescripcionMision(1, $progreso);
                                            echo $descripcionZona;
                                            $recompensa = getRecompensaMision(1, $progreso);
                                            echo $recompensa;
                                        echo "</span>";
                                    echo "</div>"; //Fin de semiTransparente
                                echo "</div>"; //Fin descripcionZonaTexto
                                }
                                
                            echo "</div>"; //FIN opcionSpot3
                       
                    echo "</span>"; //FIN de contenedor2


                echo "</div>"; //FIN DE div contenido

            echo "</div>"; //FIN DE div moduloZona

        }
        else{
            header("location: ?page=zona&nonUI&message=Aun no he descansado de mi última acción");
        }