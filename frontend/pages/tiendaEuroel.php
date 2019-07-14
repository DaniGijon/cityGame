<?php
global $db;
        include (__ROOT__.'/backend/comprobaciones.php');
        include (__ROOT__.'/backend/getFotos.php');
        $id = $_SESSION['loggedIn'];
        $miDinero = comprobarDinero();
        $dineroEnCash = $miDinero[0]['cash'];
        comprobarZona1Barrio2();
        
        echo "<div id='moduloZona'>";
            echo "<span class = 'tituloSpot'>";
                echo "<h4>" . getNombreSpot(24) . "</h4>";
            echo "</span>";
            
            echo "<div class='contenido'>";
            
            echo "<span class='contenedor1'>"; 
                 
                echo "<div class='seccionSpotOpciones'>";   
                    //Cabecera selector opciones
                    echo "<div id='botonesComprarVender'>";
                        echo "<button id='botonComprar' class='tagTiendaComprar'>Comprar</button>";
                        echo "<button id='botonVender' class='tagTiendaVender'>Vender</button>";
                    echo "</div>";
                    echo "<div class='semiTransparente'>";  
                        echo "<div id='comprar'>";
                                echo '<form id = "selectorOpciones" action="?bPage=actualizaciones&action=accionSpot&nonUI" method="post">';
                                echo "<div class='textoDependiente'>";
                                    echo "\"¡Hola! Tal vez me recuerdes de películas como las que fuiste a ver a los Multicines Ortega.\"";
                                echo "</div>"; //FIN textoDependiente
                                echo "<div class='imagenDependiente'>";
                                    echo '<img src="/design/img/dependientes/euroel.png">';
                                echo "</div>"; //FIN imagenDependiente
                                $imagenPulseraLuminosa = getFotoObjeto(314);
                                $imagenLinterna = getFotoObjeto(313);
                                $imagenLucesLED = getFotoObjeto(927);

                                echo "<div class='opcionesTienda'>";
                                    echo "<div class='opcionesTiendaCheckbox'>";
                                        echo '<input type="checkbox" name="cbox1" value="pulseraLuminosa">';
                                    echo "</div>";
                                    echo "<div class='opcionesTiendaTitulo'>";
                                        echo 'Pulsera Luminosa';
                                    echo "</div>";
                                    echo '<label for="cbox3"><div id="opcionBox">' . $imagenPulseraLuminosa . '</div><div class="monedaTienda"></div><div class="precioTienda">300</div></label>';
                                echo "</div>";
                                
                                echo "<div class='opcionesTienda'>";
                                    echo "<div class='opcionesTiendaCheckbox'>";
                                        echo '<input type="checkbox" name="cbox1" value="linterna">';
                                    echo "</div>";
                                    echo "<div class='opcionesTiendaTitulo'>";
                                        echo 'Linterna de mano';
                                    echo "</div>";
                                    echo '<label for="cbox3"><div id="opcionBox">' . $imagenLinterna . '</div><div class="monedaTienda"></div><div class="precioTienda">800</div></label>';
                                echo "</div>";
                                
                                echo "<div class='opcionesTienda'>";
                                    echo "<div class='opcionesTiendaCheckbox'>";
                                        echo '<input type="checkbox" name="cbox1" value="lucesLED">';
                                    echo "</div>";
                                    echo "<div class='opcionesTiendaTitulo'>";
                                        echo 'Luces de LED';
                                    echo "</div>";
                                    echo '<label for="cbox3"><div id="opcionBox">' . $imagenLucesLED . '</div><div class="monedaTienda"></div><div class="precioTienda">2000</div></label>';
                                echo "</div>";
                                echo "<div class='submitTienda'>";
                                    echo'<input type="submit" class="botonTiendaComprar" value=" "><br><br>';
                                echo "</div>";
                                echo " Llevo " . $dineroEnCash . " <img src='/design/img/iconos/monedaTop.png' style='vertical-align: bottom'>" . " en el bolsillo.";
                                echo "</form>";                 
                        echo "</div>";

                        echo "<div id='vender'>";

                                echo '<form id = "selectorOpciones" action="?bPage=actualizaciones&action=accionSpot&nonUI" method="post">';
                                echo "<div class='textoDependiente'>";
                                    echo "\"Esa chatarra que traes no vale ni para encender fuego.\"";
                                echo "</div>"; //FIN textoDependiente
                                echo "<div class='imagenDependiente'>";
                                    echo '<img src="/design/img/dependientes/euroel.png">';
                                echo "</div>"; //FIN imagenDependiente
                                //CONSULTAR OBJETOS QUE LLEVO DESEQUIPADOS
                                $objetosDesequipados=objetosDesequipados();
                                foreach($objetosDesequipados as $cadaObjeto){
                                    if($cadaObjeto['id'] === '0'){

                                    }
                                    else{
                                        echo "<div class='opcionesTienda'>";
                                            echo "<div class='opcionesTiendaCheckbox'>";
                                                echo '<input type="checkbox" name="cbox1" value="v' . $cadaObjeto['nombre'] . '">';
                                            echo "</div>";
                                            echo "<div class='opcionesTiendaTitulo'>";
                                                echo $cadaObjeto['nombre'];
                                            echo "</div>";
                                            echo '<label for="cbox3"><div id="opcionBox">' . '<img src="/design/img/objetos/' . $cadaObjeto['imagenObjeto'] . '"></div>' . '<div class="monedaTienda"></div><div class="precioTienda">' . $cadaObjeto["precioVenta"] . '</div></label>';
                                        echo "</div>";
                                    }
                                }

                                echo "<div class='submitTienda'>";
                                    echo "<input type='submit' class='botonCarrilBici' value=' '><br><br>";
                                echo "</div>";
                                echo " Llevo " . $dineroEnCash . " <img src='/design/img/iconos/monedaTop.png' style='vertical-align: bottom'>" . " en el bolsillo.";
                                echo '</form>';
                        echo "</div>";
                    echo "</div>"; //Fin SemiTransparente
                echo "</div>"; //FIN seccionSpotOpciones
                
                echo "</span>"; //FIN Contenedor1
                
                echo "<span class='contenedor2'>";
                
                echo "<div class='seccionSpotInfo'>";
                    echo "<div class = 'seccionContacto'>";
                        echo "<div class = 'mapaCallejero'>";
                            echo '<iframe width="300" height="225" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.openstreetmap.org/export/embed.html?bbox=-4.111365079879762%2C38.681824750432206%2C-4.097567796707154%2C38.687678801922885&amp;layer=mapnik&amp;marker=38.68475926609994%2C-4.104470730089815" style="border: 1px solid black"></iframe><br/><br>';    
                        echo "</div>";
                        echo "<div class = 'semiTransparente'>";
                        echo "<div class = 'infoSpot'>";
                            echo "<table border = '0' style = 'text-align:left'>";
                                echo "<tr>";
                                    echo "<td><div class='mapaMini'></div> C/Cisneros, 22<br></td>";
                                echo "</tr>";
                                echo "<tr>";
                                echo "<td><div class='telefonoMini'></div> 926 44 17 79<br></td>";
                                echo "</tr>";
                                echo "<tr>";
                                echo "<td><div class='relojMini'></div> 08:00 - 20:00 Lunes-Viernes</td>";
                                echo "</tr>";
                            echo "</table>";
                        echo "</div>";
                        echo "</div>";//fin semiTransparente
                    echo "</div>";
                    
                    echo "<div class = 'seccionInsignia'>";
                        $fechaInsignia = comprobarInsignia(24);
                        if ($fechaInsignia != '0'){
                            $fotoInsignia = getFotoInsignia(24);
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
                        $("#botonVender").css("background-color", "rgba(255, 249, 192, 0.7)");
                        $("#botonComprar").css("background-color", "white");
                    });

                      $("#botonComprar").click(function(){
                        $("#comprar").show();
                        $("#vender").hide();
                        $("#botonComprar").css("background-color", "rgba(255, 249, 192, 0.7)");
                        $("#botonVender").css("background-color", "white");
                    });
                    
                </script>
                

                <?php
                    
                echo "</div>"; //FIN DE div seccionSpotOpciones

                
            echo "</div>"; //FIN DE div contenido

        echo "</div>"; //FIN DE div moduloZona
        
        
        
