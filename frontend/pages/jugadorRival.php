<?php
    
if(isset($_GET['id'])){
    include(__ROOT__."/backend/fightFunctions.php");

    listJugadorObjetivo($_GET['id']);  
    
}

elseif(isset($_POST['buscarJugador'])){
    include(__ROOT__."/backend/fightFunctions.php");
    $nombre = $_POST['buscarJugador'];
    $id = nombreAId($nombre);
    listJugadorObjetivo($id);  
    
}

else{
    var_dump($_POST['buscarJugador']);
    echo 'Tienes que elegir un jugador al que atacar.';
}

?>

