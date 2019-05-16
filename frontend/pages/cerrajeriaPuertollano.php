<?php
global $db;
        include (__ROOT__.'/backend/comprobaciones.php');
        include (__ROOT__.'/backend/getFotos.php');
        $id = $_SESSION['loggedIn'];
        comprobarZona1Barrio1();
        
        echo "<div id='moduloZona'>";
        
            echo "<span class = 'tituloSpot'>";
                echo "<h4>" . getNombreSpot(7) . "</h4>";
            echo "</span>";
            
            echo "<div class='contenido'>";
            echo "<span class='contenedor1'>";
                echo "<div class='seccionSpotImagen'>" ;
                    $imagenSpot = getCerrajeria();
                    echo $imagenSpot;
                echo "</div>"; //FIN DE div seccionSpotImagen
               
                echo "<div class='seccionSpotOpciones'>";
                echo "\"¡Vaya! Eso de ahí parece bloqueado. Hagamos un trato: yo podría abrirlo si tú también abres tu bolsa de monedas\" <br><br>"; 
                
                echo '<form id = "selectorOpciones" action="?bPage=actualizaciones&action=accionSpot&nonUI" method="post">';
                    //CONSULTAR OBJETOS DE TIPO COFRE QUE LLEVO DESEQUIPADOS
                    $cofres=objetosDesequipadosCofres();
                    
                    if(!$cofres){
                        echo "¡Largo, sabandija! No tienes nada para desbloquear.<br>";
                        echo "<br><a href='?page=zona'><button class='botonVolver'>Volver</button></a><br>";
                    }
                    else{
                        foreach($cofres as $cadaObjeto){
                            echo "<div class='opcionesTienda'>";
                                echo "<input type='checkbox' name='cbox1' value='" . $cadaObjeto['nombre'] . "'>" . $cadaObjeto['nombre'] . "<label for='cbox2'><div id='opcionBox'>" . "<img src='/design/img/objetos/" . $cadaObjeto['imagenObjeto'] . "'>" . "</div><div class='monedaTienda'></div><div class='precioTienda'>" . $cadaObjeto['precioCompra'] . "</div></label>";
                            echo "</div>";
                        }

                        echo "<div class='submitTienda'>";
                            echo'<input type="submit" class="botonCerrajeria" value=" ">';
                        echo "</div>";
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
                    
                echo "</div>"; //FIN DE div seccionSpotOpciones

                    echo "</span>"; //FIN Contenedor1
                
            echo "<span class='contenedor2'>";
            echo "<div class='seccionSpotInfo'>";
                echo "<div class = 'seccionContacto'>";
                    echo "<div class = 'mapaCallejero'>";
                        echo '<iframe width="300" height="225" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.openstreetmap.org/export/embed.html?bbox=-4.116472005844117%2C38.67974766141164%2C-4.10267472267151%2C38.68560188282012&amp;layer=mapnik&amp;marker=38.68267929952015%2C-4.109571218359633" style="border: 1px solid black"></iframe><br/>';
                    echo "</div>";
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
                echo "</div>";
                    
                echo "<div class = 'seccionInsignia'>";
                    $fechaInsignia = comprobarInsignia(7);
                    if ($fechaInsignia != '0'){
                        $fotoInsignia = getFotoInsignia(7);
                        echo "<div class='fotoInsignia'>";
                            echo $fotoInsignia . "<br>";
                        echo "</div>";
                        echo "<span class='textoInsignia'>";
                            echo "Nos visitaste el día: <b>" . date( 'd/m/Y',strtotime($fechaInsignia)) . "</b><br>¡Gracias por venir!";
                        echo "</span>";
                    }
                    else{
                        echo "<div class='fotoInsignia'>";
                            echo "<img src='/design/img/insignias/insigniaVacia'><br>";
                        echo "</div>";
                        echo "<div class='textoInsignia'>";
                            echo "Visítanos y pide al dependiente tu Código de Activación";
                        echo "</div>";
                          /*  echo "<form action='?bPage=comprobaciones&action=activarCodigo' method='post'>";
                                echo "Introduce el código: <input type='text' name='codigoInsignia'><br>";
                                echo "<input type='submit'>";
                            echo "</form>";*/
                    }
                echo "</div>";
            echo "</div>";
                
        echo "</span>"; //FIN Contenedor2
    echo "</div>"; //FIN DE div contenido

echo "</div>"; //FIN DE div moduloZona
        
        

