<?php

    function listRivales(){
        global $db;
        $id = $_SESSION['loggedIn'];
        $sql = "SELECT id, nivel, nombre FROM personajes WHERE id != '$id' AND barrio = (SELECT barrio FROM personajes WHERE id='$id') AND zona = (SELECT zona FROM personajes WHERE id='$id')";
        $stmt = $db->prepare($sql);
        $stmt->execute();       
        $result = $stmt->fetchAll();
        
        $sql = "SELECT COUNT(*) FROM personajes WHERE id != '$id' AND barrio = (SELECT barrio FROM personajes WHERE id='$id') AND zona = (SELECT zona FROM personajes WHERE id='$id')";
        $stmt = $db->prepare($sql);
        $stmt->execute();       
        $total = $stmt->fetchAll();
        
        if($total[0]['COUNT(*)'] === '0'){
            echo "No veo a nadie.";
        }
        
        else{
        
            $limiteMax = $total[0]['COUNT(*)']-1;

            $propuesta = rand(0, $limiteMax);

            echo "<div class='opcionesTienda'>";
                echo "<div class='opcionesTiendaTitulo' style='text-align:center'>";
                    echo "<a href='?page=jugadorRival&id=" . $result[$propuesta]['id'] . "'>"  . $result[$propuesta]['nombre'];
                echo "</div>";
                echo '<div id="opcionBox">' . '<img src="/design/img/objetos/307.png">' . '</div><div class="nivelIcono"></div><div class="precioTienda">' . $result[$propuesta]['nivel'] . '</div></a>';

            echo "</div>";
        }
        echo "<div class='submitTienda'>";
            echo "<a href='?page=zona'><button class='botonVolver'></button></a>";
        echo "</div>";
    }
    
    function listJugadorObjetivo($id){
        global $db;
        include(__ROOT__."/backend/personajeFunctions.php");
        
        listJugadorRival($id);
     
        echo "<a href='?page=attackPlayer&id=" . $id . "'><button class='botonEmboscada'></button></a>";
    
    }
    
    function listJugador($id){
        global $db;
        include(__ROOT__."/backend/personajeFunctions.php");
        
        listJugadorRival($id);
     
        //echo "<a href='?page=attackPlayer&id=" . $id . "'><button class='botonEmboscada'></button></a>";
    
    }
    
    function atacarJugador($id){
        include (__ROOT__.'/backend/comprobaciones.php');
        global $db;
        $miId = $_SESSION['loggedIn'];
        //Comprobar que no me estoy atacando a mi mismo
        if ($id != $miId){
        //Comprobar que estoy libre de hacer una Accion
        $estoyLibre = comprobarEspera();
        if($estoyLibre === 1){
               $puedoEmboscar = comprobarEmboscar();
               if($puedoEmboscar === 1){
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

                        //Consultar que objetos tiene equipados mi personaje en cada slot (se ordenan por slot)
                        $sql = "SELECT objetos.*, inventario.slot FROM inventario JOIN objetos ON inventario.idO = objetos.id WHERE inventario.idP = '$miId' AND inventario.slot < 8";
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

                        //Consultar que objetos tiene equipados su personaje en cada slot (se ordenan por slot)
                        $sql = "SELECT objetos.*, inventario.slot FROM inventario JOIN objetos ON inventario.idO = objetos.id WHERE inventario.idP = '$id' AND inventario.slot < 8";
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
                        $miAturdimiento = 0;
                        $rivalAturdimiento = 0;

                        echo 'Salud inicial: ' . $miResult[0]['nombre'] . ' ' . $miSalud . ' //// ' . $rivalResult[0]['nombre'] . ' ' . $rivalSalud . '<br>';

                        for($i = 1; $i <= $rondas; $i++){

                            //Calcular cuanto sacan en esta ronda, y en caso de ser negativo, ponerlos a '0'
                            $rondaMiDestreza = rand($miDestreza-10, $miDestreza+10);
                            $rondaRivalAgilidad = rand($rivalAgilidad-10, $rivalAgilidad+10);
                            $rondaMiFuerza = rand($miFuerza-5, $miFuerza+5);
                            $rondaRivalResistencia = rand($rivalResistencia-5, $rivalResistencia+5);
                            $rondaRivalDestreza = rand($rivalDestreza-10, $rivalDestreza+10);
                            $rondaMiAgilidad = rand($miAgilidad-10, $miAgilidad+10);
                            $rondaRivalFuerza = rand($rivalFuerza-5, $rivalFuerza+5);
                            $rondaMiResistencia = rand($miResistencia-5, $miResistencia+5);

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
                                if($miAturdimiento > 0){
                                    $miAturdimiento = 0;
                                    echo 'En esta ronda ' . $miResult[0]['nombre'] . ' se está recuperando del aturdimiento y no puede atacar. <br>';
                                    echo 'Turno de ' . $rivalResult[0]['nombre'] . '<br>';

                                    echo $rivalResult[0]['nombre'] . ' intenta golpear con una destreza de ' . $rondaRivalDestreza . '<br>';
                                    echo $miResult[0]['nombre'] . ' quiere esquivar con una agilidad de ' . $rondaMiAgilidad . '<br>';
                                    //Acciones segun la diferencia de DES VS AGI
                                    //Caso 1: DES >20 AGI
                                    if(($rondaRivalDestreza - $rondaMiAgilidad) > 20){
                                        echo $rivalResult[0]['nombre'] . ' lanza un ataque sorpresa que pilla a ' . $miResult[0]['nombre'] . ' totalmente desprotegido.<br>';

                                        //Ver si ha sido Golpe Crítico
                                        //BONO de gran DES vs AGI
                                        $tiradaCritico = rand(1,5);
                                        if($tiradaCritico < 5){
                                            $daño = $rondaRivalFuerza;
                                        }
                                        else{
                                            echo '¡Golpe Crítico!<br>';
                                            $daño = $rondaRivalFuerza * 1.5;
                                        }
                                        if($daño <= 0){
                                            $daño = 0;
                                        }

                                        //BONO de aturdimiento por gran DES vs AGI
                                        $golpeAturdidor = rand(1, 3);
                                        if($golpeAturdidor > 2){
                                            $miAturdimiento = 1;
                                            echo '¡Qué golpetazo! ' . $miResult[0]['nombre'] . ' queda en Aturdimiento<br>';
                                        }
                                        echo 'Daño = ' . $daño . '<br>';
                                        $miSalud = $miSalud - $daño;
                                        if($daño === 0){
                                            echo $miResult[0]['nombre'] . ' esquiva el golpe. Le quedan ' . $miSalud . ' puntos de salud.<br>';
                                        }
                                        else{
                                            echo $miResult[0]['nombre'] . ' pierde ' . $daño . ' puntos de Salud. Le quedan ' . $miSalud . '<br>';
                                        }
                                        if($miSalud <= 0){

                                        break;
                                        }
                                    }
                                    //Caso 2: DES >10 AGI
                                    elseif(($rondaRivalDestreza - $rondaMiAgilidad) > 10 && ($rondaRivalDestreza - $rondaMiAgilidad) <= 20){
                                        echo $rivalResult[0]['nombre'] . ' carga ferozmente contra ' . $miResult[0]['nombre'] . ' que apenas tiene tiempo de defenderse.<br>';

                                        //Ver si ha sido Golpe Crítico
                                        //BONO de gran DES vs AGI
                                        $tiradaCritico = rand(1,5);
                                        if($tiradaCritico < 5){
                                            $daño = $rondaRivalFuerza * 1.4 - $rondaMiResistencia * 0.6;
                                        }
                                        else{
                                            echo '¡Golpe Crítico!<br>';
                                            $daño = $rondaRivalFuerza * 1.5 * 1.4 - $rondaMiResistencia * 0.6;
                                        }
                                        if($daño <= 0){
                                            $daño = 0;
                                        }

                                        echo 'Daño = ' . $daño . '<br>';
                                        $miSalud = $miSalud - $daño;
                                        if($daño === 0){
                                            echo $miResult[0]['nombre'] . ' esquiva el golpe. Le quedan ' . $miSalud . ' puntos de salud.<br>';
                                        }
                                        else{
                                            echo $miResult[0]['nombre'] . ' pierde ' . $daño . ' puntos de Salud. Le quedan ' . $miSalud . '<br>';
                                        }

                                        if($miSalud <= 0){

                                        break;
                                        }
                                    }
                                    //Caso 3: DES >4 AGI
                                    elseif(($rondaRivalDestreza - $rondaMiAgilidad) > 4 && ($rondaRivalDestreza - $rondaMiAgilidad) <= 10){
                                        echo $rivalResult[0]['nombre'] . ' ataca con destreza y ' . $miResult[0]['nombre'] . ' se ve en apuros.<br>';

                                        //Ver si ha sido Golpe Crítico
                                        //BONO de gran DES vs AGI
                                        $tiradaCritico = rand(1,5);
                                        if($tiradaCritico < 5){
                                            $daño = $rondaRivalFuerza * 1.2 - $rondaMiResistencia * 0.8;
                                        }
                                        else{
                                            echo '¡Golpe Crítico!<br>';
                                            $daño = $rondaRivalFuerza * 1.5 * 1.2 - $rondaMiResistencia * 0.8;
                                        }
                                        if($daño <= 0){
                                            $daño = 0;
                                        }

                                        echo 'Daño = ' . $daño . '<br>';
                                        $miSalud = $miSalud - $daño;
                                        if($daño === 0){
                                            echo $miResult[0]['nombre'] . ' esquiva el golpe. Le quedan ' . $miSalud . ' puntos de salud!<br>';
                                        }
                                        else{
                                            echo $miResult[0]['nombre'] . ' pierde ' . $daño . ' puntos de Salud. Le quedan ' . $miSalud . '<br>';
                                        }

                                        if($miSalud <= 0){

                                        break;
                                        }
                                    }
                                    //Caso 4: DES [-4,+4] AGI
                                    elseif(($rondaRivalDestreza - $rondaMiAgilidad) > -5 && ($rondaRivalDestreza - $rondaMiAgilidad) < 5 ){
                                        echo  $rivalResult[0]['nombre'] . ' intenta golpear a ' . $miResult[0]['nombre'] . ' que está preparado<br>';

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
                                        if($daño === 0){
                                            echo $miResult[0]['nombre'] . ' esquiva el golpe. Le quedan ' . $miSalud . ' puntos de salud<br>';
                                        }
                                        else{
                                            echo $miResult[0]['nombre'] . ' pierde ' . $daño . ' puntos de Salud. Le quedan ' . $miSalud . '<br>';
                                        }

                                        if($miSalud <= 0){

                                        break;
                                        }
                                    }
                                    //Caso 5: DES <-4 AGI
                                    elseif(($rondaRivalDestreza - $rondaMiAgilidad) >= -10 && ($rondaRivalDestreza - $rondaMiAgilidad) <= -5 ){
                                        echo $rivalResult[0]['nombre'] . ' prepara un ataque poco diestro contra ' . $miResult[0]['nombre'] . ' que ha leído la intención y se anticipa<br>';

                                        //Ver si ha sido Golpe Crítico
                                        //Penalizacion baja DES vs AGI
                                        $tiradaCritico = rand(1,5);
                                        if($tiradaCritico < 5){
                                            $daño = $rondaRivalFuerza * 0.8 - $rondaMiResistencia * 1.2;
                                        }
                                        else{
                                            echo '¡Golpe Crítico!<br>';
                                            $daño = $rondaRivalFuerza * 1.5 * 0.8 - $rondaMiResistencia * 1.2;
                                        }

                                        if($daño <= 0){
                                            $daño = 0;
                                        }

                                        echo 'Daño = ' . $daño . '<br>';
                                        $miSalud = $miSalud - $daño;
                                        if($daño === 0){
                                            echo $miResult[0]['nombre'] . ' esquiva el golpe. Le quedan ' . $miSalud . ' puntos de salud.<br>';
                                        }
                                        else{
                                            echo $miResult[0]['nombre'] . ' pierde ' . $daño . ' puntos de Salud. Le quedan ' . $miSalud . '<br>';
                                        }

                                        if($miSalud <= 0){

                                        break;
                                        }
                                    }
                                    //Caso 6: DES <10 AGI
                                    elseif(($rondaRivalDestreza - $rondaMiAgilidad) >= -20 && ($rondaRivalDestreza - $rondaMiAgilidad) < -10 ){
                                        echo $rivalResult[0]['nombre'] . ' intenta una torpe carga contra ' . $miResult[0]['nombre'] . ' que ya le espera en posición muy ventajosa<br>';

                                        //Ver si ha sido Golpe Crítico
                                        //Penalizacion baja DES vs AGI
                                        $tiradaCritico = rand(1,5);
                                        if($tiradaCritico < 5){
                                            $daño = $rondaRivalFuerza * 0.6 - $rondaMiResistencia * 1.4;
                                        }
                                        else{
                                            echo '¡Golpe Crítico!<br>';
                                            $daño = $rondaRivalFuerza * 1.5 * 0.6 - $rondaMiResistencia * 1.4;
                                        }

                                        if($daño <= 0){
                                            $daño = 0;
                                        }

                                        echo 'Daño = ' . $daño . '<br>';
                                        $miSalud = $miSalud - $daño;
                                        if($daño === 0){
                                            echo $miResult[0]['nombre'] . ' esquiva el golpe. Le quedan ' . $miSalud . ' puntos de salud.<br>';
                                        }
                                        else{
                                            echo $miResult[0]['nombre'] . ' pierde ' . $daño . ' puntos de Salud. Le quedan ' . $miSalud . '<br>';
                                        }

                                        if($miSalud <= 0){

                                        break;
                                        }
                                    }
                                    //Caso 7: DES <20 AGI
                                    elseif(($rondaRivalDestreza - $rondaMiAgilidad) < -20 ){
                                        echo $rivalResult[0]['nombre'] . ' cae al suelo mareado cuando intentaba perseguir a un ' . $miResult[0]['nombre'] . 'mucho más ágil. ¡Qué verguenza!<br>';

                                        //Tirada de contrataque
                                        $tiradaContraataque = rand(1,5);
                                        if($tiradaContraataque > 4){
                                            echo 'Situación aprovechada por ' . $miResult[0]['nombre'] . ' que lanza un contrataque mientras ' . $rivalResult[0]['nombre'] . ' recogía sus cosas del suelo.<br>';
                                            $daño = ($rondaMiFuerza - $rondaRivalResistencia);
                                            if($daño <= 0){
                                                $daño = 0;
                                            }
                                            echo 'Daño = ' . $daño . '<br>';
                                            $rivalSalud = $rivalSalud - $daño;
                                            if($daño === 0){
                                                echo $rivalResult[0]['nombre'] . ' esquiva el golpe. Le quedan ' . $rivalSalud . ' puntos de salud.<br>';
                                            }
                                            else{
                                                echo $rivalResult[0]['nombre'] . ' pierde ' . $daño . ' puntos de Salud. Le quedan ' . $rivalSalud . '<br>';
                                            }

                                            if($rivalSalud <= 0){

                                                break;
                                            }
                                        }
                                    }
                                }
                                else{
                                    echo $miResult[0]['nombre'] . ' toma la iniciativa<br>';

                                    echo $miResult[0]['nombre'] . ' intenta golpear con una destreza de ' . $rondaMiDestreza . '<br>';
                                    echo $rivalResult[0]['nombre'] . ' quiere esquivar con una agilidad de ' . $rondaRivalAgilidad . '<br>';

                                    //Acciones segun la diferencia de DES VS AGI
                                    //Caso 1: DES >20 AGI
                                    if(($rondaMiDestreza - $rondaRivalAgilidad) > 20){
                                        echo $miResult[0]['nombre'] . ' lanza un ataque sorpresa que pilla a ' . $rivalResult[0]['nombre'] . ' totalmente desprotegido.<br>';

                                        //Ver si ha sido Golpe Crítico
                                        //BONO de gran DES vs AGI
                                        $tiradaCritico = rand(1,5);
                                        if($tiradaCritico < 5){
                                            $daño = $rondaMiFuerza;
                                        }
                                        else{
                                            echo '¡Golpe Crítico!<br>';
                                            $daño = $rondaMiFuerza * 1.5;
                                        }
                                        if($daño <= 0){
                                            $daño = 0;
                                        }

                                        //BONO de aturdimiento por gran DES vs AGI
                                        $golpeAturdidor = rand(1, 3);
                                        if($golpeAturdidor > 2){
                                            $rivalAturdimiento = 1;
                                            echo '¡Qué golpetazo! ' . $rivalResult[0]['nombre'] . ' queda en Aturdimiento<br>';
                                        }
                                        echo 'Daño = ' . $daño . '<br>';
                                        $rivalSalud = $rivalSalud - $daño;
                                        if($daño === 0){
                                            echo $rivalResult[0]['nombre'] . ' esquiva el golpe. Le quedan ' . $rivalSalud . ' puntos de salud.<br>';
                                        }
                                        else{
                                            echo $rivalResult[0]['nombre'] . ' pierde ' . $daño . ' puntos de Salud. Le quedan ' . $rivalSalud . '<br>';
                                        }

                                        if($rivalSalud <= 0){

                                            break;
                                        }
                                    }
                                    //Caso 2: DES >10 AGI
                                    elseif(($rondaMiDestreza - $rondaRivalAgilidad) > 10 && ($rondaMiDestreza - $rondaRivalAgilidad) <= 20){
                                        echo $miResult[0]['nombre'] . ' carga ferozmente contra ' . $rivalResult[0]['nombre'] . ' que apenas tiene tiempo de defenderse.<br>';

                                        //Ver si ha sido Golpe Crítico
                                        //BONO de gran DES vs AGI
                                        $tiradaCritico = rand(1,5);
                                        if($tiradaCritico < 5){
                                            $daño = $rondaMiFuerza * 1.4 - $rondaRivalResistencia * 0.6;
                                        }
                                        else{
                                            echo '¡Golpe Crítico!<br>';
                                            $daño = $rondaMiFuerza * 1.5 * 1.4 - $rondaRivalResistencia * 0.6;
                                        }
                                        if($daño <= 0){
                                            $daño = 0;
                                        }

                                        echo 'Daño = ' . $daño . '<br>';
                                        $rivalSalud = $rivalSalud - $daño;
                                        if($daño === 0){
                                            echo $rivalResult[0]['nombre'] . ' esquiva el golpe. Le quedan ' . $rivalSalud . ' puntos de salud.<br>';
                                        }
                                        else{
                                            echo $rivalResult[0]['nombre'] . ' pierde ' . $daño . ' puntos de Salud. Le quedan ' . $rivalSalud . '<br>';
                                        }

                                        if($rivalSalud <= 0){

                                            break;
                                        }
                                    }
                                    //Caso 3: DES >4 AGI
                                    elseif(($rondaMiDestreza - $rondaRivalAgilidad) > 4 && ($rondaMiDestreza - $rondaRivalAgilidad) <= 10){
                                        echo $miResult[0]['nombre'] . ' ataca con destreza y ' . $rivalResult[0]['nombre'] . ' se ve en apuros<br>';

                                        //Ver si ha sido Golpe Crítico
                                        //BONO de gran DES vs AGI
                                        $tiradaCritico = rand(1,5);
                                        if($tiradaCritico < 5){
                                            $daño = $rondaMiFuerza * 1.2 - $rondaRivalResistencia * 0.8;
                                        }
                                        else{
                                            echo '¡Golpe Crítico!<br>';
                                            $daño = $rondaMiFuerza * 1.5 * 1.2 - $rondaRivalResistencia * 0.8;
                                        }
                                        if($daño <= 0){
                                            $daño = 0;
                                        }

                                        echo 'Daño = ' . $daño . '<br>';
                                        $rivalSalud = $rivalSalud - $daño;
                                        if($daño === 0){
                                            echo $rivalResult[0]['nombre'] . ' esquiva el golpe. Le quedan ' . $rivalSalud . ' puntos de salud.<br>';
                                        }
                                        else{
                                            echo $rivalResult[0]['nombre'] . ' pierde ' . $daño . ' puntos de Salud. Le quedan ' . $rivalSalud . '<br>';
                                        }                                

                                        if($rivalSalud <= 0){

                                            break;
                                        }
                                    }
                                    //Caso 4: DES [-4,+4] AGI
                                    elseif(($rondaMiDestreza - $rondaRivalAgilidad) > -5 && ($rondaMiDestreza - $rondaRivalAgilidad) < 5 ){
                                        echo $miResult[0]['nombre'] . ' intenta golpear a ' . $rivalResult[0]['nombre'] . ' que está preparado<br>';

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
                                        if($daño === 0){
                                            echo $rivalResult[0]['nombre'] . ' esquiva el golpe. Le quedan ' . $rivalSalud . ' puntos de salud.<br>';
                                        }
                                        else{
                                            echo $rivalResult[0]['nombre'] . ' pierde ' . $daño . ' puntos de Salud. Le quedan ' . $rivalSalud . '<br>';
                                        }

                                        if($rivalSalud <= 0){

                                            break;
                                        }
                                    }
                                    //Caso 5: DES <-4 AGI
                                    elseif(($rondaMiDestreza - $rondaRivalAgilidad) >= -10 && ($rondaMiDestreza - $rondaRivalAgilidad) <= -5 ){
                                        echo $miResult[0]['nombre'] . ' prepara un ataque poco diestro contra ' . $rivalResult[0]['nombre'] . ' que ha leído la intención y se anticipa.<br>';

                                        //Ver si ha sido Golpe Crítico
                                        //Penalizacion baja DES vs AGI
                                        $tiradaCritico = rand(1,5);
                                        if($tiradaCritico < 5){
                                            $daño = $rondaMiFuerza * 0.8 - $rondaRivalResistencia * 1.2;
                                        }
                                        else{
                                            echo '¡Golpe Crítico!<br>';
                                            $daño = $rondaMiFuerza * 1.5 * 0.8 - $rondaRivalResistencia * 1.2;
                                        }

                                        if($daño <= 0){
                                            $daño = 0;
                                        }

                                        echo 'Daño = ' . $daño . '<br>';
                                        $rivalSalud = $rivalSalud - $daño;
                                        if($daño === 0){
                                            echo $rivalResult[0]['nombre'] . ' esquiva el golpe. Le quedan ' . $rivalSalud . ' puntos de salud.<br>';
                                        }
                                        else{
                                            echo $rivalResult[0]['nombre'] . ' pierde ' . $daño . ' puntos de Salud. Le quedan ' . $rivalSalud . '<br>';
                                        }

                                        if($rivalSalud <= 0){

                                            break;
                                        }
                                    }
                                    //Caso 6: DES <10 AGI
                                    elseif(($rondaMiDestreza - $rondaRivalAgilidad) >= -20 && ($rondaMiDestreza - $rondaRivalAgilidad) < -10 ){
                                        echo $miResult[0]['nombre'] . ' intenta una torpe carga contra ' . $rivalResult[0]['nombre'] . ' que ya le espera en posición muy ventajosa.<br>';

                                        //Ver si ha sido Golpe Crítico
                                        //Penalizacion baja DES vs AGI
                                        $tiradaCritico = rand(1,5);
                                        if($tiradaCritico < 5){
                                            $daño = $rondaMiFuerza * 0.6 - $rondaRivalResistencia * 1.4;
                                        }
                                        else{
                                            echo '¡Golpe Crítico!<br>';
                                            $daño = $rondaMiFuerza * 1.5 * 0.6 - $rondaRivalResistencia * 1.4;
                                        }

                                        if($daño <= 0){
                                            $daño = 0;
                                        }

                                        echo 'Daño = ' . $daño . '<br>';
                                        $rivalSalud = $rivalSalud - $daño;
                                        if($daño === 0){
                                            echo $rivalResult[0]['nombre'] . ' esquiva el golpe. Le quedan ' . $rivalSalud . ' puntos de salud.<br>';
                                        }
                                        else{
                                            echo $rivalResult[0]['nombre'] . ' pierde ' . $daño . ' puntos de Salud. Le quedan ' . $rivalSalud . '<br>';
                                        }

                                        if($rivalSalud <= 0){

                                            break;
                                        }
                                    }
                                    //Caso 7: DES <20 AGI
                                    elseif(($rondaMiDestreza - $rondaRivalAgilidad) < -20 ){
                                        echo $miResult[0]['nombre'] . ' cae al suelo mareado cuando intentaba perseguir a un ' . $rivalResult[0]['nombre'] . 'mucho más ágil. ¡Qué verguenza!<br>';

                                        //Tirada de contrataque
                                        $tiradaContraataque = rand(1,5);
                                        if($tiradaContraataque > 4){
                                            echo 'Situación aprovechada por ' . $rivalResult[0]['nombre'] . ' que lanza un contrataque mientras ' . $miResult[0]['nombre'] . ' recogía sus cosas del suelo.<br>';
                                            $daño = ($rondaRivalFuerza - $rondaMiResistencia);
                                            if($daño <= 0){
                                                $daño = 0;
                                            }
                                            echo 'Daño = ' . $daño . '<br>';
                                            $miSalud = $miSalud - $daño;
                                            if($daño === 0){
                                                echo $miResult[0]['nombre'] . ' esquiva el golpe. Le quedan ' . $miSalud . ' puntos de salud.<br>';
                                            }
                                            else{
                                                echo $miResult[0]['nombre'] . ' pierde ' . $daño . ' puntos de Salud. Le quedan ' . $miSalud . '<br>';
                                            }

                                            if($miSalud <= 0){

                                            break;
                                            }
                                        }
                                    }


                                    echo 'Turno de ' . $rivalResult[0]['nombre'] . '<br>';
                                    if($rivalAturdimiento > 0){

                                        $rivalAturdimiento = 0;
                                        echo 'En esta ronda ' . $rivalResult[0]['nombre'] . ' se está recuperando del Aturdimiento y no puede atacar.<br>';

                                    }
                                    else{

                                        //Acciones segun la diferencia de DES VS AGI
                                        //Caso 1: DES >20 AGI
                                        if(($rondaRivalDestreza - $rondaMiAgilidad) > 20){
                                            echo $rivalResult[0]['nombre'] . ' lanza un ataque sorpresa que pilla a ' . $miResult[0]['nombre'] . ' totalmente desprotegido.<br>';

                                            //Ver si ha sido Golpe Crítico
                                            //BONO de gran DES vs AGI
                                            $tiradaCritico = rand(1,5);
                                            if($tiradaCritico < 5){
                                                $daño = $rondaRivalFuerza;
                                            }
                                            else{
                                                echo '¡Golpe Crítico!<br>';
                                                $daño = $rondaRivalFuerza * 1.5;
                                            }
                                            if($daño <= 0){
                                                $daño = 0;
                                            }

                                            //BONO de aturdimiento por gran DES vs AGI
                                            $golpeAturdidor = rand(1, 3);
                                            if($golpeAturdidor > 2){
                                                $miAturdimiento = 1;
                                                echo '¡Qué golpetazo! ' . $miResult[0]['nombre'] . ' queda en Aturdimiento<br>';
                                            }
                                            echo 'Daño = ' . $daño . '<br>';
                                            $miSalud = $miSalud - $daño;
                                            if($daño === 0){
                                                echo $miResult[0]['nombre'] . ' esquiva el golpe. Le quedan ' . $miSalud . ' puntos de salud.<br>';
                                            }
                                            else{
                                                echo $miResult[0]['nombre'] . ' pierde ' . $daño . ' puntos de Salud. Le quedan ' . $miSalud . '<br>';
                                            }

                                            if($miSalud <= 0){

                                            break;
                                            }
                                        }
                                        //Caso 2: DES >10 AGI
                                        elseif(($rondaRivalDestreza - $rondaMiAgilidad) > 10 && ($rondaRivalDestreza - $rondaMiAgilidad) <= 20){
                                            echo $rivalResult[0]['nombre'] . ' carga ferozmente contra ' . $miResult[0]['nombre'] . ' que apenas tiene tiempo de defenderse.<br>';

                                            //Ver si ha sido Golpe Crítico
                                            //BONO de gran DES vs AGI
                                            $tiradaCritico = rand(1,5);
                                            if($tiradaCritico < 5){
                                                $daño = $rondaRivalFuerza * 1.4 - $rondaMiResistencia * 0.6;
                                            }
                                            else{
                                                echo '¡Golpe Crítico!<br>';
                                                $daño = $rondaRivalFuerza * 1.5 * 1.4 - $rondaMiResistencia * 0.6;
                                            }
                                            if($daño <= 0){
                                                $daño = 0;
                                            }

                                            echo 'Daño = ' . $daño . '<br>';
                                            $miSalud = $miSalud - $daño;
                                            if($daño === 0){
                                                echo $miResult[0]['nombre'] . ' esquiva el golpe. Le quedan ' . $miSalud . ' puntos de salud.<br>';
                                            }
                                            else{
                                                echo $miResult[0]['nombre'] . ' pierde ' . $daño . ' puntos de Salud. Le quedan ' . $miSalud . '<br>';
                                            }

                                            if($miSalud <= 0){

                                            break;
                                            }
                                        }
                                        //Caso 3: DES >4 AGI
                                        elseif(($rondaRivalDestreza - $rondaMiAgilidad) > 4 && ($rondaRivalDestreza - $rondaMiAgilidad) <= 10){
                                            echo $rivalResult[0]['nombre'] . ' ataca con destreza y ' . $miResult[0]['nombre'] . ' se ve en apuros.<br>';

                                            //Ver si ha sido Golpe Crítico
                                            //BONO de gran DES vs AGI
                                            $tiradaCritico = rand(1,5);
                                            if($tiradaCritico < 5){
                                                $daño = $rondaRivalFuerza * 1.2 - $rondaMiResistencia * 0.8;
                                            }
                                            else{
                                                echo '¡Golpe Crítico!<br>';
                                                $daño = $rondaRivalFuerza * 1.5 * 1.2 - $rondaMiResistencia * 0.8;
                                            }
                                            if($daño <= 0){
                                                $daño = 0;
                                            }

                                            echo 'Daño = ' . $daño . '<br>';
                                            $miSalud = $miSalud - $daño;
                                            if($daño === 0){
                                                echo $miResult[0]['nombre'] . ' esquiva el golpe. Le quedan ' . $miSalud . ' puntos de salud.<br>';
                                            }
                                            else{
                                                echo $miResult[0]['nombre'] . ' pierde ' . $daño . ' puntos de Salud. Le quedan ' . $miSalud . '<br>';
                                            }

                                            if($miSalud <= 0){

                                            break;
                                            }
                                        }
                                        //Caso 4: DES [-4,+4] AGI
                                        elseif(($rondaRivalDestreza - $rondaMiAgilidad) > -5 && ($rondaRivalDestreza - $rondaMiAgilidad) < 5 ){
                                            echo $rivalResult[0]['nombre'] . ' intenta golpear a ' . $miResult[0]['nombre'] . ' que está preparado<br>';

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
                                            if($daño === 0){
                                                echo $miResult[0]['nombre'] . ' esquiva el golpe. Le quedan ' . $miSalud . ' puntos de salud.<br>';
                                            }
                                            else{
                                                echo $miResult[0]['nombre'] . ' pierde ' . $daño . ' puntos de Salud. Le quedan ' . $miSalud . '<br>';
                                            }

                                            if($miSalud <= 0){

                                            break;
                                            }
                                        }
                                        //Caso 5: DES <-4 AGI
                                        elseif(($rondaRivalDestreza - $rondaMiAgilidad) >= -10 && ($rondaRivalDestreza - $rondaMiAgilidad) <= -5 ){
                                            echo $rivalResult[0]['nombre'] . ' prepara un ataque poco diestro contra ' . $miResult[0]['nombre'] . ' que ha leído la intención y se anticipa.<br>';

                                            //Ver si ha sido Golpe Crítico
                                            //Penalizacion bajo DES vs AGI
                                            $tiradaCritico = rand(1,5);
                                            if($tiradaCritico < 5){
                                                $daño = $rondaRivalFuerza * 0.8 - $rondaMiResistencia * 1.2;
                                            }
                                            else{
                                                echo '¡Golpe Crítico!<br>';
                                                $daño = $rondaRivalFuerza * 1.5 * 0.8 - $rondaMiResistencia * 1.2;
                                            }

                                            if($daño <= 0){
                                                $daño = 0;
                                            }

                                            echo 'Daño = ' . $daño . '<br>';
                                            $miSalud = $miSalud - $daño;
                                            if($daño === 0){
                                                echo $miResult[0]['nombre'] . ' esquiva el golpe. Le quedan ' . $miSalud . ' puntos de salud.<br>';
                                            }
                                            else{
                                                echo $miResult[0]['nombre'] . ' pierde ' . $daño . ' puntos de Salud. Le quedan ' . $miSalud . '<br>';
                                            }

                                            if($miSalud <= 0){

                                            break;
                                            }
                                        }
                                        //Caso 6: DES <10 AGI
                                        elseif(($rondaRivalDestreza - $rondaMiAgilidad) >= -20 && ($rondaRivalDestreza - $rondaMiAgilidad) < -10 ){
                                            echo $rivalResult[0]['nombre'] . ' intenta una torpe carga contra ' . $miResult[0]['nombre'] . ' que ya le espera en posición muy ventajosa.<br>';

                                            //Ver si ha sido Golpe Crítico
                                            //Penalizacion baja DES vs AGI
                                            $tiradaCritico = rand(1,5);
                                            if($tiradaCritico < 5){
                                                $daño = $rondaRivalFuerza * 0.6 - $rondaMiResistencia * 1.4;
                                            }
                                            else{
                                                echo '¡Golpe Crítico!<br>';
                                                $daño = $rondaRivalFuerza * 1.5 * 0.6 - $rondaMiResistencia * 1.4;
                                            }

                                            if($daño <= 0){
                                                $daño = 0;
                                            }

                                            echo 'Daño = ' . $daño . '<br>';
                                            $miSalud = $miSalud - $daño;
                                            if($daño === 0){
                                                echo $miResult[0]['nombre'] . ' esquiva el golpe. Le quedan ' . $miSalud . ' puntos de salud.<br>';
                                            }
                                            else{
                                                echo $miResult[0]['nombre'] . ' pierde ' . $daño . ' puntos de Salud. Le quedan ' . $miSalud . '<br>';
                                            }

                                            if($miSalud <= 0){

                                            break;
                                            }
                                        }
                                        //Caso 7: DES <20 AGI
                                        elseif(($rondaRivalDestreza - $rondaMiAgilidad) < -20 ){
                                            echo $rivalResult[0]['nombre'] . ' cae al suelo mareado cuando intentaba perseguir a un ' . $miResult[0]['nombre'] . 'mucho más ágil. ¡Qué verguenza!<br>';

                                            //Tirada de contrataque
                                            $tiradaContraataque = rand(1,5);
                                            if($tiradaContraataque > 4){
                                                echo 'Situación aprovechada por ' . $miResult[0]['nombre'] . ' que lanza un contrataque mientras ' . $rivalResult[0]['nombre'] . ' recogía sus cosas del suelo.<br>';
                                                $daño = ($rondaMiFuerza - $rondaRivalResistencia);
                                                if($daño <= 0){
                                                    $daño = 0;
                                                }
                                                echo 'Daño = ' . $daño . '<br>';
                                                $rivalSalud = $rivalSalud - $daño;
                                                if($daño === 0){
                                                    echo $rivalResult[0]['nombre'] . ' esquiva el golpe. Le quedan ' . $rivalSalud . ' puntos de salud.<br>';
                                                }
                                                else{
                                                    echo $rivalResult[0]['nombre'] . ' pierde ' . $daño . ' puntos de Salud. Le quedan ' . $rivalSalud . '<br>';
                                                }

                                                if($rivalSalud <= 0){

                                                    break;
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                            else{

                                if($rivalAturdimiento > 0){
                                    $rivalAturdimiento = 0;
                                    echo 'En esta ronda ' . $rivalResult[0]['nombre'] . ' se está recuperando del Aturdimiento y no puede atacar.<br>';
                                    echo 'Turno de ' . $miResult[0]['nombre'] . '<br>';

                                    echo $miResult[0]['nombre'] . ' intenta golpear con una destreza de ' . $rondaMiDestreza . '<br>';
                                    echo $rivalResult[0]['nombre'] . ' quiere esquivar con una agilidad de ' . $rondaRivalAgilidad . '<br>';

                                    //Acciones segun la diferencia de DES VS AGI
                                    //Caso 1: DES >20 AGI
                                    if(($rondaMiDestreza - $rondaRivalAgilidad) > 20){
                                        echo $miResult[0]['nombre'] . ' lanza un ataque por sorpresa que pilla a ' . $rivalResult[0]['nombre'] . ' totalmente desprotegido.<br>';

                                        //Ver si ha sido Golpe Crítico
                                        //BONO de gran DES vs AGI
                                        $tiradaCritico = rand(1,5);
                                        if($tiradaCritico < 5){
                                            $daño = $rondaMiFuerza;
                                        }
                                        else{
                                            echo '¡Golpe Crítico!<br>';
                                            $daño = $rondaMiFuerza * 1.5;
                                        }
                                        if($daño <= 0){
                                            $daño = 0;
                                        }

                                        //BONO de aturdimiento por gran DES vs AGI
                                        $golpeAturdidor = rand(1, 3);
                                        if($golpeAturdidor > 2){
                                            $rivalAturdimiento = 1;
                                            echo '¡Qué golpetazo! ' . $rivalResult[0]['nombre'] . ' queda en Aturdimiento<br>';
                                        }
                                        echo 'Daño = ' . $daño . '<br>';
                                        $rivalSalud = $rivalSalud - $daño;
                                        if($daño === 0){
                                            echo $rivalResult[0]['nombre'] . ' esquiva el golpe. Le quedan ' . $rivalSalud . ' puntos de salud.<br>';
                                        }
                                        else{
                                            echo $rivalResult[0]['nombre'] . ' pierde ' . $daño . ' puntos de Salud. Le quedan ' . $rivalSalud . '<br>';
                                        }

                                        if($rivalSalud <= 0){

                                            break;
                                        }
                                    }
                                    //Caso 2: DES >10 AGI
                                    elseif(($rondaMiDestreza - $rondaRivalAgilidad) > 10 && ($rondaMiDestreza - $rondaRivalAgilidad) <= 20){
                                        echo $miResult[0]['nombre'] . ' carga ferozmente contra ' . $rivalResult[0]['nombre'] . ' que apenas tiene tiempo de defenderse.<br>';

                                        //Ver si ha sido Golpe Crítico
                                        //BONO gran DES vs AGI
                                        $tiradaCritico = rand(1,5);
                                        if($tiradaCritico < 5){
                                            $daño = $rondaMiFuerza * 1.4 - $rondaRivalResistencia * 0.6;
                                        }
                                        else{
                                            echo '¡Golpe Crítico!<br>';
                                            $daño = $rondaMiFuerza * 1.5 *1.4 - $rondaRivalResistencia * 0.6;
                                        }
                                        if($daño <= 0){
                                            $daño = 0;
                                        }

                                        echo 'Daño = ' . $daño . '<br>';
                                        $rivalSalud = $rivalSalud - $daño;
                                        if($daño === 0){
                                            echo $rivalResult[0]['nombre'] . ' esquiva el golpe. Le quedan ' . $rivalSalud . ' puntos de salud.<br>';
                                        }
                                        else{
                                            echo $rivalResult[0]['nombre'] . ' pierde ' . $daño . ' puntos de Salud. Le quedan ' . $rivalSalud . '<br>';
                                        }

                                        if($rivalSalud <= 0){
                                            break;
                                        }
                                    }
                                    //Caso 3: DES >4 AGI
                                    elseif(($rondaMiDestreza - $rondaRivalAgilidad) > 4 && ($rondaMiDestreza - $rondaRivalAgilidad) <= 10){
                                        echo $miResult[0]['nombre'] . ' ataca con destreza y ' . $rivalResult[0]['nombre'] . ' se ve en apuros.<br>';

                                        //Ver si ha sido Golpe Crítico
                                        //BONO gran DES vs AGI
                                        $tiradaCritico = rand(1,5);
                                        if($tiradaCritico < 5){
                                            $daño = $rondaMiFuerza * 1.2 - $rondaRivalResistencia * 0.8;
                                        }
                                        else{
                                            echo '¡Golpe Crítico!<br>';
                                            $daño = $rondaMiFuerza * 1.5 * 1.2 - $rondaRivalResistencia * 0.8;
                                        }
                                        if($daño <= 0){
                                            $daño = 0;
                                        }

                                        echo 'Daño = ' . $daño . '<br>';
                                        $rivalSalud = $rivalSalud - $daño;
                                        if($daño === 0){
                                            echo $rivalResult[0]['nombre'] . ' esquiva el golpe. Le quedan ' . $rivalSalud . ' puntos de salud.<br>';
                                        }
                                        else{
                                            echo $rivalResult[0]['nombre'] . ' pierde ' . $daño . ' puntos de Salud. Le quedan ' . $rivalSalud . '<br>';
                                        }

                                        if($rivalSalud <= 0){

                                            break;
                                        }
                                    }
                                    //Caso 4: DES [-4,+4] AGI
                                    elseif(($rondaMiDestreza - $rondaRivalAgilidad) > -5 && ($rondaMiDestreza - $rondaRivalAgilidad) < 5 ){
                                        echo $miResult[0]['nombre'] . ' intenta golpear a ' . $rivalResult[0]['nombre'] . ' que está preparado.<br>';

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
                                        if($daño === 0){
                                            echo $rivalResult[0]['nombre'] . ' esquiva el golpe. Le quedan ' . $rivalSalud . ' puntos de salud.<br>';
                                        }
                                        else{
                                            echo $rivalResult[0]['nombre'] . ' pierde ' . $daño . ' puntos de Salud. Le quedan ' . $rivalSalud . '<br>';
                                        }

                                        if($rivalSalud <= 0){

                                            break;
                                        }
                                    }
                                    //Caso 5: DES <-4 AGI
                                    elseif(($rondaMiDestreza - $rondaRivalAgilidad) >= -10 && ($rondaMiDestreza - $rondaRivalAgilidad) <= -5 ){
                                        echo $miResult[0]['nombre'] . ' prepara un ataque poco diestro contra ' . $rivalResult[0]['nombre'] . ' que ha leído la intención y se anticipa.<br>';

                                        //Ver si ha sido Golpe Crítico
                                        //Penalizacion por baja DES vs AGI
                                        $tiradaCritico = rand(1,5);
                                        if($tiradaCritico < 5){
                                            $daño = $rondaMiFuerza * 0.8 - $rondaRivalResistencia * 1.2;
                                        }
                                        else{
                                            echo '¡Golpe Crítico!<br>';
                                            $daño = $rondaMiFuerza * 1.5 * 0.8 - $rondaRivalResistencia * 1.2;
                                        }

                                        if($daño <= 0){
                                            $daño = 0;
                                        }

                                        echo 'Daño = ' . $daño . '<br>';
                                        $rivalSalud = $rivalSalud - $daño;
                                        if($daño === 0){
                                            echo $rivalResult[0]['nombre'] . ' esquiva el golpe. Le quedan ' . $rivalSalud . ' puntos de salud.<br>';
                                        }
                                        else{
                                            echo $rivalResult[0]['nombre'] . ' pierde ' . $daño . ' puntos de Salud. Le quedan ' . $rivalSalud . '<br>';
                                        }

                                        if($rivalSalud <= 0){

                                            break;
                                        }
                                    }
                                    //Caso 6: DES <10 AGI
                                    elseif(($rondaMiDestreza - $rondaRivalAgilidad) >= -20 && ($rondaMiDestreza - $rondaRivalAgilidad) < -10 ){
                                        echo $miResult[0]['nombre'] . ' intenta una torpe carga contra ' . $rivalResult[0]['nombre'] . ' que ya le espera en situación muy ventajosa.<br>';

                                        //Ver si ha sido Golpe Crítico
                                        //penalizacion baja DES vs AGI
                                        $tiradaCritico = rand(1,5);
                                        if($tiradaCritico < 5){
                                            $daño = $rondaMiFuerza * 0.6 - $rondaRivalResistencia * 1.4;
                                        }
                                        else{
                                            echo '¡Golpe Crítico!<br>';
                                            $daño = $rondaMiFuerza * 1.5 +0.6 - $rondaRivalResistencia * 1.4;
                                        }

                                        if($daño <= 0){
                                            $daño = 0;
                                        }

                                        echo 'Daño = ' . $daño . '<br>';
                                        $rivalSalud = $rivalSalud - $daño;
                                        if($daño === 0){
                                            echo $rivalResult[0]['nombre'] . ' esquiva el golpe. Le quedan ' . $rivalSalud . ' puntos de salud.<br>';
                                        }
                                        else{
                                            echo $rivalResult[0]['nombre'] . ' pierde ' . $daño . ' puntos de Salud. Le quedan ' . $rivalSalud . '<br>';
                                        }

                                        if($rivalSalud <= 0){

                                        break;
                                        }
                                    }
                                    //Caso 7: DES <20 AGI
                                    elseif(($rondaMiDestreza - $rondaRivalAgilidad) < -20 ){
                                        echo $miResult[0]['nombre'] . ' cae al suelo mareado cuando intentaba perseguir a un ' . $rivalResult[0]['nombre'] . 'mucho más ágil. ¡Qué verguenza!<br>';

                                        //Tirada de contrataque
                                        $tiradaContraataque = rand(1,5);
                                        if($tiradaContraataque > 4){
                                            echo 'Situación aprovechada por ' . $rivalResult[0]['nombre'] . ' que lanza un contrataque mientras ' . $miResult[0]['nombre'] . ' recogía sus cosas del suelo.<br>';
                                            $daño = ($rondaRivalFuerza - $rondaMiResistencia);
                                            if($daño <= 0){
                                                $daño = 0;
                                            }
                                            echo 'Daño = ' . $daño . '<br>';
                                            $miSalud = $miSalud - $daño;
                                            if($daño === 0){
                                                echo $miResult[0]['nombre'] . ' esquiva el golpe. Le quedan ' . $miSalud . ' puntos de salud.<br>';
                                            }
                                            else{
                                                echo $miResult[0]['nombre'] . ' pierde ' . $daño . ' puntos de Salud. Le quedan ' . $miSalud . '<br>';
                                            }

                                            if($miSalud <= 0){

                                            break;
                                            }
                                        }
                                    }

                                }
                                else{
                                    echo $rivalResult[0]['nombre'] . ' toma la iniciativa<br>';

                                    echo $rivalResult[0]['nombre'] . ' intenta golpear con una destreza de ' . $rondaRivalDestreza . '<br>';
                                    echo $miResult[0]['nombre'] . ' quiere esquivar con una agilidad de ' . $rondaMiAgilidad . '<br>';

                                    //Acciones segun la diferencia de DES VS AGI
                                        //Caso 1: DES >20 AGI
                                        if(($rondaRivalDestreza - $rondaMiAgilidad) > 20){
                                            echo $rivalResult[0]['nombre'] . ' lanza un ataque sorpresa que pilla a ' . $miResult[0]['nombre'] . ' totalmente desprotegido.<br>';

                                            //Ver si ha sido Golpe Crítico
                                            //BONO de gran DES vs AGI
                                            $tiradaCritico = rand(1,5);
                                            if($tiradaCritico < 5){
                                                $daño = $rondaRivalFuerza;
                                            }
                                            else{
                                                echo '¡Golpe Crítico!<br>';
                                                $daño = $rondaRivalFuerza * 1.5;
                                            }
                                            if($daño <= 0){
                                                $daño = 0;
                                            }

                                            //BONO de aturdimiento por gran DES vs AGI
                                            $golpeAturdidor = rand(1, 3);
                                            if($golpeAturdidor > 2){
                                                $miAturdimiento = 1;
                                                echo '¡Qué golpetazo! ' . $miResult[0]['nombre'] . ' queda en Aturdimiento<br>';
                                            }
                                            echo 'Daño = ' . $daño . '<br>';
                                            $miSalud = $miSalud - $daño;
                                            if($daño === 0){
                                                echo $miResult[0]['nombre'] . ' esquiva el golpe. Le quedan ' . $miSalud . ' puntos de salud.<br>';
                                            }
                                            else{
                                                echo $miResult[0]['nombre'] . ' pierde ' . $daño . ' puntos de Salud. Le quedan ' . $miSalud . '<br>';
                                            }

                                            if($miSalud <= 0){

                                            break;
                                            }
                                        }
                                        //Caso 2: DES >10 AGI
                                        elseif(($rondaRivalDestreza - $rondaMiAgilidad) > 10 && ($rondaRivalDestreza - $rondaMiAgilidad) <= 20){
                                            echo $rivalResult[0]['nombre'] . ' carga ferozmente contra ' . $miResult[0]['nombre'] . ' que apenas tiene tiempo de defenderse.<br>';

                                            //Ver si ha sido Golpe Crítico
                                            //BONO de gran DES vs AGI
                                            $tiradaCritico = rand(1,5);
                                            if($tiradaCritico < 5){
                                                $daño = $rondaRivalFuerza * 1.4 - $rondaMiResistencia * 0.6;
                                            }
                                            else{
                                                echo '¡Golpe Crítico!<br>';
                                                $daño = $rondaRivalFuerza * 1.5 * 1.4 - $rondaMiResistencia * 0.6;
                                            }
                                            if($daño <= 0){
                                                $daño = 0;
                                            }

                                            echo 'Daño = ' . $daño . '<br>';
                                            $miSalud = $miSalud - $daño;
                                            if($daño === 0){
                                                echo $miResult[0]['nombre'] . ' esquiva el golpe. Le quedan ' . $miSalud . ' puntos de salud.<br>';
                                            }
                                            else{
                                                echo $miResult[0]['nombre'] . ' pierde ' . $daño . ' puntos de Salud. Le quedan ' . $miSalud . '<br>';
                                            }

                                            if($miSalud <= 0){

                                            break;
                                            }
                                        }
                                        //Caso 3: DES >4 AGI
                                        elseif(($rondaRivalDestreza - $rondaMiAgilidad) > 4 && ($rondaRivalDestreza - $rondaMiAgilidad) <= 10){
                                            echo $rivalResult[0]['nombre'] . ' ataca con destreza y ' . $miResult[0]['nombre'] . ' se ve en apuros.<br>';

                                            //Ver si ha sido Golpe Crítico
                                            //BONO de gran DES vs AGI
                                            $tiradaCritico = rand(1,5);
                                            if($tiradaCritico < 5){
                                                $daño = $rondaRivalFuerza * 1.2 - $rondaMiResistencia * 0.8;
                                            }
                                            else{
                                                echo '¡Golpe Crítico!<br>';
                                                $daño = $rondaRivalFuerza * 1.5 * 1.2 - $rondaMiResistencia * 0.8;
                                            }
                                            if($daño <= 0){
                                                $daño = 0;
                                            }

                                            echo 'Daño = ' . $daño . '<br>';
                                            $miSalud = $miSalud - $daño;
                                            if($daño === 0){
                                                echo $miResult[0]['nombre'] . ' esquiva el golpe. Le quedan ' . $miSalud . ' puntos de salud.<br>';
                                            }
                                            else{
                                                echo $miResult[0]['nombre'] . ' pierde ' . $daño . ' puntos de Salud. Le quedan ' . $miSalud . '<br>';
                                            }

                                            if($miSalud <= 0){

                                            break;
                                            }
                                        }
                                        //Caso 4: DES [-4,+4] AGI
                                        elseif(($rondaRivalDestreza - $rondaMiAgilidad) > -5 && ($rondaRivalDestreza - $rondaMiAgilidad) < 5 ){
                                            echo $rivalResult[0]['nombre'] . ' intenta golpear a ' . $miResult[0]['nombre'] . ' que está preparado.<br>';

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
                                            if($daño === 0){
                                                echo $miResult[0]['nombre'] . ' esquiva el golpe. Le quedan ' . $miSalud . ' puntos de salud.<br>';
                                            }
                                            else{
                                                echo $miResult[0]['nombre'] . ' pierde ' . $daño . ' puntos de Salud. Le quedan ' . $miSalud . '<br>';
                                            }

                                            if($miSalud <= 0){

                                                break;
                                            }
                                        }
                                        //Caso 5: DES <-4 AGI
                                        elseif(($rondaRivalDestreza - $rondaMiAgilidad) >= -10 && ($rondaRivalDestreza - $rondaMiAgilidad) <= -5 ){
                                            echo $rivalResult[0]['nombre'] . ' prepara un ataque poco diestro contra ' . $miResult[0]['nombre'] . ' que ha leído la intención y se anticipa.<br>';

                                            //Ver si ha sido Golpe Crítico
                                            //Penalizacion por baja DES vs AGI
                                            $tiradaCritico = rand(1,5);
                                            if($tiradaCritico < 5){
                                                $daño = $rondaRivalFuerza *0.8 - $rondaMiResistencia * 1.2;
                                            }
                                            else{
                                                echo '¡Golpe Crítico!<br>';
                                                $daño = $rondaRivalFuerza * 1.5 *0.8 - $rondaMiResistencia * 1.2;
                                            }

                                            if($daño <= 0){
                                                $daño = 0;
                                            }

                                            echo 'Daño = ' . $daño . '<br>';
                                            $miSalud = $miSalud - $daño;
                                            if($daño === 0){
                                                echo $miResult[0]['nombre'] . ' esquiva el golpe. Le quedan ' . $miSalud . ' puntos de salud.<br>';
                                            }
                                            else{
                                                echo $miResult[0]['nombre'] . ' pierde ' . $daño . ' puntos de Salud. Le quedan ' . $miSalud . '<br>';
                                            }

                                            if($miSalud <= 0){

                                            break;
                                            }
                                        }
                                        //Caso 6: DES <10 AGI
                                        elseif(($rondaRivalDestreza - $rondaMiAgilidad) >= -20 && ($rondaRivalDestreza - $rondaMiAgilidad) < -10 ){
                                            echo $rivalResult[0]['nombre'] . ' intenta una torpe carga contra ' . $miResult[0]['nombre'] . ' que ya le espera en posición muy ventajosa.<br>';

                                            //Ver si ha sido Golpe Crítico
                                            //Penalizacion por baja DES vs AGI
                                            $tiradaCritico = rand(1,5);
                                            if($tiradaCritico < 5){
                                                $daño = $rondaRivalFuerza * 0.6 - $rondaMiResistencia * 1.4;
                                            }
                                            else{
                                                echo '¡Golpe Crítico!<br>';
                                                $daño = $rondaRivalFuerza * 1.5 * 0.6 - $rondaMiResistencia * 1.4;
                                            }
                                            if($daño <= 0){
                                                $daño = 0;
                                            }

                                            echo 'Daño = ' . $daño . '<br>';
                                            $miSalud = $miSalud - $daño;
                                            if($daño === 0){
                                                echo $miResult[0]['nombre'] . ' esquiva el golpe. Le quedan ' . $miSalud . ' puntos de salud.<br>';
                                            }
                                            else{
                                                echo $miResult[0]['nombre'] . ' pierde ' . $daño . ' puntos de Salud. Le quedan ' . $miSalud . '<br>';
                                            }

                                            if($miSalud <= 0){

                                            break;
                                            }
                                        }
                                        //Caso 7: DES <20 AGI
                                        elseif(($rondaRivalDestreza - $rondaMiAgilidad) < -20 ){
                                            echo $rivalResult[0]['nombre'] . ' cae al suelo mareado cuando intentaba perseguir a un ' . $miResult[0]['nombre'] . 'mucho más ágil. ¡Qué verguenza!<br>';

                                            //Tirada de contrataque
                                            $tiradaContraataque = rand(1,5);
                                            if($tiradaContraataque > 4){
                                                echo 'Situación aprovechada por ' . $miResult[0]['nombre'] . ' que lanza un contrataque mientras ' . $rivalResult[0]['nombre'] . ' recogía sus cosas del suelo.<br>';
                                                $daño = ($rondaMiFuerza - $rondaRivalResistencia);

                                                if($daño <= 0){
                                                    $daño = 0;
                                                }
                                                echo 'Daño = ' . $daño . '<br>';
                                                $rivalSalud = $rivalSalud - $daño;
                                                if($daño === 0){
                                                    echo $rivalResult[0]['nombre'] . ' esquiva el golpe. Le quedan ' . $rivalSalud . ' puntos de salud.<br>';
                                                }
                                                else{
                                                    echo $rivalResult[0]['nombre'] . ' pierde ' . $daño . ' puntos de Salud. Le quedan ' . $rivalSalud . '<br>';
                                                }

                                                if($rivalSalud <= 0){

                                                    break;
                                                }
                                            }
                                        }

                                    if($miAturdimiento > 0){
                                        $miAturdimiento = 0;
                                        echo 'En esta ronda ' . $miResult[0]['nombre'] . ' se está recuperando del Aturdimiento y no puede atacar.<br>';
                                    }
                                    else{
                                        echo 'Turno de ' . $miResult[0]['nombre'] . '<br>';

                                        echo $miResult[0]['nombre'] . ' intenta golpear con una destreza de ' . $rondaMiDestreza . '<br>';
                                        echo $rivalResult[0]['nombre'] . ' quiere esquivar con una agilidad de ' . $rondaRivalAgilidad . '<br>';

                                        //Acciones segun la diferencia de DES VS AGI
                                        //Caso 1: DES >20 AGI
                                        if(($rondaMiDestreza - $rondaRivalAgilidad) > 20){
                                            echo $miResult[0]['nombre'] . ' lanza un ataque sorpresa que pilla a ' . $rivalResult[0]['nombre'] . ' totalmente desprotegido.<br>';

                                            //Ver si ha sido Golpe Crítico
                                            //BONO gran DES vs AGI
                                            $tiradaCritico = rand(1,5);
                                            if($tiradaCritico < 5){
                                                $daño = $rondaMiFuerza;
                                            }
                                            else{
                                                echo '¡Golpe Crítico!<br>';
                                                $daño = $rondaMiFuerza * 1.5;
                                            }
                                            if($daño <= 0){
                                                $daño = 0;
                                            }
                                            //BONO de aturdimiento por gran DES vs AGI
                                            $golpeAturdidor = rand(1, 3);
                                            if($golpeAturdidor > 2){
                                                $rivalAturdimiento = 1;
                                                echo '¡Qué golpetazo! ' . $rivalResult[0]['nombre'] . ' queda en Aturdimiento<br>';
                                            }
                                            echo 'Daño = ' . $daño . '<br>';
                                            $rivalSalud = $rivalSalud - $daño;
                                            if($daño === 0){
                                                echo $rivalResult[0]['nombre'] . ' esquiva el golpe. Le quedan ' . $rivalSalud . ' puntos de salud.<br>';
                                            }
                                            else{
                                                echo $rivalResult[0]['nombre'] . ' pierde ' . $daño . ' puntos de Salud. Le quedan ' . $rivalSalud . '<br>';
                                            }

                                            if($rivalSalud <= 0){

                                            break;
                                            }
                                        }
                                        //Caso 2: DES >10 AGI
                                        elseif(($rondaMiDestreza - $rondaRivalAgilidad) > 10 && ($rondaMiDestreza - $rondaRivalAgilidad) <= 20){
                                            echo $miResult[0]['nombre'] . ' carga ferozmente contra ' . $rivalResult[0]['nombre'] . ' que apenas tiene tiempo de defenderse.<br>';

                                            //Ver si ha sido Golpe Crítico
                                            //BONO de gran DES vs AGI
                                            $tiradaCritico = rand(1,5);
                                            if($tiradaCritico < 5){
                                                $daño = $rondaMiFuerza * 1.4 - $rondaRivalResistencia * 0.6;
                                            }
                                            else{
                                                echo '¡Golpe Crítico!<br>';
                                                $daño = $rondaMiFuerza * 1.5 * 1.4 - $rondaRivalResistencia * 0.6;
                                            }
                                            if($daño <= 0){
                                                $daño = 0;
                                            }

                                            echo 'Daño = ' . $daño . '<br>';
                                            $rivalSalud = $rivalSalud - $daño;
                                            if($daño === 0){
                                                echo $rivalResult[0]['nombre'] . ' esquiva el golpe. Le quedan ' . $rivalSalud . ' puntos de salud.<br>';
                                            }
                                            else{
                                                echo $rivalResult[0]['nombre'] . ' pierde ' . $daño . ' puntos de Salud. Le quedan ' . $rivalSalud . '<br>';
                                            }

                                            if($rivalSalud <= 0){

                                            break;
                                            }
                                        }
                                        //Caso 3: DES >4 AGI
                                        elseif(($rondaMiDestreza - $rondaRivalAgilidad) > 4 && ($rondaMiDestreza - $rondaRivalAgilidad) <= 10){
                                            echo $miResult[0]['nombre'] . ' ataca con destreza y ' . $rivalResult[0]['nombre'] . ' se ve en apuros.<br>';

                                            //Ver si ha sido Golpe Crítico
                                            //BONO de gran DES vs AGI
                                            $tiradaCritico = rand(1,5);
                                            if($tiradaCritico < 5){
                                                $daño = $rondaMiFuerza * 1.2 - $rondaRivalResistencia * 0.8;
                                            }
                                            else{
                                                echo '¡Golpe Crítico!<br>';
                                                $daño = $rondaMiFuerza * 1.5 * 1.2 - $rondaRivalResistencia * 0.8;
                                            }
                                            if($daño <= 0){
                                                $daño = 0;
                                            }
                                            echo 'Daño = ' . $daño . '<br>';
                                            $rivalSalud = $rivalSalud - $daño;
                                            if($daño === 0){
                                                echo $rivalResult[0]['nombre'] . ' esquiva el golpe. Le quedan ' . $rivalSalud . ' puntos de salud.<br>';
                                            }
                                            else{
                                                echo $rivalResult[0]['nombre'] . ' pierde ' . $daño . ' puntos de Salud. Le quedan ' . $rivalSalud . '<br>';
                                            }

                                            if($rivalSalud <= 0){

                                            break;
                                            }
                                        }
                                        //Caso 4: DES [-4,+4] AGI
                                        elseif(($rondaMiDestreza - $rondaRivalAgilidad) > -5 && ($rondaMiDestreza - $rondaRivalAgilidad) < 5 ){
                                            echo $miResult[0]['nombre'] . ' intenta golpear a ' . $rivalResult[0]['nombre'] . ' que está preparado.<br>';

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
                                            if($daño === 0){
                                                echo $rivalResult[0]['nombre'] . ' esquiva el golpe. Le quedan ' . $rivalSalud . ' puntos de salud.<br>';
                                            }
                                            else{
                                                echo $rivalResult[0]['nombre'] . ' pierde ' . $daño . ' puntos de Salud. Le quedan ' . $rivalSalud . '<br>';
                                            }

                                            if($rivalSalud <= 0){

                                            break;
                                            }
                                        }
                                        //Caso 5: DES <-4 AGI
                                        elseif(($rondaMiDestreza - $rondaRivalAgilidad) >= -10 && ($rondaMiDestreza - $rondaRivalAgilidad) <= -5 ){
                                            echo $miResult[0]['nombre'] . ' prepara un ataque poco diestro contra ' . $rivalResult[0]['nombre'] . ' que ha leído la intención y se anticipa.<br>';

                                            //Ver si ha sido Golpe Crítico
                                            //Penalizacion de baja DES vs AGI
                                            $tiradaCritico = rand(1,5);
                                            if($tiradaCritico < 5){
                                                $daño = $rondaMiFuerza * 0.8 - $rondaRivalResistencia * 1.2;
                                            }
                                            else{
                                                echo '¡Golpe Crítico!<br>';
                                                $daño = $rondaMiFuerza * 1.5 * 0.8 - $rondaRivalResistencia * 1.2;
                                            }
                                            if($daño <= 0){
                                                $daño = 0;
                                            }

                                            echo 'Daño = ' . $daño . '<br>';
                                            $rivalSalud = $rivalSalud - $daño;
                                            if($daño === 0){
                                                echo $rivalResult[0]['nombre'] . ' esquiva el golpe. Le quedan ' . $rivalSalud . ' puntos de salud.<br>';
                                            }
                                            else{
                                                echo $rivalResult[0]['nombre'] . ' pierde ' . $daño . ' puntos de Salud. Le quedan ' . $rivalSalud . '<br>';
                                            }

                                            if($rivalSalud <= 0){

                                            break;
                                            }
                                        }
                                        //Caso 6: DES <10 AGI
                                        elseif(($rondaMiDestreza - $rondaRivalAgilidad) >= -20 && ($rondaMiDestreza - $rondaRivalAgilidad) < -10 ){
                                            echo $miResult[0]['nombre'] . ' intenta una torpe carga contra ' . $rivalResult[0]['nombre'] . ' que ya le espera en posición muy ventajosa.<br>';

                                            //Ver si ha sido Golpe Crítico
                                            //Penalizacion de baja DES vs AGI
                                            $tiradaCritico = rand(1,5);
                                            if($tiradaCritico < 5){
                                                $daño = $rondaMiFuerza * 0.6 - $rondaRivalResistencia * 1.4;
                                            }
                                            else{
                                                echo '¡Golpe Crítico!<br>';
                                                $daño = $rondaMiFuerza * 1.5 * 0.6 - $rondaRivalResistencia * 1.4;
                                            }

                                            if($daño <= 0){
                                                $daño = 0;
                                            }

                                            echo 'Daño = ' . $daño . '<br>';
                                            $rivalSalud = $rivalSalud - $daño;
                                            if($daño === 0){
                                                echo $rivalResult[0]['nombre'] . ' esquiva el golpe. Le quedan ' . $rivalSalud . ' puntos de salud.<br>';
                                            }
                                            else{
                                                echo $rivalResult[0]['nombre'] . ' pierde ' . $daño . ' puntos de Salud. Le quedan ' . $rivalSalud . '<br>';
                                            }

                                            if($rivalSalud <= 0){

                                                break;
                                            }
                                        }
                                        //Caso 7: DES <20 AGI
                                        elseif(($rondaMiDestreza - $rondaRivalAgilidad) < -20 ){
                                            echo $miResult[0]['nombre'] . ' cae al suelo mareado cuando intentaba perseguir a un ' . $rivalResult[0]['nombre'] . 'mucho más ágil. ¡Qué verguenza!<br>';

                                            //Tirada de contrataque
                                            $tiradaContraataque = rand(1,5);
                                            if($tiradaContraataque > 4){
                                                echo 'Situación aprovechada por ' . $rivalResult[0]['nombre'] . ' que lanza un contrataque mientras ' . $miResult[0]['nombre'] . ' recogía sus cosas del suelo.<br>';
                                                $daño = ($rondaRivalFuerza - $rondaMiResistencia);
                                                if($daño <= 0){
                                                    $daño = 0;
                                                }
                                                echo 'Daño = ' . $daño . '<br>';
                                                $miSalud = $miSalud - $daño;
                                                if($daño === 0){
                                                    echo $miResult[0]['nombre'] . ' esquiva el golpe. Le quedan ' . $miSalud . ' puntos de salud.<br>';
                                                }
                                                else{
                                                    echo $miResult[0]['nombre'] . ' pierde ' . $daño . ' puntos de Salud. Le quedan ' . $miSalud . '<br>';
                                                }

                                                if($miSalud <= 0){

                                                break;
                                                }
                                            }
                                        }

                                    }
                                }
                            }
                            echo 'FIN DE RONDA<br>';

                            echo '(' . $rivalResult[0]['nombre'] . ' ' . $rivalSalud . ' //// ' . $miResult[0]['nombre'] . ' ' . $miSalud . ')<br><br>';

                        }

                        $misPuntos = $rivalResult[0]['salud'] - $rivalSalud;
                        $rivalPuntos = $miResult[0]['salud'] - $miSalud;
                        echo $miResult[0]['nombre'] . ' ha provocado ' . $misPuntos . ' puntos de daño a ' . $rivalResult[0]['nombre'] . '<br>';
                        echo $rivalResult[0]['nombre'] . ' ha provocado ' . $rivalPuntos . ' puntos de daño a ' . $miResult[0]['nombre'] . '<br>';

                        if($miSalud <= 0){
                            hasPerdido($id);
                        }
                        elseif($rivalSalud <= 0){
                            hasGanado($id);
                        }
                        elseif($misPuntos > $rivalPuntos){
                            hasGanado($id);
                        }
                        elseif($misPuntos <= $rivalPuntos){
                            hasPerdido($id);
                        }

                        //El atacante pierde energía y se incrementa el contador de emboscada +1 Hora
                        //Aunque el minimo para atacar sea tener 50, puede ser interesante que a veces no le agote del todo a 0. 
                        $restaEnergia = rand(30,100);
                        $sql = "UPDATE personajes SET emboscada = ADDTIME(NOW(), '1:0:0'), energia = CASE WHEN energia-'$restaEnergia' < 0 THEN 0 ELSE energia-'$restaEnergia' END WHERE id='$miId'";
                        $db->query($sql);
                        
                        //Atacante ve restada su salud
                        $sql = "UPDATE personajes SET salud = CASE WHEN salud-'$rivalPuntos' < 0 THEN 0 ELSE salud-'$rivalPuntos' END WHERE id='$miId'";
                        $db->query($sql);
                        
                        //Defensor ve restada su salud
                        $sql = "UPDATE personajes SET salud = CASE WHEN salud-'$misPuntos' < 0 THEN 0 ELSE salud-'$misPuntos' END WHERE id='$id'";
                        $db->query($sql);
                    }
                    else{
                            echo "¡Ay! Estoy sin energia ahora mismo para hacer eso";
                        }
                }
                else{
                    echo "No estamos en la misma zona.";
                }
            }
            else{
               echo "No he descansado de mi última emboscada"; 
            }
        }
        else{
            echo "No he descansado de mi última acción";
        }
    }
    else{
        echo "No creerás que voy a atacarme a mí mismo";
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
        echo "FIN DE COMBATEEE <br>¡Lo hiciste! Ganas " . $dineroPillado . "€ y " . $respetoPillado . " puntos de Respeto";
        
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
       
        //INFORMAR A AMBOS JUGADORES CON MENSAJE
        $idRival = $rivalResult[0]['id'];
        $nombreRival = $rivalResult[0]['nombre'];
        $idYo = $miResult[0]['id'];
        $nombreYo = $miResult[0]['nombre'];
                
        $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$idYo','Emboscada','En el silencio de la noche, $nombreRival camina apresuradamente de camino a casa. Al pasar por delante de un montón de cajas apiladas escucha un chasquido. Se gira en la oscuridad y todo lo que alcanza a ver es la sombra de un bate de béisbol empuñado por $nombreYo.<br>¡Comienza la Batalla!<br>Cuando al fín cesa el ruido y el humo se disipa, queda sobre el asfalto el cuerpo de $nombreRival herido, mientras $nombreYo huye de la escena con un botín de $dineroPillado Monedas y $respetoPillado Puntos de Respeto que $nombreRival echará en falta.','emboscada.png'),"
                . "('$idRival','Emboscada','En el silencio de la noche, $nombreRival camina apresuradamente de camino a casa. Al pasar por delante de un montón de cajas apiladas escucha un chasquido. Se gira en la oscuridad y todo lo que alcanza a ver es la sombra de un bate de béisbol empuñado por $nombreYo.<br>¡Comienza la Batalla!<br>Cuando al fín cesa el ruido y el humo se disipa, queda sobre el asfalto el cuerpo de $nombreRival herido, mientras $nombreYo huye de la escena con un botín de $dineroPillado Monedas y $respetoPillado Puntos de Respeto que $nombreRival echará en falta.','emboscada.png')";
        $db->query($sql);
        
        //Actualizo el dinero y el respeto
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
        
        //INFORMAR A AMBOS JUGADORES CON MENSAJE
        $idRival = $rivalResult[0]['id'];
        $nombreRival = $rivalResult[0]['nombre'];
        $idYo = $miResult[0]['id'];
        $nombreYo = $miResult[0]['nombre'];
        //Creo los mensajes
        $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$idYo','Emboscada','En la vida conocí, mujer igual a $nombreRival, coral negro de La Habana, tremendísima mulata. Cien libras de piel y hueso, cuarenta kilos de salsa, y en la cara dos soles que sin palabras hablan. $nombreYo daría lo que fuera, aunque solo uno fuera.','emboscada.png'),"
                . "('$idRival','Emboscada','En la vida conocí, mujer igual a $nombreRival, coral negro de La Habana, tremendísima mulata. Cien libras de piel y hueso, cuarenta kilos de salsa, y en la cara dos soles que sin palabras hablan. $nombreYo daría lo que fuera, aunque solo uno fuera.','emboscada.png')";
        $db->query($sql);
        
        //Actualizo el rival
        $rivalResult = getPersonajeRow($id);
        $nuevoCash = $rivalResult[0]['cash'] + $dineroPerdido;
        $nuevoRespeto = $rivalResult[0]['respeto'] + $respetoPerdido;
        $sql = "UPDATE personajes SET cash = '$nuevoCash',respeto = '$nuevoRespeto' WHERE id='$id'";
        $stmt = $db->query($sql);
        return $stmt->fetchAll();   
    }
    
    function nombreAId($nombre){
        global $db;
        $sql = "SELECT id FROM personajes WHERE nombre = '$nombre'";
        $stmt = $db->query($sql);
        $result = $stmt->fetchAll();
        if(isset($result[0])){
            $id = $result[0]['id'];

            return $id;
        }
        else{
            
           return 0;
        }
        
    }
        
?>
