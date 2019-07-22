<?php
    
if(isset($_GET['id'])){
    include(__ROOT__."/backend/fightFunctions.php");

    listJugadorObjetivo($_GET['id']);  
    
}

elseif(isset($_POST['buscarJugador'])){
    include(__ROOT__."/backend/fightFunctions.php");
    $nombre = $_POST['buscarJugador'];
    $id = nombreAId($nombre);
    if($id === 0){
        echo "Jaja ¿De verdad existe alguien con ese nombre tan estúpido?";
    }
    else
    listJugador($id);  
    
}

else{
    echo 'Tienes que elegir un jugador al que atacar.';
}

?>

