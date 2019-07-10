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
    echo "<span class = 'tituloSpot'>";
        echo "<h4>" . getNombreSpot(41) . "</h4>";
    echo "</span>";

    echo "<div class='contenido'>";
        echo "<span class='contenedor1'>"; 
         echo "<div class='seccionSpotOpciones'>";
         echo "<div class='semiTransparente'>"; 
          echo "<div class='textoDependiente'>";
            echo "\"Auténticas batallas aéreas con réplicas de legendarias naves. ¡Inscribe la tuya!\".";
          echo "</div>"; //FIN textoDependiente
          echo "<div class='imagenDependiente'>";
            echo '<img src="/design/img/dependientes/aviones.png">';
          echo "</div>"; //FIN imagenDependiente

            // Establecer la zona horaria predeterminada a usar
            date_default_timezone_set('Europe/Madrid');
            // Darle formato a la fecha y hora
            $inicio = date( "d/m/Y H:i:s", strtotime($timeStamp));
            
                $estoyInscrito = avionesEstoyInscrito();
                if($estoyInscrito === '1'){
                    echo "<br>¡Estoy Inscrito! <br><br>";
                }
                else{
                    //consultar que aviones tengo y hacer el formulario
                    avionesFormulario();
                }
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
                echo "</div>";
                echo "</div>"; //FIN DE div seccionSpotOpciones
            
            echo "</span>"; //Fin de Contenedor1
                    
                    echo "<span class='contenedor2'>";
                        
                                echo "<div class='seccionDescripcionZonaImagen'>";
                                    echo "La próxima batalla es: <b>" . $inicio . "</b><br><br>";    
                                    echo " <b>BOTE PREMIO ACUMULADO: " . $premio . "€</b><br><br>";
                                echo "</div>";
                                
                                echo "<div class='seccionDescripcionZonaTexto'>";
                                    avionesHistorial();
                                echo "</div>"; //Fin descripcionZonaTexto
                            echo "</div>"; //FIN opcionSpot2
                       
                    echo "</span>"; //FIN de contenedor2
                
            echo "</div>"; //FIN DE div contenido

        echo "</div>"; //FIN DE div moduloZona
        
        

