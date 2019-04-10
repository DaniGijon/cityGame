<?php
global $db;
        include (__ROOT__.'/backend/comprobaciones.php');
        include (__ROOT__.'/backend/getFotos.php');
        $id = $_SESSION['loggedIn'];
        comprobarZona1Barrio1();
        
        echo "<div id='moduloZona'>";
            
            echo "<div class='contenido'>";
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
                            echo "<input type='checkbox' name='cbox1' value='" . $cadaObjeto['nombre'] . "'> <label for='cbox2'>" . "<img src='/design/img/objetos/" . $cadaObjeto['imagenObjeto'] . "'>" . $cadaObjeto['nombre'] . ": " . $cadaObjeto['precioCompra'] . "€</label><br>";
                        }

                        echo "<br><input type='submit' value='¡Ábrete Sésamo!'>";
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

                
            echo "</div>"; //FIN DE div contenido

        echo "</div>"; //FIN DE div moduloZona
        
        

