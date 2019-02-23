<?php
if(isset($_GET['message'])){
    echo $_GET['message'] . "<br>";
}
global $db;
include (__ROOT__.'/backend/comprobaciones.php');
$id = $_SESSION['loggedIn'];
$miDinero = comprobarDinero();
$dineroEnCash = $miDinero[0]['cash'];
comprobarZona1Barrio1();

$sql = "SELECT * FROM spots WHERE idS='2'";
$stmt = $db->query($sql);
$result = $stmt->fetchAll();

echo "<div id='moduloZona'>";

    echo "<div class='contenido'>";
        echo "<div class='seccionSpotImagen'>" ;
            $imagenSpot = "<img src='/design/img/spots/" . $result[0]['imagenSpot'] . "'>";
            echo $imagenSpot;
        echo "</div>"; //FIN DE div seccionSpotImagen

        echo "<div class='seccionSpotOpciones'>";
            echo "<br>El \"Ojailén River Grand Prix\" es el evento principal del Campeonato de Carreras de Cocodrilos. ¡Hagan sus apuestas!<br><br>";
            echo " Llevo " . $dineroEnCash . "€ en el bolsillo.";    
            ?>
<form id = "selectorOpciones" action="?bPage=apuestas&action=cocodrilos&nonUI" method="post">
                <label> <br>Crocky Balboa (@3.00) <input name="cantidadApuesta1" style="width:25%" type=number min="0" value =0>€</label><br>
                <label> Dientes de leche (@4.00) <input name="cantidadApuesta2" style="width:25%" type=number min="0" value =0>€</label><br>
                <label> Cai-Man (@5.00) <input name="cantidadApuesta3" style="width:25%" type=number min="0" value =0>€</label><br>
                <label> Totodile (@6.00) <input name="cantidadApuesta4" style="width:25%" type=number min="0" value =0>€</label><br>
                <label> Rumbera (@8.00) <input name="cantidadApuesta5" style="width:25%" type=number min="0" value =0>€</label><br>
                <label> Old Jack (@10.00) <input name="cantidadApuesta6" style="width:25%" type=number min="0" value =0>€</label><br>
                <label> Guacamole (@41.00) <input name="cantidadApuesta7" style="width:25%" type=number min="0" value =0>€</label><br>
                
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
        
        
