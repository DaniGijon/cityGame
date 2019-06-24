<?php
global $db;
        include (__ROOT__.'/backend/comprobaciones.php');
        include (__ROOT__.'/backend/getFotos.php');
        $id = $_SESSION['loggedIn'];
        comprobarZona1Barrio8();
        $estoyLibre = comprobarEspera();
        if($estoyLibre === 1){
        
        echo "<div id='moduloZona'>";
            echo "<span class = 'tituloSpot'>";
                echo "<h4>" . getNombreSpot(140) . "</h4>";
            echo "</span>";
            
            echo "<div class='contenido'>";
                echo "<span class='contenedor1'>"; 
                
                    echo "<div class='seccionSpotOpciones'>";
                    echo "<div id='botonesComprarVender'>";
                        echo "<button id='botonComprar' class='tagTiendaComprar'>Barra</button>";
                        echo "<button id='botonVender' class='tagTiendaVender'>Mesa</button>";
                    echo "</div>";
                    echo "<div class='semiTransparente'>"; 
                    echo "<div id='barra'>";
                        echo "<div class='textoDependiente'>";
                            echo "\"¿Te pongo chocolate? ¿Cuántos gramos?\".";
                        echo "</div>"; //FIN textoDependiente
                        echo "<div class='imagenDependiente'>";
                            echo '<img src="/design/img/dependientes/fogataRitual.png">';
                        echo "</div>"; //FIN imagenDependiente
                        
                    
                    echo '<form id = "selectorOpciones" action="?bPage=actualizaciones&action=accionSpot&nonUI" method="post">';
                    echo "<div class='opcionesTienda'>";
                        echo "<div class='opcionesTiendaCheckbox'>";
                            echo '<input type="checkbox" name="cbox1" value="chocolatePuro">';
                        echo "</div>";
                        echo "<div class='opcionesTiendaTitulo'>";
                            echo 'Chocolate Puro';
                        echo "</div>";
                        echo '<label for="cbox3"><div id="opcionBox">' . '<img src="/design/img/bar/cafeConLeche">' . '</div><div class="monedaTienda"></div><div class="precioTienda">25</div><div class="corazonTienda"></div><div class="vidaTienda">+3</div></label>';
                    echo "</div>";
                    
                    echo "<div class='opcionesTienda'>";
                        echo "<div class='opcionesTiendaCheckbox'>";
                            echo '<input type="checkbox" name="cbox1" value="azucar">';
                        echo "</div>";
                        echo "<div class='opcionesTiendaTitulo'>";
                            echo 'Dosis de Azúcar';
                        echo "</div>";
                        echo '<label for="cbox3"><div id="opcionBox">' . '<img src="/design/img/bar/cafeIrlandes">' . '</div><div class="monedaTienda"></div><div class="precioTienda">25</div><div class="corazonTienda"></div><div class="vidaTienda">+3</div></label>';
                    echo "</div>";
                    
                        echo "<div class='submitTienda'>";
                            echo'<input type="submit" class="botonTiendaComprar" value=" ">';
                        echo "</div>";
                    echo "</form>";      
                echo "</div>"; //FIN terraza
                
                echo "<div id='mesa'>";
                $mostrar = comprobarMision(20);
                $progreso = comprobarProgreso(20);
                    echo "<div class='textoDependiente'>";
                            
                            if($mostrar === 1){ //Está activada y en progreso
                                $descripcionZona = getDescripcionMision(20, $progreso);
                                echo $descripcionZona;
                                $recompensa = getRecompensaMision(20, $progreso);
                                echo $recompensa; 
                            }
                            elseif($mostrar === 2){ //La mision aun no esta activada
                                echo "\"¿Cuántos minutos eres capaz de resistir sin respirar?\".";
                            }
                            else{ //L mision ya esta completada
                                echo "Las mesas están vacías.";
                            }
                        echo "</div>"; //FIN textoDependiente
                        echo "<div class='imagenDependiente'>";
                            if($mostrar === 0){ //Está completada
                                echo '<img src="/design/img/dependientes/yoHombre.png">';
                            }
                            else{ //No está activada o está activad pero en progreso
                                echo '<img src="/design/img/dependientes/mujerOsiris.png">';
                            }
                        echo "</div>"; //FIN imagenDependiente
                        
                    if($mostrar === 1 || $mostrar === 2){
                        echo '<form id = "selectorOpciones" action="?bPage=actualizaciones&action=accionSpot&nonUI" method="post">';

                        echo "<div class='opcionesTienda'>";
                            echo "<div class='opcionesTiendaCheckbox'>";
                                echo '<input type="checkbox" name="cbox1" value="misionRespiro">';
                            echo "</div>";
                            echo "<div class='opcionesTiendaTitulo'>";
                                echo '¡Misión Respiro!';
                            echo "</div>";
                            if ($mostrar === 2)
                                echo '<label for="cbox3"><div id="opcionBox">' . '<img src="/design/img/bar/cafeConLeche">' . '</div><div class="monedaTienda"></div><div class="precioTienda">4 Etapas</div></label>';
                            elseif(($mostrar === 1) && ($progreso === '1'))
                                echo '<label for="cbox3"><div id="opcionBox">' . '<img src="/design/img/bar/cafeConLeche">' . '</div><div class="relojMini"></div><div class="precioTienda">1M</div></label>';
                            elseif(($mostrar === 1) && ($progreso === '2'))
                                echo '<label for="cbox3"><div id="opcionBox">' . '<img src="/design/img/bar/cafeConLeche">' . '</div><div class="relojMini"></div><div class="precioTienda">3M</div></label>';
                            elseif(($mostrar === 1) && ($progreso === '3'))
                                echo '<label for="cbox3"><div id="opcionBox">' . '<img src="/design/img/bar/cafeConLeche">' . '</div><div class="relojMini"></div><div class="precioTienda">5M</div></label>';
                            elseif(($mostrar === 1) && ($progreso === '4'))
                                echo '<label for="cbox3"><div id="opcionBox">' . '<img src="/design/img/bar/cafeConLeche">' . '</div><div class="relojMini"></div><div class="precioTienda">10M</div></label>';
                                
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
                        $("#barra").hide();
                        $("#mesa").show();
                        $("#botonVender").css("background-color", "rgba(255, 249, 192, 0.7)");
                        $("#botonComprar").css("background-color", "white");
                    });

                      $("#botonComprar").click(function(){
                        $("#barra").show();
                        $("#mesa").hide();
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
                            echo '<iframe width="300" height="225" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.openstreetmap.org/export/embed.html?bbox=-4.120495319366456%2C38.687879790894684%2C-4.1066980361938485%2C38.693733347004304&amp;layer=mapnik&amp;marker=38.690802594993514%2C-4.11360955251439" style="border: 1px solid black"></iframe><br/><br>';    
                        echo "</div>";
                        echo "<div class = 'infoSpot'>";
                            echo "<table border = '0' style = 'text-align:left'>";
                                echo "<tr>";
                                    echo "<td><div class='mapaMini'></div> C/Bañiz Bajo, 13<br></td>";
                                echo "</tr>";
                                echo "<tr>";
                                echo "<td><div class='telefonoMini'></div> 644 15 25 06<br></td>";
                                echo "</tr>";
                                echo "<tr>";
                                echo "<td><div class='relojMini'></div> -</td>";
                                echo "</tr>";
                            echo "</table>";
                        echo "</div>";
                    echo "</div>";
                    
                    echo "<div class = 'seccionInsignia'>";
                        $fechaInsignia = comprobarInsignia(140);
                        if ($fechaInsignia != '0'){
                            $fotoInsignia = getFotoInsignia(140);
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
        
        
