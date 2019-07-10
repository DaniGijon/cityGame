<?php
global $db;
        include (__ROOT__.'/backend/comprobaciones.php');
        include (__ROOT__.'/backend/getFotos.php');
        $id = $_SESSION['loggedIn'];
        comprobarZona1Barrio10();
        
        echo "<div id='moduloZona'>";
            echo "<span class = 'tituloSpot'>";
                echo "<h4>" . getNombreSpot(180) . "</h4>";
            echo "</span>";
            
            echo "<div class='contenido'>";
                echo "<span class='contenedor1'>"; 
                
                    echo "<div class='seccionSpotOpciones'>";
                    echo "<div id='botonesComprarVender'>";
                        echo "<button id='botonComprar' class='tagTiendaComprar'>Terraza</button>";
                        echo "<button id='botonVender' class='tagTiendaVender'>Escenario</button>";
                    echo "</div>";
                    echo "<div class='semiTransparente'>"; 
                    echo "<div id='terraza'>";
                        echo "<div class='textoDependiente'>";
                            echo "\"Una terraza exclusiva donde cenaré lo que mi billetera mande\".";
                        echo "</div>"; //FIN textoDependiente
                        echo "<div class='imagenDependiente'>";
                            echo '<img src="/design/img/dependientes/yoHombre.png">';
                        echo "</div>"; //FIN imagenDependiente
                        
                    
                    echo '<form id = "selectorOpciones" action="?bPage=actualizaciones&action=accionSpot&nonUI" method="post">';
                    echo "<div class='opcionesTienda'>";
                        echo "<div class='opcionesTiendaCheckbox'>";
                            echo '<input type="checkbox" name="cbox1" value="quesoMundo">';
                        echo "</div>";
                        echo "<div class='opcionesTiendaTitulo'>";
                            echo 'Quesos del Mundo';
                        echo "</div>";
                        echo '<label for="cbox3"><div id="opcionBox">' . '<img src="/design/img/bar/cafeConLeche">' . '</div><div class="monedaTienda"></div><div class="precioTienda">25</div><div class="corazonTienda"></div><div class="vidaTienda">+3</div></label>';
                    echo "</div>";
                    
                    echo "<div class='opcionesTienda'>";
                        echo "<div class='opcionesTiendaCheckbox'>";
                            echo '<input type="checkbox" name="cbox1" value="cocktailFrío">';
                        echo "</div>";
                        echo "<div class='opcionesTiendaTitulo'>";
                            echo 'Cocktail bien frío';
                        echo "</div>";
                        echo '<label for="cbox3"><div id="opcionBox">' . '<img src="/design/img/bar/cafeIrlandes">' . '</div><div class="monedaTienda"></div><div class="precioTienda">25</div><div class="corazonTienda"></div><div class="vidaTienda">+3</div></label>';
                    echo "</div>";
                    
                    echo "<div class='opcionesTienda'>";
                        echo "<div class='opcionesTiendaCheckbox'>";
                            echo '<input type="checkbox" name="cbox1" value="champagne">';
                        echo "</div>";
                        echo "<div class='opcionesTiendaTitulo'>";
                            echo 'Botella de Champagne';
                        echo "</div>";
                        echo '<label for="cbox3"><div id="opcionBox">' . '<img src="/design/img/bar/cafeIrlandes">' . '</div><div class="monedaTienda"></div><div class="precioTienda">25</div><div class="corazonTienda"></div><div class="vidaTienda">+3</div></label>';
                    echo "</div>";
                       
                        echo "<div class='submitTienda'>";
                            echo'<input type="submit" class="botonTiendaComprar" value=" ">';
                        echo "</div>";
                        $miDinero = comprobarDinero();
                                $dineroEnCash = $miDinero[0]['cash'];
                                echo "<br>Llevo " . $dineroEnCash . " <img src='/design/img/iconos/monedaTop.png' style='vertical-align: bottom'>" . " en el bolsillo.";

                    echo "</form>";      
                echo "</div>"; //FIN terraza
                
                echo "<div id='escenario'>";
                $mostrar = comprobarMision(14);
                $progreso = comprobarProgreso(14);
                    echo "<div class='textoDependiente'>";
                            if($mostrar === 1){ //Está activada y en progreso
                                $descripcionZona = getDescripcionMision(14, $progreso);
                                echo $descripcionZona;
                                $recompensa = getRecompensaMision(14, $progreso);
                                echo $recompensa; 
                            }
                            elseif($mostrar === 2){ //La mision aun no esta activada
                                echo "\"Para este truco necesitaré voluntarios. ¿Alguien con buen fajo de billetes entre el público?\"";
                            }
                            else{ //L mision ya esta completada
                                echo "El mago acaba de salir corriendo. Sus trucos estaban siendo bochornosos.";
                            }
                        echo "</div>"; //FIN textoDependiente
                        echo "<div class='imagenDependiente'>";
                            if($mostrar === 0){ //Está completada
                                echo '<img src="/design/img/dependientes/yoHombre.png">';
                            }
                            else{ //No está activada o está activad pero en progreso
                                echo '<img src="/design/img/dependientes/mago.png">';
                            }
                        echo "</div>"; //FIN imagenDependiente
                        
                    if($mostrar === 1 || $mostrar === 2){
                        echo '<form id = "selectorOpciones" action="?bPage=actualizaciones&action=accionSpot&nonUI" method="post">';

                        echo "<div class='opcionesTienda'>";
                            echo "<div class='opcionesTiendaCheckbox'>";
                                echo '<input type="checkbox" name="cbox1" value="misionMagia">';
                            echo "</div>";
                            echo "<div class='opcionesTiendaTitulo'>";
                                echo '¡Misión Magia!';
                            echo "</div>";
                            if($mostrar === 1)
                                echo '<label for="cbox3"><div id="opcionBox">' . '<img src="/design/img/bar/cafeConLeche">' . '</div><div class="relojMini"></div><div class="precioTienda">1H</div></label>';
                            else 
                                echo '<label for="cbox3"><div id="opcionBox">' . '<img src="/design/img/bar/cafeConLeche">' . '</div><div class="relojMini"></div><div class="precioTienda">1 Etapa</div></label>';
                              
                           
                        echo "</div>";

                            echo "<div class='submitTienda'>";
                                echo'<input type="submit" class="botonMision" value=" ">';
                            echo "</div>";
                        echo "</form>";  
                    }
                
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
                    
                    $("#botonVender").click(function(){
                        $("#terraza").hide();
                        $("#escenario").show();
                        $("#botonVender").css("background-color", "rgba(255, 249, 192, 0.7)");
                        $("#botonComprar").css("background-color", "white");
                    });

                      $("#botonComprar").click(function(){
                        $("#terraza").show();
                        $("#escenario").hide();
                        $("#botonComprar").css("background-color", "rgba(255, 249, 192, 0.7)");
                        $("#botonVender").css("background-color", "white");
                    });
                </script>

                <?php
                 echo "</div>"; //fin de semiTransparente   
                echo "</div>"; //FIN DE div seccionSpotOpciones
                
            echo "</span>"; //FIN Contenedor1
                
            echo "<span class='contenedor2'>";
            echo "<div class='seccionSpotInfo'>";
                    echo "<div class = 'seccionContacto'>";
                        echo "<div class = 'mapaCallejero'>";
                            echo "<iframe width='300' height='225' frameborder='0' scrolling='no' marginheight='0' marginwidth='0' src='https://www.openstreetmap.org/export/embed.html?bbox=-4.115452766418458%2C38.67803066731481%2C-4.1016554832458505%2C38.683885029177475&amp;layer=mapnik&amp;marker=38.680965031981174%2C-4.108549833690631' style='border: 1px solid black'></iframe><br/><br>";    
                        echo "</div>";
                        echo "<div class = 'infoSpot'>";
                            echo "<table border = '0' style = 'text-align:left'>";
                                echo "<tr>";
                                    echo "<td><div class='mapaMini'></div> C/Asdrúbal, 36<br></td>";
                                echo "</tr>";
                                echo "<tr>";
                                echo "<td><div class='telefonoMini'></div>  926 42 53 13<br></td>";
                                echo "</tr>";
                                echo "<tr>";
                                echo "<td><div class='relojMini'></div> ??????</td>";
                                echo "</tr>";
                            echo "</table>";
                        echo "</div>";
                    echo "</div>";
                    
                    echo "<div class = 'seccionInsignia'>";
                        $fechaInsignia = comprobarInsignia(180);
                        if ($fechaInsignia != '0'){
                            $fotoInsignia = getFotoInsignia(180);
                            echo "<div class='fotoInsignia'>";
                                echo $fotoInsignia . "<br>";
                            echo "</div>";
                            echo "<span class='textoInsignia'>";
                                echo "Nos visitaste el día: <b>" . date( 'd/m/Y',strtotime($fechaInsignia)) . "</b><br>¡Gracias por venir!";
                            echo "</span>";
                        }
                        else{
                            echo "<div class='fotoInsignia'>";
                                echo "<img src='/design/img/insignias/insigniaVacia'><br>";
                            echo "</div>";
                            echo "<div class='textoInsignia'>";
                                echo "Visítanos y pide al dependiente tu Código de Activación";
                            echo "</div>";
                          
                        }
                    echo "</div>";
                echo "</div>";
                
                echo "</span>"; //FIN Contenedor2
                
            echo "</div>"; //FIN DE div contenido

        echo "</div>"; //FIN DE div moduloZona
        
        
