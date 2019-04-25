<?php
    include("C:\wamp64\www\cityGame\system\connection.php");
    global $db;
    
    $sql = "SELECT * FROM popularidad";
    $stmt = $db->query($sql);
    $result = $stmt->fetchAll();
    
    
    foreach($result as $cadaFila){
        $idDelPersonaje = $cadaFila['idP'];
        $idDelSpot = $cadaFila['idS'];
        
        $deterioro = rand(0,10);
        $sql = "UPDATE popularidad SET puntos = CASE WHEN popularidad.puntos - '$deterioro' < 0 THEN 0 ELSE popularidad.puntos - '$deterioro' END WHERE idP='$idDelPersonaje' AND idS='$idDelSpot'";
        $db->query($sql);
    }
   /* 
    //Consulto cuantos personajes diferentes existen en la tabla de Popularidad
    $sql = "SELECT COUNT(*) FROM popularidad";
    $stmt = $db->query($sql);
    $result = $stmt->fetchAll();
    
    $cantidadUsuarios = $result[0]['COUNT(*)'] / 10;
    
    //Consulto mi nuevo porcentaje general de popularidad (AVG)
    $sql = "SELECT AVG(puntos) FROM popularidad WHERE idP = '$id'";
    $stmt = $db->query($sql);
    $result = $stmt->fetchAll();

    $popularidadAVG = $result[0]['AVG(puntos)'];
    */
?>