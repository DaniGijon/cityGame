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

                                echo "<div class='opcionesTienda'>";
                                    echo "<div class='opcionesTiendaCheckbox'>";
                                        echo '<input type="checkbox" name="cbox1" value="sacoPatatas">';
                                    echo "</div>";
                                    echo "<div class='opcionesTiendaTitulo'>";
                                        echo 'Saco de Patatas';
                                    echo "</div>";
                                    echo '<label for="cbox3"><div id="opcionBox">' . $imagenSacoPatatas . '</div><div class="monedaTienda"></div><div class="precioTienda">130</div></label>';
                                echo "</div>";
                                
                                echo "<div class='opcionesTienda'>";
                                    echo "<div class='opcionesTiendaCheckbox'>";
                                        echo '<input type="checkbox" name="cbox1" value="sandia">';
                                    echo "</div>";
                                    echo "<div class='opcionesTiendaTitulo'>";
                                        echo 'Sandía Hermosa';
                                    echo "</div>";
                                    echo '<label for="cbox3"><div id="opcionBox">' . $imagenSandia . '</div><div class="monedaTienda"></div><div class="precioTienda">150</div></label>';
                                echo "</div>";
                                
                                echo "<div class='opcionesTienda'>";
                                    echo "<div class='opcionesTiendaCheckbox'>";
                                        echo '<input type="checkbox" name="cbox1" value="sombreroAventurero">';
                                    echo "</div>";
                                    echo "<div class='opcionesTiendaTitulo'>";
                                        echo 'Sombrero Aventurero';
                                    echo "</div>";
                                    echo '<label for="cbox3"><div id="opcionBox">' . $imagenSombreroAventurero . '</div><div class="monedaTienda"></div><div class="precioTienda">270</div></label>';
                                echo "</div>";
                                
                                echo "<div class='opcionesTienda'>";
                                    echo "<div class='opcionesTiendaCheckbox'>";
                                        echo '<input type="checkbox" name="cbox1" value="gallo">';
                                    echo "</div>";
                                    echo "<div class='opcionesTiendaTitulo'>";
                                        echo 'Gallo Doméstico';
                                    echo "</div>";
                                    echo '<label for="cbox3"><div id="opcionBox">' . $imagenGallo . '</div><div class="monedaTienda"></div><div class="precioTienda">500</div></label>';
                                echo "</div>";
                                
                                echo "<div class='opcionesTienda'>";
                                    echo "<div class='opcionesTiendaCheckbox'>";
                                        echo '<input type="checkbox" name="cbox1" value="mochilaGrande">';
                                    echo "</div>";
                                    echo "<div class='opcionesTiendaTitulo'>";
                                        echo 'Mochila Grande';
                                    echo "</div>";
                                    echo '<label for="cbox3"><div id="opcionBox">' . $imagenMochilaGrande . '</div><div class="monedaTienda"></div><div class="precioTienda">900</div></label>';
                                echo "</div>";
                                
                                echo "<div class='opcionesTienda'>";
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
                                    echo "<input type='submit' class='botonCarrilBici' value=' '>";
                                echo "</div>";
                                /*echo " Llevo " . $dineroEnCash . "€ en el bolsillo.<br><br>"; */
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
                    
                </script>
                

                <?php
                    
                echo "</div>"; //FIN DE div seccionSpotOpciones

                
            echo "</div>"; //FIN DE div contenido

        echo "</div>"; //FIN DE div moduloZona
        
        
        

