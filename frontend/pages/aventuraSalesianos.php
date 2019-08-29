<?php
global $db;
        include (__ROOT__.'/backend/comprobaciones.php');
        include (__ROOT__.'/backend/getFotos.php');
        $id = $_SESSION['loggedIn'];
        comprobarZona1Barrio5();
        $estoyLibre = comprobarEspera();
        if($estoyLibre === 1){

            echo "<div id='moduloZona'>";
            echo "<span class = 'tituloSpot'>";
                echo "<h4>" . getNombreSpot(71) . "</h4>";
            echo "</span>";

                echo "<div class='contenido'>";
                echo "<span class='contenedor1'>"; 
                   

                    echo "<div class='seccionSpotOpciones'>";
                    echo "<div id='botonesComprarVender'>";
                        echo "<button id='botonComprar' class='tagTiendaComprar'>Parroquia</button>";
                        echo "<button id='botonVender' class='tagTiendaVender'>Altar</button>";
                    echo "</div>";
                    echo "<div class='semiTransparente'>"; 
                    echo "<div id='parroquia'>";
                        echo "<div class='textoDependiente'>";
                            echo "\"Mmm. Así que aquí fue donde comenzó todo el movimiento salesiano\".";
                        echo "</div>"; //FIN textoDependiente
                        echo "<div class='imagenDependiente'>";
                            echo '<img src="/design/img/dependientes/yoHombre.png">';
                        echo "</div>"; //FIN imagenDependiente
                    
                    echo "<form id = 'selectorOpciones' action='?bPage=aventuras&action=zona&nonUI' method='post'>";
                        echo "<div class='opcionesTienda'>";
                            echo "<div class='opcionesTiendaCheckbox'>";
                                echo '<input type="checkbox" name="cbox1" value="aventuraSalesianos">';
                            echo "</div>";
                            echo "<div class='opcionesTiendaTitulo'>";
                                echo 'Quitar la Palabra a Dios';
                            echo "</div>";
                            echo '<label for="cbox3"><div id="opcionBox">' . '<img src="/design/img/entrenamiento/ritmitoGeneroso.png">' . '</div><div class="relojMini"></div><div class="precioTienda">10M</div></label>';
                        echo "</div>";
                        
                        echo "<div class='opcionesTienda'>";
                            echo "<div class='opcionesTiendaCheckbox'>";
                                echo '<input type="checkbox" name="cbox1" value="aventuraSalesianosDebil">';
                            echo "</div>";
                            echo "<div class='opcionesTiendaTitulo'>";
                                echo 'Difundir Blasfemias';
                            echo "</div>";
                            echo '<label for="cbox3"><div id="opcionBox">' . '<img src="/design/img/entrenamiento/ritmitoGeneroso.png">' . '</div><div class="relojMini"></div><div class="precioTienda">10M</div></label>';
                        echo "</div>";
                        
                        echo "<div class='submitTienda'>";
                            echo "<input type='submit' class='botonCarrilBici' value=' '>";
                        echo "</div>";
                    echo "</form>"; 
                    echo "</div>"; //FIN parroquia
                    
                    echo "<div id='altar'>";
                $mostrar = comprobarMision(18);
                $progreso = comprobarProgreso(18);
                    echo "<div class='textoDependiente'>";
                            if($mostrar === 1){ //Está activada y en progreso en                
                                $descripcionZona = getDescripcionMision(18, $progreso);
                                echo $descripcionZona;
                                $recompensa = getRecompensaMision(18, $progreso);
                                echo $recompensa;
                                
                            }
                            elseif($mostrar === 2){ //Aun no esta activada
                                echo "\"Oye, disculpa. ¿Nos quieres casar tú? El cura no aparece y los invitados tienen ya más hambre que el tamagochi un sordo\".";
                            }
                            else{ //L mision ya esta completada
                                echo "¿No se casa nadie hoy? Pues vaya.";
                            }
                        echo "</div>"; //FIN textoDependiente
                        echo "<div class='imagenDependiente'>";
                            if($mostrar === 2 || ($mostrar === 1)){ //Aún no está activada o lo está pero no completada
                                echo '<img src="/design/img/dependientes/novios.png">';
                            }
                            else{ //Si ya he completado la misión
                                echo '<img src="/design/img/dependientes/yoHombre.png">';
                            }
                        echo "</div>"; //FIN imagenDependiente
                        
                    if($mostrar != 0){
                        echo '<form id = "selectorOpciones" action="?bPage=actualizaciones&action=accionSpot&nonUI" method="post">';

                        echo "<div class='opcionesTienda'>";
                            echo "<div class='opcionesTiendaCheckbox'>";
                                echo '<input type="checkbox" name="cbox1" value="misionBoda">';
                            echo "</div>";
                            echo "<div class='opcionesTiendaTitulo'>";
                                echo '¡Misión Boda!';
                            echo "</div>";
                            if($progreso === '1'){
                                echo '<label for="cbox3"><div id="opcionBox">' . '<img src="/design/img/bar/cafeConLeche">' . '</div><div class="relojMini"></div><div class="precioTienda">10M</div></label>';
                            }
                            elseif($progreso === '2'){
                                echo '<label for="cbox3"><div id="opcionBox">' . '<img src="/design/img/bar/cafeConLeche">' . '</div><div class="relojMini"></div><div class="precioTienda">10M</div></label>';
                            }
                            else{
                                echo '<label for="cbox3"><div id="opcionBox">' . '<img src="/design/img/bar/cafeConLeche">' . '</div><div class="relojMini"></div><div class="precioTienda">2 etapas</div></label>';
                            }
                        echo "</div>";

                            echo "<div class='submitTienda'>";
                                echo'<input type="submit" class="botonMision" value=" ">';
                            echo "</div>";
                        echo "</form>";  
                    }
                
                echo "</div>"; //Fin Altar
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
                            
                            if (valor === 'aventuraSalesianos') {
                                $(".opcionSpot1").show();
                                $(".opcionSpot2").hide();
                                $(".opcionSpot0").hide();
                            }
                            else if (valor === 'aventuraSalesianosDebil'){
                                $(".opcionSpot2").show();
                                $(".opcionSpot1").hide();
                                $(".opcionSpot0").hide();

                            }
                        });
                        
                    $("#botonVender").click(function(){
                        $("#parroquia").hide();
                        $("#altar").show();
                        $("#botonVender").css("background-color", "rgba(255, 249, 192, 0.7)");
                        $("#botonComprar").css("background-color", "white");
                    });

                      $("#botonComprar").click(function(){
                        $("#parroquia").show();
                        $("#altar").hide();
                        $("#botonComprar").css("background-color", "rgba(255, 249, 192, 0.7)");
                        $("#botonVender").css("background-color", "white");
                    });
                        
                    </script>

                    <?php
                    echo "</div>"; //FIN de semiTransparente
                    echo "</div>"; //FIN DE div seccionSpotOpciones
                    echo "</span>"; //Fin de Contenedor1
                    
                    echo "<span class='contenedor2'>";
                            
                            echo "<div class='opcionSpot0 opcionSpot' style='display: inline'>";
                                echo "<div class='seccionDescripcionZonaImagen'>";
                                    echo "<div class='seccionSpotImagen'>" ;
                                        $spotImagen = getFotoSpot(71);
                                        echo $spotImagen;
                                    echo "</div>";
                                echo "</div>";
                               
                            echo "</div>"; //FIN opcionSpot0
                        
                            echo "<div class='opcionSpot1 opcionSpot'>";
                                echo "<div class='seccionDescripcionZonaImagen'>";
                                    $imagenSpot = "<img src='/design/img/entrenamiento/carrilBici1.png'>";
                                    echo $imagenSpot;
                                echo "</div>";
                                echo "<div class='seccionDescripcionZonaTexto'>";
                                    echo "<div class='semiTransparente' style='border-radius: 0px 0px 10px 10px'>";
                                        echo "<span class='textoDescripcionSpot'>";
                                            $descripcionZona = "Me enfrentaré al Clero y a su fuerte poder religioso.";
                                            echo $descripcionZona;
                                        echo "</span>";
                                    echo "</div>";//Fin SemiTransparente
                                echo "</div>"; //Fin seccionDescripcionZonaTexto
                            echo "</div>"; //FIN opcionSpot1
                            
                            echo "<div class='opcionSpot2 opcionSpot'>";
                                echo "<div class='seccionDescripcionZonaImagen'>";
                                    $imagenSpot = "<img src='/design/img/entrenamiento/carrilBici2.png'>";
                                    echo $imagenSpot;
                                echo "</div>";
                                echo "<div class='seccionDescripcionZonaTexto'>";
                                    echo "<div class='semiTransparente' style='border-radius: 0px 0px 10px 10px'>";
                                        echo "<span class='textoDescripcionSpot'>";
                                            $descripcionZona = "Intentaré abrir las mentes de esos pobres adeptos, pero desde el anonimato.";
                                            echo $descripcionZona;
                                        echo "</span>";
                                    echo "</div>";//Fin de semiTransparente
                                echo "</div>"; //Fin descripcionZonaTexto
                            echo "</div>"; //FIN opcionSpot2
                       
                    echo "</span>"; //FIN de contenedor2


                echo "</div>"; //FIN DE div contenido

            echo "</div>"; //FIN DE div moduloZona

        }
        else{
            header("location: ?page=zona&nonUI&message=Aun no he descansado de mi última acción");
        }
