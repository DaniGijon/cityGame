<?php
    
if(isset($_GET['id'])){
    include(__ROOT__."/backend/fightFunctions.php");

    listJugadorObjetivo($_GET['id']);
    
    
    
}
else{
    echo 'Tienes que elegir un jugador al que atacar.';
}

?>

