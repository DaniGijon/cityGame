<?php

    function listRivales(){
        global $db;
        $id = $_SESSION['loggedIn'];
        $sql = "SELECT * FROM personajes WHERE id != '$id' AND barrio = (SELECT barrio FROM personajes WHERE id='$id') AND zona = (SELECT zona FROM personajes WHERE id='$id')";
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
        
        echo "<a href='?page=attackPlayer&id=" . $id . "'><button>¡Emboscada!</button></a>";
    }
    
    function atacarJugador($id){
        include (__ROOT__.'/backend/comprobaciones.php');
        global $db;
        $miId = $_SESSION['loggedIn'];
        //Comprobar que mi rival esta en el mismo barrio que yo
        $estamosJuntos = comprobarZonaBarrioPersonajes($id,$miId);
        
        if($estamosJuntos === 1){

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

                $miResult = getPersonajeRow($miId);

                $suBonusDestreza = 0;
                $suBonusFuerza = 0;
                $suBonusAgilidad = 0;
                $suBonusResistencia = 0;
                $suBonusEspiritu = 0;
                $suBonusEstilo = 0;
                $suBonusIngenio = 0;
                $suBonusPercepcion = 0;

                $rivalResult = getPersonajeRow($id);

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
                
                //Calculados los atributos totales
                $miDestreza = $miResult[0]['destreza'] + $miBonusDestreza;
                $miFuerza = $miResult[0]['fuerza'] + $miBonusFuerza;
                $miAgilidad = $miResult[0]['agilidad'] + $miBonusAgilidad;
                $miResistencia = $miResult[0]['resistencia'] + $miBonusResistencia;
                $rivalDestreza = $rivalResult[0]['destreza'] + $suBonusDestreza;
                $rivalFuerza = $rivalResult[0]['fuerza'] + $suBonusFuerza;
                $rivalAgilidad = $rivalResult[0]['agilidad'] + $suBonusAgilidad;
                $rivalResistencia = $rivalResult[0]['resistencia'] + $suBonusResistencia;
                
                
                //COMBATE
                $rondas = 10;
                $miSalud = $miResult[0]['salud'];
                $rivalSalud = $rivalResult[0]['salud'];
                
                echo 'Salud inicial: ' . $miResult[0]['nombre'] . ' ' . $miSalud . ' //// ' . $rivalResult[0]['nombre'] . ' ' . $rivalSalud . '<br>';
                
                for($i = 1; $i <= $rondas; $i++){
                    
                    //Calcular cuanto sacan en esta ronda, y en caso de ser negativo, ponerlos a '0'
                    $rondaMiDestreza = rand($miDestreza-10, $miDestreza+10);
                    $rondaRivalAgilidad = rand($rivalAgilidad-10, $rivalAgilidad+10);
                    $rondaMiFuerza = rand($miFuerza-10, $miFuerza+10);
                    $rondaRivalResistencia = rand($rivalResistencia-10, $rivalResistencia+10);
                    $rondaRivalDestreza = rand($rivalDestreza-10, $rivalDestreza+10);
                    $rondaMiAgilidad = rand($miAgilidad-10, $miAgilidad+10);
                    $rondaRivalFuerza = rand($rivalFuerza-10, $rivalFuerza+10);
                    $rondaMiResistencia = rand($miResistencia-10, $miResistencia+10);
                    
                    if($rondaMiDestreza < 0){
                        $rondaMiDestreza = 0;
                    }
                    if($rondaRivalAgilidad < 0){
                        $rondaRivalAgilidad = 0;
                    }
                   
                    if($rondaMiFuerza < 0){
                        $rondaMiFuerza = 0;
                    }
                    if($rondaRivalResistencia < 0){
                        $rondaRivalResistencia = 0;
                    }
                   
                    if($rondaRivalDestreza < 0){
                        $rondaRivalDestreza = 0;
                    }
                    if($rondaMiAgilidad < 0){
                        $rondaMiAgilidad = 0;
                    }
                    
                    if($rondaRivalFuerza < 0){
                       $rondaRivalFuerza = 0;
                    }
                    if($rondaMiResistencia < 0){
                        $rondaMiResistencia = 0;
                    }
                    
                    echo '¡Comienza la ronda ' . $i . '!<br>';
                    $iniciativa = rand(1,2);
                    if($iniciativa === 1){
                        echo $miResult[0]['nombre'] . ' toma la iniciativa<br>';
                        echo $miResult[0]['nombre'] . ' intenta golpear con una destreza de ' . $rondaMiDestreza . '<br>';
                        echo $rivalResult[0]['nombre'] . ' quiere esquivar con una agilidad de ' . $rondaRivalAgilidad . '<br>';
                        if($rondaMiDestreza >= $rondaRivalAgilidad){
                            echo '¡' . $miResult[0]['nombre'] . ' golpea! A ver cuánto daño ha sido... <br>';
                            
                            //Ver si ha sido Golpe Crítico
                            $tiradaCritico = rand(1,5);
                            if($tiradaCritico < 5){
                                $daño = $rondaMiFuerza - $rondaRivalResistencia;
                            }
                            else{
                                echo '¡Golpe Crítico!<br>';
                                $daño = $rondaMiFuerza * 1.5 - $rondaRivalResistencia;
                            }
                            if($daño <= 0){
                                $daño = 0;
                            }
                            echo 'Daño = ' . $daño . '<br>';
                            $rivalSalud = $rivalSalud - $daño;
                            echo $rivalResult[0]['nombre'] . ' pierde ' . $daño . ' puntos de Salud. Le quedan ' . $rivalSalud . '<br>';
                            
                            if($rivalSalud <= 0){
                                hasGanado($id);
                                break;
                            }
                        }
                        else{
                            echo $rivalResult[0]['nombre'] . ' logra esquivar el golpe<br>';
                        }
                        echo 'Turno de ' . $rivalResult[0]['nombre'] . '<br>';
                        
                        echo $rivalResult[0]['nombre'] . ' intenta golpear con una destreza de ' . $rondaRivalDestreza . '<br>';
                        echo $miResult[0]['nombre'] . ' quiere esquivar con una agilidad de ' . $rondaMiAgilidad . '<br>';
                        if($rondaRivalDestreza >= $rondaMiAgilidad){
                            echo '¡' . $rivalResult[0]['nombre'] . ' golpea! A ver cuánto daño ha sido... <br>';
                            
                            //Ver si ha sido Golpe Crítico
                            $tiradaCritico = rand(1,5);
                            if($tiradaCritico < 5){
                                $daño = $rondaRivalFuerza - $rondaMiResistencia;
                            }
                            else{
                                echo '¡Golpe Crítico!<br>';
                                $daño = $rondaRivalFuerza * 1.5 - $rondaMiResistencia;
                            }
                            if($daño <= 0){
                                $daño = 0;
                            }
                            echo 'Daño = ' . $daño . '<br>';
                            $miSalud = $miSalud - $daño;
                            echo $miResult[0]['nombre'] . ' pierde ' . $daño . ' puntos de Salud. Le quedan ' . $miSalud . '<br>';
                            
                            if($miSalud <= 0){
                                hasPerdido($id);
                            break;
                            }
                        }
                        else{
                            echo $miResult[0]['nombre'] . 'logra esquivar el golpe<br>';
                        }
                    }
                    else{
                        echo $rivalResult[0]['nombre'] . ' toma la iniciativa<br>';
                        
                        echo $rivalResult[0]['nombre'] . ' intenta golpear con una destreza de ' . $rondaRivalDestreza . '<br>';
                        echo $miResult[0]['nombre'] . ' quiere esquivar con una agilidad de ' . $rondaMiAgilidad . '<br>';
                        if($rondaRivalDestreza >= $rondaMiAgilidad){
                            echo '¡' . $rivalResult[0]['nombre'] . ' golpea! A ver cuánto daño ha sido... <br>';
                            
                            //Ver si ha sido Golpe Crítico
                            $tiradaCritico = rand(1,5);
                            if($tiradaCritico < 5){
                                $daño = $rondaRivalFuerza - $rondaMiResistencia;
                            }
                            else{
                                echo '¡Golpe Crítico!<br>';
                                $daño = $rondaRivalFuerza * 1.5 - $rondaMiResistencia;
                            }
                            if($daño <= 0){
                                $daño = 0;
                            }
                            echo 'Daño = ' . $daño . '<br>';
                            $miSalud = $miSalud - $daño;
                            echo $miResult[0]['nombre'] . ' pierde ' . $daño . ' puntos de Salud. Le quedan ' . $miSalud . '<br>';
                            
                            if($miSalud <= 0){
                                hasPerdido($id);
                                break;
                            }
                        }
                        else{
                            echo $miResult[0]['nombre'] . ' logra esquivar el golpe<br>';
                        }
                        echo 'Turno de ' . $miResult[0]['nombre'] . '<br>';
                        
                        echo $miResult[0]['nombre'] . ' intenta golpear con una destreza de ' . $rondaMiDestreza . '<br>';
                        echo $rivalResult[0]['nombre'] . ' quiere esquivar con una agilidad de ' . $rondaRivalAgilidad . '<br>';
                        if($rondaMiDestreza >= $rondaRivalAgilidad){
                            echo '¡' . $miResult[0]['nombre'] . ' golpea! A ver cuánto daño ha sido... <br>';
                            
                            //Ver si ha sido Golpe Crítico
                            $tiradaCritico = rand(1,5);
                            if($tiradaCritico < 5){
                                $daño = $rondaMiFuerza - $rondaRivalResistencia;
                            }
                            else{
                                echo '¡Golpe Crítico!<br>';
                                $daño = $rondaMiFuerza * 1.5 - $rondaRivalResistencia;
                            }
                            if($daño <= 0){
                                $daño = 0;
                            }
                            echo 'Daño = ' . $daño . '<br>';
                            $rivalSalud = $rivalSalud - $daño;
                            echo $rivalResult[0]['nombre'] . ' pierde ' . $daño . ' puntos de Salud. Le quedan ' . $rivalSalud . '<br>';
                            
                            if($rivalSalud <= 0){
                                hasGanado($id);
                                break;
                            }
                        }
                        else{
                            echo $rivalResult[0]['nombre'] . 'logra esquivar el golpe<br>';
                        }
                    }
                    echo 'FIN DE RONDA<br>';
                    if($miSalud <= 0){
                        hasPerdido($id);
                        break;
                    }
                    elseif($rivalSalud <= 0){
                        hasGanado($id);
                        break;
                    }
                    else{
                        echo '(' . $rivalResult[0]['nombre'] . ' ' . $rivalSalud . ' //// ' . $miResult[0]['nombre'] . ' ' . $miSalud . ')<br><br>';
                    }
                }
                
                $misPuntos = $rivalResult[0]['salud'] - $rivalSalud;
                $rivalPuntos = $miResult[0]['salud'] - $miSalud;
                echo $miResult[0]['nombre'] . ' ha provocado ' . $misPuntos . ' puntos de daño a ' . $rivalResult[0]['nombre'] . '<br>';
                echo $rivalResult[0]['nombre'] . ' ha provocado ' . $rivalPuntos . ' puntos de daño a ' . $miResult[0]['nombre'] . '<br>';

                if($misPuntos > $rivalPuntos){
                    hasGanado($id);
                }
                if($misPuntos < $rivalPuntos){
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
        else{
            echo "No estamos en la misma zona.";
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
        $miResult = getPersonajeRow($miId);
        
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
        
        
        if($miResult[0]['agilidad'] + $bonusAgilidad > $monstruoResult[0]['agilidad']){
            $expGanada = rand($monstruoResult[0]['nivel'] * 10, $monstruoResult[0]['nivel'] * 20);
            
            $sql = "UPDATE personajes SET experiencia = personajes.experiencia + '$expGanada' WHERE id='$miId'";
            $stmt = $db->query($sql);
            
            return $expGanada;
        }
        else{
            //Salgo derrotado y me llevan al Hospital
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
        $rivalResult = getPersonajeRow($id);
        $miId = $_SESSION['loggedIn'];
        $miResult = getPersonajeRow($_SESSION['loggedIn']);
        
        //Calcular el dinero que le gano: entre un 5% y 25% de lo que lleve en cash
        $dineroPillado = rand(($rivalResult[0]['cash'])*0.05,($rivalResult[0]['cash'])*0.25);
        
        //Calcular el respeto que le gano
        $nivelDiferencia = $rivalResult[0]['nivel'] - $miResult[0]['nivel'];
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
        echo "FIN DE COMBATE <br>¡Lo hiciste! Ganas " . $dineroPillado . "€ y " . $respetoPillado . " puntos de Respeto";
        
        // Actualizo mi jugador
        $nuevoCash = $miResult[0]['cash'] + $dineroPillado;
        $nuevoRespeto = $miResult[0]['respeto'] + $respetoPillado;
        $sql = "UPDATE personajes SET cash = '$nuevoCash',respeto = '$nuevoRespeto' WHERE id='$miId'";
        $stmt = $db->query($sql);
        $stmt->fetchAll();
        
        // Actualizo el rival
        $nuevoCash = $rivalResult[0]['cash'] - $dineroPillado;
        if($rivalResult[0]['respeto'] >= $respetoPillado){
            $nuevoRespeto = $rivalResult[0]['respeto'] - $respetoPillado;
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
        $rivalResult = getPersonajeRow($id);
        $miId = $_SESSION['loggedIn'];
        $miResult = getPersonajeRow($_SESSION['loggedIn']);
        
        //Calcular el dinero que pierdo: entre un 5% y 25% de lo que llevo en cash
        $dineroPerdido = rand(($miResult[0]['cash'])*0.05,($miResult[0]['cash'])*0.25);
        
        //Calcular el respeto que pierdo
        $nivelDiferencia = $miResult[0]['nivel'] - $rivalResult[0]['nivel'];
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
        
        echo "FIN DE COMBATE <br>Qué desastre... Vuelves a casa llorando, todos se han reído de ti. Pierdes " . $dineroPerdido . "€ y " . $respetoPerdido . " puntos de Respeto";
        
        // Actualizo mi jugador
        $nuevoCash = $miResult[0]['cash'] - $dineroPerdido;
        if($miResult[0]['respeto'] >= $respetoPerdido){
            $nuevoRespeto = $miResult[0]['respeto'] - $respetoPerdido;
        }
        else{
            $nuevoRespeto = 0;
        }
        $sql = "UPDATE personajes SET cash = '$nuevoCash',respeto = '$nuevoRespeto' WHERE id='$miId'";
        $stmt = $db->query($sql);
        $stmt->fetchAll();
        
        //Actualizo el rival
        $rivalResult = getPersonajeRow($id);
        $nuevoCash = $rivalResult[0]['cash'] + $dineroPerdido;
        $nuevoRespeto = $rivalResult[0]['respeto'] + $respetoPerdido;
        $sql = "UPDATE personajes SET cash = '$nuevoCash',respeto = '$nuevoRespeto' WHERE id='$id'";
        $stmt = $db->query($sql);
        return $stmt->fetchAll();   
    }
    
?>
