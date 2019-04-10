<?php
    include("C:\wamp64\www\cityGame\system\connection.php");
    global $db;
    
    //CONSULTAR LOS PARTICIPANTES
    $sql = "SELECT * FROM personajes WHERE survival = '1'";
    $stmt = $db->query($sql);
    $result = $stmt->fetchAll();
    
    //HACER SORTEO Y TAL
    $sql = "SELECT COUNT(*) FROM personajes WHERE survival = '1'";
    $stmt = $db->query($sql);
    $cuenta = $stmt->fetchAll();
    $tope = $cuenta[0]['COUNT(*)'];
    $max = $tope - 1;
    
    $numeroGanador = rand(0,$max);
    $ganador = $result[$numeroGanador]['id'];
    
    //ACTUALIZAR LA TABLA survivals fijando quien es el ganador
    $sql = "UPDATE survivals SET ganador = '$ganador' WHERE id='1'";
    $db->query($sql);
    
    //EL GANADOR COBRA EL PREMIO
    $sql = "SELECT premio FROM survivals WHERE id = '1'";
    $stmt = $db->query($sql);
    $obtengo = $stmt->fetchAll();
    
    $premio = $obtengo[0]['premio'];
    $sql = "UPDATE personajes SET cash = cash + '$premio' WHERE id='$ganador'";
    $db->query($sql);
   
    //ACTUALIZAR LA TABLA survivals moviendo partidas
    $sql = "SELECT COUNT(*) FROM survivals";
    $stmt = $db->query($sql);
    $cuenta = $stmt->fetchAll();
    $indice = $cuenta[0]['COUNT(*)'];
    
    $sql = "UPDATE survivals SET id = $indice WHERE id=1";
    $db->query($sql);
    
    $sql = "UPDATE survivals SET id = 1 WHERE id=0";
    $db->query($sql);
    

    //RESTABLECER QUE EL PERSONAJE NO ESTA INSCRITO A LA SIGUIENTE SURVIVAL
    foreach($result as $participante){
        $idParticipante = $participante['id'];
        $sql = "UPDATE personajes SET survival = '0' WHERE id='$idParticipante'";
        $db->query($sql);
    }
    
    
   
    
?>