<?php
global $db;
        include (__ROOT__.'/backend/comprobaciones.php');
        include (__ROOT__.'/backend/getFotos.php');
        $id = $_SESSION['loggedIn'];
        comprobarZona2Barrio1();
        $estoyLibre = comprobarEspera();
        if($estoyLibre === 1){

            echo "<div id='moduloZona'>";
            echo "<span class = 'tituloSpot'>";
                echo "<h4>" . getNombreSpot(11) . "</h4>";
            echo "</span>";

                echo "<div class='contenido'>";
                echo "<span class='contenedor1'>";

                    echo "<div class='seccionSpotOpciones'>";
                    echo "<div id='botonesComprarVender'>";
                        echo "<button id='botonComprar' class='tagTiendaComprar'>Criba</button>";
                        echo "<button id='botonVender' class='tagTiendaVender'>Escombrera</button>";
                    echo "</div>";
                    echo "<div class='semiTransparente'>";
                        echo "<div id='criba'>";
                            /*echo '<form id = "selectorOpciones" action="?bPage=actualizaciones&action=accionSpot&nonUI" method="post">';*/
                            echo "<div class='textoDependiente'>";
                                echo "El capataz no paga mucho, pero no tengo dinero ni para imprimir un currículum.";
                            echo "</div>";
                            echo "<div class='imagenDependiente'>";
                                echo '<img src="/design/img/dependientes/yoHombre.png">';
                            echo "</div>"; //FIN imagenDependiente
                   
                    
                    echo "<form id = 'selectorOpciones' action='?bPage=actualizaciones&action=accionSpot&nonUI' method='post'>";
                            echo "<div class='opcionesTienda'>";
                                echo "<div class='opcionesTiendaCheckbox'>";
                                    echo '<input type="checkbox" name="cbox1" value="ratito">';
                                echo "</div>";
                                echo "<div class='opcionesTiendaTitulo'>";
                                    echo 'Cribar un Ratito';
                                echo "</div>";
                                echo '<label for="cbox3"><div id="opcionBox">' . '<img src="/design/img/entrenamiento/ritmitoGeneroso.png">' . '</div><div class="relojMini"></div><div class="precioTienda">15M</div></label>';
                            echo "</div>"; 
                            
                            echo "<div class='opcionesTienda'>";
                                echo "<div class='opcionesTiendaCheckbox'>";
                                    echo '<input type="checkbox" name="cbox1" value="solasol">';
                                echo "</div>";
                                echo "<div class='opcionesTiendaTitulo'>";
                                    echo 'Currar de Sol a Sol';
                                echo "</div>";
                                echo '<label for="cbox3"><div id="opcionBox">' . '<img src="/design/img/entrenamiento/ritmitoGeneroso.png">' . '</div><div class="relojMini"></div><div class="precioTienda">30M</div></label>';
                            echo "</div>";
                        
                        echo "<div class='submitTienda'>";
                            echo "<input type='submit' class='botonTrabajar' value=' '>";
                        echo "</div>";
                    echo "</form>"; 
                echo "</div>"; //fin de div Criba
                
                echo "<div id='escombrera'>";
                $mostrar = comprobarMision(5);
                    echo "<div class='textoDependiente'>";
                            
                            if($mostrar === 1){ //Está activada y en progreso en
                                $progreso = comprobarProgreso(5);
                                
                                if($progreso === '1'){
                                    $descripcionZona = getDescripcionMision(5, $progreso);
                                    echo $descripcionZona;
                                    $recompensa = getRecompensaMision(5, $progreso);
                                    echo $recompensa;
                                }
                                elseif($progreso === '2'){
                                        $descripcionZona = getDescripcionMision(5, $progreso);
                                        echo $descripcionZona;
                                        $recompensa = getRecompensaMision(5, $progreso);
                                        echo $recompensa;
                                }
                                elseif($progreso === '3'){
                                        $descripcionZona = getDescripcionMision(5, $progreso);
                                        echo $descripcionZona;
                                        $recompensa = getRecompensaMision(5, $progreso);
                                        echo $recompensa;
                                }
                                
                            }
                            elseif($mostrar === 2){ //La mision aun no esta activada
                                echo "\"¿Sabes? ¡Hoy viene mi pibita a Puertollano! Vale, no somos novios, pero ojalá un día...\"";
                            }
                            else{ //L mision ya esta completada
                                echo "¡Psst! Cuando todos duerman, vendré a buscar oro por mi cuenta. ¿Te apuntas?";
                            }
                        echo "</div>"; //FIN textoDependiente
                        echo "<div class='imagenDependiente'>";
                                echo '<img src="/design/img/dependientes/fogataRitual.png">';
                        echo "</div>"; //FIN imagenDependiente
                        
                    //HAY UNA OPCION QUE ES LA MISION pico y pala
                    echo "<form id = 'selectorOpciones' action='?bPage=actualizaciones&action=accionSpot&nonUI' method='post'>";
                        $mostrar = comprobarMision(5);
                        $progreso = comprobarProgreso(5);
                        if($mostrar === 1 || $mostrar === 2){ //Si no esta activa o está activa pero en progreso
                            echo "<div class='opcionesTienda'>";
                                echo "<div class='opcionesTiendaCheckbox'>";
                                    echo '<input type="checkbox" name="cbox1" value="misionTerri">';
                                echo "</div>";
                                echo "<div class='opcionesTiendaTitulo'>";
                                    echo '¡Misión Pico y Pala!';
                                echo "</div>";
                                echo '<label for="cbox3"><div id="opcionBox">' . '<img src="/design/img/entrenamiento/ritmitoGeneroso.png">' . '</div><div class="relojMini"></div><div class="precioTienda">3 etapas</div></label>';
                            echo "</div>"; 
                        }
                        else{ //Una vez completada la misión, habrá otra opcion de rebuscar objetos
                            echo "<div class='opcionesTienda'>";
                                echo "<div class='opcionesTiendaCheckbox'>";
                                    echo '<input type="checkbox" name="cbox1" value="escombrera">';
                                echo "</div>";
                                echo "<div class='opcionesTiendaTitulo'>";
                                    echo 'Rebuscar Oro';
                                echo "</div>";
                                echo '<label for="cbox3"><div id="opcionBox">' . '<img src="/design/img/entrenamiento/ritmitoGeneroso.png">' . '</div><div class="relojMini"></div><div class="precioTienda">10M</div></label>';
                            echo "</div>"; 
                        }
                        echo "<div class='submitTienda'>";
                            echo "<input type='submit' class='botonMision' value=' '>";
                        echo "</div>";
                    echo "</form>";
                
                echo "</div>";
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
                        });
                        
                        $("#botonVender").click(function(){
                            $("#criba").hide();
                            $("#escombrera").show();
                            $("#botonVender").css("background-color", "rgba(255, 249, 192, 0.7)");
                            $("#botonComprar").css("background-color", "white");
                        });

                      $("#botonComprar").click(function(){
                            $("#criba").show();
                            $("#escombrera").hide();
                            $("#botonComprar").css("background-color", "rgba(255, 249, 192, 0.7)");
                            $("#botonVender").css("background-color", "white");
                        });
                        
                        
                    </script>

                    <?php
                    echo "</div>"; //FIN de semiTransparente
                    echo "</div>"; //FIN DE div seccionSpotOpciones
                    echo "</span>"; //Fin de Contenedor1
                    
                    echo "<span class='contenedor2'>";
                            echo "<div class='opcionSpot0 opcionSpot' style='display: inline'>";
                                echo "<div class='seccionDescripcionZonaImagen'>";
                                    echo "<div class='seccionSpotImagen'>" ;
                                        $spotImagen = getFotoSpot(11);
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