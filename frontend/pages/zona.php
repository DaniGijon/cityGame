<?php
    include (__ROOT__.'/backend/zonaFunctions.php');
    $id = $_SESSION['loggedIn'];
    
    //Para que imprima los mensajes de cuando se le redireccion a aqui
    if(isset($_GET['message'])){
        echo "<div id=seccionMessage>";
            echo $_GET['message'] . "<br>";
        echo "</div>";
    }
    
    echo"<div id='zonaArea'>";
        dibujarZona($id,0);
    echo "</div>";

?>