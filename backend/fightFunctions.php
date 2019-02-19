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
        include (__ROOT__.'/backend/comprobaciones.php');
        global $db;
        $miId = $_SESSION['loggedIn'];
        
        //Comprobar que tengo energia para hacer esto
        $agotamiento = 50;
        $puedoHacerlo = comprobarEnergia($agotamiento);
        
        if($puedoHacerlo === 1){

            $miBonusDestreza = 0;
            $miBonusFuerza = 0;
            $miBonusAgilidad = 0;
            $miBonusResistencia = 0;
            $miBonusEspiritu = 0;
            $miBonusEstilo = 0;
            $miBonusIngenio = 0;
            $miBonusPercepcion = 0;

            $yourResult = getPersonajeRow($miId);

            $suBonusDestreza = 0;
            $suBonusFuerza = 0;
            $suBonusAgilidad = 0;
            $suBonusResistencia = 0;
            $suBonusEspiritu = 0;
            $suBonusEstilo = 0;
            $suBonusIngenio = 0;
            $suBonusPercepcion = 0;

            $opponentResult = getPersonajeRow($id);

            //Consultar que objetos tiene mi personaje en cada slot (se ordenan por slot)
            $sql = "SELECT objetos.*, inventario.slot FROM inventario JOIN objetos ON inventario.idO = objetos.id WHERE inventario.idP = '$miId'";
            $stmt = $db->query($sql);
            $result = $stmt->fetchAll();

            foreach ($result as $objetosPersonaje) {
                $miBonusDestreza = $miBonusDestreza + $objetosPersonaje['destreza'];
                $miBonusFuerza = $miBonusFuerza + $objetosPersonaje['fuerza'];
                $miBonusAgilidad = $miBonusAgilidad + $objetosPersonaje['agilidad'];
                $miBonusResistencia = $miBonusResistencia + $objetosPersonaje['resistencia'];
                $miBonusEspiritu = $miBonusEspiritu + $objetosPersonaje['espiritu'];
                $miBonusEstilo = $miBonusEstilo + $objetosPersonaje['estilo'];
                $miBonusIngenio = $miBonusIngenio + $objetosPersonaje['ingenio'];
                $miBonusPercepcion = $miBonusPercepcion + $objetosPersonaje['percepcion'];
            }

            //Consultar que objetos tiene su personaje en cada slot (se ordenan por slot)
            $sql = "SELECT objetos.*, inventario.slot FROM inventario JOIN objetos ON inventario.idO = objetos.id WHERE inventario.idP = '$id'";
            $stmt = $db->query($sql);
            $result = $stmt->fetchAll();

            foreach ($result as $objetosRival) {
                $suBonusDestreza = $suBonusDestreza + $objetosRival['destreza'];
                $suBonusFuerza = $suBonusFuerza + $objetosRival['fuerza'];
                $suBonusAgilidad = $suBonusAgilidad + $objetosRival['agilidad'];
                $suBonusResistencia = $suBonusResistencia + $objetosRival['resistencia'];
                $suBonusEspiritu = $suBonusEspiritu + $objetosRival['espiritu'];
                $suBonusEstilo = $suBonusEstilo + $objetosRival['estilo'];
                $suBonusIngenio = $suBonusIngenio + $objetosRival['ingenio'];
                $suBonusPercepcion = $suBonusPercepcion + $objetosRival['percepcion'];
            }

            if($yourResult[0]['agilidad'] + $miBonusAgilidad > $opponentResult[0]['agilidad'] + $suBonusAgilidad){
                hasGanado($id);
            }
            else{
                hasPerdido($id);
            }

            //El atacante pierde energía
            //Aunque el minimo para atacar sea tener 50, puede ser interesante que a veces no le agote del todo a 0. 
            $restaEnergia = rand(30,100);
            $sql = "UPDATE personajes SET energia = CASE WHEN energia-'$restaEnergia' < 0 THEN 0 ELSE energia-'$restaEnergia' END WHERE id='$miId'";
            $stmt = $db->query($sql);
            $stmt->fetchAll();
        }
        else{
                echo "¡Ay! Estoy sin energia ahora mismo para hacer eso";
            }
    }
    
    function atacarMonstruo($idMonstruo){
        global $db;
        $miId = $_SESSION['loggedIn'];
        
        $bonusDestreza = 0;
        $bonusFuerza = 0;
        $bonusAgilidad = 0;
        $bonusResistencia = 0;
        $bonusEspiritu = 0;
        $bonusEstilo = 0;
        $bonusIngenio = 0;
        $bonusPercepcion = 0;
        
        $monstruoResult = getMonstruoRow($idMonstruo);
        $yourResult = getPersonajeRow($miId);
        
        //Consultar que objetos tiene el personaje en cada slot (se ordenan por slot)
        $sql = "SELECT objetos.*, inventario.slot FROM inventario JOIN objetos ON inventario.idO = objetos.id WHERE inventario.idP = '$miId'";
        $stmt = $db->query($sql);
        $result = $stmt->fetchAll();
        
        foreach ($result as $objetosPersonaje) {
            $bonusDestreza = $bonusDestreza + $objetosPersonaje['destreza'];
            $bonusFuerza = $bonusFuerza + $objetosPersonaje['fuerza'];
            $bonusAgilidad = $bonusAgilidad + $objetosPersonaje['agilidad'];
            $bonusResistencia = $bonusResistencia + $objetosPersonaje['resistencia'];
            $bonusEspiritu = $bonusEspiritu + $objetosPersonaje['espiritu'];
            $bonusEstilo = $bonusEstilo + $objetosPersonaje['estilo'];
            $bonusIngenio = $bonusIngenio + $objetosPersonaje['ingenio'];
            $bonusPercepcion = $bonusPercepcion + $objetosPersonaje['percepcion'];
        }
        
        
        if($yourResult[0]['agilidad'] + $bonusAgilidad > $monstruoResult[0]['agilidad']){
            $expGanada = rand($monstruoResult[0]['nivel'] * 10, $monstruoResult[0]['nivel'] * 20);
            
            $sql = "UPDATE personajes SET experiencia = personajes.experiencia + '$expGanada' WHERE id='$miId'";
            $stmt = $db->query($sql);
            
            return $expGanada;
        }
        else{
            $sql = "UPDATE personajes SET salud = '0',barrio = '9', zona = '1' WHERE id='$miId'";
            $stmt = $db->query($sql);
        
            return 0;
        }
        
    }
    
    function getPersonajeRow($id){
        global $db;
        $sql = "SELECT * FROM personajes WHERE id=?";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($id));
        return $stmt->fetchAll();
    
    } 
    
    function getMonstruoRow($idMonstruo){
        global $db;
        $sql = "SELECT * FROM monstruos WHERE idM=?";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($idMonstruo));
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
        $sql = "UPDATE personajes SET cash = '$nuevoCash',respeto = '$nuevoRespeto' WHERE id='$miId'";
        $stmt = $db->query($sql);
        $stmt->fetchAll();
        
        // Actualizo el rival
        $nuevoCash = $opponentResult[0]['cash'] - $dineroPillado;
        if($opponentResult[0]['respeto'] >= $respetoPillado){
            $nuevoRespeto = $opponentResult[0]['respeto'] - $respetoPillado;
        }
        else{
            $nuevoRespeto = 0;
        }
        $sql = "UPDATE personajes SET cash = '$nuevoCash',respeto = '$nuevoRespeto' WHERE id='$id'";
        $stmt = $db->query($sql);
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
        if($yourResult[0]['respeto'] >= $respetoPerdido){
            $nuevoRespeto = $yourResult[0]['respeto'] - $respetoPerdido;
        }
        else{
            $nuevoRespeto = 0;
        }
        $sql = "UPDATE personajes SET cash = '$nuevoCash',respeto = '$nuevoRespeto' WHERE id='$miId'";
        $stmt = $db->query($sql);
        $stmt->fetchAll();
        
        //Actualizo el rival
        $opponentResult = getPersonajeRow($id);
        $nuevoCash = $opponentResult[0]['cash'] + $dineroPerdido;
        $nuevoRespeto = $opponentResult[0]['respeto'] + $respetoPerdido;
        $sql = "UPDATE personajes SET cash = '$nuevoCash',respeto = '$nuevoRespeto' WHERE id='$id'";
        $stmt = $db->query($sql);
        return $stmt->fetchAll();   
    }
    
?>
