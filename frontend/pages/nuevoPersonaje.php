<?php
    include (__ROOT__.'/backend/personajeFunctions.php');
    include (__ROOT__.'/backend/comprobaciones.php');
    if(isset($_GET['message'])){
        echo $_GET['message'] . "<br>";
    }
    //COMPROBACION PARA QUE NO ME HAGAN INYECCION SQL NI NINGUNA TRAMPA
    $bien = comprobarEsNuevoPersonaje();
    if($bien === 1){
        echo"<div id='nuevoPersonajeArea'>";
          nuevoPersonaje();
        echo "</div>";
    }
    else{
        echo "No hagas trampas";
    }
    
?>



