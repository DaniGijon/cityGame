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
                
                echo "<div class='seccionSpotOpciones'>";   
                    //Cabecera selector opciones
                    echo "<div id='botonesComprarVender'>";
                        echo "<button id='botonComprar' class='tagTiendaComprar'>Comprar</button>";
                        echo "<button id='botonVender' class='tagTiendaVender'>Vender</button>";
                    echo "</div>";
                    echo "<div class='semiTransparente'>";
                    //INFOOBJETO 102
                     echo "<div id='infoObjeto102' class='infoObjeto objetoCabeza'>";
                    $result = getObjeto(102);
                    if($result[0]['nombre'] != 'Vacio'){
                        echo "<b>" . $result[0]['nombre'] . "</b><br><br>";
                    }
                    
                    if($result[0]['destreza'] != 0){
                        echo "Destreza: " . $result[0]['destreza'] . "<br>";
                    }
                    if($result[0]['fuerza'] != 0){
                        echo "Fuerza: " . $result[0]['fuerza'] ."<br>";
                    }
                    if($result[0]['agilidad'] != 0){
                        echo "Agilidad: " . $result[0]['agilidad'] ."<br>";
                    }
                    if($result[0]['resistencia'] != 0){
                        echo "Resistencia: " . $result[0]['resistencia'] ."<br>";
                    }
                    if($result[0]['espiritu'] != 0){
                        echo "Espiritu: " . $result[0]['espiritu'] ."<br>";
                    }
                    if($result[0]['estilo'] != 0){
                        echo "Estilo: " . $result[0]['estilo'] ."<br>" ;
                    }
                    if($result[0]['ingenio'] != 0){
                        echo "Ingenio: " . $result[0]['ingenio'] ."<br>";
                    }
                    if($result[0]['percepcion'] != 0){
                        echo "Percepcion: " . $result[0]['percepcion'];
                    }
                    if($result[0]['especial'] != 'nada'){
                        echo "<br>Especial: <b>" . $result[0]['especial'] . "</b>";
                    }
                echo "</div>";
                //FIN INFOOBJETO 102
                //INFOOBJETO 103
                     echo "<div id='infoObjeto103' class='infoObjeto objetoCabeza'>";
                    $result = getObjeto(103);
                    if($result[0]['nombre'] != 'Vacio'){
                        echo "<b>" . $result[0]['nombre'] . "</b><br><br>";
                    }
                    
                    if($result[0]['destreza'] != 0){
                        echo "Destreza: " . $result[0]['destreza'] . "<br>";
                    }
                    if($result[0]['fuerza'] != 0){
                        echo "Fuerza: " . $result[0]['fuerza'] ."<br>";
                    }
                    if($result[0]['agilidad'] != 0){
                        echo "Agilidad: " . $result[0]['agilidad'] ."<br>";
                    }
                    if($result[0]['resistencia'] != 0){
                        echo "Resistencia: " . $result[0]['resistencia'] ."<br>";
                    }
                    if($result[0]['espiritu'] != 0){
                        echo "Espiritu: " . $result[0]['espiritu'] ."<br>";
                    }
                    if($result[0]['estilo'] != 0){
                        echo "Estilo: " . $result[0]['estilo'] ."<br>" ;
                    }
                    if($result[0]['ingenio'] != 0){
                        echo "Ingenio: " . $result[0]['ingenio'] ."<br>";
                    }
                    if($result[0]['percepcion'] != 0){
                        echo "Percepcion: " . $result[0]['percepcion'];
                    }
                    if($result[0]['especial'] != 'nada'){
                        echo "<br>Especial: <b>" . $result[0]['especial'] . "</b>";
                    }
                echo "</div>";
                //FIN INFOOBJETO 103
                //INFOOBJETO 104
                     echo "<div id='infoObjeto104' class='infoObjeto objetoCabeza'>";
                    $result = getObjeto(104);
                    if($result[0]['nombre'] != 'Vacio'){
                        echo "<b>" . $result[0]['nombre'] . "</b><br><br>";
                    }
                    
                    if($result[0]['destreza'] != 0){
                        echo "Destreza: " . $result[0]['destreza'] . "<br>";
                    }
                    if($result[0]['fuerza'] != 0){
                        echo "Fuerza: " . $result[0]['fuerza'] ."<br>";
                    }
                    if($result[0]['agilidad'] != 0){
                        echo "Agilidad: " . $result[0]['agilidad'] ."<br>";
                    }
                    if($result[0]['resistencia'] != 0){
                        echo "Resistencia: " . $result[0]['resistencia'] ."<br>";
                    }
                    if($result[0]['espiritu'] != 0){
                        echo "Espiritu: " . $result[0]['espiritu'] ."<br>";
                    }
                    if($result[0]['estilo'] != 0){
                        echo "Estilo: " . $result[0]['estilo'] ."<br>" ;
                    }
                    if($result[0]['ingenio'] != 0){
                        echo "Ingenio: " . $result[0]['ingenio'] ."<br>";
                    }
                    if($result[0]['percepcion'] != 0){
                        echo "Percepcion: " . $result[0]['percepcion'];
                    }
                    if($result[0]['especial'] != 'nada'){
                        echo "<br>Especial: <b>" . $result[0]['especial'] . "</b>";
                    }
                echo "</div>";
                //FIN INFOOBJETO 104
                //INFO OBJETOS VENTA
                $objetosDesequipados = objetosDesequipados();
                $i = 0;
                foreach($objetosDesequipados as $objetoVenta){
                    echo "<div id='infoObjetoVenta" . $i . "' class='infoObjeto'>";
                        $result = getObjeto($objetoVenta['id']);
                        if($result[0]['nombre'] != 'Vacio'){
                            echo "<b>" . $result[0]['nombre'] . "</b><br><br>";
                        }

                        if($result[0]['destreza'] != 0){
                            echo "Destreza: " . $result[0]['destreza'] . "<br>";
                        }
                        if($result[0]['fuerza'] != 0){
                            echo "Fuerza: " . $result[0]['fuerza'] ."<br>";
                        }
                        if($result[0]['agilidad'] != 0){
                            echo "Agilidad: " . $result[0]['agilidad'] ."<br>";
                        }
                        if($result[0]['resistencia'] != 0){
                            echo "Resistencia: " . $result[0]['resistencia'] ."<br>";
                        }
                        if($result[0]['espiritu'] != 0){
                            echo "Espiritu: " . $result[0]['espiritu'] ."<br>";
                        }
                        if($result[0]['estilo'] != 0){
                            echo "Estilo: " . $result[0]['estilo'] ."<br>" ;
                        }
                        if($result[0]['ingenio'] != 0){
                            echo "Ingenio: " . $result[0]['ingenio'] ."<br>";
                        }
                        if($result[0]['percepcion'] != 0){
                            echo "Percepcion: " . $result[0]['percepcion'];
                        }
                        if($result[0]['especial'] != 'nada'){
                            echo "<br>Especial: <b>" . $result[0]['especial'] . "</b>";
                        }
                    echo "</div>";
                    $i++;
                } //Fin foreach
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

                                echo "<div class='opcionesTienda " . 102 . "'>";
                                    echo "<div class='opcionesTiendaCheckbox'>";
                                        echo '<input type="checkbox" name="cbox1" value="mascaraConejo">';
                                    echo "</div>";
                                    echo "<div class='opcionesTiendaTitulo'>";
                                        echo 'Capucha de Conejo';
                                    echo "</div>";
                                    echo '<label for="cbox3"><div id="opcionBox">' . $imagenMascaraConejo . '</div><div class="monedaTienda"></div><div class="precioTienda">1000</div></label>';
                                echo "</div>";
                                echo "<div class='opcionesTienda " . 103 . "'>";
                                    echo "<div class='opcionesTiendaCheckbox'>";
                                        echo '<input type="checkbox" name="cbox1" value="mascaraBomba">';
                                    echo "</div>";
                                    echo "<div class='opcionesTiendaTitulo'>";
                                        echo 'Máscara Bomba';
                                    echo "</div>";
                                    echo '<label for="cbox4"><div id="opcionBox">' . $imagenMascaraBomba . '</div><div class="monedaTienda"></div><div class="precioTienda">1000</div></label>';
                                echo "</div>";
                                echo "<div class='opcionesTienda " . 104 . "'>";
                                    echo "<div class='opcionesTiendaCheckbox'>";
                                        echo '<input type="checkbox" name="cbox1" value="mascaraMejora">';
                                    echo "</div>";
                                    echo "<div class='opcionesTiendaTitulo'>";
                                        echo 'Máscara de Mejoras';
                                    echo "</div>";
                                    echo '<label for="cbox4"><div id="opcionBox">' . $imagenMascaraMejora . '</div><div class="monedaTienda"></div><div class="precioTienda">1000</div></label>';
                                echo "</div>";  
                                echo "<div class='submitTienda'>";
                                    echo'<input type="submit" class="botonTiendaComprar" value=" ">';
                                echo "</div>";
                                $miDinero = comprobarDinero();
                                $dineroEnCash = $miDinero[0]['cash'];
                                echo "<br>Llevo " . $dineroEnCash . " <img src='/design/img/iconos/monedaTop.png' style='vertical-align: bottom'>" . " en el bolsillo.";
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
                                $j = 0;
                                foreach($objetosDesequipados as $cadaObjeto){
                                    if($cadaObjeto['id'] === '0'){

                                    }
                                    else{
                                        echo "<div class='opcionesTienda venta" . $j . "'>";
                                            echo "<div class='opcionesTiendaCheckbox'>";
                                                echo '<input type="checkbox" name="cbox1" value="v' . $cadaObjeto['nombre'] . '">';
                                            echo "</div>";
                                            echo "<div class='opcionesTiendaTitulo'>";
                                                echo $cadaObjeto['nombre'];
                                            echo "</div>";
                                            echo '<label for="cbox3"><div id="opcionBox">' . '<img src="/design/img/objetos/' . $cadaObjeto['imagenObjeto'] . '"></div>' . '<div class="monedaTienda"></div><div class="precioTienda">' . $cadaObjeto["precioVenta"] . '</div></label>';
                                        echo "</div>";
                                    }
                                    $j++;
                                }//fin foreach

                                echo "<div class='submitTienda'>";
                                    echo'<input type="submit" class="botonTiendaVender" value=" ">';
                                echo "</div>";
                                echo "<br>Llevo " . $dineroEnCash . " <img src='/design/img/iconos/monedaTop.png' style='vertical-align: bottom'>" . " en el bolsillo.";
                                echo '</form>';
                        echo "</div>";
                    echo "</div>"; //FIN Semitransparente
                echo "</div>"; //FIN seccionSpotOpciones
                
                echo "</span>"; //FIN Contenedor1
                
                echo "<span class='contenedor2'>";
                
                            echo "<div class='opcionSpot0 opcionSpot' style='display: inline'>";
                                echo "<div class='seccionDescripcionZonaImagen'>";
                                    echo "<div class='seccionSpotImagen'>" ;
                                        $spotImagen = getFotoSpot(29);
                                        echo $spotImagen;
                                    echo "</div>";
                                echo "</div>";
                            echo "</div>"; //FIN opcionSpot0
                
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
                                $(".opcionSpot0").hide();
                                $(".opcionSpot2").hide();
                                $(".opcionSpot3").hide();
                            }
                            else if (valor === 'mascaraBomba'){
                                $(".opcionSpot2").show();
                                $(".opcionSpot0").hide();
                                $(".opcionSpot1").hide();
                                $(".opcionSpot3").hide();
                            }
                            else if (valor === 'mascaraMejora'){
                                $(".opcionSpot3").show();
                                $(".opcionSpot0").hide();
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
                    
                    $(".102").mouseenter(function(e){
                    $("#infoObjeto102").css("left", e.pageX - 300);
                    $("#infoObjeto102").css("top", e.pageY - 200);
                    $("#infoObjeto102").css("display", "block");
                    });
                    
                    $(".102").mouseleave(function(e){
                    $("#infoObjeto102").css("display", "none");
                    });
                    
                    $(".103").mouseenter(function(e){
                    $("#infoObjeto103").css("left", e.pageX - 300);
                    $("#infoObjeto103").css("top", e.pageY - 200);
                    $("#infoObjeto103").css("display", "block");
                    });
                    
                    $(".103").mouseleave(function(e){
                    $("#infoObjeto103").css("display", "none");
                    });
                    
                    $(".104").mouseenter(function(e){
                    $("#infoObjeto104").css("left", e.pageX - 300);
                    $("#infoObjeto104").css("top", e.pageY - 200);
                    $("#infoObjeto104").css("display", "block");
                    });
                    
                    $(".104").mouseleave(function(e){
                    $("#infoObjeto104").css("display", "none");
                    });
                    
                    $(".venta0").mouseenter(function(e){
                    $("#infoObjetoVenta0").css("left", e.pageX - 300);
                    $("#infoObjetoVenta0").css("top", e.pageY - 200);
                    $("#infoObjetoVenta0").css("display", "block");
                    });
                    
                    $(".venta0").mouseleave(function(e){
                    $("#infoObjetoVenta0").css("display", "none");
                    });
                    
                    $(".venta1").mouseenter(function(e){
                    $("#infoObjetoVenta1").css("left", e.pageX - 300);
                    $("#infoObjetoVenta1").css("top", e.pageY - 200);
                    $("#infoObjetoVenta1").css("display", "block");
                    });
                    
                    $(".venta1").mouseleave(function(e){
                    $("#infoObjetoVenta1").css("display", "none");
                    });
                    
                    $(".venta2").mouseenter(function(e){
                    $("#infoObjetoVenta2").css("left", e.pageX - 300);
                    $("#infoObjetoVenta2").css("top", e.pageY - 200);
                    $("#infoObjetoVenta2").css("display", "block");
                    });
                    
                    $(".venta2").mouseleave(function(e){
                    $("#infoObjetoVenta2").css("display", "none");
                    });
                    
                    $(".venta3").mouseenter(function(e){
                    $("#infoObjetoVenta3").css("left", e.pageX - 300);
                    $("#infoObjetoVenta3").css("top", e.pageY - 200);
                    $("#infoObjetoVenta3").css("display", "block");
                    });
                    
                    $(".venta3").mouseleave(function(e){
                    $("#infoObjetoVenta3").css("display", "none");
                    });
                    
                    $(".venta4").mouseenter(function(e){
                    $("#infoObjetoVenta4").css("left", e.pageX - 300);
                    $("#infoObjetoVenta4").css("top", e.pageY - 200);
                    $("#infoObjetoVenta4").css("display", "block");
                    });
                    
                    $(".venta4").mouseleave(function(e){
                    $("#infoObjetoVenta4").css("display", "none");
                    });
                    
                    $(".venta5").mouseenter(function(e){
                    $("#infoObjetoVenta5").css("left", e.pageX - 300);
                    $("#infoObjetoVenta5").css("top", e.pageY - 200);
                    $("#infoObjetoVenta5").css("display", "block");
                    });
                    
                    $(".venta5").mouseleave(function(e){
                    $("#infoObjetoVenta5").css("display", "none");
                    });
                    
                    $(".venta6").mouseenter(function(e){
                    $("#infoObjetoVenta6").css("left", e.pageX - 300);
                    $("#infoObjetoVenta6").css("top", e.pageY - 200);
                    $("#infoObjetoVenta6").css("display", "block");
                    });
                    
                    $(".venta6").mouseleave(function(e){
                    $("#infoObjetoVenta6").css("display", "none");
                    });
                    
                    $(".venta7").mouseenter(function(e){
                    $("#infoObjetoVenta7").css("left", e.pageX - 300);
                    $("#infoObjetoVenta7").css("top", e.pageY - 200);
                    $("#infoObjetoVenta7").css("display", "block");
                    });
                    
                    $(".venta7").mouseleave(function(e){
                    $("#infoObjetoVenta7").css("display", "none");
                    });
                    
                    $(".venta8").mouseenter(function(e){
                    $("#infoObjetoVenta8").css("left", e.pageX - 300);
                    $("#infoObjetoVenta8").css("top", e.pageY - 200);
                    $("#infoObjetoVenta8").css("display", "block");
                    });
                    
                    $(".venta8").mouseleave(function(e){
                    $("#infoObjetoVenta8").css("display", "none");
                    });
                    
                    $(".venta9").mouseenter(function(e){
                    $("#infoObjetoVenta9").css("left", e.pageX - 300);
                    $("#infoObjetoVenta9").css("top", e.pageY - 200);
                    $("#infoObjetoVenta9").css("display", "block");
                    });
                    
                    $(".venta9").mouseleave(function(e){
                    $("#infoObjetoVenta9").css("display", "none");
                    });
                    
                    $(".venta10").mouseenter(function(e){
                    $("#infoObjetoVenta10").css("left", e.pageX - 300);
                    $("#infoObjetoVenta10").css("top", e.pageY - 200);
                    $("#infoObjetoVenta10").css("display", "block");
                    });
                    
                    $(".venta10").mouseleave(function(e){
                    $("#infoObjetoVenta10").css("display", "none");
                    });
                    
                    $(".venta11").mouseenter(function(e){
                    $("#infoObjetoVenta11").css("left", e.pageX - 300);
                    $("#infoObjetoVenta11").css("top", e.pageY - 200);
                    $("#infoObjetoVenta11").css("display", "block");
                    });
                    
                    $(".venta11").mouseleave(function(e){
                    $("#infoObjetoVenta11").css("display", "none");
                    });
                    
                </script>
                

                <?php
                    
                echo "</div>"; //FIN DE div seccionSpotOpciones

                
            echo "</div>"; //FIN DE div contenido

        echo "</div>"; //FIN DE div moduloZona
        
        
        

