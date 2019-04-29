<?php
    include (__ROOT__.'/backend/ciudadFunctions.php');
    $id = $_SESSION['loggedIn'];
    
    echo"<div id='ciudadArea'>";
        dibujarCiudad($id,0,1);
    echo "</div>";

?>