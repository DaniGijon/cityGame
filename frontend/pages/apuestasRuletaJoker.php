<?php
if(isset($_GET['message'])){
    echo $_GET['message'] . "<br>";
}
global $db;
include (__ROOT__.'/backend/comprobaciones.php');
include (__ROOT__.'/backend/apuestas.php');
include (__ROOT__.'/backend/getFotos.php');
$id = $_SESSION['loggedIn'];
$miDinero = comprobarDinero();
$dineroEnCash = $miDinero[0]['cash'];
comprobarZona2Barrio5();

$sql = "SELECT * FROM spots WHERE idS='80'";
$stmt = $db->query($sql);
$result = $stmt->fetchAll();

echo "<div id='moduloZona'>";

    echo "<div class='contenido'>";
        echo "<div class='seccionSpotImagen'>" ;
            $imagenSpot = getJoker();
            echo $imagenSpot;
        echo "</div>"; //FIN DE div seccionSpotImagen

        echo "<div class='seccionSpotOpciones'>";
            echo "<br>Why so serious?. ¡Hagan sus apuestas!<br><br>";
            echo " Llevo " . $dineroEnCash . "€ en el bolsillo.<br><br>";    
            ?>
<center><table>
    <tr>
        <td>
            El <b>JACKPOT (sólo para números)</b> actual es : <b>
                <?php 
                $jackpot = getJackpotJoker(); 
                echo $jackpot;
                ?>€</b>
        </td>
    </tr>
    <tr>
        <td>
            La apuesta máxima números es : 50€
                
        </td>
    </tr>
    <tr>
        <td>
            La apuesta máxima general es : 500€
                
        </td>
    </tr>
    
    <tr>
        <td height="1" bgcolor="black">
        </td>
    </tr>
    </table></center>
