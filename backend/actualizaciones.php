<?php

//Para las transacciones del BANCO
function actualizarDinero($operacion, $cantidadDeposito, $cantidadRetirada){
    global $db;
    $id = $_SESSION['loggedIn'];
    
    if($operacion === "depositarDinero"){
        echo "Quiero depositar" . $cantidadDeposito;
        $sql = "UPDATE personajes SET enBanco=enBanco + $cantidadDeposito, cash=cash-$cantidadDeposito WHERE id='$id'";
        $stmt = $db->query($sql);
        header("location: ?page=zona&message=Exito");
        
    }
    elseif ($operacion === "retirarDinero") {
        echo "Quiero retirar" . $cantidadRetirada;
        $sql = "UPDATE personajes SET cash=cash+$cantidadRetirada*0.95, enBanco=enBanco-$cantidadRetirada WHERE id='$id'";
        $stmt = $db->query($sql);
        header("location: ?page=zona&message=Exito");
    }
    
}
//Para viajar de una zona a otra
function actualizarZona($casilla){
    global $db;
    $id = $_SESSION['loggedIn'];
    
    switch($casilla){
        case 1:
            $nuevoBarrio = 1;
            $nuevaZona = 1;
            break;
        
        case 2:
            $nuevoBarrio = 1;
            $nuevaZona = 2;
            break;
        
        case 3:
            $nuevoBarrio = 2;
            $nuevaZona = 1;
            break;
        
        case 4:
            $nuevoBarrio = 2;
            $nuevaZona = 2;
            break;
        
        case 5:
            $nuevoBarrio = 2;
            $nuevaZona = 3;
            break;
        
        case 6:
            $nuevoBarrio = 3;
            $nuevaZona = 1;
            break;
        
        case 7:
            $nuevoBarrio = 4;
            $nuevaZona = 1;
            break;
        
        case 8:
            $nuevoBarrio = 5;
            $nuevaZona = 1;
            break;
        
        case 9:
            $nuevoBarrio = 5;
            $nuevaZona = 2;
            break;
        
        case 10:
            $nuevoBarrio = 5;
            $nuevaZona = 3;
            break;
        
        case 11:
            $nuevoBarrio = 6;
            $nuevaZona = 1;
            break;
        
        case 12:
            $nuevoBarrio = 6;
            $nuevaZona = 2;
            break;
        
        case 13:
            $nuevoBarrio = 6;
            $nuevaZona = 3;
            break;
        
        case 14:
            $nuevoBarrio = 7;
            $nuevaZona = 1;
            break;
        
        case 15:
            $nuevoBarrio = 8;
            $nuevaZona = 1;
            break;
        
        case 16:
            $nuevoBarrio = 9;
            $nuevaZona = 1;
            break;
        
        case 17:
            $nuevoBarrio = 9;
            $nuevaZona = 2;
            break;
        
        case 18:
            $nuevoBarrio = 9;
            $nuevaZona = 3;
            break;
        
        case 19:
            $nuevoBarrio = 10;
            $nuevaZona = 1;
            break;
        
            
    }
    
    $sql = "UPDATE personajes SET barrio='$nuevoBarrio', zona='$nuevaZona' WHERE id='$id'";
    $stmt = $db->query($sql);
    header("location: ?page=zona&message=Exito");
    
}

function social($operacion, $cantidadDonacion){
    include (__ROOT__.'/backend/comprobaciones.php');
    include (__ROOT__.'/backend/aventuras.php');
    global $db;
    $id = $_SESSION['loggedIn'];
    
    //Consulo el EST y el ING base, que actuaran como potenciadores a los bonus. Tambien el dinero para las donaciones
    $sql = "SELECT estilo,ingenio,cash FROM personajes WHERE id='$id'";
    $stmt = $db->query($sql);
    $result = $stmt->fetchAll();
    
    //Calculo ahora los bonus
    $bonusEstilo = 0;
    $bonusIngenio = 0;
    
    //Consultar que objetos tiene EQUIPADO el personaje en cada slot (se ordenan por slot)
    $sql = "SELECT objetos.*, inventario.slot FROM inventario JOIN objetos ON inventario.idO = objetos.id WHERE inventario.idP = '$id' AND inventario.slot <= 7 ";
    $stmt = $db->query($sql);
    $result = $stmt->fetchAll();
    
    foreach ($result as $objetosPersonaje) {
        $bonusEstilo = $bonusEstilo + $objetosPersonaje['estilo'];
        $bonusIngenio = $bonusIngenio + $objetosPersonaje['ingenio'];
    }
    
    if($operacion === "conferenciaCentroMujer"){
        $agotamiento = 25;
        $estoyLibre = comprobarEspera();
        if($estoyLibre === 1){
            $puedoHacerlo = comprobarEnergia($agotamiento);
            if($puedoHacerlo === 1){
                $maxPopularidad = comprobarMaxPopularidad(22);
                if($maxPopularidad === 1){
                    //VA A GANAR POPULARIDAD,una ganancia base + mult por ING + mult por EST
                    $gananciaBase = rand(15,20);
                    $multIngenio = 1 + (($result[0]['ingenio'] + $bonusIngenio)/33); //Porcentaje por 3
                    $multEstilo = 1 + (($result[0]['estilo'] + $bonusEstilo)/100); //Porcentaje por 1

                    $gananciaTotal = floor($gananciaBase * $multEstilo * $multIngenio);

                    //Se actualiza la popularidad del sitio
                    $sql = "UPDATE popularidad SET puntos = CASE WHEN puntos + $gananciaTotal > 100 THEN 100 ELSE puntos + $gananciaTotal END WHERE idP = '$id' AND idS = '22'";       
                    $db->query($sql);

                    //Consulto mi nuevo porcentaje general de popularidad (AVG)
                    $sql = "SELECT AVG(puntos) FROM popularidad WHERE idP = '$id'";
                    $stmt = $db->query($sql);
                    $result = $stmt->fetchAll();

                    $popularidadAVG = round($result[0]['AVG(puntos)'], 2, PHP_ROUND_HALF_DOWN);

                    //Actualizo el personaje
                    $sql = "UPDATE personajes SET energia=energia-$agotamiento, popularidad = $popularidadAVG, accion = ADDTIME(NOW(), '1:0:0') WHERE id='$id'";       
                    $db->query($sql);
                    //GENERO UN INFORME DE POPULARIDAD
                    $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$id','Popularidad','Tus últimos actos sociales están teniendo repercusión. Los habitantes de Puertollano cada vez hablan mejor de tí. <br> Tu popularidad ha ascendido $gananciaTotal puntos en esta zona.','popularidad.png')";
                    $db->query($sql);
                    header("location: ?page=mensajes");
                }
                else{
                    header("location: ?page=zona&message=Mi Popularidad ya es máxima aquí"); 
                }
            }
            else{
                header("location: ?page=zona&message=No tengo energía para soportar 1 hora de conferencia");
            }
        }
        else{
            header("location: ?page=zona&message=Aun no me he recuperado de la última acción");
        }
    }
    elseif ($operacion === "donacionCentroMujer") {
        $estoyLibre = comprobarEspera();
        if($estoyLibre === 1){
            if($cantidadDonacion >= 100){
                $puedoPagar = comprobarCoste($cantidadDonacion);
                if($puedoPagar === 1){
                    $maxPopularidad = comprobarMaxPopularidad(22);
                    if($maxPopularidad === 1){
                        //VA A GANAR POPULARIDAD, una ganancia base + bonus por donacion
                        $gananciaBase = rand(1,5);
                        $bonusDonacion = $cantidadDonacion / 10; //+1 punto por cada 10 monedas

                        $gananciaTotal = $gananciaBase + $bonusDonacion;

                        //Se actualiza la popularidad del sitio
                        $sql = "UPDATE popularidad SET puntos = CASE WHEN puntos + $gananciaTotal > 100 THEN 100 ELSE puntos + $gananciaTotal END WHERE idP = '$id' AND idS = '22'";       
                        $db->query($sql);

                        //Consulto mi nuevo porcentaje general de popularidad (AVG)
                        $sql = "SELECT AVG(puntos) FROM popularidad WHERE idP = '$id'";
                        $stmt = $db->query($sql);
                        $result = $stmt->fetchAll();

                        $popularidadAVG = round($result[0]['AVG(puntos)'], 2, PHP_ROUND_HALF_DOWN);

                        //Actualizo el personaje
                        $sql = "UPDATE personajes SET cash=cash-$cantidadDonacion, popularidad = $popularidadAVG WHERE id='$id'";       
                        $db->query($sql);
                        
                        //GENERO UN INFORME DE POPULARIDAD
                        $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$id','Popularidad','Tus últimos actos sociales están teniendo repercusión. Los habitantes de Puertollano cada vez hablan mejor de tí. <br> Tu popularidad ha ascendido $gananciaTotal puntos en esta zona.','popularidad.png')";
                        $db->query($sql);
                        header("location: ?page=mensajes");
                    }
                    else{
                        header("location: ?page=zona&message=Mi Popularidad ya es máxima aquí"); 
                    }
                }
                else{
                   header("location: ?page=zona&message=No tengo dinero suficiente"); 
                }
            }
            else{
               header("location: ?page=zona&message=La donación mínima son 100 monedas"); 
            }
        }
        else{
            header("location: ?page=zona&message=Aun no me he recuperado de la última acción");
        }
    }
    elseif($operacion === "donarSangreHospital"){
        $agotamiento = 25;
        $estoyLibre = comprobarEspera();
        if($estoyLibre === 1){
            $puedoHacerlo = comprobarEnergia($agotamiento);
            if($puedoHacerlo === 1){
                $maxPopularidad = comprobarMaxPopularidad(155);
                if($maxPopularidad === 1){
                    //VA A GANAR POPULARIDAD,una ganancia base + mult por ING + mult por EST
                    $gananciaBase = rand(15,20);
                    $multIngenio = 1 + (($result[0]['ingenio'] + $bonusIngenio)/50); //Porcentaje por 2
                    $multEstilo = 1 + (($result[0]['estilo'] + $bonusEstilo)/50); //Porcentaje por 2

                    $gananciaTotal = floor($gananciaBase * $multEstilo * $multIngenio);

                    //Se actualiza la popularidad del sitio
                    $sql = "UPDATE popularidad SET puntos = CASE WHEN puntos + $gananciaTotal > 100 THEN 100 ELSE puntos + $gananciaTotal END WHERE idP = '$id' AND idS = '155'";       
                    $db->query($sql);

                    //Consulto mi nuevo porcentaje general de popularidad (AVG)
                    $sql = "SELECT AVG(puntos) FROM popularidad WHERE idP = '$id'";
                    $stmt = $db->query($sql);
                    $result = $stmt->fetchAll();

                    $popularidadAVG = round($result[0]['AVG(puntos)'], 2, PHP_ROUND_HALF_DOWN);

                    //Actualizo el personaje
                    $sql = "UPDATE personajes SET energia=energia-$agotamiento, popularidad = $popularidadAVG, accion = ADDTIME(NOW(), '0:15:0') WHERE id='$id'";       
                    $db->query($sql);
                    //GENERO UN INFORME DE POPULARIDAD
                    $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$id','Popularidad','Siempre viene bien contar con reservas de sangre en el Hospital. Los habitantes de Puertollano te están muy agradecidos por la donación. <br> Tu popularidad ha ascendido $gananciaTotal puntos en esta zona.','popularidad.png')";
                    $db->query($sql);
                    header("location: ?page=mensajes");
                }
                else{
                    header("location: ?page=zona&message=Mi Popularidad ya es máxima aquí"); 
                }
            }
            else{
                header("location: ?page=zona&message=Tengo tan poca energía que temo desmayarme en cuanto vea la aguja.");
            }
        }
        else{
            header("location: ?page=zona&message=Aun no me he recuperado de la última acción");
        }
    }
    elseif ($operacion === "donarPastaHospital") {
        $estoyLibre = comprobarEspera();
        if($estoyLibre === 1){
            if($cantidadDonacion >= 100){
                $puedoPagar = comprobarCoste($cantidadDonacion);
                if($puedoPagar === 1){
                    $maxPopularidad = comprobarMaxPopularidad(155);
                    if($maxPopularidad === 1){
                        //VA A GANAR POPULARIDAD, una ganancia base + bonus por donacion
                        $gananciaBase = rand(1,5);
                        $bonusDonacion = $cantidadDonacion / 10; //+1 punto por cada 10 monedas

                        $gananciaTotal = $gananciaBase + $bonusDonacion;

                        //Se actualiza la popularidad del sitio
                        $sql = "UPDATE popularidad SET puntos = CASE WHEN puntos + $gananciaTotal > 100 THEN 100 ELSE puntos + $gananciaTotal END WHERE idP = '$id' AND idS = '155'";       
                        $db->query($sql);

                        //Consulto mi nuevo porcentaje general de popularidad (AVG)
                        $sql = "SELECT AVG(puntos) FROM popularidad WHERE idP = '$id'";
                        $stmt = $db->query($sql);
                        $result = $stmt->fetchAll();

                        $popularidadAVG = round($result[0]['AVG(puntos)'], 2, PHP_ROUND_HALF_DOWN);

                        //Actualizo el personaje
                        $sql = "UPDATE personajes SET cash=cash-$cantidadDonacion, popularidad = $popularidadAVG WHERE id='$id'";       
                        $db->query($sql);
                        
                        //GENERO UN INFORME DE POPULARIDAD
                        $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$id','Popularidad','Tu generosa donación al Hospital está siendo de lo más comentado hoy. Los habitantes de Puertollano cada vez te valoran mejor. <br> Tu popularidad ha ascendido $gananciaTotal puntos en esta zona.','popularidad.png')";
                        $db->query($sql);
                        header("location: ?page=mensajes");
                    }
                    else{
                        header("location: ?page=zona&message=Mi Popularidad ya es máxima aquí"); 
                    }
                }
                else{
                   header("location: ?page=zona&message=No tengo dinero suficiente"); 
                }
            }
            else{
               header("location: ?page=zona&message=La donación mínima son 100 monedas"); 
            }
        }
        else{
            header("location: ?page=zona&message=Aun no me he recuperado de la última acción");
        }
    }
}

