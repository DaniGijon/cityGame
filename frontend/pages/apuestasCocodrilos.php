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
comprobarZona1Barrio1();

echo "<div id='moduloZona'>";
            echo "<span class = 'tituloSpot'>";
                echo "<h4>" . getNombreSpot(2) . "</h4>";
            echo "</span>"; 

    echo "<div class='contenido'>";
    echo "<span class='contenedor1'>";
       /* echo "<div class='seccionSpotImagen'>" ;
            $imagenSpot = getFotoSpot(2);
            echo $imagenSpot;
        echo "</div>"; //FIN DE div seccionSpotImagen*/

        echo "<div class='seccionSpotOpciones'>";
            echo "<div class='semiTransparente'>"; 
                echo "<div class='textoDependiente'>";
                    echo "\"El evento principal del Campeonato de Carreras de Cocodrilos. ¡Hagan sus apuestas!\"";
                echo "</div>"; //FIN textoDependiente
                echo "<div class='imagenDependiente'>";
                    echo '<img src="/design/img/dependientes/apuestasCocodrilos.png">';
                echo "</div>"; //FIN imagenDependiente
           
              
            ?>
<form id = "selectorOpciones" action="?bPage=apuestas&action=cocodrilos&nonUI" method="post">
    <table border = '0' style = 'text-align:center'>
        <tr>
            <th>Corredor</th>
            <th>Premio</th>
            <th>Cantidad a Apostar</th>
        </tr>
        
        <tr>
            <td>
                Crocky Balboa
            </td>
            <td>
                x3
            </td>
            <td>
                <label><input name="cantidadApuesta1" style="width:50%; border-radius:10px;" type=number min="0" value =0><img src='/design/img/iconos/monedaTop.png' style='vertical-align: bottom'></label>
            </td>
        </tr>
        
        <tr>
            <td>
                Mellao
            </td>
            <td>
                x4
            </td>
            <td>
                <label><input name="cantidadApuesta2" style="width:50%; border-radius:10px;" type=number min="0" value =0><img src='/design/img/iconos/monedaTop.png' style='vertical-align: bottom'></label>
            </td>
        </tr>
        
        <tr>
            <td>
                Cai-Man
            </td>
            <td>
                x5
            </td>
            <td>
                <label><input name="cantidadApuesta3" style="width:50%; border-radius:10px;" type=number min="0" value =0><img src='/design/img/iconos/monedaTop.png' style='vertical-align: bottom'></label>
            </td>
        </tr>
        
        <tr>
            <td>
                Totodile
            </td>
            <td>
                x6
            </td>
            <td>
                <label><input name="cantidadApuesta4" style="width:50%; border-radius:10px;" type=number min="0" value =0><img src='/design/img/iconos/monedaTop.png' style='vertical-align: bottom'></label>
            </td>
        </tr>
        
        <tr>
            <td>
                Rumbera
            </td>
            <td>
                x8
            </td>
            <td>
                <label><input name="cantidadApuesta5" style="width:50%; border-radius:10px;" type=number min="0" value =0><img src='/design/img/iconos/monedaTop.png' style='vertical-align: bottom'></label>
            </td>
        </tr>
        
        <tr>
            <td>
               Old-Jack
            </td>
            <td>
                x10
            </td>
            <td>
                <label><input name="cantidadApuesta6" style="width:50%; border-radius:10px;" type=number min="0" value =0><img src='/design/img/iconos/monedaTop.png' style='vertical-align: bottom'></label>
            </td>
        </tr>
        
        <tr>
            <td>
                Plátano
            </td>
            <td>
                x41
            </td>
            <td>
                <label><input name="cantidadApuesta7" style="width:50%; border-radius:10px;" type=number min="0" value =0><img src='/design/img/iconos/monedaTop.png' style='vertical-align: bottom'></label>
            </td>
        </tr>
            
    </table>
        <div class='submitTienda'>
            <input type='submit' class='botonApostar' value=' '>
        </div>
                
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
                echo "</div>"; //Fin de semiTransparente   
                echo "</div>"; //FIN DE div seccionSpotOpciones

             echo "</span>";
             echo "<span class='contenedor2'>";
             echo "Aqui una tarjeta con info de cada corredor";
             echo "</span>";
            echo "</div>"; //FIN DE div contenido

        echo "</div>"; //FIN DE div moduloZona
        
        
