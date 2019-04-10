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
comprobarZona1Barrio6();

echo "<div id='moduloZona'>";

    echo "<div class='contenido'>";
        echo "<div class='seccionSpotImagen'>" ;
            $imagenSpot = getLuckia();
            echo $imagenSpot;
        echo "</div>"; //FIN DE div seccionSpotImagen

        echo "<div class='seccionSpotOpciones'>";
            echo "<br>'Din din din! Las máquinas tragaperras suenan sin parar. ¡Hagan sus apuestas!<br><br>";
            echo " Llevo " . $dineroEnCash . "€ en el bolsillo.<br><br>";    
            ?>
<center><table>
    <tr>
        <td>
            El <b>JACKPOT</b> actual es : <b>
                <?php 
                $jackpot = getJackpotLuckia(); 
                echo $jackpot;
                ?>€</b>
        </td>
    </tr>
    <tr>
        <td>
            La apuesta máxima es : 100€
        </td>
    </tr>
    <tr>
        <td>
            La apuesta mínima es : 10€
        </td>
    </tr>
    <tr>
        <td height="1" bgcolor="black">
        </td>
    </tr>
    <tr>
        <td>
        <form id = "selectorOpciones" action="?bPage=apuestas&action=tragaperras&nonUI" method="post">
                    <center><label> <br><input name="cantidadApuesta1" style="width:25%" type=number min="0" value =0>€</label><br>

                    <input type="submit" value="¡Apostar!"></center>
        </form> 
        </td>
    </tr>
    <tr>
        <td height="1" bgcolor="black">
        </td>
    </tr>
    <tr>
        <td align="center" style="text-align: center">
            <img src="/design/img/apuestas/premiosTragaperras.gif">
        </td>
    </tr>
      
    </table></center>
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
        
        

