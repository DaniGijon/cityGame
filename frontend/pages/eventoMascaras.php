<?php
global $db;
        include (__ROOT__.'/backend/comprobaciones.php');
        include (__ROOT__.'/backend/getFotos.php');
        $id = $_SESSION['loggedIn'];
        comprobarZona1Barrio2();
        
        echo "<div id='moduloZona'>";
            echo "<span class = 'tituloSpot'>";
                echo "<h4>" . getNombreSpot(29) . "</h4>";
            echo "</span>";
            
            echo "<div class='contenido'>";
            
            echo "<span class='contenedor1'>"; 
                /*    
                echo "<div class='seccionSpotImagen'>" ;
                    $imagenSpot = getFotoSpot(29);
                    echo $imagenSpot;
                echo "</div>"; //FIN DE div seccionSpotImagen
                */
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
                                    echo "\"Viajo por todas partes en busca de máscaras... Pruébate alguna.\"";
                                echo "</div>"; //FIN textoDependiente
                                echo "<div class='imagenDependiente'>";
                                    echo '<img src="/design/img/dependientes/mascaras.png">';
                                echo "</div>"; //FIN imagenDependiente
                                $imagenMascaraConejo = getFotoObjeto(102);
                                $imagenMascaraBomba = getFotoObjeto(103);
                                $imagenMascaraMejora = getFotoObjeto(104);

                                echo "<div class='opcionesTienda'>";
                                    echo "<div class='opcionesTiendaCheckbox'>";
                                        echo '<input type="checkbox" name="cbox1" value="mascaraConejo">';
                                    echo "</div>";
                                    echo "<div class='opcionesTiendaTitulo'>";
                                        echo 'Capucha de Conejo';
                                    echo "</div>";
                                    echo '<label for="cbox3"><div id="opcionBox">' . $imagenMascaraConejo . '</div><div class="monedaTienda"></div><div class="precioTienda">1000</div></label>';
                                echo "</div>";
                                echo "<div class='opcionesTienda'>";
                                    echo "<div class='opcionesTiendaCheckbox'>";
                                        echo '<input type="checkbox" name="cbox1" value="mascaraBomba">';
                                    echo "</div>";
                                    echo "<div class='opcionesTiendaTitulo'>";
                                        echo 'Máscara Explosiva';
                                    echo "</div>";
                                    echo '<label for="cbox4"><div id="opcionBox">' . $imagenMascaraBomba . '</div><div class="monedaTienda"></div><div class="precioTienda">1000</div></label>';
                                echo "</div>";
                                echo "<div class='opcionesTienda'>";
                                    echo "<div class='opcionesTiendaCheckbox'>";
                                        echo '<input type="checkbox" name="cbox1" value="mascaraMejora">';
                                    echo "</div>";
                                    echo "<div class='opcionesTiendaTitulo'>";
                                        echo 'Máscara de Mejora';
                                    echo "</div>";
                                    echo '<label for="cbox4"><div id="opcionBox">' . $imagenMascaraMejora . '</div><div class="monedaTienda"></div><div class="precioTienda">1000</div></label>';
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
                                    echo "\"Está bien. Veamos qué traes en tu mochila\"";
                                echo "</div>"; //FIN textoDependiente
                                echo "<div class='imagenDependiente'>";
                                    echo '<img src="/design/img/dependientes/mascaras.png">';
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
                                    echo'<input type="submit" class="botonTiendaVender" value=" ">';
                                echo "</div>";
                                /*echo " Llevo " . $dineroEnCash . "€ en el bolsillo.<br><br>"; */
                                echo '</form>';
                        echo "</div>";
                    echo "</div>"; //FIN Semitransparente
                echo "</div>"; //FIN seccionSpotOpciones
                
                echo "</span>"; //FIN Contenedor1
                
                echo "<span class='contenedor2'>";
                
                            echo "<div class='opcionSpot1 opcionSpot'>";
                                echo "<div class='seccionDescripcionZonaImagen'>";
                                    $imagenSpot = "<img src='/design/img/especial/ritual.png'>";
                                    echo $imagenSpot;
                                echo "</div>";
                                echo "<div class='seccionDescripcionZonaTexto'>";
                        
                                    echo "<span class='textoDescripcionSpot'>";
                                        $descripcionZona = "\"¡La capucha del Conejo! Guau, vaya cacho de orejas. ¿Seré digno de su poder salvaje?\"";
                                        echo $descripcionZona;
                                    echo "</span>";
                                echo "</div>"; //Fin seccionDescripcionZonaTexto
                            echo "</div>"; //FIN opcionSpot1
                            
                            echo "<div class='opcionSpot2 opcionSpot'>";
                                echo "<div class='seccionDescripcionZonaImagen'>";
                                    $imagenSpot = "<img src='/design/img/especial/tragoVino.png'>";
                                    echo $imagenSpot;
                                echo "</div>";
                                echo "<div class='seccionDescripcionZonaTexto'>";
                        
                                    echo "<span class='textoDescripcionSpot'>";
                                        $descripcionZona = "\"¡Esto va a ser la Bomba!\"";
                                        echo $descripcionZona;
                                    echo "</span>";
                                echo "</div>"; //Fin descripcionZonaTexto
                            echo "</div>"; //FIN opcionSpot2
                            
                             echo "<div class='opcionSpot3 opcionSpot'>";
                                echo "<div class='seccionDescripcionZonaImagen'>";
                                    $imagenSpot = "<img src='/design/img/especial/guarroAsao.png'>";
                                    echo $imagenSpot;
                                echo "</div>";
                                echo "<div class='seccionDescripcionZonaTexto'>";
                        
                                    echo "<span class='textoDescripcionSpot'>";
                                        $descripcionZona = "\"♪♫♬ Aa-aa-ay. Corazón espinado ♪♫♬\".";
                                        echo $descripcionZona;
                                    echo "</span>";
                                echo "</div>"; //Fin descripcionZonaTexto
                            echo "</div>"; //FIN opcionSpot3
                
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
                    
                    $(":checkbox").click(function(){
                            var valor = $(this).val();
                            
                            if (valor === 'mascaraConejo') {
                                $(".opcionSpot1").show();
                                $(".opcionSpot2").hide();
                                $(".opcionSpot3").hide();
                            }
                            else if (valor === 'mascaraBomba'){
                                $(".opcionSpot2").show();
                                $(".opcionSpot1").hide();
                                $(".opcionSpot3").hide();
                            }
                            else if (valor === 'mascaraMejora'){
                                $(".opcionSpot3").show();
                                $(".opcionSpot1").hide();
                                $(".opcionSpot2").hide();
                            }
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
        
        
        

