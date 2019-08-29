<?php
global $db;
        include (__ROOT__.'/backend/comprobaciones.php');
        include (__ROOT__.'/backend/getFotos.php');
        $id = $_SESSION['loggedIn'];
        comprobarZona2Barrio5();
        
        echo "<div id='moduloZona'>";
            echo "<span class = 'tituloSpot'>";
                echo "<h4>" . getNombreSpot(82) . "</h4>";
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
                    //INFOOBJETO 924
                     echo "<div id='infoObjeto311' class='infoObjeto objetoMano'>";
                    $result = getObjeto(311);
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
                //FIN INFOOBJETO 924
                //INFOOBJETO 925
                     echo "<div id='infoObjeto924' class='infoObjeto'>";
                    $result = getObjeto(924);
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
                //FIN INFOOBJETO 925
                //INFOOBJETO 110
                     echo "<div id='infoObjeto928' class='infoObjeto'>";
                    $result = getObjeto(928);
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
                //FIN INFOOBJETO 110
                //INFOOBJETO 110
                     echo "<div id='infoObjeto925' class='infoObjeto'>";
                    $result = getObjeto(925);
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
                //FIN INFOOBJETO 110
                //INFOOBJETO 3
                     echo "<div id='infoObjeto930' class='infoObjeto'>";
                    $result = getObjeto(930);
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
                //FIN INFOOBJETO 3
                //INFOOBJETO 506
                     echo "<div id='infoObjeto931' class='infoObjeto'>";
                    $result = getObjeto(931);
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
                //FIN INFOOBJETO 506
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
                                    echo "\"Los mejores productos de alimentación. Todo fresquito\".";
                                echo "</div>"; //FIN textoDependiente
                                echo "<div class='imagenDependiente'>";
                                    echo '<img src="/design/img/dependientes/mercadilloVendedor.png">';
                                echo "</div>"; //FIN imagenDependiente
                                $imagenSacoPatatas = getFotoObjeto(924);
                                $imagenSandia = getFotoObjeto(925);
                                $imagenBarraPan = getFotoObjeto(311);
                                $imagenBerenjenas = getFotoObjeto(930);
                                $imagenPiezaFruta = getFotoObjeto(928);
                                $imagenQueso = getFotoObjeto(931);

                                echo "<div class='opcionesTienda " . 311 . "'>";
                                    echo "<div class='opcionesTiendaCheckbox'>";
                                        echo '<input type="checkbox" name="cbox1" value="barraPan">';
                                    echo "</div>";
                                    echo "<div class='opcionesTiendaTitulo'>";
                                        echo 'Barra de Pan Duro';
                                    echo "</div>";
                                    echo '<label for="cbox3"><div id="opcionBox">' . $imagenBarraPan . '</div><div class="monedaTienda"></div><div class="precioTienda">60</div></label>';
                                echo "</div>";
                                
                                echo "<div class='opcionesTienda " . 924 . "'>";
                                    echo "<div class='opcionesTiendaCheckbox'>";
                                        echo '<input type="checkbox" name="cbox1" value="sacoPatatas">';
                                    echo "</div>";
                                    echo "<div class='opcionesTiendaTitulo'>";
                                        echo 'Saco de Patatas';
                                    echo "</div>";
                                    echo '<label for="cbox3"><div id="opcionBox">' . $imagenSacoPatatas . '</div><div class="monedaTienda"></div><div class="precioTienda">130</div></label>';
                                echo "</div>";
                                
                                echo "<div class='opcionesTienda " . 928 . "'>";
                                    echo "<div class='opcionesTiendaCheckbox'>";
                                        echo '<input type="checkbox" name="cbox1" value="frutaFresca">';
                                    echo "</div>";
                                    echo "<div class='opcionesTiendaTitulo'>";
                                        echo 'Pieza de Fruta Fresca';
                                    echo "</div>";
                                    echo '<label for="cbox3"><div id="opcionBox">' . $imagenPiezaFruta . '</div><div class="monedaTienda"></div><div class="precioTienda">30</div></label>';
                                echo "</div>";
                                
                                echo "<div class='opcionesTienda " . 925 . "'>";
                                    echo "<div class='opcionesTiendaCheckbox'>";
                                        echo '<input type="checkbox" name="cbox1" value="sandia">';
                                    echo "</div>";
                                    echo "<div class='opcionesTiendaTitulo'>";
                                        echo 'Sandía Hermosa';
                                    echo "</div>";
                                    echo '<label for="cbox3"><div id="opcionBox">' . $imagenSandia . '</div><div class="monedaTienda"></div><div class="precioTienda">150</div></label>';
                                echo "</div>";
                                
                                
                                
                                echo "<div class='opcionesTienda " . 930 . "'>";
                                    echo "<div class='opcionesTiendaCheckbox'>";
                                        echo '<input type="checkbox" name="cbox1" value="berenjenasAlmagro">';
                                    echo "</div>";
                                    echo "<div class='opcionesTiendaTitulo'>";
                                        echo 'Berenjenas de Almagro';
                                    echo "</div>";
                                    echo '<label for="cbox3"><div id="opcionBox">' . $imagenBerenjenas . '</div><div class="monedaTienda"></div><div class="precioTienda">250</div></label>';
                                echo "</div>";
                                
                                echo "<div class='opcionesTienda " . 931 . "'>";
                                    echo "<div class='opcionesTiendaCheckbox'>";
                                        echo '<input type="checkbox" name="cbox1" value="quesoEspeciado">';
                                    echo "</div>";
                                    echo "<div class='opcionesTiendaTitulo'>";
                                        echo 'Queso Especiado';
                                    echo "</div>";
                                    echo '<label for="cbox3"><div id="opcionBox">' . $imagenQueso . '</div><div class="monedaTienda"></div><div class="precioTienda">400</div></label>';
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
                                    echo "\"Ve al grano. ¿Qué objeto quieres venderme?\"";
                                echo "</div>"; //FIN textoDependiente
                                echo "<div class='imagenDependiente'>";
                                    echo '<img src="/design/img/dependientes/mercadilloVendedor.png">';
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
                                    echo "<input type='submit' class='botonCarrilBici' value=' '>";
                                echo "</div>";
                                $miDinero = comprobarDinero();
                                $dineroEnCash = $miDinero[0]['cash'];
                                echo "<br>Llevo " . $dineroEnCash . " <img src='/design/img/iconos/monedaTop.png' style='vertical-align: bottom'>" . " en el bolsillo.";

                                echo '</form>';
                        echo "</div>"; //Fin Vender
                        
                    echo "</div>"; //Fin SemiTransparente
                echo "</div>"; //FIN seccionSpotOpciones
                
                echo "</span>"; //FIN Contenedor1
                
                echo "<span class='contenedor2'>";
                
                echo "<div class='seccionSpotInfo'>";
                    echo "<div class = 'seccionContacto'>";
                        echo "<div class = 'mapaCallejero'>";
                            echo '<iframe width="300" height="225" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.openstreetmap.org/export/embed.html?bbox=-4.117650033222163%2C38.69556212183247%2C-4.090055466876947%2C38.706447011760886&amp;layer=mapnik&amp;marker=38.7010047738897%2C-4.103852750049555" style="border: 1px solid black"></iframe><br/><br>';    
                        echo "</div>";
                        echo "<div class = 'semiTransparente'>";
                        echo "<div class = 'infoSpot'>";
                            echo "<table border = '0' style = 'text-align:left'>";
                                echo "<tr>";
                                    echo "<td><div class='mapaMini'></div> Recinto Ferial, S/N<br></td>";
                                echo "</tr>";
                                echo "<tr>";
                                echo "<td><div class='telefonoMini'></div> -<br></td>";
                                echo "</tr>";
                                echo "<tr>";
                                echo "<td><div class='relojMini'></div> 09:00 - 14:00 Sábado</td>";
                                echo "</tr>";
                            echo "</table>";
                        echo "</div>";
                        echo "</div>";//fin semiTransparente
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
                        $("#charlar").hide();
                        $("#botonVender").css("background-color", "rgba(255, 249, 192, 0.7)");
                        $("#botonComprar").css("background-color", "white");
                        $("#botonCharlar").css("background-color", "white");
                    });

                      $("#botonComprar").click(function(){
                        $("#comprar").show();
                        $("#vender").hide();
                        $("#charlar").hide();
                        $("#botonComprar").css("background-color", "rgba(255, 249, 192, 0.7)");
                        $("#botonVender").css("background-color", "white");
                        $("#botonCharlar").css("background-color", "white");
                    });
                    
                    $("#botonCharlar").click(function(){
                        $("#charlar").show();
                        $("#comprar").hide();
                        $("#vender").hide();
                        $("#botonCharlar").css("background-color", "rgba(255, 249, 192, 0.7)");
                        $("#botonVender").css("background-color", "white");
                        $("#botonComprar").css("background-color", "white");
                    });
                    
                    
                    $(".924").mouseenter(function(e){
                    $("#infoObjeto924").css("left", e.pageX - 300);
                    $("#infoObjeto924").css("top", e.pageY - 200);
                    $("#infoObjeto924").css("display", "block");
                    });
                    
                    $(".924").mouseleave(function(e){
                    $("#infoObjeto924").css("display", "none");
                    });
                    
                    $(".925").mouseenter(function(e){
                    $("#infoObjeto925").css("left", e.pageX - 300);
                    $("#infoObjeto925").css("top", e.pageY - 200);
                    $("#infoObjeto925").css("display", "block");
                    });
                    
                    $(".925").mouseleave(function(e){
                    $("#infoObjeto925").css("display", "none");
                    });
                    
                    $(".311").mouseenter(function(e){
                    $("#infoObjeto311").css("left", e.pageX - 300);
                    $("#infoObjeto311").css("top", e.pageY - 200);
                    $("#infoObjeto311").css("display", "block");
                    });
                    
                    $(".311").mouseleave(function(e){
                    $("#infoObjeto311").css("display", "none");
                    });
                    
                    $(".928").mouseenter(function(e){
                    $("#infoObjeto928").css("left", e.pageX - 300);
                    $("#infoObjeto928").css("top", e.pageY - 200);
                    $("#infoObjeto928").css("display", "block");
                    });
                    
                    $(".928").mouseleave(function(e){
                    $("#infoObjeto928").css("display", "none");
                    });
                    
                    $(".930").mouseenter(function(e){
                    $("#infoObjeto930").css("left", e.pageX - 300);
                    $("#infoObjeto930").css("top", e.pageY - 200);
                    $("#infoObjeto930").css("display", "block");
                    });
                    
                    $(".930").mouseleave(function(e){
                    $("#infoObjeto930").css("display", "none");
                    });
                    
                    $(".931").mouseenter(function(e){
                    $("#infoObjeto931").css("left", e.pageX - 300);
                    $("#infoObjeto931").css("top", e.pageY - 200);
                    $("#infoObjeto931").css("display", "block");
                    });
                    
                    $(".931").mouseleave(function(e){
                    $("#infoObjeto931").css("display", "none");
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
        
        
        


