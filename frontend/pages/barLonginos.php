<?php
global $db;
        include (__ROOT__.'/backend/comprobaciones.php');
        include (__ROOT__.'/backend/getFotos.php');
        $id = $_SESSION['loggedIn'];
        comprobarZona2Barrio2();
        
        echo "<div id='moduloZona'>";
            echo "<span class = 'tituloSpot'>";
                echo "<h4>" . getNombreSpot(30) . "</h4>";
            echo "</span>";
            
            echo "<div class='contenido'>";
                echo "<span class='contenedor1'>"; 
                
                    echo "<div class='seccionSpotOpciones'>";
                    echo "<div id='botonesComprarVender'>";
                        echo "<button id='botonComprar' class='tagTiendaComprar'>Barra</button>";
                        echo "<button id='botonVender' class='tagTiendaVender'>Muro</button>";
                    echo "</div>";
                    echo "<div class='semiTransparente'>"; 
                    echo "<div id='barra'>";
                        echo "<div class='textoDependiente'>";
                            echo "\"La comida picante de mi bar te hará sentir como en el calor del hogar, del mismo infierno\".";
                        echo "</div>"; //FIN textoDependiente
                        echo "<div class='imagenDependiente'>";
                            echo '<img src="/design/img/dependientes/hellboy.png">';
                        echo "</div>"; //FIN imagenDependiente
                        
                    
                    echo '<form id = "selectorOpciones" action="?bPage=actualizaciones&action=accionSpot&nonUI" method="post">';
                    echo "<div class='opcionesTienda'>";
                        echo "<div class='opcionesTiendaCheckbox'>";
                            echo '<input type="checkbox" name="cbox1" value="bravas">';
                        echo "</div>";
                        echo "<div class='opcionesTiendaTitulo'>";
                            echo 'Patatas Bravas';
                        echo "</div>";
                        echo '<label for="cbox3"><div id="opcionBox">' . '<img src="/design/img/bar/cafeConLeche">' . '</div><div class="monedaTienda"></div><div class="precioTienda">25</div><div class="corazonTienda"></div><div class="vidaTienda">+3</div></label>';
                    echo "</div>";
                    
                    echo "<div class='opcionesTienda'>";
                        echo "<div class='opcionesTiendaCheckbox'>";
                            echo '<input type="checkbox" name="cbox1" value="brochetas">';
                        echo "</div>";
                        echo "<div class='opcionesTiendaTitulo'>";
                            echo 'Brochetas Bravas';
                        echo "</div>";
                        echo '<label for="cbox3"><div id="opcionBox">' . '<img src="/design/img/bar/cafeIrlandes">' . '</div><div class="monedaTienda"></div><div class="precioTienda">25</div><div class="corazonTienda"></div><div class="vidaTienda">+3</div></label>';
                    echo "</div>";
                    
                    echo "<div class='opcionesTienda'>";
                        echo "<div class='opcionesTiendaCheckbox'>";
                            echo '<input type="checkbox" name="cbox1" value="retoPicante">';
                        echo "</div>";
                        echo "<div class='opcionesTiendaTitulo'>";
                            echo 'Reto Picante';
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
                
                echo "<div id='muro'>";
                $mostrar = comprobarMision(17);
                $progreso = comprobarProgreso(17);
                    echo "<div class='textoDependiente'>";
                            
                            if($mostrar === 1){ //Está activada y en progreso
                                $descripcionZona = getDescripcionMision(17, $progreso);
                                echo $descripcionZona;
                                $recompensa = getRecompensaMision(17, $progreso);
                                echo $recompensa; 
                            }
                            elseif($mostrar === 2){ //La mision aun no esta activada
                                echo "\"Qué vecinos tan ruidosos con sus rituales y sacrificios. Se ofrece recompensa por silenciarlos\".";
                            }
                            else{ //L mision ya esta completada
                                echo "\"Vendo Opel Corsa. 5 puertas. Está nuevo\".";
                            }
                        echo "</div>"; //FIN textoDependiente
                        echo "<div class='imagenDependiente'>";
                            
                                echo '<img src="/design/img/dependientes/cartelMuro.png">';
                            
                        echo "</div>"; //FIN imagenDependiente
                        
                    if($mostrar === 2 || $mostrar === 1){
                        echo '<form id = "selectorOpciones" action="?bPage=actualizaciones&action=accionSpot&nonUI" method="post">';

                        echo "<div class='opcionesTienda'>";
                            echo "<div class='opcionesTiendaCheckbox'>";
                                echo '<input type="checkbox" name="cbox1" value="mision666">';
                            echo "</div>";
                            echo "<div class='opcionesTiendaTitulo'>";
                                echo '¡Misión 666!';
                            echo "</div>";
                            echo '<label for="cbox3"><div id="opcionBox">' . '<img src="/design/img/bar/cafeConLeche">' . '</div><div class="monedaTienda"></div><div class="precioTienda">3 Etapas</div></label>';
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
                        $("#muro").show();
                        $("#botonVender").css("background-color", "rgba(255, 249, 192, 0.7)");
                        $("#botonComprar").css("background-color", "white");
                    });

                      $("#botonComprar").click(function(){
                        $("#barra").show();
                        $("#muro").hide();
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
                            echo '<iframe width="300" height="225" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.openstreetmap.org/export/embed.html?bbox=-4.105024337768556%2C38.68146461431729%2C-4.091227054595948%2C38.6873186952697&amp;layer=mapnik&amp;marker=38.68439578716559%2C-4.098129987323773" style="border: 1px solid black"></iframe><br/><br>';    
                        echo "</div>";
                        echo "<div class = 'infoSpot'>";
                            echo "<table border = '0' style = 'text-align:left'>";
                                echo "<tr>";
                                    echo "<td><div class='mapaMini'></div> C/Palafox, 17<br></td>";
                                echo "</tr>";
                                echo "<tr>";
                                echo "<td><div class='telefonoMini'></div>  926 43 07 72<br></td>";
                                echo "</tr>";
                                echo "<tr>";
                                echo "<td><div class='relojMini'></div> 12:30H - 00:00H. Miércoles Cerrado.</td>";
                                echo "</tr>";
                            echo "</table>";
                        echo "</div>";
                    echo "</div>";
                    
                    echo "<div class = 'seccionInsignia'>";
                        $fechaInsignia = comprobarInsignia(30);
                        if ($fechaInsignia != '0'){
                            $fotoInsignia = getFotoInsignia(30);
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
        
        