<?php
global $db;
        include (__ROOT__.'/backend/comprobaciones.php');
        include (__ROOT__.'/backend/getFotos.php');
        $id = $_SESSION['loggedIn'];
        comprobarZona2Barrio5();
        $estoyLibre = comprobarEspera();
        if($estoyLibre === 1){

            echo "<div id='moduloZona'>";
            echo "<span class = 'tituloSpot'>";
                echo "<h4>" . getNombreSpot(87) . "</h4>";
            echo "</span>";

                echo "<div class='contenido'>";
                echo "<span class='contenedor1'>";

                    echo "<div class='seccionSpotOpciones'>";
                    echo "<div class='semiTransparente'>";
                        echo "<div id='comprar'>";
                            echo '<form id = "selectorOpciones" action="?bPage=actualizaciones&action=accionSpot&nonUI" method="post">';
                            echo "<div class='textoDependiente'>";
                                echo "\"Ayúdame a traer clientes. Ganarás una jugosa comisión\".";
                            echo "</div>";
                            echo "<div class='imagenDependiente'>";
                                echo '<img src="/design/img/dependientes/museo.png">';
                            echo "</div>"; //FIN imagenDependiente
                   
                    
                    echo "<form id = 'selectorOpciones' action='?bPage=actualizaciones&action=accionSpot&nonUI' method='post'>";
                            echo "<div class='opcionesTienda'>";
                                echo "<div class='opcionesTiendaCheckbox'>";
                                    echo '<input type="checkbox" name="cbox1" value="relaciones1">';
                                echo "</div>";
                                echo "<div class='opcionesTiendaTitulo'>";
                                    echo 'Repartir Flyers';
                                echo "</div>";
                                echo '<label for="cbox3"><div id="opcionBox">' . '<img src="/design/img/entrenamiento/ritmitoGeneroso.png">' . '</div><div class="relojMini"></div><div class="precioTienda">1H</div></label>';
                            echo "</div>"; 
                            
                        
                        echo "<div class='submitTienda'>";
                            echo "<input type='submit' class='botonTrabajar' value=' '>";
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
                            
                            if (valor === 'relaciones1') {
                                $(".opcionSpot1").show();
                                $(".opcionSpot0").hide();
                            }
                            
                        });
                        
                        
                    </script>

                    <?php
                    echo "</div>";
                    echo "</div>"; //FIN de semiTransparente
                    echo "</div>"; //FIN DE div seccionSpotOpciones
                    echo "</span>"; //Fin de Contenedor1
                    
                    echo "<span class='contenedor2'>";
                            echo "<div class='opcionSpot0 opcionSpot' style='display: inline'>";
                                echo "<div class='seccionDescripcionZonaImagen'>";
                                    echo "<div class='seccionSpotImagen'>" ;
                                        $spotImagen = getFotoSpot(87);
                                        echo $spotImagen;
                                    echo "</div>";
                                echo "</div>";
                            echo "</div>"; //FIN opcionSpot0
                        
                            echo "<div class='opcionSpot1 opcionSpot'>";
                                echo "<div class='seccionDescripcionZonaImagen'>";
                                    $imagenSpot = "<img src='/design/img/trabajo/qualy.png'>";
                                    echo $imagenSpot;
                                echo "</div>";
                                echo "<div class='seccionDescripcionZonaTexto'>";
                                    echo "<div class='semiTransparente'>";
                                    echo "<span class='textoDescripcionSpot'>";
                                        $descripcionZona = "\"¿Una copita dentro? Enseña este cupón y te la dejamos a mitad de precio\".";
                                        echo $descripcionZona;
                                    echo "</span>";
                                    echo "</div>";
                                echo "</div>"; //Fin seccionDescripcionZonaTexto
                            echo "</div>"; //FIN opcionSpot1
                            
                    echo "</span>"; //FIN de contenedor2


                echo "</div>"; //FIN DE div contenido

            echo "</div>"; //FIN DE div moduloZona

        }
        else{
            header("location: ?page=zona&nonUI&message=Aun no he descansado de mi última acción");
        }
