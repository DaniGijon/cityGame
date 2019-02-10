<?php

    function listRivales(){
        global $db;
        $id = $_SESSION['loggedIn'];
        $sql = "SELECT * FROM personajes WHERE id != $id";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        
        $result = $stmt->fetchAll();
        
        foreach ($result as $rivales) {
            echo "<a href='?page=jugadorRival&id=" .$rivales['id'] . "'>" . $rivales['nombre'] . "</a><br>";
            
        }
       
    }
    
    function listJugadorObjetivo($id){
        global $db;
        include(__ROOT__."/backend/personajeFunctions.php");
        
        listJugadorRival($id);
        
        echo "<a href='?page=attackPlayer&id=" . $id . "'><button>Attack</button></a>";
    }
    
    function atacarJugador($id){
        global $db;
        
        $opponentResult = getPersonajeRow($id);
        $yourResult = getPersonajeRow($_SESSION['loggedIn']);
    
        if($yourResult[0]['agilidad'] > $opponentResult[0]['agilidad']){
            hasGanado($id);
        }
        else{
            hasPerdido($id);
        }
    }
    
    function getPersonajeRow($id){
        global $db;
        $sql = "SELECT * FROM personajes WHERE id=?";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($id));
        return $stmt->fetchAll();
    
    } 
    
    
    function hasGanado($id){
        global $db;
        echo '¡Enhorabuena! Ganas 10 Euros y 30 puntos de Respeto';
        
        // Actualizo mi jugador
        $miId = $_SESSION['loggedIn'];
        $yourResult = getPersonajeRow($_SESSION['loggedIn']);
        $nuevoCash = $yourResult[0]['cash'] + 10;
        $nuevoRespeto = $yourResult[0]['respeto'] +30;
        $sql = "UPDATE personajes SET cash = '$nuevoCash',respeto = '$nuevoRespeto' WHERE id='$miId'";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($id));
        $stmt->fetchAll();
        
        // Actualizo el rival
        $opponentResult = getPersonajeRow($id);
        $nuevoCash = $opponentResult[0]['cash'] - 10;
        $nuevoRespeto = $opponentResult[0]['respeto'] - 20;
        $sql = "UPDATE personajes SET cash = '$nuevoCash',respeto = '$nuevoRespeto' WHERE id='$id'";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($id));
        return $stmt->fetchAll();
    }
    
    function hasPerdido($id){
        global $db;
        echo 'Qué pena... Vuelves a casa con 10 Euros menos y además todos se ríen de ti. Pierdes 20 puntos de Respeto';
        
        // Actualizo mi jugador
        $miId = $_SESSION['loggedIn'];
        $yourResult = getPersonajeRow($_SESSION['loggedIn']);
        $nuevoCash = $yourResult[0]['cash'] - 10;
        $nuevoRespeto = $yourResult[0]['respeto'] - 20;
        $sql = "UPDATE personajes SET cash = '$nuevoCash',respeto = '$nuevoRespeto' WHERE id='$miId'";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($id));
        $stmt->fetchAll();
        
        //Actualizo el rival
        $opponentResult = getPersonajeRow($id);
        $nuevoCurrentMoney = $opponentResult[0]['cash'] + 10;
        $nuevoRespeto = $opponentResult[0]['respeto'] + 0;
        $sql = "UPDATE personajes SET cash = '$nuevoCash',respeto = '$nuevoRespeto' WHERE id='$id'";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($id));
        return $stmt->fetchAll();   
    }
    
?>
