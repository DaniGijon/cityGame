<?php
    //Cada vez que se ejecuta, la popularidad de cada slot va a deteriorarse entre 0 y 10 puntos.
    //Hay que generar un mensaje-notificación cada vez que esto ocurra para informar al jugador
    //También hay que actualizar el campo "Popularidad" de la tabla personajes
    include("C:\wamp64\www\cityGame\system\connection.php");
    global $db;
    
    //Hago una preconsulta con la popularidad que tiene cada personaje antes del deterioro, para luego informar en el mensaje
    $sql = "SELECT idP,AVG(puntos) FROM popularidad GROUP BY idP";
    $stmt = $db->query($sql);
    $pre = $stmt->fetchAll();
    
    //Genero el deterioro de cada spot de cada personaje
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
    
    //Ahora voy a actualizar el campo "Popularidad" de la tabla de personajes para cada personaje
    $sql = "SELECT idP,AVG(puntos) FROM popularidad GROUP BY idP";
    $stmt = $db->query($sql);
    $result = $stmt->fetchAll();
    
    $i = -1;
    foreach($result as $cadaPesonaje){
        $i = $i+1;
        $media = round($cadaPesonaje['AVG(puntos)'], 2, PHP_ROUND_HALF_DOWN);
        $personaje = $cadaPesonaje['idP'];
        $sql = "UPDATE personajes SET popularidad = $media WHERE id = '$personaje'";
        $db->query($sql);
        
        //Generar mensaje-notificacion informando del deterioro que se ha producido
        $deterioro = round($media - $pre[$i]['AVG(puntos)'], 2, PHP_ROUND_HALF_DOWN);
        $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$personaje','Deterioro Popularidad','Lamentablemente, la gente va olvidando día a día lo importante que fuiste una vez para ellos. Hoy mi Popularidad en Puertollano ha caído $deterioro puntos. Ahora tengo un $media% de reconocimiento entre mis vecinos.','deterioro.png')";
        $db->query($sql);
    }
?>