// Cuando realiza una accion en un checkbox de un spot
function accionSpot($box){
    include (__ROOT__.'/backend/comprobaciones.php');
    include (__ROOT__.'/backend/aventuras.php');
    global $db;
    $id = $_SESSION['loggedIn'];
    
    //Consultar que objetos tiene equipados mi personaje en cada slot (se ordenan por slot)
    $sql = "SELECT objetos.*, inventario.slot FROM inventario JOIN objetos ON inventario.idO = objetos.id WHERE inventario.idP = '$id' AND inventario.slot < 8";
    $stmt = $db->query($sql);
    $result = $stmt->fetchAll();
    
    foreach($result as $objetosEquipados){
        if($objetosEquipados['especial'] === 'aturdidor'){
            $aturdidor = 1;
        }
        elseif($objetosEquipados['especial'] === 'mistico'){
            $mistico = 1;
        }
        elseif($objetosEquipados['especial'] === 'recaudador'){
            $recaudador = 1;
        }
    }
    
    //Bonus de mejoras de habilidades
    $mejoraPrincipalMuyAlta = 1.25;
    $mejoraPrincipalAlta = 0.8;
    $mejoraPrincipalMedia = 0.5;
    $mejoraPrincipalBaja = 0.22;
    $mejoraPrincipalMuyBaja = 0.1;
    $mejoraSecundariaMuyAlta = 0.625;
    $mejoraSecundariaAlta = 0.4;
    $mejoraSecundariaMedia = 0.25;
    $mejoraSecundariaBaja = 0.11;
    $mejoraSecundariaMuyBaja = 0.05;
    
    switch($box){
        //BAR BOHEMIOS
        case 'misionBohemios':
            $sql = "SELECT * FROM progresos WHERE idP='$id' AND idM='4'";
            $stmt = $db->query($sql);
            $result = $stmt->fetchAll();
            
            if(isset($result[0])){ //Si ya tengo comenzada la mision
                if($result[0]['completada']==='0'){
                    //Compruebo en que etapa me encuentro ahora mismo
                    $etapaActual = $result[0]['progreso'];
                    if($etapaActual === '1'){ //Si estoy en la 1a etapa, debo hacer la entrega en Skatepark antes de que llegue al deadline de tiempo
                        $tiempoRestante = comprobarTiempoRestanteMision($id,4);
                        if($tiempoRestante != 0){
                            //Aumento el Progreso de Mision a 2
                            $sql = "UPDATE progresos SET progreso = 2 WHERE idP = '$id' AND idM = '4'";
                            $db->query($sql);
                        }
                        else{ //Reinicio la mision
                            $sql = "UPDATE tiempos SET deadline = ADDTIME(NOW(), '0:40:0') WHERE idP = '$id' AND idM = '4'";
                            $db->query($sql);
                            
                            //Envio mensaje de Reinicio de Mision
                            $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$id','Misión Reiniciada','¡Has reiniciado la Misión <i>Reparto Relámpago</i>!<br>¡Deja ya de leer y aligera para entregar ese pedido a tiempo!','etapa.png')";
                            $db->query($sql);
                        }
                        
                        
                    }
                    elseif($etapaActual === '2'){
                            //MIRAR EL DEADLINE A VER SI LO HE ENTREGADO DENTRO DE TIEMPO O NO
                            $tiempoRestante = comprobarTiempoRestanteMision($id,4);
                            if($tiempoRestante != 0){ //EXITO. COMPLETO LA MISION
                                //Recojo Recompensa: +300exp y +600 monedas
                                $sql = "UPDATE personajes SET experiencia = experiencia + 300, cash = cash + 600 WHERE id = '$id'";
                                $db->query($sql);

                                //Pongo la mision como completada
                                $sql = "UPDATE progresos SET completada = 1 WHERE idP = '$id' AND idM = '4'";
                                $db->query($sql);

                                //Genero un informe de Mision Cumplida
                                $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$id','Misión Cumplida','¡Has completado la Misión <i>Reparto Relámpago</i>!<br>Al entregar ese pedido en tiempo récord, ganas +300 EXP y +600 monedas. ¡Bien hecho!','etapa.png')";
                                $db->query($sql);

                                //Comprobar si subo de nivel
                                $sql = "SELECT nivel FROM personajes WHERE id='$id'";
                                $stmt = $db->query($sql);
                                $personaje = $stmt->fetchAll();
                                $nuevoNivel = comprobarSuboNivel($id);
                                if($nuevoNivel != $personaje[0]['nivel'] ){ //sube de nivel
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
                                    //Generar mensaje del informe de la subida de nivel
                                    $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$id','Subiste de Nivel','¡Enhorabuena! Acabas de subir a Nivel $nuevoNivel. <br> Obtienes $avances Avances para mejorar habilidades en la ventana de Personaje.','subirNivel.png')";
                                    $db->query($sql);
                                }
                            }
                            else{ //Reinicio la mision
                                $sql = "UPDATE tiempos SET deadline = ADDTIME(NOW(), '0:40:0') WHERE idP = '$id' AND idM = '4'";
                                $db->query($sql);
                                
                                //Envio mensaje de Reinicio de Mision
                                $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$id','Misión Reiniciada','¡Has reiniciado la Misión <i>Reparto Relámpago</i>!<br>¡Deja ya de leer y aligera para entregar ese pedido a tiempo!','etapa.png')";
                                $db->query($sql);
                            }
                        
                            
                    }
                }
            }
            else{ //Si no está comenzada, activarla y activar tambien un contador de tiempo
                $sql = "INSERT INTO progresos (idP,idM,progreso,completada) VALUES('$id','4','1','0')";
                $db->query($sql);
                
                $sql = "INSERT INTO tiempos (idM,idP, deadline) VALUES('4','$id',ADDTIME(NOW(), '0:40:0'))";
                $db->query($sql);
                
                //Envio mensaje de Aceptar Mision
                $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$id','Misión Aceptada','¡Has aceptado la Misión <i>Reparto Relámpago</i>!<br>¡Deja ya de leer y aligera para entregar ese pedido a tiempo!','etapa.png')";
                $db->query($sql);
            }
            
            break;
        case 'burrito':
            $coste = 10;
            $mejoraSalud = 10;
            $puedoPagar = comprobarCoste($coste);
            if($puedoPagar === 1){
                $sql = "UPDATE personajes SET salud = CASE WHEN salud + '$mejoraSalud' > 100 THEN 100 ELSE salud + '$mejoraSalud' END, cash = cash-$coste WHERE id='$id'";
                $stmt = $db->query($sql);
            }
            else{
                $box = "No puedo pagar eso";
            }
            break;
        case 'pizza':
            $coste = 18;
            $mejoraSalud = 20;
            $puedoPagar = comprobarCoste($coste);
            if($puedoPagar === 1){
                $sql = "UPDATE personajes SET salud = CASE WHEN salud + '$mejoraSalud' > 100 THEN 100 ELSE salud + '$mejoraSalud' END, cash = cash-$coste WHERE id='$id'";
                $stmt = $db->query($sql);
            }
            else{
                $box = "No puedo pagar eso";
            }
            break;
        case 'brownie':
            $coste = 18;
            $mejoraSalud = 20;
            $puedoPagar = comprobarCoste($coste);
            if($puedoPagar === 1){
                $sql = "UPDATE personajes SET salud = CASE WHEN salud + '$mejoraSalud' > 100 THEN 100 ELSE salud + '$mejoraSalud' END, cash = cash-$coste WHERE id='$id'";
                $stmt = $db->query($sql);
            }
            else{
                $box = "No puedo pagar eso";
            }
            break;
            
        //CAFES
        case 'cafeGo':
            $coste = 10;
            $mejoraSalud = 1;
            $puedoPagar = comprobarCoste($coste);
            if($puedoPagar === 1){
                $sql = "UPDATE personajes SET salud = CASE WHEN salud + '$mejoraSalud' > 100 THEN 100 ELSE salud + '$mejoraSalud' END, cash = cash-$coste WHERE id='$id'";
                $stmt = $db->query($sql);
            }
            else{
                $box = "No puedo pagar eso";
            }
            break;
        case 'cafeIrlandes':
            $coste = 25;
            $mejoraSalud = 3;
            $puedoPagar = comprobarCoste($coste);
            if($puedoPagar === 1){
                $sql = "UPDATE personajes SET salud = CASE WHEN salud + '$mejoraSalud' > 100 THEN 100 ELSE salud + '$mejoraSalud' END, cash = cash-$coste WHERE id='$id'";
                $stmt = $db->query($sql);
            }
            else{
                $box = "No puedo pagar eso";
            }
            break;
            
        //CARRIL BICI
        case 'ritmitoGeneroso':
            $agotamiento = 40;
            $coste = 10;
            $puedoHacerlo = comprobarEnergia($agotamiento);
            if($puedoHacerlo === 1){
                $puedoPagar = comprobarCoste($coste);
                if($puedoPagar === 1){
                    //Consulta para hacer el informe
                    $sql = "SELECT agilidad,resistencia FROM personajes WHERE id='$id'";
                    $stmt = $db->query($sql);
                    $habilidades = $stmt->fetchAll();
                    
                    $agilidadPrevia = $habilidades[0]['agilidad'];
                    $resistenciaPrevia = $habilidades[0]['resistencia'];
                    $sql = "UPDATE personajes SET cash = cash - $coste, energia = energia-$agotamiento, agilidad = agilidad + $mejoraSecundariaMedia/personajes.agilidad, resistencia = resistencia + $mejoraPrincipalMedia/personajes.resistencia, accion = ADDTIME(NOW(), '0:30:0') WHERE id='$id'";
                    $stmt = $db->query($sql);
                    
                    //INFORME DE ENTRENAMIENTO
                    $sql = "SELECT agilidad,resistencia FROM personajes WHERE id='$id'";
                    $stmt = $db->query($sql);
                    $habilidades = $stmt->fetchAll();
                    
                    $agilidadPosterior = $habilidades[0]['agilidad'];
                    $resistenciaPosterior = $habilidades[0]['resistencia'];
                    
                    $mejoraAgilidad = round($agilidadPosterior - $agilidadPrevia, 2, PHP_ROUND_HALF_DOWN);
                    $mejoraResistencia = round($resistenciaPosterior - $resistenciaPrevia, 2, PHP_ROUND_HALF_DOWN);
                    
                    $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$id','Mejora de Habilidad','Buen ritmito de piernas. He mejorado $mejoraResistencia puntos de Resistencia y también $mejoraAgilidad puntos de Agilidad.','entrenamiento.png')";
                    $db->query($sql);
                }
                else{
                    $box = "Necesito dinero para engrasar la cadena.";
                }
            }else{
                $box = "EH, EH, tranqui. No aguanto ese ritmo sin antes dormir una siestita";
            }
            break;
        
        case 'vueltaBici':
            $agotamiento = 60;
            $coste = 20;
            $puedoHacerlo = comprobarEnergia($agotamiento);
            if($puedoHacerlo === 1){
                $puedoPagar = comprobarCoste($coste);
                if($puedoPagar === 1){
                    //Consulta para hacer el informe
                    $sql = "SELECT agilidad,resistencia FROM personajes WHERE id='$id'";
                    $stmt = $db->query($sql);
                    $habilidades = $stmt->fetchAll();
                    
                    $agilidadPrevia = $habilidades[0]['agilidad'];
                    $resistenciaPrevia = $habilidades[0]['resistencia'];
                    
                    $sql = "UPDATE personajes SET cash = cash - $coste, energia = energia-$agotamiento, agilidad = agilidad + $mejoraSecundariaAlta/personajes.agilidad, resistencia = resistencia + $mejoraPrincipalAlta/personajes.resistencia, accion = ADDTIME(NOW(), '0:45:0') WHERE id='$id'";
                    $stmt = $db->query($sql);
                    
                    //INFORME DE ENTRENAMIENTO
                    $sql = "SELECT agilidad,resistencia FROM personajes WHERE id='$id'";
                    $stmt = $db->query($sql);
                    $habilidades = $stmt->fetchAll();
                    
                    $agilidadPosterior = $habilidades[0]['agilidad'];
                    $resistenciaPosterior = $habilidades[0]['resistencia'];
                    
                    $mejoraAgilidad = round($agilidadPosterior - $agilidadPrevia, 2, PHP_ROUND_HALF_DOWN);
                    $mejoraResistencia = round($resistenciaPosterior - $resistenciaPrevia, 2, PHP_ROUND_HALF_DOWN);
                    
                    $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$id','Mejora de Habilidad','¡De aquí a correr el Tour! He mejorado $mejoraResistencia puntos de Resistencia y también $mejoraAgilidad puntos de Agilidad.','entrenamiento.png')";
                    $db->query($sql);
                }
                else{
                    $box = "¿Y si me multan por ir tan rápido? Mejor reunir algo de dinero antes";
                }
            }else{
                $box = "Pensándolo mejor... la única Vuelta que haré va a ser al sofá.";
            }
            break;
            
        //SKATEPARK ENTRENAMIENTO
        case 'rodarSkate':
            $agotamiento = 30;
            $coste = 5;
            $puedoHacerlo = comprobarEnergia($agotamiento);
            if($puedoHacerlo === 1){
                $puedoPagar = comprobarCoste($coste);
                if($puedoPagar === 1){
                    //Consulta para hacer el informe
                    $sql = "SELECT agilidad,resistencia FROM personajes WHERE id='$id'";
                    $stmt = $db->query($sql);
                    $habilidades = $stmt->fetchAll();
                    
                    $agilidadPrevia = $habilidades[0]['agilidad'];
                    $resistenciaPrevia = $habilidades[0]['resistencia'];
                    $sql = "UPDATE personajes SET cash = cash - $coste, energia = energia-$agotamiento, agilidad = agilidad + $mejoraPrincipalBaja/personajes.agilidad, resistencia = resistencia + $mejoraSecundariaBaja/personajes.resistencia, accion = ADDTIME(NOW(), '0:15:0') WHERE id='$id'";
                    $stmt = $db->query($sql);
                    
                    //INFORME DE ENTRENAMIENTO
                    $sql = "SELECT agilidad,resistencia FROM personajes WHERE id='$id'";
                    $stmt = $db->query($sql);
                    $habilidades = $stmt->fetchAll();
                    
                    $agilidadPosterior = $habilidades[0]['agilidad'];
                    $resistenciaPosterior = $habilidades[0]['resistencia'];
                    
                    $mejoraAgilidad = round($agilidadPosterior - $agilidadPrevia, 2, PHP_ROUND_HALF_DOWN);
                    $mejoraResistencia = round($resistenciaPosterior - $resistenciaPrevia, 2, PHP_ROUND_HALF_DOWN);
                    
                    $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$id','Mejora de Habilidad','Al menos le he quitado el óxido a la tabla. He mejorado $mejoraAgilidad puntos de Agilidad y también $mejoraResistencia puntos de Resistencia.','entrenamiento.png')";
                    $db->query($sql);
                }
                else{
                    $box = "Necesito dinero para poner una lija nueva.";
                }
            }else{
                $box = "No creo tener el cuerpo ahora mismo para subirme a rodar.";
            }
            break;
        
        case 'horse':
            $agotamiento = 45;
            $coste = 10;
            $puedoHacerlo = comprobarEnergia($agotamiento);
            if($puedoHacerlo === 1){
                $puedoPagar = comprobarCoste($coste);
                if($puedoPagar === 1){
                    //Consulta para hacer el informe
                    $sql = "SELECT agilidad,resistencia FROM personajes WHERE id='$id'";
                    $stmt = $db->query($sql);
                    $habilidades = $stmt->fetchAll();
                    
                    $agilidadPrevia = $habilidades[0]['agilidad'];
                    $resistenciaPrevia = $habilidades[0]['resistencia'];
                    
                    $sql = "UPDATE personajes SET cash = cash - $coste, energia = energia-$agotamiento, agilidad = agilidad + $mejoraPrincipalMedia/personajes.agilidad, resistencia = resistencia + $mejoraSecundariaMedia/personajes.resistencia, accion = ADDTIME(NOW(), '0:30:0') WHERE id='$id'";
                    $stmt = $db->query($sql);
                    
                    //INFORME DE ENTRENAMIENTO
                    $sql = "SELECT agilidad,resistencia FROM personajes WHERE id='$id'";
                    $stmt = $db->query($sql);
                    $habilidades = $stmt->fetchAll();
                    
                    $agilidadPosterior = $habilidades[0]['agilidad'];
                    $resistenciaPosterior = $habilidades[0]['resistencia'];
                    
                    $mejoraAgilidad = round($agilidadPosterior - $agilidadPrevia, 2, PHP_ROUND_HALF_DOWN);
                    $mejoraResistencia = round($resistenciaPosterior - $resistenciaPrevia, 2, PHP_ROUND_HALF_DOWN);
                    
                    $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$id','Mejora de Habilidad','¡Wow, qué hambre me ha entrado después de hacer tantos trucos! He mejorado $mejoraAgilidad puntos de Agilidad y también $mejoraResistencia puntos de Resistencia.','entrenamiento.png')";
                    $db->query($sql);
                }
                else{
                    $box = "Necesito algo para apostar en el juego del H.O.R.S.E.";
                }
            }else{
                $box = "Con este cansancio el mejor truco que puedo hacer es tumbarme, cerrar los ojos y aparecer en otro día.";
            }
            break;
            
        //FOGATA RITUAL ASDRÚBAL
        case 'ritual':
            $agotamiento = 30;
            $coste = 0;
            $estoyLibre = comprobarEspera();
            if($estoyLibre === 1){
                $puedoHacerlo = comprobarEnergia($agotamiento);
                if($puedoHacerlo === 1){
                    $puedoPagar = comprobarCoste($coste);
                    if($puedoPagar === 1){
                        //Consulta para hacer el informe
                        $sql = "SELECT espiritu FROM personajes WHERE id='$id'";
                        $stmt = $db->query($sql);
                        $habilidades = $stmt->fetchAll();

                        $espirituPrevia = $habilidades[0]['espiritu'];
                        
                        if($mistico === 1){
                            $sql = "UPDATE personajes SET cash = cash-$coste, energia = energia-$agotamiento, espiritu = espiritu + $mejoraPrincipalMuyAlta*2/personajes.espiritu, accion = ADDTIME(NOW(), '1:0:0') WHERE id='$id'";
                            $stmt = $db->query($sql);
                        }
                        else{
                            $sql = "UPDATE personajes SET cash = cash - $coste, energia = energia-$agotamiento, espiritu = espiritu + $mejoraPrincipalMuyAlta/personajes.espiritu, accion = ADDTIME(NOW(), '1:0:0') WHERE id='$id'";
                            $stmt = $db->query($sql);
                        }
                        //INFORME DE ENTRENAMIENTO
                        $sql = "SELECT espiritu FROM personajes WHERE id='$id'";
                        $stmt = $db->query($sql);
                        $habilidades = $stmt->fetchAll();

                        $espirituPosterior = $habilidades[0]['espiritu'];

                        $mejoraEspiritu = round($espirituPosterior - $espirituPrevia, 2, PHP_ROUND_HALF_DOWN);
                        

                        $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$id','Mejora de Habilidad','Me siento en algo más de tranquilidad ahora. He mejorado $mejoraEspiritu puntos de Espíritu.','rezo.png')";
                        $db->query($sql);
                    }
                    else{
                        $box = "Alguna moneda necesito para echar de ofrenda.";
                    }
                }else{
                    $box = "No tengo energía para controlar el ritual. Como entre ahí, algún espíritu maligno podría poseer mi cuerpo.";
                }
            }
            else{
                $box = "Aún no he descansado de mi ultima acción";
            }
            break; 
        //PARROQUIA DE CAÑAMARES
        case 'plegaria':
            $agotamiento = 10;
            $coste = 5;
            $estoyLibre = comprobarEspera();
            if($estoyLibre === 1){
                $puedoHacerlo = comprobarEnergia($agotamiento);
                if($puedoHacerlo === 1){
                    $puedoPagar = comprobarCoste($coste);
                    if($puedoPagar === 1){
                        //Consulta para hacer el informe
                        $sql = "SELECT espiritu FROM personajes WHERE id='$id'";
                        $stmt = $db->query($sql);
                        $habilidades = $stmt->fetchAll();

                        $espirituPrevia = $habilidades[0]['espiritu'];
                        
                        if($mistico === 1){
                            $sql = "UPDATE personajes SET cash = cash-$coste, energia = energia-$agotamiento, espiritu = espiritu + $mejoraPrincipalMuyBaja*2/personajes.espiritu, accion = ADDTIME(NOW(), '0:5:0') WHERE id='$id'";
                            $stmt = $db->query($sql);
                        }
                        else{
                            $sql = "UPDATE personajes SET cash = cash - $coste, energia = energia-$agotamiento, espiritu = espiritu + $mejoraPrincipalMuyBaja/personajes.espiritu, accion = ADDTIME(NOW(), '0:5:0') WHERE id='$id'";
                            $stmt = $db->query($sql);
                        }
                        //INFORME DE ENTRENAMIENTO
                        $sql = "SELECT espiritu FROM personajes WHERE id='$id'";
                        $stmt = $db->query($sql);
                        $habilidades = $stmt->fetchAll();

                        $espirituPosterior = $habilidades[0]['espiritu'];

                        $mejoraEspiritu = round($espirituPosterior - $espirituPrevia, 2, PHP_ROUND_HALF_DOWN);
                        

                        $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$id','Mejora de Habilidad','Me siento en algo más de tranquilidad ahora. He mejorado $mejoraEspiritu puntos de Espíritu.','rezo.png')";
                        $db->query($sql);
                    }
                    else{
                        $box = "Alguna moneda necesito para echar de ofrenda.";
                    }
                }else{
                    $box = "No tengo fuerzas. Como entre ahí, me quedo sopa en un banco.";
                }
            }
            else{
                $box = "Aún no he descansado de mi ultima acción";
            }
            break; 
            
        case 'tragoVino':
            $coste = 40;
            $mejoraSalud = 10;
            $puedoPagar = comprobarCoste($coste);
            if($puedoPagar === 1){
                $sql = "UPDATE personajes SET salud = CASE WHEN salud + '$mejoraSalud' > 100 THEN 100 ELSE salud + '$mejoraSalud' END, cash = cash-$coste WHERE id='$id'";
                $stmt = $db->query($sql);
            }
            else{
                $box = "No puedo pagarme el trago de Vino";
            }
            break;
            
        case 'guarroAsao':
            $coste = 150;
            $mejoraSalud = 50;
            $puedoPagar = comprobarCoste($coste);
            if($puedoPagar === 1){
                $sql = "UPDATE personajes SET salud = CASE WHEN salud + '$mejoraSalud' > 100 THEN 100 ELSE salud + '$mejoraSalud' END, cash = cash-$coste WHERE id='$id'";
                $stmt = $db->query($sql);
            }
            else{
                $box = "No me quedan monedas suficientes";
            }
            break;
        //Cultura Multicines Ortega 
        case 'misionCine':
            $sql = "SELECT * FROM progresos WHERE idP='$id' AND idM='2'";
            $stmt = $db->query($sql);
            $result = $stmt->fetchAll();
            
            if(isset($result[0])){ //Si ya tengo comenzada la mision
                if($result[0]['completada']==='0'){
                    //Compruebo en que etapa me encuentro ahora mismo
                    $etapaActual = $result[0]['progreso'];
                    if($etapaActual === '1'){ //Si estoy en la 1a etapa, debo entregar una Bobina de Pelicula
                        //Ver Objetos que llevo desequipados
                        $objetosDesequipados = objetosDesequipados();
                        foreach($objetosDesequipados as $cadaObjeto){
                            if($cadaObjeto['id'] === '921'){//Si es una bobina de pelicula, la elimino y recojo recompensa y progreso en la mision a la siguiente etapa y notifico mensaje mision
                                //VER QUE SLOT QUEDA LIBRE EN EL INVENTARIO
                                $sql = "SELECT inventario.* FROM inventario JOIN objetos ON inventario.idO = objetos.id WHERE inventario.idP = '$id' AND inventario.slot > 7 AND inventario.idO = '921'";
                                $stmt = $db->query($sql);
                                $resultado = $stmt->fetchAll();
                                $slotLibre = $resultado[0]['slot'];

                                //BORRAR EL OBJETO VENDIDO
                                $sql = "UPDATE inventario SET idO='0' WHERE (idP='$id' AND slot = '$slotLibre')";
                                $db->query($sql);

                                //Recojo Recompensa: +400exp
                                $sql = "UPDATE personajes SET experiencia = experiencia + 400 WHERE id = '$id'";
                                $db->query($sql);

                                //Completo la Mision
                                $sql = "UPDATE progresos SET completada = 1 WHERE idP = '$id' AND idM = '2'";
                                $db->query($sql);

                                //Genero un informe de Mision Cumplida
                                $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$id','Misión Cumplida','¡Has completado la Misión <i>Pánico en el Cine</i>!<br>Al entregar esa Bobina de Película, el operario se echa a tus brazos agradecido y como recompensa te invita a proyectar juntos la película que acabáis de recuperar. Te acomodas en la butaca, saboreas las crujientes palomitas y por fín la pantalla se ilumina con 6 letras vistosas: \"EUROEL\". Por el altavoz alguien narra lo que estás viendo en pantalla: \"Euroel. En C/Cisneros 22. Suministros Electricos. EUROEL\". Parece una interesante tienda, la apuntaré en mi mapa para visitarla más tarde.<br>Ganas +400 EXP. ¡Bien hecho!','etapa.png')";
                                $db->query($sql);

                                //Comprobar si subo de nivel
                                $sql = "SELECT nivel FROM personajes WHERE id='$id'";
                                $stmt = $db->query($sql);
                                $personaje = $stmt->fetchAll();
                                $nuevoNivel = comprobarSuboNivel($id);
                                if($nuevoNivel != $personaje[0]['nivel'] ){ //sube de nivel
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
                                    //Generar mensaje del informe de la subida de nivel
                                    $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$id','Subiste de Nivel','¡Enhorabuena! Acabas de subir a Nivel $nuevoNivel. <br> Obtienes $avances Avances para mejorar habilidades en la ventana de Personaje.','subirNivel.png')";
                                    $db->query($sql);
                                }

                                break;

                            }
                            else{
                                $box = "Aún no he encontrado esa <i>Bobina de Película</i>, debe estar aquí cerca.";
                            }
                        }
                    }
                    else{
                        $box = "Ya completaste esta misión.";
                    }
                }
                
            }
            else{
                //Insertar la Mision en el registro de Misiones
                $sql = "INSERT INTO progresos (idP,idM,progreso,completada) VALUES('$id','2','1','0')";
                $db->query($sql);
            }
                
            break;
        
        case 'verPeli':
            $agotamiento = 10;
            $coste = 40;
            $puedoHacerlo = comprobarEnergia($agotamiento);
            if($puedoHacerlo === 1){
                $puedoPagar = comprobarCoste($coste);
                if($puedoPagar === 1){
                    //Consulta para hacer el informe
                    $sql = "SELECT ingenio,percepcion FROM personajes WHERE id='$id'";
                    $stmt = $db->query($sql);
                    $habilidades = $stmt->fetchAll();
                    
                    $ingenioPrevio = $habilidades[0]['ingenio'];
                    $percepcionPrevia = $habilidades[0]['percepcion'];
                    $sql = "UPDATE personajes SET cash = cash - $coste, energia = energia-$agotamiento, ingenio = ingenio + $mejoraSecundariaMedia/personajes.ingenio, percepcion = percepcion + $mejoraPrincipalMedia/personajes.percepcion, accion = ADDTIME(NOW(), '0:30:0') WHERE id='$id'";
                    $stmt = $db->query($sql);
                    
                    //INFORME DE ENTRENAMIENTO
                    $sql = "SELECT ingenio, percepcion FROM personajes WHERE id='$id'";
                    $stmt = $db->query($sql);
                    $habilidades = $stmt->fetchAll();
                    
                    $ingenioPosterior = $habilidades[0]['ingenio'];
                    $percepcionPosterior = $habilidades[0]['percepcion'];
                    
                    $mejoraIngenio = round($ingenioPosterior - $ingenioPrevio, 2, PHP_ROUND_HALF_DOWN);
                    $mejoraPercepcion = round($percepcionPosterior - $percepcionPrevia, 2, PHP_ROUND_HALF_DOWN);
                    
                    $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$id','Mejora de Habilidad','¡Peliculón!. He mejorado $mejoraPercepcion puntos de Percepción y también $mejoraIngenio puntos de Ingenio.','cultura.png')";
                    $db->query($sql);
                }
                else{
                    $box = "Necesito más monedas para comprar el ticket";
                }
            }else{
                $box = "Tengo poca energía, lo mismo me quedo sopa en la butaca.";
            }
            break;
            
        case 'rebuscar':
            $tengoIluminacion = comprobarIluminacion();
            if($tengoIluminacion === 1){
                //Voy a encontrar un objeto y voy a notificarselo
                $rand = rand(0, 5);
                if($rand === 0 || $rand === 1){ //No encuentro nada mas que pelusas y restos de palomitas
                    //Genero un informe de Rebuscar
                    $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$id','Rebuscar','¡Mmeh! Tras pasar 10 Minutos gateando entre las butacas lo único que he conseguido ha sido llenarme la ropa de pelusas y restos de palomitas. No he encontrado nada de interés esta vez.','rebuscar.png')";
                    $db->query($sql);
                }
                elseif($rand === 2 || $rand === 3){ //Encuentro dinero
                    //Genero un informe de Rebuscar
                    $cantidad = rand(20,80);
                    $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$id','Rebuscar','¡Anda! Alguien ha perdido su cambio por aquí. Obtengo $cantidad monedas.','rebuscar.png')";
                    $db->query($sql);
                    
                    $sql = "UPDATE personajes SET cash = cash + $cantidad WHERE id='$id'";
                    $db->query($sql);
                }
                elseif($rand === 4){ //Encuentro chocolatina derretida
                    $mensajeObjeto = ' ¡Me la llevo!';
                    //Miro que tenga algun slot libre en el inventario
                    $slotDondeGuardo = comprobarSlotLibre();
                    if($slotDondeGuardo === -1){
                        $mensajeObjeto = " No puedo llevarme el botín porque mi inventario está lleno.";
                    }
                    else{
                        //AÑADIR AL INVENTARIO
                        $idObjetoObtenido = $obj[$objetoObtenido]['id'];
                        $sql = "UPDATE inventario SET idO = '920' WHERE idP='$id' AND slot = '$slotDondeGuardo'";
                        $db->query($sql);
                    }
                    //Genero un informe de Rebuscar
                    $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$id','Rebuscar','¡Puaj! Una chocolatina derretida. $mensajeObjeto','rebuscar.png')";
                    $db->query($sql);
                }
                elseif($rand === 5){ //ENCUENTRO LA BOBINA DE PELICULA
                    $mensajeObjeto = ' ¡Me la llevo!';
                    //Miro que tenga algun slot libre en el inventario
                    $slotDondeGuardo = comprobarSlotLibre();
                    if($slotDondeGuardo === -1){
                        $mensajeObjeto = " No puedo llevarme el botín porque mi inventario está lleno.";
                    }
                    else{
                        //AÑADIR AL INVENTARIO
                        $idObjetoObtenido = $obj[$objetoObtenido]['id'];
                        $sql = "UPDATE inventario SET idO = '921' WHERE idP='$id' AND slot = '$slotDondeGuardo'";
                        $db->query($sql);
                    }
                    //Genero un informe de Rebuscar
                    $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$id','Rebuscar','¡¿Y esto?! Parece una bobina de película antigua, como las que salen en las películas. $mensajeObjeto','rebuscar.png')";
                    $db->query($sql);
                }
                $sql = "UPDATE personajes SET accion= ADDTIME(NOW(), '0:10:0') WHERE id='$id'";
                $stmt = $db->query($sql);
                
            }
            else{
                $box = "Necesito llevar algo para iluminar. Está muy oscuro.";
            }
            break;
            
        //TERRI. CRIBA DE ORO
        case 'misionTerri':
            $sql = "SELECT * FROM progresos WHERE idP='$id' AND idM='5'";
            $stmt = $db->query($sql);
            $result = $stmt->fetchAll();
            
            if(isset($result[0])){ //Si ya tengo comenzada la mision
                if($result[0]['completada']==='0'){
                    //Compruebo en que etapa me encuentro ahora mismo
                    $etapaActual = $result[0]['progreso'];
                    if($etapaActual === '1'){ //Si estoy en la 1a etapa, debo entregar 150 monedas para el Ramo de Flores
                        $coste = 150;
                        $puedoPagar = comprobarCoste($coste);
                        if($puedoPagar === 1){
                            //Hago el Pago y Recojo Recompensa: +100exp
                            $sql = "UPDATE personajes SET cash = cash - 150, experiencia = experiencia + 100 WHERE id = '$id'";
                            $db->query($sql);

                            //Actualizo la mision a Etapa 2
                            $sql = "UPDATE progresos SET progreso = 2 WHERE idP = '$id' AND idM = '5'";
                            $db->query($sql);

                            //Genero un informe de Mision Cumplida
                            $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$id','Misión Cumplida','¡Has completado la Etapa 1 de la misión <i>Pico y Pala</i>!<br>Al prestar ese dinero, tu compañero ya puede comprar un Ramo de Flores bien bonito para su ligue. ¡Espero que la chica no sea alérgica!<br>Ganas +100 EXP. ¡Bien hecho!','etapa.png')";
                            $db->query($sql);
                        }
                        else{
                            $box = "No tengo dinero. Estoy friendo los huevos con saliva...";
                        }
                    }
                    elseif($etapaActual === '2'){ //Si estoy en la 2a etapa, debo entregar un conjunto elegante
                        //Ver Objetos que llevo desequipados
                        $objetosDesequipados = objetosDesequipados();
                        foreach($objetosDesequipados as $cadaObjeto){
                            if($cadaObjeto['id'] === '208'){//Si es un conjunto elegante, la elimino y recojo recompensa y progreso en la mision a la siguiente etapa y notifico mensaje mision
                                //VER QUE SLOT QUEDA LIBRE EN EL INVENTARIO
                                $sql = "SELECT inventario.* FROM inventario JOIN objetos ON inventario.idO = objetos.id WHERE inventario.idP = '$id' AND inventario.slot > 7 AND inventario.idO = '208'";
                                $stmt = $db->query($sql);
                                $resultado = $stmt->fetchAll();
                                $slotLibre = $resultado[0]['slot'];

                                //BORRAR EL OBJETO VENDIDO
                                $sql = "UPDATE inventario SET idO='0' WHERE (idP='$id' AND slot = '$slotLibre')";
                                $db->query($sql);

                                //Recojo Recompensa: +200exp
                                $sql = "UPDATE personajes SET experiencia = experiencia + 200 WHERE id = '$id'";
                                $db->query($sql);

                                //Actualizo la mision a Etapa 3
                                $sql = "UPDATE progresos SET progreso = 3 WHERE idP = '$id' AND idM = '5'";
                                $db->query($sql);

                                //Genero un informe de Mision Cumplida
                                $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$id','Misión Cumplida','¡Has completado la Etapa 2 de la misión <i>Pico y Pala</i>!<br>Al entregar esa ropa elegante, tu compañero se viste para la ocasión como un galán en vez de como un gañán. Ahora ya está listo para ir con la chica que le gusta.<br>Ganas +200 EXP. ¡Bien hecho!','etapa.png')";
                                $db->query($sql);

                                //Comprobar si subo de nivel
                                $sql = "SELECT nivel FROM personajes WHERE id='$id'";
                                $stmt = $db->query($sql);
                                $personaje = $stmt->fetchAll();
                                $nuevoNivel = comprobarSuboNivel($id);
                                if($nuevoNivel != $personaje[0]['nivel'] ){ //sube de nivel
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
                                    //Generar mensaje del informe de la subida de nivel
                                    $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$id','Subiste de Nivel','¡Enhorabuena! Acabas de subir a Nivel $nuevoNivel. <br> Obtienes $avances Avances para mejorar habilidades en la ventana de Personaje.','subirNivel.png')";
                                    $db->query($sql);
                                }

                                break;

                            }
                            else{
                                $box = "Pues no llevo ahora mismo ninguna ropa elegante en la mochila.";
                            }
                        }
                        
                    }
                    elseif($etapaActual === '3'){ //Si estoy en la 3a etapa, debo ahora trabajar 1H y ya completo la mision
                        $estoyLibre = comprobarEspera();
                        if($estoyLibre === 1){
                            //Trabajar durante 1 HORA, completar mision, recibir recompensa y emitir notificacion
                            $sql = "UPDATE personajes SET accion= ADDTIME(NOW(), '0:59:59') WHERE id='$id'";
                            $stmt = $db->query($sql);
                            
                            //Recojo Recompensa: +300exp
                            $sql = "UPDATE personajes SET experiencia = experiencia + 300 WHERE id = '$id'";
                            $db->query($sql);

                            //Completar mision
                            $sql = "UPDATE progresos SET completada = 1 WHERE idP = '$id' AND idM = '5'";
                            $db->query($sql);

                            //Genero un informe de Mision Cumplida
                            $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$id','Misión Cumplida','¡Has completado la Misión <i>Pico y Pala</i>!<br>Al cambiar el turno de trabajo con tu compañero, le has permitido cumplir su sueño de poder ir en busca de su enana.<br>Ganas +300 EXP. ¡Bien hecho!','etapa.png')";
                            $db->query($sql);

                            //Comprobar si subo de nivel
                            $sql = "SELECT nivel FROM personajes WHERE id='$id'";
                            $stmt = $db->query($sql);
                            $personaje = $stmt->fetchAll();
                            $nuevoNivel = comprobarSuboNivel($id);
                            if($nuevoNivel != $personaje[0]['nivel'] ){ //sube de nivel
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
                                //Generar mensaje del informe de la subida de nivel
                                $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$id','Subiste de Nivel','¡Enhorabuena! Acabas de subir a Nivel $nuevoNivel. <br> Obtienes $avances Avances para mejorar habilidades en la ventana de Personaje.','subirNivel.png')";
                                $db->query($sql);
                            }
                        }
                        else{
                            $box = "Aún no estoy libre de mi última acción.";
                        }
                        
                    }
                    else{
                        $box = "Ya completaste esta misión.";
                    }
                }
                
            }
            else{
                //Insertar la Mision en el registro de Misiones y Generar un informe
                $sql = "INSERT INTO progresos (idP,idM,progreso,completada) VALUES('$id','5','1','0')";
                $db->query($sql);
                
                $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$id','Misión Aceptada','Acabas de aceptar la misión <i>Pico y Pala</i>.<br>Busca a tu compañero en la Escombrera para que te cuente más detalles.','subirNivel.png')";
                $db->query($sql);
            }
                
            break;
        
        case 'escombrera':
            
            //Voy a encontrar un objeto y voy a notificarselo
            $rand = rand(0, 15);
            if($rand >= 0 && $rand <=3){ //No encuentro nada mas que arena y grava
                //Genero un informe de Rebuscar
                $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$id','Rebuscar','¡Mmeh! Tras pasar 10 Minutos removiendo arena y grava, lo único que he conseguido ha sido llenarme la ropa de polvo y barro. Esto no lo podré meter así en la lavadora. No he encontrado nada de interés esta vez.','rebuscar.png')";
                $db->query($sql);
            }
            elseif($rand >=4 && $rand <= 7){ //Encuentro dinero
                //Genero un informe de Rebuscar
                $cantidad = rand(5,20);
                $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$id','Rebuscar','¡Anda! Alguien ha debido perder su dinero del desayuno aquí, está semienterrado. Obtengo $cantidad monedas.','rebuscar.png')";
                $db->query($sql);
                    
                $sql = "UPDATE personajes SET cash = cash + $cantidad WHERE id='$id'";
                $db->query($sql);
            }
            elseif($rand >=8 && $rand <= 10){ //Encuentro chocolatina derretida
                $mensajeObjeto = ' ¡Me la llevo!';
                //Miro que tenga algun slot libre en el inventario
                $slotDondeGuardo = comprobarSlotLibre();
                if($slotDondeGuardo === -1){
                    $mensajeObjeto = " No puedo llevarme el botín porque mi inventario está lleno.";
                }
                else{
                    //AÑADIR AL INVENTARIO
                    $idObjetoObtenido = $obj[$objetoObtenido]['id'];
                    $sql = "UPDATE inventario SET idO = '920' WHERE idP='$id' AND slot = '$slotDondeGuardo'";
                    $db->query($sql);
                }
                //Genero un informe de Rebuscar
                $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$id','Rebuscar','¡Puaj! Una chocolatina llena de hormigas. $mensajeObjeto','rebuscar.png')";
                $db->query($sql);
            }
            elseif($rand >=11 && $rand <= 12){ //Encuentro pepita de oro
                $mensajeObjeto = ' ¡Me la llevo!';
                //Miro que tenga algun slot libre en el inventario
                $slotDondeGuardo = comprobarSlotLibre();
                if($slotDondeGuardo === -1){
                    $mensajeObjeto = " No puedo llevarme el botín porque mi inventario está lleno.";
                }
                else{
                    //AÑADIR AL INVENTARIO
                    $idObjetoObtenido = $obj[$objetoObtenido]['id'];
                    $sql = "UPDATE inventario SET idO = '926' WHERE idP='$id' AND slot = '$slotDondeGuardo'";
                    $db->query($sql);
                }
                //Genero un informe de Rebuscar
                $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$id','Rebuscar','¡Eeeeh! ¡Algo que brilla! Mientras voy cribando rezo para que no sea otra lata de cerveza oxidada y.... ¡Premio! esta vez es una <i>Pepita de Oro</i>.','rebuscar.png')";
                $db->query($sql);
            }
            elseif($rand >=13 && $rand <= 14){ //Encuentro pico de minero
                $mensajeObjeto = ' ¡Me lo llevo!';
                //Miro que tenga algun slot libre en el inventario
                $slotDondeGuardo = comprobarSlotLibre();
                if($slotDondeGuardo === -1){
                    $mensajeObjeto = " No puedo llevarme el botín porque mi inventario está lleno.";
                }
                else{
                    //AÑADIR AL INVENTARIO
                    $idObjetoObtenido = $obj[$objetoObtenido]['id'];
                    $sql = "UPDATE inventario SET idO = '308' WHERE idP='$id' AND slot = '$slotDondeGuardo'";
                    $db->query($sql);
                    
                    //Genero un informe de Reliquia Encontrada
                    $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$id','Reliquia Encontrada','Encontrar algún objeto valioso en la Criba ya es suerte, así que imagínate la alegría que da encontrarse un <i>Pico de Minero</i>, toda una Reliquia símbolo del pasado de Puertollano.','reliquia.png')";
                    $db->query($sql);
                }
                //Genero un informe de Rebuscar
                $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$id','Rebuscar','¡No me digas que eso es lo que creo que es! Cribas, cribas, cribas y... obtienes un <i>Pico de Minero</i>, toda una Reliquia símbolo del pasado de Puertollano.','rebuscar.png')";
                $db->query($sql);
            }
            elseif($rand === 15){ //ENCUENTRO EL TROZO 'A' DEL MAPA
                $mensajeObjeto = ' ¡Me lo llevo!';
                //Miro que tenga algun slot libre en el inventario
                $slotDondeGuardo = comprobarSlotLibre();
                if($slotDondeGuardo === -1){
                    $mensajeObjeto = " No puedo llevarme el botín porque mi inventario está lleno.";
                }
                else{
                    //AÑADIR AL INVENTARIO
                    $idObjetoObtenido = $obj[$objetoObtenido]['id'];
                    $sql = "UPDATE inventario SET idO = '922' WHERE idP='$id' AND slot = '$slotDondeGuardo'";
                    $db->query($sql);
                
                    //Genero un informe de Rebuscar
                    $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$id','Rebuscar','¡TOMA YA! ¡Un mapa del Tesoro! O bueno, lo que queda de él. Es un papelujo lleno de polvo, pero mira lo que tiene dibujado. Debe ser muy valioso. \"','rebuscar.png')";
                    $db->query($sql);
                }
            }
            $sql = "UPDATE personajes SET accion= ADDTIME(NOW(), '0:10:0') WHERE id='$id'";
            $stmt = $db->query($sql);
            
            break;
        // MISION 3: BAR UN ALTO
        case 'misionUnAlto':
            $sql = "SELECT * FROM progresos WHERE idP='$id' AND idM='3'";
            $stmt = $db->query($sql);
            $result = $stmt->fetchAll();
            
            if(isset($result[0])){ //Si ya tengo comenzada la mision
                if($result[0]['completada']==='0'){
                    //Compruebo en que etapa me encuentro ahora mismo
                    $etapaActual = $result[0]['progreso'];
                    if($etapaActual === '1'){ //Si estoy en la 1a etapa, debo reunirme en Los Arcos (Abulagar)
                        comprobarZona1Barrio3();
                        
                            //Recojo Recompensa: +100exp
                            $sql = "UPDATE personajes SET experiencia = experiencia + 100 WHERE id = '$id'";
                            $db->query($sql);
                            
                            //Aumento el Progreso de Mision a 2
                            $sql = "UPDATE progresos SET progreso = 2 WHERE idP = '$id' AND idM = '3'";
                            $db->query($sql);
                            
                            //Genero un informe de Mision Cumplida
                            $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$id','Misión Cumplida','¡Has completado la Etapa 1 de la Misión <i>Hogar, dulce hogar</i>!<br>Al escoltar al viajero hasta El Abulagar, ganas +100 EXP. ¡Bien hecho! Vuelve a hablar con él para continuar con la misión.','etapa.png')";
                            $db->query($sql);
                            
                            //Comprobar si subo de nivel
                            $sql = "SELECT nivel FROM personajes WHERE id='$id'";
                            $stmt = $db->query($sql);
                            $personaje = $stmt->fetchAll();
                            $nuevoNivel = comprobarSuboNivel($id);
                            if($nuevoNivel != $personaje[0]['nivel'] ){ //sube de nivel
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
                                //Generar mensaje del informe de la subida de nivel
                                $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$id','Subiste de Nivel','¡Enhorabuena! Acabas de subir a Nivel $nuevoNivel. <br> Obtienes $avances Avances para mejorar habilidades en la ventana de Personaje.','subirNivel.png')";
                                $db->query($sql);
                            }
                        
                    }
                    
                    if($etapaActual === '2'){ //Si estoy en la 2a etapa, debo reunirme en El Asador del Club (El Poblado)
                        comprobarZona1Barrio3();
                        
                            //Recojo Recompensa: +100exp
                            $sql = "UPDATE personajes SET experiencia = experiencia + 100 WHERE id = '$id'";
                            $db->query($sql);
                            
                            //Aumento el Progreso de Mision a 3
                            $sql = "UPDATE progresos SET progreso = 3 WHERE idP = '$id' AND idM = '3'";
                            $db->query($sql);
                            
                            //Genero un informe de Mision Cumplida
                            $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$id','Misión Cumplida','¡Has completado la Etapa 2 de la Misión <i>Hogar, dulce hogar</i>!<br>Al escoltar al viajero hasta El Poblado, ganas +100 EXP. ¡Bien hecho! Vuelve a hablar con él para continuar con la misión.','etapa.png')";
                            $db->query($sql);
                            
                            //Comprobar si subo de nivel
                            $sql = "SELECT nivel FROM personajes WHERE id='$id'";
                            $stmt = $db->query($sql);
                            $personaje = $stmt->fetchAll();
                            $nuevoNivel = comprobarSuboNivel($id);
                            if($nuevoNivel != $personaje[0]['nivel'] ){ //sube de nivel
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
                                //Generar mensaje del informe de la subida de nivel
                                $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$id','Subiste de Nivel','¡Enhorabuena! Acabas de subir a Nivel $nuevoNivel. <br> Obtienes $avances Avances para mejorar habilidades en la ventana de Personaje.','subirNivel.png')";
                                $db->query($sql);
                            }
                        
                    }
                    
                    if($etapaActual === '3'){ //Si estoy en la 3a etapa, debo reunirme en Lounge Bar La Plaza (Salesianos)
                        comprobarZona1Barrio3();
                        
                            //Recojo Recompensa: +100exp
                            $sql = "UPDATE personajes SET experiencia = experiencia + 100 WHERE id = '$id'";
                            $db->query($sql);
                            
                            //Aumento el Progreso de Mision a 4
                            $sql = "UPDATE progresos SET progreso = 4 WHERE idP = '$id' AND idM = '3'";
                            $db->query($sql);
                            
                            //Genero un informe de Mision Cumplida
                            $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$id','Misión Cumplida','¡Has completado la Etapa 3 de la Misión <i>Hogar, dulce hogar</i>!<br>Al escoltar al viajero hasta los Salesianos, ganas +100 EXP. ¡Bien hecho! Vuelve a hablar con él para continuar con la misión.','etapa.png')";
                            $db->query($sql);
                            
                            //Comprobar si subo de nivel
                            $sql = "SELECT nivel FROM personajes WHERE id='$id'";
                            $stmt = $db->query($sql);
                            $personaje = $stmt->fetchAll();
                            $nuevoNivel = comprobarSuboNivel($id);
                            if($nuevoNivel != $personaje[0]['nivel'] ){ //sube de nivel
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
                                //Generar mensaje del informe de la subida de nivel
                                $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$id','Subiste de Nivel','¡Enhorabuena! Acabas de subir a Nivel $nuevoNivel. <br> Obtienes $avances Avances para mejorar habilidades en la ventana de Personaje.','subirNivel.png')";
                                $db->query($sql);
                            }
                        
                    }
                    
                    if($etapaActual === '4'){ //Si estoy en la 4a etapa, debo reunirme en Restaurante Casa Ginés (Terri)
                        comprobarZona1Barrio3();
                        
                            //Recojo Recompensa: +100exp
                            $sql = "UPDATE personajes SET experiencia = experiencia + 100 WHERE id = '$id'";
                            $db->query($sql);
                            
                            //Aumento el Progreso de Mision a 5
                            $sql = "UPDATE progresos SET progreso = 5 WHERE idP = '$id' AND idM = '3'";
                            $db->query($sql);
                            
                            //Genero un informe de Mision Cumplida
                            $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$id','Misión Cumplida','¡Has completado la Etapa 4 de la Misión <i>Hogar, dulce hogar</i>!<br>Al escoltar al viajero hasta el Terri, ganas +100 EXP. ¡Bien hecho! Vuelve a hablar con él para continuar con la misión.','etapa.png')";
                            $db->query($sql);
                            
                            //Comprobar si subo de nivel
                            $sql = "SELECT nivel FROM personajes WHERE id='$id'";
                            $stmt = $db->query($sql);
                            $personaje = $stmt->fetchAll();
                            $nuevoNivel = comprobarSuboNivel($id);
                            if($nuevoNivel != $personaje[0]['nivel'] ){ //sube de nivel
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
                                //Generar mensaje del informe de la subida de nivel
                                $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$id','Subiste de Nivel','¡Enhorabuena! Acabas de subir a Nivel $nuevoNivel. <br> Obtienes $avances Avances para mejorar habilidades en la ventana de Personaje.','subirNivel.png')";
                                $db->query($sql);
                            }
                        
                    }
                    
                    if($etapaActual === '5'){ //Si estoy en la 4a etapa, debo reunirme en Cafeteria Doctor Limon (El Pino)
                        comprobarZona1Barrio3();
                        
                            //Recojo Recompensa: +100exp
                            $sql = "UPDATE personajes SET experiencia = experiencia + 100 WHERE id = '$id'";
                            $db->query($sql);
                            
                            //Recojo Recompensa: Macuto de Acampar
                            $slotLibre = comprobarSlotLibre();
                            if($slotLibre >=0){
                                
                                $sql = "UPDATE inventario SET idO = 512 WHERE idP='$id' AND slot = '$slotLibre'";
                                $db->query($sql);
                                $mensajeObjeto = "";
                            }
                            else{
                                $mensajeObjeto = "No tengo espacio libre";
                            }
                            $sql = "UPDATE personajes SET experiencia = experiencia + 100 WHERE id = '$id'";
                            $db->query($sql);
                            
                            //Completo la Mision
                            $sql = "UPDATE progresos SET completada = 1 WHERE idP = '$id' AND idM = '3'";
                            $db->query($sql);
                            
                            //Genero un informe de Mision Cumplida
                            $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$id','Misión Cumplida','¡Has completado la Misión <i>Hogar, dulce hogar</i>!<br>Al escoltar al viajero hasta la Cafetería del Doctor Limón, ganas +100 EXP y un Macuto de Acampar que te ayudará a llevar un montón de objetos en el inventario. $mensajeObjeto','etapa.png')";
                            $db->query($sql);
                            
                            //Comprobar si subo de nivel
                            $sql = "SELECT nivel FROM personajes WHERE id='$id'";
                            $stmt = $db->query($sql);
                            $personaje = $stmt->fetchAll();
                            $nuevoNivel = comprobarSuboNivel($id);
                            if($nuevoNivel != $personaje[0]['nivel'] ){ //sube de nivel
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
                                //Generar mensaje del informe de la subida de nivel
                                $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$id','Subiste de Nivel','¡Enhorabuena! Acabas de subir a Nivel $nuevoNivel. <br> Obtienes $avances Avances para mejorar habilidades en la ventana de Personaje.','subirNivel.png')";
                                $db->query($sql);
                            }
                        
                    }
                }
            }
            else{ //Si NO tengo comenzada la mision
                //Insertarla en la lista de progresos
                $sql = "INSERT INTO progresos (idP,idM,progreso,completada) VALUES('$id','3','1','0')";
                $db->query($sql);
                
                //Generar mensaje del informe de la subida de nivel
                $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$id','Misión Aceptada','Acabas de aceptar la misión \"Hogar, dulce hogar\". Dirígete al Bar Un Alto en el Camino, situado en Asdrúbal, para obtener más información.','misionAceptada.png')";
                $db->query($sql);
            }
            break;
            
        //BAR EL BOMBA
        case 'misionBomba':
            $sql = "SELECT * FROM progresos WHERE idP='$id' AND idM='6'";
            $stmt = $db->query($sql);
            $result = $stmt->fetchAll();
            
            if(isset($result[0])){ //Si ya tengo comenzada la mision
                if($result[0]['completada']==='0'){
                //Compruebo en que etapa me encuentro ahora mismo
                $etapaActual = $result[0]['progreso'];
                if($etapaActual === '1'){ //Si estoy en la 1a etapa, debo entregar una MASCARA BOMBA
                    //Ver Objetos que llevo desequipados
                    $objetosDesequipados = objetosDesequipados();
                    foreach($objetosDesequipados as $cadaObjeto){
                        if($cadaObjeto['id'] === '103'){//Si es una MASCARA BOMBA, la elimino y recojo recompensa y completo la mision y notifico mensaje mision
                            //VER QUE SLOT QUEDA LIBRE EN EL INVENTARIO
                            $sql = "SELECT inventario.* FROM inventario JOIN objetos ON inventario.idO = objetos.id WHERE inventario.idP = '$id' AND inventario.slot > 7 AND inventario.idO = '103'";
                            $stmt = $db->query($sql);
                            $resultado = $stmt->fetchAll();
                            $slotLibre = $resultado[0]['slot'];

                            //BORRAR EL OBJETO VENDIDO
                            $sql = "UPDATE inventario SET idO='0' WHERE (idP='$id' AND slot = '$slotLibre')";
                            $db->query($sql);
                            
                            //Recojo Recompensa: +300exp
                            $sql = "UPDATE personajes SET experiencia = experiencia + 300 WHERE id = '$id'";
                            $db->query($sql);
                            
                            //Recojo Recompensa: Recetario de Cocina
                            $sql = "UPDATE inventario SET idO = 309 WHERE (idP='$id' AND slot = '$slotLibre')";
                            $db->query($sql);
                            
                            //Completo la Mision
                            $sql = "UPDATE progresos SET completada = 1 WHERE idP = '$id' AND idM = '6'";
                            $db->query($sql);
                            
                            //Genero un informe de Mision Cumplida
                            $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$id','Misión Cumplida','¡Has completado la Misión <i>Mi preciado Tesoro</i>!<br>Al recuperar la Máscara Bomba del cocinero le devolviste un objeto de enorme valor sentimental.Ganas +300 EXP y como agradecimiento te entrega también su Recetario de Cocina Manchega, un raro ejemplar. ¡Bien hecho!','etapa.png')";
                            $db->query($sql);
                            
                            //Comprobar si subo de nivel
                            $sql = "SELECT nivel FROM personajes WHERE id='$id'";
                            $stmt = $db->query($sql);
                            $personaje = $stmt->fetchAll();
                            $nuevoNivel = comprobarSuboNivel($id);
                            if($nuevoNivel != $personaje[0]['nivel'] ){ //sube de nivel
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
                                //Generar mensaje del informe de la subida de nivel
                                $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$id','Subiste de Nivel','¡Enhorabuena! Acabas de subir a Nivel $nuevoNivel. <br> Obtienes $avances Avances para mejorar habilidades en la ventana de Personaje.','subirNivel.png')";
                                $db->query($sql);
                            }
                            
                            break;
                            
                        }
                        else{
                            $box = "No he encontrado aún tu Máscara Bomba, pero la traeré de vuelta.";
                        }
                    }
                    
                }
            }
            }
            else{
                //Insertar la Mision en el registro de Misiones
                $sql = "INSERT INTO progresos (idP,idM,progreso,completada) VALUES('$id','6','1','0')";
                $db->query($sql);
                
                $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$id','Misión Aceptada','Aceptaste la misión <i>Mi preciado Tesoro</i>. Vuelve a la Cocina del Bar El Bomba, situado en Gran Capitán, para conocer más detalles.','misionAceptada.png')";
                $db->query($sql);
            }
            break;
        case 'roscaChurros':
            $coste = 25;
            $mejoraSalud = 3;
            $puedoPagar = comprobarCoste($coste);
            if($puedoPagar === 1){
                $sql = "UPDATE personajes SET salud = CASE WHEN salud + '$mejoraSalud' > 100 THEN 100 ELSE salud + '$mejoraSalud' END, cash = cash-$coste WHERE id='$id'";
                $stmt = $db->query($sql);
            }
            else{
                $box = "No llevo dinero pa churros.";
            }
            break; 
        case 'migasManchegas':
            $coste = 25;
            $mejoraSalud = 3;
            $puedoPagar = comprobarCoste($coste);
            if($puedoPagar === 1){
                $sql = "UPDATE personajes SET salud = CASE WHEN salud + '$mejoraSalud' > 100 THEN 100 ELSE salud + '$mejoraSalud' END, cash = cash-$coste WHERE id='$id'";
                $stmt = $db->query($sql);
            }
            else{
                $box = "¿Me lo dejas a fiar? Vale, vale, ya conozco la salida.";
            }
            break;
        case 'bombaRellena':
            $coste = 25;
            $mejoraSalud = 3;
            $puedoPagar = comprobarCoste($coste);
            if($puedoPagar === 1){
                $sql = "UPDATE personajes SET salud = CASE WHEN salud + '$mejoraSalud' > 100 THEN 100 ELSE salud + '$mejoraSalud' END, cash = cash-$coste WHERE id='$id'";
                $stmt = $db->query($sql);
            }
            else{
                $box = "Quizá otro día, cuando me toque la lotería.";
            }
            break;
        //MISION COLEGIO SEVERO OCHOA QUE ESCANDALO
        case 'misionColegio':
            $sql = "SELECT * FROM progresos WHERE idP='$id' AND idM='7'";
            $stmt = $db->query($sql);
            $result = $stmt->fetchAll();
            
            if(isset($result[0])){ //Si ya tengo comenzada la mision
                if($result[0]['completada']==='0'){
                //Compruebo en que etapa me encuentro ahora mismo
                $etapaActual = $result[0]['progreso'];
                if($etapaActual === '1'){ //Si estoy en la 1a etapa, debo superar un 60% Popularidad en el Hospital(id 155)
                    //Ver mi popularidad en 155
                    $miPop = getPopularidadSpot(155);
                    if($miPop > 60){ //Si supero a Ashley T.
   
                        //Recojo Recompensa: +250exp +250monedas
                        $sql = "UPDATE personajes SET experiencia = experiencia + 250, cash = cash + 250 WHERE id = '$id'";
                        $db->query($sql);
                            
                        //Aumento el Progreso de Mision a 2
                        $sql = "UPDATE progresos SET progreso = 2 WHERE idP = '$id' AND idM = '7'";
                        $db->query($sql);
                            
                        //Genero un informe de Mision Cumplida
                        $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$id','Misión Cumplida','¡Has completado la Etapa 1 de la Misión <i>Qué Escándalo</i>!<br>Al superar la Popularidad de Ashley T. entras automáticamente en el selecto grupo de Ashleys ocupando la cuarta posición.<br>Ganas +250 EXP y las Ashleys te premian con +250 monedas por tu ingreso al club. ¡Bien hecho! Vuelve a hablar con ellas para continuar escalando posiciones.','etapa.png')";
                        $db->query($sql);
                            
                            //Comprobar si subo de nivel
                            $sql = "SELECT nivel FROM personajes WHERE id='$id'";
                            $stmt = $db->query($sql);
                            $personaje = $stmt->fetchAll();
                            $nuevoNivel = comprobarSuboNivel($id);
                            if($nuevoNivel != $personaje[0]['nivel'] ){ //sube de nivel
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
                                //Generar mensaje del informe de la subida de nivel
                                $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$id','Subiste de Nivel','¡Enhorabuena! Acabas de subir a Nivel $nuevoNivel. <br> Obtienes $avances Avances para mejorar habilidades en la ventana de Personaje.','subirNivel.png')";
                                $db->query($sql);
                            }
                    }
                    else{
                        $box = "Todavía no soy lo suficiente Popular en la zona de Las 600 como para desafiar a Ashley T.";
                    }
                    
                }
                elseif($etapaActual === '2'){ //Si estoy en la 2a etapa, debo superar un 60% en Gran Capitan (22)
                    //Ver mi popularidad en 22
                    $miPop = getPopularidadSpot(22);
                    if($miPop > 60){ //Si supero a Ashley Q.
   
                        //Recojo Recompensa: +500exp +500monedas
                        $sql = "UPDATE personajes SET experiencia = experiencia + 500, cash = cash + 500 WHERE id = '$id'";
                        $db->query($sql);
                            
                        //Aumento el Progreso de Mision a 3
                        $sql = "UPDATE progresos SET progreso = 3 WHERE idP = '$id' AND idM = '7'";
                        $db->query($sql);
                            
                        //Genero un informe de Mision Cumplida
                        $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$id','Misión Cumplida','¡Has completado la Etapa 2 de la Misión <i>Qué Escándalo</i>!<br>Cerraste toda la boca a Ashley Q. superándole en popularidad. Escalas en el selecto grupo de Ashleys ocupando ahora la tercera posición.<br>Ganas +500 EXP y las Ashleys te premian con +500 monedas por tu ascenso dentro del club. ¡Bien hecho! Vuelve a hablar con ellas para continuar escalando posiciones.','etapa.png')";
                        $db->query($sql);
                            
                            //Comprobar si subo de nivel
                            $sql = "SELECT nivel FROM personajes WHERE id='$id'";
                            $stmt = $db->query($sql);
                            $personaje = $stmt->fetchAll();
                            $nuevoNivel = comprobarSuboNivel($id);
                            if($nuevoNivel != $personaje[0]['nivel'] ){ //sube de nivel
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
                                //Generar mensaje del informe de la subida de nivel
                                $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$id','Subiste de Nivel','¡Enhorabuena! Acabas de subir a Nivel $nuevoNivel. <br> Obtienes $avances Avances para mejorar habilidades en la ventana de Personaje.','subirNivel.png')";
                                $db->query($sql);
                            }
                    }
                    else{
                        $box = "Aún no puedo competir en Popularidad contra Ashley Q. en la zona de Gran Capitán";
                    }
                    
                }
                elseif($etapaActual === '3'){ //Si estoy en la 1a etapa, debo superar un 75% en Recinto Ferial (id 175)
                    //Ver mi popularidad en 175
                    $miPop = getPopularidadSpot(175);
                    if($miPop > 75){ //Si supero a Ashley B.
   
                        //Recojo Recompensa: +750exp +750monedas
                        $sql = "UPDATE personajes SET experiencia = experiencia + 750, cash = cash + 750 WHERE id = '$id'";
                        $db->query($sql);
                            
                        //Aumento el Progreso de Mision a 4
                        $sql = "UPDATE progresos SET progreso = 4 WHERE idP = '$id' AND idM = '7'";
                        $db->query($sql);
                            
                        //Genero un informe de Mision Cumplida
                        $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$id','Misión Cumplida','¡Has completado la Etapa 3 de la Misión <i>Qué Escándalo</i>!<br>La pobre Ashley B. todavía sigue llorando desde que se enteró que le arrebataste la Popularidad. Ya estas en segunda posición dentro del selecto grupo de Ashleys.<br>Ganas +750 EXP y las Ashleys te premian con +750 monedas por llegar a la vicepresidencia. ¡Bien hecho! Vuelve a hablar con ellas para asaltar el Primer Puesto.','etapa.png')";
                        $db->query($sql);
                            
                            //Comprobar si subo de nivel
                            $sql = "SELECT nivel FROM personajes WHERE id='$id'";
                            $stmt = $db->query($sql);
                            $personaje = $stmt->fetchAll();
                            $nuevoNivel = comprobarSuboNivel($id);
                            if($nuevoNivel != $personaje[0]['nivel'] ){ //sube de nivel
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
                                //Generar mensaje del informe de la subida de nivel
                                $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$id','Subiste de Nivel','¡Enhorabuena! Acabas de subir a Nivel $nuevoNivel. <br> Obtienes $avances Avances para mejorar habilidades en la ventana de Personaje.','subirNivel.png')";
                                $db->query($sql);
                            }
                    }
                    else{
                        $box = "Mi Popularidad aún no da para discutirle el puesto a Ashley B. en la zona del Recinto Ferial.";
                    } 
                }
                elseif($etapaActual === '4'){
                    //Ver mi popularidad en 85
                    $miPop = getPopularidadSpot(85);
                    if($miPop > 75){ //Si supero a Ashley A.
   
                        //Recojo Recompensa: +1000exp +1000monedas
                        $sql = "UPDATE personajes SET experiencia = experiencia + 1000, cash = cash + 1000 WHERE id = '$id'";
                        $db->query($sql);
                            
                        //Completo la Mision
                        $sql = "UPDATE progresos SET completada = 1 WHERE idP = '$id' AND idM = '7'";
                        $db->query($sql);
                            
                        //Genero un informe de Mision Cumplida
                        $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$id','Misión Cumplida','¡Has completado la Misión <i>Qué Escándalo</i>!<br>Pateaste el culo de Ashley A y de todas ellas, superándoles en popularidad. Escalas a la cima del selecto grupo de Ashleys ocupando ahora la primera posición.<br>Ganas +1000 EXP y las Ashleys te premian con +1000 monedas por tu coronación. ¡Bien hecho!','etapa.png')";
                        $db->query($sql);
                            
                            //Comprobar si subo de nivel
                            $sql = "SELECT nivel FROM personajes WHERE id='$id'";
                            $stmt = $db->query($sql);
                            $personaje = $stmt->fetchAll();
                            $nuevoNivel = comprobarSuboNivel($id);
                            if($nuevoNivel != $personaje[0]['nivel'] ){ //sube de nivel
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
                                //Generar mensaje del informe de la subida de nivel
                                $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$id','Subiste de Nivel','¡Enhorabuena! Acabas de subir a Nivel $nuevoNivel. <br> Obtienes $avances Avances para mejorar habilidades en la ventana de Personaje.','subirNivel.png')";
                                $db->query($sql);
                            }
                    }
                    else{
                        $box = "Tengo que currarme aún más mi Popularidad si quiero quitar la corona a Ashley Armbruster.";
                    }
                }
            }
            else{
                $box = "Ya completaste esta misión.";
            }
            }
            else{
                //Insertar la Mision en el registro de Misiones
                $sql = "INSERT INTO progresos (idP,idM,progreso,completada) VALUES('$id','7','1','0')";
                $db->query($sql);
                
                //Envio mensaje de Aceptar Mision
                $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$id','Misión Aceptada','¡Has aceptado la Misión <i>Qué Escándalo</i>!<br>Tendrás que superar la Popularidad de esas niñas engreídas para demostrar quién manda en Puertollano.','etapa.png')";
                $db->query($sql);
            }
                
            break;
            
        // EVENTO ALTAR DE SACRIFICIOS   
        case 'misionMaimonides':
            $sql = "SELECT * FROM progresos WHERE idP='$id' AND idM='1'";
            $stmt = $db->query($sql);
            $result = $stmt->fetchAll();
            
            if(isset($result[0])){ //Si ya tengo comenzada la mision
                if($result[0]['completada']==='0'){
                //Compruebo en que etapa me encuentro ahora mismo
                $etapaActual = $result[0]['progreso'];
                if($etapaActual === '1'){ //Si estoy en la 1a etapa, debo entregar una chocolatina
                    //Ver Objetos que llevo desequipados
                    $objetosDesequipados = objetosDesequipados();
                    foreach($objetosDesequipados as $cadaObjeto){
                        if($cadaObjeto['id'] === '920'){//Si es una chocolatina derretida, la elimino y recojo recompensa y progreso en la mision a la siguiente etapa y notifico mensaje mision
                            //VER QUE SLOT QUEDA LIBRE EN EL INVENTARIO
                            $sql = "SELECT inventario.* FROM inventario JOIN objetos ON inventario.idO = objetos.id WHERE inventario.idP = '$id' AND inventario.slot > 7 AND inventario.idO = '920'";
                            $stmt = $db->query($sql);
                            $resultado = $stmt->fetchAll();
                            $slotLibre = $resultado[0]['slot'];

                            //BORRAR EL OBJETO VENDIDO
                            $sql = "UPDATE inventario SET idO='0' WHERE (idP='$id' AND slot = '$slotLibre')";
                            $db->query($sql);
                            
                            //Recojo Recompensa: +100exp
                            $sql = "UPDATE personajes SET experiencia = experiencia + 100 WHERE id = '$id'";
                            $db->query($sql);
                            
                            //Aumento el Progreso de Mision a 2
                            $sql = "UPDATE progresos SET progreso = 2 WHERE idP = '$id' AND idM = '1'";
                            $db->query($sql);
                            
                            //Genero un informe de Mision Cumplida
                            $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$id','Misión Cumplida','¡Has completado la Etapa 1 de la Misión <i>El Proverbio de Maimónides</i>!<br>Al entregar esa Chocolatina al Mendigo, ganas +100 EXP. ¡Bien hecho! Vuelve a hablar con él para continuar con la misión.','etapa.png')";
                            $db->query($sql);
                            
                            //Comprobar si subo de nivel
                            $sql = "SELECT nivel FROM personajes WHERE id='$id'";
                            $stmt = $db->query($sql);
                            $personaje = $stmt->fetchAll();
                            $nuevoNivel = comprobarSuboNivel($id);
                            if($nuevoNivel != $personaje[0]['nivel'] ){ //sube de nivel
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
                                //Generar mensaje del informe de la subida de nivel
                                $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$id','Subiste de Nivel','¡Enhorabuena! Acabas de subir a Nivel $nuevoNivel. <br> Obtienes $avances Avances para mejorar habilidades en la ventana de Personaje.','subirNivel.png')";
                                $db->query($sql);
                            }
                            
                            break;
                            
                        }
                        else{
                            $box = "¡Oops, me comí todas las <i>chocolatinas</i>! No tengo ninguna más para darle.";
                        }
                    }
                    
                }
                elseif($etapaActual === '2'){ //Si estoy en la 1a etapa, debo entregar un abrigo
                    //Ver Objetos que llevo desequipados
                    $objetosDesequipados = objetosDesequipados();
                    foreach($objetosDesequipados as $cadaObjeto){
                        if($cadaObjeto['id'] === '207'){//Si es un Abrigo Polar, lo elimino y recojo recompensa y progreso en la mision a la siguiente etapa y notifico mensaje mision
                            //VER QUE SLOT QUEDA LIBRE EN EL INVENTARIO
                            $sql = "SELECT inventario.* FROM inventario JOIN objetos ON inventario.idO = objetos.id WHERE inventario.idP = '$id' AND inventario.slot > 7 AND inventario.idO = '207'";
                            $stmt = $db->query($sql);
                            $resultado = $stmt->fetchAll();
                            $slotLibre = $resultado[0]['slot'];

                            //BORRAR EL OBJETO VENDIDO
                            $sql = "UPDATE inventario SET idO='0' WHERE (idP='$id' AND slot = '$slotLibre')";
                            $db->query($sql);
                            
                            //Recojo Recompensa: +100exp
                            $sql = "UPDATE personajes SET experiencia = experiencia + 200 WHERE id = '$id'";
                            $db->query($sql);
                            
                            //Aumento el Progreso de Mision a 2
                            $sql = "UPDATE progresos SET progreso = 3 WHERE idP = '$id' AND idM = '1'";
                            $db->query($sql);
                            
                            //Genero un informe de Mision Cumplida
                            $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$id','Misión Cumplida','¡Has completado la Etapa 2 de la Misión <i>El Proverbio de Maimónides</i>!<br>Al entregar ese Abrigo Polar al Mendigo, ganas +200 EXP. ¡Bien hecho! Vuelve a hablar con él para continuar con la misión.','etapa.png')";
                            $db->query($sql);
                            
                            //Comprobar si subo de nivel
                            $sql = "SELECT nivel FROM personajes WHERE id='$id'";
                            $stmt = $db->query($sql);
                            $personaje = $stmt->fetchAll();
                            $nuevoNivel = comprobarSuboNivel($id);
                            if($nuevoNivel != $personaje[0]['nivel'] ){ //sube de nivel
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
                                //Generar mensaje del informe de la subida de nivel
                                $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$id','Subiste de Nivel','¡Enhorabuena! Acabas de subir a Nivel $nuevoNivel. <br> Obtienes $avances Avances para mejorar habilidades en la ventana de Personaje.','subirNivel.png')";
                                $db->query($sql);
                            }
                            
                            break;
                            
                        }
                        else{
                            $box = "No tengo ese <i>Abrigo Polar</i> que dice. ¡¿Tienes idea de cuánto cuesta uno de esos?!";
                        }
                    }
                    
                }
                elseif($etapaActual === '3'){ //Si estoy en la 1a etapa, debo entregar una Caña de Pescar
                    //Ver Objetos que llevo desequipados
                    $objetosDesequipados = objetosDesequipados();
                    foreach($objetosDesequipados as $cadaObjeto){
                        if($cadaObjeto['id'] === '307'){//Si es una Caña de Pesca, lo elimino y recojo recompensa y progreso en la mision a la siguiente etapa y notifico mensaje mision
                            //VER QUE SLOT QUEDA LIBRE EN EL INVENTARIO
                            $sql = "SELECT inventario.* FROM inventario JOIN objetos ON inventario.idO = objetos.id WHERE inventario.idP = '$id' AND inventario.slot > 7 AND inventario.idO = '307'";
                            $stmt = $db->query($sql);
                            $resultado = $stmt->fetchAll();
                            $slotLibre = $resultado[0]['slot'];

                            //BORRAR EL OBJETO VENDIDO
                            $sql = "UPDATE inventario SET idO='0' WHERE (idP='$id' AND slot = '$slotLibre')";
                            $db->query($sql);
                            
                            //EN ESE LUGAR PONER EL OBJETO RECOMPENSA
                            $sql = "UPDATE inventario SET idO='302' WHERE (idP='$id' AND slot = '$slotLibre')";
                            $db->query($sql);
                            
                            //COMO DICHO OBJETO ES UNA RELIQUIA, INSERTARLO EN coleccionismo Y GENERAR UNA NOTIFICACION
                            $sql = "INSERT INTO coleccionismo (idP,idO,imagen) VALUES('$id','302','302.png')";
                            $db->query($sql);
                            
                            $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$id','Reliquia Encontrada','¡Has conseguido el Callejero de Puertollano, ¡toda una reliquia! Tiene todas las calles y sitios de interés, así que te será de enorme ayuda a la hora de desplazarte más rápido entre zonas.', 'reliquia.png')";
                            $db->query($sql);
                            
                            //Recojo Recompensa: +400exp
                            $sql = "UPDATE personajes SET experiencia = experiencia + 400 WHERE id = '$id'";
                            $db->query($sql);
                            
                            //Completo la Mision
                            $sql = "UPDATE progresos SET completada = 1 WHERE idP = '$id' AND idM = '1'";
                            $db->query($sql);
                            
                            //Genero un informe de Mision Cumplida
                            $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$id','Misión Cumplida','¡Has completado todas las etapas de la Misión <i>El Proverbio de Maimónides</i>!<br>Al entregar esa Caña de Pesca al Mendigo, ganas +400 EXP y como recompensa te regala un Callejero de Puertollano. ¡Bien hecho!','etapa.png')";
                            $db->query($sql);
                            
                            //Comprobar si subo de nivel
                            $sql = "SELECT nivel FROM personajes WHERE id='$id'";
                            $stmt = $db->query($sql);
                            $personaje = $stmt->fetchAll();
                            $nuevoNivel = comprobarSuboNivel($id);
                            if($nuevoNivel != $personaje[0]['nivel'] ){ //sube de nivel
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
                                //Generar mensaje del informe de la subida de nivel
                                $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$id','Subiste de Nivel','¡Enhorabuena! Acabas de subir a Nivel $nuevoNivel. <br> Obtienes $avances Avances para mejorar habilidades en la ventana de Personaje.','subirNivel.png')";
                                $db->query($sql);
                            }
                            
                            break;
                            
                        }
                        else{
                            $box = "Eso que llevo ahí no es una <i>Caña de Pesca</i>, es sólo que me alegro de verte.";
                        }
                    }
                    
                }
            }
            else{
                $box = "Ya completaste esta misión.";
            }
            }
            else{
                //Insertar la Mision en el registro de Misiones
                $sql = "INSERT INTO progresos (idP,idM,progreso,completada) VALUES('$id','1','1','0')";
                $db->query($sql);
            }
                
            break;
        
        case 'sacrificio':
            $costeSalud = 40;
            $tengoVida = comprobarSalud($costeSalud);
            if($tengoVida === 1){
                $mejoraEnergia = 20;
                $sql = "UPDATE personajes SET energia = CASE WHEN energia + '$mejoraEnergia' > 100 THEN 100 ELSE energia + '$mejoraEnergia' END, salud = salud-$costeSalud WHERE id='$id'";
                $stmt = $db->query($sql);
            }
            else{
                $box = "¡Ojo! Que puedo quedarme tieso ahí.";
            }
            break;
            
        case 'barraLibre':
            $costeSalud = 90;
            $tengoVida = comprobarSalud($costeSalud);
            if($tengoVida === 1){
                $mejoraEnergia = 50;
                $sql = "UPDATE personajes SET energia = CASE WHEN energia + '$mejoraEnergia' > 100 THEN 100 ELSE energia + '$mejoraEnergia' END, salud = salud-$costeSalud WHERE id='$id'";
                $stmt = $db->query($sql);
            }
            else{
                $box = "Me pides esto yendo a tope de Salud o me estás pidiendo morir ahí, eh?";
            }
            break;
        
        // FIESTAS DE LA BARRIADA EL ABULAGAR    
        case 'pregon':
            $sql = "SELECT * FROM popularidad WHERE idP='$id'";
            $stmt = $db->query($sql);
            $result = $stmt->fetchAll();
            
            foreach ($result as $cadaSpot){
                $mejoraPuntos = rand(0,10);
                $cadaSpotID = $cadaSpot['idS'];
                $sql = "UPDATE popularidad SET puntos = CASE WHEN puntos + '$mejoraPuntos' > 100 THEN 100 ELSE puntos + '$mejoraPuntos' END WHERE idP='$id' AND idS='$cadaSpotID'";
                $stmt = $db->query($sql);
            }
                //Ver mi nueva popularidad, actualizarla, meter el contador de tiempo de accion y Generar mensaje
            $sql = "SELECT AVG(puntos) FROM popularidad WHERE idP = '$id'";
            $stmt = $db->query($sql);
            $result = $stmt->fetchAll();

            $popularidadAVG = round($result[0]['AVG(puntos)'], 2, PHP_ROUND_HALF_DOWN);
            
            $sql = "UPDATE personajes SET popularidad = $popularidadAVG, accion= ADDTIME(NOW(), '0:30:0') WHERE id='$id'";
            $stmt = $db->query($sql);
            
            $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$id','Popularidad','El Pregón ha sido todo un éxito y los habitantes de todo Puertollano hablan mejor de mí ahora mismo.<br>Mi Popularidad asciende un poquito en cada zona de Puertollano. Tengo un $popularidadAVG% de valoración positiva.','popularidad.png')";
            $db->query($sql);
            header("location: ?page=mensajes");
                
            break;
        
        case 'chocolatada':
            $coste = 40;
            $mejoraSalud = 10;
            $puedoPagar = comprobarCoste($coste);
            if($puedoPagar === 1){
                $sql = "UPDATE personajes SET salud = CASE WHEN salud + '$mejoraSalud' > 100 THEN 100 ELSE salud + '$mejoraSalud' END, cash = cash-$coste WHERE id='$id'";
                $stmt = $db->query($sql);
            }
            else{
                $box = "No puedo pagarme el trago de Vino";
            }
            break;
            
        case 'postre':
            $coste = 150;
            $mejoraSalud = 50;
            $puedoPagar = comprobarCoste($coste);
            if($puedoPagar === 1){
                $sql = "UPDATE personajes SET salud = CASE WHEN salud + '$mejoraSalud' > 100 THEN 100 ELSE salud + '$mejoraSalud' END, cash = cash-$coste WHERE id='$id'";
                $stmt = $db->query($sql);
            }
            else{
                $box = "No me quedan monedas suficientes";
            }
            break;
        
        // Krater Rock City Concierto   
        case 'telonero':
            $sql = "SELECT * FROM popularidad WHERE idP='$id'";
            $stmt = $db->query($sql);
            $result = $stmt->fetchAll();
            
            foreach ($result as $cadaSpot){
                $mejoraPuntos = rand(0,10);
                $cadaSpotID = $cadaSpot['idS'];
                $sql = "UPDATE popularidad SET puntos = CASE WHEN puntos + '$mejoraPuntos' > 100 THEN 100 ELSE puntos + '$mejoraPuntos' END WHERE idP='$id' AND idS='$cadaSpotID'";
                $stmt = $db->query($sql);
            }
                //Ver mi nueva popularidad, actualizarla, meter el contador de tiempo de accion y Generar mensaje
            $sql = "SELECT AVG(puntos) FROM popularidad WHERE idP = '$id'";
            $stmt = $db->query($sql);
            $result = $stmt->fetchAll();

            $popularidadAVG = round($result[0]['AVG(puntos)'], 2, PHP_ROUND_HALF_DOWN);
            
            $sql = "UPDATE personajes SET popularidad = $popularidadAVG, accion= ADDTIME(NOW(), '0:30:0') WHERE id='$id'";
            $stmt = $db->query($sql);
            
            $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$id','Popularidad','Me llueven flashes y tangas. Cuando bajo del escenario me abro paso entre la multitud enfervorecida, firmando autógrafos y posando para los selfies. Al llegar a la puerta de mi camerino hay una periodista esperando para entrevistarme. Esto va a dar un subidón a mi Popularidad en todo Puertollano.<br>¡Un éxito! Ahora tengo un $popularidadAVG% de valoración positiva.','popularidad.png')";
            $db->query($sql);
            header("location: ?page=mensajes");
                
            break;
        
        case 'jarraCerveza':
            $coste = 40;
            $mejoraSalud = 10;
            $puedoPagar = comprobarCoste($coste);
            if($puedoPagar === 1){
                $sql = "UPDATE personajes SET salud = CASE WHEN salud + '$mejoraSalud' > 100 THEN 100 ELSE salud + '$mejoraSalud' END, cash = cash-$coste WHERE id='$id'";
                $stmt = $db->query($sql);
            }
            else{
                $box = "No puedo pagarme el trago de Vino";
            }
            break;
            
        case 'chupitos':
            $coste = 150;
            $mejoraSalud = 50;
            $puedoPagar = comprobarCoste($coste);
            if($puedoPagar === 1){
                $sql = "UPDATE personajes SET salud = CASE WHEN salud + '$mejoraSalud' > 100 THEN 100 ELSE salud + '$mejoraSalud' END, cash = cash-$coste WHERE id='$id'";
                $stmt = $db->query($sql);
            }
            else{
                $box = "No me quedan monedas suficientes";
            }
            break;
            
        //EVENTO: Maestre Trapichero
        case 'vinoSueño':
            $coste = 150;
            $mejoraEnergia = 50;
            $puedoPagar = comprobarCoste($coste);
            if($puedoPagar === 1){
                $sql = "UPDATE personajes SET energia = CASE WHEN energia + '$mejoraEnergia' > 100 THEN 100 ELSE energia + '$mejoraEnergia' END, cash = cash-$coste WHERE id='$id'";
                $stmt = $db->query($sql);
            }
            else{
                $box = "No me quedan monedas suficientes";
            }
            break;
            
        case 'lecheAmapola':
            $coste = 150;
            $mejoraEnergia = 100;
            $puedoPagar = comprobarCoste($coste);
            if($puedoPagar === 1){
                $sql = "UPDATE personajes SET energia = CASE WHEN energia + '$mejoraEnergia' > 100 THEN 100 ELSE energia + '$mejoraEnergia' END, cash = cash-$coste WHERE id='$id'";
                $stmt = $db->query($sql);
            }
            else{
                $box = "No me quedan monedas suficientes";
            }
            break;
        
        case 'bramidoDioses':
            $coste = 500;
            $puedoPagar = comprobarCoste($coste);
            if($puedoPagar === 1){
                $sql = "UPDATE personajes SET sexo = CASE WHEN personajes.sexo = 'Hombre' THEN 'Mujer' ELSE 'Hombre' END, cash = cash-$coste WHERE id='$id'";
                $stmt = $db->query($sql);
            }
            else{
                $box = "No me quedan monedas suficientes";
            }
            break;
        
        
        //TRABAJO: CORREDOR DE APUESTAS
        case 'qualy':
            $agotamiento = 10;
            $salario = 15;
            $estoyLibre = comprobarEspera();
            if($estoyLibre === 1){
                $puedoHacerlo = comprobarEnergia($agotamiento);
                if($puedoHacerlo === 1){
                        //Consulta para hacer el informe
                        $sql = "SELECT cash FROM personajes WHERE id='$id'";
                        $stmt = $db->query($sql);
                        $dinero = $stmt->fetchAll();

                        $cashPrevio = $dinero[0]['cash'];
                        //HACER EL PAGO
                        if($recaudador === 1){
                            $sql = "UPDATE personajes SET cash = cash+$salario*1.50, energia = energia-$agotamiento, accion = ADDTIME(NOW(), '0:15:0') WHERE id='$id'";
                            $stmt = $db->query($sql);
                        }
                        else{
                            $sql = "UPDATE personajes SET cash = cash+$salario, energia = energia-$agotamiento, accion = ADDTIME(NOW(), '0:15:0') WHERE id='$id'";
                            $stmt = $db->query($sql);
                        }
                        //GENERAR EL INFORME DE COBRO
                        $sql = "SELECT cash FROM personajes WHERE id='$id'";
                        $stmt = $db->query($sql);
                        $dinero = $stmt->fetchAll();

                        $cashPosterior = $dinero[0]['cash'];
                        
                        $mejoraCash = round($cashPosterior - $cashPrevio, 2, PHP_ROUND_HALF_DOWN);
                        

                        $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$id','Cobro','¡Aquí está el cobro por 15 minutos de duro trabajo! Ahora mi bolsillo pesa un poco más, exactamente $mejoraCash monedas más.','cobro.png')";
                        $db->query($sql);
                    
                }else{
                    $box = "¿Tú quieres que me muera ahí al sol? Mejor descansar un poco.";
                }
            }
            else{
                $box = "Aún no he descansado de mi ultima acción";
            }
            break; 
            
        case 'carrera':
            $agotamiento = 20;
            $salario = 40;
            $estoyLibre = comprobarEspera();
            if($estoyLibre === 1){
                $puedoHacerlo = comprobarEnergia($agotamiento);
                if($puedoHacerlo === 1){
                        //Consulta para hacer el informe
                        $sql = "SELECT cash FROM personajes WHERE id='$id'";
                        $stmt = $db->query($sql);
                        $dinero = $stmt->fetchAll();

                        $cashPrevio = $dinero[0]['cash'];
                        //HACER EL PAGO
                        if($recaudador === 1){
                            $sql = "UPDATE personajes SET cash = cash+$salario*1.50, energia = energia-$agotamiento, accion = ADDTIME(NOW(), '0:30:0') WHERE id='$id'";
                            $stmt = $db->query($sql);
                        }
                        else{
                            $sql = "UPDATE personajes SET cash = cash+$salario, energia = energia-$agotamiento, accion = ADDTIME(NOW(), '0:30:0') WHERE id='$id'";
                            $stmt = $db->query($sql);
                        }
                        //GENERAR EL INFORME DE COBRO
                        $sql = "SELECT cash FROM personajes WHERE id='$id'";
                        $stmt = $db->query($sql);
                        $dinero = $stmt->fetchAll();

                        $cashPosterior = $dinero[0]['cash'];
                        
                        $mejoraCash = round($cashPosterior - $cashPrevio, 2, PHP_ROUND_HALF_DOWN);
                        

                        $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$id','Cobro','¡Aquí está el cobro por 30 minutos de duro trabajo! Ahora mi bolsillo pesa un poco más, exactamente $mejoraCash monedas más.','cobro.png')";
                        $db->query($sql);
                    
                }else{
                    $box = "Uff.. no aguanto yo ahora mismo ahí fuera como no me tumbe antes un rato.";
                }
            }
            else{
                $box = "Aún no he descansado de mi ultima acción";
            }
            break;
            
        case 'series':
            $agotamiento = 40;
            $salario = 100;
            $estoyLibre = comprobarEspera();
            if($estoyLibre === 1){
                $puedoHacerlo = comprobarEnergia($agotamiento);
                if($puedoHacerlo === 1){
                        //Consulta para hacer el informe
                        $sql = "SELECT cash FROM personajes WHERE id='$id'";
                        $stmt = $db->query($sql);
                        $dinero = $stmt->fetchAll();

                        $cashPrevio = $dinero[0]['cash'];
                        //HACER EL PAGO
                        if($recaudador === 1){
                            $sql = "UPDATE personajes SET cash = cash+$salario*1.50, energia = energia-$agotamiento, accion = ADDTIME(NOW(), '1:0:0') WHERE id='$id'";
                            $stmt = $db->query($sql);
                        }
                        else{
                            $sql = "UPDATE personajes SET cash = cash+$salario, energia = energia-$agotamiento, accion = ADDTIME(NOW(), '1:0:0') WHERE id='$id'";
                            $stmt = $db->query($sql);
                        }
                        //GENERAR EL INFORME DE COBRO
                        $sql = "SELECT cash FROM personajes WHERE id='$id'";
                        $stmt = $db->query($sql);
                        $dinero = $stmt->fetchAll();

                        $cashPosterior = $dinero[0]['cash'];
                        
                        $mejoraCash = round($cashPosterior - $cashPrevio, 2, PHP_ROUND_HALF_DOWN);
                        

                        $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$id','Cobro','¡Aquí está el cobro por 1 hora de duro trabajo! Ahora mi bolsillo pesa un poco más, exactamente $mejoraCash monedas más.','cobro.png')";
                        $db->query($sql);
                    
                }else{
                    $box = "¿1 Hora? Con tan poca energía no aguantaría ahora mismo ni 1 Minuto.";
                }
            }
            else{
                $box = "Aún no he descansado de mi ultima acción";
            }
            break;
            
        //TRABAJO: EL MURO, GUARDIA DE LA NOCHE
        case 'guardiaNoche':
            $agotamiento = 10;
            $salario = 100;
            $estoyLibre = comprobarEspera();
            if($estoyLibre === 1){
                $puedoHacerlo = comprobarEnergia($agotamiento);
                if($puedoHacerlo === 1){
                        //Consulta para hacer el informe
                        $sql = "SELECT cash FROM personajes WHERE id='$id'";
                        $stmt = $db->query($sql);
                        $dinero = $stmt->fetchAll();

                        $cashPrevio = $dinero[0]['cash'];
                        //HACER EL PAGO
                        if($recaudador === 1){
                            $sql = "UPDATE personajes SET cash = cash+$salario*1.50, energia = energia-$agotamiento, accion = ADDTIME(NOW(), '1:0:0') WHERE id='$id'";
                            $stmt = $db->query($sql);
                        }
                        else{
                            $sql = "UPDATE personajes SET cash = cash+$salario, energia = energia-$agotamiento, accion = ADDTIME(NOW(), '1:0:0') WHERE id='$id'";
                            $stmt = $db->query($sql);
                        }
                        //GENERAR EL INFORME DE COBRO
                        $sql = "SELECT cash FROM personajes WHERE id='$id'";
                        $stmt = $db->query($sql);
                        $dinero = $stmt->fetchAll();

                        $cashPosterior = $dinero[0]['cash'];
                        
                        $mejoraCash = round($cashPosterior - $cashPrevio, 2, PHP_ROUND_HALF_DOWN);
                        

                        $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$id','Cobro','¡Aquí está el cobro por 1 hora de duro trabajo! Ahora mi bolsillo pesa un poco más, exactamente $mejoraCash monedas más.','cobro.png')";
                        $db->query($sql);
                    
                }else{
                    $box = "No tengo fuerzas. Como me quede dormido quizá me devoren los Salvajes del Norte.";
                }
            }
            else{
                $box = "Aún no he descansado de mi ultima acción";
            }
            break; 
        
        //HOTELES : DESCANSO ENERGIA
        case 'habitacionSantaEulalia':
            $coste = 50;
            $estoyLibre = comprobarEspera();
            if($estoyLibre === 1){
                $puedoPagar = comprobarCoste($coste);
                if($puedoPagar === 1){
                    $sql = "UPDATE personajes SET cash = cash-$coste, energia = 100, accion = ADDTIME(NOW(), '0:30:0') WHERE id='$id'";
                    $db->query($sql);
                }
                else{
                    $box = "No tengo dinero para pagar eso.";
                }
            }
            else{
                    $box = "Aún no he descansado de la ultima acción.";
                }
            break;
            
        case 'suiteSantaEulalia':
            $coste = 300;
            $puedoPagar = comprobarCoste($coste);
            $estoyLibre = comprobarEspera();
            if($estoyLibre === 1){
                if($puedoPagar === 1){
                    $sql = "UPDATE personajes SET cash = cash-$coste, energia = 100, accion = ADDTIME(NOW(), '0:5:0') WHERE id='$id'";
                    $db->query($sql);
                }
                else{
                    $box = "No tengo dinero para pagar eso.";
                }
            }
            else{
                $box = "Aún no he descansado de la última acción,";
            }
            break;
            
        case 'clasicoElPaisano':
            $coste = 50;
            $puedoPagar = comprobarCoste($coste);
            $estoyLibre = comprobarEspera();
            if($estoyLibre === 1){
                if($puedoPagar === 1){
                    //Consulta para hacer el informe
                    $sql = "SELECT estilo FROM personajes WHERE id='$id'";
                    $stmt = $db->query($sql);
                    $estilo = $stmt->fetchAll();

                    $estiloPrevio = $estilo[0]['estilo'];
                    
                    $sql = "UPDATE personajes SET cash = cash-$coste, estilo = estilo + $mejoraPrincipalMedia/personajes.estilo, accion = ADDTIME(NOW(), '0:15:0') WHERE id='$id'";
                    $db->query($sql);
                    
                    //GENERAR EL INFORME DE COBRO
                    $sql = "SELECT estilo FROM personajes WHERE id='$id'";
                    $stmt = $db->query($sql);
                    $estilo = $stmt->fetchAll();

                    $estiloPosterior = $estilo[0]['estilo'];
                        
                    $mejoraEstilo = round($estiloPosterior - $estiloPrevio, 2, PHP_ROUND_HALF_DOWN);
                    
                    $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$id','Mejora de Habilidad','¡Yeah! Qué obra de arte, me encanta el nuevo corte. Mi estilo sube $mejoraEstilo puntos.','estilo.png')";
                    $db->query($sql);
                }
                else{
                    $box = "No tengo dinero para pagarle al Hudy.";
                }
            }
            else{
                $box = "Aún no he descansado de la última acción,";
            }
            break;
        
        case 'hudyElPaisano':
            $coste = 200;
            $puedoPagar = comprobarCoste($coste);
            $estoyLibre = comprobarEspera();
            if($estoyLibre === 1){
                if($puedoPagar === 1){
                    //Consulta para hacer el informe
                    $sql = "SELECT estilo FROM personajes WHERE id='$id'";
                    $stmt = $db->query($sql);
                    $estilo = $stmt->fetchAll();

                    $estiloPrevio = $estilo[0]['estilo'];
                    $sql = "UPDATE personajes SET cash = cash-$coste, estilo = estilo + $mejoraPrincipalMuyAlta/personajes.estilo, accion = ADDTIME(NOW(), '0:30:0') WHERE id='$id'";
                    $db->query($sql);
                    
                    //GENERAR EL INFORME DE COBRO
                    $sql = "SELECT estilo FROM personajes WHERE id='$id'";
                    $stmt = $db->query($sql);
                    $estilo = $stmt->fetchAll();

                    $estiloPosterior = $estilo[0]['estilo'];
                        
                    $mejoraEstilo = round($estiloPosterior - $estiloPrevio, 2, PHP_ROUND_HALF_DOWN);
                    
                    $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$id','Mejora de Habilidad','¡Mi peinado es ahora el del mismísimo Hudy! Algún día contaré esto a mis nietos. Mi estilo sube $mejoraEstilo puntos.','estilo.png')";
                    $db->query($sql);
                }
                else{
                    $box = "No tengo dinero para pagarle al Hudy.";
                }
            }
            else{
                $box = "Aún no he descansado de la última acción,";
            }
            break;
            
        //CERRAJERIAS y EXPOLIADOR: ABRIR  
        case 'Cajita oxidada':
            $coste = 20;
            $puedoPagar = comprobarCoste($coste);
            if($puedoPagar === 1){
                
                //Calculo que objeto hay dentro (respetando el nivel)
                $sql = "SELECT * FROM objetos WHERE nivelMin <= '1'";
                $stmt = $db->query($sql);
                $objetosCandidatos = $stmt->fetchAll();
                
                $sql = "SELECT COUNT(*) FROM objetos WHERE (nivelMin <= '1' && nivelMin > '0')";
                $stmt = $db->query($sql);
                $cuenta = $stmt->fetchAll();
                $tope = $cuenta[0]['COUNT(*)']; //cantidad de objetos candidatos
                
                $indiceObjetoEncontrado = rand(0,$tope-1); //indice del objeto encontrado
                $objetoEncontrado = $objetosCandidatos[$indiceObjetoEncontrado]['id']; //id del objeto encontrado

                //Le paso el objeto encontrado al slot que ha quedado libre en el inventario
                $sql = "UPDATE inventario SET idO = '$objetoEncontrado' WHERE idP='$id' AND idO='900'";
                $stmt = $db->query($sql);
                
                //Actualizo el dinero
                $sql = "UPDATE personajes SET cash = cash - '$coste' WHERE id='$id'";
                $stmt = $db->query($sql);
                
                //GENERAR EL INFORME DE OBJETO ENCONTRADO
                $sql = "SELECT * FROM objetos WHERE id= '$objetoEncontrado'";
                $stmt = $db->query($sql);
                $resultado = $stmt->fetchAll();
                
                $nombreObjetoEncontrado = $resultado[0]['nombre'];
                
                $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$id','Cerrajería','El dependiente pasa largo rato mirando la caja bloqueada... parece estar pensando. Al fin entra a la trastienda a por las herramientas. Se escucha cómo pronuncia unas palabras mágicas ¡a la vez que saca una maza! Un instante después, la caja está abierta ante tus ojos. Consigues su contenido : $nombreObjetoEncontrado','cerrajeria.png')";
                $db->query($sql);
                
            }else{
                $box = "No tengo dinero para pagar eso.";
            }
            break;     
            
        case 'GCajita oxidada':
            $coste = 0;
            $puedoPagar = comprobarCoste($coste);
            if($puedoPagar === 1){
                
                //Calculo que objeto hay dentro (respetando el nivel)
                $sql = "SELECT * FROM objetos WHERE nivelMin <= '1'";
                $stmt = $db->query($sql);
                $objetosCandidatos = $stmt->fetchAll();
                
                $sql = "SELECT COUNT(*) FROM objetos WHERE (nivelMin <= '1' && nivelMin > '0')";
                $stmt = $db->query($sql);
                $cuenta = $stmt->fetchAll();
                $tope = $cuenta[0]['COUNT(*)']; //cantidad de objetos candidatos
                
                $indiceObjetoEncontrado = rand(0,$tope-1); //indice del objeto encontrado
                $objetoEncontrado = $objetosCandidatos[$indiceObjetoEncontrado]['id']; //id del objeto encontrado

                //Le paso el objeto encontrado al slot que ha quedado libre en el inventario
                $sql = "UPDATE inventario SET idO = '$objetoEncontrado' WHERE idP='$id' AND idO='900'";
                $stmt = $db->query($sql);
                
                //Actualizo el dinero
                $sql = "UPDATE personajes SET cash = cash - '$coste' WHERE id='$id'";
                $stmt = $db->query($sql);
                
                //GENERAR EL INFORME DE OBJETO ENCONTRADO
                $sql = "SELECT * FROM objetos WHERE id= '$objetoEncontrado'";
                $stmt = $db->query($sql);
                $resultado = $stmt->fetchAll();
                
                $nombreObjetoEncontrado = $resultado[0]['nombre'];
                
                $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$id','Cerrajería','El dependiente pasa largo rato mirando la caja bloqueada... parece estar pensando. Al fin entra a la trastienda a por las herramientas. Se escucha cómo pronuncia unas palabras mágicas ¡a la vez que saca una maza! Un instante después, la caja está abierta ante tus ojos. Consigues su contenido : $nombreObjetoEncontrado','cerrajeria.png')";
                $db->query($sql);
                
            }else{
                $box = "No tengo dinero para pagar eso.";
            }
            break;
         
        //Mascaras VENDEDOR DE MASCARAS
        case 'mascaraConejo':
            $coste = 1000;
            $puedoPagar = comprobarCoste($coste);
            $slotLibre = comprobarSlotLibre();
            if($puedoPagar === 1){
                if($slotLibre >=0){
                    $sql = "UPDATE personajes SET cash = cash - $coste WHERE id='$id'";
                    $db->query($sql); 
                    
                    $sql = "UPDATE inventario SET idO = 102 WHERE idP='$id' AND slot = '$slotLibre'";
                    $db->query($sql); 
                    
                }
                else{
                    $box = "No tengo espacio libre";
                }
                
            }
            else{
                $box = "No puedo pagar eso";
            }
            break;
        
        case 'mascaraBomba':
            $coste = 1000;
            $puedoPagar = comprobarCoste($coste);
            $slotLibre = comprobarSlotLibre();
            if($puedoPagar === 1){
                if($slotLibre >=0){
                    $sql = "UPDATE personajes SET cash = cash - $coste WHERE id='$id'";
                    $db->query($sql); 
                    
                    $sql = "UPDATE inventario SET idO = 103 WHERE idP='$id' AND slot = '$slotLibre'";
                    $db->query($sql);
                    
                }
                else{
                    $box = "No tengo espacio libre";
                }
                
            }
            else{
                $box = "No puedo pagar eso";
            }
            break;
            
        case 'mascaraMejora':
            $coste = 1000;
            $puedoPagar = comprobarCoste($coste);
            $slotLibre = comprobarSlotLibre();
            if($puedoPagar === 1){
                if($slotLibre >=0){
                    $sql = "UPDATE personajes SET cash = cash - $coste WHERE id='$id'";
                    $db->query($sql); 
                    
                    $sql = "UPDATE inventario SET idO = 104 WHERE idP='$id' AND slot = '$slotLibre'";
                    $db->query($sql); 
                    
                    //Reliquia
                    $sql = "INSERT INTO coleccionismo (idP, idO, imagen) VALUES ('$id', '104', '104.png')";
                    $db->query($sql); 
                    
                    $sql = "INSERT INTO mensajes (idP,asunto,contenido,imagen) VALUES('$id','Reliquia Encontrada','Al llegar a casa me pruebo esa máscara que compré hace un rato. Hago tonterías delante del espejo y... espera, hay algo grabado en su interior: \"Made in Hyrule\"','reliquiaEncontrada.png')";                    
                    $db->query($sql); 
                    
                }
                else{
                    $box = "No tengo espacio libre";
                }
                
            }
            else{
                $box = "No puedo pagar eso";
            }
            break;
        //Todo Para Tu Mascota   
        case 'Pez':
            $coste = 10;
            $puedoPagar = comprobarCoste($coste);
            $slotLibre = comprobarSlotLibre();
            if($puedoPagar === 1){
                if($slotLibre >=0){
                    $sql = "UPDATE personajes SET cash = cash - $coste WHERE id='$id'";
                    $db->query($sql); 
                    
                    $sql = "UPDATE inventario SET idO = 1 WHERE idP='$id' AND slot = '$slotLibre'";
                    $db->query($sql); 
                    
                }
                else{
                    $box = "No tengo espacio libre";
                }
                
            }
            else{
                $box = "No puedo pagar eso";
            }
            break;
        
        case 'Hámster':
            $coste = 30;
            $puedoPagar = comprobarCoste($coste);
            $slotLibre = comprobarSlotLibre();
            if($puedoPagar === 1){
                if($slotLibre >=0){
                    $sql = "UPDATE personajes SET cash = cash - $coste WHERE id='$id'";
                    $db->query($sql); 
                    
                    $sql = "UPDATE inventario SET idO = 2 WHERE idP='$id' AND slot = '$slotLibre'";
                    $db->query($sql); 
                    
                }
                else{
                    $box = "No tengo espacio libre";
                }
                
            }
            else{
                $box = "No puedo pagar eso";
            }
            break;
        
        case 'Gallo':
            $coste = 36;
            $puedoPagar = comprobarCoste($coste);
            $slotLibre = comprobarSlotLibre();
            if($puedoPagar === 1){
                if($slotLibre >=0){
                    $sql = "UPDATE personajes SET cash = cash - $coste WHERE id='$id'";
                    $db->query($sql); 
                    
                    $sql = "UPDATE inventario SET idO = 3 WHERE idP='$id' AND slot = '$slotLibre'";
                    $db->query($sql); 
                    
                }
                else{
                    $box = "No tengo espacio libre";
                }
                
            }
            else{
                $box = "No puedo pagar eso";
            }
            break;
        //PescaBass
        case 'cañaPesca':
            $coste = 130;
            $puedoPagar = comprobarCoste($coste);
            $slotLibre = comprobarSlotLibre();
            if($puedoPagar === 1){
                if($slotLibre >=0){
                    $sql = "UPDATE personajes SET cash = cash - $coste WHERE id='$id'";
                    $db->query($sql); 
                    
                    $sql = "UPDATE inventario SET idO = 307 WHERE idP='$id' AND slot = '$slotLibre'";
                    $db->query($sql); 
                    
                }
                else{
                    $box = "No tengo espacio libre";
                }
                
            }
            else{
                $box = "No puedo pagar eso";
            }
            break;
            
        case 'sombreroPescador':
            $coste = 100;
            $puedoPagar = comprobarCoste($coste);
            $slotLibre = comprobarSlotLibre();
            if($puedoPagar === 1){
                if($slotLibre >=0){
                    $sql = "UPDATE personajes SET cash = cash - $coste WHERE id='$id'";
                    $db->query($sql); 
                    
                    $sql = "UPDATE inventario SET idO = 109 WHERE idP='$id' AND slot = '$slotLibre'";
                    $db->query($sql); 
                    
                }
                else{
                    $box = "No tengo espacio libre";
                }
                
            }
            else{
                $box = "No puedo pagar eso";
            }
            break;
            
        case 'botasPescador':
            $coste = 100;
            $puedoPagar = comprobarCoste($coste);
            $slotLibre = comprobarSlotLibre();
            if($puedoPagar === 1){
                if($slotLibre >=0){
                    $sql = "UPDATE personajes SET cash = cash - $coste WHERE id='$id'";
                    $db->query($sql); 
                    
                    $sql = "UPDATE inventario SET idO = 407 WHERE idP='$id' AND slot = '$slotLibre'";
                    $db->query($sql); 
                    
                }
                else{
                    $box = "No tengo espacio libre";
                }
                
            }
            else{
                $box = "No puedo pagar eso";
            }
            break;
        
        //VENTAS
        case 'vPez':
            $sql = "SELECT precioVenta FROM objetos WHERE objetos.id = '1'";
            $stmt = $db->query($sql);
            $result = $stmt->fetchAll();
            $recibo = $result[0]['precioVenta'];
            
            $sql = "UPDATE personajes SET cash = cash+ '$recibo' WHERE id='$id'";
            $stmt = $db->query($sql);
            
            //VER QUE SLOT QUEDA LIBRE EN EL INVENTARIO
            $sql = "SELECT inventario.* FROM inventario JOIN objetos ON inventario.idO = objetos.id WHERE inventario.idP = '$id' AND inventario.slot > 7 AND inventario.idO = '1'";
            $stmt = $db->query($sql);
            $resultado = $stmt->fetchAll();
            $slotLibre = $resultado[0]['slot'];
            
            //BORRAR EL OBJETO VENDIDO
            $sql = "UPDATE inventario SET idO='0' WHERE (idP='$id' AND slot = '$slotLibre')";
            $stmt = $db->query($sql);
            break;
        
        case 'vHámster':
            $sql = "SELECT precioVenta FROM objetos WHERE objetos.id = '2'";
            $stmt = $db->query($sql);
            $result = $stmt->fetchAll();
            $recibo = $result[0]['precioVenta'];
            
            $sql = "UPDATE personajes SET cash = cash+ '$recibo' WHERE id='$id'";
            $stmt = $db->query($sql);
            
            //VER QUE SLOT QUEDA LIBRE EN EL INVENTARIO
            $sql = "SELECT inventario.* FROM inventario JOIN objetos ON inventario.idO = objetos.id WHERE inventario.idP = '$id' AND inventario.slot > 7 AND inventario.idO = '2'";
            $stmt = $db->query($sql);
            $resultado = $stmt->fetchAll();
            $slotLibre = $resultado[0]['slot'];
            
            //BORRAR EL OBJETO VENDIDO
            $sql = "UPDATE inventario SET idO='0' WHERE (idP='$id' AND slot = '$slotLibre')";
            $stmt = $db->query($sql);
            break;
        
        case 'vGallo':
            $sql = "SELECT precioVenta FROM objetos WHERE objetos.id = '3'";
            $stmt = $db->query($sql);
            $result = $stmt->fetchAll();
            $recibo = $result[0]['precioVenta'];
            
            $sql = "UPDATE personajes SET cash = cash+ '$recibo' WHERE id='$id'";
            $stmt = $db->query($sql);
            
            //VER QUE SLOT QUEDA LIBRE EN EL INVENTARIO
            $sql = "SELECT inventario.* FROM inventario JOIN objetos ON inventario.idO = objetos.id WHERE inventario.idP = '$id' AND inventario.slot > 7 AND inventario.idO = '3'";
            $stmt = $db->query($sql);
            $resultado = $stmt->fetchAll();
            $slotLibre = $resultado[0]['slot'];
            
            //BORRAR EL OBJETO VENDIDO
            $sql = "UPDATE inventario SET idO='0' WHERE (idP='$id' AND slot = '$slotLibre')";
            $stmt = $db->query($sql);
            break;
        
        case 'vZapatillas deportivas':
            $sql = "SELECT precioVenta FROM objetos WHERE objetos.id = '401'";
            $stmt = $db->query($sql);
            $result = $stmt->fetchAll();
            $recibo = $result[0]['precioVenta'];
            
            $sql = "UPDATE personajes SET cash = cash+ '$recibo' WHERE id='$id'";
            $stmt = $db->query($sql);
            
            //VER QUE SLOT QUEDA LIBRE EN EL INVENTARIO
            $sql = "SELECT inventario.* FROM inventario JOIN objetos ON inventario.idO = objetos.id WHERE inventario.idP = '$id' AND inventario.slot > 7 AND inventario.idO = '401'";
            $stmt = $db->query($sql);
            $resultado = $stmt->fetchAll();
            $slotLibre = $resultado[0]['slot'];
            
            //BORRAR EL OBJETO VENDIDO
            $sql = "UPDATE inventario SET idO='0' WHERE (idP='$id' AND slot = '$slotLibre')";
            $stmt = $db->query($sql);
            break;
            
        
        default :
            $box = 'Debes marcar una de las Opciones'. $box;
    }
    header("location: ?page=zona&message=$box");
}

if($_GET['action'] === "actualizarZona"){
    actualizarZona($_POST['casilla']);
}

if($_GET['action'] === "accionSpot"){
    accionSpot($_POST['cbox1']);
}

if($_GET['action'] === "actualizarDinero"){
    actualizarDinero($_POST['cbox1'], $_POST['cantidadDeposito'], $_POST['cantidadRetirada']);
}

if($_GET['action'] === "social"){
    social($_POST['cbox1'], $_POST['cantidadDonacion']);
}

?>