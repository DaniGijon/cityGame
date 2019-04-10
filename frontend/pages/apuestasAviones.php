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
comprobarZona3Barrio2();

$timeStamp = avionesVerFecha();
$premio = avionesVerPremio();

echo "<div id='moduloZona'>";

    echo "<div class='contenido'>";
        echo "<div class='seccionSpotImagen'>" ;
            $imagenSpot = getAviones();
            echo $imagenSpot;
        echo "</div>"; //FIN DE div seccionSpotImagen

        echo "<div class='seccionSpotOpciones'>";
            echo "<br>'Auténticas batallas aéreas con réplicas de legendarios aviones. ¡Inscribe el tuyo!<br><br>";
            
            // Establecer la zona horaria predeterminada a usar
            date_default_timezone_set('Europe/Madrid');
            // Darle formato a la fecha y hora
            $inicio = date( "d/m/Y H:i:s", strtotime($timeStamp));
            echo "La próxima batalla es: <b>" . $inicio . "</b><br><br>";    
            echo " <b>BOTE PREMIO ACUMULADO: " . $premio . "€</b><br><br>"; 
            ?>
<center><table>
    <tr>
        <td>
            En este SURVIVAL gana la última nave que siga en vuelo. Elige bien con qué modelo volar y prepara tu estrategia.
        </td>
    </tr>
        
    <tr>
        <td height="1" bgcolor="black">
        </td>
    </tr>
    <tr>
        <td>
            <?php
                $estoyInscrito = avionesEstoyInscrito();
                if($estoyInscrito === '1'){
                    echo "<br>¡Estoy Inscrito! <br><br>";
                }
                else{
                    //consultar que aviones tengo y hacer el formulario
                    avionesFormulario();
                }
                ?>
        </form>     
        
        </td>
    </tr>
    <tr>
        <td height="1" bgcolor="black">
        </td>
    </tr>
    <tr>
        <td> <br>
            <?php
                avionesHistorial();
                
            ?>
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
        
        

