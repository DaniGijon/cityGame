<?php
global $db;
        include (__ROOT__.'/backend/comprobaciones.php');
        include (__ROOT__.'/backend/getFotos.php');
        $id = $_SESSION['loggedIn'];
        comprobarZona1Barrio8();
        
        $estoyLibre = comprobarEspera();
        if($estoyLibre === 1){
            echo "<div id='moduloZona'>";
            echo "<span class = 'tituloSpot'>";
                echo "<h4>" . getNombreSpot(144) . "</h4>";
            echo "</span>";
            
            $result = comprobarDinero();
            $dineroEnBanco = $result[0]['enBanco'];
            
            echo "<div class='contenido'>";
            echo "<span class='contenedor1'>"; 
            echo "<div class='seccionSpotOpciones'>";
            echo "<div id='botonesComprarVender'>";
                echo "<button id='botonComprar' class='tagTiendaComprar'>Cajero</button>";
                echo "<button id='botonVender' class='tagTiendaVender'>Empeños</button>";
            echo "</div>";
            echo "<div class='semiTransparente'>"; 
            echo "<div id='cajero'>";
            echo "<div class='textoDependiente'>";
                echo "\"Gringotts es el lugar más seguro del mundo para lo que quieras guardar\".";
            echo "</div>"; //FIN textoDependiente
            echo "<div class='imagenDependiente'>";
                echo '<img src="/design/img/dependientes/fogataRitual.png">';
            echo "</div>"; //FIN imagenDependiente
            
            echo '<form id = "selectorOpciones" action="?bPage=actualizaciones&action=actualizarDinero&nonUI" method="post">';
            echo "<div class='opcionesTienda'>";
                echo "<div class='opcionesTiendaCheckbox'>";
                    echo '<input type="checkbox" name="cbox1" value="depositarDinero" checked="true">';
                echo "</div>";
                echo "<div class='opcionesTiendaTitulo'>";
                    echo 'Meter en banco';
                echo "</div>";
                echo '<label for="cbox3"><div id="opcionBox">' . '<img src="/design/img/bar/cafeIrlandes">' . '</div><div class="monedaTienda"></div><div class="precioTiendaInput"><input name="cantidadDeposito" style="width:70%; border-radius:10px;" type=number min="0"></div><br></label>';
            echo "</div>";
            echo "<div class='opcionesTienda'>";
                echo "<div class='opcionesTiendaCheckbox'>";
                    echo '<input type="checkbox" name="cbox1" value="retirarDinero">';
                echo "</div>";
                echo "<div class='opcionesTiendaTitulo'>";
                    echo 'Deseo Retirar';
                echo "</div>";
                echo '<label for="cbox3"><div id="opcionBox">' . '<img src="/design/img/bar/cafeIrlandes">' . '</div><div class="monedaTienda"></div><div class="precioTiendaInput"><input name="cantidadRetirada" style="width:70%; border-radius:10px;" type=number min="0"></div>(5% Comisión)</label>';
            echo "</div>";
            
            echo "<div class='submitTienda'>";
                echo "<input type='submit' class='botonCarrilBici' value=' '><br><br>";
            echo "</div>";
            
            echo "</form>"; 
            echo "</div>"; //FIN cajero
            echo "<div id='empeno'>";
            echo "HOLA";
            echo "</div>"; //FIN empeno
        }
        
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
                        $("#cajero").hide();
                        $("#empeno").show();
                        $("#botonVender").css("background-color", "rgba(255, 249, 192, 0.7)");
                        $("#botonComprar").css("background-color", "white");
                    });

                      $("#botonComprar").click(function(){
                        $("#cajero").show();
                        $("#empeno").hide();
                        $("#botonComprar").css("background-color", "rgba(255, 249, 192, 0.7)");
                        $("#botonVender").css("background-color", "white");
                    });
                </script>

                <?php
                echo "</div>"; //fin de semiTransparente     
                echo "</div>"; //FIN DE div seccionSpotOpciones
                
                echo "</span>"; //FIN contenedor1
                
                echo "<span class='contenedor2'>";
                    echo "<div class='opcionSpot0 opcionSpot' style='display: inline'>";
                        echo "<div class='seccionDescripcionZonaImagen'>";
                            echo "<div class='seccionSpotImagen'>" ;
                                $spotImagen = getFotoSpot(144);
                                echo $spotImagen;
                            echo "</div>";
                        echo "</div>";               
                    echo "</div>"; //FIN opcionSpot0
                echo "</span>"; //FIN de contenedor2
                
            echo "</div>"; //FIN DE div contenido

        echo "</div>"; //FIN DE div moduloZona
        
        
