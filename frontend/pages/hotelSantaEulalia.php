<?php
global $db;
        include (__ROOT__.'/backend/comprobaciones.php');
        include (__ROOT__.'/backend/getFotos.php');
        $id = $_SESSION['loggedIn'];
        comprobarZona2Barrio6();
        
        $estoyLibre = comprobarEspera();
            if($estoyLibre === 1){
                
            
        echo "<div id='moduloZona'>";
            
            echo "<div class='contenido'>";
                echo "<div class='seccionSpotImagen'>" ;
                    $imagenSpot = getFotoSpot(112);
                    echo $imagenSpot;
                echo "</div>"; //FIN DE div seccionSpotImagen
                
                echo "<div class='seccionSpotInfo'>";
                    echo "<div class = 'seccionContacto'>";
                        echo "<iframe src='https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d778.5757872801886!2d-4.106969971472256!3d38.687880266855736!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xacbcbf68ff5325bd!2sHotel+Santa+Eulalia!5e0!3m2!1ses!2ses!4v1556040757205!5m2!1ses!2ses' width='300' height='225' frameborder='0' style='border:0' allowfullscreen></iframe><br>";
                        echo "Aqui la info del sitio";
                    echo "</div>";
                    
                    echo "<div class = 'seccionInsignia'>";
                        $fechaInsignia = comprobarInsignia(112);
                        if ($fechaInsignia != '0'){
                            $fotoInsignia = getFotoInsignia(112);
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
                echo "Bienvenido a nuestro Hotel, probablemente el más elegante de todo Puertollano. <br><br>";
                ?>
<form id = "selectorOpciones" action="?bPage=actualizaciones&action=accionSpot&nonUI" method="post">
                <input type="checkbox" name="cbox1" value="habitacionSantaEulalia"> <label for="cbox3">Habitación individual (50 monedas | 30 Minutos)</label><br>
                <label><input type="checkbox" name="cbox1" value="suiteSantaEulalia"> Suite 'Santa Eulalia' (300 monedas | 5 Minutos)</label><br><br>
                
                <input type="submit" value="Descansar">
</form>                
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
        
            }
            else{
                header("location: ?page=zona&message=Aun no he descansado de mi última acción");
            }