<form id = "selectorOpciones" action="?bPage=apuestas&action=ruleta&nonUI" method="post">
    <label style="background-color: green; color: white"> <br> 0 <input name="cantidadApuesta0" style="width:90%; background-color: green; color: white" type=number min="0" max="50" value =0></label><br>
    <label style="background-color: red; color: white"> 1 <input name="cantidadApuesta1" style="width:27%; background-color: red" type=number min="0" max="50" value =0></label>
    <label style="background-color: black; color: white"> 2 <input name="cantidadApuesta2" style="width:27%; background-color: black; color : white" type=number min="0" max="50" value =0></label>
    <label style="background-color: red; color: white"> 3 <input name="cantidadApuesta3" style="width:27%; background-color: red" type=number min="0" max="50" value =0></label><br>
    <label style="background-color: black; color: white"> 4 <input name="cantidadApuesta4" style="width:27%; background-color: black; color : white" type=number min="0" max="50" value =0></label>
    <label style="background-color: red; color: white"> 5 <input name="cantidadApuesta5" style="width:27%; background-color: red" type=number min="0"  max="50"value =0></label>
    <label style="background-color: black; color: white"> 6 <input name="cantidadApuesta6" style="width:27%; background-color: black; color : white" type=number min="0" max="50" value =0></label><br>
    <label style="background-color: red; color: white"> 7 <input name="cantidadApuesta7" style="width:27%; background-color: red" type=number min="0"  max="50" value =0></label>
    <label style="background-color: black; color: white"> 8 <input name="cantidadApuesta8" style="width:27%; background-color: black; color : white" type=number min="0" max="50" value =0></label>
    <label style="background-color: red; color: white"> 9 <input name="cantidadApuesta9" style="width:27%; background-color: red" type=number min="0"  max="50"value =0></label><br>
    <label style="background-color: black; color: white"> 10 <input name="cantidadApuesta10" style="width:25%; background-color: black; color : white" type=number min="0" max="50" value =0></label>
    <label style="background-color: black; color: white"> 11 <input name="cantidadApuesta11" style="width:25%; background-color: black; color : white" type=number min="0" max="50" value =0></label>
    <label style="background-color: red; color: white"> 12 <input name="cantidadApuesta12" style="width:25%; background-color: red" type=number min="0" max="50" value =0></label><br>
    <label style="background-color: black; color: white"> 13 <input name="cantidadApuesta13" style="width:25%; background-color: black; color : white" type=number min="0" max="50" value =0></label>
    <label style="background-color: red; color: white"> 14 <input name="cantidadApuesta14" style="width:25%; background-color: red" type=number min="0" max="50" value =0></label>
    <label style="background-color: black; color: white"> 15 <input name="cantidadApuesta15" style="width:25%; background-color: black; color : white" type=number min="0" max="50" value =0></label><br>
    <label style="background-color: red; color: white"> 16 <input name="cantidadApuesta16" style="width:25%; background-color: red" type=number min="0" max="50" value =0></label>
    <label style="background-color: black; color: white"> 17 <input name="cantidadApuesta17" style="width:25%; background-color: black; color : white" type=number min="0" max="50" value =0></label>
    <label style="background-color: red; color: white"> 18 <input name="cantidadApuesta18" style="width:25%; background-color: red" type=number min="0" max="50" value =0></label><br>
    <label style="background-color: red; color: white"> 19 <input name="cantidadApuesta19" style="width:25%; background-color: red" type=number min="0" max="50" value =0></label>
    <label style="background-color: black; color: white"> 20 <input name="cantidadApuesta20" style="width:25%; background-color: black; color : white" type=number min="0" max="50" value =0></label>
    <label style="background-color: red; color: white"> 21 <input name="cantidadApuesta21" style="width:25%; background-color: red" type=number min="0" max="50" value =0></label><br>
    <label style="background-color: black; color: white"> 22 <input name="cantidadApuesta22" style="width:25%; background-color: black; color : white" type=number min="0" max="50" value =0></label>
    <label style="background-color: red; color: white"> 23 <input name="cantidadApuesta23" style="width:25%; background-color: red" type=number min="0" max="50" value =0></label>
    <label style="background-color: black; color: white"> 24 <input name="cantidadApuesta24" style="width:25%; background-color: black; color : white" type=number min="0" max="50" value =0></label><br>
    <label style="background-color: red; color: white"> 25 <input name="cantidadApuesta25" style="width:25%; background-color: red" type=number min="0" max="50" value =0></label>
    <label style="background-color: black; color: white"> 26 <input name="cantidadApuesta26" style="width:25%; background-color: black; color : white" type=number min="0" max="50" value =0></label>
    <label style="background-color: red; color: white"> 27 <input name="cantidadApuesta27" style="width:25%; background-color: red" type=number min="0" max="50" value =0></label><br>
    <label style="background-color: black; color: white"> 28 <input name="cantidadApuesta28" style="width:25%; background-color: black; color : white" type=number min="0" max="50" value =0></label>
    <label style="background-color: black; color: white"> 29 <input name="cantidadApuesta29" style="width:25%; background-color: black; color : white" type=number min="0" max="50" value =0></label>
    <label style="background-color: red; color: white"> 30 <input name="cantidadApuesta30" style="width:25%; background-color: red" type=number min="0" max="50" value =0></label><br>
    <label style="background-color: black; color: white"> 31 <input name="cantidadApuesta31" style="width:25%; background-color: black; color : white" type=number min="0" max="50" value =0></label>
    <label style="background-color: red; color: white"> 32 <input name="cantidadApuesta32" style="width:25%; background-color: red" type=number min="0" max="50" value =0></label>
    <label style="background-color: black; color: white"> 33 <input name="cantidadApuesta33" style="width:25%; background-color: black; color : white" type=number min="0" max="50" value =0></label><br>
    <label style="background-color: red; color: white"> 34 <input name="cantidadApuesta34" style="width:25%; background-color: red" type=number min="0" max="50" value =0></label>
    <label style="background-color: black; color: white"> 35 <input name="cantidadApuesta35" style="width:25%; background-color: black; color : white" type=number min="0" max="50" value =0></label>
    <label style="background-color: red; color: white"> 36 <input name="cantidadApuesta36" style="width:25%; background-color: red" type=number min="0" max="50" value =0></label><br><br>
                
                <label> Rojo <input name="cantidadApuestaRojo" style="width:25%" type=number min="0" max="500" value =0></label>
                <label> Negro <input name="cantidadApuestaNegro" style="width:25%" type=number min="0" max="500" value =0></label><br><br>
                
                <label> Par <input name="cantidadApuestaPar" style="width:25%" type=number min="0" max="500" value =0></label>
                <label> Impar <input name="cantidadApuestaImpar" style="width:25%" type=number min="0" max="500" value =0></label><br><br>
                
                <label> Falta (1-18) <input name="cantidadApuestaFalta" style="width:25%" type=number min="0" max="500" value =0></label>
                <label> Pasa (19-36) <input name="cantidadApuestaPasa" style="width:25%" type=number min="0" max="500" value =0></label><br><br>
                
                <label> 1a columna <input name="cantidadApuesta1c" style="width:25%" type=number min="0" max="500" value =0></label><br>
                <label> 2a columna <input name="cantidadApuesta2c" style="width:25%" type=number min="0" max="500" value =0></label><br>
                <label> 3a columna <input name="cantidadApuesta3c" style="width:25%" type=number min="0" max="500" value =0></label><br><br>
                
                <label> 1a docena <input name="cantidadApuesta1d" style="width:25%" type=number min="0" max="500" value =0></label><br>
                <label> 2a docena <input name="cantidadApuesta2d" style="width:25%" type=number min="0" max="500" value =0></label><br>
                <label> 3a docena <input name="cantidadApuesta3d" style="width:25%" type=number min="0" max="500" value =0></label><br><br>
                
                <label> Juego <input name="cantidadApuestaJuego" style="width:25%" type=number min="0" max="500" value =0></label>
                <label> Vecinos <input name="cantidadApuestaVecinos" style="width:25%" type=number min="0" max="500" value =0></label><br>
                <label> Huérfanos <input name="cantidadApuestaHuerfanos" style="width:25%" type=number min="0" max="500" value =0></label>
                <label> Tercio <input name="cantidadApuestaTercio" style="width:25%" type=number min="0" max="500" value =0></label><br><br>
                
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
        
        