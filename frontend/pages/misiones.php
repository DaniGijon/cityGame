<?php

    include (__ROOT__.'/backend/misionesFunctions.php');
    
    //Para que imprima los mensajes de cuando se le redireccion a aqui
    if(isset($_GET['message'])){
        echo $_GET['message'] . "<br>";
    }
    
     $id = $_SESSION['loggedIn'];
    
    echo"<div id='misionesArea'>";
        dibujarMisiones($id);
    echo "</div>";
?>