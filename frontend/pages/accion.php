<?php
    include (__ROOT__.'/backend/zonaFunctions.php');
    
    
    //Para que imprima los mensajes de cuando se le redirecciona a aqui
    if(isset($_GET['message'])){
        echo $_GET['message'] . "<br>";
    }
    
    echo"<a href='?page=zona'><button>Seguir</button></a>";
?>