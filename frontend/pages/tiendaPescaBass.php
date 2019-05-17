<?php
global $db;
        include (__ROOT__.'/backend/comprobaciones.php');
        include (__ROOT__.'/backend/getFotos.php');
        $id = $_SESSION['loggedIn'];
        comprobarZona1Barrio2();
        
        echo "<div id='moduloZona'>";
            echo "<span class = 'tituloSpot'>";
                echo "<h4>" . getNombreSpot(21) . "</h4>";
            echo "</span>";
            
            echo "<div class='contenido'>";
            
            echo "<span class='contenedor1'>"; 
                    
                echo "<div class='seccionSpotImagen'>" ;
                    $imagenSpot = getFotoSpot(21);
                    echo $imagenSpot;
                echo "</div>"; //FIN DE div seccionSpotImagen
                
                echo "<div class='seccionSpotOpciones'>";   
                    //Cabecera selector opciones
                    echo "<div id='botonesComprarVender'>";
                        echo "<button id='botonComprar' class='tagTiendaComprar'>Comprar</button>";
                        echo "<button id='botonVender' class='tagTiendaVender'>Vender</button>";
                       echo "</div>";
                    echo "<div id='comprar'>";
                            echo '<form id = "selectorOpciones" action="?bPage=actualizaciones&action=accionSpot&nonUI" method="post">';
                            echo "<div class='textoDependiente'>";
                                echo "\"Bienvenido a PescaBass. ¿En qué puedo ayudarle?\" <br><br>";
                            echo "</div>";
                            $imagenPez = getPez();
                            $imagenHamster = getHámster();
                            $imagenGallo = getGallo();
                           
                            echo "<div class='opcionesTienda'>";
                                echo '<input type="checkbox" name="cbox1" value="Pez">Pez<label for="cbox3"><div id="opcionBox">' . $imagenPez . '</div><div class="monedaTienda"></div><div class="precioTienda">1000</div></label>';
                            echo "</div>";
                            echo "<div class='opcionesTienda'>";
                                echo '<input type="checkbox" name="cbox1" value="Hámster">Hámster<label for="cbox4"><div id="opcionBox">' . $imagenHamster . '</div><div class="monedaTienda"></div><div class="precioTienda">1000</div></label>';
                            echo "</div>";
                            echo "<div class='opcionesTienda'>";
                                echo '<input type="checkbox" name="cbox1" value="Gallo"> Gallo<label for="cbox4"><div id="opcionBox">' . $imagenGallo . '</div><div class="monedaTienda"></div><div class="precioTienda">1000</div></label><br><br>';
                            echo "</div>";  
                            echo "<div class='submitTienda'>";
                                echo'<input type="submit" class="botonTiendaComprar" value=" ">';
                            echo "</div>";
                           /* $miDinero = comprobarDinero();
                            $dineroEnCash = $miDinero[0]['cash'];
                            echo " Llevo " . $dineroEnCash . "€ en el bolsillo.<br><br>"; */
                            echo "</form>";                 
                    echo "</div>";

                    echo "<div id='vender'>";

                            echo '<form id = "selectorOpciones" action="?bPage=actualizaciones&action=accionSpot&nonUI" method="post">';
                            echo "<div class='textoDependiente'>";
                                echo "\"Está bien, veamos qué traes en tu mochila\" <br><br>";
                            echo "</div>";
                            //CONSULTAR OBJETOS QUE LLEVO DESEQUIPADOS
                            $objetosDesequipados=objetosDesequipados();
                            foreach($objetosDesequipados as $cadaObjeto){
                                if($cadaObjeto['id'] === '0'){
                                    
                                }
                                else{
                                    echo "<div class='opcionesTienda'>";
                                     echo '<input type="checkbox" name="cbox1" value="v' . $cadaObjeto['nombre'] . '">'. $cadaObjeto['nombre'] . '<label for="cbox3"><div id="opcionBox">' . '<img src="/design/img/objetos/' . $cadaObjeto['imagenObjeto'] . '"></div>' . '<div class="monedaTienda"></div><div class="precioTienda">' . $cadaObjeto["precioVenta"] . '</div></label>';
                                    echo "</div>";
                                }
                            }

                            echo "<div class='submitTienda'>";
                                echo'<input type="submit" class="botonTiendaVender" value=" ">';
                            echo "</div>";
                            /*echo " Llevo " . $dineroEnCash . "€ en el bolsillo.<br><br>"; */
                            echo '</form>';
                    echo "</div>";
                echo "</div>"; //FIN seccionSpotOpciones
                
                echo "</span>"; //FIN Contenedor1
                
                echo "<span class='contenedor2'>";
                
                echo "<div class='seccionSpotInfo'>";
                    echo "<div class = 'seccionContacto'>";
                        echo "<div class = 'mapaCallejero'>";
                            echo '<iframe width="300" height="225" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.openstreetmap.org/export/embed.html?bbox=-4.1127920150756845%2C38.681749373255805%2C-4.098994731903077%2C38.687603430912894&amp;layer=mapnik&amp;marker=38.684672389459415%2C-4.105891227591201" style="border: 1px solid black"></iframe><br/><br>';    
                        echo "</div>";
                        echo "<div class = 'infoSpot'>";
                            echo "<table border = '0' style = 'text-align:left'>";
                                echo "<tr>";
                                    echo "<td><div class='mapaMini'></div> C/Gran Capitán, 12<br></td>";
                                echo "</tr>";
                                echo "<tr>";
                                echo "<td><div class='telefonoMini'></div> 926 41 23 68<br></td>";
                                echo "</tr>";
                                echo "<tr>";
                                echo "<td><div class='relojMini'></div> 10:00 - 14:00, 17:30 - 20:30 Lunes-Viernes<br>10:00 - 14:00 Sábado-Domingo</td>";
                                echo "</tr>";
                            echo "</table>";
                        echo "</div>";
                    echo "</div>";
                    
                    echo "<div class = 'seccionInsignia'>";
                        $fechaInsignia = comprobarInsignia(21);
                        if ($fechaInsignia != '0'){
                            $fotoInsignia = getFotoInsignia(21);
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
                        $("#comprar").hide();
                        $("#vender").show();
                        $("#botonVender").css("background-color", "yellow");
                        $("#botonComprar").css("background-color", "white");
                    });

                      $("#botonComprar").click(function(){
                        $("#comprar").show();
                        $("#vender").hide();
                        $("#botonComprar").css("background-color", "yellow");
                        $("#botonVender").css("background-color", "white");
                    });
                    
                </script>
                

                <?php
                    
                echo "</div>"; //FIN DE div seccionSpotOpciones

                
            echo "</div>"; //FIN DE div contenido

        echo "</div>"; //FIN DE div moduloZona
        
        
        
