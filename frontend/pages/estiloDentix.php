<?php
global $db;
        include (__ROOT__.'/backend/comprobaciones.php');
        include (__ROOT__.'/backend/getFotos.php');
        $id = $_SESSION['loggedIn'];
        comprobarZona2Barrio6();
        echo "<span class = 'tituloSpot'>";
            echo "<h4>" . getNombreSpot(114) . "</h4>";
        echo "</span>";
        
        $estoyLibre = comprobarEspera();
            if($estoyLibre === 1){
                
            
        echo "<div id='moduloZona'>";
            
            echo "<div class='contenido'>";
                echo "<span class='contenedor1'>"; 
               echo "<div class='semiTransparente'>"; 
               
                echo "<div class='seccionSpotOpciones'>";
                echo "<div class='textoDependiente'>";
                    echo "\"Una sonrisa brillante. Por difícil que sea, lo conseguiré hacer\".";
                echo "</div>"; //FIN textoDependiente
                echo "<div class='imagenDependiente'>";
                    echo '<img src="/design/img/dependientes/enfermera.png">';
                echo "</div>"; //FIN imagenDependiente
                
                echo '<form id = "selectorOpciones" action="?bPage=actualizaciones&action=accionSpot&nonUI" method="post">';
                    echo "<div class='opcionesTienda'>";
                        echo "<div class='opcionesTiendaCheckbox'>";
                            echo '<input type="checkbox" name="cbox1" value="limpiezaDental">';
                        echo "</div>";
                        echo "<div class='opcionesTiendaTitulo'>";
                            echo 'Limpieza Dental';
                        echo "</div>";
                        echo '<label for="cbox3"><div id="opcionBox">' . '<img src="/design/img/bar/cafeIrlandes">' . '</div><div class="relojMini"></div><div class="precioTienda">10M</div></label>';
                    echo "</div>";
                    
                    echo "<div class='opcionesTienda'>";
                        echo "<div class='opcionesTiendaCheckbox'>";
                            echo '<input type="checkbox" name="cbox1" value="implanteDental">';
                        echo "</div>";
                        echo "<div class='opcionesTiendaTitulo'>";
                            echo "Implantes Dentales";
                        echo "</div>";
                        echo '<label for="cbox3"><div id="opcionBox">' . '<img src="/design/img/bar/cafeIrlandes">' . '</div><div class="relojMini"></div><div class="precioTienda">25M</div></label>';
                    echo "</div>";
                       
                        echo "<div class='submitTienda'>";
                            echo'<input type="submit" class="botonTiendaComprar" value=" ">';
                        echo "</div>";
                        $miDinero = comprobarDinero();
                        $dineroEnCash = $miDinero[0]['cash'];
                        echo "<br>Llevo " . $dineroEnCash . " <img src='/design/img/iconos/monedaTop.png' style='vertical-align: bottom'>" . " en el bolsillo.";
                                
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
                            
                            if (valor === 'limpiezaDental') {
                                $(".opcionSpot1").show();
                                $(".opcionSpot2").hide();
                                $(".opcionSpot0").hide();
                            }
                            else if (valor === 'implanteDental'){
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
                                        $spotImagen = getFotoSpot(114);
                                        echo $spotImagen;
                                    echo "</div>";
                                echo "</div>";
                               
                            echo "</div>"; //FIN opcionSpot0
                        
                            echo "<div class='opcionSpot1 opcionSpot'>";
                                echo "<div class='seccionDescripcionZonaImagen'>";
                                    $imagenSpot = "<img src='/design/img/estilo/hudyClasico.png'>";
                                    echo $imagenSpot;
                                echo "</div>";
                                echo "<div class='seccionDescripcionZonaTexto'>";
                                    echo "<div class='semiTransparente' style='border-radius: 0px 0px 10px 10px'>";
                                        echo "<span class='textoDescripcionSpot'>";
                                            $descripcionZona = "Puaj! Estos dientes han visto menos el agua que la Esfinge de Guiza";
                                            echo $descripcionZona;
                                        echo "</span>";
                                    echo "</div>";//Fin SemiTransparente
                                echo "</div>"; //Fin seccionDescripcionZonaTexto
                            echo "</div>"; //FIN opcionSpot1
                            
                            echo "<div class='opcionSpot2 opcionSpot'>";
                                echo "<div class='seccionDescripcionZonaImagen'>";
                                    $imagenSpot = "<img src='/design/img/estilo/hudyElPaisano.png'>";
                                    echo $imagenSpot;
                                echo "</div>";
                                echo "<div class='seccionDescripcionZonaTexto'>";
                                    echo "<div class='semiTransparente' style='border-radius: 0px 0px 10px 10px'>";
                                        echo "<span class='textoDescripcionSpot'>";
                                            $descripcionZona = "\"¡Madre mía! Habrá que pedir un permiso de obra para tocar algo aquí\".";
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
