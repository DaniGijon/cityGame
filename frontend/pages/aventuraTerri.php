<?php
global $db;
        include (__ROOT__.'/backend/comprobaciones.php');
        include (__ROOT__.'/backend/getFotos.php');
        $id = $_SESSION['loggedIn'];
        comprobarZona2Barrio1();
        $estoyLibre = comprobarEspera();
        if($estoyLibre === 1){

            echo "<div id='moduloZona'>";
            echo "<span class = 'tituloSpot'>";
                echo "<h4>" . getNombreSpot(14) . "</h4>";
            echo "</span>";

                echo "<div class='contenido'>";
                echo "<span class='contenedor1'>";

                    echo "<div class='seccionSpotOpciones'>";
                    echo "<div class='semiTransparente'>"; 
                        echo "<div class='textoDependiente'>";
                            echo "Una estrecha gruta humeante conduce al interior del Terri.";
                        echo "</div>"; //FIN textoDependiente
                        echo "<div class='imagenDependiente'>";
                            echo '<img src="/design/img/dependientes/fogataRitual.png">';
                        echo "</div>"; //FIN imagenDependiente
                   
                    
                    echo "<form id = 'selectorOpciones' action='?bPage=aventuras&action=zona&nonUI' method='post'>";
                        echo "<div class='opcionesTienda'>";
                            echo "<div class='opcionesTiendaCheckbox'>";
                                echo '<input type="checkbox" name="cbox1" value="aventuraTerri">';
                            echo "</div>";
                            echo "<div class='opcionesTiendaTitulo'>";
                                echo 'Explorar Terri adentro';
                            echo "</div>";
                            echo '<label for="cbox3"><div id="opcionBox">' . '<img src="/design/img/entrenamiento/ritmitoGeneroso.png">' . '</div><div class="relojMini"></div><div class="precioTienda">10M</div></label>';
                        echo "</div>";
                        
                        echo "<div class='opcionesTienda'>";
                            echo "<div class='opcionesTiendaCheckbox'>";
                                echo '<input type="checkbox" name="cbox1" value="aventuraTerriDebil">';
                            echo "</div>";
                            echo "<div class='opcionesTiendaTitulo'>";
                                echo 'Asegurar la entrada';
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
                            
                            if (valor === 'aventuraTerri') {
                                $(".opcionSpot1").show();
                                $(".opcionSpot2").hide();
                                $(".opcionSpot0").hide();
                            }
                            else if (valor === 'aventuraTerriDebil'){
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
                                        $spotImagen = getFotoSpot(14);
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
                                            $descripcionZona = "Dicen que en lo más profundo del Terri, un Dragón custodia un tesoro tan brillante y lujoso que cualquier humano quedaría cegado al mirar.";
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
                                            $descripcionZona = "La entrada parece el lugar más seguro de proteger, aunque siempre hay Enanos que intentan colarse al menor descuido.";
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