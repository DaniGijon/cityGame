<?php
global $db;
        include (__ROOT__.'/backend/comprobaciones.php');
        include (__ROOT__.'/backend/getFotos.php');
        $id = $_SESSION['loggedIn'];
        comprobarZona1Barrio2();
        $estoyLibre = comprobarEspera();
        if($estoyLibre === 1){

            echo "<div id='moduloZona'>";
            echo "<span class = 'tituloSpot'>";
                echo "<h4>" . getNombreSpot(27) . "</h4>";
            echo "</span>";

                echo "<div class='contenido'>";
                echo "<span class='contenedor1'>";

                    echo "<div class='seccionSpotOpciones'>";
                    echo "<div class='semiTransparente'>"; 
                        echo "<div class='textoDependiente'>";
                            echo "Entre el barullo del Bulevar siempre hay maleantes acechando.";
                        echo "</div>"; //FIN textoDependiente
                        echo "<div class='imagenDependiente'>";
                            echo '<img src="/design/img/dependientes/fogataRitual.png">';
                        echo "</div>"; //FIN imagenDependiente
                   
                    
                    echo "<form id = 'selectorOpciones' action='?bPage=aventuras&action=zona&nonUI' method='post'>";
                        echo "<div class='opcionesTienda'>";
                            echo "<div class='opcionesTiendaCheckbox'>";
                                echo '<input type="checkbox" name="cbox1" value="aventuraBulevar">';
                            echo "</div>";
                            echo "<div class='opcionesTiendaTitulo'>";
                                echo 'Buscar jaleo y aventuras';
                            echo "</div>";
                            echo '<label for="cbox3"><div id="opcionBox">' . '<img src="/design/img/entrenamiento/ritmitoGeneroso.png">' . '</div><div class="relojMini"></div><div class="precioTienda">10M</div></label>';
                        echo "</div>";
                        
                        echo "<div class='opcionesTienda'>";
                            echo "<div class='opcionesTiendaCheckbox'>";
                                echo '<input type="checkbox" name="cbox1" value="aventuraBulevarDebil">';
                            echo "</div>";
                            echo "<div class='opcionesTiendaTitulo'>";
                                echo 'Andar con cuidado';
                            echo "</div>";
                            echo '<label for="cbox3"><div id="opcionBox">' . '<img src="/design/img/entrenamiento/ritmitoGeneroso.png">' . '</div><div class="relojMini"></div><div class="precioTienda">10M</div></label>';
                        echo "</div>";
                        
                        echo "<div class='submitTienda'>";
                            echo "<input type='submit' class='botonAventura' value=' '>";
                        echo "</div>";
                    echo "</form>";           
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
                            
                            if (valor === 'aventuraBulevar') {
                                $(".opcionSpot1").show();
                                $(".opcionSpot2").hide();
                                $(".opcionSpot0").hide();
                            }
                            else if (valor === 'aventuraBulevarDebil'){
                                $(".opcionSpot2").show();
                                $(".opcionSpot1").hide();
                                $(".opcionSpot0").hide();
                            }
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
                                        $spotImagen = getFotoSpot(27);
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
                           
                                    echo "<span class='textoDescripcionSpot'>";
                                        echo "<div class='semiTransparente' style='border-radius: 0px 0px 10px 10px'>";
                                            $descripcionZona = "Mezclarme de lleno con toda la chusma del barrio mercader a ver qué me encuentro.";
                                            echo $descripcionZona;
                                        echo "</div>";
                                    echo "</span>";
                                echo "</div>"; //Fin seccionDescripcionZonaTexto
                            echo "</div>"; //FIN opcionSpot1
                            
                            echo "<div class='opcionSpot2 opcionSpot'>";
                                echo "<div class='seccionDescripcionZonaImagen'>";
                                    $imagenSpot = "<img src='/design/img/entrenamiento/carrilBici2.png'>";
                                    echo $imagenSpot;
                                echo "</div>";
                                echo "<div class='seccionDescripcionZonaTexto'>";
                        
                                    echo "<span class='textoDescripcionSpot'>";
                                        echo "<div class='semiTransparente' style='border-radius: 0px 0px 10px 10px'>";
                                            $descripcionZona = "Intentaré pasar por el Bulevar Comercial sin meterme en líos gordos.";
                                            echo $descripcionZona;
                                        echo "</div>";
                                    echo "</span>";
                                echo "</div>"; //Fin descripcionZonaTexto
                            echo "</div>"; //FIN opcionSpot2
                       
                    echo "</span>"; //FIN de contenedor2


                echo "</div>"; //FIN DE div contenido

            echo "</div>"; //FIN DE div moduloZona

        }
        else{
            header("location: ?page=zona&nonUI&message=Aun no he descansado de mi última acción");
        }