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
                echo "El camarero te saluda con una amable sonrisa, es un lugar acogedor. \"¿Qué desea tomar?\" <br><br>";
                ?>
<form id = "selectorOpciones" action="?bPage=actualizaciones&action=accionSpot&nonUI" method="post">
                <label><input type="checkbox" name="cbox1" value="quesadillas"> Quesadillas (+15 Salud) (10€)</label><br>
                <input type="checkbox" name="cbox1" value="fajitas"> <label for="cbox2">Fajitas (+30 Salud) (18€)</label><br><br>
                <input type="checkbox" name="cbox1" value="cafeConLeche"> <label for="cbox3">Cafe con leche (+10 Energia) (2€)</label><br>
                <input type="checkbox" name="cbox1" value="cafeIrlandes"> <label for="cbox4">Cafe Irlandes (+15 Energia) (3€)</label><br><br>
                <input type="submit" value="Tomar">
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
        
        
