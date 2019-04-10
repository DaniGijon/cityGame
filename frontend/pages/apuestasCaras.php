<?php
if(isset($_GET['message'])){
    echo $_GET['message'] . "<br>";
}
global $db;
include (__ROOT__.'/backend/comprobaciones.php');
include (__ROOT__.'/backend/getFotos.php');
$id = $_SESSION['loggedIn'];
$miDinero = comprobarDinero();
$dineroEnCash = $miDinero[0]['cash'];
comprobarZona1Barrio2();

$sql = "SELECT * FROM spots WHERE idS='30'";
$stmt = $db->query($sql);
$result = $stmt->fetchAll();

echo "<div id='moduloZona'>";

    echo "<div class='contenido'>";
        echo "<div class='seccionSpotImagen'>" ;
            $imagenSpot = getCaras();
            echo $imagenSpot;
        echo "</div>"; //FIN DE div seccionSpotImagen

        echo "<div class='seccionSpotOpciones'>";
            echo "<br>El juego de Caras y Cruces. ¡Hagan sus apuestas!<br><br>";
            echo " Llevo " . $dineroEnCash . "€ en el bolsillo.";    
            ?>
<form id = "selectorOpciones" action="?bPage=apuestas&action=caras&nonUI" method="post">
                <label> <br>Caras (@2.00) <input name="cantidadApuesta1" style="width:25%" type=number min="0" value =0>€</label><br>
                <label> Cruces (@2.00) <input name="cantidadApuesta2" style="width:25%" type=number min="0" value =0>€</label><br>
                
                <input type="submit" value="¡Apostar!">
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
        
        
