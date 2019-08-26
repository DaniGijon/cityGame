<?php
global $db;
        include (__ROOT__.'/backend/comprobaciones.php');
        include (__ROOT__.'/backend/getFotos.php');
        $id = $_SESSION['loggedIn'];
        comprobarZona2Barrio1();
        
        echo "<div id='moduloZona'>";
        
            echo "<span class = 'tituloSpot'>";
                echo "<h4>" . getNombreSpot(13) . "</h4>";
            echo "</span>";
            
            echo "<div class='contenido'>";
            echo "<span class='contenedor1'>";
                $cofres=objetosDesequipadosCofres();
               
                echo "<div class='seccionSpotOpciones'>";
                echo "<div class='semiTransparente'>"; 
                echo "<div class='textoDependiente'>";
                    if(!$cofres){
                        echo "No interrumpas la siesta de un Enano si no traes nada para desbloquear.<br>";
                    }
                    else{
                        echo "\"¡Vaya, eso parece bloqueado!<br>Yo podría abrirlo si tú también abres tu bolsa de monedas\".";
                    }
                echo "</div>"; //FIN textoDependiente
                echo "<div class='imagenDependiente'>";
                    echo '<img src="/design/img/dependientes/fogataRitual.png">';
                echo "</div>"; //FIN imagenDependiente
               
                
                    //CONSULTAR OBJETOS DE TIPO COFRE QUE LLEVO DESEQUIPADOS

                    if(!$cofres){
                        
                        echo "<br><a href='?page=zona'><button class='botonVolver'></button></a><br>";
                    }
                    else{
                        echo '<form id = "selectorOpciones" action="?bPage=actualizaciones&action=accionSpot&nonUI" method="post">';
                        foreach($cofres as $cadaObjeto){
                            echo "<div class='opcionesTienda'>";
                            echo "<div class='opcionesTiendaCheckbox'>";
                                echo '<input type="checkbox" name="cbox1" value="' . $cadaObjeto['nombre'] . '">';
                            echo "</div>";
                            echo "<div class='opcionesTiendaTitulo'>";
                                echo $cadaObjeto['nombre'];
                            echo "</div>";
                            echo '<label for="cbox3"><div id="opcionBox">' . '<img src="/design/img/objetos/' . $cadaObjeto['imagenObjeto'] . '">' . '</div><div class="monedaTienda"></div><div class="precioTienda">' . $cadaObjeto["precioVenta"] . '</div></label>';
                        echo "</div>";
                            
                        }

                        echo "<div class='submitTienda'>";
                            echo'<input type="submit" class="botonCerrajeria" value=" ">';
                        echo "</div>";
                        $miDinero = comprobarDinero();
                        $dineroEnCash = $miDinero[0]['cash'];
                        echo "<br>Llevo " . $dineroEnCash . " <img src='/design/img/iconos/monedaTop.png' style='vertical-align: bottom'>" . " en el bolsillo.";
                                
                    }
                echo '</form>';
?>
                <script>
                    
                    $(":checkbox").change(function(){
                       var $box = $(this);
                      
                       $box.parents('#selectorOpciones').find(':checkbox').each(function(){
                          $(this).prop('checked', false); 
                       });
                       $box.prop("checked", true);

                    });
                </script>

                <?php
                echo "</div>"; //Fin de semiTransparente  
                echo "</div>"; //FIN DE div seccionSpotOpciones

                    echo "</span>"; //FIN Contenedor1
                
            echo "<span class='contenedor2'>";
            echo "<div class='seccionSpotInfo'>";
                echo "<div class = 'seccionContacto'>";
                    echo "<div class = 'mapaCallejero'>";
                        echo '<iframe width="300" height="225" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.openstreetmap.org/export/embed.html?bbox=-4.116472005844117%2C38.67974766141164%2C-4.10267472267151%2C38.68560188282012&amp;layer=mapnik&amp;marker=38.68267929952015%2C-4.109571218359633" style="border: 1px solid black"></iframe><br/>';
                    echo "</div>";
                    echo "<div class = 'semiTransparente'>";
                    echo "<div class = 'infoSpot'>";
                        echo "<table border = '0' style = 'text-align:left'>";
                            echo "<tr>";
                               echo "<td><div class='mapaMini'></div> C/Colonia, 27<br></td>";
                            echo "</tr>";
                            echo "<tr>";
                               echo "<td><div class='telefonoMini'></div>  926 04 71 96<br></td>";
                            echo "</tr>";
                            echo "<tr>";
                                echo "<td><div class='relojMini'></div> 08:30 - 18:30 (Lunes a Viernes)</td>";
                            echo "</tr>";
                        echo "</table>";
                    echo "</div>";
                    echo "</div>"; //FIN Semitransparente
                echo "</div>";
                    
               
            echo "</div>";
                
        echo "</span>"; //FIN Contenedor2
    echo "</div>"; //FIN DE div contenido

echo "</div>"; //FIN DE div moduloZona
        
        


