<?php

function zona($box){
    include (__ROOT__.'/backend/comprobaciones.php');
    include (__ROOT__.'/backend/tiradas.php');
    include (__ROOT__.'/backend/fightFunctions.php');
    global $db;
    $id = $_SESSION['loggedIn'];
    
    
    switch($box){
        case 'aventuraLosPinos':
            $zona = 1;
            $barrio = 1;
            $agotamiento = 30;
            $probabilidadEncontrar = rand(1, 30);
            $puedoHacerlo = comprobarEnergia($agotamiento);
            $tengoSalud = comprobarSalud(1);
            if($puedoHacerlo === 1 && $tengoSalud === 1){
                $sql = "UPDATE personajes SET energia = energia-$agotamiento WHERE id='$id'";
                $stmt = $db->query($sql);
                $encuentroMonstruos = buscarMonstruos($probabilidadEncontrar);
                if($encuentroMonstruos === 1){
                    // ¿Cuál monstruo he encontrado?
                    $monstruo = cualMonstruo($zona,$barrio);
                    $box = $monstruo[0]['nombre'];
                    
                    // Atacar al monstruo
                    $idMonstruo = $monstruo[0]['idM'];
                    $premio= atacarMonstruo($idMonstruo);
                    var_dump($premio);
                    if($premio > 0){
                        //GANO RESPETO? GANO OBJETOS? 
                        $respetoGanado = rand($monstruo[0]['nivel']*2, $monstruo[0]['nivel']*5);
                        $sql = "UPDATE personajes SET respeto = respeto+$respetoGanado WHERE id='$id'";
                        $db->query($sql);
                        
                        $celebracion = "Toma ya! He derrotado al monstruo y gano $premio EXP. <br> Mi respeto sube $respetoGanado puntos.<br>";
                        
                        //Gano tambien dinero?
                        $ganoDinero = rand(1,3);
                        if($ganoDinero > 2){
                            $dineroGanado = rand(10,50);
                            $sql = "UPDATE personajes SET cash = personajes.cash + '$dineroGanado' WHERE id='$id'";
                            $db->query($sql);
                            $mensajeDinero = "El monstruo llevaba una bolsita. La abro y miro dentro. Consigo $dineroGanado monedas.<br>";
                        }
                        else{
                            $mensajeDinero = '';
                        }

                        //Gano tambien objeto?
                        $ganoObjeto = rand(1,5);
                        if($ganoObjeto>4){
                            //HAY QUE MIRAR QUÉ OBJETO SUELTA EL MONSTRUO
                            $mensajeObjeto = " Le arrebato un objeto que llevaba consigo: MAIZ ";
                        }
                        else{
                            $mensajeObjeto = '';
                        }
                        
                        //Comprobar si subo de nivel
                        global $db;
                        $sql = "SELECT nivel FROM personajes WHERE id='$id'";
                        $stmt = $db->query($sql);
                        $personaje = $stmt->fetchAll();
                        $nuevoNivel = comprobarSuboNivel($id);
                        if($nuevoNivel != $personaje[0]['nivel'] ){
                            $sql = "UPDATE personajes SET nivel = personajes.nivel+1 WHERE id='$id'";
                            $db->query($sql);
                            $mensajeNivel = " SUBO DE NIVEL!<br>";
                            
                        }

                        $celebracion = $celebracion . $mensajeNivel . $mensajeDinero . $mensajeObjeto;
                    }
                    else{
                        $sql = "SELECT personajes.salud FROM personajes WHERE id = '$id'";
                        $stmt = $db->prepare($sql);
                        $stmt->execute();       
                        $result = $stmt->fetchAll();
                        if($result[0]['salud'] != 0){
                            $celebracion = "¡Ouch! Eso ha dolido. Me vuelvo a casa a curar mis heridas <br>";
                        }
                        else{
                        //Si me quedo con la vida a cero, me llevan al hospital     
                        $sql = "UPDATE personajes SET barrio = '9', zona = '1' WHERE id='$id'";
                        $db->query($sql);
                        $celebracion = "¡Qué dolor! Al Hospital vamos <br>";
                        }
                    }
                    
                    $box = "Me enfrento a un " . $box . " ... " . $celebracion;
                }
                else{
                    $box = "No he encontrado ningún monstruo. Quizá necesito aumentar algo más mi Percepción antes de salir en busca de aventuras por esta zona";
                }
            }
            else{
                $box = "¡Ay! No puedo con mi cuerpo ahora mismo";
            }
            break;
            
        default:
            $box = "Error: esa opcion no existe";
    }
    
    header("location: ?page=accion&message=$box");
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
        
    //Consultar que objetos tiene equipados el personaje en cada slot (se ordenan por slot)
    $sql = "SELECT objetos.*, inventario.slot FROM inventario JOIN objetos ON inventario.idO = objetos.id WHERE inventario.idP = '$miId' AND inventario.slot < 8";
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
    
    //Calculados los atributos totales
    $miDestreza = $miResult[0]['destreza'] + $bonusDestreza;
    $miFuerza = $miResult[0]['fuerza'] + $bonusFuerza;
    $miAgilidad = $miResult[0]['agilidad'] + $bonusAgilidad;
    $miResistencia = $miResult[0]['resistencia'] + $bonusResistencia;
    $miEstilo = $miResult[0]['estilo'] + $bonusEstilo;
    
    //COMBATE
    $rondas = 10;
    $miSalud = $miResult[0]['salud'];
    $monstruoSalud = $monstruoResult[0]['salud'];
    $miAturdimiento = 0;
    $monstruoAturdimiento = 0;
            
   // echo 'Salud inicial: ' . $miResult[0]['nombre'] . ' ' . $miSalud . ' //// ' . $monstruoResult[0]['nombre'] . ' ' . $monstruoSalud . '<br>';
                
    for($i = 1; $i <= $rondas; $i++){ 
    //Calcular cuanto sacan en esta ronda, y en caso de ser negativo, ponerlos a '0'
        $rondaMiDestreza = rand($miDestreza-10, $miDestreza+10);
        $rondaMonstruoAgilidad = rand($monstruoResult[0]['agilidad']-10, $monstruoResult[0]['agilidad']+10);
        $rondaMiFuerza = rand($miFuerza-5, $miFuerza+5);
        $rondaMonstruoResistencia = rand($monstruoResult[0]['resistencia']-5, $monstruoResult[0]['resistencia']+5);
        $rondaMonstruoDestreza = rand($monstruoResult[0]['destreza']-10, $monstruoResult[0]['destreza']+10);
        $rondaMiAgilidad = rand($miAgilidad-10, $miAgilidad+10);
        $rondaMonstruoFuerza = rand($monstruoResult[0]['fuerza']-5, $monstruoResult[0]['fuerza']+5);
        $rondaMiResistencia = rand($miResistencia-5, $miResistencia+5);
                    
        if($rondaMiDestreza < 0){
            $rondaMiDestreza = 0;
        }
        if($rondaMonstruoAgilidad < 0){
            $rondaMonstruoAgilidad = 0;
        }                   
        if($rondaMiFuerza < 0){
            $rondaMiFuerza = 0;
        }
        if($rondaMonstruoResistencia < 0){
            $rondaMonstruoResistencia = 0;
        }           
        if($rondaMonstruoDestreza < 0){
            $rondaMonstruoDestreza = 0;
        }
        if($rondaMiAgilidad < 0){
            $rondaMiAgilidad = 0;
        }            
        if($rondaMonstruoFuerza < 0){
            $rondaMonstruoFuerza = 0;
        }
        if($rondaMiResistencia < 0){
            $rondaMiResistencia = 0;
        }
                    
  //      echo '¡Comienza la ronda ' . $i . '!<br>';
        $iniciativa = 1; //rand(1,2);
        if($iniciativa === 1){
            if($miAturdimiento > 0){
                $miAturdimiento = 0;
     //           echo 'En esta ronda ' . $miResult[0]['nombre'] . ' se está recuperando del aturdimiento y no puede atacar. <br>';
     //           echo 'Turno de ' . $monstruoResult[0]['nombre'] . '<br>';

     //          echo $monstruoResult[0]['nombre'] . ' intenta golpear con una destreza de ' . $rondaMonstruoDestreza . '<br>';
       //         echo $miResult[0]['nombre'] . ' quiere esquivar con una agilidad de ' . $rondaMiAgilidad . '<br>';
                //Acciones segun la diferencia de DES VS AGI
                //Caso 1: DES >20 AGI
                if(($rondaMonstruoDestreza - $rondaMiAgilidad) > 20){
         //           echo $monstruoResult[0]['nombre'] . ' lanza un ataque sorpresa que pilla a ' . $miResult[0]['nombre'] . ' totalmente desprotegido.<br>';

                    //Ver si ha sido Golpe Crítico
                    //BONO de gran DES vs AGI
                    $tiradaCritico = rand(1,5);
                    if($tiradaCritico < 5){
                        $daño = $rondaMonstruoFuerza;
                    }
                    else{
           //             echo '¡Golpe Crítico!<br>';
                        $daño = $rondaMonstruoFuerza * 1.5;
                    }
                    if($daño <= 0){
                        $daño = 0;
                    }
                                
                    //BONO de aturdimiento por gran DES vs AGI
                    $golpeAturdidor = rand(1, 3);
                    if($golpeAturdidor > 2){
                        $miAturdimiento = 1;
             //           echo '¡Qué golpetazo! ' . $miResult[0]['nombre'] . ' queda en Aturdimiento<br>';
                    }
               //     echo 'Daño = ' . $daño . '<br>';
                    $miSalud = $miSalud - $daño;
                    if($daño === 0){
    //                    echo $miResult[0]['nombre'] . ' esquiva el golpe. Le quedan ' . $miSalud . ' puntos de salud.<br>';
                    }
                    else{
      //                  echo $miResult[0]['nombre'] . ' pierde ' . $daño . ' puntos de Salud. Le quedan ' . $miSalud . '<br>';
                    }
                    if($miSalud <= 0){    
                        break;
                    }
                }
                //Caso 2: DES >10 AGI
                elseif(($rondaMonstruoDestreza - $rondaMiAgilidad) > 10 && ($rondaMonstruoDestreza - $rondaMiAgilidad) <= 20){
        //            echo $monstruoResult[0]['nombre'] . ' carga ferozmente contra ' . $miResult[0]['nombre'] . ' que apenas tiene tiempo de defenderse.<br>';

                    //Ver si ha sido Golpe Crítico
                    //BONO de gran DES vs AGI
                    $tiradaCritico = rand(1,5);
                    if($tiradaCritico < 5){
                        $daño = $rondaMonstruoFuerza * 1.4 - $rondaMiResistencia * 0.6;
                    }
                    else{
          //              echo '¡Golpe Crítico!<br>';
                        $daño = $rondaMonstruoFuerza * 1.5 * 1.4 - $rondaMiResistencia * 0.6;
                    }
                    if($daño <= 0){
                        $daño = 0;
                    }
                                
            //        echo 'Daño = ' . $daño . '<br>';
                    $miSalud = $miSalud - $daño;
                    if($daño === 0){
              //          echo $miResult[0]['nombre'] . ' esquiva el golpe. Le quedan ' . $miSalud . ' puntos de salud.<br>';
                    }
                    else{
    //                    echo $miResult[0]['nombre'] . ' pierde ' . $daño . ' puntos de Salud. Le quedan ' . $miSalud . '<br>';
                    }

                    if($miSalud <= 0){
                        break;
                    }
                }
                //Caso 3: DES >4 AGI
                elseif(($rondaMonstruoDestreza - $rondaMiAgilidad) > 4 && ($rondaMonstruoDestreza - $rondaMiAgilidad) <= 10){
      //              echo $monstruoResult[0]['nombre'] . ' ataca con destreza y ' . $miResult[0]['nombre'] . ' se ve en apuros.<br>';

                    //Ver si ha sido Golpe Crítico
                    //BONO de gran DES vs AGI
                    $tiradaCritico = rand(1,5);
                    if($tiradaCritico < 5){
                        $daño = $rondaMonstruoFuerza * 1.2 - $rondaMiResistencia * 0.8;
                    }
                    else{
        //                echo '¡Golpe Crítico!<br>';
                        $daño = $rondaMonstruoFuerza * 1.5 * 1.2 - $rondaMiResistencia * 0.8;
                    }
                    if($daño <= 0){
                        $daño = 0;
                    }
                                
          //          echo 'Daño = ' . $daño . '<br>';
                    $miSalud = $miSalud - $daño;
                    if($daño === 0){
            //            echo $miResult[0]['nombre'] . ' esquiva el golpe. Le quedan ' . $miSalud . ' puntos de salud!<br>';
                    }
                    else{
              //          echo $miResult[0]['nombre'] . ' pierde ' . $daño . ' puntos de Salud. Le quedan ' . $miSalud . '<br>';
                    }

                    if($miSalud <= 0){    
                        break;
                    }
                }
                //Caso 4: DES [-4,+4] AGI
                elseif(($rondaMonstruoDestreza - $rondaMiAgilidad) > -5 && ($rondaMonstruoDestreza - $rondaMiAgilidad) < 5 ){
    //                echo  $monstruoResult[0]['nombre'] . ' intenta golpear a ' . $miResult[0]['nombre'] . ' que está preparado<br>';

                    //Ver si ha sido Golpe Crítico
                    $tiradaCritico = rand(1,5);
                    if($tiradaCritico < 5){
                        $daño = $rondaMonstruoFuerza - $rondaMiResistencia;
                    }
                    else{
      //                  echo '¡Golpe Crítico!<br>';
                        $daño = $rondaMonstruoFuerza * 1.5 - $rondaMiResistencia;
                    }
                    if($daño <= 0){
                        $daño = 0;
                    }
                                
        //            echo 'Daño = ' . $daño . '<br>';
                    $miSalud = $miSalud - $daño;
                    if($daño === 0){
          //              echo $miResult[0]['nombre'] . ' esquiva el golpe. Le quedan ' . $miSalud . ' puntos de salud<br>';
                    }
                    else{
            //            echo $miResult[0]['nombre'] . ' pierde ' . $daño . ' puntos de Salud. Le quedan ' . $miSalud . '<br>';
                    }

                    if($miSalud <= 0){          
                        break;
                    }
                }
                //Caso 5: DES <-4 AGI
                elseif(($rondaMonstruoDestreza - $rondaMiAgilidad) >= -10 && ($rondaMonstruoDestreza - $rondaMiAgilidad) <= -5 ){
//                    echo $monstruoResult[0]['nombre'] . ' prepara un ataque poco diestro contra ' . $miResult[0]['nombre'] . ' que ha leído la intención y se anticipa<br>';

                    //Ver si ha sido Golpe Crítico
                    //Penalizacion baja DES vs AGI
                    $tiradaCritico = rand(1,5);
                    if($tiradaCritico < 5){
                        $daño = $rondaMonstruoFuerza * 0.8 - $rondaMiResistencia * 1.2;
                    }
                    else{
  //                      echo '¡Golpe Crítico!<br>';
                        $daño = $rondaMonstruoFuerza * 1.5 * 0.8 - $rondaMiResistencia * 1.2;
                    }
                                
                    if($daño <= 0){
                        $daño = 0;
                    }
                                
    //                echo 'Daño = ' . $daño . '<br>';
                    $miSalud = $miSalud - $daño;
                    if($daño === 0){
      //                  echo $miResult[0]['nombre'] . ' esquiva el golpe. Le quedan ' . $miSalud . ' puntos de salud.<br>';
                    }
                    else{
        //                echo $miResult[0]['nombre'] . ' pierde ' . $daño . ' puntos de Salud. Le quedan ' . $miSalud . '<br>';
                    }

                    if($miSalud <= 0){     
                        break;
                    }
                }
                //Caso 6: DES <10 AGI
                elseif(($rondaMonstruoDestreza - $rondaMiAgilidad) >= -20 && ($rondaMonstruoDestreza - $rondaMiAgilidad) < -10 ){
//                    echo $monstruoResult[0]['nombre'] . ' intenta una torpe carga contra ' . $miResult[0]['nombre'] . ' que ya le espera en posición muy ventajosa<br>';

                    //Ver si ha sido Golpe Crítico
                    //Penalizacion baja DES vs AGI
                    $tiradaCritico = rand(1,5);
                    if($tiradaCritico < 5){
                        $daño = $rondaMonstruoFuerza * 0.6 - $rondaMiResistencia * 1.4;
                    }
                    else{
  //                      echo '¡Golpe Crítico!<br>';
                        $daño = $rondaMonstruoFuerza * 1.5 * 0.6 - $rondaMiResistencia * 1.4;
                    }
                                
                    if($daño <= 0){
                        $daño = 0;
                    }
                                
    //                echo 'Daño = ' . $daño . '<br>';
                    $miSalud = $miSalud - $daño;
                    if($daño === 0){
      //                  echo $miResult[0]['nombre'] . ' esquiva el golpe. Le quedan ' . $miSalud . ' puntos de salud.<br>';
                    }
                    else{
        //               echo $miResult[0]['nombre'] . ' pierde ' . $daño . ' puntos de Salud. Le quedan ' . $miSalud . '<br>';
                    }

                    if($miSalud <= 0){    
                        break;
                    }
                }
                //Caso 7: DES <20 AGI
                elseif(($rondaMonstruoDestreza - $rondaMiAgilidad) < -20 ){
   //                 echo $monstruoResult[0]['nombre'] . ' cae al suelo mareado cuando intentaba perseguir a un ' . $miResult[0]['nombre'] . 'mucho más ágil. ¡Qué verguenza!<br>';

                    //Tirada de contrataque
                    $tiradaContraataque = rand(1,5);
                    if($tiradaContraataque > 4){
     //                   echo 'Situación aprovechada por ' . $miResult[0]['nombre'] . ' que lanza un contrataque mientras ' . $monstruoResult[0]['nombre'] . ' recogía sus cosas del suelo.<br>';
                        $daño = ($rondaMiFuerza - $rondaMonstruoResistencia);
                        if($daño <= 0){
                            $daño = 0;
                        }
       //                 echo 'Daño = ' . $daño . '<br>';
                        $monstruoSalud = $monstruoSalud - $daño;
                        if($daño === 0){
         //                   echo $monstruoResult[0]['nombre'] . ' esquiva el golpe. Le quedan ' . $monstruoSalud . ' puntos de salud.<br>';
                        }
                        else{
           //                 echo $monstruoResult[0]['nombre'] . ' pierde ' . $daño . ' puntos de Salud. Le quedan ' . $monstruoSalud . '<br>';
                        }

                        if($monstruoSalud <= 0){
                            break;
                        }
                    }
                }
            }
            else{
 //               echo $miResult[0]['nombre'] . ' toma la iniciativa<br>';
                            
   //             echo $miResult[0]['nombre'] . ' intenta golpear con una destreza de ' . $rondaMiDestreza . '<br>';
     //           echo $monstruoResult[0]['nombre'] . ' quiere esquivar con una agilidad de ' . $rondaMonstruoAgilidad . '<br>';
                            
                //Acciones segun la diferencia de DES VS AGI
                //Caso 1: DES >20 AGI
                if(($rondaMiDestreza - $rondaMonstruoAgilidad) > 20){
       //             echo $miResult[0]['nombre'] . ' lanza un ataque sorpresa que pilla a ' . $monstruoResult[0]['nombre'] . ' totalmente desprotegido.<br>';

                    //Ver si ha sido Golpe Crítico
                    //BONO de gran DES vs AGI
                    $tiradaCritico = rand(1,5);
                    if($tiradaCritico < 5){
                        $daño = $rondaMiFuerza;
                    }
                    else{
         //               echo '¡Golpe Crítico!<br>';
                        $daño = $rondaMiFuerza * 1.5;
                    }
                    if($daño <= 0){
                        $daño = 0;
                    }
                                
                    //BONO de aturdimiento por gran DES vs AGI
                    $golpeAturdidor = rand(1, 3);
                    if($golpeAturdidor > 2){
                        $monstruoAturdimiento = 1;
           //             echo '¡Qué golpetazo! ' . $monstruoResult[0]['nombre'] . ' queda en Aturdimiento<br>';
                    }
             //       echo 'Daño = ' . $daño . '<br>';
                    $monstruoSalud = $monstruoSalud - $daño;
                    if($daño === 0){
               //         echo $monstruoResult[0]['nombre'] . ' esquiva el golpe. Le quedan ' . $monstruoSalud . ' puntos de salud.<br>';
                    }
                    else{
                 //       echo $monstruoResult[0]['nombre'] . ' pierde ' . $daño . ' puntos de Salud. Le quedan ' . $monstruoSalud . '<br>';
                    }

                    if($monstruoSalud <= 0){
                        break;
                    }
                }
                //Caso 2: DES >10 AGI
                elseif(($rondaMiDestreza - $rondaMonstruoAgilidad) > 10 && ($rondaMiDestreza - $rondaMonstruoAgilidad) <= 20){
   //                 echo $miResult[0]['nombre'] . ' carga ferozmente contra ' . $monstruoResult[0]['nombre'] . ' que apenas tiene tiempo de defenderse.<br>';

                    //Ver si ha sido Golpe Crítico
                    //BONO de gran DES vs AGI
                    $tiradaCritico = rand(1,5);
                    if($tiradaCritico < 5){
                        $daño = $rondaMiFuerza * 1.4 - $rondaMonstruoResistencia * 0.6;
                    }
                    else{
     //                   echo '¡Golpe Crítico!<br>';
                        $daño = $rondaMiFuerza * 1.5 * 1.4 - $rondaMonstruoResistencia * 0.6;
                    }
                    if($daño <= 0){
                        $daño = 0;
                    }
                                
       //             echo 'Daño = ' . $daño . '<br>';
                    $monstruoSalud = $monstruoSalud - $daño;
                    if($daño === 0){
         //               echo $monstruoResult[0]['nombre'] . ' esquiva el golpe. Le quedan ' . $monstruoSalud . ' puntos de salud.<br>';
                    }
                    else{
           //             echo $monstruoResult[0]['nombre'] . ' pierde ' . $daño . ' puntos de Salud. Le quedan ' . $monstruoSalud . '<br>';
                    }

                    if($monstruoSalud <= 0){ 
                        break;
                    }
                }
                //Caso 3: DES >4 AGI
                elseif(($rondaMiDestreza - $rondaMonstruoAgilidad) > 4 && ($rondaMiDestreza - $rondaMonstruoAgilidad) <= 10){
   //                 echo $miResult[0]['nombre'] . ' ataca con destreza y ' . $monstruoResult[0]['nombre'] . ' se ve en apuros<br>';

                    //Ver si ha sido Golpe Crítico
                    //BONO de gran DES vs AGI
                    $tiradaCritico = rand(1,5);
                    if($tiradaCritico < 5){
                        $daño = $rondaMiFuerza * 1.2 - $rondaMonstruoResistencia * 0.8;
                    }
                    else{
     //                   echo '¡Golpe Crítico!<br>';
                        $daño = $rondaMiFuerza * 1.5 * 1.2 - $rondaMonstruoResistencia * 0.8;
                    }
                    if($daño <= 0){
                        $daño = 0;
                    }
                                
       //             echo 'Daño = ' . $daño . '<br>';
                    $monstruoSalud = $monstruoSalud - $daño;
                    if($daño === 0){
         //               echo $monstruoResult[0]['nombre'] . ' esquiva el golpe. Le quedan ' . $monstruoSalud . ' puntos de salud.<br>';
                    }
                    else{
           //             echo $monstruoResult[0]['nombre'] . ' pierde ' . $daño . ' puntos de Salud. Le quedan ' . $monstruoSalud . '<br>';
                    }                                

                    if($monstruoSalud <= 0){   
                        break;
                    }
                }
                //Caso 4: DES [-4,+4] AGI
                elseif(($rondaMiDestreza - $rondaMonstruoAgilidad) > -5 && ($rondaMiDestreza - $rondaMonstruoAgilidad) < 5 ){
   //                 echo $miResult[0]['nombre'] . ' intenta golpear a ' . $monstruoResult[0]['nombre'] . ' que está preparado<br>';

                    //Ver si ha sido Golpe Crítico
                    $tiradaCritico = rand(1,5);
                    if($tiradaCritico < 5){
                        $daño = $rondaMiFuerza - $rondaMonstruoResistencia;
                    }
                    else{
     //                   echo '¡Golpe Crítico!<br>';
                        $daño = $rondaMiFuerza * 1.5 - $rondaMonstruoResistencia;
                    }
                    if($daño <= 0){
                        $daño = 0;
                    }
       //             echo 'Daño = ' . $daño . '<br>';
                    $monstruoSalud = $monstruoSalud - $daño;
                    if($daño === 0){
         //               echo $monstruoResult[0]['nombre'] . ' esquiva el golpe. Le quedan ' . $monstruoSalud . ' puntos de salud.<br>';
                    }
                    else{
           //             echo $monstruoResult[0]['nombre'] . ' pierde ' . $daño . ' puntos de Salud. Le quedan ' . $monstruoSalud . '<br>';
                    }

                    if($monstruoSalud <= 0){ 
                        break;
                    }
                }
                //Caso 5: DES <-4 AGI
                elseif(($rondaMiDestreza - $rondaMonstruoAgilidad) >= -10 && ($rondaMiDestreza - $rondaMonstruoAgilidad) <= -5 ){
             //       echo $miResult[0]['nombre'] . ' prepara un ataque poco diestro contra ' . $monstruoResult[0]['nombre'] . ' que ha leído la intención y se anticipa.<br>';

                    //Ver si ha sido Golpe Crítico
                    //Penalizacion baja DES vs AGI
                    $tiradaCritico = rand(1,5);
                    if($tiradaCritico < 5){
                        $daño = $rondaMiFuerza * 0.8 - $rondaMonstruoResistencia * 1.2;
                    }
                    else{
 //                       echo '¡Golpe Crítico!<br>';
                        $daño = $rondaMiFuerza * 1.5 * 0.8 - $rondaMonstruoResistencia * 1.2;
                    }
                                
                    if($daño <= 0){
                        $daño = 0;
                    }
                                
   //                 echo 'Daño = ' . $daño . '<br>';
                    $monstruoSalud = $monstruoSalud - $daño;
                    if($daño === 0){
     //                   echo $monstruoResult[0]['nombre'] . ' esquiva el golpe. Le quedan ' . $monstruoSalud . ' puntos de salud.<br>';
                    }
                    else{
       //                 echo $monstruoResult[0]['nombre'] . ' pierde ' . $daño . ' puntos de Salud. Le quedan ' . $monstruoSalud . '<br>';
                    }

                    if($monstruoSalud <= 0){
                        break;
                    }
                }
                //Caso 6: DES <10 AGI
                elseif(($rondaMiDestreza - $rondaMonstruoAgilidad) >= -20 && ($rondaMiDestreza - $rondaMonstruoAgilidad) < -10 ){
         //           echo $miResult[0]['nombre'] . ' intenta una torpe carga contra ' . $monstruoResult[0]['nombre'] . ' que ya le espera en posición muy ventajosa.<br>';

                    //Ver si ha sido Golpe Crítico
                    //Penalizacion baja DES vs AGI
                    $tiradaCritico = rand(1,5);
                    if($tiradaCritico < 5){
                        $daño = $rondaMiFuerza * 0.6 - $rondaMonstruoResistencia * 1.4;
                    }
                    else{
           //             echo '¡Golpe Crítico!<br>';
                        $daño = $rondaMiFuerza * 1.5 * 0.6 - $rondaMonstruoResistencia * 1.4;
                    }
                                
                    if($daño <= 0){
                        $daño = 0;
                    }
                                
             //       echo 'Daño = ' . $daño . '<br>';
                    $monstruoSalud = $monstruoSalud - $daño;
                    if($daño === 0){
               //         echo $monstruoResult[0]['nombre'] . ' esquiva el golpe. Le quedan ' . $monstruoSalud . ' puntos de salud.<br>';
                    }
                    else{
                 //       echo $monstruoResult[0]['nombre'] . ' pierde ' . $daño . ' puntos de Salud. Le quedan ' . $monstruoSalud . '<br>';
                    }

                    if($monstruoSalud <= 0){  
                        break;
                    }
                }
                //Caso 7: DES <20 AGI
                elseif(($rondaMiDestreza - $rondaMonstruoAgilidad) < -20 ){
 //                   echo $miResult[0]['nombre'] . ' cae al suelo mareado cuando intentaba perseguir a un ' . $monstruoResult[0]['nombre'] . 'mucho más ágil. ¡Qué verguenza!<br>';

                    //Tirada de contrataque
                    $tiradaContraataque = rand(1,5);
                    if($tiradaContraataque > 4){
   //                     echo 'Situación aprovechada por ' . $monstruoResult[0]['nombre'] . ' que lanza un contrataque mientras ' . $miResult[0]['nombre'] . ' recogía sus cosas del suelo.<br>';
                        $daño = ($rondaMonstruoFuerza - $rondaMiResistencia);
                        if($daño <= 0){
                            $daño = 0;
                        }
     //                   echo 'Daño = ' . $daño . '<br>';
                        $miSalud = $miSalud - $daño;
                        if($daño === 0){
       //                     echo $miResult[0]['nombre'] . ' esquiva el golpe. Le quedan ' . $miSalud . ' puntos de salud.<br>';
                        }
                        else{
         //                   echo $miResult[0]['nombre'] . ' pierde ' . $daño . ' puntos de Salud. Le quedan ' . $miSalud . '<br>';
                        }

                        if($miSalud <= 0){     
                            break;
                        }
                    }
                }
                
           //     echo 'Turno de ' . $monstruoResult[0]['nombre'] . '<br>';

             //   echo $monstruoResult[0]['nombre'] . ' intenta golpear con una destreza de ' . $rondaMonstruoDestreza . '<br>';
  //              echo $miResult[0]['nombre'] . ' quiere esquivar con una agilidad de ' . $rondaMiAgilidad . '<br>';
                //Acciones segun la diferencia de DES VS AGI
                //Caso 1: DES >20 AGI
                if(($rondaMonstruoDestreza - $rondaMiAgilidad) > 20){
    //                echo $monstruoResult[0]['nombre'] . ' lanza un ataque sorpresa que pilla a ' . $miResult[0]['nombre'] . ' totalmente desprotegido.<br>';

                    //Ver si ha sido Golpe Crítico
                    //BONO de gran DES vs AGI
                    $tiradaCritico = rand(1,5);
                    if($tiradaCritico < 5){
                        $daño = $rondaMonstruoFuerza;
                    }
                    else{
      //                  echo '¡Golpe Crítico!<br>';
                        $daño = $rondaMonstruoFuerza * 1.5;
                    }
                    if($daño <= 0){
                        $daño = 0;
                    }
                                
                    //BONO de aturdimiento por gran DES vs AGI
                    $golpeAturdidor = rand(1, 3);
                    if($golpeAturdidor > 2){
                        $miAturdimiento = 1;
        //                echo '¡Qué golpetazo! ' . $miResult[0]['nombre'] . ' queda en Aturdimiento<br>';
                    }
          //          echo 'Daño = ' . $daño . '<br>';
                    $miSalud = $miSalud - $daño;
                    if($daño === 0){
            //            echo $miResult[0]['nombre'] . ' esquiva el golpe. Le quedan ' . $miSalud . ' puntos de salud.<br>';
                    }
                    else{
              //          echo $miResult[0]['nombre'] . ' pierde ' . $daño . ' puntos de Salud. Le quedan ' . $miSalud . '<br>';
                    }
                    if($miSalud <= 0){    
                        break;
                    }
                }
                //Caso 2: DES >10 AGI
                elseif(($rondaMonstruoDestreza - $rondaMiAgilidad) > 10 && ($rondaMonstruoDestreza - $rondaMiAgilidad) <= 20){
   //                 echo $monstruoResult[0]['nombre'] . ' carga ferozmente contra ' . $miResult[0]['nombre'] . ' que apenas tiene tiempo de defenderse.<br>';

                    //Ver si ha sido Golpe Crítico
                    //BONO de gran DES vs AGI
                    $tiradaCritico = rand(1,5);
                    if($tiradaCritico < 5){
                        $daño = $rondaMonstruoFuerza * 1.4 - $rondaMiResistencia * 0.6;
                    }
                    else{
     //                   echo '¡Golpe Crítico!<br>';
                        $daño = $rondaMonstruoFuerza * 1.5 * 1.4 - $rondaMiResistencia * 0.6;
                    }
                    if($daño <= 0){
                        $daño = 0;
                    }
                                
       //             echo 'Daño = ' . $daño . '<br>';
                    $miSalud = $miSalud - $daño;
                    if($daño === 0){
         //               echo $miResult[0]['nombre'] . ' esquiva el golpe. Le quedan ' . $miSalud . ' puntos de salud.<br>';
                    }
                    else{
           //             echo $miResult[0]['nombre'] . ' pierde ' . $daño . ' puntos de Salud. Le quedan ' . $miSalud . '<br>';
                    }

                    if($miSalud <= 0){
                        break;
                    }
                }
                //Caso 3: DES >4 AGI
                elseif(($rondaMonstruoDestreza - $rondaMiAgilidad) > 4 && ($rondaMonstruoDestreza - $rondaMiAgilidad) <= 10){
  //                  echo $monstruoResult[0]['nombre'] . ' ataca con destreza y ' . $miResult[0]['nombre'] . ' se ve en apuros.<br>';

                    //Ver si ha sido Golpe Crítico
                    //BONO de gran DES vs AGI
                    $tiradaCritico = rand(1,5);
                    if($tiradaCritico < 5){
                        $daño = $rondaMonstruoFuerza * 1.2 - $rondaMiResistencia * 0.8;
                    }
                    else{
    //                    echo '¡Golpe Crítico!<br>';
                        $daño = $rondaMonstruoFuerza * 1.5 * 1.2 - $rondaMiResistencia * 0.8;
                    }
                    if($daño <= 0){
                        $daño = 0;
                    }
                                
      //              echo 'Daño = ' . $daño . '<br>';
                    $miSalud = $miSalud - $daño;
                    if($daño === 0){
        //                echo $miResult[0]['nombre'] . ' esquiva el golpe. Le quedan ' . $miSalud . ' puntos de salud!<br>';
                    }
                    else{
          //              echo $miResult[0]['nombre'] . ' pierde ' . $daño . ' puntos de Salud. Le quedan ' . $miSalud . '<br>';
                    }

                    if($miSalud <= 0){    
                        break;
                    }
                }
                //Caso 4: DES [-4,+4] AGI
                elseif(($rondaMonstruoDestreza - $rondaMiAgilidad) > -5 && ($rondaMonstruoDestreza - $rondaMiAgilidad) < 5 ){
            //        echo  $monstruoResult[0]['nombre'] . ' intenta golpear a ' . $miResult[0]['nombre'] . ' que está preparado<br>';

                    //Ver si ha sido Golpe Crítico
                    $tiradaCritico = rand(1,5);
                    if($tiradaCritico < 5){
                        $daño = $rondaMonstruoFuerza - $rondaMiResistencia;
                    }
                    else{
  //                      echo '¡Golpe Crítico!<br>';
                        $daño = $rondaMonstruoFuerza * 1.5 - $rondaMiResistencia;
                    }
                    if($daño <= 0){
                        $daño = 0;
                    }
                                
    //                echo 'Daño = ' . $daño . '<br>';
                    $miSalud = $miSalud - $daño;
                    if($daño === 0){
      //                  echo $miResult[0]['nombre'] . ' esquiva el golpe. Le quedan ' . $miSalud . ' puntos de salud<br>';
                    }
                    else{
        //                echo $miResult[0]['nombre'] . ' pierde ' . $daño . ' puntos de Salud. Le quedan ' . $miSalud . '<br>';
                    }

                    if($miSalud <= 0){          
                        break;
                    }
                }
                //Caso 5: DES <-4 AGI
                elseif(($rondaMonstruoDestreza - $rondaMiAgilidad) >= -10 && ($rondaMonstruoDestreza - $rondaMiAgilidad) <= -5 ){
          //          echo $monstruoResult[0]['nombre'] . ' prepara un ataque poco diestro contra ' . $miResult[0]['nombre'] . ' que ha leído la intención y se anticipa<br>';

                    //Ver si ha sido Golpe Crítico
                    //Penalizacion baja DES vs AGI
                    $tiradaCritico = rand(1,5);
                    if($tiradaCritico < 5){
                        $daño = $rondaMonstruoFuerza * 0.8 - $rondaMiResistencia * 1.2;
                    }
                    else{
            //            echo '¡Golpe Crítico!<br>';
                        $daño = $rondaMonstruoFuerza * 1.5 * 0.8 - $rondaMiResistencia * 1.2;
                    }
                                
                    if($daño <= 0){
                        $daño = 0;
                    }
                                
              //      echo 'Daño = ' . $daño . '<br>';
                    $miSalud = $miSalud - $daño;
                    if($daño === 0){
                //        echo $miResult[0]['nombre'] . ' esquiva el golpe. Le quedan ' . $miSalud . ' puntos de salud.<br>';
                    }
                    else{
                  //      echo $miResult[0]['nombre'] . ' pierde ' . $daño . ' puntos de Salud. Le quedan ' . $miSalud . '<br>';
                    }

                    if($miSalud <= 0){     
                        break;
                    }
                }
                //Caso 6: DES <10 AGI
                elseif(($rondaMonstruoDestreza - $rondaMiAgilidad) >= -20 && ($rondaMonstruoDestreza - $rondaMiAgilidad) < -10 ){
    //                echo $monstruoResult[0]['nombre'] . ' intenta una torpe carga contra ' . $miResult[0]['nombre'] . ' que ya le espera en posición muy ventajosa<br>';

                    //Ver si ha sido Golpe Crítico
                    //Penalizacion baja DES vs AGI
                    $tiradaCritico = rand(1,5);
                    if($tiradaCritico < 5){
                        $daño = $rondaMonstruoFuerza * 0.6 - $rondaMiResistencia * 1.4;
                    }
                    else{
      //                  echo '¡Golpe Crítico!<br>';
                        $daño = $rondaMonstruoFuerza * 1.5 * 0.6 - $rondaMiResistencia * 1.4;
                    }
                                
                    if($daño <= 0){
                        $daño = 0;
                    }
                                
        //            echo 'Daño = ' . $daño . '<br>';
                    $miSalud = $miSalud - $daño;
                    if($daño === 0){
          //              echo $miResult[0]['nombre'] . ' esquiva el golpe. Le quedan ' . $miSalud . ' puntos de salud.<br>';
                    }
                    else{
            //           echo $miResult[0]['nombre'] . ' pierde ' . $daño . ' puntos de Salud. Le quedan ' . $miSalud . '<br>';
                    }

                    if($miSalud <= 0){    
                        break;
                    }
                }
                //Caso 7: DES <20 AGI
                elseif(($rondaMonstruoDestreza - $rondaMiAgilidad) < -20 ){
              //      echo $monstruoResult[0]['nombre'] . ' cae al suelo mareado cuando intentaba perseguir a un ' . $miResult[0]['nombre'] . 'mucho más ágil. ¡Qué verguenza!<br>';

                    //Tirada de contrataque
                    $tiradaContraataque = rand(1,5);
                    if($tiradaContraataque > 4){
   //                     echo 'Situación aprovechada por ' . $miResult[0]['nombre'] . ' que lanza un contrataque mientras ' . $monstruoResult[0]['nombre'] . ' recogía sus cosas del suelo.<br>';
                        $daño = ($rondaMiFuerza - $rondaMonstruoResistencia);
                        if($daño <= 0){
                            $daño = 0;
                        }
     //                   echo 'Daño = ' . $daño . '<br>';
                        $monstruoSalud = $monstruoSalud - $daño;
                        if($daño === 0){
       //                     echo $monstruoResult[0]['nombre'] . ' esquiva el golpe. Le quedan ' . $monstruoSalud . ' puntos de salud.<br>';
                        }
                        else{
         //                   echo $monstruoResult[0]['nombre'] . ' pierde ' . $daño . ' puntos de Salud. Le quedan ' . $monstruoSalud . '<br>';
                        }

                        if($monstruoSalud <= 0){
                            break;
                        }
                    }
                }
            }               
        }
        else{ 
            if($monstruoAturdimiento > 0){
                $monstruoAturdimiento = 0;
                echo 'En esta ronda ' . $monstruoResult[0]['nombre'] . ' se está recuperando del Aturdimiento y no puede atacar.<br>';
                echo 'Turno de ' . $miResult[0]['nombre'] . '<br>';

                echo $miResult[0]['nombre'] . ' intenta golpear con una destreza de ' . $rondaMiDestreza . '<br>';
                echo $monstruoResult[0]['nombre'] . ' quiere esquivar con una agilidad de ' . $rondaMonstruoAgilidad . '<br>';
                            
                //Acciones segun la diferencia de DES VS AGI
                //Caso 1: DES >20 AGI
                if(($rondaMiDestreza - $rondaMonstruoAgilidad) > 20){
                    echo $miResult[0]['nombre'] . ' lanza un ataque sorpresa que pilla a ' . $monstruoResult[0]['nombre'] . ' totalmente desprotegido.<br>';

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
                        $monstruoAturdimiento = 1;
                        echo '¡Qué golpetazo! ' . $monstruoResult[0]['nombre'] . ' queda en Aturdimiento<br>';
                    }
                    echo 'Daño = ' . $daño . '<br>';
                    $monstruoSalud = $monstruoSalud - $daño;
                    if($daño === 0){
                        echo $monstruoResult[0]['nombre'] . ' esquiva el golpe. Le quedan ' . $monstruoSalud . ' puntos de salud.<br>';
                    }
                    else{
                        echo $monstruoResult[0]['nombre'] . ' pierde ' . $daño . ' puntos de Salud. Le quedan ' . $monstruoSalud . '<br>';
                    }

                    if($monstruoSalud <= 0){
                        break;
                    }
                }
                //Caso 2: DES >10 AGI
                elseif(($rondaMiDestreza - $rondaMonstruoAgilidad) > 10 && ($rondaMiDestreza - $rondaMonstruoAgilidad) <= 20){
                    echo $miResult[0]['nombre'] . ' carga ferozmente contra ' . $monstruoResult[0]['nombre'] . ' que apenas tiene tiempo de defenderse.<br>';

                    //Ver si ha sido Golpe Crítico
                    //BONO de gran DES vs AGI
                    $tiradaCritico = rand(1,5);
                    if($tiradaCritico < 5){
                        $daño = $rondaMiFuerza * 1.4 - $rondaMonstruoResistencia * 0.6;
                    }
                    else{
                        echo '¡Golpe Crítico!<br>';
                        $daño = $rondaMiFuerza * 1.5 * 1.4 - $rondaMonstruoResistencia * 0.6;
                    }
                    if($daño <= 0){
                        $daño = 0;
                    }
                                
                    echo 'Daño = ' . $daño . '<br>';
                    $monstruoSalud = $monstruoSalud - $daño;
                    if($daño === 0){
                        echo $monstruoResult[0]['nombre'] . ' esquiva el golpe. Le quedan ' . $monstruoSalud . ' puntos de salud.<br>';
                    }
                    else{
                        echo $monstruoResult[0]['nombre'] . ' pierde ' . $daño . ' puntos de Salud. Le quedan ' . $monstruoSalud . '<br>';
                    }

                    if($monstruoSalud <= 0){ 
                        break;
                    }
                }
                //Caso 3: DES >4 AGI
                elseif(($rondaMiDestreza - $rondaMonstruoAgilidad) > 4 && ($rondaMiDestreza - $rondaMonstruoAgilidad) <= 10){
                    echo $miResult[0]['nombre'] . ' ataca con destreza y ' . $monstruoResult[0]['nombre'] . ' se ve en apuros<br>';

                    //Ver si ha sido Golpe Crítico
                    //BONO de gran DES vs AGI
                    $tiradaCritico = rand(1,5);
                    if($tiradaCritico < 5){
                        $daño = $rondaMiFuerza * 1.2 - $rondaMonstruoResistencia * 0.8;
                    }
                    else{
                        echo '¡Golpe Crítico!<br>';
                        $daño = $rondaMiFuerza * 1.5 * 1.2 - $rondaMonstruoResistencia * 0.8;
                    }
                    if($daño <= 0){
                        $daño = 0;
                    }
                                
                    echo 'Daño = ' . $daño . '<br>';
                    $monstruoSalud = $monstruoSalud - $daño;
                    if($daño === 0){
                        echo $monstruoResult[0]['nombre'] . ' esquiva el golpe. Le quedan ' . $monstruoSalud . ' puntos de salud.<br>';
                    }
                    else{
                        echo $monstruoResult[0]['nombre'] . ' pierde ' . $daño . ' puntos de Salud. Le quedan ' . $monstruoSalud . '<br>';
                    }                                

                    if($monstruoSalud <= 0){   
                        break;
                    }
                }
                //Caso 4: DES [-4,+4] AGI
                elseif(($rondaMiDestreza - $rondaMonstruoAgilidad) > -5 && ($rondaMiDestreza - $rondaMonstruoAgilidad) < 5 ){
                    echo $miResult[0]['nombre'] . ' intenta golpear a ' . $monstruoResult[0]['nombre'] . ' que está preparado<br>';

                    //Ver si ha sido Golpe Crítico
                    $tiradaCritico = rand(1,5);
                    if($tiradaCritico < 5){
                        $daño = $rondaMiFuerza - $rondaMonstruoResistencia;
                    }
                    else{
                        echo '¡Golpe Crítico!<br>';
                        $daño = $rondaMiFuerza * 1.5 - $rondaMonstruoResistencia;
                    }
                    if($daño <= 0){
                        $daño = 0;
                    }
                    echo 'Daño = ' . $daño . '<br>';
                    $monstruoSalud = $monstruoSalud - $daño;
                    if($daño === 0){
                        echo $monstruoResult[0]['nombre'] . ' esquiva el golpe. Le quedan ' . $monstruoSalud . ' puntos de salud.<br>';
                    }
                    else{
                        echo $monstruoResult[0]['nombre'] . ' pierde ' . $daño . ' puntos de Salud. Le quedan ' . $monstruoSalud . '<br>';
                    }

                    if($monstruoSalud <= 0){ 
                        break;
                    }
                }
                //Caso 5: DES <-4 AGI
                elseif(($rondaMiDestreza - $rondaMonstruoAgilidad) >= -10 && ($rondaMiDestreza - $rondaMonstruoAgilidad) <= -5 ){
                    echo $miResult[0]['nombre'] . ' prepara un ataque poco diestro contra ' . $monstruoResult[0]['nombre'] . ' que ha leído la intención y se anticipa.<br>';

                    //Ver si ha sido Golpe Crítico
                    //Penalizacion baja DES vs AGI
                    $tiradaCritico = rand(1,5);
                    if($tiradaCritico < 5){
                        $daño = $rondaMiFuerza * 0.8 - $rondaMonstruoResistencia * 1.2;
                    }
                    else{
                        echo '¡Golpe Crítico!<br>';
                        $daño = $rondaMiFuerza * 1.5 * 0.8 - $rondaMonstruoResistencia * 1.2;
                    }
                                
                    if($daño <= 0){
                        $daño = 0;
                    }
                                
                    echo 'Daño = ' . $daño . '<br>';
                    $monstruoSalud = $monstruoSalud - $daño;
                    if($daño === 0){
                        echo $monstruoResult[0]['nombre'] . ' esquiva el golpe. Le quedan ' . $monstruoSalud . ' puntos de salud.<br>';
                    }
                    else{
                        echo $monstruoResult[0]['nombre'] . ' pierde ' . $daño . ' puntos de Salud. Le quedan ' . $monstruoSalud . '<br>';
                    }

                    if($monstruoSalud <= 0){
                        break;
                    }
                }
                //Caso 6: DES <10 AGI
                elseif(($rondaMiDestreza - $rondaMonstruoAgilidad) >= -20 && ($rondaMiDestreza - $rondaMonstruoAgilidad) < -10 ){
                    echo $miResult[0]['nombre'] . ' intenta una torpe carga contra ' . $monstruoResult[0]['nombre'] . ' que ya le espera en posición muy ventajosa.<br>';

                    //Ver si ha sido Golpe Crítico
                    //Penalizacion baja DES vs AGI
                    $tiradaCritico = rand(1,5);
                    if($tiradaCritico < 5){
                        $daño = $rondaMiFuerza * 0.6 - $rondaMonstruoResistencia * 1.4;
                    }
                    else{
                        echo '¡Golpe Crítico!<br>';
                        $daño = $rondaMiFuerza * 1.5 * 0.6 - $rondaMonstruoResistencia * 1.4;
                    }
                                
                    if($daño <= 0){
                        $daño = 0;
                    }
                                
                    echo 'Daño = ' . $daño . '<br>';
                    $monstruoSalud = $monstruoSalud - $daño;
                    if($daño === 0){
                        echo $monstruoResult[0]['nombre'] . ' esquiva el golpe. Le quedan ' . $monstruoSalud . ' puntos de salud.<br>';
                    }
                    else{
                        echo $monstruoResult[0]['nombre'] . ' pierde ' . $daño . ' puntos de Salud. Le quedan ' . $monstruoSalud . '<br>';
                    }

                    if($monstruoSalud <= 0){  
                        break;
                    }
                }
                //Caso 7: DES <20 AGI
                elseif(($rondaMiDestreza - $rondaMonstruoAgilidad) < -20 ){
                    echo $miResult[0]['nombre'] . ' cae al suelo mareado cuando intentaba perseguir a un ' . $monstruoResult[0]['nombre'] . 'mucho más ágil. ¡Qué verguenza!<br>';

                    //Tirada de contrataque
                    $tiradaContraataque = rand(1,5);
                    if($tiradaContraataque > 4){
                        echo 'Situación aprovechada por ' . $monstruoResult[0]['nombre'] . ' que lanza un contrataque mientras ' . $miResult[0]['nombre'] . ' recogía sus cosas del suelo.<br>';
                        $daño = ($rondaMonstruoFuerza - $rondaMiResistencia);
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
                echo $monstruoResult[0]['nombre'] . ' toma la iniciativa<br>';
                
                echo $monstruoResult[0]['nombre'] . ' intenta golpear con una destreza de ' . $rondaMonstruoDestreza . '<br>';
                echo $miResult[0]['nombre'] . ' quiere esquivar con una agilidad de ' . $rondaMiAgilidad . '<br>';
                //Acciones segun la diferencia de DES VS AGI
                //Caso 1: DES >20 AGI
                if(($rondaMonstruoDestreza - $rondaMiAgilidad) > 20){
                    echo $monstruoResult[0]['nombre'] . ' lanza un ataque sorpresa que pilla a ' . $miResult[0]['nombre'] . ' totalmente desprotegido.<br>';

                    //Ver si ha sido Golpe Crítico
                    //BONO de gran DES vs AGI
                    $tiradaCritico = rand(1,5);
                    if($tiradaCritico < 5){
                        $daño = $rondaMonstruoFuerza;
                    }
                    else{
                        echo '¡Golpe Crítico!<br>';
                        $daño = $rondaMonstruoFuerza * 1.5;
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
                elseif(($rondaMonstruoDestreza - $rondaMiAgilidad) > 10 && ($rondaMonstruoDestreza - $rondaMiAgilidad) <= 20){
                    echo $monstruoResult[0]['nombre'] . ' carga ferozmente contra ' . $miResult[0]['nombre'] . ' que apenas tiene tiempo de defenderse.<br>';

                    //Ver si ha sido Golpe Crítico
                    //BONO de gran DES vs AGI
                    $tiradaCritico = rand(1,5);
                    if($tiradaCritico < 5){
                        $daño = $rondaMonstruoFuerza * 1.4 - $rondaMiResistencia * 0.6;
                    }
                    else{
                        echo '¡Golpe Crítico!<br>';
                        $daño = $rondaMonstruoFuerza * 1.5 * 1.4 - $rondaMiResistencia * 0.6;
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
                elseif(($rondaMonstruoDestreza - $rondaMiAgilidad) > 4 && ($rondaMonstruoDestreza - $rondaMiAgilidad) <= 10){
                    echo $monstruoResult[0]['nombre'] . ' ataca con destreza y ' . $miResult[0]['nombre'] . ' se ve en apuros.<br>';

                    //Ver si ha sido Golpe Crítico
                    //BONO de gran DES vs AGI
                    $tiradaCritico = rand(1,5);
                    if($tiradaCritico < 5){
                        $daño = $rondaMonstruoFuerza * 1.2 - $rondaMiResistencia * 0.8;
                    }
                    else{
                        echo '¡Golpe Crítico!<br>';
                        $daño = $rondaMonstruoFuerza * 1.5 * 1.2 - $rondaMiResistencia * 0.8;
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
                elseif(($rondaMonstruoDestreza - $rondaMiAgilidad) > -5 && ($rondaMonstruoDestreza - $rondaMiAgilidad) < 5 ){
                    echo  $monstruoResult[0]['nombre'] . ' intenta golpear a ' . $miResult[0]['nombre'] . ' que está preparado<br>';

                    //Ver si ha sido Golpe Crítico
                    $tiradaCritico = rand(1,5);
                    if($tiradaCritico < 5){
                        $daño = $rondaMonstruoFuerza - $rondaMiResistencia;
                    }
                    else{
                        echo '¡Golpe Crítico!<br>';
                        $daño = $rondaMonstruoFuerza * 1.5 - $rondaMiResistencia;
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
                elseif(($rondaMonstruoDestreza - $rondaMiAgilidad) >= -10 && ($rondaMonstruoDestreza - $rondaMiAgilidad) <= -5 ){
                    echo $monstruoResult[0]['nombre'] . ' prepara un ataque poco diestro contra ' . $miResult[0]['nombre'] . ' que ha leído la intención y se anticipa<br>';

                    //Ver si ha sido Golpe Crítico
                    //Penalizacion baja DES vs AGI
                    $tiradaCritico = rand(1,5);
                    if($tiradaCritico < 5){
                        $daño = $rondaMonstruoFuerza * 0.8 - $rondaMiResistencia * 1.2;
                    }
                    else{
                        echo '¡Golpe Crítico!<br>';
                        $daño = $rondaMonstruoFuerza * 1.5 * 0.8 - $rondaMiResistencia * 1.2;
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
                elseif(($rondaMonstruoDestreza - $rondaMiAgilidad) >= -20 && ($rondaMonstruoDestreza - $rondaMiAgilidad) < -10 ){
                    echo $monstruoResult[0]['nombre'] . ' intenta una torpe carga contra ' . $miResult[0]['nombre'] . ' que ya le espera en posición muy ventajosa<br>';

                    //Ver si ha sido Golpe Crítico
                    //Penalizacion baja DES vs AGI
                    $tiradaCritico = rand(1,5);
                    if($tiradaCritico < 5){
                        $daño = $rondaMonstruoFuerza * 0.6 - $rondaMiResistencia * 1.4;
                    }
                    else{
                        echo '¡Golpe Crítico!<br>';
                        $daño = $rondaMonstruoFuerza * 1.5 * 0.6 - $rondaMiResistencia * 1.4;
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
                elseif(($rondaMonstruoDestreza - $rondaMiAgilidad) < -20 ){
                    echo $monstruoResult[0]['nombre'] . ' cae al suelo mareado cuando intentaba perseguir a un ' . $miResult[0]['nombre'] . 'mucho más ágil. ¡Qué verguenza!<br>';

                    //Tirada de contrataque
                    $tiradaContraataque = rand(1,5);
                    if($tiradaContraataque > 4){
                        echo 'Situación aprovechada por ' . $miResult[0]['nombre'] . ' que lanza un contrataque mientras ' . $monstruoResult[0]['nombre'] . ' recogía sus cosas del suelo.<br>';
                        $daño = ($rondaMiFuerza - $rondaMonstruoResistencia);
                        if($daño <= 0){
                            $daño = 0;
                        }
                        echo 'Daño = ' . $daño . '<br>';
                        $monstruoSalud = $monstruoSalud - $daño;
                        if($daño === 0){
                            echo $monstruoResult[0]['nombre'] . ' esquiva el golpe. Le quedan ' . $monstruoSalud . ' puntos de salud.<br>';
                        }
                        else{
                            echo $monstruoResult[0]['nombre'] . ' pierde ' . $daño . ' puntos de Salud. Le quedan ' . $monstruoSalud . '<br>';
                        }

                        if($monstruoSalud <= 0){
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
                    echo $monstruoResult[0]['nombre'] . ' quiere esquivar con una agilidad de ' . $rondaMonstruoAgilidad . '<br>';

                    //Acciones segun la diferencia de DES VS AGI
                    //Caso 1: DES >20 AGI
                    if(($rondaMiDestreza - $rondaMonstruoAgilidad) > 20){
                        echo $miResult[0]['nombre'] . ' lanza un ataque sorpresa que pilla a ' . $monstruoResult[0]['nombre'] . ' totalmente desprotegido.<br>';

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
                            $monstruoAturdimiento = 1;
                            echo '¡Qué golpetazo! ' . $monstruoResult[0]['nombre'] . ' queda en Aturdimiento<br>';
                        }
                        echo 'Daño = ' . $daño . '<br>';
                        $monstruoSalud = $monstruoSalud - $daño;
                        if($daño === 0){
                            echo $monstruoResult[0]['nombre'] . ' esquiva el golpe. Le quedan ' . $monstruoSalud . ' puntos de salud.<br>';
                        }
                        else{
                            echo $monstruoResult[0]['nombre'] . ' pierde ' . $daño . ' puntos de Salud. Le quedan ' . $monstruoSalud . '<br>';
                        }

                        if($monstruoSalud <= 0){
                            break;
                        }
                    }
                    //Caso 2: DES >10 AGI
                    elseif(($rondaMiDestreza - $rondaMonstruoAgilidad) > 10 && ($rondaMiDestreza - $rondaMonstruoAgilidad) <= 20){
                        echo $miResult[0]['nombre'] . ' carga ferozmente contra ' . $monstruoResult[0]['nombre'] . ' que apenas tiene tiempo de defenderse.<br>';

                        //Ver si ha sido Golpe Crítico
                        //BONO de gran DES vs AGI
                        $tiradaCritico = rand(1,5);
                        if($tiradaCritico < 5){
                            $daño = $rondaMiFuerza * 1.4 - $rondaMonstruoResistencia * 0.6;
                        }
                        else{
                            echo '¡Golpe Crítico!<br>';
                            $daño = $rondaMiFuerza * 1.5 * 1.4 - $rondaMonstruoResistencia * 0.6;
                        }
                        if($daño <= 0){
                            $daño = 0;
                        }

                        echo 'Daño = ' . $daño . '<br>';
                        $monstruoSalud = $monstruoSalud - $daño;
                        if($daño === 0){
                            echo $monstruoResult[0]['nombre'] . ' esquiva el golpe. Le quedan ' . $monstruoSalud . ' puntos de salud.<br>';
                        }
                        else{
                            echo $monstruoResult[0]['nombre'] . ' pierde ' . $daño . ' puntos de Salud. Le quedan ' . $monstruoSalud . '<br>';
                        }

                        if($monstruoSalud <= 0){ 
                            break;
                        }
                    }
                    //Caso 3: DES >4 AGI
                    elseif(($rondaMiDestreza - $rondaMonstruoAgilidad) > 4 && ($rondaMiDestreza - $rondaMonstruoAgilidad) <= 10){
                        echo $miResult[0]['nombre'] . ' ataca con destreza y ' . $monstruoResult[0]['nombre'] . ' se ve en apuros<br>';

                        //Ver si ha sido Golpe Crítico
                        //BONO de gran DES vs AGI
                        $tiradaCritico = rand(1,5);
                        if($tiradaCritico < 5){
                            $daño = $rondaMiFuerza * 1.2 - $rondaMonstruoResistencia * 0.8;
                        }
                        else{
                            echo '¡Golpe Crítico!<br>';
                            $daño = $rondaMiFuerza * 1.5 * 1.2 - $rondaMonstruoResistencia * 0.8;
                        }
                        if($daño <= 0){
                            $daño = 0;
                        }

                        echo 'Daño = ' . $daño . '<br>';
                        $monstruoSalud = $monstruoSalud - $daño;
                        if($daño === 0){
                            echo $monstruoResult[0]['nombre'] . ' esquiva el golpe. Le quedan ' . $monstruoSalud . ' puntos de salud.<br>';
                        }
                        else{
                            echo $monstruoResult[0]['nombre'] . ' pierde ' . $daño . ' puntos de Salud. Le quedan ' . $monstruoSalud . '<br>';
                        }                                

                        if($monstruoSalud <= 0){   
                            break;
                        }
                    }
                    //Caso 4: DES [-4,+4] AGI
                    elseif(($rondaMiDestreza - $rondaMonstruoAgilidad) > -5 && ($rondaMiDestreza - $rondaMonstruoAgilidad) < 5 ){
                        echo $miResult[0]['nombre'] . ' intenta golpear a ' . $monstruoResult[0]['nombre'] . ' que está preparado<br>';

                        //Ver si ha sido Golpe Crítico
                        $tiradaCritico = rand(1,5);
                        if($tiradaCritico < 5){
                            $daño = $rondaMiFuerza - $rondaMonstruoResistencia;
                        }
                        else{
                            echo '¡Golpe Crítico!<br>';
                            $daño = $rondaMiFuerza * 1.5 - $rondaMonstruoResistencia;
                        }
                        if($daño <= 0){
                            $daño = 0;
                        }
                        echo 'Daño = ' . $daño . '<br>';
                        $monstruoSalud = $monstruoSalud - $daño;
                        if($daño === 0){
                            echo $monstruoResult[0]['nombre'] . ' esquiva el golpe. Le quedan ' . $monstruoSalud . ' puntos de salud.<br>';
                        }
                        else{
                            echo $monstruoResult[0]['nombre'] . ' pierde ' . $daño . ' puntos de Salud. Le quedan ' . $monstruoSalud . '<br>';
                        }

                        if($monstruoSalud <= 0){ 
                            break;
                        }
                    }
                    //Caso 5: DES <-4 AGI
                    elseif(($rondaMiDestreza - $rondaMonstruoAgilidad) >= -10 && ($rondaMiDestreza - $rondaMonstruoAgilidad) <= -5 ){
                        echo $miResult[0]['nombre'] . ' prepara un ataque poco diestro contra ' . $monstruoResult[0]['nombre'] . ' que ha leído la intención y se anticipa.<br>';

                        //Ver si ha sido Golpe Crítico
                        //Penalizacion baja DES vs AGI
                        $tiradaCritico = rand(1,5);
                        if($tiradaCritico < 5){
                            $daño = $rondaMiFuerza * 0.8 - $rondaMonstruoResistencia * 1.2;
                        }
                        else{
                            echo '¡Golpe Crítico!<br>';
                            $daño = $rondaMiFuerza * 1.5 * 0.8 - $rondaMonstruoResistencia * 1.2;
                        }

                        if($daño <= 0){
                            $daño = 0;
                        }

                        echo 'Daño = ' . $daño . '<br>';
                        $monstruoSalud = $monstruoSalud - $daño;
                        if($daño === 0){
                            echo $monstruoResult[0]['nombre'] . ' esquiva el golpe. Le quedan ' . $monstruoSalud . ' puntos de salud.<br>';
                        }
                        else{
                            echo $monstruoResult[0]['nombre'] . ' pierde ' . $daño . ' puntos de Salud. Le quedan ' . $monstruoSalud . '<br>';
                        }

                        if($monstruoSalud <= 0){
                            break;
                        }
                    }
                    //Caso 6: DES <10 AGI
                    elseif(($rondaMiDestreza - $rondaMonstruoAgilidad) >= -20 && ($rondaMiDestreza - $rondaMonstruoAgilidad) < -10 ){
                        echo $miResult[0]['nombre'] . ' intenta una torpe carga contra ' . $monstruoResult[0]['nombre'] . ' que ya le espera en posición muy ventajosa.<br>';

                        //Ver si ha sido Golpe Crítico
                        //Penalizacion baja DES vs AGI
                        $tiradaCritico = rand(1,5);
                        if($tiradaCritico < 5){
                            $daño = $rondaMiFuerza * 0.6 - $rondaMonstruoResistencia * 1.4;
                        }
                        else{
                            echo '¡Golpe Crítico!<br>';
                            $daño = $rondaMiFuerza * 1.5 * 0.6 - $rondaMonstruoResistencia * 1.4;
                        }

                        if($daño <= 0){
                            $daño = 0;
                        }

                        echo 'Daño = ' . $daño . '<br>';
                        $monstruoSalud = $monstruoSalud - $daño;
                        if($daño === 0){
                            echo $monstruoResult[0]['nombre'] . ' esquiva el golpe. Le quedan ' . $monstruoSalud . ' puntos de salud.<br>';
                        }
                        else{
                            echo $monstruoResult[0]['nombre'] . ' pierde ' . $daño . ' puntos de Salud. Le quedan ' . $monstruoSalud . '<br>';
                        }

                        if($monstruoSalud <= 0){  
                            break;
                        }
                    }
                    //Caso 7: DES <20 AGI
                    elseif(($rondaMiDestreza - $rondaMonstruoAgilidad) < -20 ){
                        echo $miResult[0]['nombre'] . ' cae al suelo mareado cuando intentaba perseguir a un ' . $monstruoResult[0]['nombre'] . 'mucho más ágil. ¡Qué verguenza!<br>';

                        //Tirada de contrataque
                        $tiradaContraataque = rand(1,5);
                        if($tiradaContraataque > 4){
                            echo 'Situación aprovechada por ' . $monstruoResult[0]['nombre'] . ' que lanza un contrataque mientras ' . $miResult[0]['nombre'] . ' recogía sus cosas del suelo.<br>';
                            $daño = ($rondaMonstruoFuerza - $rondaMiResistencia);
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
        echo '(' . $monstruoResult[0]['nombre'] . ' ' . $monstruoSalud . ' //// ' . $miResult[0]['nombre'] . ' ' . $miSalud . ')<br><br>';
                    
    }
                
    $misPuntos = $monstruoResult[0]['salud'] - $monstruoSalud;
    $monstruoPuntos = $miResult[0]['salud'] - $miSalud;
    echo $miResult[0]['nombre'] . ' ha provocado ' . $misPuntos . ' puntos de daño a ' . $monstruoResult[0]['nombre'] . '<br>';
    echo $monstruoResult[0]['nombre'] . ' ha provocado ' . $monstruoPuntos . ' puntos de daño a ' . $miResult[0]['nombre'] . '<br>';

    //Actualizar Salud del jugador post-batalla
    $actualizarSalud = "UPDATE personajes SET salud = CASE WHEN $miSalud < 0 THEN 0 ELSE $miSalud END WHERE id='$miId'";
    $db->query($actualizarSalud);
            
    if($miSalud <= 0){
        $resultadoBatalla = pierdes($miId, $monstruoResult);
    }
    elseif($monstruoSalud <= 0){
        $resultadoBatalla = ganas($miId, $monstruoResult);
    }   

    elseif($misPuntos > $monstruoPuntos){
        $resultadoBatalla = ganas($miId, $monstruoResult);
    }
    elseif($misPuntos <= $monstruoPuntos){
        $resultadoBatalla = pierdes($miId, $monstruoResult);
    }

    return $resultadoBatalla;
}   
                
function ganas($miId,$monstruoResult){
        global $db;
        $expGanada = rand($monstruoResult[0]['nivel'] * 10, $monstruoResult[0]['nivel'] * 20);
        $sql = "UPDATE personajes SET experiencia = personajes.experiencia + '$expGanada' WHERE id='$miId'";
        $db->query($sql);
        
        return $expGanada;
}

function pierdes($miId, $monstruoResult){
        global $db;
        
        $expGanada = 0;
        
        return $expGanada;
}


function getMonstruoRow($idMonstruo){
    global $db;
    $sql = "SELECT * FROM monstruos WHERE idM=?";
    $stmt = $db->prepare($sql);
    $stmt->execute(array($idMonstruo));
    return $stmt->fetchAll();       
}

function comprobarSuboNivel($miId){
    global $db;
    $sql = "SELECT nivel, experiencia FROM personajes WHERE id='$miId'";
    $stmt = $db->query($sql);
    $personaje = $stmt->fetchAll();
    $nuevoNivel = floor(1 + (0.1 * sqrt($personaje[0]['experiencia'])));
    return $nuevoNivel;
}

if($_GET['action'] === "zona"){
    zona($_POST['cbox1']);
}

?>