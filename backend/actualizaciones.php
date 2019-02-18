<?php
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
    
    
    switch($box){
        case 'quesadillas':
            $coste = 10;
            $mejoraSalud = 15;
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
            $mejoraSalud = 30;
            $puedoPagar = comprobarCoste($coste);
            if($puedoPagar === 1){
                $sql = "UPDATE personajes SET salud = CASE WHEN salud + '$mejoraSalud' > 100 THEN 100 ELSE salud + '$mejoraSalud' END, cash = cash-$coste WHERE id='$id'";
                $stmt = $db->query($sql);
            }
            else{
                $box = "No puedo pagar eso";
            }
            break;
        case 'cafeConLeche':
            $coste = 2;
            $mejoraEnergia = 10;
            $puedoPagar = comprobarCoste($coste);
            if($puedoPagar === 1){
                $sql = "UPDATE personajes SET energia = CASE WHEN energia + '$mejoraEnergia' > 100 THEN 100 ELSE energia + '$mejoraEnergia' END, cash = cash-$coste WHERE id='$id'";
                $stmt = $db->query($sql);
            }
            else{
                $box = "No puedo pagar eso";
            }
            break;
        case 'cafeIrlandes':
            $coste = 3;
            $mejoraEnergia = 15;
            $puedoPagar = comprobarCoste($coste);
            if($puedoPagar === 1){
                $sql = "UPDATE personajes SET energia = CASE WHEN energia + '$mejoraEnergia' > 100 THEN 100 ELSE energia + '$mejoraEnergia' END, cash = cash-$coste WHERE id='$id'";
                $stmt = $db->query($sql);
            }
            else{
                $box = "No puedo pagar eso";
            }
            break;
        default :
            $box = 'Error: esa opcion no existe';
    }
    header("location: ?page=zona&message=$box");
}

if($_GET['action'] === "actualizarZona"){
    actualizarZona($_POST['casilla']);
}

if($_GET['action'] === "accionSpot"){
    accionSpot($_POST['cbox1']);
}

?>