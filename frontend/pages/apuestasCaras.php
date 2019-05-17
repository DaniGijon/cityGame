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

$sql = "SELECT * FROM spots WHERE idS='20'";
$stmt = $db->query($sql);
$result = $stmt->fetchAll();

echo "<div id='moduloZona'>";

    echo "<div class='contenido'>";
    echo "<span class='contenedor1'>";
        echo "<div class='seccionSpotImagen'>" ;
            $imagenSpot = getFotoSpot(20);
            echo $imagenSpot;
        echo "</div>"; //FIN DE div seccionSpotImagen

        echo "<div class='seccionSpotOpciones'>";
            echo "<br>El juego de Caras y Cruces. ¡Hagan sus apuestas!<br><br>";
            ?>
<form id = "selectorOpciones" action="?bPage=apuestas&action=caras&nonUI" method="post">
    <table border = '0' style = 'text-align:center'>
        <tr>
            <th>Elijo</th>
            <th>Premio</th>
            <th>Cantidad a Apostar</th>
        </tr>
        
        <tr>
            <td>
                Caras
            </td>
            <td>
                x2
            </td>
            <td>
                <label><input name="cantidadApuesta1" style="width:50%" type=number min="0" value =0><img src='/design/img/iconos/monedaTop.png' style='vertical-align: bottom'></label>
            </td>
        </tr>
        
        <tr>
            <td>
                Cruces
            </td>
            <td>
                x2
            </td>
            <td>
                <label><input name="cantidadApuesta2" style="width:50%" type=number min="0" value =0><img src='/design/img/iconos/monedaTop.png' style='vertical-align: bottom'></label>
            </td>
        </tr>
    </table>
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
                
                echo " Llevo " . $dineroEnCash . " <img src='/design/img/iconos/monedaTop.png' style='vertical-align: bottom'>" . " en el bolsillo.";  
                 
                echo "</div>"; //FIN DE div seccionSpotOpciones
                echo "</span>";
                echo "<span class='contenedor2'>";
                    echo "Aqui una tarjeta con info de este tipo de juego";
                echo "</span>";
                
            echo "</div>"; //FIN DE div contenido

        echo "</div>"; //FIN DE div moduloZona
        
        
