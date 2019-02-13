<?php

    function listRivales(){
        global $db;
        $id = $_SESSION['loggedIn'];
        $sql = "SELECT * FROM personajes WHERE id != '$id' AND barrio = (SELECT barrio FROM personajes WHERE id='$id')";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        
        $result = $stmt->fetchAll();
        
        foreach ($result as $rivales) {
            echo "<a href='?page=jugadorRival&id=" .$rivales['id'] . "'>" . $rivales['nombre'] . " (Nivel: " . $rivales['nivel'] . ")" . "</a><br>";
            
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
        $miId = $_SESSION['loggedIn'];
        
        $opponentResult = getPersonajeRow($id);
        $yourResult = getPersonajeRow($_SESSION['loggedIn']);
    
        if($yourResult[0]['agilidad'] > $opponentResult[0]['agilidad']){
            hasGanado($id);
        }
        else{
            hasPerdido($id);
        }
        
        //El atacante pierde energía
        $nuevoEnergia = rand(30,100);
        $sql = "UPDATE personajes SET energia = energia-'$nuevoEnergia' WHERE id='$miId'";
        $stmt = $db->query($sql);
        $stmt->fetchAll();
        
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
        $opponentResult = getPersonajeRow($id);
        $miId = $_SESSION['loggedIn'];
        $yourResult = getPersonajeRow($_SESSION['loggedIn']);
        
        //Calcular el dinero que le gano: entre un 5% y 25% de lo que lleve en cash
        $dineroPillado = rand(($opponentResult[0]['cash'])*0.05,($opponentResult[0]['cash'])*0.25);
        
        //Calcular el respeto que le gano
        $nivelDiferencia = $opponentResult[0]['nivel'] - $yourResult[0]['nivel'];
        if($nivelDiferencia > 2){
            $respetoPillado = rand(80,100);
        }
        elseif($nivelDiferencia > 0 && $nivelDiferencia <= 2){
            $respetoPillado = rand(30,50);
        }
        elseif($nivelDiferencia == 0){
            $respetoPillado = rand(10,20);
        }
        else{
            $respetoPillado = rand(1,9);
        }
        echo "¡Lo hiciste! Ganas " . $dineroPillado . "€ y " . $respetoPillado . " puntos de Respeto";
        
        // Actualizo mi jugador
        $nuevoCash = $yourResult[0]['cash'] + $dineroPillado;
        $nuevoRespeto = $yourResult[0]['respeto'] + $respetoPillado;
        $sql = "UPDATE personajes SET cash = '$nuevoCash',respeto = '$nuevoRespeto' WHERE id='?'";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($miId));
        $stmt->fetchAll();
        
        // Actualizo el rival
        $nuevoCash = $opponentResult[0]['cash'] - $dineroPillado;
        $nuevoRespeto = $opponentResult[0]['respeto'] - $respetoPillado;
        $sql = "UPDATE personajes SET cash = '$nuevoCash',respeto = '$nuevoRespeto' WHERE id='?'";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($id));
        return $stmt->fetchAll();
    }
    
    function hasPerdido($id){
        global $db;
        $opponentResult = getPersonajeRow($id);
        $miId = $_SESSION['loggedIn'];
        $yourResult = getPersonajeRow($_SESSION['loggedIn']);
        
        //Calcular el dinero que pierdo: entre un 5% y 25% de lo que llevo en cash
        $dineroPerdido = rand(($yourResult[0]['cash'])*0.05,($yourResult[0]['cash'])*0.25);
        
        //Calcular el respeto que pierdo
        $nivelDiferencia = $yourResult[0]['nivel'] - $opponentResult[0]['nivel'];
        if($nivelDiferencia > 2){
            $respetoPerdido = rand(80,100);
        }
        elseif($nivelDiferencia > 0 && $nivelDiferencia <= 2){
            $respetoPerdido = rand(30,50);
        }
        elseif($nivelDiferencia == 0){
            $respetoPerdido = rand(10,20);
        }
        else{
            $respetoPerdido = rand(1,9);
        }
        
        echo "Qué desastre... Vuelves a casa llorando, todos se han reído de ti. Pierdes " . $dineroPerdido . "€ y " . $respetoPerdido . " puntos de Respeto";
        
        // Actualizo mi jugador
        $nuevoCash = $yourResult[0]['cash'] - $dineroPerdido;
        $nuevoRespeto = $yourResult[0]['respeto'] - $respetoPerdido;
        $sql = "UPDATE personajes SET cash = '$nuevoCash',respeto = '$nuevoRespeto' WHERE id='$miId'";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($id));
        $stmt->fetchAll();
        
        //Actualizo el rival
        $opponentResult = getPersonajeRow($id);
        $nuevoCash = $opponentResult[0]['cash'] + $dineroPerdido;
        $nuevoRespeto = $opponentResult[0]['respeto'] + $respetoPerdido;
        $sql = "UPDATE personajes SET cash = '$nuevoCash',respeto = '$nuevoRespeto' WHERE id='$id'";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($id));
        return $stmt->fetchAll();   
    }
    
?>
