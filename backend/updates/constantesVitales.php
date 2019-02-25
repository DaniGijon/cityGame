<?php
    include("C:\wamp64\www\cityGame\system\connection.php");
    global $db;
    $sql = "SELECT * FROM personajes";
    $stmt = $db->query($sql);
    $result = $stmt->fetchAll();
    
    
    foreach($result as $cadaPersonaje){
        $idDelPersonaje = $cadaPersonaje['id'];
        $BonusEspiritu = 0;
        //Consultar qué objetos EQUIPADOS tiene el personaje
        $sql = "SELECT objetos.*, inventario.slot FROM inventario JOIN objetos ON inventario.idO = objetos.id WHERE inventario.idP = '$idDelPersonaje' AND inventario.slot <= 7";
        $stmt = $db->query($sql);
        $result = $stmt->fetchAll();

        foreach ($result as $objetosPersonaje) {
            $BonusEspiritu = $BonusEspiritu + $objetosPersonaje['espiritu'];  
        }
        
        $saludRecuperacion = 1 + ($cadaPersonaje['espiritu'] + $BonusEspiritu) * 0.1;
        $energiaRecuperacion = 5 + ($cadaPersonaje['espiritu'] + $BonusEspiritu) * 0.5;
       
        $sql = "UPDATE personajes SET salud = CASE WHEN salud + '$saludRecuperacion' > 100 THEN 100 ELSE salud + '$saludRecuperacion' END,"
                . "energia = CASE WHEN energia + '$energiaRecuperacion' > 100 THEN 100 ELSE energia + '$energiaRecuperacion' END WHERE id = '$idDelPersonaje'";
        $db->query($sql);
    }
?>