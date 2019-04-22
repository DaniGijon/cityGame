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

// Cuando realiza una accion en un checkbox de un spot
function accionSpot($box){
    include (__ROOT__.'/backend/comprobaciones.php');
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
        case 'quesadillas':
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
        case 'fajitas':
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
        case 'cafeConLeche':
            $coste = 2;
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
            $coste = 3;
            $mejoraSalud = 2;
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
        case 'pedaleo Suave':
            $agotamiento = 20;
            $coste = 5;
            $puedoHacerlo = comprobarEnergia($agotamiento);
            if($puedoHacerlo === 1){
                $puedoPagar = comprobarCoste($coste);
                if($puedoPagar === 1){
                
                    $sql = "UPDATE personajes SET cash = cash - $coste, energia = energia-$agotamiento, agilidad = agilidad + $mejoraSecundariaBaja/personajes.agilidad, resistencia = resistencia + $mejoraPrincipalBaja/personajes.resistencia WHERE id='$id'";
                    $stmt = $db->query($sql);
                }
                else{
                    $box = "No llevo dinero para inflar las ruedas.";
                }
            }else{
                $box = "¿Bici ahora? Uff... No puedo con mi alma. Mejor tomar un snack";
            }
            break;
            
        case 'pedaleoFuerte':
            $agotamiento = 40;
            $coste = 10;
            $puedoHacerlo = comprobarEnergia($agotamiento);
            if($puedoHacerlo === 1){
                $puedoPagar = comprobarCoste($coste);
                if($puedoPagar === 1){
                    $sql = "UPDATE personajes SET cash = cash - $coste, energia = energia-$agotamiento, agilidad = agilidad + $mejoraSecundariaMedia/personajes.agilidad, resistencia = resistencia + $mejoraPrincipalMedia/personajes.resistencia WHERE id='$id'";
                    $stmt = $db->query($sql);
                }
                else{
                    $box = "Necesito dinero para engrasar la cadena.";
                }
            }else{
                $box = "EH, EH, tranqui. No aguanto ese ritmo sin antes beber algo";
            }
            break;
        
        case 'indurain':
            $agotamiento = 60;
            $coste = 20;
            $puedoHacerlo = comprobarEnergia($agotamiento);
            if($puedoHacerlo === 1){
                $puedoPagar = comprobarCoste($coste);
                if($puedoPagar === 1){
                    $sql = "UPDATE personajes SET cash = cash - $coste, energia = energia-$agotamiento, agilidad = agilidad + $mejoraSecundariaAlta/personajes.agilidad, resistencia = resistencia + $mejoraPrincipalAlta/personajes.resistencia WHERE id='$id'";
                    $stmt = $db->query($sql);
                }
                else{
                    $box = "¿Y si me multan por ir tan rápido? Mejor reunir dinero antes";
                }
            }else{
                $box = "Pensándolo mejor... la única Vuelta que haré va a ser al sofá.";
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
                        if($mistico === 1){
                            $sql = "UPDATE personajes SET cash = cash-$coste, energia = energia-$agotamiento, espiritu = espiritu + $mejoraPrincipalMuyBaja*2/personajes.espiritu, accion = ADDTIME(NOW(), '0:5:0') WHERE id='$id'";
                            $stmt = $db->query($sql);
                        }
                        else{
                            $sql = "UPDATE personajes SET cash = cash - $coste, energia = energia-$agotamiento, espiritu = espiritu + $mejoraPrincipalMuyBaja/personajes.espiritu, accion = ADDTIME(NOW(), '0:5:0') WHERE id='$id'";
                            $stmt = $db->query($sql);
                        }
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
        //TRABAJO: EL MURO, GUARDIA DE LA NOCHE
        case 'guardiaNoche':
            $agotamiento = 10;
            $salario = 100;
            $estoyLibre = comprobarEspera();
            if($estoyLibre === 1){
                $puedoHacerlo = comprobarEnergia($agotamiento);
                if($puedoHacerlo === 1){
                    
                        if($recaudador === 1){
                            $sql = "UPDATE personajes SET cash = cash+$salario*1.50, energia = energia-$agotamiento, accion = ADDTIME(NOW(), '1:0:0') WHERE id='$id'";
                            $stmt = $db->query($sql);
                        }
                        else{
                            $sql = "UPDATE personajes SET cash = cash+$salario, energia = energia-$agotamiento, accion = ADDTIME(NOW(), '1:0:0') WHERE id='$id'";
                            $stmt = $db->query($sql);
                        }
                    
                }else{
                    $box = "No tengo fuerzas. Como me quede dormido quizá me devoren los Salvajes del Norte.";
                }
            }
            else{
                $box = "Aún no he descansado de mi ultima acción";
            }
            break; 
            
        //CERRAJERIA: ABRIR  
        case 'cajita oxidada':
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
                
            }else{
                $box = "No tengo dinero para pagar eso.";
            }
            break;     
            
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
            $box = 'Error: esa opcion no existe:'. $box;
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

?>