<?php
global $db;
        include (__ROOT__.'/backend/comprobaciones.php');
        include (__ROOT__.'/backend/getFotos.php');
        $id = $_SESSION['loggedIn'];
        comprobarZona3Barrio9();
        
        echo "<div id='moduloZona'>";
            echo "<span class = 'tituloSpot'>";
                echo "<h4>" . getNombreSpot(171) . "</h4>";
            echo "</span>";
            
            echo "<div class='contenido'>";
            
            echo "<span class='contenedor1'>"; 
               
                echo "<div class='seccionSpotOpciones'>";   
                    //Cabecera selector opciones
                    echo "<div id='botonesComprarVender'>";
                        echo "<button id='botonComprar' class='tagTiendaComprar'>Comprar</button>";
                        echo "<button id='botonVender' class='tagTiendaVender'>Vender</button>";
                        echo "<button id='botonCharlar' class='tagTiendaVender'>Charlar</button>";
                    echo "</div>";
                    echo "<div class='semiTransparente'>"; 
                    //INFOOBJETO 924
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
                //FIN INFOOBJETO 924
                //INFOOBJETO 925
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
                //FIN INFOOBJETO 925
                //INFOOBJETO 110
                     echo "<div id='infoObjeto110' class='infoObjeto'>";
                    $result = getObjeto(110);
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
                ////INFOOBJETO 22
                     echo "<div id='infoObjeto22' class='infoObjeto'>";
                    $result = getObjeto(22);
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
                //FIN INFOOBJETO 22
                //INFOOBJETO 3
                     echo "<div id='infoObjeto3' class='infoObjeto'>";
                    $result = getObjeto(3);
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
                     echo "<div id='infoObjeto506' class='infoObjeto'>";
                    $result = getObjeto(506);
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
                                    echo "\"Todo barato, nena. ¡Me lo quitan de las maaaaanos!\"";
                                echo "</div>"; //FIN textoDependiente
                                echo "<div class='imagenDependiente'>";
                                    echo '<img src="/design/img/dependientes/mercadilloVendedor.png">';
                                echo "</div>"; //FIN imagenDependiente
                                $imagenSacoPatatas = getFotoObjeto(924);
                                $imagenSandia = getFotoObjeto(925);
                                $imagenSombreroAventurero = getFotoObjeto(110);
                                $imagenAlfombraMagica = getFotoObjeto(22);
                                $imagenGallo = getFotoObjeto(3);
                                $imagenMochilaGrande = getFotoObjeto(506);

                                echo "<div class='opcionesTienda " . 924 . "'>";
                                    echo "<div class='opcionesTiendaCheckbox'>";
                                        echo '<input type="checkbox" name="cbox1" value="sacoPatatas">';
                                    echo "</div>";
                                    echo "<div class='opcionesTiendaTitulo'>";
                                        echo 'Saco de Patatas';
                                    echo "</div>";
                                    echo '<label for="cbox3"><div id="opcionBox">' . $imagenSacoPatatas . '</div><div class="monedaTienda"></div><div class="precioTienda">130</div></label>';
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
                                
                                echo "<div class='opcionesTienda " . 110 . "'>";
                                    echo "<div class='opcionesTiendaCheckbox'>";
                                        echo '<input type="checkbox" name="cbox1" value="sombreroAventurero">';
                                    echo "</div>";
                                    echo "<div class='opcionesTiendaTitulo'>";
                                        echo 'Sombrero Aventurero';
                                    echo "</div>";
                                    echo '<label for="cbox3"><div id="opcionBox">' . $imagenSombreroAventurero . '</div><div class="monedaTienda"></div><div class="precioTienda">270</div></label>';
                                echo "</div>";
                                
                                echo "<div class='opcionesTienda " . 3 . "'>";
                                    echo "<div class='opcionesTiendaCheckbox'>";
                                        echo '<input type="checkbox" name="cbox1" value="gallo">';
                                    echo "</div>";
                                    echo "<div class='opcionesTiendaTitulo'>";
                                        echo 'Gallo Doméstico';
                                    echo "</div>";
                                    echo '<label for="cbox3"><div id="opcionBox">' . $imagenGallo . '</div><div class="monedaTienda"></div><div class="precioTienda">500</div></label>';
                                echo "</div>";
                                
                                echo "<div class='opcionesTienda " . 506 . "'>";
                                    echo "<div class='opcionesTiendaCheckbox'>";
                                        echo '<input type="checkbox" name="cbox1" value="mochilaGrande">';
                                    echo "</div>";
                                    echo "<div class='opcionesTiendaTitulo'>";
                                        echo 'Mochila Grande';
                                    echo "</div>";
                                    echo '<label for="cbox3"><div id="opcionBox">' . $imagenMochilaGrande . '</div><div class="monedaTienda"></div><div class="precioTienda">900</div></label>';
                                echo "</div>";
                                
                                echo "<div class='opcionesTienda " . 22 . "'>";
                                    echo "<div class='opcionesTiendaCheckbox'>";
                                        echo '<input type="checkbox" name="cbox1" value="alfombraMagica">';
                                    echo "</div>";
                                    echo "<div class='opcionesTiendaTitulo'>";
                                        echo 'Alfombra Mágica';
                                    echo "</div>";
                                    echo '<label for="cbox3"><div id="opcionBox">' . $imagenAlfombraMagica . '</div><div class="monedaTienda"></div><div class="precioTienda">3000</div></label>';
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
                                    echo "\"Qué guapo eso que llevas ahí.<br>¿Me lo dejas?\"";
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
                        
                        echo "<div id='charlar'>";
                            $mostrar = comprobarMision(11);
                            $progreso = comprobarProgreso(11);
                            echo "<div class='textoDependiente'>";
                            if($mostrar === 2){ //Aun no he comenzado la mision
                                echo "\"Levantaré el negocio familiar desde las cenizas y dominaré el Mercadillo.\"";
                            }
                            elseif($mostrar === 1){ //Está activada y en progreso
                                $descripcionZona = getDescripcionMision(11, $progreso);
                                echo $descripcionZona;
                                $recompensa = getRecompensaMision(11, $progreso);
                                echo $recompensa; 
                            }
                            else{
                                echo "¿Quién es la última para la fruta?";
                            }
                        echo "</div>"; //FIN textoDependiente
                        echo "<div class='imagenDependiente'>";
                            if($mostrar === 0)
                                echo '<img src="/design/img/dependientes/yoHombre.png">';
                            else
                                echo '<img src="/design/img/dependientes/mercadilloVendedor2.png">';
                        echo "</div>"; //FIN imagenDependiente
                        if($mostrar != 0){
                            echo '<form id = "selectorOpciones" action="?bPage=actualizaciones&action=accionSpot&nonUI" method="post">';
                                echo "<div class='opcionesTienda'>";
                                    echo "<div class='opcionesTiendaCheckbox'>";
                                        echo '<input type="checkbox" name="cbox1" value="misionCenizas">';
                                    echo "</div>";
                                    echo "<div class='opcionesTiendaTitulo'>";
                                        echo '¡Misión Cenizas!';
                                    echo "</div>";
                                    echo '<label for="cbox3"><div id="opcionBox">' . '<img src="/design/img/bar/cafeConLeche">' . '</div><div class="monedaTienda"></div><div class="precioTienda">4 Etapas</div></label>';
                                echo "</div>";
                                echo "<div class='submitTienda'>";
                                    echo "<input type='submit' class='botonMision' value=' '>";
                                echo "</div>";
                            echo '</form>';
                        }
                        echo "</div>"; //Fin Charlar
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
                    
                    $(".110").mouseenter(function(e){
                    $("#infoObjeto110").css("left", e.pageX - 300);
                    $("#infoObjeto110").css("top", e.pageY - 200);
                    $("#infoObjeto110").css("display", "block");
                    });
                    
                    $(".110").mouseleave(function(e){
                    $("#infoObjeto110").css("display", "none");
                    });
                    
                    $(".22").mouseenter(function(e){
                    $("#infoObjeto22").css("left", e.pageX - 300);
                    $("#infoObjeto22").css("top", e.pageY - 200);
                    $("#infoObjeto22").css("display", "block");
                    });
                    
                    $(".22").mouseleave(function(e){
                    $("#infoObjeto22").css("display", "none");
                    });
                    
                    $(".3").mouseenter(function(e){
                    $("#infoObjeto3").css("left", e.pageX - 300);
                    $("#infoObjeto3").css("top", e.pageY - 200);
                    $("#infoObjeto3").css("display", "block");
                    });
                    
                    $(".3").mouseleave(function(e){
                    $("#infoObjeto3").css("display", "none");
                    });
                    
                    $(".506").mouseenter(function(e){
                    $("#infoObjeto506").css("left", e.pageX - 300);
                    $("#infoObjeto506").css("top", e.pageY - 200);
                    $("#infoObjeto506").css("display", "block");
                    });
                    
                    $(".506").mouseleave(function(e){
                    $("#infoObjeto506").css("display", "none");
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
        
        
        

