<?php
    include (__ROOT__.'/backend/mensajesFunctions.php');
    //Para que imprima los mensajes de cuando se le redirecciona a aqui
    if(isset($_GET['message'])){
        $contenido = lectura($_GET['message']);
        echo $contenido . "<br>";
    }
    
    echo"<a href='?page=mensajes'><button>Volver a Bandeja</button></a>";
?>