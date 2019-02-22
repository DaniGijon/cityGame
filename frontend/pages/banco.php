<?php
global $db;
        include (__ROOT__.'/backend/comprobaciones.php');
        $id = $_SESSION['loggedIn'];
        comprobarZona2Barrio6();
        
        $result = comprobarDinero();
        $dineroEnBanco = $result[0]['enBanco'];
        $dineroEnCash = $result[0]['cash'];
        
        echo "<div id='moduloZona'>";
            
            echo "<div class='contenido'>";
                echo "<div class='seccionSpotImagen'>" ;
                    echo"seccionSpotImagen";
                echo "</div>"; //FIN DE div seccionSpotImagen
               
                echo "<div class='seccionSpotOpciones'>";
                echo "\"¿Por qué arriesgarse a llevar dinero encima y ser asaltado en plena calle si podemos robarte directamente nosotros?\" <br><br>";
                echo "Actualmente dispone de " . $dineroEnBanco . "€ en la cuenta bancaria. <br>";
                echo "Llevas " . $dineroEnCash . "€ en el bolsillo.";
                
                ?>
                
<form id = "selectorOpciones" action="?bPage=actualizaciones&action=actualizarDinero&nonUI" method="post">
    <br><input type="checkbox" name="cbox1" value="depositarDinero" checked="true"> <label for="cbox3">Meter en banco: <input name="cantidadDeposito" style="width:25%" type=number min="0">€<br></label><br>
                <input type="checkbox" name="cbox1" value="retirarDinero"> <label for="cbox4">Deseo retirar <input name="cantidadRetirada" style="width:25%" type=number min="0">€ (5% Comisión)</label><br><br>
                
                <input type="submit" value="Vale">
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
        
        
