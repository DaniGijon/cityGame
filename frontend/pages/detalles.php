<?php
    include (__ROOT__.'/backend/misionesFunctions.php');
    //Para que imprima los mensajes de cuando se le redirecciona a aqui
    if(isset($_GET['message'])){
        $contenido = lectura($_GET['message']);
        echo $contenido . "<br>";
    }
    
    echo"<a href='?page=misiones'><button>Volver a Misiones</button></a>";
?>