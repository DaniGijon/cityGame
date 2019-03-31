<?php
global $db;
        include (__ROOT__.'/backend/comprobaciones.php');
        $id = $_SESSION['loggedIn'];
        comprobarZona1Barrio1();
        
        echo "<div id='moduloZona'>";
            
            echo "<div class='contenido'>";
                echo "<div class='seccionSpotImagen'>" ;
                    echo"seccionSpotImagen";
                echo "</div>"; //FIN DE div seccionSpotImagen
               
                echo "<div class='seccionSpotOpciones'>";
                echo "\"¡Schwack! ¡Un cliente!\", grita el loro. <br><br>"; 
                
                echo '<form id = "selectorOpciones" action="?bPage=actualizaciones&action=accionSpot&nonUI" method="post">';
                    echo '<input type="checkbox" name="cbox1" value="Pez"> <label for="cbox3">Pez (10€)</label><br>';
                    echo '<input type="checkbox" name="cbox1" value="Hámster"> <label for="cbox4">Hámster (30€)</label><br>';
                    echo '<input type="checkbox" name="cbox1" value="Gallo"> <label for="cbox4">Gallo (36€)</label><br><br>';
                    
                    echo'<input type="submit" value="Comprar"><br><br>';
                    $miDinero = comprobarDinero();
                    $dineroEnCash = $miDinero[0]['cash'];
                    echo " Llevo " . $dineroEnCash . "€ en el bolsillo.<br><br>"; 

                    echo "\"Así que quieres vender. Déjame echar un vistazo dentro de tu mochila, quizá tengas algo valioso.\" <br><br>";
                    //CONSULTAR OBJETOS QUE LLEVO DESEQUIPADOS
                    $objetosDesequipados=objetosDesequipados();
                    foreach($objetosDesequipados as $cadaObjeto){
                        echo "<input type='checkbox' name='cbox1' value='v" . $cadaObjeto['nombre'] . "'> <label for='cbox2'>" . $cadaObjeto['nombre'] . ": " . $cadaObjeto['precioVenta'] . "€</label><br>";
                    }
                    
                    echo "<br><input type='submit' value='Vender'>";
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

                
            echo "</div>"; //FIN DE div contenido

        echo "</div>"; //FIN DE div moduloZona
        
        

