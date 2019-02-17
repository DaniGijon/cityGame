<?php

function zona($box){
    include (__ROOT__.'/backend/comprobaciones.php');
    include (__ROOT__.'/backend/tiradas.php');
    global $db;
    $id = $_SESSION['loggedIn'];
    
    
    switch($box){
        case 'aventuraLosPinos':
            $zona = 1;
            $barrio = 1;
            $agotamiento = 50;
            $probabilidad = rand(1, 30);
            $puedoHacerlo = comprobarEnergia($agotamiento);
            if($puedoHacerlo === 1){
                $sql = "UPDATE personajes SET energia = energia-50 WHERE id='$id'";
                $stmt = $db->query($sql);
                $encuentroMonstruos = buscarMonstruos($probabilidad);
                if($encuentroMonstruos === 1){
                    $box = "LO ENCONTRE!";
                    
                    // ¿Cuál monstruo he encontrado?
                    $monstruo = cualMonstruo($zona,$barrio);
                    
                    $box = $monstruo[0]['nombre'];
                }
                else{
                    $box = "No he encontrado nada";
                }
            }
            else{
                $box = "¡Ay! Estoy sin energia ahora mismo para hacer eso";
            }
            break;
        
        default :
            $box = 'Error: esa opcion no existe';
    }
    header("location: ?page=zona&message=$box");
}


if($_GET['action'] === "zona"){
    zona($_POST['cbox1']);
}

?>