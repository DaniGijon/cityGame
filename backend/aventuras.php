<?php

function zona($box){
    include (__ROOT__.'/backend/comprobaciones.php');
    include (__ROOT__.'/backend/tiradas.php');
    include (__ROOT__.'/backend/fightFunctions.php');
    global $db;
    $id = $_SESSION['loggedIn'];
    
    
    switch($box){
        //Caso especial: PESCAR
        case 'pescar':
            $agotamiento = 3;
            $puedoHacerlo = comprobarEnergia($agotamiento);
            $tengoCana = comprobarCana();
            if($puedoHacerlo === 1 && $tengoCana === 1){ 
                //Voy a pescar algo y voy a notificarselo
                $pesca = rand(1, 30);
                if($pesca <= 18){
                    //No pican
                    //Genero un informe de Pesca
                    $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$id','Pesca','No pican...','pescar.png')";
                    $db->query($sql);
                }
                if($pesca > 18 && $pesca <= 25){
                    //pescado crudo
                    //Miro que tenga algun slot libre en el inventario
                    $slotDondeGuardo = comprobarSlotLibre();
                    if($slotDondeGuardo === -1){
                        $mensajeObjeto = " Lo devolveré al agua, porque mi inventario está lleno.";
                    }
                    else{
                        $mensajeObjeto = ' ¡Meeee lo llevo! \n\nObtengo 1x Pescado Crudo';
                        //AÑADIR AL INVENTARIO
                        $sql = "UPDATE inventario SET idO = '933' WHERE idP='$id' AND slot = '$slotDondeGuardo'";
                        $db->query($sql);
                    }
                    //Genero un informe de Pesca
                    $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$id','Pesca','¡EEEH! Han mordido el anzuelo, ¡cacho pez cómo tira! $mensajeObjeto','pescar.png')";
                    $db->query($sql);
                }
                if($pesca > 25 && $pesca <= 27){
                    //monedas
                     //Genero un informe de Pescar
                    $cantidad = rand(20,80);
                    $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$id','Pescar','¡Anda! Al recoger sedal vienen unas monedas enganchadas al anzuelo. ¿Será que hay un tesoro hundido ahí abajo? Obtengo $cantidad monedas.','rebuscar.png')";
                    $db->query($sql);
                    
                    $sql = "UPDATE personajes SET cash = cash + $cantidad WHERE id='$id'";
                    $db->query($sql);
                }
                if($pesca > 27 && $pesca <= 29){
                    //cofre
                    //Miro que tenga algun slot libre en el inventario
                    $slotDondeGuardo = comprobarSlotLibre();
                    if($slotDondeGuardo === -1){
                        $mensajeObjeto = " Lo devolveré al agua, porque mi inventario está lleno.";
                    }
                    else{
                        $idCofre = rand(900, 909);
                        if ($idCofre == 900)
                            $mensajeObjeto = ' ¡Puaj! es una caja cubierta de algas y óxido.  \n\nObtengo 1x Cajita oxidada';
                        elseif ($idCofre == 901)
                            $mensajeObjeto = ' ¡Qué asco! alguien ha tirado una caja aquí y se ha estado pudriendo.  \n\nObtengo 1x Caja pequeña de madera';
                        elseif ($idCofre == 902)
                            $mensajeObjeto = ' ¡Mmeh! Una cajita. Se le habrá caído a alguien.  \n\nObtengo 1x Caja pequeña de metal';
                        elseif ($idCofre == 903)
                            $mensajeObjeto = ' ¡Oye! es un pequeño cofre, está muy deteriorado.  \n\nObtengo 1x Cofre pequeño oxidado';
                        elseif ($idCofre == 904)
                            $mensajeObjeto = ' ¡Oh! la madera está algo podrida pero es un cofre, y su interior parece intacto.  \n\nObtengo 1x Cofre pequeño de madera';
                        elseif ($idCofre == 905)
                            $mensajeObjeto = ' ¡Anda! es un pequeño cofre, y pesa lo suyo.  \n\nObtengo 1x Cofre pequeño de metal';
                        elseif ($idCofre == 906)
                            $mensajeObjeto = ' ¡Eh! es un cofre grande, tan grande como sus marcas de óxido.  \n\nObtengo 1x Cofre grande oxidado';
                        elseif ($idCofre == 907)
                            $mensajeObjeto = ' Un momento... no son restos de una balsa, ¡es una especie de baúl!  \n\nObtengo 1x Cofre grande de madera';
                        elseif ($idCofre == 908)
                            $mensajeObjeto = ' ¡Mira eso! puede que sea el tesoro de algún pirata.  \n\nObtengo 1x Cofre grande de metal';
                        elseif ($idCofre == 909)
                            $mensajeObjeto = ' ¡Cómo brilla!... Es un baúl adornado con pedrulos y todo. ¡Eso debe valer una pasta!  \n\nObtengo 1x Cofre de piedras preciosas';
                        //AÑADIR AL INVENTARIO
                        $sql = "UPDATE inventario SET idO = '$idCofre' WHERE idP='$id' AND slot = '$slotDondeGuardo'";
                        $db->query($sql);
                    }
                    //Genero un informe de Pesca
                    $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$id','Pesca','Algo se ha enganchado al anzuelo. $mensajeObjeto','pescar.png')";
                    $db->query($sql);
                }
                if($pesca == 30){
                    //Tenacitas
                    //Miro que tenga algun slot libre en el inventario
                    $slotDondeGuardo = comprobarSlotLibre();
                    if($slotDondeGuardo === -1){
                        $mensajeObjeto = " Lo devolveré al agua, porque mi inventario está lleno.";
                    }
                    else{
                        $mensajeObjeto = ' ¡Hola Teniii! \n\nObtengo 1x Tenacitas';
                        //AÑADIR AL INVENTARIO
                        $sql = "UPDATE inventario SET idO = '7' WHERE idP='$id' AND slot = '$slotDondeGuardo'";
                        $db->query($sql);
                    }
                    //Genero un informe de Pesca
                    $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$id','Pesca','¡AYYY! Han mordido el anzuelo y sea lo que sea ¡está gordísimo!... $mensajeObjeto','pescar.png')";
                    $db->query($sql);
                }
                //Restar la energia necesaria para pescar y ponerle tiempo accion
                $sql = "UPDATE personajes SET energia = energia-$agotamiento, accion = ADDTIME(NOW(), '0:01:0') WHERE id='$id'";
                $stmt = $db->query($sql);
            }
            else{
                $box = "Necesito una Caña para pescar y un poco de energía para tirar con fuerza.";
                $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$id','Pesca','$box','pescar.png')";
                $db->query($sql);
                $box = "pescar";
            }
            break;
        
        
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
                    
                    //Foto del monstruo
                    $imagenMonstruo = $monstruo[0]['imagenMonstruo'];

                    // Atacar al monstruo
                    $idMonstruo = $monstruo[0]['idM'];
                    $premio= atacarMonstruo($idMonstruo);
                    
                    if($premio > 0){
                        //AÑADO EL MONSTRUO DERROTADO AL ALBUM
                        $sql = "INSERT INTO victorias (idP,idM,cantidad) VALUES ('$id','$idMonstruo',1) ON DUPLICATE KEY UPDATE cantidad=cantidad+1;";
                        $db->query($sql);
                        
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
                            $mensajeObjeto = " Le arrebato un objeto que llevaba consigo: ";
                            $nivelMAXObjeto = $monstruo[0]['nivel'];
                            $sql = "SELECT * FROM objetos WHERE nivelMin > 0 AND nivelMin <= '$nivelMAXObjeto'";
                            $stmt = $db->query($sql);
                            $obj = $stmt->fetchAll();
                            $cantidadObjetosCandidatos = count($obj); 
                            $objetoObtenido = rand(0, $cantidadObjetosCandidatos-1);
                            $mensajeObjeto = $mensajeObjeto . $obj[$objetoObtenido]['nombre'];
                            
                            //Miro que tenga algun slot libre en el inventario
                            $slotDondeGuardo = comprobarSlotLibre();
                            if($slotDondeGuardo === -1){
                                $mensajeObjeto = $mensajeObjeto . ". No puedo llevarme el botín porque mi inventario está lleno.";
                            }
                            else{
                                //AÑADIR AL INVENTARIO
                                $idObjetoObtenido = $obj[$objetoObtenido]['id'];
                                $sql = "UPDATE inventario SET idO = '$idObjetoObtenido' WHERE idP='$id' AND slot = '$slotDondeGuardo'";
                                $db->query($sql);
                                
                                
                                //AÑADIR AL ALBUM DE COLECCIONISMO SI ES UN AVION
                                if($idObjetoObtenido >= '1000'){
                                    $sql = "INSERT INTO coleccionismo (idP,idO,imagen) VALUES('$id','$idObjetoObtenido','$idObjetoObtenido.png')";
                                    $db->query($sql);
                                }
                                else{
                                    //AÑADIR AL ALBUM DE COLECCIONISMO SI ES UNA RELIQUIA
                                    $sql = "SELECT * FROM objetos WHERE id='$idObjetoObtenido'";
                                    $stmt = $db->query($sql);
                                    $res = $stmt->fetchAll();
                                    
                                    $esReliquia = $res[0]['reliquia'];
                                    if($esReliquia === '1'){
                                        $sql = "INSERT INTO coleccionismo (idP,idO,imagen) VALUES('$id','$idObjetoObtenido','$idObjetoObtenido.png')";
                                        $db->query($sql);
                                        
                                        //Generar un mensaje de Informe de reliquia
                                        $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$id','Reliquia Encontrada','Al derrotar a ese monstruo notas un pequeño brillo debajo de su cuerpo. Te acercas para observar mejor... <br>¡Encuentras $nombreObjetoObtenido! Toda una Reliquia.','reliquiaEncontrada.png')";
                                        $db->query($sql);
                                    }
                                }
                            }
                        }
                        else{
                            $mensajeObjeto = '';
                        }
                        
                        //Comprobar si subo de nivel
                        global $db;
                        $mensajeNivel = '';
                        $sql = "SELECT nivel FROM personajes WHERE id='$id'";
                        $stmt = $db->query($sql);
                        $personaje = $stmt->fetchAll();
                        $nuevoNivel = comprobarSuboNivel($id);
                        if($nuevoNivel != $personaje[0]['nivel'] ){
                            $avances = 5;
                            //Mirar si lleva algun objeto con la especialidad AVANCE EXTRA
                            $sql = "SELECT objetos.* FROM inventario JOIN objetos ON inventario.idO = objetos.id WHERE inventario.idP = '$id' AND inventario.slot <= 7";
                            $stmt = $db->query($sql);
                            $objetosEquipados = $stmt->fetchAll();

                            foreach ($objetosEquipados as $cadaObjeto) {
                                if($cadaObjeto['especial']==='avance extra'){
                                    $avances = $avances + 1;
                                }   
                            }
                            
                            $sql = "UPDATE personajes SET nivel = personajes.nivel+1, avances = personajes.avances + $avances WHERE id='$id'";
                            $db->query($sql);
                            $mensajeNivel = " SUBO DE NIVEL<br>";
                            //Generar mensaje del informe de la subida de nivel
                            $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$id','Subiste de Nivel','¡Enhorabuena! Acabas de subir a Nivel $nuevoNivel. <br> Obtienes $avances Avances para mejorar habilidades en la ventana de Personaje.','subirNivel.png')";
                            $db->query($sql);
                            
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
                        //Si me quedo con la vida a cero, me viene la ambulancia     
                        $sql = "UPDATE personajes SET accion = ADDTIME(NOW(), '0:30:0') WHERE id='$id'";
                        $db->query($sql);
                        $celebracion = "¡Qué dolor! Por suerte la ambulancia estaba cerca. Estaré 30 Minutos en observación hasta que sanen mis heridas. <br>";
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
                header("location: ?page=accion&message=$box");
                exit;
            }
            break;
            
            case 'aventuraLosPinosDebil':
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
                    $monstruo = cualMonstruoDebil($zona,$barrio);
                    $box = $monstruo[0]['nombre'];
                    
                    //Foto del monstruo
                    $imagenMonstruo = $monstruo[0]['imagenMonstruo'];
                    
                    // Atacar al monstruo
                    $idMonstruo = $monstruo[0]['idM'];
                    $premio= atacarMonstruo($idMonstruo);
                    
                    if($premio > 0){
                        //AÑADO EL MONSTRUO DERROTADO AL ALBUM
                        $sql = "INSERT INTO victorias (idP,idM,cantidad) VALUES ('$id','$idMonstruo',1) ON DUPLICATE KEY UPDATE cantidad=cantidad+1;";
                        $db->query($sql);
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
                            $mensajeObjeto = " Le arrebato un objeto que llevaba consigo: ";
                            $nivelMAXObjeto = $monstruo[0]['nivel'];
                            $sql = "SELECT * FROM objetos WHERE nivelMin > 0 AND nivelMin <= '$nivelMAXObjeto'";
                            $stmt = $db->query($sql);
                            $obj = $stmt->fetchAll();
                            $cantidadObjetosCandidatos = count($obj); 
                            $objetoObtenido = rand(0, $cantidadObjetosCandidatos-1);
                            $nombreObjetoObtenido = $obj[$objetoObtenido]['nombre'];
                            $mensajeObjeto = $mensajeObjeto . $nombreObjetoObtenido;
                            
                            //Miro que tenga algun slot libre en el inventario
                            $slotDondeGuardo = comprobarSlotLibre();
                            if($slotDondeGuardo === -1){
                                $mensajeObjeto = $mensajeObjeto . ". No puedo llevarme el botín porque mi inventario está lleno.";
                            }
                             else{
                                //AÑADIR AL INVENTARIO
                                $idObjetoObtenido = $obj[$objetoObtenido]['id'];
                                $sql = "UPDATE inventario SET idO = '$idObjetoObtenido' WHERE idP='$id' AND slot = '$slotDondeGuardo'";
                                $db->query($sql);
                                
                                
                                //AÑADIR AL ALBUM DE COLECCIONISMO SI ES UN AVION
                                if($idObjetoObtenido >= '1000'){
                                    $sql = "INSERT INTO coleccionismo (idP,idO,imagen) VALUES('$id','$idObjetoObtenido','$idObjetoObtenido.png')";
                                    $db->query($sql);
                                }
                                else{
                                    //AÑADIR AL ALBUM DE COLECCIONISMO SI ES UNA RELIQUIA
                                    $sql = "SELECT * FROM objetos WHERE id='$idObjetoObtenido'";
                                    $stmt = $db->query($sql);
                                    $res = $stmt->fetchAll();
                                    
                                    $esReliquia = $res[0]['reliquia'];
                                    if($esReliquia === '1'){
                                        //Añadir al Album Coleccionismo
                                        $sql = "INSERT INTO coleccionismo (idP,idO,imagen) VALUES('$id','$idObjetoObtenido','$idObjetoObtenido.png')";
                                        $db->query($sql);
                                        
                                        //Generar un mensaje de Informe de reliquia
                                        $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$id','Reliquia Encontrada','Al derrotar a ese monstruo notas un pequeño brillo debajo de su cuerpo. Te acercas para observar mejor... <br>¡Encuentras $nombreObjetoObtenido! Toda una Reliquia.','reliquiaEncontrada.png')";
                                        $db->query($sql);
                                    }
                                }
                            }
                        }
                        else{
                            $mensajeObjeto = '';
                        }
                        
                        //Comprobar si subo de nivel
                        global $db;
                        $mensajeNivel = '';
                        $sql = "SELECT nivel FROM personajes WHERE id='$id'";
                        $stmt = $db->query($sql);
                        $personaje = $stmt->fetchAll();
                        $nuevoNivel = comprobarSuboNivel($id);
                        if($nuevoNivel != $personaje[0]['nivel'] ){
                            $avances = 5;
                            //Mirar si lleva algun objeto con la especialidad avance extra
                            $sql = "SELECT objetos.* FROM inventario JOIN objetos ON inventario.idO = objetos.id WHERE inventario.idP = '$id' AND inventario.slot <= 7";
                            $stmt = $db->query($sql);
                            $objetosEquipados = $stmt->fetchAll();

                            foreach ($objetosEquipados as $cadaObjeto) {
                                if($cadaObjeto['especial']==='avance extra'){
                                    $avances = $avances + 1;
                                }   
                            }
                            
                            $sql = "UPDATE personajes SET nivel = personajes.nivel+1, avances = personajes.avances + $avances WHERE id='$id'";
                            $db->query($sql);
                            
                            $mensajeNivel = " SUBO DE NIVEL<br>";
                            
                            //Generar mensaje del informe de la subida de nivel
                            $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$id','Subiste de Nivel','¡Enhorabuena! Acabas de subir a Nivel $nuevoNivel. <br> Obtienes $avances Avances para mejorar habilidades en la ventana de Personaje.','subirNivel.png')";
                            $db->query($sql);
                            
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
                        //Si me quedo con la vida a cero, me viene la ambulancia     
                        $sql = "UPDATE personajes SET accion = ADDTIME(NOW(), '0:30:0') WHERE id='$id'";
                        $db->query($sql);
                        $celebracion = "¡Qué dolor! Enseguida llega la ambulancia a auxiliarme, pero tardarán 30 Minutos en darme el alta <br>";
                        }
                    }
                    
                    $box = "Me enfrento a un " . $box . " ... " . $celebracion;
                }
                else{
                    
                    $box = "Qué agradable paseo! No me ha atacado ningún monstruo.";
                }
            }
            else{
                $box = "¡Ay! No puedo con mi cuerpo ahora mismo";
                header("location: ?page=accion&message=$box");
                exit;
            }
            break;
        //AVENTURA TERRI
        case 'aventuraTerri':
            $zona = 2;
            $barrio = 1;
            $agotamiento = 30;
            $probabilidadEncontrar = rand(1, 40);
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
                    
                    //Foto del monstruo
                    $imagenMonstruo = $monstruo[0]['imagenMonstruo'];

                    // Atacar al monstruo
                    $idMonstruo = $monstruo[0]['idM'];
                    $premio= atacarMonstruo($idMonstruo);
                    
                    if($premio > 0){
                        //AÑADO EL MONSTRUO DERROTADO AL ALBUM
                        $sql = "INSERT INTO victorias (idP,idM,cantidad) VALUES ('$id','$idMonstruo',1) ON DUPLICATE KEY UPDATE cantidad=cantidad+1;";
                        $db->query($sql);
                        
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
                            $mensajeObjeto = " Le arrebato un objeto que llevaba consigo: ";
                            $nivelMAXObjeto = $monstruo[0]['nivel'];
                            $sql = "SELECT * FROM objetos WHERE nivelMin > 0 AND nivelMin <= '$nivelMAXObjeto'";
                            $stmt = $db->query($sql);
                            $obj = $stmt->fetchAll();
                            $cantidadObjetosCandidatos = count($obj); 
                            $objetoObtenido = rand(0, $cantidadObjetosCandidatos-1);
                            $mensajeObjeto = $mensajeObjeto . $obj[$objetoObtenido]['nombre'];
                            
                            //Miro que tenga algun slot libre en el inventario
                            $slotDondeGuardo = comprobarSlotLibre();
                            if($slotDondeGuardo === -1){
                                $mensajeObjeto = $mensajeObjeto . ". No puedo llevarme el botín porque mi inventario está lleno.";
                            }
                            else{
                                //AÑADIR AL INVENTARIO
                                $idObjetoObtenido = $obj[$objetoObtenido]['id'];
                                $sql = "UPDATE inventario SET idO = '$idObjetoObtenido' WHERE idP='$id' AND slot = '$slotDondeGuardo'";
                                $db->query($sql);
                                
                                
                                //AÑADIR AL ALBUM DE COLECCIONISMO SI ES UN AVION
                                if($idObjetoObtenido >= '1000'){
                                    $sql = "INSERT INTO coleccionismo (idP,idO,imagen) VALUES('$id','$idObjetoObtenido','$idObjetoObtenido.png')";
                                    $db->query($sql);
                                }
                                else{
                                    //AÑADIR AL ALBUM DE COLECCIONISMO SI ES UNA RELIQUIA
                                    $sql = "SELECT * FROM objetos WHERE id='$idObjetoObtenido'";
                                    $stmt = $db->query($sql);
                                    $res = $stmt->fetchAll();
                                    
                                    $esReliquia = $res[0]['reliquia'];
                                    if($esReliquia === '1'){
                                        $sql = "INSERT INTO coleccionismo (idP,idO,imagen) VALUES('$id','$idObjetoObtenido','$idObjetoObtenido.png')";
                                        $db->query($sql);
                                        
                                        //Generar un mensaje de Informe de reliquia
                                        $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$id','Reliquia Encontrada','Al derrotar a ese monstruo notas un pequeño brillo debajo de su cuerpo. Te acercas para observar mejor... <br>¡Encuentras $nombreObjetoObtenido! Toda una Reliquia.','reliquiaEncontrada.png')";
                                        $db->query($sql);
                                    }
                                }
                            }
                        }
                        else{
                            $mensajeObjeto = '';
                        }
                        
                        //Comprobar si subo de nivel
                        global $db;
                        $mensajeNivel = '';
                        $sql = "SELECT nivel FROM personajes WHERE id='$id'";
                        $stmt = $db->query($sql);
                        $personaje = $stmt->fetchAll();
                        $nuevoNivel = comprobarSuboNivel($id);
                        if($nuevoNivel != $personaje[0]['nivel'] ){
                            $avances = 5;
                            //Mirar si lleva algun objeto con la especialidad AVANCE EXTRA
                            $sql = "SELECT objetos.* FROM inventario JOIN objetos ON inventario.idO = objetos.id WHERE inventario.idP = '$id' AND inventario.slot <= 7";
                            $stmt = $db->query($sql);
                            $objetosEquipados = $stmt->fetchAll();

                            foreach ($objetosEquipados as $cadaObjeto) {
                                if($cadaObjeto['especial']==='avance extra'){
                                    $avances = $avances + 1;
                                }   
                            }
                            
                            $sql = "UPDATE personajes SET nivel = personajes.nivel+1, avances = personajes.avances + $avances WHERE id='$id'";
                            $db->query($sql);
                            $mensajeNivel = " SUBO DE NIVEL<br>";
                            //Generar mensaje del informe de la subida de nivel
                            $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$id','Subiste de Nivel','¡Enhorabuena! Acabas de subir a Nivel $nuevoNivel. <br> Obtienes $avances Avances para mejorar habilidades en la ventana de Personaje.','subirNivel.png')";
                            $db->query($sql);
                            
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
                        //Si me quedo con la vida a cero, me viene la ambulancia     
                        $sql = "UPDATE personajes SET accion = ADDTIME(NOW(), '0:30:0') WHERE id='$id'";
                        $db->query($sql);
                        $celebracion = "¡Qué dolor! Por suerte la ambulancia estaba cerca. Estaré 30 Minutos en observación hasta que sanen mis heridas. <br>";
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
                header("location: ?page=accion&message=$box");
                exit;
            }
            break;
            
            case 'aventuraTerriDebil':
            $zona = 2;
            $barrio = 1;
            $agotamiento = 30;
            $probabilidadEncontrar = rand(1, 40);
            $puedoHacerlo = comprobarEnergia($agotamiento);
            $tengoSalud = comprobarSalud(1);
            if($puedoHacerlo === 1 && $tengoSalud === 1){
                $sql = "UPDATE personajes SET energia = energia-$agotamiento WHERE id='$id'";
                $stmt = $db->query($sql);
                $encuentroMonstruos = buscarMonstruos($probabilidadEncontrar);
                if($encuentroMonstruos === 1){
                    // ¿Cuál monstruo he encontrado?
                    $monstruo = cualMonstruoDebil($zona,$barrio);
                    $box = $monstruo[0]['nombre'];
                    
                    //Foto del monstruo
                    $imagenMonstruo = $monstruo[0]['imagenMonstruo'];
                    
                    // Atacar al monstruo
                    $idMonstruo = $monstruo[0]['idM'];
                    $premio= atacarMonstruo($idMonstruo);
                    
                    if($premio > 0){
                        //AÑADO EL MONSTRUO DERROTADO AL ALBUM
                        $sql = "INSERT INTO victorias (idP,idM,cantidad) VALUES ('$id','$idMonstruo',1) ON DUPLICATE KEY UPDATE cantidad=cantidad+1;";
                        $db->query($sql);
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
                            $mensajeObjeto = " Le arrebato un objeto que llevaba consigo: ";
                            $nivelMAXObjeto = $monstruo[0]['nivel'];
                            $sql = "SELECT * FROM objetos WHERE nivelMin > 0 AND nivelMin <= '$nivelMAXObjeto'";
                            $stmt = $db->query($sql);
                            $obj = $stmt->fetchAll();
                            $cantidadObjetosCandidatos = count($obj); 
                            $objetoObtenido = rand(0, $cantidadObjetosCandidatos-1);
                            $nombreObjetoObtenido = $obj[$objetoObtenido]['nombre'];
                            $mensajeObjeto = $mensajeObjeto . $nombreObjetoObtenido;
                            
                            //Miro que tenga algun slot libre en el inventario
                            $slotDondeGuardo = comprobarSlotLibre();
                            if($slotDondeGuardo === -1){
                                $mensajeObjeto = $mensajeObjeto . ". No puedo llevarme el botín porque mi inventario está lleno.";
                            }
                             else{
                                //AÑADIR AL INVENTARIO
                                $idObjetoObtenido = $obj[$objetoObtenido]['id'];
                                $sql = "UPDATE inventario SET idO = '$idObjetoObtenido' WHERE idP='$id' AND slot = '$slotDondeGuardo'";
                                $db->query($sql);
                                
                                
                                //AÑADIR AL ALBUM DE COLECCIONISMO SI ES UN AVION
                                if($idObjetoObtenido >= '1000'){
                                    $sql = "INSERT INTO coleccionismo (idP,idO,imagen) VALUES('$id','$idObjetoObtenido','$idObjetoObtenido.png')";
                                    $db->query($sql);
                                }
                                else{
                                    //AÑADIR AL ALBUM DE COLECCIONISMO SI ES UNA RELIQUIA
                                    $sql = "SELECT * FROM objetos WHERE id='$idObjetoObtenido'";
                                    $stmt = $db->query($sql);
                                    $res = $stmt->fetchAll();
                                    
                                    $esReliquia = $res[0]['reliquia'];
                                    if($esReliquia === '1'){
                                        //Añadir al Album Coleccionismo
                                        $sql = "INSERT INTO coleccionismo (idP,idO,imagen) VALUES('$id','$idObjetoObtenido','$idObjetoObtenido.png')";
                                        $db->query($sql);
                                        
                                        //Generar un mensaje de Informe de reliquia
                                        $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$id','Reliquia Encontrada','Al derrotar a ese monstruo notas un pequeño brillo debajo de su cuerpo. Te acercas para observar mejor... <br>¡Encuentras $nombreObjetoObtenido! Toda una Reliquia.','reliquiaEncontrada.png')";
                                        $db->query($sql);
                                    }
                                }
                            }
                        }
                        else{
                            $mensajeObjeto = '';
                        }
                        
                        //Comprobar si subo de nivel
                        global $db;
                        $mensajeNivel = '';
                        $sql = "SELECT nivel FROM personajes WHERE id='$id'";
                        $stmt = $db->query($sql);
                        $personaje = $stmt->fetchAll();
                        $nuevoNivel = comprobarSuboNivel($id);
                        if($nuevoNivel != $personaje[0]['nivel'] ){
                            $avances = 5;
                            //Mirar si lleva algun objeto con la especialidad avance extra
                            $sql = "SELECT objetos.* FROM inventario JOIN objetos ON inventario.idO = objetos.id WHERE inventario.idP = '$id' AND inventario.slot <= 7";
                            $stmt = $db->query($sql);
                            $objetosEquipados = $stmt->fetchAll();

                            foreach ($objetosEquipados as $cadaObjeto) {
                                if($cadaObjeto['especial']==='avance extra'){
                                    $avances = $avances + 1;
                                }   
                            }
                            
                            $sql = "UPDATE personajes SET nivel = personajes.nivel+1, avances = personajes.avances + $avances WHERE id='$id'";
                            $db->query($sql);
                            
                            $mensajeNivel = " SUBO DE NIVEL<br>";
                            
                            //Generar mensaje del informe de la subida de nivel
                            $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$id','Subiste de Nivel','¡Enhorabuena! Acabas de subir a Nivel $nuevoNivel. <br> Obtienes $avances Avances para mejorar habilidades en la ventana de Personaje.','subirNivel.png')";
                            $db->query($sql);
                            
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
                        //Si me quedo con la vida a cero, me viene la ambulancia     
                        $sql = "UPDATE personajes SET accion = ADDTIME(NOW(), '0:30:0') WHERE id='$id'";
                        $db->query($sql);
                        $celebracion = "¡Qué dolor! Enseguida llega la ambulancia a auxiliarme, pero tardarán 30 Minutos en darme el alta <br>";
                        }
                    }
                    
                    $box = "Me enfrento a un " . $box . " ... " . $celebracion;
                }
                else{
                    
                    $box = "Qué agradable paseo! No me ha atacado ningún monstruo.";
                }
            }
            else{
                $box = "¡Ay! No puedo con mi cuerpo ahora mismo";
                header("location: ?page=accion&message=$box");
                exit;
            }
            break;
            //AVENTURA BULEVAR COMERCIAL
        case 'aventuraBulevar':
            $zona = 1;
            $barrio = 2;
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
                    
                    //Foto del monstruo
                    $imagenMonstruo = $monstruo[0]['imagenMonstruo'];

                    // Atacar al monstruo
                    $idMonstruo = $monstruo[0]['idM'];
                    $premio= atacarMonstruo($idMonstruo);
                    
                    if($premio > 0){
                        //AÑADO EL MONSTRUO DERROTADO AL ALBUM
                        $sql = "INSERT INTO victorias (idP,idM,cantidad) VALUES ('$id','$idMonstruo',1) ON DUPLICATE KEY UPDATE cantidad=cantidad+1;";
                        $db->query($sql);
                        
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
                            $mensajeObjeto = " Le arrebato un objeto que llevaba consigo: ";
                            $nivelMAXObjeto = $monstruo[0]['nivel'];
                            $sql = "SELECT * FROM objetos WHERE nivelMin > 0 AND nivelMin <= '$nivelMAXObjeto'";
                            $stmt = $db->query($sql);
                            $obj = $stmt->fetchAll();
                            $cantidadObjetosCandidatos = count($obj); 
                            $objetoObtenido = rand(0, $cantidadObjetosCandidatos-1);
                            $mensajeObjeto = $mensajeObjeto . $obj[$objetoObtenido]['nombre'];
                            
                            //Miro que tenga algun slot libre en el inventario
                            $slotDondeGuardo = comprobarSlotLibre();
                            if($slotDondeGuardo === -1){
                                $mensajeObjeto = $mensajeObjeto . ". No puedo llevarme el botín porque mi inventario está lleno.";
                            }
                            else{
                                //AÑADIR AL INVENTARIO
                                $idObjetoObtenido = $obj[$objetoObtenido]['id'];
                                $sql = "UPDATE inventario SET idO = '$idObjetoObtenido' WHERE idP='$id' AND slot = '$slotDondeGuardo'";
                                $db->query($sql);
                                
                                
                                //AÑADIR AL ALBUM DE COLECCIONISMO SI ES UN AVION
                                if($idObjetoObtenido >= '1000'){
                                    $sql = "INSERT INTO coleccionismo (idP,idO,imagen) VALUES('$id','$idObjetoObtenido','$idObjetoObtenido.png')";
                                    $db->query($sql);
                                }
                                else{
                                    //AÑADIR AL ALBUM DE COLECCIONISMO SI ES UNA RELIQUIA
                                    $sql = "SELECT * FROM objetos WHERE id='$idObjetoObtenido'";
                                    $stmt = $db->query($sql);
                                    $res = $stmt->fetchAll();
                                    
                                    $esReliquia = $res[0]['reliquia'];
                                    if($esReliquia === '1'){
                                        $sql = "INSERT INTO coleccionismo (idP,idO,imagen) VALUES('$id','$idObjetoObtenido','$idObjetoObtenido.png')";
                                        $db->query($sql);
                                        
                                        //Generar un mensaje de Informe de reliquia
                                        $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$id','Reliquia Encontrada','Al derrotar a ese monstruo notas un pequeño brillo debajo de su cuerpo. Te acercas para observar mejor... <br>¡Encuentras $nombreObjetoObtenido! Toda una Reliquia.','reliquiaEncontrada.png')";
                                        $db->query($sql);
                                    }
                                }
                            }
                        }
                        else{
                            $mensajeObjeto = '';
                        }
                        
                        //Comprobar si subo de nivel
                        global $db;
                        $mensajeNivel = '';
                        $sql = "SELECT nivel FROM personajes WHERE id='$id'";
                        $stmt = $db->query($sql);
                        $personaje = $stmt->fetchAll();
                        $nuevoNivel = comprobarSuboNivel($id);
                        if($nuevoNivel != $personaje[0]['nivel'] ){
                            $avances = 5;
                            //Mirar si lleva algun objeto con la especialidad AVANCE EXTRA
                            $sql = "SELECT objetos.* FROM inventario JOIN objetos ON inventario.idO = objetos.id WHERE inventario.idP = '$id' AND inventario.slot <= 7";
                            $stmt = $db->query($sql);
                            $objetosEquipados = $stmt->fetchAll();

                            foreach ($objetosEquipados as $cadaObjeto) {
                                if($cadaObjeto['especial']==='avance extra'){
                                    $avances = $avances + 1;
                                }   
                            }
                            
                            $sql = "UPDATE personajes SET nivel = personajes.nivel+1, avances = personajes.avances + $avances WHERE id='$id'";
                            $db->query($sql);
                            $mensajeNivel = " SUBO DE NIVEL<br>";
                            //Generar mensaje del informe de la subida de nivel
                            $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$id','Subiste de Nivel','¡Enhorabuena! Acabas de subir a Nivel $nuevoNivel. <br> Obtienes $avances Avances para mejorar habilidades en la ventana de Personaje.','subirNivel.png')";
                            $db->query($sql);
                            
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
                        //Si me quedo con la vida a cero, me viene la ambulancia     
                        $sql = "UPDATE personajes SET accion = ADDTIME(NOW(), '0:30:0') WHERE id='$id'";
                        $db->query($sql);
                        $celebracion = "¡Qué dolor! Por suerte la ambulancia estaba cerca. Estaré 30 Minutos en observación hasta que sanen mis heridas. <br>";
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
                header("location: ?page=accion&message=$box");
                exit;
            }
            break;
            
            case 'aventuraBulevarDebil':
            $zona = 1;
            $barrio = 2;
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
                    $monstruo = cualMonstruoDebil($zona,$barrio);
                    $box = $monstruo[0]['nombre'];
                    
                    //Foto del monstruo
                    $imagenMonstruo = $monstruo[0]['imagenMonstruo'];
                    
                    // Atacar al monstruo
                    $idMonstruo = $monstruo[0]['idM'];
                    $premio= atacarMonstruo($idMonstruo);
                    
                    if($premio > 0){
                        //AÑADO EL MONSTRUO DERROTADO AL ALBUM
                        $sql = "INSERT INTO victorias (idP,idM,cantidad) VALUES ('$id','$idMonstruo',1) ON DUPLICATE KEY UPDATE cantidad=cantidad+1;";
                        $db->query($sql);
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
                            $mensajeObjeto = " Le arrebato un objeto que llevaba consigo: ";
                            $nivelMAXObjeto = $monstruo[0]['nivel'];
                            $sql = "SELECT * FROM objetos WHERE nivelMin > 0 AND nivelMin <= '$nivelMAXObjeto'";
                            $stmt = $db->query($sql);
                            $obj = $stmt->fetchAll();
                            $cantidadObjetosCandidatos = count($obj); 
                            $objetoObtenido = rand(0, $cantidadObjetosCandidatos-1);
                            $nombreObjetoObtenido = $obj[$objetoObtenido]['nombre'];
                            $mensajeObjeto = $mensajeObjeto . $nombreObjetoObtenido;
                            
                            //Miro que tenga algun slot libre en el inventario
                            $slotDondeGuardo = comprobarSlotLibre();
                            if($slotDondeGuardo === -1){
                                $mensajeObjeto = $mensajeObjeto . ". No puedo llevarme el botín porque mi inventario está lleno.";
                            }
                             else{
                                //AÑADIR AL INVENTARIO
                                $idObjetoObtenido = $obj[$objetoObtenido]['id'];
                                $sql = "UPDATE inventario SET idO = '$idObjetoObtenido' WHERE idP='$id' AND slot = '$slotDondeGuardo'";
                                $db->query($sql);
                                
                                
                                //AÑADIR AL ALBUM DE COLECCIONISMO SI ES UN AVION
                                if($idObjetoObtenido >= '1000'){
                                    $sql = "INSERT INTO coleccionismo (idP,idO,imagen) VALUES('$id','$idObjetoObtenido','$idObjetoObtenido.png')";
                                    $db->query($sql);
                                }
                                else{
                                    //AÑADIR AL ALBUM DE COLECCIONISMO SI ES UNA RELIQUIA
                                    $sql = "SELECT * FROM objetos WHERE id='$idObjetoObtenido'";
                                    $stmt = $db->query($sql);
                                    $res = $stmt->fetchAll();
                                    
                                    $esReliquia = $res[0]['reliquia'];
                                    if($esReliquia === '1'){
                                        //Añadir al Album Coleccionismo
                                        $sql = "INSERT INTO coleccionismo (idP,idO,imagen) VALUES('$id','$idObjetoObtenido','$idObjetoObtenido.png')";
                                        $db->query($sql);
                                        
                                        //Generar un mensaje de Informe de reliquia
                                        $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$id','Reliquia Encontrada','Al derrotar a ese monstruo notas un pequeño brillo debajo de su cuerpo. Te acercas para observar mejor... <br>¡Encuentras $nombreObjetoObtenido! Toda una Reliquia.','reliquiaEncontrada.png')";
                                        $db->query($sql);
                                    }
                                }
                            }
                        }
                        else{
                            $mensajeObjeto = '';
                        }
                        
                        //Comprobar si subo de nivel
                        global $db;
                        $mensajeNivel = '';
                        $sql = "SELECT nivel FROM personajes WHERE id='$id'";
                        $stmt = $db->query($sql);
                        $personaje = $stmt->fetchAll();
                        $nuevoNivel = comprobarSuboNivel($id);
                        if($nuevoNivel != $personaje[0]['nivel'] ){
                            $avances = 5;
                            //Mirar si lleva algun objeto con la especialidad avance extra
                            $sql = "SELECT objetos.* FROM inventario JOIN objetos ON inventario.idO = objetos.id WHERE inventario.idP = '$id' AND inventario.slot <= 7";
                            $stmt = $db->query($sql);
                            $objetosEquipados = $stmt->fetchAll();

                            foreach ($objetosEquipados as $cadaObjeto) {
                                if($cadaObjeto['especial']==='avance extra'){
                                    $avances = $avances + 1;
                                }   
                            }
                            
                            $sql = "UPDATE personajes SET nivel = personajes.nivel+1, avances = personajes.avances + $avances WHERE id='$id'";
                            $db->query($sql);
                            
                            $mensajeNivel = " SUBO DE NIVEL<br>";
                            
                            //Generar mensaje del informe de la subida de nivel
                            $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$id','Subiste de Nivel','¡Enhorabuena! Acabas de subir a Nivel $nuevoNivel. <br> Obtienes $avances Avances para mejorar habilidades en la ventana de Personaje.','subirNivel.png')";
                            $db->query($sql);
                            
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
                        //Si me quedo con la vida a cero, me viene la ambulancia     
                        $sql = "UPDATE personajes SET accion = ADDTIME(NOW(), '0:30:0') WHERE id='$id'";
                        $db->query($sql);
                        $celebracion = "¡Qué dolor! Enseguida llega la ambulancia a auxiliarme, pero tardarán 30 Minutos en darme el alta <br>";
                        }
                    }
                    
                    $box = "Me enfrento a un " . $box . " ... " . $celebracion;
                }
                else{
                    
                    $box = "Qué agradable paseo! No me ha atacado ningún monstruo.";
                }
            }
            else{
                $box = "¡Ay! No puedo con mi cuerpo ahora mismo";
                header("location: ?page=accion&message=$box");
                exit;
            }
            break;
        //AVENTURA SUBIR AL MINERO
        case 'aventuraMinero':
            $zona = 3;
            $barrio = 5;
            $agotamiento = 30;
            $probabilidadEncontrar = rand(1, 20);
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
                    
                    //Foto del monstruo
                    $imagenMonstruo = $monstruo[0]['imagenMonstruo'];

                    // Atacar al monstruo
                    $idMonstruo = $monstruo[0]['idM'];
                    $premio= atacarMonstruo($idMonstruo);
                    
                    if($premio > 0){
                        //AÑADO EL MONSTRUO DERROTADO AL ALBUM
                        $sql = "INSERT INTO victorias (idP,idM,cantidad) VALUES ('$id','$idMonstruo',1) ON DUPLICATE KEY UPDATE cantidad=cantidad+1;";
                        $db->query($sql);
                        //AÑADO EL MONSTRUO DERROTADO A CACERIAS SI PROCEDE
                        //Monstruos candidatos a cacerias
                        if($idMonstruo === 91 || $idMonstruo === 94 || $idMonstruo === 96 || $idMonstruo === 99){ //Jabalies Mision 12
                            $mision = comprobarMision(12);
                            if($mision === 1){ //La mision está en curso
                                $sql = "INSERT INTO cacerias (idP,idM,cantidad) VALUES ('$id','$idMonstruo',1) ON DUPLICATE KEY UPDATE cantidad=cantidad+1;";
                                $db->query($sql);
                            }
                        }
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
                            $mensajeObjeto = " Le arrebato un objeto que llevaba consigo: ";
                            $nivelMAXObjeto = $monstruo[0]['nivel'];
                            $sql = "SELECT * FROM objetos WHERE nivelMin > 0 AND nivelMin <= '$nivelMAXObjeto'";
                            $stmt = $db->query($sql);
                            $obj = $stmt->fetchAll();
                            $cantidadObjetosCandidatos = count($obj); 
                            $objetoObtenido = rand(0, $cantidadObjetosCandidatos-1);
                            $mensajeObjeto = $mensajeObjeto . $obj[$objetoObtenido]['nombre'];
                            
                            //Miro que tenga algun slot libre en el inventario
                            $slotDondeGuardo = comprobarSlotLibre();
                            if($slotDondeGuardo === -1){
                                $mensajeObjeto = $mensajeObjeto . ". No puedo llevarme el botín porque mi inventario está lleno.";
                            }
                            else{
                                //AÑADIR AL INVENTARIO
                                $idObjetoObtenido = $obj[$objetoObtenido]['id'];
                                $sql = "UPDATE inventario SET idO = '$idObjetoObtenido' WHERE idP='$id' AND slot = '$slotDondeGuardo'";
                                $db->query($sql);
                                
                                
                                //AÑADIR AL ALBUM DE COLECCIONISMO SI ES UN AVION
                                if($idObjetoObtenido >= '1000'){
                                    $sql = "INSERT INTO coleccionismo (idP,idO,imagen) VALUES('$id','$idObjetoObtenido','$idObjetoObtenido.png')";
                                    $db->query($sql);
                                }
                                else{
                                    //AÑADIR AL ALBUM DE COLECCIONISMO SI ES UNA RELIQUIA
                                    $sql = "SELECT * FROM objetos WHERE id='$idObjetoObtenido'";
                                    $stmt = $db->query($sql);
                                    $res = $stmt->fetchAll();
                                    
                                    $esReliquia = $res[0]['reliquia'];
                                    if($esReliquia === '1'){
                                        $sql = "INSERT INTO coleccionismo (idP,idO,imagen) VALUES('$id','$idObjetoObtenido','$idObjetoObtenido.png')";
                                        $db->query($sql);
                                        
                                        //Generar un mensaje de Informe de reliquia
                                        $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$id','Reliquia Encontrada','Al derrotar a ese monstruo notas un pequeño brillo debajo de su cuerpo. Te acercas para observar mejor... <br>¡Encuentras $nombreObjetoObtenido! Toda una Reliquia.','reliquiaEncontrada.png')";
                                        $db->query($sql);
                                    }
                                }
                            }
                        }
                        else{
                            $mensajeObjeto = '';
                        }
                        
                        //Comprobar si subo de nivel
                        global $db;
                        $mensajeNivel = '';
                        $sql = "SELECT nivel FROM personajes WHERE id='$id'";
                        $stmt = $db->query($sql);
                        $personaje = $stmt->fetchAll();
                        $nuevoNivel = comprobarSuboNivel($id);
                        if($nuevoNivel != $personaje[0]['nivel'] ){
                            $avances = 5;
                            //Mirar si lleva algun objeto con la especialidad AVANCE EXTRA
                            $sql = "SELECT objetos.* FROM inventario JOIN objetos ON inventario.idO = objetos.id WHERE inventario.idP = '$id' AND inventario.slot <= 7";
                            $stmt = $db->query($sql);
                            $objetosEquipados = $stmt->fetchAll();

                            foreach ($objetosEquipados as $cadaObjeto) {
                                if($cadaObjeto['especial']==='avance extra'){
                                    $avances = $avances + 1;
                                }   
                            }
                            
                            $sql = "UPDATE personajes SET nivel = personajes.nivel+1, avances = personajes.avances + $avances WHERE id='$id'";
                            $db->query($sql);
                            $mensajeNivel = " SUBO DE NIVEL<br>";
                            //Generar mensaje del informe de la subida de nivel
                            $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$id','Subiste de Nivel','¡Enhorabuena! Acabas de subir a Nivel $nuevoNivel. <br> Obtienes $avances Avances para mejorar habilidades en la ventana de Personaje.','subirNivel.png')";
                            $db->query($sql);
                            
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
                        //Si me quedo con la vida a cero, me viene la ambulancia     
                        $sql = "UPDATE personajes SET accion = ADDTIME(NOW(), '0:30:0') WHERE id='$id'";
                        $db->query($sql);
                        $celebracion = "¡Qué dolor! Por suerte la ambulancia estaba cerca. Estaré 30 Minutos en observación hasta que sanen mis heridas. <br>";
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
                header("location: ?page=accion&message=$box");
                exit;
            }
            break;
            
            case 'aventuraMineroDebil':
            $zona = 3;
            $barrio = 5;
            $agotamiento = 30;
            $probabilidadEncontrar = rand(1, 20);
            $puedoHacerlo = comprobarEnergia($agotamiento);
            $tengoSalud = comprobarSalud(1);
            if($puedoHacerlo === 1 && $tengoSalud === 1){
                $sql = "UPDATE personajes SET energia = energia-$agotamiento WHERE id='$id'";
                $stmt = $db->query($sql);
                $encuentroMonstruos = buscarMonstruos($probabilidadEncontrar);
                if($encuentroMonstruos === 1){
                    // ¿Cuál monstruo he encontrado?
                    $monstruo = cualMonstruoDebil($zona,$barrio);
                    $box = $monstruo[0]['nombre'];
                    
                    //Foto del monstruo
                    $imagenMonstruo = $monstruo[0]['imagenMonstruo'];
                    
                    // Atacar al monstruo
                    $idMonstruo = $monstruo[0]['idM'];
                    $premio= atacarMonstruo($idMonstruo);
                    
                    if($premio > 0){
                        //AÑADO EL MONSTRUO DERROTADO AL ALBUM
                        $sql = "INSERT INTO victorias (idP,idM,cantidad) VALUES ('$id','$idMonstruo',1) ON DUPLICATE KEY UPDATE cantidad=cantidad+1;";
                        $db->query($sql);
                        //AÑADO EL MONSTRUO DERROTADO A CACERIAS SI PROCEDE
                        //Monstruos candidatos a cacerias
                        if($idMonstruo === '91' || $idMonstruo === '94' || $idMonstruo === '96' || $idMonstruo === '99'){ //Jabalies Mision 12
                            $mision = comprobarMision(12);
                            if($mision === 1){ //La mision está en curso
                                $sql = "INSERT INTO cacerias (idP,idM,cantidad) VALUES ('$id','$idMonstruo',1) ON DUPLICATE KEY UPDATE cantidad=cantidad+1;";
                                $db->query($sql);
                            }
                        }
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
                            $mensajeObjeto = " Le arrebato un objeto que llevaba consigo: ";
                            $nivelMAXObjeto = $monstruo[0]['nivel'];
                            $sql = "SELECT * FROM objetos WHERE nivelMin > 0 AND nivelMin <= '$nivelMAXObjeto'";
                            $stmt = $db->query($sql);
                            $obj = $stmt->fetchAll();
                            $cantidadObjetosCandidatos = count($obj); 
                            $objetoObtenido = rand(0, $cantidadObjetosCandidatos-1);
                            $nombreObjetoObtenido = $obj[$objetoObtenido]['nombre'];
                            $mensajeObjeto = $mensajeObjeto . $nombreObjetoObtenido;
                            
                            //Miro que tenga algun slot libre en el inventario
                            $slotDondeGuardo = comprobarSlotLibre();
                            if($slotDondeGuardo === -1){
                                $mensajeObjeto = $mensajeObjeto . ". No puedo llevarme el botín porque mi inventario está lleno.";
                            }
                             else{
                                //AÑADIR AL INVENTARIO
                                $idObjetoObtenido = $obj[$objetoObtenido]['id'];
                                $sql = "UPDATE inventario SET idO = '$idObjetoObtenido' WHERE idP='$id' AND slot = '$slotDondeGuardo'";
                                $db->query($sql);
                                
                                
                                //AÑADIR AL ALBUM DE COLECCIONISMO SI ES UN AVION
                                if($idObjetoObtenido >= '1000'){
                                    $sql = "INSERT INTO coleccionismo (idP,idO,imagen) VALUES('$id','$idObjetoObtenido','$idObjetoObtenido.png')";
                                    $db->query($sql);
                                }
                                else{
                                    //AÑADIR AL ALBUM DE COLECCIONISMO SI ES UNA RELIQUIA
                                    $sql = "SELECT * FROM objetos WHERE id='$idObjetoObtenido'";
                                    $stmt = $db->query($sql);
                                    $res = $stmt->fetchAll();
                                    
                                    $esReliquia = $res[0]['reliquia'];
                                    if($esReliquia === '1'){
                                        //Añadir al Album Coleccionismo
                                        $sql = "INSERT INTO coleccionismo (idP,idO,imagen) VALUES('$id','$idObjetoObtenido','$idObjetoObtenido.png')";
                                        $db->query($sql);
                                        
                                        //Generar un mensaje de Informe de reliquia
                                        $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$id','Reliquia Encontrada','Al derrotar a ese monstruo notas un pequeño brillo debajo de su cuerpo. Te acercas para observar mejor... <br>¡Encuentras $nombreObjetoObtenido! Toda una Reliquia.','reliquiaEncontrada.png')";
                                        $db->query($sql);
                                    }
                                }
                            }
                        }
                        else{
                            $mensajeObjeto = '';
                        }
                        
                        //Comprobar si subo de nivel
                        global $db;
                        $mensajeNivel = '';
                        $sql = "SELECT nivel FROM personajes WHERE id='$id'";
                        $stmt = $db->query($sql);
                        $personaje = $stmt->fetchAll();
                        $nuevoNivel = comprobarSuboNivel($id);
                        if($nuevoNivel != $personaje[0]['nivel'] ){
                            $avances = 5;
                            //Mirar si lleva algun objeto con la especialidad avance extra
                            $sql = "SELECT objetos.* FROM inventario JOIN objetos ON inventario.idO = objetos.id WHERE inventario.idP = '$id' AND inventario.slot <= 7";
                            $stmt = $db->query($sql);
                            $objetosEquipados = $stmt->fetchAll();

                            foreach ($objetosEquipados as $cadaObjeto) {
                                if($cadaObjeto['especial']==='avance extra'){
                                    $avances = $avances + 1;
                                }   
                            }
                            
                            $sql = "UPDATE personajes SET nivel = personajes.nivel+1, avances = personajes.avances + $avances WHERE id='$id'";
                            $db->query($sql);
                            
                            $mensajeNivel = " SUBO DE NIVEL<br>";
                            
                            //Generar mensaje del informe de la subida de nivel
                            $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$id','Subiste de Nivel','¡Enhorabuena! Acabas de subir a Nivel $nuevoNivel. <br> Obtienes $avances Avances para mejorar habilidades en la ventana de Personaje.','subirNivel.png')";
                            $db->query($sql);
                            
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
                        //Si me quedo con la vida a cero, me viene la ambulancia     
                        $sql = "UPDATE personajes SET accion = ADDTIME(NOW(), '0:30:0') WHERE id='$id'";
                        $db->query($sql);
                        $celebracion = "¡Qué dolor! Enseguida llega la ambulancia a auxiliarme, pero tardarán 30 Minutos en darme el alta <br>";
                        }
                    }
                    
                    $box = "Me enfrento a un " . $box . " ... " . $celebracion;
                }
                else{
                    
                    $box = "Qué agradable paseo! No me ha atacado ningún monstruo.";
                }
            }
            else{
                $box = "¡Ay! No puedo con mi cuerpo ahora mismo";
                header("location: ?page=accion&message=$box");
                exit;
            }
            break;
            
        //AVENTURA GALERIAS TAURO
        case 'aventuraTauro':
            $zona = 2;
            $barrio = 5;
            $agotamiento = 15;
            $probabilidadEncontrar = rand(1, 40);
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
                    
                    //Foto del monstruo
                    $imagenMonstruo = $monstruo[0]['imagenMonstruo'];

                    // Atacar al monstruo
                    $idMonstruo = $monstruo[0]['idM'];
                    $premio= atacarMonstruo($idMonstruo);
                    
                    if($premio > 0){
                        //AÑADO EL MONSTRUO DERROTADO AL ALBUM
                        $sql = "INSERT INTO victorias (idP,idM,cantidad) VALUES ('$id','$idMonstruo',1) ON DUPLICATE KEY UPDATE cantidad=cantidad+1;";
                        $db->query($sql);
                        //AÑADO EL MONSTRUO DERROTADO A CACERIAS SI PROCEDE
                        //Monstruos candidatos a cacerias
                        if(($idMonstruo >= 81 && $idMonstruo <= 90) || $idMonstruo === '208'){
                            $mision = comprobarMision(16);
                            if($mision === 1){ //La mision está en curso
                                $sql = "INSERT INTO cacerias (idP,idM,cantidad) VALUES ('$id','$idMonstruo',1) ON DUPLICATE KEY UPDATE cantidad=cantidad+1;";
                                $db->query($sql);
                            }
                        }
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
                            $mensajeObjeto = " Le arrebato un objeto que llevaba consigo: ";
                            $nivelMAXObjeto = $monstruo[0]['nivel'];
                            $sql = "SELECT * FROM objetos WHERE nivelMin > 0 AND nivelMin <= '$nivelMAXObjeto'";
                            $stmt = $db->query($sql);
                            $obj = $stmt->fetchAll();
                            $cantidadObjetosCandidatos = count($obj); 
                            $objetoObtenido = rand(0, $cantidadObjetosCandidatos-1);
                            $mensajeObjeto = $mensajeObjeto . $obj[$objetoObtenido]['nombre'];
                            
                            //Miro que tenga algun slot libre en el inventario
                            $slotDondeGuardo = comprobarSlotLibre();
                            if($slotDondeGuardo === -1){
                                $mensajeObjeto = $mensajeObjeto . ". No puedo llevarme el botín porque mi inventario está lleno.";
                            }
                            else{
                                //AÑADIR AL INVENTARIO
                                $idObjetoObtenido = $obj[$objetoObtenido]['id'];
                                $sql = "UPDATE inventario SET idO = '$idObjetoObtenido' WHERE idP='$id' AND slot = '$slotDondeGuardo'";
                                $db->query($sql);
                                
                                
                                //AÑADIR AL ALBUM DE COLECCIONISMO SI ES UN AVION
                                if($idObjetoObtenido >= '1000'){
                                    $sql = "INSERT INTO coleccionismo (idP,idO,imagen) VALUES('$id','$idObjetoObtenido','$idObjetoObtenido.png')";
                                    $db->query($sql);
                                }
                                else{
                                    //AÑADIR AL ALBUM DE COLECCIONISMO SI ES UNA RELIQUIA
                                    $sql = "SELECT * FROM objetos WHERE id='$idObjetoObtenido'";
                                    $stmt = $db->query($sql);
                                    $res = $stmt->fetchAll();
                                    
                                    $esReliquia = $res[0]['reliquia'];
                                    if($esReliquia === '1'){
                                        $sql = "INSERT INTO coleccionismo (idP,idO,imagen) VALUES('$id','$idObjetoObtenido','$idObjetoObtenido.png')";
                                        $db->query($sql);
                                        
                                        //Generar un mensaje de Informe de reliquia
                                        $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$id','Reliquia Encontrada','Al derrotar a ese monstruo notas un pequeño brillo debajo de su cuerpo. Te acercas para observar mejor... <br>¡Encuentras $nombreObjetoObtenido! Toda una Reliquia.','reliquiaEncontrada.png')";
                                        $db->query($sql);
                                    }
                                }
                            }
                        }
                        else{
                            $mensajeObjeto = '';
                        }
                        
                        //Comprobar si subo de nivel
                        global $db;
                        $mensajeNivel = '';
                        $sql = "SELECT nivel FROM personajes WHERE id='$id'";
                        $stmt = $db->query($sql);
                        $personaje = $stmt->fetchAll();
                        $nuevoNivel = comprobarSuboNivel($id);
                        if($nuevoNivel != $personaje[0]['nivel'] ){
                            $avances = 5;
                            //Mirar si lleva algun objeto con la especialidad AVANCE EXTRA
                            $sql = "SELECT objetos.* FROM inventario JOIN objetos ON inventario.idO = objetos.id WHERE inventario.idP = '$id' AND inventario.slot <= 7";
                            $stmt = $db->query($sql);
                            $objetosEquipados = $stmt->fetchAll();

                            foreach ($objetosEquipados as $cadaObjeto) {
                                if($cadaObjeto['especial']==='avance extra'){
                                    $avances = $avances + 1;
                                }   
                            }
                            
                            $sql = "UPDATE personajes SET nivel = personajes.nivel+1, avances = personajes.avances + $avances WHERE id='$id'";
                            $db->query($sql);
                            $mensajeNivel = " SUBO DE NIVEL<br>";
                            //Generar mensaje del informe de la subida de nivel
                            $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$id','Subiste de Nivel','¡Enhorabuena! Acabas de subir a Nivel $nuevoNivel. <br> Obtienes $avances Avances para mejorar habilidades en la ventana de Personaje.','subirNivel.png')";
                            $db->query($sql);
                            
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
                        //Si me quedo con la vida a cero, me viene la ambulancia     
                        $sql = "UPDATE personajes SET accion = ADDTIME(NOW(), '0:30:0') WHERE id='$id'";
                        $db->query($sql);
                        $celebracion = "¡Qué dolor! Por suerte la ambulancia estaba cerca. Estaré 30 Minutos en observación hasta que sanen mis heridas. <br>";
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
                header("location: ?page=accion&message=$box");
                exit;
            }
            break;
            
            case 'aventuraTauroDebil':
            $zona = 2;
            $barrio = 5;
            $agotamiento = 15;
            $probabilidadEncontrar = rand(1, 40);
            $puedoHacerlo = comprobarEnergia($agotamiento);
            $tengoSalud = comprobarSalud(1);
            if($puedoHacerlo === 1 && $tengoSalud === 1){
                $sql = "UPDATE personajes SET energia = energia-$agotamiento WHERE id='$id'";
                $stmt = $db->query($sql);
                $encuentroMonstruos = buscarMonstruos($probabilidadEncontrar);
                if($encuentroMonstruos === 1){
                    // ¿Cuál monstruo he encontrado?
                    $monstruo = cualMonstruoDebil($zona,$barrio);
                    $box = $monstruo[0]['nombre'];
                    
                    //Foto del monstruo
                    $imagenMonstruo = $monstruo[0]['imagenMonstruo'];
                    
                    // Atacar al monstruo
                    $idMonstruo = $monstruo[0]['idM'];
                    $premio= atacarMonstruo($idMonstruo);
                    
                    if($premio > 0){
                        //AÑADO EL MONSTRUO DERROTADO AL ALBUM
                        $sql = "INSERT INTO victorias (idP,idM,cantidad) VALUES ('$id','$idMonstruo',1) ON DUPLICATE KEY UPDATE cantidad=cantidad+1;";
                        $db->query($sql);
                        //AÑADO EL MONSTRUO DERROTADO A CACERIAS SI PROCEDE
                        //Monstruos candidatos a cacerias
                        if(($idMonstruo >= 81 && $idMonstruo <= 90) || $idMonstruo === '208'){
                            $mision = comprobarMision(16);
                            if($mision === 1){ //La mision está en curso
                                $sql = "INSERT INTO cacerias (idP,idM,cantidad) VALUES ('$id','$idMonstruo',1) ON DUPLICATE KEY UPDATE cantidad=cantidad+1;";
                                $db->query($sql);
                            }
                        }
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
                            $mensajeObjeto = " Le arrebato un objeto que llevaba consigo: ";
                            $nivelMAXObjeto = $monstruo[0]['nivel'];
                            $sql = "SELECT * FROM objetos WHERE nivelMin > 0 AND nivelMin <= '$nivelMAXObjeto'";
                            $stmt = $db->query($sql);
                            $obj = $stmt->fetchAll();
                            $cantidadObjetosCandidatos = count($obj); 
                            $objetoObtenido = rand(0, $cantidadObjetosCandidatos-1);
                            $nombreObjetoObtenido = $obj[$objetoObtenido]['nombre'];
                            $mensajeObjeto = $mensajeObjeto . $nombreObjetoObtenido;
                            
                            //Miro que tenga algun slot libre en el inventario
                            $slotDondeGuardo = comprobarSlotLibre();
                            if($slotDondeGuardo === -1){
                                $mensajeObjeto = $mensajeObjeto . ". No puedo llevarme el botín porque mi inventario está lleno.";
                            }
                             else{
                                //AÑADIR AL INVENTARIO
                                $idObjetoObtenido = $obj[$objetoObtenido]['id'];
                                $sql = "UPDATE inventario SET idO = '$idObjetoObtenido' WHERE idP='$id' AND slot = '$slotDondeGuardo'";
                                $db->query($sql);
                                
                                
                                //AÑADIR AL ALBUM DE COLECCIONISMO SI ES UN AVION
                                if($idObjetoObtenido >= '1000'){
                                    $sql = "INSERT INTO coleccionismo (idP,idO,imagen) VALUES('$id','$idObjetoObtenido','$idObjetoObtenido.png')";
                                    $db->query($sql);
                                }
                                else{
                                    //AÑADIR AL ALBUM DE COLECCIONISMO SI ES UNA RELIQUIA
                                    $sql = "SELECT * FROM objetos WHERE id='$idObjetoObtenido'";
                                    $stmt = $db->query($sql);
                                    $res = $stmt->fetchAll();
                                    
                                    $esReliquia = $res[0]['reliquia'];
                                    if($esReliquia === '1'){
                                        //Añadir al Album Coleccionismo
                                        $sql = "INSERT INTO coleccionismo (idP,idO,imagen) VALUES('$id','$idObjetoObtenido','$idObjetoObtenido.png')";
                                        $db->query($sql);
                                        
                                        //Generar un mensaje de Informe de reliquia
                                        $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$id','Reliquia Encontrada','Al derrotar a ese monstruo notas un pequeño brillo debajo de su cuerpo. Te acercas para observar mejor... <br>¡Encuentras $nombreObjetoObtenido! Toda una Reliquia.','reliquiaEncontrada.png')";
                                        $db->query($sql);
                                    }
                                }
                            }
                        }
                        else{
                            $mensajeObjeto = '';
                        }
                        
                        //Comprobar si subo de nivel
                        global $db;
                        $mensajeNivel = '';
                        $sql = "SELECT nivel FROM personajes WHERE id='$id'";
                        $stmt = $db->query($sql);
                        $personaje = $stmt->fetchAll();
                        $nuevoNivel = comprobarSuboNivel($id);
                        if($nuevoNivel != $personaje[0]['nivel'] ){
                            $avances = 5;
                            //Mirar si lleva algun objeto con la especialidad avance extra
                            $sql = "SELECT objetos.* FROM inventario JOIN objetos ON inventario.idO = objetos.id WHERE inventario.idP = '$id' AND inventario.slot <= 7";
                            $stmt = $db->query($sql);
                            $objetosEquipados = $stmt->fetchAll();

                            foreach ($objetosEquipados as $cadaObjeto) {
                                if($cadaObjeto['especial']==='avance extra'){
                                    $avances = $avances + 1;
                                }   
                            }
                            
                            $sql = "UPDATE personajes SET nivel = personajes.nivel+1, avances = personajes.avances + $avances WHERE id='$id'";
                            $db->query($sql);
                            
                            $mensajeNivel = " SUBO DE NIVEL<br>";
                            
                            //Generar mensaje del informe de la subida de nivel
                            $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$id','Subiste de Nivel','¡Enhorabuena! Acabas de subir a Nivel $nuevoNivel. <br> Obtienes $avances Avances para mejorar habilidades en la ventana de Personaje.','subirNivel.png')";
                            $db->query($sql);
                            
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
                        //Si me quedo con la vida a cero, me viene la ambulancia     
                        $sql = "UPDATE personajes SET accion = ADDTIME(NOW(), '0:30:0') WHERE id='$id'";
                        $db->query($sql);
                        $celebracion = "¡Qué dolor! Enseguida llega la ambulancia a auxiliarme, pero tardarán 30 Minutos en darme el alta <br>";
                        }
                    }
                    
                    $box = "Me enfrento a un " . $box . " ... " . $celebracion;
                }
                else{
                    
                    $box = "Qué agradable paseo! No me ha atacado ningún monstruo.";
                }
            }
            else{
                $box = "¡Ay! No puedo con mi cuerpo ahora mismo";
                header("location: ?page=accion&message=$box");
                exit;
            }
            break;
            
        //AVENTURA GALERIAS TAURO
        case 'aventuraNiebla':
            $zona = 2;
            $barrio = 2;
            $agotamiento = 15;
            $probabilidadEncontrar = rand(1, 50);
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
                    
                    //Foto del monstruo
                    $imagenMonstruo = $monstruo[0]['imagenMonstruo'];

                    // Atacar al monstruo
                    $idMonstruo = $monstruo[0]['idM'];
                    $premio= atacarMonstruo($idMonstruo);
                    
                    if($premio > 0){
                        //AÑADO EL MONSTRUO DERROTADO AL ALBUM
                        $sql = "INSERT INTO victorias (idP,idM,cantidad) VALUES ('$id','$idMonstruo',1) ON DUPLICATE KEY UPDATE cantidad=cantidad+1;";
                        $db->query($sql);
                        //AÑADO EL MONSTRUO DERROTADO A CACERIAS SI PROCEDE
                        //Monstruos candidatos a cacerias
                        if($idMonstruo >= 31 && $idMonstruo <= 39){
                            $mision = comprobarMision(17);
                            $progreso = comprobarProgreso(17);
                            if($mision === 1 && $progreso === '1'){
                                if($idMonstruo >= 31 && $idMonstruo <= 33){
                                    $sql = "INSERT INTO cacerias (idP,idM,cantidad) VALUES ('$id','$idMonstruo',1) ON DUPLICATE KEY UPDATE cantidad=cantidad+1;";
                                    $db->query($sql);
                                }
                            }
                            elseif($mision === 1 && $progreso === '2'){
                                if($idMonstruo >= 34 && $idMonstruo <= 36){
                                    $sql = "INSERT INTO cacerias (idP,idM,cantidad) VALUES ('$id','$idMonstruo',1) ON DUPLICATE KEY UPDATE cantidad=cantidad+1;";
                                    $db->query($sql);
                                }
                            }
                            elseif($mision === 1 && $progreso === '3'){
                                if($idMonstruo >= 37 && $idMonstruo <= 39){
                                    $sql = "INSERT INTO cacerias (idP,idM,cantidad) VALUES ('$id','$idMonstruo',1) ON DUPLICATE KEY UPDATE cantidad=cantidad+1;";
                                    $db->query($sql);
                                }
                            }
                        }
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
                            $mensajeObjeto = " Le arrebato un objeto que llevaba consigo: ";
                            $nivelMAXObjeto = $monstruo[0]['nivel'];
                            $sql = "SELECT * FROM objetos WHERE nivelMin > 0 AND nivelMin <= '$nivelMAXObjeto'";
                            $stmt = $db->query($sql);
                            $obj = $stmt->fetchAll();
                            $cantidadObjetosCandidatos = count($obj); 
                            $objetoObtenido = rand(0, $cantidadObjetosCandidatos-1);
                            $mensajeObjeto = $mensajeObjeto . $obj[$objetoObtenido]['nombre'];
                            
                            //Miro que tenga algun slot libre en el inventario
                            $slotDondeGuardo = comprobarSlotLibre();
                            if($slotDondeGuardo === -1){
                                $mensajeObjeto = $mensajeObjeto . ". No puedo llevarme el botín porque mi inventario está lleno.";
                            }
                            else{
                                //AÑADIR AL INVENTARIO
                                $idObjetoObtenido = $obj[$objetoObtenido]['id'];
                                $sql = "UPDATE inventario SET idO = '$idObjetoObtenido' WHERE idP='$id' AND slot = '$slotDondeGuardo'";
                                $db->query($sql);
                                
                                
                                //AÑADIR AL ALBUM DE COLECCIONISMO SI ES UN AVION
                                if($idObjetoObtenido >= '1000'){
                                    $sql = "INSERT INTO coleccionismo (idP,idO,imagen) VALUES('$id','$idObjetoObtenido','$idObjetoObtenido.png')";
                                    $db->query($sql);
                                }
                                else{
                                    //AÑADIR AL ALBUM DE COLECCIONISMO SI ES UNA RELIQUIA
                                    $sql = "SELECT * FROM objetos WHERE id='$idObjetoObtenido'";
                                    $stmt = $db->query($sql);
                                    $res = $stmt->fetchAll();
                                    
                                    $esReliquia = $res[0]['reliquia'];
                                    if($esReliquia === '1'){
                                        $sql = "INSERT INTO coleccionismo (idP,idO,imagen) VALUES('$id','$idObjetoObtenido','$idObjetoObtenido.png')";
                                        $db->query($sql);
                                        
                                        //Generar un mensaje de Informe de reliquia
                                        $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$id','Reliquia Encontrada','Al derrotar a ese monstruo notas un pequeño brillo debajo de su cuerpo. Te acercas para observar mejor... <br>¡Encuentras $nombreObjetoObtenido! Toda una Reliquia.','reliquiaEncontrada.png')";
                                        $db->query($sql);
                                    }
                                }
                            }
                        }
                        else{
                            $mensajeObjeto = '';
                        }
                        
                        //Comprobar si subo de nivel
                        global $db;
                        $mensajeNivel = '';
                        $sql = "SELECT nivel FROM personajes WHERE id='$id'";
                        $stmt = $db->query($sql);
                        $personaje = $stmt->fetchAll();
                        $nuevoNivel = comprobarSuboNivel($id);
                        if($nuevoNivel != $personaje[0]['nivel'] ){
                            $avances = 5;
                            //Mirar si lleva algun objeto con la especialidad AVANCE EXTRA
                            $sql = "SELECT objetos.* FROM inventario JOIN objetos ON inventario.idO = objetos.id WHERE inventario.idP = '$id' AND inventario.slot <= 7";
                            $stmt = $db->query($sql);
                            $objetosEquipados = $stmt->fetchAll();

                            foreach ($objetosEquipados as $cadaObjeto) {
                                if($cadaObjeto['especial']==='avance extra'){
                                    $avances = $avances + 1;
                                }   
                            }
                            
                            $sql = "UPDATE personajes SET nivel = personajes.nivel+1, avances = personajes.avances + $avances WHERE id='$id'";
                            $db->query($sql);
                            $mensajeNivel = " SUBO DE NIVEL<br>";
                            //Generar mensaje del informe de la subida de nivel
                            $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$id','Subiste de Nivel','¡Enhorabuena! Acabas de subir a Nivel $nuevoNivel. <br> Obtienes $avances Avances para mejorar habilidades en la ventana de Personaje.','subirNivel.png')";
                            $db->query($sql);
                            
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
                        //Si me quedo con la vida a cero, me viene la ambulancia     
                        $sql = "UPDATE personajes SET accion = ADDTIME(NOW(), '0:30:0') WHERE id='$id'";
                        $db->query($sql);
                        $celebracion = "¡Qué dolor! Por suerte la ambulancia estaba cerca. Estaré 30 Minutos en observación hasta que sanen mis heridas. <br>";
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
                header("location: ?page=accion&message=$box");
                exit;
            }
            break;
            
            case 'aventuraNieblaDebil':
            $zona = 2;
            $barrio = 2;
            $agotamiento = 15;
            $probabilidadEncontrar = rand(1, 50);
            $puedoHacerlo = comprobarEnergia($agotamiento);
            $tengoSalud = comprobarSalud(1);
            if($puedoHacerlo === 1 && $tengoSalud === 1){
                $sql = "UPDATE personajes SET energia = energia-$agotamiento WHERE id='$id'";
                $stmt = $db->query($sql);
                $encuentroMonstruos = buscarMonstruos($probabilidadEncontrar);
                if($encuentroMonstruos === 1){
                    // ¿Cuál monstruo he encontrado?
                    $monstruo = cualMonstruoDebil($zona,$barrio);
                    $box = $monstruo[0]['nombre'];
                    
                    //Foto del monstruo
                    $imagenMonstruo = $monstruo[0]['imagenMonstruo'];
                    
                    // Atacar al monstruo
                    $idMonstruo = $monstruo[0]['idM'];
                    $premio= atacarMonstruo($idMonstruo);
                    
                    if($premio > 0){
                        //AÑADO EL MONSTRUO DERROTADO AL ALBUM
                        $sql = "INSERT INTO victorias (idP,idM,cantidad) VALUES ('$id','$idMonstruo',1) ON DUPLICATE KEY UPDATE cantidad=cantidad+1;";
                        $db->query($sql);
                        //AÑADO EL MONSTRUO DERROTADO A CACERIAS SI PROCEDE
                        //Monstruos candidatos a cacerias
                        if($idMonstruo >= 31 && $idMonstruo <= 39){
                            $mision = comprobarMision(17);
                            $progreso = comprobarProgreso(17);
                            if($mision === 1 && $progreso === '1'){
                                if($idMonstruo >= 31 && $idMonstruo <= 33){
                                    $sql = "INSERT INTO cacerias (idP,idM,cantidad) VALUES ('$id','$idMonstruo',1) ON DUPLICATE KEY UPDATE cantidad=cantidad+1;";
                                    $db->query($sql);
                                }
                            }
                            elseif($mision === 1 && $progreso === '2'){
                                if($idMonstruo >= 34 && $idMonstruo <= 36){
                                    $sql = "INSERT INTO cacerias (idP,idM,cantidad) VALUES ('$id','$idMonstruo',1) ON DUPLICATE KEY UPDATE cantidad=cantidad+1;";
                                    $db->query($sql);
                                }
                            }
                            elseif($mision === 1 && $progreso === '3'){
                                if($idMonstruo >= 37 && $idMonstruo <= 39){
                                    $sql = "INSERT INTO cacerias (idP,idM,cantidad) VALUES ('$id','$idMonstruo',1) ON DUPLICATE KEY UPDATE cantidad=cantidad+1;";
                                    $db->query($sql);
                                }
                            }
                        }
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
                            $mensajeObjeto = " Le arrebato un objeto que llevaba consigo: ";
                            $nivelMAXObjeto = $monstruo[0]['nivel'];
                            $sql = "SELECT * FROM objetos WHERE nivelMin > 0 AND nivelMin <= '$nivelMAXObjeto'";
                            $stmt = $db->query($sql);
                            $obj = $stmt->fetchAll();
                            $cantidadObjetosCandidatos = count($obj); 
                            $objetoObtenido = rand(0, $cantidadObjetosCandidatos-1);
                            $nombreObjetoObtenido = $obj[$objetoObtenido]['nombre'];
                            $mensajeObjeto = $mensajeObjeto . $nombreObjetoObtenido;
                            
                            //Miro que tenga algun slot libre en el inventario
                            $slotDondeGuardo = comprobarSlotLibre();
                            if($slotDondeGuardo === -1){
                                $mensajeObjeto = $mensajeObjeto . ". No puedo llevarme el botín porque mi inventario está lleno.";
                            }
                             else{
                                //AÑADIR AL INVENTARIO
                                $idObjetoObtenido = $obj[$objetoObtenido]['id'];
                                $sql = "UPDATE inventario SET idO = '$idObjetoObtenido' WHERE idP='$id' AND slot = '$slotDondeGuardo'";
                                $db->query($sql);
                                
                                
                                //AÑADIR AL ALBUM DE COLECCIONISMO SI ES UN AVION
                                if($idObjetoObtenido >= '1000'){
                                    $sql = "INSERT INTO coleccionismo (idP,idO,imagen) VALUES('$id','$idObjetoObtenido','$idObjetoObtenido.png')";
                                    $db->query($sql);
                                }
                                else{
                                    //AÑADIR AL ALBUM DE COLECCIONISMO SI ES UNA RELIQUIA
                                    $sql = "SELECT * FROM objetos WHERE id='$idObjetoObtenido'";
                                    $stmt = $db->query($sql);
                                    $res = $stmt->fetchAll();
                                    
                                    $esReliquia = $res[0]['reliquia'];
                                    if($esReliquia === '1'){
                                        //Añadir al Album Coleccionismo
                                        $sql = "INSERT INTO coleccionismo (idP,idO,imagen) VALUES('$id','$idObjetoObtenido','$idObjetoObtenido.png')";
                                        $db->query($sql);
                                        
                                        //Generar un mensaje de Informe de reliquia
                                        $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$id','Reliquia Encontrada','Al derrotar a ese monstruo notas un pequeño brillo debajo de su cuerpo. Te acercas para observar mejor... <br>¡Encuentras $nombreObjetoObtenido! Toda una Reliquia.','reliquiaEncontrada.png')";
                                        $db->query($sql);
                                    }
                                }
                            }
                        }
                        else{
                            $mensajeObjeto = '';
                        }
                        
                        //Comprobar si subo de nivel
                        global $db;
                        $mensajeNivel = '';
                        $sql = "SELECT nivel FROM personajes WHERE id='$id'";
                        $stmt = $db->query($sql);
                        $personaje = $stmt->fetchAll();
                        $nuevoNivel = comprobarSuboNivel($id);
                        if($nuevoNivel != $personaje[0]['nivel'] ){
                            $avances = 5;
                            //Mirar si lleva algun objeto con la especialidad avance extra
                            $sql = "SELECT objetos.* FROM inventario JOIN objetos ON inventario.idO = objetos.id WHERE inventario.idP = '$id' AND inventario.slot <= 7";
                            $stmt = $db->query($sql);
                            $objetosEquipados = $stmt->fetchAll();

                            foreach ($objetosEquipados as $cadaObjeto) {
                                if($cadaObjeto['especial']==='avance extra'){
                                    $avances = $avances + 1;
                                }   
                            }
                            
                            $sql = "UPDATE personajes SET nivel = personajes.nivel+1, avances = personajes.avances + $avances WHERE id='$id'";
                            $db->query($sql);
                            
                            $mensajeNivel = " SUBO DE NIVEL<br>";
                            
                            //Generar mensaje del informe de la subida de nivel
                            $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$id','Subiste de Nivel','¡Enhorabuena! Acabas de subir a Nivel $nuevoNivel. <br> Obtienes $avances Avances para mejorar habilidades en la ventana de Personaje.','subirNivel.png')";
                            $db->query($sql);
                            
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
                        //Si me quedo con la vida a cero, me viene la ambulancia     
                        $sql = "UPDATE personajes SET accion = ADDTIME(NOW(), '0:30:0') WHERE id='$id'";
                        $db->query($sql);
                        $celebracion = "¡Qué dolor! Enseguida llega la ambulancia a auxiliarme, pero tardarán 30 Minutos en darme el alta <br>";
                        }
                    }
                    
                    $box = "Me enfrento a un " . $box . " ... " . $celebracion;
                }
                else{
                    
                    $box = "Qué agradable paseo! No me ha atacado ningún monstruo.";
                }
            }
            else{
                $box = "¡Ay! No puedo con mi cuerpo ahora mismo";
                header("location: ?page=accion&message=$box");
                exit;
            }
            break;
        default:
            $box = "Error: esa opcion no existe";
            header("location: ?page=accion&message=$box");
            exit;
    }
    
    //Generar mensaje del informe de la aventura excepto cuando sea Pescar
    if($box != "pescar"){
        $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$id','Aventura','$box','$imagenMonstruo')";
        $db->query($sql); 
    }
    header("location: ?page=mensajes");
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