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
            if($puedoHacerlo === 1){
                $sql = "UPDATE personajes SET energia = energia-$agotamiento WHERE id='$id'";
                $stmt = $db->query($sql);
                $encuentroMonstruos = buscarMonstruos($probabilidadEncontrar);
                if($encuentroMonstruos === 1){
                    // ¿Cuál monstruo he encontrado?
                    $monstruo = cualMonstruo($zona,$barrio);
                    $box = $monstruo[0]['nombre'];
                    
                    // Atacar al monstruo
                    $idMonstruo = $monstruo[0]['idM'];
                    $resultadoBatalla= atacarMonstruo($idMonstruo);
                    if($resultadoBatalla > 0){
                        //GANO RESPETO? GANO OBJETOS? 
                        $respetoGanado = rand($monstruo[0]['nivel']*2, $monstruo[0]['nivel']*5);
                        $sql = "UPDATE personajes SET respeto = respeto+$respetoGanado WHERE id='$id'";
                        $stmt = $db->query($sql);
                        
                        $celebracion = "Toma ya! He derrotado al monstruo y gano $resultadoBatalla EXP. <br> Mi respeto sube $respetoGanado puntos";
                        
                        
                    }
                    $box = "Me enfrento a un " . $box . " ... " . $celebracion;
                }
                else{
                    $box = "No he encontrado ningún monstruo. Quizá necesito aumentar algo más mi Percepción antes de salir en busca de aventuras por esta zona";
                }
            }
            else{
                $box = "¡Ay! Estoy sin energia ahora mismo para hacer eso";
            }
            break;
        
        default :
            $box = 'Error: esa opcion no existe';
    }
    header("location: ?page=accion&message=$box");
}


if($_GET['action'] === "zona"){
    zona($_POST['cbox1']);
}

?>