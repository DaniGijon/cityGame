<?php
global $db;
        include (__ROOT__.'/backend/comprobaciones.php');
        include (__ROOT__.'/backend/getFotos.php');
        $id = $_SESSION['loggedIn'];
        comprobarZona1Barrio1();
        
        echo "<div id='moduloZona'>";
            
            echo "<div class='contenido'>";
            //Cabecera selector opciones
                echo "<div id='botonesComprarVender'>";
                    echo "<button id='botonComprar'>Comprar</button>";
                    echo "<button id='botonVender'>Vender</button>";
                echo "</div>"; 
                    
                echo "<div class='seccionSpotImagen'>" ;
                    $imagenSpot = getPajareria();
                    echo $imagenSpot;
                echo "</div>"; //FIN DE div seccionSpotImagen
                
                echo "<div class='seccionSpotInfo'>";
                    echo "<div class = 'seccionContacto'>";
                        echo "<iframe src='https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1557.3101550457134!2d-4.108160992980026!3d38.68059324901264!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd6b8df13b26fdf9%3A0xbee576f8f5c7e903!2sPajareria!5e0!3m2!1ses!2ses!4v1555449886510!5m2!1ses!2ses' width='300' height='225' frameborder='0' style='border:0' allowfullscreen></iframe><br>";
                        echo "Aqui la info del sitio";
                    echo "</div>";
                    
                    echo "<div class = 'seccionInsignia'>";
                        $fechaInsignia = comprobarInsignia8();
                        if ($fechaInsignia != '0'){
                            $fotoInsignia = getFotoInsignia8();
                            echo $fotoInsignia . "<br>";
                            echo "Nos visitaste el día: <b>" . date( 'd/m/Y',strtotime($fechaInsignia)) . "</b><br>¡Gracias por venir!";
                        }
                        else{
                            echo "Aqui la foto de la insignia vacia<br>";
                            echo "<form action='?bPage=comprobaciones&action=activarCodigo' method='post'>";
                                echo "Introduce el código: <input type='text' name='codigoInsignia'><br>";
                                echo "<input type='submit'>";
                            echo "</form>";
                        }
                    echo "</div>";
                echo "</div>";

                echo "<div class='seccionSpotOpciones'>";               
                echo "<div id='comprar'>";
                        echo '<form id = "selectorOpciones" action="?bPage=actualizaciones&action=accionSpot&nonUI" method="post">';
                        echo "\"Schwak!\", grita el loro. \"¿Qué necesitas?\" <br><br>";
                        $imagenPez = getPez();
                        $imagenHámster = getHámster();
                        $imagenGallo = getGallo();
                        echo "<div id='opcionBox'>$imagenPez</div>";
                        echo "<div id='opcionBox'>$imagenHámster</div>";
                        echo "<div id='opcionBox'>$imagenGallo</div><br><br><br>";
                        echo '<input type="checkbox" name="cbox1" value="Pez"> <label for="cbox3">Pez</label>';

                        echo '<input type="checkbox" name="cbox1" value="Hámster"> <label for="cbox4">Hámster (30€)</label>';

                        echo '<input type="checkbox" name="cbox1" value="Gallo"> <label for="cbox4">Gallo (36€)</label><br><br>';

                        echo'<input type="submit" value="Comprar"><br><br>';
                        $miDinero = comprobarDinero();
                        $dineroEnCash = $miDinero[0]['cash'];
                        echo " Llevo " . $dineroEnCash . "€ en el bolsillo.<br><br>"; 
                        echo "</form>";                 
                echo "</div>";
                
                echo "<div id='vender'>";
                       
                        echo '<form id = "selectorOpciones" action="?bPage=actualizaciones&action=accionSpot&nonUI" method="post">';
                        echo "\"Schwak! ¿Traes algo para lorito?\" <br><br>";
                        //CONSULTAR OBJETOS QUE LLEVO DESEQUIPADOS
                        $objetosDesequipados=objetosDesequipados();
                        foreach($objetosDesequipados as $cadaObjeto){
                            echo "<input type='checkbox' name='cbox1' value='v" . $cadaObjeto['nombre'] . "'> <label for='cbox2'>" . "<img src='/design/img/objetos/" . $cadaObjeto['imagenObjeto'] . "'>" . $cadaObjeto['nombre'] . ": " . $cadaObjeto['precioVenta'] . "€</label><br>";
                        }

                        echo "<br><input type='submit' value='Vender'><br><br>";
                        echo " Llevo " . $dineroEnCash . "€ en el bolsillo.<br><br>"; 
                        echo '</form>';
                echo "</div>";
            echo "</div>";
        
        
                    
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
                    });

                      $("#botonComprar").click(function(){
                        $("#comprar").show();
                        $("#vender").hide();
                    });
                    
                </script>
                

                <?php
                    
                echo "</div>"; //FIN DE div seccionSpotOpciones

                
            echo "</div>"; //FIN DE div contenido

        echo "</div>"; //FIN DE div moduloZona
        
        
        
