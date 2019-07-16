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
                echo "<h4>" . getNombreSpot(21) . "</h4>";
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
                    //INFOOBJETO 307
                     echo "<div id='infoObjeto307' class='infoObjeto'>";
                    $result = getObjeto(307);
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
                //FIN INFOOBJETO 307
                //INFOOBJETO 109
                     echo "<div id='infoObjeto109' class='infoObjeto'>";
                    $result = getObjeto(109);
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
                //FIN INFOOBJETO 109
                //INFOOBJETO 407
                     echo "<div id='infoObjeto407' class='infoObjeto'>";
                    $result = getObjeto(407);
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
                //FIN INFOOBJETO 927
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
                                    echo "\"¡Hola! Bienvenido a PescaBass: Lo coges, pagas y te vas JAJA\"";
                                echo "</div>"; //FIN textoDependiente
                                echo "<div class='imagenDependiente'>";
                                    echo '<img src="/design/img/dependientes/pescaBass.png">';
                                echo "</div>"; //FIN imagenDependiente
                                $imagenCañaPesca = getFotoObjeto(307);
                                $imagenSombreroPescador = getFotoObjeto(109);
                                $imagenBotasPescador = getFotoObjeto(407);

                                echo "<div class='opcionesTienda " . 307 . "'>";
                                    echo "<div class='opcionesTiendaCheckbox'>";
                                        echo '<input type="checkbox" name="cbox1" value="cañaPesca">';
                                    echo "</div>";
                                    echo "<div class='opcionesTiendaTitulo'>";
                                        echo 'Caña de Pesca';
                                    echo "</div>";
                                    echo '<label for="cbox3"><div id="opcionBox">' . $imagenCañaPesca . '</div><div class="monedaTienda"></div><div class="precioTienda">130</div></label>';
                                echo "</div>";
                                
                                echo "<div class='opcionesTienda " . 109 . "'>";
                                    echo "<div class='opcionesTiendaCheckbox'>";
                                        echo '<input type="checkbox" name="cbox1" value="sombreroPescador">';
                                    echo "</div>";
                                    echo "<div class='opcionesTiendaTitulo'>";
                                        echo 'Sombrero Pescador';
                                    echo "</div>";
                                    echo '<label for="cbox3"><div id="opcionBox">' . $imagenSombreroPescador . '</div><div class="monedaTienda"></div><div class="precioTienda">100</div></label>';
                                echo "</div>";
                                
                                echo "<div class='opcionesTienda " . 407 . "'>";
                                    echo "<div class='opcionesTiendaCheckbox'>";
                                        echo '<input type="checkbox" name="cbox1" value="botasPescador">';
                                    echo "</div>";
                                    echo "<div class='opcionesTiendaTitulo'>";
                                        echo 'Botas de Pescador';
                                    echo "</div>";
                                    echo '<label for="cbox3"><div id="opcionBox">' . $imagenBotasPescador . '</div><div class="monedaTienda"></div><div class="precioTienda">100</div></label>';
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
                                    echo "\"¡Ajá! Así que vienes para encasquetarme cosas... JAJAJA ¡Qué sinvergüenza!\"";
                                echo "</div>"; //FIN textoDependiente
                                echo "<div class='imagenDependiente'>";
                                    echo '<img src="/design/img/dependientes/pescaBass.png">';
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
                            echo '<iframe width="300" height="225" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.openstreetmap.org/export/embed.html?bbox=-4.1127920150756845%2C38.681749373255805%2C-4.098994731903077%2C38.687603430912894&amp;layer=mapnik&amp;marker=38.684672389459415%2C-4.105891227591201" style="border: 1px solid black"></iframe><br/><br>';    
                        echo "</div>";
                        echo "<div class = 'semiTransparente'>";
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
                        echo "</div>";//fin semiTransparente
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
                        $("#botonVender").css("background-color", "rgba(255, 249, 192, 0.7)");
                        $("#botonComprar").css("background-color", "white");
                    });

                      $("#botonComprar").click(function(){
                        $("#comprar").show();
                        $("#vender").hide();
                        $("#botonComprar").css("background-color", "rgba(255, 249, 192, 0.7)");
                        $("#botonVender").css("background-color", "white");
                    });
                    
                    $(".307").mouseenter(function(e){
                    $("#infoObjeto307").css("left", e.pageX - 300);
                    $("#infoObjeto307").css("top", e.pageY - 200);
                    $("#infoObjeto307").css("display", "block");
                    });
                    
                    $(".307").mouseleave(function(e){
                    $("#infoObjeto307").css("display", "none");
                    });
                    
                    $(".109").mouseenter(function(e){
                    $("#infoObjeto109").css("left", e.pageX - 300);
                    $("#infoObjeto109").css("top", e.pageY - 200);
                    $("#infoObjeto109").css("display", "block");
                    });
                    
                    $(".109").mouseleave(function(e){
                    $("#infoObjeto109").css("display", "none");
                    });
                    
                    $(".407").mouseenter(function(e){
                    $("#infoObjeto407").css("left", e.pageX - 300);
                    $("#infoObjeto407").css("top", e.pageY - 200);
                    $("#infoObjeto407").css("display", "block");
                    });
                    
                    $(".407").mouseleave(function(e){
                    $("#infoObjeto407").css("display", "none");
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
        
        
        
