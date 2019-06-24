<?php
global $db;
        include (__ROOT__.'/backend/comprobaciones.php');
        include (__ROOT__.'/backend/getFotos.php');
        $id = $_SESSION['loggedIn'];
        comprobarZona1Barrio7();
        $estoyLibre = comprobarEspera();
        if($estoyLibre === 1){

            echo "<div id='moduloZona'>";
            echo "<span class = 'tituloSpot'>";
                echo "<h4>" . getNombreSpot(131) . "</h4>";
            echo "</span>";

                echo "<div class='contenido'>";
                echo "<span class='contenedor1'>";

                    echo "<div class='seccionSpotOpciones'>";
                    echo "<div id='botonesComprarVender'>";
                        echo "<button id='botonComprar' class='tagTiendaComprar'>Obra</button>";
                        echo "<button id='botonVender' class='tagTiendaVender'>Caseta</button>";
                    echo "</div>";
                    echo "<div class='semiTransparente'>";
                        echo "<div id='obra'>";
                            echo "<div class='textoDependiente'>";
                                echo "Primo, ¿tú quieres que yo te vigile esto bien vigilao? No se van a acercar ni los pájaros.";
                            echo "</div>";
                            echo "<div class='imagenDependiente'>";
                                echo '<img src="/design/img/dependientes/yoHombre.png">';
                            echo "</div>"; //FIN imagenDependiente
                   
                    
                    echo "<form id = 'selectorOpciones' action='?bPage=actualizaciones&action=accionSpot&nonUI' method='post'>";
                            echo "<div class='opcionesTienda'>";
                                echo "<div class='opcionesTiendaCheckbox'>";
                                    echo '<input type="checkbox" name="cbox1" value="vigilarRato">';
                                echo "</div>";
                                echo "<div class='opcionesTiendaTitulo'>";
                                    echo 'Vigilar un rato';
                                echo "</div>";
                                echo '<label for="cbox3"><div id="opcionBox">' . '<img src="/design/img/entrenamiento/ritmitoGeneroso.png">' . '</div><div class="relojMini"></div><div class="precioTienda">15M</div></label>';
                            echo "</div>"; 
                            
                            echo "<div class='opcionesTienda'>";
                                echo "<div class='opcionesTiendaCheckbox'>";
                                    echo '<input type="checkbox" name="cbox1" value="vigilarNoche">';
                                echo "</div>";
                                echo "<div class='opcionesTiendaTitulo'>";
                                    echo 'Vigilancia Nocturna';
                                echo "</div>";
                                echo '<label for="cbox3"><div id="opcionBox">' . '<img src="/design/img/entrenamiento/ritmitoGeneroso.png">' . '</div><div class="relojMini"></div><div class="precioTienda">60M</div></label>';
                            echo "</div>";
                        
                        echo "<div class='submitTienda'>";
                            echo "<input type='submit' class='botonTrabajar' value=' '>";
                        echo "</div>";
                    echo "</form>"; 
                echo "</div>"; //fin de div Obra
                
                echo "<div id='caseta'>";
                $mostrar = comprobarMision(15);
                    echo "<div class='textoDependiente'>";
                            if($mostrar === 1){ //Está activada y en progreso en
                                $progreso = comprobarProgreso(15);
                                $descripcionZona = getDescripcionMision(15, $progreso);
                                echo $descripcionZona;
                                $recompensa = getRecompensaMision(15, $progreso);
                                echo $recompensa;
                                
                            }
                            elseif($mostrar === 2){ //La mision aun no esta activada
                                echo "\"To..Todo El Pino respeta a los Mo..Montoya. No puedes venir y hacer lo que te sa..salga de la... ¡Largo!\"";
                            }
                            else{ //L mision ya esta completada
                                echo "Se han ido todos de aqui.";
                            }
                        echo "</div>"; //FIN textoDependiente
                        if(($mostrar === 1 && $progreso === '1') || $mostrar === 2){ //gitanillo chico       
                            echo "<div class='imagenDependiente'>";
                                    echo '<img src="/design/img/dependientes/gitanoObra.png">';
                            echo "</div>"; //FIN imagenDependiente
                        }
                        elseif($mostrar === 1 && $progreso === '2'){ //gitanillo adolescente (primo)      
                            echo "<div class='imagenDependiente'>";
                                    echo '<img src="/design/img/dependientes/gitanoObra2.png">';
                            echo "</div>"; //FIN imagenDependiente
                        }
                        elseif($mostrar === 1 && $progreso === '3'){ //madre gitana       
                            echo "<div class='imagenDependiente'>";
                                    echo '<img src="/design/img/dependientes/gitanoObra3.png">';
                            echo "</div>"; //FIN imagenDependiente
                        }
                        elseif($mostrar === 1 && $progreso === '4'){ //tía mayor gitana     
                            echo "<div class='imagenDependiente'>";
                                    echo '<img src="/design/img/dependientes/gitanoObra4.png">';
                            echo "</div>"; //FIN imagenDependiente
                        }
                        elseif($mostrar === 1 && $progreso === '5'){ //patriarca gitano Montoya     
                            echo "<div class='imagenDependiente'>";
                                    echo '<img src="/design/img/dependientes/gitanoObra5.png">';
                            echo "</div>"; //FIN imagenDependiente
                        }
                        else{
                            echo "<div class='imagenDependiente'>";
                                    echo '<img src="/design/img/dependientes/yoHombre.png">';
                            echo "</div>"; //FIN imagenDependiente
                        }
                        
                    //HAY UNA OPCION QUE ES LA MISION Temor y Respeto
                    echo "<form id = 'selectorOpciones' action='?bPage=actualizaciones&action=accionSpot&nonUI' method='post'>";
                        $mostrar = comprobarMision(15);
                        $progreso = comprobarProgreso(15);
                        if($mostrar === 1 || $mostrar === 2){ //Si no esta activa o está activa pero en progreso
                            echo "<div class='opcionesTienda'>";
                                echo "<div class='opcionesTiendaCheckbox'>";
                                    echo '<input type="checkbox" name="cbox1" value="misionRespeto">';
                                echo "</div>";
                                echo "<div class='opcionesTiendaTitulo'>";
                                    echo '¡Misión Respeto!';
                                echo "</div>";
                                echo '<label for="cbox3"><div id="opcionBox">' . '<img src="/design/img/entrenamiento/ritmitoGeneroso.png">' . '</div><div class="relojMini"></div><div class="precioTienda">4 etapas</div></label>';
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
                            
                            if (valor === 'vigilarRato') {
                                $(".opcionSpot1").show();
                                $(".opcionSpot2").hide();
                                $(".opcionSpot3").hide();
                                $(".opcionSpot0").hide();
                            }
                            else if (valor === 'vigilarNoche'){
                                $(".opcionSpot2").show();
                                $(".opcionSpot1").hide();
                                $(".opcionSpot3").hide();
                                $(".opcionSpot0").hide();
                            }
                        });
                        
                        $("#botonVender").click(function(){
                            $("#obra").hide();
                            $("#caseta").show();
                            $("#botonVender").css("background-color", "rgba(255, 249, 192, 0.7)");
                            $("#botonComprar").css("background-color", "white");
                        });

                      $("#botonComprar").click(function(){
                            $("#obra").show();
                            $("#caseta").hide();
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
                                        $spotImagen = getFotoSpot(131);
                                        echo $spotImagen;
                                    echo "</div>";
                                echo "</div>";
                            echo "</div>"; //FIN opcionSpot0
                        
                            echo "<div class='opcionSpot1 opcionSpot'>";
                                echo "<div class='seccionDescripcionZonaImagen'>";
                                    $imagenSpot = "<img src='/design/img/trabajo/obraRato.png'>";
                                    echo $imagenSpot;
                                echo "</div>";
                                echo "<div class='seccionDescripcionZonaTexto'>";
                                    echo "<div class='semiTransparente'>";
                                    echo "<span class='textoDescripcionSpot'>";
                                        $descripcionZona = "Estaré por aquí un rato, primo.";
                                        echo $descripcionZona;
                                    echo "</span>";
                                    echo "</div>";
                                echo "</div>"; //Fin seccionDescripcionZonaTexto
                            echo "</div>"; //FIN opcionSpot1
                            
                            echo "<div class='opcionSpot2 opcionSpot'>";
                                echo "<div class='seccionDescripcionZonaImagen'>";
                                    $imagenSpot = "<img src='/design/img/trabajo/obraNoche.png'>";
                                    echo $imagenSpot;
                                echo "</div>";
                                echo "<div class='seccionDescripcionZonaTexto'>";
                                    echo "<div class='semiTransparente'>";
                                    echo "<span class='textoDescripcionSpot'>";
                                        $descripcionZona = "De aquí no se cantea nadie en toda la Noche.";
                                        echo $descripcionZona;
                                    echo "</span>";
                                    echo "</div>";
                                echo "</div>"; //Fin descripcionZonaTexto
                            echo "</div>"; //FIN opcionSpot2
                       
                    echo "</span>"; //FIN de contenedor2


                echo "</div>"; //FIN DE div contenido

            echo "</div>"; //FIN DE div moduloZona

        }
        else{
            header("location: ?page=zona&nonUI&message=Aun no he descansado de mi última acción");
        }
