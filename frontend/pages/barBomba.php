<?php
global $db;
        include (__ROOT__.'/backend/comprobaciones.php');
        include (__ROOT__.'/backend/getFotos.php');
        $id = $_SESSION['loggedIn'];
        $miDinero = comprobarDinero();
        $dineroEnCash = $miDinero[0]['cash'];
        comprobarZona1Barrio2();
        $estoyLibre = comprobarEspera();
        if($estoyLibre === 1){
        
        echo "<div id='moduloZona'>";
            echo "<span class = 'tituloSpot'>";
                echo "<h4>" . getNombreSpot(23) . "</h4>";
            echo "</span>";
            
            echo "<div class='contenido'>";
                echo "<span class='contenedor1'>"; 
                
                    echo "<div class='seccionSpotOpciones'>";
                    echo "<div id='botonesComprarVender'>";
                        echo "<button id='botonComprar' class='tagTiendaComprar'>Salón</button>";
                        echo "<button id='botonVender' class='tagTiendaVender'>Cocina</button>";
                    echo "</div>";
                    echo "<div class='semiTransparente'>"; 
                    echo "<div id='salon'>";
                        echo "<div class='textoDependiente'>";
                            echo "\"Llevo viniendo a comer aquí desde mi bautizo por lo menos\".";
                        echo "</div>"; //FIN textoDependiente
                        echo "<div class='imagenDependiente'>";
                            echo '<img src="/design/img/dependientes/yoHombre.png">';
                        echo "</div>"; //FIN imagenDependiente
                        
                    
                    echo '<form id = "selectorOpciones" action="?bPage=actualizaciones&action=accionSpot&nonUI" method="post">';
                    echo "<div class='opcionesTienda'>";
                        echo "<div class='opcionesTiendaCheckbox'>";
                            echo '<input type="checkbox" name="cbox1" value="roscaChurros">';
                        echo "</div>";
                        echo "<div class='opcionesTiendaTitulo'>";
                            echo 'Rosca de Churros';
                        echo "</div>";
                        echo '<label for="cbox3"><div id="opcionBox">' . '<img src="/design/img/bar/cafeConLeche">' . '</div><div class="monedaTienda"></div><div class="precioTienda">25</div><div class="corazonTienda"></div><div class="vidaTienda">+3</div></label>';
                    echo "</div>";
                    
                    echo "<div class='opcionesTienda'>";
                        echo "<div class='opcionesTiendaCheckbox'>";
                            echo '<input type="checkbox" name="cbox1" value="migasManchegas">';
                        echo "</div>";
                        echo "<div class='opcionesTiendaTitulo'>";
                            echo 'Migas Manchegas';
                        echo "</div>";
                        echo '<label for="cbox3"><div id="opcionBox">' . '<img src="/design/img/bar/cafeIrlandes">' . '</div><div class="monedaTienda"></div><div class="precioTienda">25</div><div class="corazonTienda"></div><div class="vidaTienda">+3</div></label>';
                    echo "</div>";
                    
                    echo "<div class='opcionesTienda'>";
                        echo "<div class='opcionesTiendaCheckbox'>";
                            echo '<input type="checkbox" name="cbox1" value="bombaRellena">';
                        echo "</div>";
                        echo "<div class='opcionesTiendaTitulo'>";
                            echo 'Bomba Rellena';
                        echo "</div>";
                        echo '<label for="cbox3"><div id="opcionBox">' . '<img src="/design/img/bar/cafeIrlandes">' . '</div><div class="monedaTienda"></div><div class="precioTienda">25</div><div class="corazonTienda"></div><div class="vidaTienda">+3</div></label>';
                    echo "</div>";
                       
                        echo "<div class='submitTienda'>";
                            echo'<input type="submit" class="botonTiendaComprar" value=" "><br><br>';
                        echo "</div>";
                        echo " Llevo " . $dineroEnCash . " <img src='/design/img/iconos/monedaTop.png' style='vertical-align: bottom'>" . " en el bolsillo.";
                    echo "</form>";      
                echo "</div>"; //FIN terraza
                
                echo "<div id='trastienda'>";
                $mostrar = comprobarMision(6);
                    echo "<div class='textoDependiente'>";
                            
                            if($mostrar === 1){ //Está activada y en progreso
                                $descripcionZona = getDescripcionMision(6, 1);
                                echo $descripcionZona;
                                $recompensa = getRecompensaMision(6, 1);
                                echo $recompensa; 
                            }
                            elseif($mostrar === 2){ //La mision aun no esta activada
                                echo "\"Nos la robarooon, la quereeemos, la necesitaaamos\".";
                            }
                            else{ //L mision ya esta completada
                                echo "¡Huele bien a comida! pero no hay nada de interés ahora mismo";
                            }
                        echo "</div>"; //FIN textoDependiente
                        echo "<div class='imagenDependiente'>";
                            if($mostrar === 0){ //Está completada
                                echo '<img src="/design/img/dependientes/yoHombre.png">';
                            }
                            else{ //No está activada o está activad pero en progreso
                                echo '<img src="/design/img/dependientes/fogataRitual.png">';
                            }
                        echo "</div>"; //FIN imagenDependiente
                        
                    if($mostrar === 1 || $mostrar === 2){
                        echo '<form id = "selectorOpciones" action="?bPage=actualizaciones&action=accionSpot&nonUI" method="post">';

                        echo "<div class='opcionesTienda'>";
                            echo "<div class='opcionesTiendaCheckbox'>";
                                echo '<input type="checkbox" name="cbox1" value="misionBomba">';
                            echo "</div>";
                            echo "<div class='opcionesTiendaTitulo'>";
                                echo '¡Misión Tesoro!';
                            echo "</div>";
                            echo '<label for="cbox3"><div id="opcionBox">' . '<img src="/design/img/bar/cafeConLeche">' . '</div><div class="monedaTienda"></div><div class="precioTienda">1 Etapa</div></label>';
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
                        $("#salon").hide();
                        $("#trastienda").show();
                        $("#botonVender").css("background-color", "rgba(255, 249, 192, 0.7)");
                        $("#botonComprar").css("background-color", "white");
                    });

                      $("#botonComprar").click(function(){
                        $("#salon").show();
                        $("#trastienda").hide();
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
                        $fechaInsignia = comprobarInsignia(3);
                        if ($fechaInsignia != '0'){
                            $fotoInsignia = getFotoInsignia(3);
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
                          /*  echo "<form action='?bPage=comprobaciones&action=activarCodigo' method='post'>";
                                echo "Introduce el código: <input type='text' name='codigoInsignia'><br>";
                                echo "<input type='submit'>";
                            echo "</form>";*/
                        }
                    echo "</div>";
                echo "</div>";
                
                echo "</span>"; //FIN Contenedor2
                
            echo "</div>"; //FIN DE div contenido

        echo "</div>"; //FIN DE div moduloZona
        }
        else{
            header("location: ?page=zona&nonUI&message=Aun no he descansado de mi última acción");
        }
        
        
