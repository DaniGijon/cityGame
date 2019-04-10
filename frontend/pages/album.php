<?php

    include (__ROOT__.'/backend/albumFunctions.php');
    
    //Para que imprima los mensajes de cuando se le redireccion a aqui
    if(isset($_GET['message'])){
        echo $_GET['message'] . "<br>";
    }
    
    echo"<div id='albumArea'>";
        dibujarAlbum();
    echo "</div>";
?>