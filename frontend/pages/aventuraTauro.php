<?php
global $db;
        include (__ROOT__.'/backend/comprobaciones.php');
        include (__ROOT__.'/backend/getFotos.php');
        $id = $_SESSION['loggedIn'];
        comprobarZona2Barrio5();
        $estoyLibre = comprobarEspera();
        if($estoyLibre === 1){

            echo "<div id='moduloZona'>";
            echo "<span class = 'tituloSpot'>";
                echo "<h4>" . getNombreSpot(81) . "</h4>";
            echo "</span>";

                echo "<div class='contenido'>";
                echo "<span class='contenedor1'>";

                    echo "<div class='seccionSpotOpciones'>";
                    echo "<div id='botonesComprarVender'>";
                        echo "<button id='botonComprar' class='tagTiendaComprar'>Galerías</button>";
                        echo "<button id='botonVender' class='tagTiendaVender'>Pasaje</button>";
                    echo "</div>";
                    echo "<div class='semiTransparente'>"; 
                    echo "<div id='galerias'>";
                        echo "<div class='textoDependiente'>";
                            echo "\"Las Galerías del Edificio Tauro llevan a un laberinto subterráneo. Quién sabe qué monstruos habrá allí abajo\".";
                        echo "</div>"; //FIN textoDependiente
                        echo "<div class='imagenDependiente'>";
                            echo '<img src="/design/img/dependientes/yoHombre.png">';
                        echo "</div>"; //FIN imagenDependiente
                   
                    
                    echo "<form id = 'selectorOpciones' action='?bPage=aventuras&action=zona&nonUI' method='post'>";
                        echo "<div class='opcionesTienda'>";
                            echo "<div class='opcionesTiendaCheckbox'>";
                                echo '<input type="checkbox" name="cbox1" value="aventuraTauro">';
                            echo "</div>";
                            echo "<div class='opcionesTiendaTitulo'>";
                                echo 'Explorar Galerías';
                            echo "</div>";
                            echo '<label for="cbox3"><div id="opcionBox">' . '<img src="/design/img/entrenamiento/ritmitoGeneroso.png">' . '</div><div class="relojMini"></div><div class="precioTienda">10M</div></label>';
                        echo "</div>";
                        
                        echo "<div class='opcionesTienda'>";
                            echo "<div class='opcionesTiendaCheckbox'>";
                                echo '<input type="checkbox" name="cbox1" value="aventuraTauroDebil">';
                            echo "</div>";
                            echo "<div class='opcionesTiendaTitulo'>";
                                echo 'Cuidar la Entrada';
                            echo "</div>";
                            echo '<label for="cbox3"><div id="opcionBox">' . '<img src="/design/img/entrenamiento/ritmitoGeneroso.png">' . '</div><div class="relojMini"></div><div class="precioTienda">10M</div></label>';
                        echo "</div>";
                        
                        echo "<div class='submitTienda'>";
                            echo "<input type='submit' class='botonAventura' value=' '>";
                        echo "</div>";
                    echo "</form>";    
                    echo "</div>"; //FIN de Galerias
                    
                    echo "<div id='pasaje'>";
                $mostrar = comprobarMision(16);
                    echo "<div class='textoDependiente'>";
                            $progreso = comprobarProgreso(16);
                            if($mostrar === 1){ 
                                $descripcionZona = getDescripcionMision(16, $progreso);
                                echo $descripcionZona;
                                $recompensa = getRecompensaMision(16, $progreso);
                                echo $recompensa; 
                            }
                            elseif($mostrar === 2)
                                echo "¡Puff cómo huele a cerrao! Ojalá alguien valiente para bajar a hacer limpieza.";
                            else{
                                echo "A estas horas no pasan por aquí ni las águilas.";
                            }
                        echo "</div>"; //FIN textoDependiente
                        echo "<div class='imagenDependiente'>";
                            if($mostrar === 1 || $mostrar === 2){
                                echo '<img src="/design/img/dependientes/fogataRitual.png">';
                            }
                            else{ 
                                echo '<img src="/design/img/dependientes/yoHombre.png">';
                            }
                        echo "</div>"; //FIN imagenDependiente
                        
                        if($mostrar === 2){
                        
                        echo '<form id = "selectorOpciones" action="?bPage=actualizaciones&action=accionSpot&nonUI" method="post">';

                        echo "<div class='opcionesTienda'>";
                            echo "<div class='opcionesTiendaCheckbox'>";
                                echo '<input type="checkbox" name="cbox1" value="misionCerrao">';
                            echo "</div>";
                            echo "<div class='opcionesTiendaTitulo'>";
                                echo '¡Misión Cerrao!';
                            echo "</div>";
                            echo '<label for="cbox3"><div id="opcionBox">' . '<img src="/design/img/bar/cafeConLeche">' . '</div><div class="monedaTienda"></div><div class="precioTienda">1 Etapa</div></label>';
                        echo "</div>";

                            echo "<div class='submitTienda'>";
                                echo'<input type="submit" class="botonMision" value=" ">';
                            echo "</div>";
                        echo "</form>"; 
                        }
                        
                        elseif($mostrar === 1){
                        
                        echo '<form id = "selectorOpciones" action="?bPage=actualizaciones&action=accionSpot&nonUI" method="post">';

                        echo "<div class='opcionesTienda'>";
                            echo "<div class='opcionesTiendaCheckbox'>";
                                echo '<input type="checkbox" name="cbox1" value="misionCerrao">';
                            echo "</div>";
                            echo "<div class='opcionesTiendaTitulo'>";
                                echo '¡Misión Cerrao!';
                            echo "</div>";
                            echo '<label for="cbox3"><div id="opcionBox">' . '<img src="/design/img/bar/cafeConLeche">' . '</div><div class="monedaTienda"></div><div class="precioTienda">+3000</div></label>';
                        echo "</div>";

                            echo "<div class='submitTienda'>";
                                echo'<input type="submit" class="botonMision" value=" ">';
                            echo "</div>";
                        echo "</form>"; 
                        }
                
                echo "</div>"; //Fin de pasaje
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
                            
                            if (valor === 'aventuraTauro') {
                                $(".opcionSpot1").show();
                                $(".opcionSpot2").hide();
                                $(".opcionSpot0").hide();
                            }
                            else if (valor === 'aventuraTauroDebil'){
                                $(".opcionSpot2").show();
                                $(".opcionSpot1").hide();
                                $(".opcionSpot0").hide();
                            }
                        });
                        
                        $("#botonVender").click(function(){
                        $("#galerias").hide();
                        $("#pasaje").show();
                        $("#botonVender").css("background-color", "rgba(255, 249, 192, 0.7)");
                        $("#botonComprar").css("background-color", "white");
                    });

                      $("#botonComprar").click(function(){
                        $("#galerias").show();
                        $("#pasaje").hide();
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
                                        $spotImagen = getFotoSpot(81);
                                        echo $spotImagen;
                                    echo "</div>";
                                echo "</div>";
                               
                            echo "</div>"; //FIN opcionSpot0
                        
                            echo "<div class='opcionSpot1 opcionSpot'>";
                                echo "<div class='seccionDescripcionZonaImagen'>";
                                    $imagenSpot = "<img src='/design/img/entrenamiento/carrilBici1.png'>";
                                    echo $imagenSpot;
                                echo "</div>";
                                echo "<div class='seccionDescripcionZonaTexto'>";
                           
                                    echo "<span class='textoDescripcionSpot'>";
                                        echo "<div class='semiTransparente' style='border-radius: 0px 0px 10px 10px'>";
                                            $descripcionZona = "Descender hasta las zonas más profundas y misteriosas de las Galerías del Edificio Tauro.";
                                            echo $descripcionZona;
                                        echo "</div>";
                                    echo "</span>";
                                echo "</div>"; //Fin seccionDescripcionZonaTexto
                            echo "</div>"; //FIN opcionSpot1
                            
                            echo "<div class='opcionSpot2 opcionSpot'>";
                                echo "<div class='seccionDescripcionZonaImagen'>";
                                    $imagenSpot = "<img src='/design/img/entrenamiento/carrilBici2.png'>";
                                    echo $imagenSpot;
                                echo "</div>";
                                echo "<div class='seccionDescripcionZonaTexto'>";
                        
                                    echo "<span class='textoDescripcionSpot'>";
                                        echo "<div class='semiTransparente' style='border-radius: 0px 0px 10px 10px'>";
                                            $descripcionZona = "Cuidar de la puerta de entrada. Aquí a veces suben monstruos, pero ni por asomo son tan peligrosos como los de allí abajo.";
                                            echo $descripcionZona;
                                        echo "</div>";
                                    echo "</span>";
                                echo "</div>"; //Fin descripcionZonaTexto
                            echo "</div>"; //FIN opcionSpot2
                       
                    echo "</span>"; //FIN de contenedor2


                echo "</div>"; //FIN DE div contenido

            echo "</div>"; //FIN DE div moduloZona

        }
        else{
            header("location: ?page=zona&nonUI&message=Aun no he descansado de mi última acción");
        }